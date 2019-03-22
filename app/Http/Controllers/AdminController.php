<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Validator;
use App\Kegiatan;
use App\Kampung;
use App\User;
use App\Komentar;
use Auth;

class AdminController extends Controller
{

    public function dash(Request $request)
    {
        $kegiatan = Kegiatan::all()->count();
        $kampung = Kampung::all()->count();
        $user = User::all()->count();
        $komentar = Komentar::all()->count();

        return view ('index', compact('kegiatan','kampung','user','komentar'));
    }



//==========================LOGIN=======================================

    public function masuk(Request $request, Admin $admin)
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

            return redirect('/')->withErrors($validator);
            
        }else {

        	$username = $request->username;
            $password = $request->password;

            $admin = Admin::where('username',$username)->first();

            if($admin){
            	$db_encrypted_password = $admin->password;
            	$salt = $admin->salt;

            	//Pengecekan Password
            	$hasil_pass = $this->verifyHash($password.$salt,$db_encrypted_password);

            	if($hasil_pass) {
            		
            		$take = Admin::where('username',$username)->first();

            			// auth()->guard('admin')->attempt();
            			session(['username' => $take->username]);

            			return redirect('admin/index');
             	 }

			else {
            		return redirect('/')->with('gagal', 'Password Anda Salah');
            	 }
            } 

            else {
            		return redirect('/')->with('gagal', 'Username dan Password Anda Salah');
            } 
        }
	}

	protected function guard()
	{
		return Auth::guard('admin');
	}

	public function index(Request $request) {
		if($request->session()->has('username')) {
			return view('index');
		}else {
			return redirect('/');
		}
	}

//============================LOGOUT=================================//	
	
	public function logout (Request $request) {

		$request->session()->regenerate();
		$request->session()->flush();

		return redirect('/');
	}


//============================REGISTER=================================//	


	public function register(Request $request, Admin $admin)
	{
		$validator = Validator::make($request->all(),   
        
            array(
                  	'nama' => 'required|min:5',   
                    'username' => 'required|min:5|unique:tbl_admin,username',
                    'email' => 'required|email|unique:tbl_admin,email',
                    'bio' => 'required',
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
                    'bio.required' => 'bio tidak boleh kosong',    
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
            $bio = $request->bio;
            
	//=====================================================================        
            $hash                =	$this->getHash($request->password);
            $encrypted_password  =	$hash['encrypted'];
            $salt                =	$hash['salt'];    
	//=====================================================================

            $admin = new Admin();
            $admin->nama=$nama;
            $admin->username=$username;
            $admin->email=$email;
            $admin->bio=$bio;
            $admin->salt=$salt;

            $admin->password=$encrypted_password;

            $admin->token=bcrypt($encrypted_password);
            $admin->save();

            $response = fractal()
				->item($admin)
				->transformWith(new AdminTransformer)
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


}
