<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use App\Form;

class FormController extends Controller
{
    public function create(){
          
        $data['form'] = Form::all();
        return view("form.create", $data);
    }
    public function store(Request $request){
        $locationSt = new Point($request->latst,$request->longst);
        $locationFin = new Point($request->latfin,$request->longfin);

        $loc = new Form(
            [
                'startLocation'=> $locationSt,
                'finishLocation' => $locationFin
            ]
        );
        $loc->save();
        return redirect()->route("form.create");
    }
}


