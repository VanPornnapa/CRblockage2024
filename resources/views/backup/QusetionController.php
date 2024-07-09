<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlockageLocation;
use App\Blockage;
use Grimzy\LaravelMysqlSpatial\Types\Point;

class QuestionController extends Controller
{
    public function questionnaire()
    {
        return view('form.questionnaire');
    }

    public function store(Request $request){
         dd($request);

        $locationSt = new Point($request->latstart,$request->longstart);
        $locationFin = new Point($request->latend,$request->longend);

        $loc = new BlockageLocation(
            
            [
                'blk_location_id'=> 'L0005',
                'blk_start_location'=>$locationSt,
                'blk_end_location'=>$locationFin,
                'blk_village'=>$request->blk_village,
                'blk_tumbol'=>$request->blk_tumbol,
                'blk_district'=>$request->blk_district,
                'blk_province'=>$request->blk_province
            ]
        );
        
        // $block =new BlockageLocation;
        // $block->fill($request->all());
        // $block->save();
       // $loc_id = $loc->save();

        


         $loc->save();
        // return redirect()->route("form.create");
    }

    public function getData() {
        $data = BlockageLocation::all();
        return response()->json($data);
    }

    public function addBlockage(Request $request) {
        $len=$request->blk_length;
        if($len==1){
            $blk_len=9;
        }else if ($len==2){
            $blk_len=$request->distance2;
        }else{
            $blk_len=$request->distance3;
        }
        dd($request);
        $Blockage = new Blockage(
            [
                'blk_id' => "B004",
                'blk_location_id' => "L0004",
                'river_id' => 1,
                'blk_crossection_id' => 1,
                'sol_id' => 1,
                'blk_length' =>$blk_len,
                'damage_type' => 1,
                'damage_level' => 1,
                'damage_frequency' => 1
            ]
        );
        $Blockage->save();
    }

    public function getBlockageData() {
        $data = Blockage::with('blockageLocation')->get();
        return response()->json($data);
    }
}
