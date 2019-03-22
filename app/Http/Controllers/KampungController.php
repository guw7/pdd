<?php

namespace App\Http\Controllers;

use App\Kampung;
use App\Kegiatan;
use Illuminate\Http\Request;
use Validator;
use DB;
class KampungController extends Controller
{

    public function index()
    {
        
        $kampungs  = Kampung::all();
        
            return view('kampung.datakampung', compact('kampungs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $kampungs = Kampung::all();
        
             return view('kampung.createkampung', compact('kampungs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),

            array(
            
                'nama_kampung' => 'required|min:5',
                'nm_gecik' => 'required|min:5',
                ),

            array(

               
                'nama_kampung.required' => 'nama kampung tidak boleh kosong',
                'nama_kampung.min' => 'nama kampung minimal 5 karakter',
                'nm_gecik.required' => 'nama geuchik tidak boleh kosong',
                'nm_gecik.min' => 'nama geuchik minimal 5 karakter',
                )
        );

        if ($validator->fails()){
            $eror = $validator->messages()->all();
            return redirect()->route('kampung.create')->withErrors($validator);
        
        }else{

        }

        $kampung = new Kampung();

       
        $kampung->nama_kampung = $request->nama_kampung;  
        $kampung->nm_gecik = $request->nm_gecik;  

        $kampung->save();

        return redirect()->route('kampung.index')->with('SUCCESS', 'Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kampung  $kampung
     * @return \Illuminate\Http\Response
     */
    public function show(Kampung $kampung)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kampung  $kampung
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kampung = Kampung::findOrFail($id);
       
        return view('kampung.editkampung', compact('kampung'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kampung  $kampung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          
        $validator = Validator::make($request->all(),   
        
           array(
                
                
                'nama_kampung' => 'required|min:5',
                'nm_gecik' => 'required|min:5',
                ),
            array(

               
                'nama_kampung.required' => 'nama tidak boleh kosong',
                'nama_kampung.min' => 'nama kampung minimal 5 karakter',
                'nm_gecik.min' => 'nama geuchik tidak boleh kosong',
                'nm_gecik.min' => 'nama geuchik minimal 5 karakter',
                )
                 
        );

        //Kondisi validasi (Pesan Error yang akan terjadi)
        if($validator->fails()){

            $eror = $validator->messages()->all();
            return redirect()->route('kampung.edit')->withErrors($validator);
        
        }else {

            $kampung = Kampung::findOrFail($id);

           
            $kampung->nama_kampung=$request->nama_kampung;
            $kampung->nm_gecik=$request->nm_gecik;

            $kampung->save();

            return redirect()->route('kampung.index')->with('SUCCESS', 'Data Berhasil Di Update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kampung  $kampung
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kampung = Kampung::findOrFail($id);

        $kampung->delete();

        return redirect()->route('kampung.index')->with('SUCCESS', 'Data Berhasil Di Hapus');
    }
}
