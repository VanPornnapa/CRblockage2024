<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RaindataController extends Controller
{
    public function getIDF($amp=0){
        
        $amp_name="images/rain/IDF_CR_".$amp.".jpg";
        // dd($amp);
        return view('rain/showrain',compact('amp_name','amp'));

    }
}
