<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use PDF;
use App\BlockageLocation;
use App\Blockage;
use App\BlockageCrossection;
use App\River;
use App\ProblemDetail;
use App\Solution;
use App\Project;
use App\Photo;
use DB;

class pdfController extends Controller
{
    
    public function viewBlockagePDF()
    {
        return view('form.blockagePDFview');
    }

    public function table(Request $request)
    {   
       
        $amp=$request->amp;
        if ($request->amp=="sum"){
            // $data = BlockageLocation::select('*')->get();
            $data = Blockage::with('blockageLocation')->get();
            $problem =  ProblemDetail::select 
                        ('*',\DB::raw("sum(IFNULL(hum_stc_bld_num,0))
                                 +sum(IFNULL(hum_stc_fence_num,0))
                                 +sum(IFNULL(hum_str_other,0)) as gov"),
                            \DB::raw("sum(IFNULL(hum_stc_bld_bu_num,0))
                                +sum(IFNULL(hum_stc_fence_bu_num,0))
                                +sum(IFNULL(hum_str_other_bu,0)) as bu")
    
                        )
                        ->groupBy('blk_id')
                        ->get();
           // dd($data);
            $amp="sum9";
            $pdf = PDF::loadView('table_report' ,compact('data','problem','amp'))->setPaper('a4', 'landscape');
            return $pdf->stream('BlockageAll.pdf');
        }else{

            $problem =DB::table('blockage_locations')
            ->join('blockages', 'blockage_locations.blk_location_id', '=', 'blockages.blk_location_id')
            ->join('problem_details', 'blockages.blk_id', '=', 'problem_details.blk_id')
            ->join('rivers', 'blockages.river_id', '=', 'rivers.river_id')
            ->select('problem_details.*','blockages.*','rivers.*','blockage_locations.*',
                      \DB::raw("sum(IFNULL(hum_stc_bld_num,0))
                        +sum(IFNULL(hum_stc_fence_num,0))
                        +sum(IFNULL(hum_str_other,0)) as gov"),
                      \DB::raw("sum(IFNULL(hum_stc_bld_bu_num,0))
                        +sum(IFNULL(hum_stc_fence_bu_num,0))
                        +sum(IFNULL(hum_str_other_bu,0)) as bu"),
                      \DB::raw('ST_X(blockage_locations.blk_start_utm) as lat_utm_start'),
                      \DB::raw('ST_X(blockage_locations.blk_start_utm) as lng_utm_start'),
                      \DB::raw('ST_X(blockage_locations.blk_end_utm) as lat_utm_stop'),
                      \DB::raw('ST_X(blockage_locations.blk_end_utm) as lng_utm_stop')
                    )
            ->where ('blockage_locations.blk_district',$amp)
            ->groupBy('blockages.blk_id')
            ->get();

            // $damageData=json_decode($problem[0]->damage_level);
            // dd($damageData->flood);
            $name= "อำเภอ.".$amp.".pdf";
            $pdf = PDF::loadView('table_reportAmp' ,compact('problem','amp'))->setPaper('a4', 'landscape');
            return $pdf->stream($name);

        }
       
    }


    public function view($blk_id=0)
        {
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
            

        //dd(isset($current_narrow->type));
        $current_narrow_new = [
            'waterway_type' => null,
            'round_type' => null,
            'square_type' => null,
            'other_type' => null,
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

    // dd($current_narrow_new);
        

       //dd($data[0]->blockageLocation );
        // dd($solution_id[0]->sol_how);
        $current_end = json_decode($current_end);
        // return view('report_pdf', compact('data','damageData','damage_type','pastData','current_start','current_narrow','current_end','problem','photo_Blockage','photo_Land','photo_Riverbefore','photo_Riverprob','photo_Riverafter','photo_Probsketch','solution_id','project_id'));
         $pdf = PDF::loadView('report_pdf' ,compact('current_brigde','data','damageData','damage_type','pastData','current_start','current_narrow_new','current_end','problem','photo_Blockage','photo_Land','photo_Riverbefore','photo_Riverprob','photo_Riverafter','photo_Probsketch','solution_id','project_id'));
         return $pdf->stream('reportBlockage.pdf');   
        
    
    }

    public function exportPDF()
    {
        
        $data =  Blockage::with('blockageLocation','blockageCrossection','River','Solution','Photo')->get();
        $problem =  ProblemDetail::where('blk_id', $data[0]->blk_id)->get();
        //$project =  Project::with('Solution')->get();
        $past = $data[0]->blockageCrossection->past;
        $current_start = $data[0]->blockageCrossection->current_start;
        $current_narrow = $data[0]->blockageCrossection->current_narrow;
        $current_end = $data[0]->blockageCrossection->current_end;

        $pastData = json_decode($past);
        $current_start = json_decode($current_start);
        $current_narrow = json_decode($current_narrow);
        $current_end = json_decode($current_end);
        //return $data;
        //return $project;
        //dd($data);
        $pdf = PDF::loadView('form.blockagePDF' ,compact('data','pastData','current_start','current_narrow','current_end','problem'));
        return $pdf->stream('Blockage.pdf');
        //return $pdf->download('demo.pdf');
    }


    // --------------------------------- //
    // ------ FANG -------CM------------ //
    public function tableCM(Request $request)

    {   
       
        $amp=$request->amp;
        if ($request->amp=="sum"){
            $problem =DB::table('blockage_locations')
            ->join('blockages', 'blockage_locations.blk_location_id', '=', 'blockages.blk_location_id')
            ->join('problem_details', 'blockages.blk_id', '=', 'problem_details.blk_id')
            ->join('rivers', 'blockages.river_id', '=', 'rivers.river_id')
            ->select('problem_details.*','blockages.blk_id','blockages.blk_code','blockages.damage_level','blockages.damage_frequency','rivers.*','blockage_locations.*',
                      \DB::raw("sum(IFNULL(hum_stc_bld_num,0))
                        +sum(IFNULL(hum_stc_fence_num,0))
                        +sum(IFNULL(hum_str_other,0)) as gov"),
                      \DB::raw("sum(IFNULL(hum_stc_bld_bu_num,0))
                        +sum(IFNULL(hum_stc_fence_bu_num,0))
                        +sum(IFNULL(hum_str_other_bu,0)) as bu"),
                      \DB::raw('ST_Y(blockage_locations.blk_start_utm) as lat_utm_start'),
                      \DB::raw('ST_X(blockage_locations.blk_start_utm) as lng_utm_start'),
                      \DB::raw('ST_Y(blockage_locations.blk_end_utm) as lat_utm_stop'),
                      \DB::raw('ST_X(blockage_locations.blk_end_utm) as lng_utm_stop')
                    )
            ->where ('blockage_locations.blk_province',"เชียงใหม่")
            ->groupBy('blockages.blk_id')
            ->get();
            // dd($problem);
            $amp= "cm";
            
            for($i=0;$i<count($problem);$i++){
                $data[$i]=[
                           'blk_code'=>$problem[$i]->blk_code,
                           'blk_village'=>$problem[$i]->blk_village,
                           'blk_tumbol'=>$problem[$i]->blk_tumbol,
                           'blk_district'=>$problem[$i]->blk_district,
                           'river_name'=>$problem[$i]->river_name,
                           'lat_utm_start'=>$problem[$i]->lat_utm_start,
                           'lng_utm_start'=>$problem[$i]->lng_utm_start,
                           'lat_utm_stop'=>$problem[$i]->lat_utm_stop,
                           'lng_utm_stop'=>$problem[$i]->lng_utm_stop,
                           'prob_level'=>$problem[$i]->prob_level,
                           'damage_level'=>$problem[$i]->damage_level,
                           'damage_frequency'=>$problem[$i]->damage_frequency,
                           'nat_erosion'=>$problem[$i]->nat_erosion,
                           'nat_shoal'=>$problem[$i]->nat_shoal,
                           'nat_missing'=>$problem[$i]->nat_missing,
                           'nat_winding'=>$problem[$i]->nat_winding,
                           'nat_weed'=>$problem[$i]->nat_weed,
                           'nat_weed_detail'=>$problem[$i]->nat_weed_detail,
                           'nat_other'=>$problem[$i]->nat_other,
                           'nat_other_detail'=>$problem[$i]->nat_other_detail,
                           'hum_structure'=>$problem[$i]->hum_structure,
                           'hum_str_owner_type'=>$problem[$i]->hum_str_owner_type,
                            'hum_stc_bld_num'=>$problem[$i]->hum_stc_bld_num,
                            'hum_stc_fence_num'=>$problem[$i]->hum_stc_fence_num,
                            'hum_str_other'=>$problem[$i]->hum_str_other,
                            'hum_stc_bld_bu_num'=>$problem[$i]->hum_stc_bld_bu_num,
                            'hum_stc_fence_bu_num'=>$problem[$i]->hum_stc_fence_bu_num,
                            'hum_str_other_bu'=>$problem[$i]->hum_str_other_bu,
                            'hum_road'=>$problem[$i]->hum_road,
                            'hum_smallconvert'=>$problem[$i]->hum_smallconvert,
                            'hum_road_paralel'=>$problem[$i]->hum_road_paralel,
                            'hum_replaced_convert'=>$problem[$i]->hum_replaced_convert,
                            'hum_bridge_pile'=>$problem[$i]->hum_bridge_pile,
                            'hum_soil_cover'=>$problem[$i]->hum_soil_cover,
                            'hum_trash'=>$problem[$i]->hum_trash,
                            'hum_other'=>$problem[$i]->hum_other,
                            'hum_other_detail'=>$problem[$i]->hum_other_detail,
                            'gov'=>$problem[$i]->gov,
                            'bu'=>$problem[$i]->bu,
                            'date'=>$problem[$i]->updated_at
                        ];
            }
            $result=[
                'amp'=>$amp,
                'data'=>$data

            ];
           
            echo json_encode($result);
        }else{

            $problem =DB::table('blockage_locations')
            ->join('blockages', 'blockage_locations.blk_location_id', '=', 'blockages.blk_location_id')
            ->join('problem_details', 'blockages.blk_id', '=', 'problem_details.blk_id')
            ->join('rivers', 'blockages.river_id', '=', 'rivers.river_id')
            ->select('problem_details.*','blockages.blk_id','blockages.blk_code','blockages.damage_level','blockages.damage_frequency','rivers.*','blockage_locations.*',
                      \DB::raw("sum(IFNULL(hum_stc_bld_num,0))
                        +sum(IFNULL(hum_stc_fence_num,0))
                        +sum(IFNULL(hum_str_other,0)) as gov"),
                      \DB::raw("sum(IFNULL(hum_stc_bld_bu_num,0))
                        +sum(IFNULL(hum_stc_fence_bu_num,0))
                        +sum(IFNULL(hum_str_other_bu,0)) as bu"),
                      \DB::raw('ST_Y(blockage_locations.blk_start_utm) as lat_utm_start'),
                      \DB::raw('ST_X(blockage_locations.blk_start_utm) as lng_utm_start'),
                      \DB::raw('ST_Y(blockage_locations.blk_end_utm) as lat_utm_stop'),
                      \DB::raw('ST_X(blockage_locations.blk_end_utm) as lng_utm_stop')
                    )
            ->where ('blockage_locations.blk_district',$amp)
            ->groupBy('blockages.blk_id')
            ->get();
            // dd($problem);
            $name= "อำเภอ.".$amp.".pdf";
           
            
            // $pdf = PDF::loadView('fang/pdfAmp' ,compact('problem','amp'))->setPaper('a4', 'landscape');
            // return $pdf->stream($name);
            // dd($problem);
            for($i=0;$i<count($problem);$i++){
                $data[$i]=[
                           'amp'=>$amp,
                           'blk_code'=>$problem[$i]->blk_code,
                           'blk_village'=>$problem[$i]->blk_village,
                           'blk_tumbol'=>$problem[$i]->blk_tumbol,
                           'blk_district'=>$problem[$i]->blk_district,
                           'river_name'=>$problem[$i]->river_name,
                           'lat_utm_start'=>$problem[$i]->lat_utm_start,
                           'lng_utm_start'=>$problem[$i]->lng_utm_start,
                           'lat_utm_stop'=>$problem[$i]->lat_utm_stop,
                           'lng_utm_stop'=>$problem[$i]->lng_utm_stop,
                           'prob_level'=>$problem[$i]->prob_level,
                           'damage_level'=>$problem[$i]->damage_level,
                           'damage_frequency'=>$problem[$i]->damage_frequency,
                           'nat_erosion'=>$problem[$i]->nat_erosion,
                           'nat_shoal'=>$problem[$i]->nat_shoal,
                           'nat_missing'=>$problem[$i]->nat_missing,
                           'nat_winding'=>$problem[$i]->nat_winding,
                           'nat_weed'=>$problem[$i]->nat_weed,
                           'nat_weed_detail'=>$problem[$i]->nat_weed_detail,
                           'nat_other'=>$problem[$i]->nat_other,
                           'nat_other_detail'=>$problem[$i]->nat_other_detail,
                           'hum_structure'=>$problem[$i]->hum_structure,
                           'hum_str_owner_type'=>$problem[$i]->hum_str_owner_type,
                            'hum_stc_bld_num'=>$problem[$i]->hum_stc_bld_num,
                            'hum_stc_fence_num'=>$problem[$i]->hum_stc_fence_num,
                            'hum_str_other'=>$problem[$i]->hum_str_other,
                            'hum_stc_bld_bu_num'=>$problem[$i]->hum_stc_bld_bu_num,
                            'hum_stc_fence_bu_num'=>$problem[$i]->hum_stc_fence_bu_num,
                            'hum_str_other_bu'=>$problem[$i]->hum_str_other_bu,
                            'hum_road'=>$problem[$i]->hum_road,
                            'hum_smallconvert'=>$problem[$i]->hum_smallconvert,
                            'hum_road_paralel'=>$problem[$i]->hum_road_paralel,
                            'hum_replaced_convert'=>$problem[$i]->hum_replaced_convert,
                            'hum_bridge_pile'=>$problem[$i]->hum_bridge_pile,
                            'hum_soil_cover'=>$problem[$i]->hum_soil_cover,
                            'hum_trash'=>$problem[$i]->hum_trash,
                            'hum_other'=>$problem[$i]->hum_other,
                            'hum_other_detail'=>$problem[$i]->hum_other_detail,
                            'gov'=>$problem[$i]->gov,
                            'bu'=>$problem[$i]->bu,
                            'date'=>$problem[$i]->updated_at
                        ];
            }
            $result=[
                'amp'=>$amp,
                'data'=>$data

            ];
           
            echo json_encode($result);
            exit;

        }
       
    }

    public function tablegen(Request $request)
    {   
       
        $amp=$request->amp;
        if ($request->amp=="sum"){
            // $data = BlockageLocation::select('*')->get();
            $data = Blockage::with('blockageLocation')->get();
            $problem =  ProblemDetail::select 
                        ('*',\DB::raw("sum(IFNULL(hum_stc_bld_num,0))
                                 +sum(IFNULL(hum_stc_fence_num,0))
                                 +sum(IFNULL(hum_str_other,0)) as gov"),
                            \DB::raw("sum(IFNULL(hum_stc_bld_bu_num,0))
                                +sum(IFNULL(hum_stc_fence_bu_num,0))
                                +sum(IFNULL(hum_str_other_bu,0)) as bu")
    
                        )
                        ->groupBy('blk_id')
                        ->get();
           // dd($data);
            $amp="sum9";
            $pdf = PDF::loadView('table_report' ,compact('data','problem','amp'))->setPaper('a4', 'landscape');
            return $pdf->stream('BlockageAll.pdf');
        }else{
            if($request->tumbol=="sum" ){
                $problem =DB::table('blockage_locations')
                ->join('blockages', 'blockage_locations.blk_location_id', '=', 'blockages.blk_location_id')
                ->join('problem_details', 'blockages.blk_id', '=', 'problem_details.blk_id')
                ->join('rivers', 'blockages.river_id', '=', 'rivers.river_id')
                ->select('problem_details.*','blockages.*','rivers.*','blockage_locations.*',
                        \DB::raw("sum(IFNULL(hum_stc_bld_num,0))
                            +sum(IFNULL(hum_stc_fence_num,0))
                            +sum(IFNULL(hum_str_other,0)) as gov"),
                        \DB::raw("sum(IFNULL(hum_stc_bld_bu_num,0))
                            +sum(IFNULL(hum_stc_fence_bu_num,0))
                            +sum(IFNULL(hum_str_other_bu,0)) as bu"),
                        \DB::raw('ST_X(blockage_locations.blk_start_utm) as lat_utm_start'),
                        \DB::raw('ST_X(blockage_locations.blk_start_utm) as lng_utm_start'),
                        \DB::raw('ST_X(blockage_locations.blk_end_utm) as lat_utm_stop'),
                        \DB::raw('ST_X(blockage_locations.blk_end_utm) as lng_utm_stop')
                        )
                ->where ('blockage_locations.blk_district',$amp)
                ->groupBy('blockages.blk_id')
                ->get();

                // $damageData=json_decode($problem[0]->damage_level);
                // dd($damageData->flood);
                $name= "อำเภอ.".$amp.".pdf";
                $pdf = PDF::loadView('table_reportAmp' ,compact('problem','amp'))->setPaper('a4', 'landscape');
                return $pdf->stream($name);

            }else{
                $problem =DB::table('blockage_locations')
                ->join('blockages', 'blockage_locations.blk_location_id', '=', 'blockages.blk_location_id')
                ->join('problem_details', 'blockages.blk_id', '=', 'problem_details.blk_id')
                ->join('rivers', 'blockages.river_id', '=', 'rivers.river_id')
                ->select('problem_details.*','blockages.*','rivers.*','blockage_locations.*',
                        \DB::raw("sum(IFNULL(hum_stc_bld_num,0))
                            +sum(IFNULL(hum_stc_fence_num,0))
                            +sum(IFNULL(hum_str_other,0)) as gov"),
                        \DB::raw("sum(IFNULL(hum_stc_bld_bu_num,0))
                            +sum(IFNULL(hum_stc_fence_bu_num,0))
                            +sum(IFNULL(hum_str_other_bu,0)) as bu"),
                        \DB::raw('ST_X(blockage_locations.blk_start_utm) as lat_utm_start'),
                        \DB::raw('ST_X(blockage_locations.blk_start_utm) as lng_utm_start'),
                        \DB::raw('ST_X(blockage_locations.blk_end_utm) as lat_utm_stop'),
                        \DB::raw('ST_X(blockage_locations.blk_end_utm) as lng_utm_stop')
                        )
                ->where ('blockage_locations.blk_district',$amp)
                ->where ('blockage_locations.blk_tumbol',$request->tumbol)
                ->groupBy('blockages.blk_id')
                ->get();

                // $damageData=json_decode($problem[0]->damage_level);
                // dd($damageData->flood);
                $amp=$amp."/".$request->tumbol;
                // dd($amp);
                $name= "อำเภอ.".$amp.".pdf";
                $pdf = PDF::loadView('table_reportAmp' ,compact('problem','amp'))->setPaper('a4', 'landscape');
                return $pdf->stream($name);

            }
            

        }
       
    }


}


