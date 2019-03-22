<?php

namespace App\Http\Controllers;

use App\Kegiatan;
use Illuminate\Http\Request;
use Validator;
use DB;
use Illuminate\Support\Facades\Input;
use Image;
use App\Kampung;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $kegiatans = Kegiatan::all();

        $kegiatans  = DB::table('tbl_kegiatan')
                        ->select('tbl_kegiatan.*','tbl_kampung.nama_kampung')
                        ->leftjoin('tbl_kampung','tbl_kegiatan.id_kampung','tbl_kampung.id')
                        ->get();

        return view('kegiatan.datakegiatan', compact('kegiatans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kegiatans = Kegiatan::all();
        
        $kampungs = Kampung::all();
    
        return view('kegiatan.createkegiatan', compact('kegiatans','kampungs'));
    }

    public function store(Request $request)
    {
         $validator = Validator::make($request->all(),   
        
           array(
                    'nama_kegiatan' => 'required|min:5',
                 //   'alamat' => 'required',
                 //   'kontak_person' => 'required|min:12',
                 //   'email' => 'required|email',
                    'keterangan' => 'required',
                    'mulai_kegiatan' => 'required',
                    'berakhir_kegiatan' => 'required',
                 //   'penanggung_jawab' => 'required',
                    'jumlah_anggaran' => 'required',
                    'thn_anggaran' => 'required',
                    'id_kampung' => 'required',
                 ),
        
            array(
                    'nama_kegiatan.required' => 'nama kegiatan tidak boleh kosong',
                    'nama_kegiatan.min' => 'nama kegiatan minimal 5 karakter',
                //    'alamat.required' => 'alamat tidak boleh kosong',
                // 'kontak_person.required' => 'Kontak tidak boleh kosong',
                // 'kontak_person.min' => 'Kontak minimal 12 karakter',
                // 'email.required' => 'email tidak boleh kosong',
                // 'email.email' => 'email harus valid ( @example.com )',     
                    'keterangan.required' => 'keterangan tidak boleh kosong',               
                    'mulai_kegiatan.required' => 'Mulai Kegiatan tidak boleh kosong',
                    'berakhir_kegiatan.required' => 'Berakhir Kegiatan tidak boleh kosong',
                // 'penanggung_jawab.required' => 'Penanggung Jawab tidak boleh kosong',
                    'jumlah_anggaran.required' => 'Jumlah Anggaran tidak boleh kosong',
                    'thn_anggaran.required' => 'Tahun Anggaran tidak boleh kosong',
                    'id_kampung.required' => 'Nama Kampung tidak boleh kosong',
                    
                  )
        );

        //Kondisi validasi (Pesan Error yang akan terjadi)
        if($validator->fails()){

            $eror = $validator->messages()->all();
            return redirect()->route('kegiatan.create')->withErrors($validator);
        
        }else {

            $kegiatan = new Kegiatan();

            $kegiatan->nama_kegiatan = $request->nama_kegiatan;
            $kegiatan->alamat = $request->alamat;
            $kegiatan->kontak_person = $request->kontak_person;
            $kegiatan->email = $request->email;
            $kegiatan->keterangan = $request->keterangan;
            $kegiatan->mulai_kegiatan = $request->mulai_kegiatan;
            $kegiatan->berakhir_kegiatan = $request->berakhir_kegiatan;
            $kegiatan->penanggung_jawab = $request->penanggung_jawab;
            $kegiatan->jumlah_anggaran = $request->jumlah_anggaran;
            $kegiatan->thn_anggaran = $request->thn_anggaran;
            $kegiatan->id_kampung = $request->id_kampung;
            
            
            
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

            $kegiatan->save();
                
            return redirect()->route('kegiatan.index')->with('SUCCESS', 'Data Berhasil Disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function show(Kegiatan $kegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $kegiatan = Kegiatan::find($id);
        $id_kampung =$kegiatan->id_kampung;
    $ambilkampungs = Kampung::where('id',$id_kampung)->get();
        $kampungs = Kampung::all();
        return view('kegiatan.editkegiatan', compact('kegiatan','kampungs','ambilkampungs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
        $validator = Validator::make($request->all(),   
        
           array(
                
                'nama_kegiatan' => 'required|min:5',
        //        'alamat' => 'required',
        //        'kontak_person' => 'required|min:12',
        //        'email' => 'required|email',
                'mulai_kegiatan' => 'required',
                'berakhir_kegiatan' => 'required',
        //        'penanggung_jawab' => 'required',
                'jumlah_anggaran' => 'required',
                'thn_anggaran' => 'required',
                'id_kampung' => 'required',

                ),

            array(

                'nama_kegiatan.required' => 'nama kegiatan tidak boleh kosong',
                'nama_kegiatan.min' => 'nama kegiatan minimal 5 karakter',
            // 'alamat.required' => 'alamat tidak boleh kosong',
            // 'kontak_person.required' => 'Kontak tidak boleh kosong',
            // 'kontak_person.min' => 'Kontak minimal 12 karakter',
            // 'email.required' => 'email tidak boleh kosong',
            // 'email.email' => 'email harus valid ( @example.com )',                    
                'mulai_kegiatan.required' => "Mulai Kegiatan tidak boleh kosong",
                'berakhir_kegiatan.required' => "Berakhir Kegiatan tidak boleh kosong",
                'penanggung_jawab.required' => "Penanggung Jawab tidak boleh kosong",
            // 'jumlah_anggaran.required' => "Jumlah Anggaran tidak boleh kosong",
                'thn_anggaran.required' => "Tahun Anggaran tidak boleh kosong",
                'id_kampung.required' => "Nama Kampung tidak boleh kosong",
                )
        );

        //Kondisi validasi (Pesan Error yang akan terjadi)
        if($validator->fails()){

            $eror = $validator->messages()->all();
            return redirect()->route('kegiatan.edit')->withErrors($validator);
        
        }else {

            $kegiatan = Kegiatan::findOrFail($id);

            $kegiatan->nama_kegiatan = $request->nama_kegiatan;
            $kegiatan->alamat = $request->alamat;
            $kegiatan->kontak_person = $request->kontak_person;
            $kegiatan->email = $request->email;
            $kegiatan->keterangan = $request->keterangan;
            $kegiatan->mulai_kegiatan = $request->mulai_kegiatan;
            $kegiatan->berakhir_kegiatan = $request->berakhir_kegiatan;
            $kegiatan->penanggung_jawab = $request->penanggung_jawab;
            $kegiatan->jumlah_anggaran = $request->jumlah_anggaran;
            $kegiatan->thn_anggaran = $request->thn_anggaran;
            $kegiatan->id_kampung = $request->id_kampung;

            if (Input::file('foto')) {
            
                $image = $request->file('foto');
                if ($kegiatan->foto != "") {
                    $path = $kegiatan->foto;

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
                    $kegiatan->foto = $direktori;

            }
            $kegiatan->save();

         return redirect()->route('kegiatan.index')->with('SUCCESS', 'Data Berhasil Di Update');
        }
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $kegiatan->delete();

        return redirect()->route('kegiatan.index')->with('SUCCESS', 'Data Berhasil Di Hapus');
    }

    public function tampil($id)
    {
        $kegiatan=Kegiatan::findOrFail($id);

        $kegiatan->tampil=1;

        $kegiatan->save();

        return redirect()->route('kegiatan.index')->with('SUCCESS', 'Berhasil Tampilkan');
    }

    public function hilangkan($id)
    {
        $kegiatan=Kegiatan::findOrFail($id);

        $kegiatan->tampil=0;

        $kegiatan->save();

        return redirect()->route('kegiatan.index')->with('SUCCESS', 'Berhasil Hilangkan');
    }

}
