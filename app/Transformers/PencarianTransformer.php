<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use DB;

class PencarianTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($cari)
    {

       $cari = DB::table('tbl_kegiatan')
                        ->select('tbl_kegiatan.*','tbl_kampung.nama_kampung')
                        ->leftjoin('tbl_kampung','tbl_kegiatan.id_kampung','tbl_kampung.id')
                        ->where('tbl_kegiatan.id','=',$cari->id)
                        ->first();

        return [
            'id'=>$cari->id,
            'nama_kegiatan'=>$cari->nama_kegiatan,
            'foto'=>$cari->foto,
            'alamat'=>$cari->alamat,
            'kontak_person'=>$cari->kontak_person,
            'email'=>$cari->email,
            'keterangan'=>$cari->keterangan,
            'mulai_kegiatan'=>$cari->mulai_kegiatan,
            'berakhir_kegiatan'=>$cari->berakhir_kegiatan,
            'penanggung_jawab'=>$cari->penanggung_jawab,
            'jumlah_anggaran'=>$cari->jumlah_anggaran,
            'thn_anggaran'=>$cari->thn_anggaran,
            'id_kampung'=>$cari->id_kampung,
            'tampil'=>$cari->tampil,
            'j_like'=>$cari->j_like,
            'j_unlike'=>$cari->j_unlike,
            'j_view'=>$cari->j_view,
            // 'j_share'=>$cari->j_share,
            // 'j_rate'=>$cari->j_rate,
            'longitude'=>$cari->latitude,

        ];
    }
}
