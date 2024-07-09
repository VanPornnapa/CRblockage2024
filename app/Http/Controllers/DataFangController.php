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

class DataFangController extends Controller
{
    public function getBlockage(){
        $data = Blockage::with('blockageLocation','river')
                ->where('blk_code','LIKE','%CM%')->get();
        // return view('report_admin',compact('data'));
        $result = json_encode($data);
         echo $result;
            
    }
    public function getBlockageAmp($amp=0,$tambol=0){
        // dd($amp);
        $data = Blockage::with('blockageLocation','river')
        ->where('blk_code','LIKE','%CM%')->get();
        if($tambol=='sum' && $amp=="sum"){
            $result = json_encode($data);
            // dd($data);
            echo $result;
        }else if($tambol=='sum' ){
            $c=0;
            $list;
            for($i=0;$i<count($data);$i++){
                
                if($data[$i]->blockageLocation->blk_district==$amp){
                    $list[$c]=$data[$i];
                    $c=$c+1;
                }
            }
            // dd($list);
            $result = json_encode($list);
            echo $result;
        }else{
            $c=0;
            $list;
            for($i=0;$i<count($data);$i++){
                
                if($data[$i]->blockageLocation->blk_district==$amp && $data[$i]->blockageLocation->blk_tumbol==$tambol ){
                    $list[$c]=$data[$i];
                    $c=$c+1;
                }
            }
            // dd($list);
            $result = json_encode($list);
            echo $result;
        }
        
        
            
    }

    // report by each blockage
    public function reportBlockage($blk_id=0){
        //dd ("555");
        //dd($blk_id);
        $data =  Blockage::with('blockageLocation','blockageCrossection','River','Solution','Photo')->where('blk_id', $blk_id)->get();
        //$location= BlockageLocation::where('blk_location_id', $data[0]->blockageLocation->blk_location_id)->get();
        $problem =  ProblemDetail::where('blk_id', $data[0]->blk_id)->get();
        $photo_Blockage=Photo::where('blk_id', $data[0]->blk_id )->Where('photo_type','Blockage')->get();
        $photo_Land=Photo::where('blk_id', $data[0]->blk_id )->Where('photo_type','Land')->get();
        $photo_Riverbefore=Photo::where('blk_id', $data[0]->blk_id )->Where('photo_type','River before')->get();
        $photo_Riverprob=Photo::where('blk_id', $data[0]->blk_id )->Where('photo_type','River prob')->get();
        $photo_Riverafter=Photo::where('blk_id', $data[0]->blk_id )->Where('photo_type','River after')->get();
        $photo_Probsketch=Photo::where('blk_id', $data[0]->blk_id )->Where('photo_type','Prob sketch')->get();
        $solution_id=Solution::where('sol_id',$data[0]->sol_id)->get();
        $project_id=Project::where('proj_id',$solution_id[0]->proj_id)->get();
        $location=BlockageLocation::select(\DB::raw('ST_Y(blockage_locations.blk_start_utm) as lat_utm_start'),
                        \DB::raw('ST_X(blockage_locations.blk_start_utm) as lng_utm_start'))
                        ->where('blk_location_id',$data[0]->blk_location_id)->get();

        $damage=$data[0]->damage_level;
        $damage_type=$data[0]->damage_type;
        $past = $data[0]->blockageCrossection->past;
        $current_start = $data[0]->blockageCrossection->current_start;
        $current_narrow = $data[0]->blockageCrossection->current_narrow;
        $current_end = $data[0]->blockageCrossection->current_end;
        
        $damageData=json_decode($damage);
        $damage_type=json_decode($damage_type);
        $pastData = json_decode($past);
        $current_start = json_decode($current_start);
        $current_narrow = json_decode($current_narrow);
        
      
        $current_narrow_new = [
            'waterway_type' => null,
            'round_type' => null,
            'square_type' => null,
            'other_type' =>null,
            'waterway'=> [
                'width'=>null,
                'depth'=> null,
                'slop'=>null],
            'round'=>[
                'diameter'=>null,
                'num'=>null ],
            'square'=>[
               'width'=>null,
                'high'=>null,
                'num'=>null],
            'other'=>[
                'detail'=>null,
            ]


        ];
        $current_narrow_new=json_encode($current_narrow_new);
        $current_narrow_new=json_decode($current_narrow_new);
  
        if(isset($current_narrow->culvert->diameter)){
            $diameter=$current_narrow->culvert->diameter;
            if(isset($current_narrow->culvert->c->num)){
                $numr=$current_narrow->culvert->c->num;
            }else if (isset($current_narrow->culvert->num)){
                $numr=$current_narrow->culvert->num;
            }else{
                $numr=null;
            }
        }else{
            $diameter=null;
            $numr=null;
        }

        if(isset($current_narrow->culvert->width)){
            $width=$current_narrow->culvert->width;
            $high=$current_narrow->culvert->high;
            if(isset($current_narrow->culvert->sq->num)){
                $numsq=$current_narrow->culvert->sq->num;
            }else{
                $numsq=null;
            }
        }else{
            $width=null;
            $high=null;
            $numsq=null;
        }


        //dd($current_narrow_new);
       
        if(($current_narrow->type=="waterway" )|| isset($current_narrow->width) ){
            $current_narrow_new->waterway_type="1";
            $current_narrow_new->waterway->width=$current_narrow->width;
            $current_narrow_new->waterway->depth=$current_narrow->depth;
            $current_narrow_new->waterway->slop=$current_narrow->slop;
         }
         // culvert round
        if(isset($current_narrow->culvert->diameter)){
            $current_narrow_new->round_type="1";
            $current_narrow_new->round->diameter=$diameter;
            $current_narrow_new->round->num=$numr;

        }
         // culvert square

        if(isset($current_narrow->culvert->width)){
            $current_narrow_new->square_type="1";
            $current_narrow_new->square->width=$width;
            $current_narrow_new->square->high=$high;
            $current_narrow_new->square->num=$numsq;

        }
        // other
        if($current_narrow->type=="other" || isset($current_narrow->other) ){
            $current_narrow_new->other_type="1";
            $current_narrow_new->other->detail=$current_narrow->other;
        }  

        $current_end = json_decode($current_end);
        // return view('report', compact('data','damageData','damage_type','pastData','current_start','current_narrow_new','current_end','problem','photo_Blockage','photo_Land','photo_Riverbefore','photo_Riverprob','photo_Riverafter','photo_Probsketch','solution_id','project_id'));
        
        $AllData = [
            'data' => $data,
            'damageData' => $damageData,
            'damage_type' => $damage_type,
            'pastData' =>$pastData,
            'current_start' =>$current_start,
            'current_narrow_new' =>$current_narrow_new,
            'current_end' =>$current_end,
            'problem' =>$problem,
            'photo_Blockage' =>$photo_Blockage,
            'photo_Land' =>$photo_Land,
            'photo_Riverbefore' =>$photo_Riverbefore,
            'photo_Riverprob' =>$photo_Riverprob,
            'photo_Riverafter' =>$photo_Riverafter,
            'photo_Probsketch' =>$photo_Probsketch,
            'solution_id' =>$solution_id,
            'project_id' =>$project_id,
            'X_start'=>$location[0]->lat_utm_start,
            'Y_start'=>$location[0]->blk_location_id
        ];

        $result = json_encode($AllData);
        echo $result;
    }


    public function apiCM($amp=0)
    {
        header('Access-Control-Allow-Origin: *');
        if($amp=="all"){
            $countNum =  DB::table('blockage_locations')
                        ->join('blockages', 'blockages.blk_location_id', '=', 'blockage_locations.blk_location_id')
                        ->join('problem_details', 'problem_details.blk_id', '=', 'blockages.blk_id')
                        ->select(\DB::raw("COUNT(problem_details.nat_erosion) as nat_erosion,
                            COUNT(problem_details.nat_shoal) as nat_shoal,
                            COUNT(problem_details.nat_missing) as nat_missing,
                            COUNT(problem_details.nat_winding) as nat_winding,
                            COUNT(problem_details.nat_weed) as nat_weed,
                            COUNT(problem_details.nat_weed_detail) as nat_weed_detail,
                            COUNT(problem_details.nat_other) as nat_other,
                            COUNT(problem_details.hum_stc_bld_num) as hum_stc_bld_num,
                            COUNT(problem_details.hum_stc_fence_num) as hum_stc_fence_num,
                            COUNT(problem_details.hum_str_other) as hum_str_other,
                            COUNT(problem_details.hum_stc_bld_bu_num) as hum_stc_bld_bu_num,
                            COUNT(problem_details.hum_stc_fence_bu_num) as hum_stc_fence_bu_num,
                            COUNT(problem_details.hum_str_other_bu) as hum_str_other_bu,
                            COUNT(problem_details.hum_road) as hum_road,
                            COUNT(problem_details.hum_smallconvert) as hum_smallconvert,
                            COUNT(problem_details.hum_road_paralel) as hum_road_paralel,
                            COUNT(problem_details.hum_replaced_convert) as hum_replaced_convert,
                            COUNT(problem_details.hum_bridge_pile) as hum_bridge_pile,
                            COUNT(problem_details.hum_soil_cover) as hum_soil_cover,
                            COUNT(problem_details.hum_trash) as hum_trash,
                            COUNT(problem_details.hum_other) as hum_other"))
                        ->where('blockage_locations.blk_province', '=', "เชียงใหม่")
                        ->get();
        //dd($countNum);
        $nat = $countNum[0]->nat_erosion+$countNum[0]->nat_shoal+$countNum[0]->nat_missing+$countNum[0]->nat_winding+$countNum[0]->nat_weed+$countNum[0]->nat_other;
        
        $hum = $countNum[0]->hum_stc_bld_num+
                $countNum[0]->hum_stc_fence_num+
                $countNum[0]->hum_str_other+
                $countNum[0]->hum_stc_bld_bu_num+
                $countNum[0]->hum_stc_fence_bu_num+
                $countNum[0]->hum_str_other_bu+
                $countNum[0]->hum_road+
                $countNum[0]->hum_smallconvert+
                $countNum[0]->hum_road_paralel+
                $countNum[0]->hum_replaced_convert+
                $countNum[0]->hum_bridge_pile+
                $countNum[0]->hum_soil_cover+
                $countNum[0]->hum_trash+
                $countNum[0]->hum_other;
        $countNum=[["สาเหตุจากมุนษย์",$hum],["สาเหตุจากธรรมชาติ",$nat]];
        //dd($countNum);
        ////////////////////////////////////////////////////////////////////
        $countBar =DB::table('blockage_locations')
                    ->join('blockages', 'blockages.blk_location_id', '=', 'blockage_locations.blk_location_id')
                    ->join('problem_details', 'problem_details.blk_id', '=', 'blockages.blk_id')
                    ->select(\DB::raw("COUNT(problem_details.nat_erosion) as nat_erosion,
                        COUNT(problem_details.nat_shoal) as nat_shoal,
                        COUNT(problem_details.nat_missing) as nat_missing,
                        COUNT(problem_details.nat_winding) as nat_winding,
                        COUNT(problem_details.nat_weed) as nat_weed,
                        COUNT(problem_details.nat_weed_detail) as nat_weed_detail,
                        COUNT(problem_details.nat_other) as nat_other,
                        COUNT(problem_details.hum_stc_bld_num) as hum_stc_bld_num,
                        COUNT(problem_details.hum_stc_fence_num) as hum_stc_fence_num,
                        COUNT(problem_details.hum_str_other) as hum_str_other,
                        COUNT(problem_details.hum_stc_bld_bu_num) as hum_stc_bld_bu_num,
                        COUNT(problem_details.hum_stc_fence_bu_num) as hum_stc_fence_bu_num,
                        COUNT(problem_details.hum_str_other_bu) as hum_str_other_bu,
                        COUNT(problem_details.hum_road) as hum_road,
                        COUNT(problem_details.hum_smallconvert) as hum_smallconvert,
                        COUNT(problem_details.hum_road_paralel) as hum_road_paralel,
                        COUNT(problem_details.hum_replaced_convert) as hum_replaced_convert,
                        COUNT(problem_details.hum_bridge_pile) as hum_bridge_pile,
                        COUNT(problem_details.hum_soil_cover) as hum_soil_cover,
                        COUNT(problem_details.hum_trash) as hum_trash,
                        COUNT(problem_details.hum_other) as hum_other"))
                        ->where('blockage_locations.blk_province', '=', "เชียงใหม่")
                        ->get();
    
        $countBar=[["ตลิ่งพังการกัดเซาะ",$countBar[0]->nat_erosion],
                   ["การทับถมของตะกอน (ลำน้ำตื้นเขิน)",$countBar[0]->nat_shoal],
                   ["ลำน้ำขาดหาย",$countBar[0]->nat_missing],
                   ["ลำน้ำคดเคี้ยวมาก",$countBar[0]->nat_winding],
                   ["วัชพืช",$countBar[0]->nat_weed],
                   ["อื่นๆ(ธรรมชาติ)",$countBar[0]->nat_other],
                   ["ส่วนอาคาร(ราชการ)",$countBar[0]->hum_stc_bld_num],
                    ["รั้ว(ราชการ)",$countBar[0]->hum_stc_fence_num],
                    ["อื่นๆ(ราชการ)",$countBar[0]->hum_str_other],
                    ["ส่วนอาคาร(เอกชน)",$countBar[0]->hum_stc_bld_bu_num],
                    ["รั้ว(เอกชน)",$countBar[0]->hum_stc_fence_bu_num],
                    ["อื่นๆ(เอกชน)",$countBar[0]->hum_str_other_bu],
                    ["ถนนขวางทางน้ำ",$countBar[0]->hum_road],
                    ["ท่อลอดถนนที่ตัดลำน้ำฯ",$countBar[0]->hum_smallconvert],
                    ["ถนนขนานลำน้ำสร้างกินพื้นที่ลำน้ำ",$countBar[0]->hum_road_paralel],
                    ["วางท่อตามแนวลำน้ำทดแทนลำน้ำเดิม",$countBar[0]->hum_replaced_convert],
                    ["สะพานมีหน้าตัดแคบเกินไป",$countBar[0]->hum_bridge_pile],
                    ["การถมดิน",$countBar[0]->hum_soil_cover],
                    ["สิ่งปฏิกูล",$countBar[0]->hum_trash],
                    ["อื่นๆ(มนุษย์)",$countBar[0]->hum_other]
                  ];
       
                $data = [
                    'countNum'=>$countNum,
                    'amp'=> $amp,
                    'countBar'=>$countBar
                ];
                $result = json_encode($data);
                echo $result;
    
        }else{
            $countNum = DB::table('blockage_locations')
                ->join('blockages', 'blockages.blk_location_id', '=', 'blockage_locations.blk_location_id')
                ->join('problem_details', 'problem_details.blk_id', '=', 'blockages.blk_id')
                ->select(\DB::raw("COUNT(problem_details.nat_erosion) as nat_erosion,
                    COUNT(problem_details.nat_shoal) as nat_shoal,
                    COUNT(problem_details.nat_missing) as nat_missing,
                    COUNT(problem_details.nat_winding) as nat_winding,
                    COUNT(problem_details.nat_weed) as nat_weed,
                    COUNT(problem_details.nat_weed_detail) as nat_weed_detail,
                    COUNT(problem_details.nat_other) as nat_other,
                    COUNT(problem_details.hum_stc_bld_num) as hum_stc_bld_num,
                    COUNT(problem_details.hum_stc_fence_num) as hum_stc_fence_num,
                    COUNT(problem_details.hum_str_other) as hum_str_other,
                    COUNT(problem_details.hum_stc_bld_bu_num) as hum_stc_bld_bu_num,
                    COUNT(problem_details.hum_stc_fence_bu_num) as hum_stc_fence_bu_num,
                    COUNT(problem_details.hum_str_other_bu) as hum_str_other_bu,
                    COUNT(problem_details.hum_road) as hum_road,
                    COUNT(problem_details.hum_smallconvert) as hum_smallconvert,
                    COUNT(problem_details.hum_road_paralel) as hum_road_paralel,
                    COUNT(problem_details.hum_replaced_convert) as hum_replaced_convert,
                    COUNT(problem_details.hum_bridge_pile) as hum_bridge_pile,
                    COUNT(problem_details.hum_soil_cover) as hum_soil_cover,
                    COUNT(problem_details.hum_trash) as hum_trash,
                    COUNT(problem_details.hum_other) as hum_other"))
                ->where('blockage_locations.blk_district', '=', $amp)
                ->get();
        $nat = $countNum[0]->nat_erosion+$countNum[0]->nat_shoal+$countNum[0]->nat_missing+$countNum[0]->nat_winding+$countNum[0]->nat_weed+$countNum[0]->nat_other;
        
        $hum = $countNum[0]->hum_stc_bld_num+
                $countNum[0]->hum_stc_fence_num+
                $countNum[0]->hum_str_other+
                $countNum[0]->hum_stc_bld_bu_num+
                $countNum[0]->hum_stc_fence_bu_num+
                $countNum[0]->hum_str_other_bu+
                $countNum[0]->hum_road+
                $countNum[0]->hum_smallconvert+
                $countNum[0]->hum_road_paralel+
                $countNum[0]->hum_replaced_convert+
                $countNum[0]->hum_bridge_pile+
                $countNum[0]->hum_soil_cover+
                $countNum[0]->hum_trash+
                $countNum[0]->hum_other;
        // $countNum=[["สาเหตุจากธรรมชาติ",$nat],["สาเหตุจากมุนษย์",$hum]];
        $countNum=[["สาเหตุจากมุนษย์",$hum],["สาเหตุจากธรรมชาติ",$nat]];
        //////////////////////////////////////////////////////////////
        $countBar = DB::table('blockage_locations')
        ->join('blockages', 'blockages.blk_location_id', '=', 'blockage_locations.blk_location_id')
        ->join('problem_details', 'problem_details.blk_id', '=', 'blockages.blk_id')
        ->select(\DB::raw("COUNT(problem_details.nat_erosion) as nat_erosion,
            COUNT(problem_details.nat_shoal) as nat_shoal,
            COUNT(problem_details.nat_missing) as nat_missing,
            COUNT(problem_details.nat_winding) as nat_winding,
            COUNT(problem_details.nat_weed) as nat_weed,
            COUNT(problem_details.nat_weed_detail) as nat_weed_detail,
            COUNT(problem_details.nat_other) as nat_other,
            COUNT(problem_details.hum_stc_bld_num) as hum_stc_bld_num,
            COUNT(problem_details.hum_stc_fence_num) as hum_stc_fence_num,
            COUNT(problem_details.hum_str_other) as hum_str_other,
            COUNT(problem_details.hum_stc_bld_bu_num) as hum_stc_bld_bu_num,
            COUNT(problem_details.hum_stc_fence_bu_num) as hum_stc_fence_bu_num,
            COUNT(problem_details.hum_str_other_bu) as hum_str_other_bu,
            COUNT(problem_details.hum_road) as hum_road,
            COUNT(problem_details.hum_smallconvert) as hum_smallconvert,
            COUNT(problem_details.hum_road_paralel) as hum_road_paralel,
            COUNT(problem_details.hum_replaced_convert) as hum_replaced_convert,
            COUNT(problem_details.hum_bridge_pile) as hum_bridge_pile,
            COUNT(problem_details.hum_soil_cover) as hum_soil_cover,
            COUNT(problem_details.hum_trash) as hum_trash,
            COUNT(problem_details.hum_other) as hum_other"))
        ->where('blockage_locations.blk_district', '=', $amp)
        ->get();
    //dd($countNum);
    
    $countBar=[["ตลิ่งพังการกัดเซาะ",$countBar[0]->nat_erosion],
           ["การทับถมของตะกอน (ลำน้ำตื้นเขิน)",$countBar[0]->nat_shoal],
           ["ลำน้ำขาดหาย",$countBar[0]->nat_missing],
           ["ลำน้ำคดเคี้ยวมาก",$countBar[0]->nat_winding],
           ["วัชพืช",$countBar[0]->nat_weed],
           ["อื่นๆ(ธรรมชาติ)",$countBar[0]->nat_other],
           ["ส่วนอาคาร(ราชการ)",$countBar[0]->hum_stc_bld_num],
            ["รั้ว(ราชการ)",$countBar[0]->hum_stc_fence_num],
            ["อื่นๆ(ราชการ)",$countBar[0]->hum_str_other],
            ["ส่วนอาคาร(เอกชน)",$countBar[0]->hum_stc_bld_bu_num],
            ["รั้ว(เอกชน)",$countBar[0]->hum_stc_fence_bu_num],
            ["อื่นๆ(เอกชน)",$countBar[0]->hum_str_other_bu],
            ["ถนนขวางทางน้ำ",$countBar[0]->hum_road],
            ["ท่อลอดถนนที่ตัดลำน้ำฯ",$countBar[0]->hum_smallconvert],
            ["ถนนขนานลำน้ำสร้างกินพื้นที่ลำน้ำ",$countBar[0]->hum_road_paralel],
            ["วางท่อตามแนวลำน้ำทดแทนลำน้ำเดิม",$countBar[0]->hum_replaced_convert],
            ["สะพานมีหน้าตัดแคบเกินไป",$countBar[0]->hum_bridge_pile],
            ["การถมดิน",$countBar[0]->hum_soil_cover],
            ["สิ่งปฏิกูล",$countBar[0]->hum_trash],
            ["อื่นๆ(มนุษย์)",$countBar[0]->hum_other]
          ];
            // echo( json_encode($countNum));
            
            $amp = "อำเภอ".$amp."  จังหวัดเชียงใหม่";
                $data = [
                    'countNum'=>$countNum,
                    'amp'=> $amp,
                    'countBar'=>$countBar
                ];
                $result = json_encode($data);
                echo $result;
    
            }
            
    }
    
    public function expertPDF($blk_id=0)
    {
        $data =  Blockage::with('blockageLocation','blockageCrossection','River','Solution','Photo')->where('blk_id', $blk_id)->get();
      
        $problem =  ProblemDetail::where('blk_id', $data[0]->blk_id)->get();
        $photo_Blockage=Photo::where('blk_id', $data[0]->blk_id )->Where('photo_type','Blockage')->get();
        $photo_Land=Photo::where('blk_id', $data[0]->blk_id )->Where('photo_type','Land')->get();
        $photo_Riverbefore=Photo::where('blk_id', $data[0]->blk_id )->Where('photo_type','River before')->get();
        $photo_Riverprob=Photo::where('blk_id', $data[0]->blk_id )->Where('photo_type','River prob')->get();
        $photo_Riverafter=Photo::where('blk_id', $data[0]->blk_id )->Where('photo_type','River after')->get();
        $photo_Probsketch=Photo::where('blk_id', $data[0]->blk_id )->Where('photo_type','Prob sketch')->get();
        $solution_id=Solution::where('sol_id',$data[0]->sol_id)->get();
        $project_id=Project::where('proj_id',$solution_id[0]->proj_id)->get();

        $expert=Expert::where('blk_id', $data[0]->blk_id)->get();
        
        $damage=$data[0]->damage_level;
        $damage_type=$data[0]->damage_type;
        $past = $data[0]->blockageCrossection->past;
        $current_start = $data[0]->blockageCrossection->current_start;
        $current_narrow = $data[0]->blockageCrossection->current_narrow;
        $current_end = $data[0]->blockageCrossection->current_end;
        $current_brigde = $data[0]->blockageCrossection->current_brigde;
        
        $damageData=json_decode($damage);
        $damage_type=json_decode($damage_type);
        $pastData = json_decode($past);
        $current_start = json_decode($current_start);
        $current_narrow = json_decode($current_narrow);
        $current_brigde = json_decode($current_brigde);

        $current_brigde_new=[
            'width'=>0,
            'depth'=> 0,
            'len'=>0,
            'num'=>0
        ];
        
        if($current_brigde==null){
            $current_brigde=json_encode($current_brigde_new);
            $current_brigde=json_decode($current_brigde);
        }
        
        //   dd($current_narrow->culvert);
        $current_narrow_new = [
            'waterway_type' => null,
            'round_type' => null,
            'square_type' => null,
            'other_type' =>null,
            'waterway'=> [
                'width'=>null,
                'depth'=> null,
                'slop'=>null],
            'round'=>[
                'diameter'=>null,
                'num'=>null,
                'len'=>null ],
            'square'=>[
               'width'=>null,
                'high'=>null,
                'num'=>null,
                'len'=>null],
            'other'=>[
                'detail'=>null,
            ]
        ];
        $current_narrow_new=json_encode($current_narrow_new);
        $current_narrow_new=json_decode($current_narrow_new);
  
        if(isset($current_narrow->culvert->diameter)){
            $diameter=$current_narrow->culvert->diameter;
           
            if(isset($current_narrow->culvert->c->num)){
                $numr=$current_narrow->culvert->c->num;
                
            }else if (isset($current_narrow->culvert->num)){
                $numr=$current_narrow->culvert->num;
                
            }else{
                $numr=null;
            }

            if(!empty($current_narrow->culvert->c->len)||!empty($current_narrow->culvert->len)){
                if(isset($current_narrow->culvert->c->len)){
                    $lenr=$current_narrow->culvert->c->len;
                }else if($current_narrow->culvert->len){
                    $lenr=$current_narrow->culvert->len;
                }
            }else{
                $lenr=null;
            }
        }else{
            $diameter=null;
            $numr=null;
            $lenr=null;
        }

        if(isset($current_narrow->culvert->width)){
            $width=$current_narrow->culvert->width;
            $high=$current_narrow->culvert->high;
            
            if(isset($current_narrow->culvert->sq->num)){
                $numsq=$current_narrow->culvert->sq->num;
            }else if(isset($current_narrow->culvert->num)){
                $numsq=$current_narrow->culvert->num;
            }else{
                $numsq=null;
            }

            if(!empty($current_narrow->culvert->sq->len)||!empty($current_narrow->culvert->len)){
                if(isset($current_narrow->culvert->sq->len)){
                    $lensq=$current_narrow->culvert->sq->len;
                }else if($current_narrow->culvert->len){
                    $lensq=$current_narrow->culvert->len;
                }
            }else{
                $lensq=null;
            }


        }else{
            $width=null;
            $high=null;
            $numsq=null;
            $lensq=null;
        }

        if(($current_narrow->type=="waterway" )|| isset($current_narrow->width) ){
            $current_narrow_new->waterway_type="1";
            $current_narrow_new->waterway->width=$current_narrow->width;
            $current_narrow_new->waterway->depth=$current_narrow->depth;
            $current_narrow_new->waterway->slop=$current_narrow->slop;
         }
         // culvert round
        if(isset($current_narrow->culvert->diameter)){
            $current_narrow_new->round_type="1";
            $current_narrow_new->round->diameter=$diameter;
            $current_narrow_new->round->num=$numr;
            $current_narrow_new->round->len=$lenr;

        }
         // culvert square

        if(isset($current_narrow->culvert->width)){
            $current_narrow_new->square_type="1";
            $current_narrow_new->square->width=$width;
            $current_narrow_new->square->high=$high;
            $current_narrow_new->square->num=$numsq;
            $current_narrow_new->square->len=$lensq;

        }
        // other
        if($current_narrow->type=="other" || isset($current_narrow->other) ){
            $current_narrow_new->other_type="1";
            $current_narrow_new->other->detail=$current_narrow->other;
        }  

        // Problem Neural 
        $nat_erosion=NuLL;
        $nat_shoal=NULL;
        $nat_missing=NULL;
        $nat_winding=NULL;
        $nat_weed=NULL;
        $nat_other=NULL;
        if($problem[0]->nat_erosion==1){
            $nat_erosion=" ตลิ่งพังการกัดเซาะ ";
        }
        if($problem[0]->nat_shoal==1){
            $nat_shoal=" การทับถมของตะกอน (ลำน้ำตื้นเขิน) ";
        }
        if($problem[0]->nat_missing==1){
            $nat_missing=" ลำน้ำขาดหาย ";
        }
        if($problem[0]->nat_winding==1){
            $nat_winding="ลำน้ำคดเคี้ยวมาก";
        }
        if($problem[0]->nat_weed==1){
            $nat_weed=" วัชพืช (".$problem[0]->nat_weed_detail." )";
        }
        if($problem[0]->nat_other==1){
            $nat_other=" อื่นๆ (".$problem[0]->nat_other_detail." )";
        }
        $nut=$nat_erosion.$nat_shoal.$nat_missing.$nat_winding.$nat_weed.$nat_other;

        // Problem Human
        $hum_structure=NULL;
        $infra=NULL;
        $hum_soil_cover=NULL;
        $hum_trash=NULL;
        $hum_other=NULL;
        $hum=NULL;
        if($problem[0]->hum_structure==1){
            if($problem[0]->hum_str_owner_type=="ราชการ"){
                $hum_structure="สิ่งปลูกสร้างเป็นของส่วนราชการ : เป็นส่วนอาคาร ".$problem[0]->hum_stc_bld_num." หลัง รั้ว ".$problem[0]->hum_stc_fence_num." หลัง อื่นๆ ".$problem[0]->hum_str_other;
            }else if($problem[0]->hum_str_owner_type=="เอกชน"){
                $hum_structure="สิ่งปลูกสร้างเป็นของส่วนเอกชน หรือส่วนบุคคล : เป็นส่วนอาคาร ".$problem[0]->hum_stc_bld_bu_num." หลัง รั้ว ".$problem[0]->hum_stc_fence_bu_num." หลัง อื่นๆ ".$problem[0]->hum_str_other_bu;
            }
        }
        if($problem[0]->hum_road==1||$problem[0]->hum_smallconvert==1||$problem[0]->hum_road_paralel==1||$problem[0]->hum_replaced_convert==1||$problem[0]->hum_bridge_pile==1){
            $infra="ระบบสาธารณูปโภค:";
            if($problem[0]->hum_road==1){
                $infra=$infra." ถนนขวางทางน้ำ";
            }
            if($problem[0]->hum_smallconvert==1){
                $infra=$infra." ท่อลอดถนนที่ตัดลำน้ำมีขนาดเล็กเกินไประบายน้ำหลากไม่ทัน";
            }
            if($problem[0]->hum_road_paralel==1){
                $infra=$infra." ถนนขนานลำน้ำสร้างกินพื้นที่ลำน้ำ";
            }
            if($problem[0]->hum_replaced_convert==1){
                $infra=$infra." วางท่อตามแนวลำน้ำทดแทนลำน้ำเดิม";
            }
            if($problem[0]->hum_bridge_pile==1){
                $infra=$infra." สะพานมีหน้าตัดแคบเกินไป หรือมีต่อม่อมากเกินไปในช่วงฤดูน้ำหลากระบายไม่ทัน";
            }
           
        }
        if($problem[0]->hum_soil_cover==1){
            $hum_soil_cover="การถมดิน";
        }
        if($problem[0]->hum_trash==1){
            $hum_trash="สิ่งปฏิกูล";
        }
        if($problem[0]->hum_other==1){
            $hum_other="อื่นๆ (".$problem[0]->hum_other_detail.")";
        }
        $hum= [$hum_structure,$infra,$hum_soil_cover,$hum_trash,$hum_other];
        // dd($damageData);
        $current_end = json_decode($current_end);
        $start_utmX = $data[0]->blockageLocation->blk_start_utm->getLat();
        $start_utmY= $data[0]->blockageLocation->blk_start_utm->getLng();
        $end_utmX=$data[0]->blockageLocation->blk_end_utm->getLat();
        $end_utmY=$data[0]->blockageLocation->blk_end_utm->getLng();
        $AllData = [
            'data' => $data,
            'expert'=>$expert,
            'nut'=>$nut,
            'hum'=>$hum,
            'damageData' => $damageData,
            'damage_type' => $damage_type,
            'pastData' =>$pastData,
            'current_start' =>$current_start,
            'current_narrow_new' =>$current_narrow_new,
            'current_end' =>$current_end,
            'current_brigde' => $current_brigde,
            'problem' =>$problem,
            'photo_Blockage' =>$photo_Blockage,
            'photo_Land' =>$photo_Land,
            'photo_Riverbefore' =>$photo_Riverbefore,
            'photo_Riverprob' =>$photo_Riverprob,
            'photo_Riverafter' =>$photo_Riverafter,
            'photo_Probsketch' =>$photo_Probsketch,
            'solution_id' =>$solution_id,
            'project_id' =>$project_id,
            'location'=>['blk_start_utmX'=>$start_utmX,
                            'blk_start_utmY'=>$start_utmY,
                            'blk_end_utmX'=>$end_utmX,
                            'blk_end_utmY'=>$end_utmY
                        ]
        ];

        $result = json_encode($AllData);
        echo $result;
    }
        
    
}

