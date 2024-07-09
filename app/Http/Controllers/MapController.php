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
use DB;
use Auth;
use Grimzy\LaravelMysqlSpatial\Types\Point;
ini_set("memory_limit","521M");
class MapController extends Controller
{
    public function map()
    {
        return view('form.map');
    }

    public function getBlockageMap() {
        $data = Blockage::with('blockageLocation','blockageCrossection','River','Solution','Photo')->get();
        //return response()->json($data);
       
        $result=[];
        $properties['time']=[];
        
        for ($i=0;$i<count($data);$i++){
            //$locationSt = new Point($request->latstart,$request->longstart);
            
            $point =($data[0]->blk_start_location);
            if($data[$i]->blockageLocation->blk_province=="เชียงราย"){
                $result[] = [
                    'id' => $data[$i]->blk_id,
                    'type' => "Feature",
                    'properties' => [
                        'time'=> date($data[$i]->updated_at),
                        'blk_code'=> $data[$i]->blk_code,
                        'blk_id'=>$data[$i]->blk_id,
                        'river'=>$data[$i]->River->river_name,
                        'location'=>$data[$i]->blockageLocation->blk_village,
                        'tambol'=> $data[$i]->blockageLocation->blk_tumbol , 
                        'district'=>$data[$i]->blockageLocation->blk_district ],
                         'geometry'=> $data[$i]->blockageLocation->blk_start_location
                ];
            }
                       
         }
        $test['type']="FeatureCollection";
        $test['features']=$result;
        //dd($test);
         $test = json_encode($test);
         echo $test;
        //return response()->json($data);
        
    }

    // Get Level Damage
    public function getDamage($amp=0) {
        header('Access-Control-Allow-Origin: *');
        function checkRisk($level,$fq){
            if($level=="มาก"){
                $l=3;
            }else if($level=="ปานกลาง"){
                $l=2;
            }else{
                $l=1;
            }

            if($fq=="ทุกปี"){
                $f=3;
            }else if($fq=="2-4 ปีครั้ง"){
                $f=2;
            }else{
                $f=1;
            }
            
            $cal=$l*$f;

            if($cal<3){
                return "น้อย";
            }
            else if($cal<6){
                return "ปานกลาง";
            }else{
                return "มาก";
            }
        }
        function checklevel($flood,$waste,$other) {
            if($flood!=NULL||$flood!=0){
                if($flood=="low"){
                    $level="น้อย";
                }else if( $flood=="medium"){
                    $level="ปานกลาง";
                }else if( $flood=="high") {
                    $level="มาก";
                }else{
                    $level=NULL;
                }
            }else if($waste!=NULL||$waste!=0){
                if($waste=="low"){
                    $level="น้อย";
                }else if( $waste=="medium"){
                    $level="ปานกลาง";
                }else if( $waste=="high") {
                    $level="มาก";
                }else{
                    $level=NULL;
                }

            }else if($other!=NULL||$other!=0){
                if($other=="low"){
                    $level="น้อย";
                }else if( $other=="medium"){
                    $level="ปานกลาง";
                }else if( $other=="high") {
                    $level="มาก";
                }else{
                    $level=NULL;
                }
            }
                return $level;
        }
        //$data = Blockage::with('blockageLocation','blockageCrossection','River','Solution','Photo')->get();
        $data = BlockageLocation::with('blockage','blockage.River')->where('blk_district',$amp)->get();
       
        //return response()->json($data);
        //dd($data);
        $result=[];
        $properties['time']=[];
        
        for ($i=0;$i<count($data);$i++){
            //$locationSt = new Point($request->latstart,$request->longstart);
            if($data[$i]->blockage){
                $fq = ProblemDetail::select('prob_level')->where ('problem_details.blk_id', $data[$i]->blockage->blk_id)->get();
                //dd($fq);
                // $point =($data[0]->blk_start_location);
                $damage=$data[$i]->blockage->damage_level;
                $damageData=json_decode($damage);
                //dd($damage);
                $level=checklevel($damageData->flood,$damageData->waste,$damageData->other->level);
                $risk=checkRisk($level,$data[$i]->blockage->damage_frequency);

                    $result[] = [
                        'id' => $data[$i]->blockage->blk_id,
                        'time'=> date($data[$i]->blockage->updated_at),
                        'blk_code'=> $data[$i]->blockage->blk_code,
                        'blk_id'=>$data[$i]->blockage->blk_id,
                        'river'=>$data[$i]->blockage->River->river_name,
                        'location'=>$data[$i]->blk_village,
                        'tambol'=> $data[$i]->blk_tumbol , 
                        'district'=>$data[$i]->blk_district,
                        'geometry'=> $data[$i]->blk_start_location,
                        'level'=>$risk];
             }
            
        }

        // $test['type']="FeatureCollection";
        // $test['features']=$result;
    
         $result = json_encode($result);
         echo $result;
        //return response()->json($data);
        
    }

    public function getDamage_test($amp=0) {

        function checkRisk($level,$fq){
            if($level=="มาก"){
                $l=3;
            }else if($level=="ปานกลาง"){
                $l=2;
            }else{
                $l=1;
            }

            if($fq=="ทุกปี"){
                $f=3;
            }else if($fq=="2-4 ปีครั้ง"){
                $f=2;
            }else{
                $f=1;
            }
            
            $cal=$l*$f;

            if($cal<3){
                return "1";
            }
            else if($cal<6){
                return "2";
            }else{
                return "3";
            }
        }
        function checklevel($flood,$waste,$other) {
            if($flood!=NULL||$flood!=0){
                if($flood=="low"){
                    $level="น้อย";
                }else if( $flood=="medium"){
                    $level="ปานกลาง";
                }else if( $flood=="high") {
                    $level="มาก";
                }else{
                    $level=NULL;
                }
            }else if($waste!=NULL||$waste!=0){
                if($waste=="low"){
                    $level="น้อย";
                }else if( $waste=="medium"){
                    $level="ปานกลาง";
                }else if( $waste=="high") {
                    $level="มาก";
                }else{
                    $level=NULL;
                }

            }else if($other!=NULL||$other!=0){
                if($other=="low"){
                    $level="น้อย";
                }else if( $other=="medium"){
                    $level="ปานกลาง";
                }else if( $other=="high") {
                    $level="มาก";
                }else{
                    $level=NULL;
                }
            }
                return $level;
        }
        $amp=["เชียงของ","เชียงแสน","เวียงแก่น","เวียงชัย","เวียงเชียงรุ้ง","แม่จัน","แม่สาย","แม่ฟ้าหลวง","ดอยหลวง"];
        for($i=0;$i<count($amp);$i++){
            $data[$i] = BlockageLocation::with('blockage','blockage.River')->where('blk_district',$amp[$i])->get();
            
                $result=[];
                $properties['time']=[];
                $Level1=0;
                $Level2=0;
                $Level3=0;
                // dd($data[$i]);

                for ($j=0;$j<count($data[$i]);$j++){
                        // dd($data[$i][$j]->blockage->damage_level);
                        $damage=$data[$i][$j]->blockage->damage_level;
                       
                        $damageData=json_decode($damage);
                        
                        $level=checklevel($damageData->flood,$damageData->waste,$damageData->other->level);
                        $risk=checkRisk($level,$data[$i][$j]->blockage->damage_frequency);
                        
                        if($risk==3){
                            $Level3=$Level3+1;
                        }else if($risk==2){
                            $Level2=$Level2+1;
                        }else{
                            $Level1=$Level1+1;
                        }
                        
                }
                $result[] = [
                    'district'=>$amp[$i],
                    'level1'=>$Level1,
                    'level2'=>$Level2,
                    'level3'=>$Level3
                ];
                // dd($result);
        }
                
    
         $result = json_encode($result);
         echo $result;
        //return response()->json($data);
        
    }

    public function getDamageByAmp() {
        // $amp=["เชียงของ","เชียงแสน","เวียงแก่น","เวียงชัย","เวียงเชียงรุ้ง","แม่จัน","แม่สาย","แม่ฟ้าหลวง","ดอยหลวง"];
        // $level1=0;$level2=0;$level3=0;
        // $ampL1=0;$ampL2=0;$ampL3=0;
        // for($i=0;$i<count($amp);$i++){
        //     $data[$i] =DB::table('blockage_locations')
        //     ->join('blockages', 'blockage_locations.blk_location_id', '=', 'blockages.blk_location_id')
        //     ->join('problem_details', 'blockages.blk_id', '=', 'problem_details.blk_id')
        //     ->select('blockage_locations.blk_district',\DB::raw('count(problem_details.prob_level) as count'),'problem_details.prob_level')
        //     ->where ('blockage_locations.blk_district',$amp[$i])
        //     ->groupBy ('problem_details.prob_level')->get();

        //     $data[$i]->amp=$amp[$i];
        //     $data[$i]->level1=0;
        //     $data[$i]->level2=0;
        //     $data[$i]->level3=0;
        //     // dd($data[$i]);
        //     for($j=0;$j<count($data[$i]);$j++){

        //         if($data[$i][$j]->prob_level=="1-30%"){
        //             $data[$i]->level1=$data[$i][$j]->count;
        //             $ampL1=$ampL1+$data[$i]->level1;
        //         }else if($data[$i][$j]->prob_level=="30-70%"){
        //             $data[$i]->level2=$data[$i][$j]->count;
        //             $ampL2=$ampL2+$data[$i]->level2;
        //         }else if($data[$i][$j]->prob_level=="มากกว่า 70%"){
        //             $data[$i]->level3=$data[$i][$j]->count;
        //             $ampL3=$ampL3+ $data[$i]->level3;
        //         }
        //     }
         

        // }

        function checkRisk($level,$fq){
            if($level=="มาก"){
                $l=3;
            }else if($level=="ปานกลาง"){
                $l=2;
            }else{
                $l=1;
            }

            if($fq=="ทุกปี"){
                $f=3;
            }else if($fq=="2-4 ปีครั้ง"){
                $f=2;
            }else{
                $f=1;
            }
            
            $cal=$l*$f;

            if($cal<3){
                return "1";
            }
            else if($cal<6){
                return "2";
            }else{
                return "3";
            }
        }
        function checklevel($flood,$waste,$other) {
            if($flood!=NULL||$flood!=0){
                if($flood=="low"){
                    $level="น้อย";
                }else if( $flood=="medium"){
                    $level="ปานกลาง";
                }else if( $flood=="high") {
                    $level="มาก";
                }else{
                    $level=NULL;
                }
            }else if($waste!=NULL||$waste!=0){
                if($waste=="low"){
                    $level="น้อย";
                }else if( $waste=="medium"){
                    $level="ปานกลาง";
                }else if( $waste=="high") {
                    $level="มาก";
                }else{
                    $level=NULL;
                }

            }else if($other!=NULL||$other!=0){
                if($other=="low"){
                    $level="น้อย";
                }else if( $other=="medium"){
                    $level="ปานกลาง";
                }else if( $other=="high") {
                    $level="มาก";
                }else{
                    $level=NULL;
                }
            }
                return $level;
        }
        $amp=["เชียงของ","เชียงแสน","เวียงแก่น","เวียงชัย","เวียงเชียงรุ้ง","แม่จัน","แม่สาย","แม่ฟ้าหลวง","ดอยหลวง"];
        // $amp=["แม่จัน"];
        $result=[];
        $sum1=0;
        $sum2=0;
        $sum3=0;
        for($i=0;$i<count($amp);$i++){
            $data[$i] = BlockageLocation::with('blockage','blockage.River')->where('blk_district',$amp[$i])->get();
                $Level1=0;
                $Level2=0;
                $Level3=0;
                $damage=NULL;
                // for ($j=0;$j<count($data[$i]);$j++){
                for ($j=0;$j<count($data[$i]);$j++){
                    // dd($data[$i][38]);
                    $damage=$data[$i][$j]->blockage->damage_level;
                    $damageData=json_decode($damage);
                    $level=checklevel($damageData->flood,$damageData->waste,$damageData->other->level);
                    $risk=checkRisk($level,$data[$i][$j]->blockage->damage_frequency);
                    if($risk==3){
                        $Level3=$Level3+1;
                    }else if($risk==2){
                        $Level2=$Level2+1;
                    }else{
                        $Level1=$Level1+1;
                    }
                    
                }
                $result[$i] = [
                    'amp'=>$amp[$i],
                    'level1'=>$Level1,
                    'level2'=>$Level2,
                    'level3'=>$Level3
                ];
                $sum1=$sum1+$Level1;
                $sum2=$sum2+$Level2;
                $sum3=$sum3+$Level3;
                // dd($result);
        }
        

        //  dd($result[0]['amp']);
         return view('pages.testmap', compact('result','sum1','sum2','sum3'));
        
    }


    public function getDamageByAmpG() {
        function checkRisk($level,$fq){
            if($level=="มาก"){
                $l=3;
            }else if($level=="ปานกลาง"){
                $l=2;
            }else{
                $l=1;
            }

            if($fq=="ทุกปี"){
                $f=3;
            }else if($fq=="2-4 ปีครั้ง"){
                $f=2;
            }else{
                $f=1;
            }
            
            $cal=$l*$f;

            if($cal<3){
                return "1";
            }
            else if($cal<6){
                return "2";
            }else{
                return "3";
            }
        }
        function checklevel($flood,$waste,$other) {
            if($flood!=NULL||$flood!=0){
                if($flood=="low"){
                    $level="น้อย";
                }else if( $flood=="medium"){
                    $level="ปานกลาง";
                }else if( $flood=="high") {
                    $level="มาก";
                }else{
                    $level=NULL;
                }
            }else if($waste!=NULL||$waste!=0){
                if($waste=="low"){
                    $level="น้อย";
                }else if( $waste=="medium"){
                    $level="ปานกลาง";
                }else if( $waste=="high") {
                    $level="มาก";
                }else{
                    $level=NULL;
                }

            }else if($other!=NULL||$other!=0){
                if($other=="low"){
                    $level="น้อย";
                }else if( $other=="medium"){
                    $level="ปานกลาง";
                }else if( $other=="high") {
                    $level="มาก";
                }else{
                    $level=NULL;
                }
            }
                return $level;
        }
        // $amp=["เมืองเชียงราย"];
        $amp=["เชียงของ","เชียงแสน","เวียงแก่น","เวียงชัย","เวียงเชียงรุ้ง","แม่จัน","แม่สาย","แม่ฟ้าหลวง","ดอยหลวง","เมืองเชียงราย","ป่าแดด","แม่ลาว","แม่สรวย","เวียงป่าเป้า","พญาเม็งราย","เทิง","พาน","ขุนตาล"];

        $result=[];
        $sum1=0;
        $sum2=0;
        $sum3=0;
        $phase1_1=0;
        $phase1_2=0;
        $phase1_3=0;
        $phase2_1=0;
        $phase2_2=0;
        $phase2_3=0;
        for($i=0;$i<count($amp);$i++){
            $data[$i] = BlockageLocation::with('blockage','blockage.River')->where('blk_district',$amp[$i])->get();
            // dd($data[$i]);
                $Level1=0;
                $Level2=0;
                $Level3=0;
                $damage=NULL;
                // for ($j=0;$j<count($data[$i]);$j++){
                for ($j=0;$j<count($data[$i]);$j++){
                    if(!empty($data[$i][$j]->blockage->damage_level)){
                        $damage=$data[$i][$j]->blockage->damage_level;
                        $damageData=json_decode($damage);
                        $level=checklevel($damageData->flood,$damageData->waste,$damageData->other->level);
                        $risk=checkRisk($level,$data[$i][$j]->blockage->damage_frequency);
                    }else{
                        $risk=0;

                    }
                    
                    
                    if($risk==3){
                        $Level3=$Level3+1;
                    }else if($risk==2){
                        $Level2=$Level2+1;
                    }else{
                        $Level1=$Level1+1;
                    }
                    
                }
                $result[$i] = [
                    'amp'=>$amp[$i],
                    'level1'=>$Level1,
                    'level2'=>$Level2,
                    'level3'=>$Level3
                ];

                $sum1=$sum1+$Level1;
                $sum2=$sum2+$Level2;
                $sum3=$sum3+$Level3;
                if($i<9){
                    $phase1_1=$phase1_1+$Level1;
                    $phase1_2=$phase1_2+$Level2;
                    $phase1_3=$phase1_3+$Level3; 
                }else{
                    $phase2_1=$phase2_1+$Level1;
                    $phase2_2=$phase2_2+$Level2;
                    $phase2_3=$phase2_3+$Level3; 
                }
                // dd($result);
        }
        

        //  dd($result[0]['amp']);
         return view('general.map', compact('result','sum1','sum2','sum3','phase1_1','phase1_2','phase1_3','phase2_1','phase2_2','phase2_3'));
        
    }

    // Fang -------------------------------

    // Get Level Damage
    public function getDamageCM($amp=0) {
        header('Access-Control-Allow-Origin: *');
       $data = BlockageLocation::with('blockage','blockage.River')->where('blk_district',$amp)
       ->where('blk_province',"เชียงใหม่")->get();
       
        $result=[];
        $properties['time']=[];
        
        for ($i=0;$i<count($data);$i++){
            //$locationSt = new Point($request->latstart,$request->longstart);
            if($data[$i]->blockage){
                $fq = ProblemDetail::select('prob_level')->where ('problem_details.blk_id', $data[$i]->blockage->blk_id)->get();
                //dd($fq);
                // $point =($data[0]->blk_start_location);
                
                    $result[] = [
                        'id' => $data[$i]->blockage->blk_id,
                        'time'=> date($data[$i]->blockage->updated_at),
                        'blk_code'=> $data[$i]->blockage->blk_code,
                        'blk_id'=>$data[$i]->blockage->blk_id,
                        'river'=>$data[$i]->blockage->River->river_name,
                        'location'=>$data[$i]->blk_village,
                        'tambol'=> $data[$i]->blk_tumbol , 
                        'district'=>$data[$i]->blk_district,
                        'geometry'=> $data[$i]->blk_start_location,
                        'level'=>$fq[0]->prob_level];
             }
            
        }
         $result = json_encode($result);
         echo $result;

         
        
    }


    public function getDamageByAmpCM() {
      
        function checkRisk($level,$fq){
            if($level=="มาก"){
                $l=3;
            }else if($level=="ปานกลาง"){
                $l=2;
            }else{
                $l=1;
            }

            if($fq=="ทุกปี"){
                $f=3;
            }else if($fq=="2-4 ปีครั้ง"){
                $f=2;
            }else{
                $f=1;
            }
            
            $cal=$l*$f;

            if($cal<3){
                return "1";
            }
            else if($cal<6){
                return "2";
            }else{
                return "3";
            }
        }
        function checklevel($flood,$waste,$other) {
            if($flood!=NULL||$flood!=0){
                if($flood=="low"){
                    $level="น้อย";
                }else if( $flood=="medium"){
                    $level="ปานกลาง";
                }else if( $flood=="high") {
                    $level="มาก";
                }else{
                    $level=NULL;
                }
            }else if($waste!=NULL||$waste!=0){
                if($waste=="low"){
                    $level="น้อย";
                }else if( $waste=="medium"){
                    $level="ปานกลาง";
                }else if( $waste=="high") {
                    $level="มาก";
                }else{
                    $level=NULL;
                }

            }else if($other!=NULL||$other!=0){
                if($other=="low"){
                    $level="น้อย";
                }else if( $other=="medium"){
                    $level="ปานกลาง";
                }else if( $other=="high") {
                    $level="มาก";
                }else{
                    $level=NULL;
                }
            }
                return $level;
        }
        $amp=["ฝาง","ไชยปราการ","แม่อาย"];
        // $amp=["แม่จัน"];
        $result=[];
        $sum1=0;
        $sum2=0;
        $sum3=0;
        for($i=0;$i<count($amp);$i++){
            $data[$i] = BlockageLocation::with('blockage','blockage.River')->where('blk_district',$amp[$i])->get();
                $Level1=0;
                $Level2=0;
                $Level3=0;
                $damage=NULL;
                // for ($j=0;$j<count($data[$i]);$j++){
                for ($j=0;$j<count($data[$i]);$j++){
                    // dd($data[$i][38]);
                    $damage=$data[$i][$j]->blockage->damage_level;
                    $damageData=json_decode($damage);
                    $level=checklevel($damageData->flood,$damageData->waste,$damageData->other->level);
                    $risk=checkRisk($level,$data[$i][$j]->blockage->damage_frequency);
                    if($risk==3){
                        $Level3=$Level3+1;
                    }else if($risk==2){
                        $Level2=$Level2+1;
                    }else{
                        $Level1=$Level1+1;
                    }
                    
                }
                $result[$i] = [
                    'amp'=>$amp[$i],
                    'level1'=>$Level1,
                    'level2'=>$Level2,
                    'level3'=>$Level3
                ];
                $sum1=$sum1+$Level1;
                $sum2=$sum2+$Level2;
                $sum3=$sum3+$Level3;
                // dd($result);
        }
       
        $data=[
            'result'=>$result,
            'sum1'=>$sum1,
            'sum2'=>$sum2,
            'sum3'=>$sum3

        ];

         echo json_encode($data);
         exit;
        //dd($data);
        // return view('pages.testmap', compact('data','ampL1','ampL2','ampL3'));
        
    }

    // Map Fang in Blockages Chiang Rai
    public function getDamageByAmpFang() {
        $amp=["ฝาง","ไชยปราการ","แม่อาย"];
        $level1=0;$level2=0;$level3=0;
        $ampL1=0;$ampL2=0;$ampL3=0;
        for($i=0;$i<count($amp);$i++){
            $data[$i] =DB::table('blockage_locations')
            ->join('blockages', 'blockage_locations.blk_location_id', '=', 'blockages.blk_location_id')
            ->join('problem_details', 'blockages.blk_id', '=', 'problem_details.blk_id')
            ->select('blockage_locations.blk_district',\DB::raw('count(problem_details.prob_level) as count'),'problem_details.prob_level')
            ->where ('blockage_locations.blk_district',$amp[$i])
            ->groupBy ('problem_details.prob_level')->get();
            $data[$i]->amp=$amp[$i];
            $data[$i]->level1=0;
            $data[$i]->level2=0;
            $data[$i]->level3=0;
            for($j=0;$j<count($data[$i]);$j++){
                if($data[$i][$j]->prob_level=="1-30%"){
                    $data[$i]->level1=$data[$i][$j]->count;
                    $ampL1=$ampL1+$data[$i]->level1;
                }else if($data[$i][$j]->prob_level=="30-70%"){
                    $data[$i]->level2=$data[$i][$j]->count;
                    $ampL2=$ampL2+$data[$i]->level2;
                }else if($data[$i][$j]->prob_level=="มากกว่า 70%"){
                    $data[$i]->level3=$data[$i][$j]->count;
                    $ampL3=$ampL3+ $data[$i]->level3;
                }
            }
         

        }
        

        //dd($data);
         return view('fang.map', compact('data','ampL1','ampL2','ampL3'));
        
    }

    // Location spacific Pin 
    public function getLocation($id=0){
        header('Access-Control-Allow-Origin: *');
        $blk_id=$id;
        $data =  Blockage::where('blk_id', $blk_id)->get();
        $location =BlockageLocation::where('blk_location_id', $data[0]->blk_location_id)->get();
      
        
        // dd($location[0]->blk_start_location->getLat());
        return view('expert.mapshow',compact('data','location'));

    }
    

}
