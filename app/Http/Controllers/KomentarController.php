<?php

namespace App\Http\Controllers;

use App\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Image;
use DB;


class KomentarController extends Controller
{
	 public function index()
    {
        //$komentars = Komentar::all();

        $komentars = DB::table('tbl_komentar')
                        ->select('tbl_komentar.*','tbl_user.nama','tbl_kegiatan.nama_kegiatan')
                        ->leftjoin('tbl_user','tbl_komentar.user_id','tbl_user.id')
                        ->leftjoin('tbl_kegiatan', 'tbl_komentar.id_kegiatan','tbl_kegiatan.id')
                        ->get();

        return view('komentar.datakomentar', compact('komentars'));
    }

    public function create()
    {
        // $komentars = Komentar::all();

        // $komentars = DB::table('tbl_komentar')
        //                 ->select('tbl_komentar.*','tbl_user.nama','tbl_kegiatan.nama_kegiatan')
        //                 ->leftjoin('tbl_user','tbl_komentar.user_id','tbl_user.id')
        //                 ->leftjoin('tbl_kegiatan', 'tbl_komentar.id_kegiatan','tbl_kegiatan.id')
        //                 ->get();
        
        // return view('komentar.createkomentar', compact('komentars'));

         $komentars = Komentar::all();
        
             return view('komentar.createkomentar', compact('komentars'));
    }

    public function store(Request $request)
    {
         $validator = Validator::make($request->all(),   
        
           array(
                    'user_id' => 'required',
                    'id_kegiatan' => 'required',
                    'komen' => 'required',
                 ),
        
            array(
                    'user_id.required' => 'ID User tidak boleh kosong',
                    'id_kegiatan.required' => 'ID Kegiatan tidak boleh kosong',
                    'komen.required' => 'Komentar tidak boleh kosong',
                  )
        );

        //Kondisi validasi (Pesan Error yang akan terjadi)
        if($validator->fails()){

            $eror = $validator->messages()->all();

            return redirect()->route('komentar.create')->withErrors($validator);
        
        }else {

            $komentar = new Komentar();

            $komentar->user_id = $request->user_id;
            $komentar->id_kegiatan = $request->id_kegiatan;
            $komentar->komentar = $request->komentar;

            if (Input::hasfile('foto')) {
    
            $input['imagename'] =  date('ymdhis').'.'.$image->getClientOriginalExtension();
    
            $destinationPath = ('images');
            $img = Image::make($image->getRealPath());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);
    
            $image->move($destinationPath, $input['imagename']);
    
            $direktori = $destinationPath.'/'.$input['imagename'];
            $kegiatan->foto = $direktori;
    
        }

            $komentar->save();

            return redirect()->route('komentar.index')->with('SUCCESS', 'Data Berhasil Disimpan');
        }
    }    

    /**
     * Display the specified resource.
     *
     * @param  \App\komentar  $komentar
     * @return \Illuminate\Http\Response
     */
    public function show(komentar $komentar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\komentar  $komentar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       	$komentar = Komentar::find($id);
       
        return view('komentar.editkomentar', compact('komentar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\komentar  $komentar
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
    
        $validator = Validator::make($request->all(),   
        
           array(
                
                'komentar' => 'required',
                ),

            array(

                'komentar.required' => 'Komentar tidak boleh kosong',
                )
        );

        //Kondisi validasi (Pesan Error yang akan terjadi)
        if($validator->fails()){

            $eror = $validator->messages()->all();
            return redirect()->route('komentar.edit')->withErrors($validator);
        
        }else {

            $komentar = Komentar::findOrFail($id);

            $komentar->komentar = $request->komentar;

            if (Input::hasFile('foto')) {
            
                $image = $request->file('foto');
                if ($komentar->foto != "") {
                    $path = $komentar->foto;

                    //Log::info($filename);
                    unlink($path);
                }
                    $input['imagename'] =  date('ymdhis').'.'.$image->getClientOriginalExtension();

                    $destinationPath = ('images');
                    $img = Image::make($image->getRealPath());
                    $img->resize(100, 100, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$input['imagename']);

                    $image->move($destinationPath, $input['imagename']);

                    $direktori = $destinationPath.'/'.$input['imagename'];
                    $komentar->foto = $direktori;

            }
            $komentar->save();

         return redirect()->route('komentar.index')->with('SUCCESS', 'Data Berhasil Di Update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\komentar  $komentar
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $komentar = Komentar::findOrFail($id);

        $komentar->delete();

        return redirect()->route('komentar.index')->with('SUCCESS', 'Data Berhasil Di Hapus');
    }


    // public function tampil($id)
    // {
    //     $komentar=Komentar::findOrFail($id);

    //     $komentar->tampil=1;

    //     $komentar->save();

    //     return redirect()->route('komentar.index')->with('SUCCESS', 'Berhasil Tampilkan');
    // }

    // public function hilangkan($id)
    // {
    //     $komentar=Komentar::findOrFail($id);

    //     $komentar->tampil=0;

    //     $komentar->save();

    //     return redirect()->route('komentar.index')->with('SUCCESS', 'Berhasil Hilangkan');
    // }
}
