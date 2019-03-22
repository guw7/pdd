<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id'=> $user->id,
            'nama' => $user->nama,
            'username' => $user->username,
            'email' => $user->email,
         //   'bio'=> $user->bio,
            'password' => $user->password,
            'created_at'=>$komentar->created_at,
            'updated_at'=>$komentar->updated_at
        ];
    }
}
