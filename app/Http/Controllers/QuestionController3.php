<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solution;
use App\Project;
use DB;
use App\Blockage;

class QuestionController3 extends Controller
{
    public function questionnaire3()
    {
        return view('form.questionnaire3');
    }
    public function addSolution(Request $request){
        //  dd($request);
        /////////--------addSolution-------------/////////
        
        $SolutionCount = Solution::count();
        $ProjectCount = Project::count();
        $BlockageCount = Blockage::count();
        
        
        
        // dd($request);
       //$text=$request->sol_how1.",".$request->sol_how2.",".$request->sol_how3.",".$request->sol_how4.",".$request->sol_how5.",".$request->sol_how6.",".$request->sol_how7;
        $solutionLoc = new Solution(
            
            [
                'sol_id'=>'S0000'.($SolutionCount+1),
                'proj_id'=>'P0000'.($ProjectCount+1),
                'responsed_dept'=>$request->responsed_dept,
                // 'sol_how'=> $text,
                'sol_how'=> json_encode($request->sol_how),
                'result'=>$request->result_selector


            ]
        );
         $solutionLoc->save();
         $solid='S0000'.($SolutionCount+1);
         $id='B0000'.($BlockageCount);

         
    //    dd($request);
        if($request->proj_status=="plan"){
            $name=$request->proj_name1;
            $year=$request->proj_year1;
            $budget=$request->proj_budget1;
            $proj_type=$request->proj_type1;
        }else if ($request->proj_status=="Two"){
            $name=$request->proj_name2;
            $year=$request->proj_year2;
            $budget=$request->proj_budget2;
            $proj_type=$request->proj_type2;
        }else{
            $name="-";
            $year=0;
            $budget=0;
            $proj_type="-";
        }
        $ProjectCount2 = Project::count();
        
         $projectLoc = new Project(
            
            [
                
                'proj_id'=>'P0000'.($ProjectCount2+1),
                'proj_name'=>$name,
                'proj_type'=>$proj_type,
                'proj_status'=>$request->proj_status,
                'proj_budget'=>$budget,
                'proj_year'=> $year,


            ]
        );
         $projectLoc->save();


        DB::update('update blockages set `sol_id`=? where `blk_id`=?',[$solid,$id]);
       


        //return redirect()->route("form.Qnaire4");form.Qnaire.getBlockageData
        return redirect()->route("form.Qnaire.getBlockageData");
    }
}
