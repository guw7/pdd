<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kegiatan;
use App\User;
use App\Like;
use Validator;
use Image;
use App\Transformers\KegiatanTransformer;
use App\Transformers\ErrorTransformer;
use App\Transformers\ErrorValidasiTransformer;
use App\Transformers\PencarianTransformer;
use DB;
use Illuminate\Support\Facades\Input;

class KegiatanAPIController extends Controller
{
    
//=========================GET_PENCARIAN==============================// 

    public function cari($name = ""){

        if($name != ""){
            $cari = DB::table('tbl_kegiatan')
                        ->leftjoin('tbl_kampung','tbl_kegiatan.id_kampung','tbl_kampung.id')
                        ->where('nama_kampung','LIKE', '%'.$name.'%')
                        ->orwhere('nama_kegiatan','LIKE', '%'.$name.'%')
                        ->take(10)
                        ->get();

        $response = fractal()   
            ->collection($cari)
            ->transformwith(new PencarianTransformer)
            ->toArray();

        return response()->json($response, 200);    

        }
    }

//=========================GET_KEGIATAN==============================// 


    public function get_allkegiatan()
    {   
    $kegiatan = Kegiatan::where('tampil','1')->get();

        $response = fractal()
            ->collection($kegiatan)
            ->transformwith(new KegiatanTransformer)
            ->toArray();

        return response()->json($response, 200);    
   
    }

    public function get_allkegiatanid($id)
    {
        $kegiatan = Kegiatan::find($id);
        
    $kegiatan->j_view = $kegiatan->j_view+1;
    $kegiatan->save();
    
        $response = fractal()
            ->item($kegiatan)
            ->transformwith(new KegiatanTransformer)
            ->toArray();

            return response()->json($response, 200);
    }


//============================POST_KEGIATAN=================================// 

    public function post_kegiatan (Request $request, Kegiatan $kegiatan)
    {
        $validator = Validator::make($request->all(),

        array(
                'nama_kegiatan' => 'required|min:5',
                'alamat' => 'required',
                'kontak_person' => 'required|min:12',
                'email' => 'required|email|unique:tbl_user,email',
                'mulai_kegiatan' => 'required',
                'berakhir_kegiatan' => 'required',
                'penanggung_jawab' => 'required',
                'jumlah_anggaran' => 'required',
                'thn_anggaran' => 'required',
                'nama_kampung' => 'required',
            ),

        array(
                'nama_kegiatan.required' => 'nama kegiatan tidak boleh kosong',
                'nama_kegiatan.min' => 'nama kegiatan minimal 5 karakter',
                'alamat.required' => 'alamat tidak boleh kosong',
                'kontak_person.required' => 'Kontak tidak boleh kosong',
                'kontak_person.min' => 'Kontak minimal 12 karakter',
                'email.required' => 'username tidak boleh kosong',
                'email.email' => 'email harus valid',             
                'email.unique' => 'email sudah digunakan',                   
                'mulai_kegiatan.required' => 'Mulai Kegiatan tidak boleh kosong',
                'berakhir_kegiatan.required' => 'Berakhir Kegiatan tidak boleh kosong',
                'penanggung_jawab.required' => 'Penanggung Jawab tidak boleh kosong',
                'jumlah_anggaran.required' => 'Jumlah Anggaran tidak boleh kosong',
                'thn_anggaran.required' => 'Tahun Anggaran tidak boleh kosong',
                'nama_kampung.required' => 'Nama Kampung tidak boleh kosong'
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

            $nama_kegiatan = $request->nama_kegiatan;
            $alamat = $request->alamat;
            $kontak_person = $request->kontak_person;
            $email = $request->email;
            $mulai_kegiatan = $request->mulai_kegiatan;
            $berakhir_kegiatan = $request->berakhir_kegiatan;
            $penanggung_jawab = $request->penanggung_jawab;
            $jumlah_anggaran = $request->jumlah_anggaran;
            $thn_anggaran = $request->thn_anggaran;
            $nama_kampung = $request->nama_kampung;
            $longitude = $request->longitude;
            $latitude = $request->latitude;


//==================================FOTO============================================

            // $image=$request->file('foto');
            
            // $input['imagename'] = date('d-m-Y-H-i-s').'.'.$image->getClientExtension();

            // $destinationPath = ('images/kegiatan');
            // $img = Image::make($image->getRealPath());
            // $img->resize(100, 100, function ($constraint) {
            //     $constraint->aspectRatio();
            // })->save($destinationPath.'/'.$input['imagename']);

            // $image->move($destinationPath, $input[imagename]);
            // $directori = $destinationPath.'/'.$input['imagename'];

              if (Input::hasFile('foto')) {
            
                $image = $request->file('foto');

                $input['imagename'] =  date('ymdhis').'.'.$image->getClientOriginalExtension();

                $destinationPath = ('images');
                $img = Image::make($image->getRealPath());
                $img->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$input['imagename']);

                $image->move($destinationPath, $input['imagename']);

                $direktori = $destinationPath.'/'.$input['imagename'];
                $warkop->foto = $direktori;


//==================================================================================

            $kegiatan = new Kegiatan();

            $kegiatan->nama_kegiatan=$nama_kegiatan;
            $kegiatan->alamat=$alamat;
            $kegiatan->kontak_person=$kontak_person;
            $kegiatan->email=$email;
            $kegiatan->mulai_kegiatan=$mulai_kegiatan;
            $kegiatan->berakhir_kegiatan=$berakhir_kegiatan;
            $kegiatan->penanggung_jawab=$penanggung_jawab;
            $kegiatan->jumlah_anggaran=$jumlah_anggaran;
            $kegiatan->thn_anggaran=$thn_anggaran;
            $kegiatan->nama_kampung=$nama_kampung;
            $kegiatan->longitude=$longitude;
            $kegiatan->tampil=0;
            $kegiatan->j_like=0;
            $kegiatan->j_unlike=0;
            $kegiatan->j_view=0;
           // $kegiatan->j_share=0;
            $kegiatan->j_comment=0;
           // $kegiatan->j_rate=0;
            $kegiatan->foto=$directori;
            
            $kegiatan->save();

            $response = fractal()
                ->item($kegiatan)
                ->transformWith(new KegiatanTransformer)
                ->toArray();

            return response()->json($response, 200);
        }
    }

//============================POST_LIKE=================================// 

    public function post_like(Request $request,$id)
    {
    
        $user = User::where('id',$id)->first();

            $user_id = $user->id;
            $keg_id= $request->id_kegiatan;
    
            $check = Like::where('id_kegiatan', $keg_id)->where('user_id', $user_id)->first();

            if($check){
                $like = Like::where('id_kegiatan', $keg_id)->where('user_id', $user_id)->first();

                $like->user_id = $user_id;
                $like->id_kegiatan= $keg_id;
                $like->suka = 1;

                $kegiatan = Kegiatan::findOrFail($keg_id);
                $kegiatan->j_like = $kegiatan->j_like+1;
                $kegiatan->j_unlike = $kegiatan->j_unlike-1;
                $kegiatan->save();
                $like->save();

                $respone =  fractal()
                    ->item($kegiatan)
                    ->transformWith(new KegiatanTransformer)
                    ->toArray();
                return response()->json($respone, 200);
            }else{
                $like= new Like;
                
                $like->user_id = $user_id;
                $like->id_kegiatan = $keg_id;
                $like->suka = 1;

                $kegiatan = Kegiatan::findOrFail($keg_id);
 
                $kegiatan->j_like = $kegiatan->j_like+1;

                $kegiatan->save();

                $like->save();

                $respone =  fractal()   
                    ->item($kegiatan)
                    ->transformWith(new KegiatanTransformer)
                    ->toArray();
                return response()->json($respone, 200);
            }
    }

//============================POST_UNLIKE=================================// 

    public function post_dislike(Request $request,$id)
    {
        $user = User::where('id',$id)->first();

            $user_id = $user->id;
            $keg_id = $request->id_kegiatan;

            $check = Like::where('id_kegiatan', $keg_id)->where('user_id', $user_id)->first();

            if($check){
                $like = Like::where('id_kegiatan', $keg_id)->where('user_id', $user_id)->first();

               $like->user_id = $user_id;
                $like->id_kegiatan = $keg_id;
                $like->suka = 0;

                    $kegiatan = Kegiatan::findOrFail($keg_id);
             $kegiatan->j_unlike = $kegiatan->j_unlike+1;
                    $kegiatan->j_like = $kegiatan->j_like-1;

                    $kegiatan->save();
                   
                $like->save();

                $respone =  fractal()
                    ->item($kegiatan)
                    ->transformWith(new KegiatanTransformer)
                    ->toArray();
                return response()->json($respone, 200);
            }else{
                $like = new Like();

                $like->user_id = $user_id;
                $like->id_kegiatan = $keg_id;
                $like->suka = 0;

                    $warkop = Kegiatan::findOrFail($keg_id);

                    $kegiatan->j_unlike = $kegiatan->j_unlike+1;
                    $kegiatan->j_like = $kegiatan->j_like-1;

                    $kegiatan->save();

                $like->save();

                $respone =  fractal()
                    ->item($kegiatan)
                    ->transformWith(new KegiatanTransformer)
                    ->toArray();
                return response()->json($respone, 200);
            }  
    }

}
