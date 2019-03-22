<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Transformers\UserTransformer;
use App\Transformers\ErrorTransformer;
use App\Transformers\ErrorValidasiTransformer;


class UserAPIController extends Controller
{   

//=====================GET===========================//

	public function get_alluserid($id)
	{
		$user = User::find($id);

		$response = fractal()
			->item($user)
			->transformWith(new UserTransformer)
			->toArray();

			return response()->json($response, 200);
	}

//============================POST_LOGIN=================================//	

	public function login(Request $request, User $user)
	{
		 $validator = Validator::make($request->all(),   
        
            array(
                    
                    'username' => 'required|min:5',
                    'password' => 'required|min:5',
                 ),

            array(
                    
                    'username.required' => 'username tidak boleh kosong',
                    'username.min' => 'username harus 5 karakter',                   
                    'password.required' => 'Password tidak boleh kosong',
                    'password.min' => 'password minimal 5 karakter',
                  )
        );

		//Kondisi validasi (Pesan Error yang akan terjadi)
        if($validator->fails()){

            $eror = $validator->messages()->all();

            $response = fractal()
				->item($eror)
				->transformWith(new ErrorValidasiTransformer)
				->toArray();

			return response()->json($response, 200);
        
        }else {

        	$username = $request->username;
            $password = $request->password;

            $user = User::where('username',$username)->first();

            if($user){
            	$db_encrypted_password = $user->password;
            	$salt = $user->salt;

            	//Pengecekan Password
            	$hasil_pass = $this->verifyHash($password.$salt,$db_encrypted_password);

            	if($hasil_pass) {
            		
            		$response = fractal()
            			->item($user)
            			->transformWith(new UserTransformer)
            			->toArray();

            	return response()->json($response, 200);

            	}
            	else {

            		$message = 'Password anda Salah !';

            		$response = fractal()
            			->item($message)
            			->transformWith(new ErrorTransformer)
            			->toArray();

            		return response()->json($response, 401);	
            	}
            } 
            else {

            	$message ='Username dan password tidak ada';
            	
            	$response = fractal()

            			->item($message)
            			->transformWith(new ErrorTransformer)
            			->toArray();

            		return response()->json($response, 404);	
            } 

        }
	}

//============================POST_REGISTER=================================//	


	public function register(Request $request, User $user)
	{
		$validator = Validator::make($request->all(),   
        
            array(
                  	'nama' => 'required|min:5',   
                    'username' => 'required|min:5|unique:tbl_user,username',
                    'email' => 'required|email|unique:tbl_user,email',
                    'password' => 'required|min:5',
                 ),
        
            array(
                    'nama.required' => 'nama tidak boleh kosong',
                    'nama.min' => 'nama harus 5 karakter',                   
                    'username.required' => 'username tidak boleh kosong',
                    'username.min' => 'username harus 5 karakter',
                    'username.unique' => 'username sudah digunakan',
                    'email.required' => 'email tidak boleh kosong',
                    'email.email' => 'email harus valid',             
                    'email.unique' => 'email sudah digunakan',
                    'password.required' => 'Password tidak boleh kosong',
                    'password.min' => 'password minimal 5 karakter',
                  )
        );

        //Kondisi validasi (Pesan Error yang akan terjadi)
        if($validator->fails()){

            $eror = $validator->messages()->all();

            $response = fractal()
				->item($eror)
				->transformWith(new ErrorValidasiTransformer)
				->toArray();

			return response()->json($response, 401);
        
        }else {

            $nama = $request->nama;
            $username = $request->username;
            $email = $request->email;
            
	//=====================================================================        
            $hash                =	$this->getHash($request->password);
            $encrypted_password  =	$hash['encrypted'];
            $salt                =	$hash['salt'];    
	//=====================================================================

            $user = new User();
            $user->nama=$nama;
            $user->username=$username;
            $user->email=$email;
            $user->salt=$salt;

            $user->password=$encrypted_password;

            $user->token=bcrypt($encrypted_password);
            $user->save();

            $response = fractal()
				->item($user)
				->transformWith(new UserTransformer)
				->toArray();

			return response()->json($response, 200);
        }

	}

	//Berfungsi untuk mengembalikan yang sudah di enkripsi
    public function verifyHash($password, $hash)
    {
        return password_verify($password, $hash);
    }

    //Berfungsi Ambil Enkripsi Password
    public function getHash($password)
    {
        $salt       = sha1(rand());
        $salt       = substr($salt, 0, 10);
        $encrypted  = password_hash ($password.$salt, PASSWORD_DEFAULT);
        $hash       = array("salt" => $salt, "encrypted" => $encrypted);

        return $hash;
    }

//=============================POST_UBAH_PASSWORD========================================

    public function editpassword(Request $request, $id)
        {
            $validator = Validator::make($request->all(),
                array(
                    'password' => 'min:5',
                    'newpassword' => 'min:5',
                    ),
                
                array(
                    'password.min' => 'password minimal 5 karakter',
                    'newpassword.min' => 'password baru minimal 5 karakter',
                    )
                );

            if($validator->fails()){

                $eror = $validator->messages()->all();

                $response = fractal()
                    ->item($eror)
                    ->transformWith(new ErrorValidasiTransformer)
                    ->toArray();

                return response()->json($response, 401);
            
            }else{


                $password = $request->password;
                $newpassword = $request->newpassword;

                $user = User::findOrFail($id);

                $db_encrypted_password = $user->password;
                $salt = $user->salt;

                //Pengecekan Password
                $cek_password = $this->verifyHash($password.$salt,$db_encrypted_password);

                if($cek_password){
                    if($newpassword == $password){

                        $messages = 'Password baru dengan password lama tidak boleh sama';
                        $response = fractal()
                            ->item($messages)
                            ->transformWith(new ErrorValidasiTransformer)    
                            ->toArray();

                        return response()->json($response, 401);

                    }else{

                        $hash                =  $this->getHash($request->newpassword);
                        $encrypted_password  =  $hash['encrypted'];
                        $salt123                =  $hash['salt'];    

                        $user = User::findOrFail($id);

                        $user->password = $encrypted_password;
                        $user->salt=$salt123;
                        $user->save();

                        $respone =  fractal()
                            ->item($user)
                            ->transformWith(new UserTransformer)
                            ->toArray();
                        return response()->json($respone, 200);                
                    }

                }else{
                    $messages = 'Password lama anda salah';
                    $respone =  fractal()
                        ->item($messages)
                        ->transformWith(new ErrorValidasiTransformer)
                        ->toArray();
                    return response()->json($respone, 401);
                }
            }
        }

//=============================POST_EDIT_PROFILE=========================================

     public function editprofile(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            array(
                    'nama' => 'required|min:5',  
                    'email' => 'required|email',
                ),
            
            array(

                    'nama.required' => 'nama tidak boleh kosong',
                    'nama.min' => 'nama harus 5 karakter',    
                    'email.required' => 'username tidak boleh kosong',
                    'email.email' => 'email harus valid',   
                )

            );

        if($validator->fails()){

            $eror = $validator->messages()->all();

            $response = fractal()
                ->item($eror)
                ->transformWith(new ErrorValidasiTransformer)
                ->toArray();

            return response()->json($response, 401);
        
        }else{

            $user = User::findOrFail($id);

            $user->nama = $request->nama;
            $user->email = $request->email;

            $user->save();

            $response = fractal()
                        ->item($user)
                        ->transformWith(new UserTransformer)
                        ->toArray();

                return response()->json($response, 200);
        }
    }

//=====================================================================

}