<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Komentar;
use App\Kegiatan;
use App\User;
use App\Transformers\KomentarTransformer;
use App\Transformers\ErrorValidasiTransformer;
use Validator;

class KomentarAPIController extends Controller
{

//=============================POST_KOMENTAR=========================================

    public function post_komentar(Request $request,$id)
    {
        $validator= Validator::make($request->all(),
            array(
                    'komen' => 'required|max:250',
                ),

            array(
                    'komen.required' =>'Komentar Harus Di isi',
                    'komen.max' => 'Maximal 250 Karakter',
                )
            );

        if($validator->fails())
        {
            $error = $validator->messages()->all();
            $response = fractal()
                    ->item($error)
                    ->transformWith(new ErrorValidasiTransformer)
                    ->toArray();

            return response()->json($response, 401);        
        }
        else {

            $user = User::find($id);

            $user_id = $user->id;
            
            $komentar = new Komentar();

            $komentar->id_kegiatan = $request->id_kegiatan;
            $komentar->user_id = $user_id;
            $komentar->komen = $request->komen;
            $komentar->rate = 0;
            $komentar->j_like = 0;

//====================================FOTO=================================================
           
            // if (input::hasFile('foto')) 
            // {   
            //     $user = User::findOrFail($id);

            //     $image=$request->file('foto');
                
            //     $input['imagename'] = date('d-m-Y-H-i-s').'.'.$image->getClientExtension();

            //     $destinationPath = ('images');
            //     $img = Image::make($image->getRealPath());
            //     $img->resize(100, 100, function ($constraint) {
            //         $constraint->aspectRatio();
            //     })->save($destinationPath.'/'.$input['imagename']);

            //     $image->move($destinationPath, $input[imagename]);
            //     $directori = $destinationPath.'/'.$input['imagename'];

            //     $komentar->foto=$directori;


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
                $komentar->foto = $direktori;


            }

//====================================================================================            

            $kegiatan = Kegiatan::find($request->id_kegiatan);

            $kegiatan->j_comment = $kegiatan->j_comment+1;
            $kegiatan->save();

            $komentar->save();

            $response = fractal()
                    ->item($komentar)
                    ->transformWith(new KomentarTransformer)
                    ->toArray();

            return response()->json($response, 200);
        }
    }

//=============================GET_KOMENTAR=========================================

    public function get_komentar($id)
    {
        //$komentar = Komentar::where('id_kegiatan', $id)->where('tampil','1')->get();
        
        // $komentar = DB::table('tbl_komentar')
        //                 ->select('tbl_komentar.*','tbl_user.nama','tbl_kegiatan.nama_kegiatan')
        //                 ->leftjoin('tbl_user','tbl_komentar.user_id','tbl_user.id')
        //                 ->leftjoin('tbl_kegiatan', 'tbl_komentar.id_kegiatan','tbl_kegiatan.id')
        //                 ->get();


        $komentar = Komentar::where('id_kegiatan', $id)->get();

       
        //$komentar = Komentar::all();
        
        $response = fractal()
            ->collection($komentar)
            ->transformWith(new KomentarTransformer)
            ->toArray();

        return response()->json($response, 200);

    }
    
    public function get_komentaruser($id)
    {
    //  $komentar = Komentar::where('user_id', $id)->where('tampil','1')->get();
        
        $komentar = Komentar::where('user_id', $id) ->get();

        //$komentar = Komentar::all();
        
        $response = fractal()
            ->collection($komentar)
            ->transformWith(new KomentarTransformer)
            ->toArray();

        return response()->json($response, 200);

    }
}
