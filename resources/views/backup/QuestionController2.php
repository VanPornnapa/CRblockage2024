<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProblemDetail;
use App\Blockage;
use App\NaturalCause;
use App\HumanCause;
use DB;

class QuestionController2 extends Controller
{
    public function questionnaire2()
    {
        return view('form.questionnaire2');
    }

    public function addProblem(Request $request){
        //  dd($request);
        /////////--------ProblemDetail-------------/////////
        
        $BlockageCount = Blockage::count();
        
        $wordCount = ProblemDetail::count();
        //dd($wordCount);
        
        if($request->prob_cause_type=="ธรรมชาติ"){
            $cause=1;
            $causeCount = NaturalCause::count();
            $text="NC0000".($causeCount+1);
        }else{
            $cause=2;
            $causeCount = HumanCause::count();
            $text="HC0000".($causeCount+1);
        }

        
        $Promblemloc = new ProblemDetail(
            
            [

                'prob_id'=> 'P0000'.($wordCount+1),
                'blk_id'=> 'B0000'.($BlockageCount),
                'prob_level_percent'=>$request->prob_level_percent,
                'prob_level'=>'999',
                'prob_cause_type'=>$request->prob_cause_type,
                'prob_cause_id'=>$text,

            ]
        );
         $Promblemloc->save();
        
         $damage_type=$request->damage_type;
         $damage_level=json_encode($request->damage_level);
         
         $damage_frequency=$request->damage_frequency;
         if($damage_frequency=="บางปี"){
            $damage_frequency=$damage_frequency."(".$request->damage_frequency_detail.")";
         }
        $id='B0000'.($BlockageCount);
        // dd($request->damage_level);

        DB::update('update blockages set `damage_type`=?,`damage_level`=?,`damage_frequency`=? where `blk_id`=?',[$damage_type,$damage_level,$damage_frequency,$id]);
       
       

        return redirect()->route("form.Qnaire3");
    }

}
