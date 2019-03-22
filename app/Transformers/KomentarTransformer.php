<?php

namespace App\Transformers;

use App\Komentar;
use League\Fractal\TransformerAbstract;
use DB;

class KomentarTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */

    public function transform(Komentar $komentar)
    {

        $komentar = DB::table('tbl_komentar')
                        ->select('tbl_komentar.*','tbl_user.nama','tbl_kegiatan.nama_kegiatan')
                        ->leftjoin('tbl_user','tbl_komentar.user_id','tbl_user.id')
                        ->leftjoin('tbl_kegiatan', 'tbl_komentar.id_kegiatan','tbl_kegiatan.id')
                        ->where('tbl_komentar.id','=',$komentar->id)
                        ->first();

        return [

            'id'=>$komentar->id,
            'id_kegiatan'=>$komentar->id_kegiatan,
            'nama_kegiatan'=>$komentar->nama_kegiatan,
            'user_id'=>$komentar->user_id,
            'nama_user'=>$komentar->nama,
            'komen'=>$komentar->komen,
            'foto'=>$komentar->foto,
            'rate'=>$komentar->rate,
            'j_like'=>$komentar->j_like,
            'created_at'=>$komentar->created_at,
            'updated_at'=>$komentar->updated_at
            
            // 'id'=>$komentar->id,
            // 'id_kegiatan'=>$komentar->id_kegiatan,
            // 'user_id'=>$komentar->user_id,
            // 'komen'=>$komentar->komen,
            // 'foto'=>$komentar->foto,
            // 'rate'=>$komentar->rate,
            // 'j_like'=>$komentar->j_like,
             //  'tampil'=>$komentar->tampil,

        ];
    }
}