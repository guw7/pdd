<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class ErrorTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($message)
    {
        return [
            'success' => false,
            'error' => array($message),
        ];
    }
}
