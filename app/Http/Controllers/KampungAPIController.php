<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kampung;
use App\Transformers\KampungTransformer;


class KampungAPIController extends Controller
{
    
//============================GET_KAMPUNG===============================// 

    public function get_allkampung(Kampung $kampung)
    {
        $kampung = Kampung::all();

        $response = fractal()
            ->collection($kampung)
            ->transformwith(new KampungTransformer)
            ->toArray();

        return response()->json($response, 200);    
    }


    public function get_allkampungid($id)
    {
        $kampung = Kampung::find($id);

        $respon = fractal()
            ->item($kampung)
            ->transformerwith(new KampungTransformer)
            ->toArray();

            return respon()->json($response, 200);
    }


}
