<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlockageLocation;
use App\Blockage;
use App\BlockageCrossection;
use App\Culvert;
use App\River;

use Grimzy\LaravelMysqlSpatial\Types\Point;

class QuestionController extends Controller
{
    public function questionnaire()
    {
        return view('form.questionnaire');
    }

    public function store(Request $request){
        //  dd($request);

        $wordCount = BlockageLocation::count();
        //location point
        $locationSt = new Point($request->latstart,$request->longstart);
        $locationFin = new Point($request->latend,$request->longend);

        /////////--------blockage_location-------------/////////
        $loc = new BlockageLocation(
            
            [
                'blk_location_id'=> 'L0000'.($wordCount+1),
                'blk_start_location'=>$locationSt,
                'blk_end_location'=>$locationFin,
                'blk_village'=>$request->blk_village,
                'blk_tumbol'=>$request->blk_tumbol,
                'blk_district'=>$request->blk_district,
                'blk_province'=>$request->blk_province
            ]
        );
         $loc->save();
        // return redirect()->route("form.create");

        /////////--------blockage_crossection-------------/////////
        $XsectioneCount = BlockageCrossection::count();
        $BlockageCount = Blockage::count();
        $BlockageCrossection = new BlockageCrossection(
            [
                'blk_xsection_id'=>'X0000'.($XsectioneCount+1),
                'blk_id'=>'B0000'.($BlockageCount+1),
                'culvert_id'=>'C0000'.($XsectioneCount+1),
                'past'=>json_encode($request->past),
                'current_start'=>json_encode($request->current_start),
                'current_narrow'=>json_encode($request->current_narrow),
                'current_end'=>json_encode($request->current_end),
            ]
        );
        $BlockageCrossection->save();

         /////////--------Culvert-------------/////////
         $CulvertCount = Culvert::count();
         $Culvert = new Culvert(
             [
                'culvert_id'=>"C0000".($CulvertCount+1),
                'culvert_type'=>$request->culvert_type,
                'diameter'=>$request->diameter,
                'culvert_width'=>$request->culvert_width,
                'culvert_hight'=>$request->culvert_high,
             ]
         );
         $Culvert->save();

         /////////--------River-------------/////////
         $RiverCount = River::count();
         $River = new River(
             [
                'river_id'=>"R0000".($RiverCount+1),
                'river_name'=>$request->river_name,
                'river_type'=>$request->river_type,
                'river_main'=>$request->river_main
             ]
         );
         $River->save();

         
        /////////--------blockage Main-------------/////////
        $BlockageCount = Blockage::count();
        $LocationCount = BlockageLocation::count();

        $len=$request->blk_length;
        if($len==1){
            $blk_len=9;
        }else if ($len==2){
            $blk_len=$request->distance2;
        }else{
            $blk_len=$request->distance3;
        }

        $Blockage = new Blockage(
            [
                'blk_id' => "B0000".($BlockageCount+1),
                'blk_location_id' => "L0000".($LocationCount),
                'river_id' => "R0000".($RiverCount+1),
                'blk_crossection_id' => "X0000".($wordCount+1),
                'sol_id' => 1,
                'blk_length' =>$blk_len,
                'damage_type' => 1,
                'damage_level' => 1,
                'damage_frequency' => 1
            ]
        );
        $Blockage->save();


        return redirect()->route("form.Qnaire2");
    }

    public function getData() {
        $data = BlockageLocation::all();
        return response()->json($data);
    }

    public function getBlockageData() {
        $data = Blockage::with('blockageLocation')->get();
        return response()->json($data);
    }
}
