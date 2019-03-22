<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use DB;

use App\Kegiatan;

class KegiatanTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Kegiatan $kegiatan)
    {
         /* $keiatans = DB::table('tbl_kegiatan')
                        ->leftjoin('tbl_kampung','tbl_kegiatan.id_kampung','tbl_kampung.id')
                        ->where('tbl_kegiatan.id','=',$kegiatan->id)
                        ->first();
          */              

          $keiatans = DB::table('tbl_kegiatan')
                        ->select('tbl_kegiatan.*','tbl_kampung.nama_kampung')
                        ->leftjoin('tbl_kampung','tbl_kegiatan.id_kampung','tbl_kampung.id')
                        ->where('tbl_kegiatan.id','=',$kegiatan->id)
                        ->first();

        return [
            'id'=>$keiatans->id,
            'nama_kegiatan'=>$keiatans->nama_kegiatan,
            'foto'=>$keiatans->foto,
            'alamat'=>$keiatans->alamat,
            'kontak_person'=>$keiatans->kontak_person,
            'email'=>$keiatans->email,
            'keterangan'=>$keiatans->keterangan,
            'mulai_kegiatan'=>$keiatans->mulai_kegiatan,
            'berakhir_kegiatan'=>$keiatans->berakhir_kegiatan,
            'penanggung_jawab'=>$keiatans->penanggung_jawab,
            'jumlah_anggaran'=>$keiatans->jumlah_anggaran,
            'thn_anggaran'=>$keiatans->thn_anggaran,
            'id_kampung'=>$keiatans->id_kampung,
            'tampil'=>$keiatans->tampil,
            'j_like'=>$keiatans->j_like,
            'j_unlike'=>$keiatans->j_unlike,
            'j_view'=>$keiatans->j_view,
            // 'j_share'=>$keiatans->j_share,
            // 'j_rate'=>$keiatans->j_rate,
            'longitude'=>$keiatans->latitude,
            'created_at'=>$komentar->created_at,
            'updated_at'=>$komentar->updated_at
        ];
    }
}



