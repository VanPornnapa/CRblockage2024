<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blockage;
use App\Page;
use App\River;
use App\BlockageCrossection;
use App\ProblemDetail;
use App\Solution;
use App\Project;
use App\User;
use App\BlockageLocation;

class PagesController extends Controller
{
    // public function __construct()
    //   {
    //       $this->middleware('auth');
    //   }
  
    public function indexdistrict(){

        // Fetch departments
        $districtData['data'] = Page::getDistrict();
       // dd($districtData['data']);
        // Load index view
        return view('indexdistrict')->with("districtData",$districtData);
        
      }

      public function formblockage($uid){
        // dd($uid);
        // Fetch departments
        
        $user = \App\Blockage::where('blk_id', $uid)->value('blk_user_id');
        // dd(User::find($user));
        $userId = auth()->user()->id;
        // dd($userId);
        if($user != $userId) return view('auth.login');
        $districtData['data'] = Page::getDistrict();
        $river = River::where('river_id', str_replace("B", "R", $uid))->get();
        dd($river);
        //$json = file_get_contents('http://localhost/chiang-rai/public/getBlockageID/' . $uid);
       
        $json = file_get_contents('https://survey.crflood.com/getBlockageID/'.$uid);
        $obj = json_decode($json);
        $id = 0;
        // dd($obj[0]);
        $temp = BlockageCrossection::where('blk_id', $uid)->value('past');
        $blk_crossection_past = json_decode($temp);
        $temp = BlockageCrossection::where('blk_id', $uid)->value('current_start');
        $blk_crossection_current_start = json_decode($temp);
        $temp = BlockageCrossection::where('blk_id', $uid)->value('current_narrow');
        $blk_crossection_current_narrow = json_decode($temp);
        $temp = BlockageCrossection::where('blk_id', $uid)->value('current_end');
        $blk_crossection_current_end = json_decode($temp);
        $temp = BlockageCrossection::where('blk_id', $uid)->value('current_brigde');
        $blk_crossection_current_brigde = json_decode($temp);


        $blk_damage_level = json_decode($obj[0]->damage_level);
        $blk_project = \App\Project::where('proj_id', str_replace("B", "PJ", $uid))->get();
        $ProblemDetail = ProblemDetail::where('blk_id', $uid)->get();
        // dd($river);
        // dd($blk_crossection_current_brigde);
        // Load index view
        return view('form_blockage',[
          'river' => $river,
          'obj' => $obj,
          'id' => $id,
          'blk_crossection_past' => $blk_crossection_past,
          'blk_crossection_current_start' => $blk_crossection_current_start,
          'blk_crossection_current_narrow' => $blk_crossection_current_narrow,
          'blk_crossection_current_end' => $blk_crossection_current_end,
          'blk_crossection_current_brigde'=>$blk_crossection_current_brigde,
          'blk_problem_detail' => $ProblemDetail,
          'uid' => $uid,
          'blk_damage_level' => $blk_damage_level,
          'blk_project' => $blk_project[0],

        ])->with("districtData",$districtData);
        
      }

      public function newFormblockage(){

        $districtData['data'] = Page::getDistrict();
        return view('new_form_blockage', compact('districtData'));
      }
      
      // Fetch district
    public function getDistrict($vill_provinceid=0){

      // Fetch Employees by Departmentid
      $userData['data'] = Page::getprovinceDistrict($vill_provinceid);        
      echo json_encode($userData);
      exit;
  }

     // Fetch tumbol
    public function getTumbol($vill_districtid=0){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: *');
        header('Access-Control-Allow-Headers: *');
        // Fetch Employees by Departmentid
        $userData['data'] = Page::getdistrictTumbol($vill_districtid);        
        echo json_encode($userData);
        exit;
    }

     // Fetch rvillage
     public function getVillage($vill_tumbolid=0){

        // Fetch Employees by Departmentid
        $userVill['data'] = Page::gettumbolVillage($vill_tumbolid); 

        echo json_encode($userVill);
        exit;
    }

    //test edit page
    public function editblockage($uid){
      // dd($uid);
      // Fetch departments
      $data =  Blockage::with('blockageLocation','blockageCrossection','River','Solution','Photo')->where('blk_id', $uid)->get();
  
      $user = \App\Blockage::where('blk_id', $uid)->value('blk_user_id');
      $userId = auth()->user()->id;
      $admin= auth()->user()->name;
      $status= auth()->user()->status_work;
      //dd($admin);
  
      // dd($userId);
      if(($user != $userId) && ($admin!="admin") && ($status!= "expert")) return view('auth.login');

      $districtData['data'] = Page::getDistrict();
      $river = River::where('river_id',$data[0]->river_id )->get();
      // $json = file_get_contents('http://localhost/chiang-rai/public/getBlockageID/' . $uid);
      $json = file_get_contents('https://survey.crflood.com/getBlockageID/'.$uid);
      $obj = json_decode($json);
      $id = 0;
      //  dd($obj[0]);
      $temp = BlockageCrossection::where('blk_id', $uid)->value('past');
      $blk_crossection_past = json_decode($temp);
      $temp = BlockageCrossection::where('blk_id', $uid)->value('current_start');
      $blk_crossection_current_start = json_decode($temp);
      $temp = BlockageCrossection::where('blk_id', $uid)->value('current_narrow');
      $blk_crossection_current_narrow = json_decode($temp);
      $temp = BlockageCrossection::where('blk_id', $uid)->value('current_end');
      $blk_crossection_current_end = json_decode($temp);
      $temp = BlockageCrossection::where('blk_id', $uid)->value('current_brigde');
      $blk_crossection_current_brigde = json_decode($temp);
     
     $len_morekm=NULL;
      // dd($obj[0]);
      if($obj[0]->blk_length_type=="มากกว่า 1 กิโลเมตร"||$obj[0]->blk_length_type=="น้อยกว่า 10 เมตร"){
        $len_prob="-- ระบุระยะ --";
        $len_prob_value="0";
        if($obj[0]->blk_length_type=="น้อยกว่า 10 เมตร"){
          $len_morekm="-- ระบุระยะมากกว่า 1 กม.--";
        }
      }else{
        $len_prob=$obj[0]->blk_length_type;
        $len_prob_value=$obj[0]->blk_length_type;
        $len_morekm="-- ระบุระยะมากกว่า 1 กม.--";
      }
      $blk_damage_level = json_decode($obj[0]->damage_level);
      $blk_project = \App\Project::where('proj_id', str_replace("B", "PJ", $uid))->get();
      $ProblemDetail = ProblemDetail::where('blk_id', $uid)->get();
      $solution_id=Solution::where('sol_id',$obj[0]->sol_id)->get();
      $project_id=Project::where('proj_id',$solution_id[0]->proj_id)->get();

      // Load index view
     // dd($blk_crossection_current_narrow);
      return view('edit_form_blockage',[
        'river' => $river,
        'obj' => $obj,
        'id' => $id,
        'blk_crossection_past' => $blk_crossection_past,
        'blk_crossection_current_start' => $blk_crossection_current_start,
        'blk_crossection_current_narrow' => $blk_crossection_current_narrow,
        'blk_crossection_current_end' => $blk_crossection_current_end,
        'blk_crossection_current_brigde'=>$blk_crossection_current_brigde,
        'blk_problem_detail' => $ProblemDetail,
        'uid' => $uid,
        'blk_damage_level' => $blk_damage_level,
        'blk_project' => $blk_project[0],   
        'solution'=>$solution_id ,
        'project'=>$project_id ,
        'len_prob'=>$len_prob,
        'len_prob_value'=>$len_prob_value,
        'len_morekm'=>$len_morekm

      ])->with("districtData",$districtData);
     
    }
}
