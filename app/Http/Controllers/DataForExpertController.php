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
use App\Commentexpert;
use App\Expert;
use App\Page;
use DB;
use Auth;
use App\User;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use AuthenticatesUsers;
use SpatialTrait;
use PDF;
use File;
use Image;
class DataForExpertController extends Controller
{
    public function reportExpert($blk_id=0){
        // dd ("555");
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

        $expert=Expert::where('blk_id', $data[0]->blk_id)->get();
        
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
            }else if(isset($current_narrow->culvert->num)){
                $numsq=$current_narrow->culvert->num;
            }else{
                $numsq=null;
            }
        }else{
            $width=null;
            $high=null;
            $numsq=null;
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
        return view('expert.report', compact('expert','data','nut','hum','damageData','damage_type','pastData','current_start','current_narrow_new','current_end','problem','photo_Blockage','photo_Land','photo_Riverbefore','photo_Riverprob','photo_Riverafter','photo_Probsketch','solution_id','project_id'));
       
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
        
        // dd( $current_brigde->width);
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
        

        
        // dd($current_brigde);
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
    //    dd($current_brigde);
        $pdf = PDF::loadView('expert.reportpdf' ,compact('current_brigde','expert','data','nut','hum','damageData','damage_type','pastData','current_start','current_narrow_new','current_end','problem','photo_Blockage','photo_Land','photo_Riverbefore','photo_Riverprob','photo_Riverafter','photo_Probsketch','solution_id','project_id'));
        return $pdf->stream('expert_report.pdf');
    }

    public function expertPDFAmp(Request $request)
    {
        // $data=0;$problem=0;$photo_Blockage=0;$photo_Land=0;
        // $photo_Riverbefore=0;$photo_Riverprob=0;$photo_Riverafter=0;
        // $photo_Probsketch=0;$solution_id=0;$project_id=0;$expert=0;    
        // $current_brigde=0;$nut=0; $damageData=0;$damage_type=0;
        // $pastData=0;$current_start=0;$current_narrow_new=0;$current_end=0;$problem=0;$photo=0;
        $data=NULL;$problem=NULL;$photo_Blockage=NULL;$photo_Land=NULL;
        $photo_Riverbefore=NULL;$photo_Riverprob=NULL;$photo_Riverafter=NULL;
        $photo_Probsketch=NULL;$solution_id=NULL;$project_id=NULL;$expert=NULL;    
        $current_brigde=NULL;$nut=NULL; $damageData=NULL;$damage_type=NULL;
        $pastData=NULL;$current_start=NULL;$current_narrow_new=NULL;$current_end=NULL;$problem=NULL;$photo=NULL;

        $amp=$request->amp;
        $tumbol=$request->tumbol;
        $hum=NULL;
        $blk=DB::table('blockage_locations')
                ->join('blockages', 'blockage_locations.blk_location_id', '=', 'blockages.blk_location_id')
                ->select('blockages.blk_id')
                ->where ('blockage_locations.blk_district',$request->amp)
                ->where ('blockage_locations.blk_tumbol',$request->tumbol)
                ->groupBy('blockages.blk_id')
                ->get();

      
        for($i=0;$i<count($blk);$i++){

            $blk_id= $blk[$i]->blk_id;
           
            $data[$i]=  Blockage::with('blockageLocation','blockageCrossection','River','Solution','Photo')->where('blk_id', $blk_id)->get();
            $problem[$i] =  ProblemDetail::where('blk_id', $data[$i][0]->blk_id)->get();
            $photo_Blockage[$i]=Photo::where('blk_id', $data[$i][0]->blk_id )->Where('photo_type','Blockage')->get();
            $photo_Land[$i]=Photo::where('blk_id', $data[$i][0]->blk_id )->Where('photo_type','Land')->get();
            $photo_Riverbefore[$i]=Photo::where('blk_id', $data[$i][0]->blk_id )->Where('photo_type','River before')->get();
            $photo_Riverprob[$i]=Photo::where('blk_id', $data[$i][0]->blk_id )->Where('photo_type','River prob')->get();
            $photo_Riverafter[$i]=Photo::where('blk_id', $data[$i][0]->blk_id )->Where('photo_type','River after')->get();
            $photo_Probsketch[$i]=Photo::where('blk_id', $data[$i][0]->blk_id )->Where('photo_type','Prob sketch')->get();
            $solution_id[$i]=Solution::where('sol_id',$data[$i][0]->sol_id)->get();
            $project_id[$i]=Project::where('proj_id',$solution_id[$i][0]->proj_id)->get();
            $expert[$i]=Expert::where('blk_id', $data[$i][0]->blk_id)->get();

            $damage[$i]=$data[$i][0]->damage_level;
            $damage_type[$i]=$data[$i][0]->damage_type;
            $past[$i] = $data[$i][0]->blockageCrossection->past;
            $current_start[$i] = $data[$i][0]->blockageCrossection->current_start;
            $current_narrow[$i] = $data[$i][0]->blockageCrossection->current_narrow;
            $current_end[$i] = $data[$i][0]->blockageCrossection->current_end;
            $current_brigde[$i] = $data[$i][0]->blockageCrossection->current_brigde;

            $damageData[$i]=json_decode($damage[$i]);
            $damage_type[$i]=json_decode($damage_type[$i]);
            $pastData[$i] = json_decode($past[$i]);
            $current_start[$i] = json_decode($current_start[$i]);
            $current_narrow[$i] = json_decode($current_narrow[$i]);
            $current_brigde[$i] = json_decode($current_brigde[$i]);

            // dd( $current_brigde->width);
            $current_brigde_new[$i]=[
                'width'=>0,
                'depth'=> 0,
                'len'=>0,
                'num'=>0
            ];

            if($current_brigde[$i]==null){
                $current_brigde[$i]=json_encode($current_brigde_new[$i]);
                $current_brigde[$i]=json_decode($current_brigde[$i]);
            }



            // dd($current_brigde);
            $current_narrow_new[$i] = [
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
            $current_narrow_new[$i]=json_encode($current_narrow_new[$i]);
            $current_narrow_new[$i]=json_decode($current_narrow_new[$i]);

            if(isset($current_narrow[$i]->culvert->diameter)){
                $diameter=$current_narrow[$i]->culvert->diameter;

                if(isset($current_narrow[$i]->culvert->c->num)){
                    $numr=$current_narrow[$i]->culvert->c->num;
                    
                }else if (isset($current_narrow[$i]->culvert->num)){
                    $numr=$current_narrow[$i]->culvert->num;
                    
                }else{
                    $numr=null;
                }

                if(!empty($current_narrow[$i]->culvert->c->len)||!empty($current_narrow[$i]->culvert->len)){
                    if(isset($current_narrow[$i]->culvert->c->len)){
                        $lenr=$current_narrow[$i]->culvert->c->len;
                    }else if($current_narrow[$i]->culvert->len){
                        $lenr=$current_narrow[$i]->culvert->len;
                    }
                }else{
                    $lenr=null;
                }
            }else{
                $diameter=null;
                $numr=null;
                $lenr=null;
            }

            if(isset($current_narrow[$i]->culvert->width)){
                $width=$current_narrow[$i]->culvert->width;
                $high=$current_narrow[$i]->culvert->high;
                
                if(isset($current_narrow[$i]->culvert->sq->num)){
                    $numsq=$current_narrow[$i]->culvert->sq->num;
                }else if(isset($current_narrow[$i]->culvert->num)){
                    $numsq=$current_narrow[$i]->culvert->num;
                }else{
                    $numsq=null;
                }

                if(!empty($current_narrow[$i]->culvert->sq->len)||!empty($current_narrow[$i]->culvert->len)){
                    if(isset($current_narrow[$i]->culvert->sq->len)){
                        $lensq=$current_narrow[$i]->culvert->sq->len;
                    }else if($current_narrow[$i]->culvert->len){
                        $lensq=$current_narrow[$i]->culvert->len;
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

            if(($current_narrow[$i]->type=="waterway" )|| isset($current_narrow[$i]->width) ){
                $current_narrow_new[$i]->waterway_type="1";
                $current_narrow_new[$i]->waterway->width=$current_narrow[$i]->width;
                $current_narrow_new[$i]->waterway->depth=$current_narrow[$i]->depth;
                $current_narrow_new[$i]->waterway->slop=$current_narrow[$i]->slop;
            }
            // culvert round
            if(isset($current_narrow[$i]->culvert->diameter)){
                $current_narrow_new[$i]->round_type="1";
                $current_narrow_new[$i]->round->diameter=$diameter;
                $current_narrow_new[$i]->round->num=$numr;
                $current_narrow_new[$i]->round->len=$lenr;

            }
            // culvert square

            if(isset($current_narrow[$i]->culvert->width)){
                $current_narrow_new[$i]->square_type="1";
                $current_narrow_new[$i]->square->width=$width;
                $current_narrow_new[$i]->square->high=$high;
                $current_narrow_new[$i]->square->num=$numsq;
                $current_narrow_new[$i]->square->len=$lensq;

            }
            // other
            if($current_narrow[$i]->type=="other" || isset($current_narrow[$i]->other) ){
                $current_narrow_new[$i]->other_type="1";
                $current_narrow_new[$i]->other->detail=$current_narrow[$i]->other;
            }  

            // Problem Neural 
            $nat_erosion=NuLL;
            $nat_shoal=NULL;
            $nat_missing=NULL;
            $nat_winding=NULL;
            $nat_weed=NULL;
            $nat_other=NULL;
            if($problem[$i][0]->nat_erosion==1){
                $nat_erosion=" ตลิ่งพังการกัดเซาะ ";
            }
            if($problem[$i][0]->nat_shoal==1){
                $nat_shoal=" การทับถมของตะกอน (ลำน้ำตื้นเขิน) ";
            }
            if($problem[$i][0]->nat_missing==1){
                $nat_missing=" ลำน้ำขาดหาย ";
            }
            if($problem[$i][0]->nat_winding==1){
                $nat_winding="ลำน้ำคดเคี้ยวมาก";
            }
            if($problem[$i][0]->nat_weed==1){
                $nat_weed=" วัชพืช (".$problem[$i][0]->nat_weed_detail." )";
            }
            if($problem[$i][0]->nat_other==1){
                $nat_other=" อื่นๆ (".$problem[$i][0]->nat_other_detail." )";
            }
            $nut[$i]=$nat_erosion.$nat_shoal.$nat_missing.$nat_winding.$nat_weed.$nat_other;

            // Problem Human
            $hum_structure=NULL;
            $infra=NULL;
            $hum_soil_cover=NULL;
            $hum_trash=NULL;
            $hum_other=NULL;
           
            if($problem[$i][0]->hum_structure==1){
                if($problem[$i][0]->hum_str_owner_type=="ราชการ"){
                    $hum_structure="สิ่งปลูกสร้างเป็นของส่วนราชการ : เป็นส่วนอาคาร ".$problem[$i][0]->hum_stc_bld_num." หลัง รั้ว ".$problem[$i][0]->hum_stc_fence_num." หลัง อื่นๆ ".$problem[$i][0]->hum_str_other;
                }else if($problem[$i][0]->hum_str_owner_type=="เอกชน"){
                    $hum_structure="สิ่งปลูกสร้างเป็นของส่วนเอกชน หรือส่วนบุคคล : เป็นส่วนอาคาร ".$problem[$i][0]->hum_stc_bld_bu_num." หลัง รั้ว ".$problem[$i][0]->hum_stc_fence_bu_num." หลัง อื่นๆ ".$problem[$i][0]->hum_str_other_bu;
                }
            }
            if($problem[$i][0]->hum_road==1||$problem[$i][0]->hum_smallconvert==1||$problem[$i][0]->hum_road_paralel==1||$problem[$i][0]->hum_replaced_convert==1||$problem[$i][0]->hum_bridge_pile==1){
                $infra="ระบบสาธารณูปโภค:";
                if($problem[$i][0]->hum_road==1){
                    $infra=$infra." ถนนขวางทางน้ำ";
                }
                if($problem[$i][0]->hum_smallconvert==1){
                    $infra=$infra." ท่อลอดถนนที่ตัดลำน้ำมีขนาดเล็กเกินไประบายน้ำหลากไม่ทัน";
                }
                if($problem[$i][0]->hum_road_paralel==1){
                    $infra=$infra." ถนนขนานลำน้ำสร้างกินพื้นที่ลำน้ำ";
                }
                if($problem[$i][0]->hum_replaced_convert==1){
                    $infra=$infra." วางท่อตามแนวลำน้ำทดแทนลำน้ำเดิม";
                }
                if($problem[$i][0]->hum_bridge_pile==1){
                    $infra=$infra." สะพานมีหน้าตัดแคบเกินไป หรือมีต่อม่อมากเกินไปในช่วงฤดูน้ำหลากระบายไม่ทัน";
                }

            }
            if($problem[$i][0]->hum_soil_cover==1){
                $hum_soil_cover="การถมดิน";
            }
            if($problem[$i][0]->hum_trash==1){
                $hum_trash="สิ่งปฏิกูล";
            }
            if($problem[$i][0]->hum_other==1){
                $hum_other="อื่นๆ (".$problem[$i][0]->hum_other_detail.")";
            }
            $hum[$i]= [$hum_structure,$infra,$hum_soil_cover,$hum_trash,$hum_other];
            

            $current_end[$i]= json_decode($current_end[$i]);
            

        }
       
        // dd($hum[0][1]);
        // dd($data);
        $pdf = PDF::loadView('expert.reportpdf_Amp' ,compact('amp','tumbol','current_brigde','expert','data','nut','hum','damageData','damage_type','pastData','current_start','current_narrow_new','current_end','problem','photo_Blockage','photo_Land','photo_Riverbefore','photo_Riverprob','photo_Riverafter','photo_Probsketch','solution_id','project_id'));
        
        return $pdf->stream('expert_report_Amp.pdf');
    }


    // showphoto
    public function showPhoto($blk_id=0){
        $data =  Blockage::where('blk_id', $blk_id)->get();
        $photo_Blockage=Photo::select('blk_id','photo_id','thumbnail_name')->where('blk_id', $blk_id )->get();
        // dd($photo_Blockage);
        return view('expert.upphoto',compact('photo_Blockage','data'));
    }

     // showphoto
     public function showPhotoDownload($blk_id=0){
        $data =  Blockage::where('blk_id', $blk_id)->get();
        $photo_Blockage=Photo::select('blk_id','photo_id','thumbnail_name','photo_name')->where('blk_id', $blk_id )->get();
        
        $expert=Expert::select('exp_pixmap')->where('blk_id',$blk_id)->get();
        $location =BlockageLocation::where('blk_location_id', $data[0]->blk_location_id)->get();
        // dd($location);	
        return view('expert.showphoto',compact('photo_Blockage','data','expert','location'));
    }




    public function uploadImage(Request $request)
    {
        //    dd($request);
       $blk_id=$request->blk_id;
       $pix=[null,null];
       $c=0;
        //    dd($request->num_pix);
       for($i=0;$i<$request->num_pix;$i++){
           $ph='photo'.($i);
           
           if(isset($request->$ph)){
               $pix[$c]=$request->$ph;
               $c=$c+1;
           }
           if($c==2){
            break;
            }
       }
       // dd($request->photo_type_land);
       
        //**************** check if image photo_type_bld exist **********************//
        if ($request->hasFile('photo_type_land')) {
            // dd("ffff");
            $images = $request->file('photo_type_land');
             // dd($images);
            //setting flag for condition
            $org_img = $thm_img = true;
            // create new directory for uploading image if doesn't exist
            if( ! File::exists('images/expert/originals/')) {
                $org_img = File::makeDirectory('images/expert/originals/', 0777, true);
                
            }
            if ( ! File::exists('images/expert/thumbnails/')) {
                $thm_img = File::makeDirectory('images/expert/thumbnails', 0777, true);
            }
            
            // loop through each image to save and upload
            // foreach($images as $key => $image) {
               
                // $blockage = DB::table('blockages')->select('blk_code')->where('blk_id', $blk_id)->get();
                $expert=Expert::where('blk_id', $blk_id)->get();
                
                $blockageId=$blk_id;
                // $filename = $blk_id.'.'.$image->getClientOriginalExtension();
                $filename = $blk_id.'.jpg';
                //path of image for upload
                $org_path = 'images/expert/originals/' . $filename;
                $thm_path = 'images/expert/thumbnails/' . $filename;
                
                // upload image to server
                if (($org_img && $thm_img) == true) {
                    Image::make($images)->fit(3308, 4675, function ($constraint) {
                            $constraint->upsize();
                        })->save($org_path);
                    Image::make($images)->fit(1654, 2338, function ($constraint) {
                        $constraint->upsize();
                    })->save($thm_path);
                 }
                 
                 $ph = Expert::where('blk_id', $blk_id)->update
                 ([  'exp_pixmap'=>$thm_path]);

            // }
        }      

        $photo = Expert::where('blk_id', $blk_id)->update
                 ([   'exp_pix1'=>$pix[0],
                     'exp_pix2'=>$pix[1],
                     
        ]);
        
        return redirect()->route('expert.expert');
    }
    // home foe expert by p'kong & admin
    public function getDataforexpert(User $user ){
        if(!isset(Auth::user()->name)){
            return view('auth/login');
        }else{
            $name=Auth::user()->name ;
            // dd ($name);
            if(Auth::user()->status_work=="admin" ||$name=="ระวีเวช จาติเกตุ" || $name=="Prem" ){
                // $data = Blockage::with('blockageLocation')->get();
                // dd($data);
                
                $data = DB::table('blockage_locations')
                ->join('blockages', 'blockages.blk_location_id', '=', 'blockage_locations.blk_location_id')
                ->join('rivers', 'rivers.river_id', '=', 'blockages.river_id')->get();
                // ->where('blockage_locations.blk_province', '=', "เชียงราย")->get();

            
                return view('expert.expert',compact('data'));
                
            }else{
                // dd("0");
                return view('pages.noexpert');
            }
        }

    }


    public function getDataforHome(User $user, Request $request){

        if(!empty($request->blk_district)){
            if(!empty($request->blk_tumbolCR) && $request->blk_tumbolCR!="sum"){
                $data = DB::table('blockage_locations')
                ->join('blockages', 'blockages.blk_location_id', '=', 'blockage_locations.blk_location_id')
                ->join('rivers', 'rivers.river_id', '=', 'blockages.river_id')
                ->where('blockage_locations.blk_province', '=', "เชียงราย")
                ->where('blockage_locations.blk_district', '=',$request->blk_district)
                ->where('blockage_locations.blk_tumbol', '=',$request->blk_tumbolCR)
                ->get();
            }else  {
                $data = DB::table('blockage_locations')
                ->join('blockages', 'blockages.blk_location_id', '=', 'blockage_locations.blk_location_id')
                ->join('rivers', 'rivers.river_id', '=', 'blockages.river_id')
                ->where('blockage_locations.blk_province', '=', "เชียงราย")
                ->where('blockage_locations.blk_district', '=',$request->blk_district)
                ->get();
            }
            
                // dd($data);


        }else{
            $data = DB::table('blockage_locations')
                ->join('blockages', 'blockages.blk_location_id', '=', 'blockage_locations.blk_location_id')
                ->join('rivers', 'rivers.river_id', '=', 'blockages.river_id')
                ->where('blockage_locations.blk_province', '=', "เชียงราย")
                ->get();
                // dd($data);
        }

        $districtData['data'] = Page::getDistrictCR();
        //  dd($districtData['data']);
        if(Auth::guest()){
            return view('pages.home',compact('data','districtData'));
        }else{
            return view('pages.test',compact('data','districtData'));
        }
        
    }


    public function solutionPDF(Request $request)
    {
        $amp_req=$request->amp;
        if ($request->amp=="sum"){
            $amp=[ 'เชียงของ','เชียงแสน','เวียงแก่น','เวียงชัย','เวียงเชียงรุ้ง','แม่จัน','แม่สาย','แม่ฟ้าหลวง','ดอยหลวง'];
                for($i=0;$i<count($amp);$i++){
                    $blk[$i] =DB::table('blockage_locations')
                    ->join('blockages', 'blockage_locations.blk_location_id', '=', 'blockages.blk_location_id')
                    ->join('rivers', 'blockages.river_id', '=', 'rivers.river_id')
                    ->join('experts', 'experts.blk_id', '=', 'blockages.blk_id')
                    ->select('blockages.blk_id','rivers.*','blockage_locations.*','experts.*',
                            \DB::raw('ST_Y(blockage_locations.blk_start_utm) as lat_utm_start'),
                            \DB::raw('ST_X(blockage_locations.blk_start_utm) as lng_utm_start')
                    )
                    ->where ('blockage_locations.blk_district',$amp[$i])
                    ->groupBy('blockages.blk_id')
                    ->get();
                    $data[$i]=['amp'=>$amp[$i],'detail'=>$blk[$i]];
                
                }
            $pix="9amp";
            $key=1;
            $pdf = PDF::loadView('expert.tablepdf' ,compact('data','pix','key'))->setPaper('a4', 'landscape');
            return $pdf->stream('solution_report.pdf');
        }else{
            $blk[0] =DB::table('blockage_locations')
            ->join('blockages', 'blockage_locations.blk_location_id', '=', 'blockages.blk_location_id')
            ->join('rivers', 'blockages.river_id', '=', 'rivers.river_id')
            ->join('experts', 'experts.blk_id', '=', 'blockages.blk_id')
            ->select('blockages.blk_id','rivers.*','blockage_locations.*','experts.*',
                    \DB::raw('ST_Y(blockage_locations.blk_start_utm) as lat_utm_start'),
                    \DB::raw('ST_X(blockage_locations.blk_start_utm) as lng_utm_start')
            )
            ->where ('blockage_locations.blk_district',$amp_req)
            ->groupBy('blockages.blk_id')
            ->get();
            $data[0]=['amp'=>$amp_req,'detail'=>$blk[0]];

            $pix=$amp_req;
            $key=2;
            $pdf = PDF::loadView('expert.tablepdf' ,compact('data','pix','key'))->setPaper('a4', 'landscape');
            return $pdf->stream('solution_report.pdf');

        }
        
    }


    public function getsolutionPDF(Request $request)
    {
        $amp_req=$request->amp;
        if ($request->amp=="sum"){
            $amp=[ 'ฝาง','แม่อาย','ไชยปราการ'];
                for($i=0;$i<count($amp);$i++){
                    $blk[$i] =DB::table('blockage_locations')
                    ->join('blockages', 'blockage_locations.blk_location_id', '=', 'blockages.blk_location_id')
                    ->join('rivers', 'blockages.river_id', '=', 'rivers.river_id')
                    ->join('experts', 'experts.blk_id', '=', 'blockages.blk_id')
                    ->select('blockages.blk_id','rivers.*','blockage_locations.*','experts.*','blockage_locations.created_at as time',
                            \DB::raw('ST_Y(blockage_locations.blk_start_utm) as lat_utm_start'),
                            \DB::raw('ST_X(blockage_locations.blk_start_utm) as lng_utm_start')
                    )
                    ->where ('blockage_locations.blk_district',$amp[$i])
                    ->groupBy('blockages.blk_id')
                    ->get();

                    // dd($blk);
                    // $data[$i]=['amp'=>$amp[$i],'detail'=>$blk[$i]];
                    for($j=0;$j<count($blk[$i]);$j++){
                        $data[$j]=[
                            'blk_id'=>$blk[$i][$j]->blk_id,
                            'river_id'=>$blk[$i][$j]->river_id,
                            'river_name'=>$blk[$i][$j]->river_name,
                            'river_type'=>$blk[$i][$j]->river_type,
                            'river_main'=>$blk[$i][$j]->river_main,
                            'blk_location_id'=>$blk[$i][$j]->blk_location_id,
                            'blk_village'=>$blk[$i][$j]->blk_village,
                            'blk_tumbol'=>$blk[$i][$j]->blk_tumbol,
                            'blk_district'=>$blk[$i][$j]->blk_district,
                            'blk_province'=>$blk[$i][$j]->blk_province,
                            'lat_utm_start'=>$blk[$i][$j]->lat_utm_start,
                            'lng_utm_start'=>$blk[$i][$j]->lng_utm_start,
                            'blk_code'=>$blk[$i][$j]->blk_code,
                            'exp_problem'=>$blk[$i][$j]->exp_problem,
                            'exp_probreport'=>$blk[$i][$j]->exp_probreport,
                            'exp_area'=>$blk[$i][$j]->exp_area,
                            'exp_L0'=>$blk[$i][$j]->exp_L0,
                            'exp_H'=>$blk[$i][$j]->exp_H,
                            'exp_C'=>$blk[$i][$j]->exp_C,
                            'exp_tc'=>$blk[$i][$j]->exp_tc,
                            'exp_returnPeriod'=>$blk[$i][$j]->exp_returnPeriod,
                            'exp_I'=>$blk[$i][$j]->exp_I,
                            'exp_maxflow'=>$blk[$i][$j]->exp_maxflow,
                            'exp_solution'=>$blk[$i][$j]->exp_solreport,
                            'exp_slope'=>$blk[$i][$j]->exp_slope,
                            'exp_a25'=>$blk[$i][$j]->exp_a25,
                            'exp_b25'=>$blk[$i][$j]->exp_b25,
                            'exp_a50'=>$blk[$i][$j]->exp_a50,
                            'exp_b50'=>$blk[$i][$j]->exp_b50,
                            'exp_pixmap'=>$blk[$i][$j]->exp_pixmap,
                            'exp_pix1'=>$blk[$i][$j]->exp_pix1,
                            'exp_pix2'=>$blk[$i][$j]->exp_pix2,
                            'date'=>$blk[$i][$j]->time
                        ];
                    }
                    $list[$i]=$data;

                
                }
            $pix="cm";
            $key=1;
            $result=[
                'data'=>$list,
                'pix'=>$pix,
                'key'=>$key
            ];
            echo json_encode($result);
            // $pdf = PDF::loadView('expert.tablepdf' ,compact('data','pix','key'))->setPaper('a4', 'landscape');
            // return $pdf->stream('solution_report.pdf');
        }else{
            $blk[0] =DB::table('blockage_locations')
            ->join('blockages', 'blockage_locations.blk_location_id', '=', 'blockages.blk_location_id')
            ->join('rivers', 'blockages.river_id', '=', 'rivers.river_id')
            ->join('experts', 'experts.blk_id', '=', 'blockages.blk_id')
            ->select('blockages.blk_id','rivers.*','blockage_locations.*','experts.*','blockage_locations.created_at as time',
                    \DB::raw('ST_Y(blockage_locations.blk_start_utm) as lat_utm_start'),
                    \DB::raw('ST_X(blockage_locations.blk_start_utm) as lng_utm_start')
            )
            ->where ('blockage_locations.blk_district',$amp_req)
            ->groupBy('blockages.blk_id')
            ->get();
            // dd($blk[0][0]);

            for($i=0;$i<count($blk[0]);$i++){
                $data[$i]=[
                    'blk_id'=>$blk[0][$i]->blk_id,
                    'river_id'=>$blk[0][$i]->river_id,
                    'river_name'=>$blk[0][$i]->river_name,
                    'river_type'=>$blk[0][$i]->river_type,
                    'river_main'=>$blk[0][$i]->river_main,
                    'blk_location_id'=>$blk[0][$i]->blk_location_id,
                    'blk_village'=>$blk[0][$i]->blk_village,
                    'blk_tumbol'=>$blk[0][$i]->blk_tumbol,
                    'blk_district'=>$blk[0][$i]->blk_district,
                    'blk_province'=>$blk[0][$i]->blk_province,
                    'lat_utm_start'=>$blk[0][$i]->lat_utm_start,
                    'lng_utm_start'=>$blk[0][$i]->lng_utm_start,
                    'blk_code'=>$blk[0][$i]->blk_code,
                    'exp_problem'=>$blk[0][$i]->exp_problem,
                    'exp_probreport'=>$blk[0][$i]->exp_probreport,
                    'exp_area'=>$blk[0][$i]->exp_area,
                    'exp_L0'=>$blk[0][$i]->exp_L0,
                    'exp_H'=>$blk[0][$i]->exp_H,
                    'exp_C'=>$blk[0][$i]->exp_C,
                    'exp_tc'=>$blk[0][$i]->exp_tc,
                    'exp_returnPeriod'=>$blk[0][$i]->exp_returnPeriod,
                    'exp_I'=>$blk[0][$i]->exp_I,
                    'exp_maxflow'=>$blk[0][$i]->exp_maxflow,
                    'exp_solution'=>$blk[0][$i]->exp_solreport,
                    'exp_slope'=>$blk[0][$i]->exp_slope,
                    'exp_a25'=>$blk[0][$i]->exp_a25,
                    'exp_b25'=>$blk[0][$i]->exp_b25,
                    'exp_a50'=>$blk[0][$i]->exp_a50,
                    'exp_b50'=>$blk[0][$i]->exp_b50,
                    'exp_pixmap'=>$blk[0][$i]->exp_pixmap,
                    'exp_pix1'=>$blk[0][$i]->exp_pix1,
                    'exp_pix2'=>$blk[0][$i]->exp_pix2,
                    'date'=>$blk[0][$i]->time
                ];
            }
            // dd($data);

            // $data=['amp'=>$amp_req,
            //           'detail'=>$blk[0]
            //         ];

            $pix=$amp_req;
            $key=2;
            
            $result=[
                'data'=>$data,
                'pix'=>$pix,
                'key'=>$key
            ];
            echo json_encode($result);
            // $pdf = PDF::loadView('expert.tablepdf' ,compact('data','pix','key'))->setPaper('a4', 'landscape');
            // return $pdf->stream('solution_report.pdf');

        }
        
    }



    public function solutionPDFgen(Request $request)
    {
        $amp_req=$request->amp;
        if ($request->amp=="sum"){
            $amp=[ 'เชียงของ','เชียงแสน','เวียงแก่น','เวียงชัย','เวียงเชียงรุ้ง','แม่จัน','แม่สาย','แม่ฟ้าหลวง','ดอยหลวง'];
                for($i=0;$i<count($amp);$i++){
                    $blk[$i] =DB::table('blockage_locations')
                    ->join('blockages', 'blockage_locations.blk_location_id', '=', 'blockages.blk_location_id')
                    ->join('rivers', 'blockages.river_id', '=', 'rivers.river_id')
                    ->join('experts', 'experts.blk_id', '=', 'blockages.blk_id')
                    ->select('blockages.blk_id','rivers.*','blockage_locations.*','experts.*',
                            \DB::raw('ST_Y(blockage_locations.blk_start_utm) as lat_utm_start'),
                            \DB::raw('ST_X(blockage_locations.blk_start_utm) as lng_utm_start')
                    )
                    ->where ('blockage_locations.blk_district',$amp[$i])
                    ->groupBy('blockages.blk_id')
                    ->get();
                    $data[$i]=['amp'=>$amp[$i],'detail'=>$blk[$i]];
                
                }
            // dd($data);
            $pix="9amp.jpg";
            $key=1;
            $pdf = PDF::loadView('expert.tablepdf' ,compact('data','pix','key'))->setPaper('a4', 'landscape');
            return $pdf->stream('solution_report.pdf');
        }else{
            if($request->tumbol=="sum"){
                $blk[0] =DB::table('blockage_locations')
                ->join('blockages', 'blockage_locations.blk_location_id', '=', 'blockages.blk_location_id')
                ->join('rivers', 'blockages.river_id', '=', 'rivers.river_id')
                ->join('experts', 'experts.blk_id', '=', 'blockages.blk_id')
                ->select('blockages.blk_id','rivers.*','blockage_locations.*','experts.*',
                        \DB::raw('ST_Y(blockage_locations.blk_start_utm) as lat_utm_start'),
                        \DB::raw('ST_X(blockage_locations.blk_start_utm) as lng_utm_start')
                )
                ->where ('blockage_locations.blk_district',$amp_req)
                ->groupBy('blockages.blk_id')
                ->get();
                $data[0]=['amp'=>$amp_req,'detail'=>$blk[0]];

                $pix=$amp_req.".jpg";
                $key=2;
                $pdf = PDF::loadView('expert.tablepdf' ,compact('data','pix','key'))->setPaper('a4', 'landscape');
                return $pdf->stream('solution_report.pdf');
            }else{
                $blk[0] =DB::table('blockage_locations')
                ->join('blockages', 'blockage_locations.blk_location_id', '=', 'blockages.blk_location_id')
                ->join('rivers', 'blockages.river_id', '=', 'rivers.river_id')
                ->join('experts', 'experts.blk_id', '=', 'blockages.blk_id')
                ->select('blockages.blk_id','rivers.*','blockage_locations.*','experts.*',
                        \DB::raw('ST_Y(blockage_locations.blk_start_utm) as lat_utm_start'),
                        \DB::raw('ST_X(blockage_locations.blk_start_utm) as lng_utm_start')
                )
                ->where ('blockage_locations.blk_district',$amp_req)
                ->where ('blockage_locations.blk_tumbol',$request->tumbol)
                ->groupBy('blockages.blk_id')
                ->get();
                $data[0]=['amp'=>$amp_req,'detail'=>$blk[0]];

                $pix=$amp_req."/".$request->tumbol.".png";
                // dd($pix);
                $key=2;
                $pdf = PDF::loadView('expert.tablepdf' ,compact('data','pix','key'))->setPaper('a4', 'landscape');
                return $pdf->stream('solution_report.pdf');

            }
            

        }
        
    }
    

}
