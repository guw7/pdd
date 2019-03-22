<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Kampung;

class KampungTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Kampung $kampung)
    {
        return [
        
            'id'=>$kampung->id,
           // 'id_kegiatan'=>$kampung->id_kegiatan,
            'nama_kampung'=>$kampung->nama_kampung,
            'nm_gecik'=>$kampung->nm_gecik,
            'created_at'=>$komentar->created_at,
            'updated_at'=>$komentar->updated_at 
        ];
    }
}
