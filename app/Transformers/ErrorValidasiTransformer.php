<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;


class ErrorValidasiTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($eror)
    {
        return [
            'success' => false,
            'error_validasi' => array($eror),
        ];
    }
}
