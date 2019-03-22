<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    
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

    public function index()
    {
        $profile = User::all();

        return view('user.datauser', compact('profile'));
    }
    
    public function create()
    {
        return view('user.createuser');
    }

    public function store(Request $request)
    {
     
        $validator = Validator::make($request->all(),   
        
            array(
                    'nama' => 'required|min:5',
                    'username' => 'required|min:5',
                    'email' => 'required|email',
                    'password' => 'required|min:5',
                 ),
        

            array(
                    'nama.required' => 'nama tidak boleh kosong',
                    'nama.min' => 'nama harus 5 karakter',
                    'username.required' => 'username tidak boleh kosong',
                    'username.min' => 'username harus 5 karakter',
                    'email.required' => 'email tidak boleh kosong',
                    'email.email' => 'email harus valid ( @example.com )',                    
                    'password.required' => "Password tidak boleh kosong",
                    'password.min' => 'password minimal 5 karakter',
                  )
        );

        //Kondisi validasi (Pesan Error yang akan terjadi)
        if($validator->fails()){

            $eror = $validator->messages()->all();
            return redirect()->route('user.create')->withErrors($validator);
        
        }else {

//==========================================================================
            $hash                = $this->getHash($request->password);
            $encrypted_password  = $hash['encrypted'];
            $salt                = $hash['salt'];    
//==========================================================================

            $user = new User();

            $user->nama = $request->nama;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = $encrypted_password;
            
           $user->save();

            return redirect()->route('user.index')->with('SUCCESS', 'Data Berhasil Dihapus');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user= User::findOrFail($id);
       
        return view('user.edituser', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(),   
        
           array(
                    'nama' => 'required|min:5',
                    'username' => 'required|min:5',
                    'email' => 'required|email',
                 ),
        
            array(
                    'nama.required' => 'nama tidak boleh kosong',
                    'nama.min' => 'nama harus 5 karakter',
                    'username.required' => 'username tidak boleh kosong',
                    'username.min' => 'username harus 5 karakter',
                    'email.required' => 'email tidak boleh kosong',
                    'email.email' => 'email harus valid ( @example.com )', 
                  )
                 
        );

        //Kondisi validasi (Pesan Error yang akan terjadi)
        if($validator->fails()){

            $eror = $validator->messages()->all();
            return redirect()->route('user.edit')->withErrors($validator);
        
        }else {

            $user = User::findOrFail($id);

            $user->nama=$request->nama;
            $user->username=$request->username;
            $user->email=$request->email;

            $user->save();

            return redirect()->route('user.index')->with('SUCCESS', 'Data Berhasil Di Update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('user.index')->with('SUCCESS', 'Data Berhasil Di Hapus');
    }
}
