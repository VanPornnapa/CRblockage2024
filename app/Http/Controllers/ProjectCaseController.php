<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectCaseController extends Controller
{
    public function case($id=0){
        // dd($id);
        $cover="images/project/map/proj".$id.".jpg";
        $plan="images/project/plan/proj".$id.".PNG";
        $plan_link="pdf/project/plan/proj".$id.".pdf";
        return view('menubar.project_detail',compact('cover','plan','plan_link','id'));

    }
}
