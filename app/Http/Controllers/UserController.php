<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlockageLocation;
use App\Blockage;
use App\BlockageCrossection;
use App\River;
use App\ProblemDetail;
use App\Solution;
use App\Project;
use App\Photo;
use App\ChangeLogs;
use App\Expert;
use DB;
use Auth;
use App\User;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use AuthenticatesUsers;
use SpatialTrait;

class UserController extends Controller
{
    protected $title ='Users';

    public function getUser(){
        $data = DB::table('users')->orderBy('id', 'DESC')->get();
        return view('admin/manage',compact('data'));           
    }

    public function getdetailUser($id=0){
        $data = DB::table('users')->where('id',$id)->get();
        if( $data[0]->status_work =="surveyor"){
            $status ="ผู้สำรวจ";
        }else if ($data[0]->status_work =="expert"){
            $status ="ผู้เชี่ยวชาญ";
        }else{
            $status ="ผู้ดูแลระบบ";
        }
        
        return view('admin/detail',compact('data','status'));           
    }



}
