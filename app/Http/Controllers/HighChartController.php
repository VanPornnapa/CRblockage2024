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
use DB;
use Auth;
use App\User;

class HighChartController extends Controller
{
    public function index(Request $request)
    {
        //dd($request->amp);
        if($request->amp=="อำเภอทั้งหมด"){
            $countNum =DB::table('blockage_locations')
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
            ->where('blockage_locations.blk_province', '=', "เชียงราย")
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
                    ->where('blockage_locations.blk_province', '=', "เชียงราย")
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
            $amp = "จังหวัดเชียงราย";
            $amp1 = "อำเภอทั้งหมด";
                    
            return view('chart/chart', compact('countNum','countBar','amp','amp1'));

        }else{
            if($request->amp=="ระยะ1"){
                $countNum =DB::table('blockage_locations')
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
                    ->where('blockage_locations.blk_province', '=', "เชียงราย")
                    ->where('blockage_locations.blk_location_id', '<', "L00263")
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
                    ->where('blockage_locations.blk_province', '=', "เชียงราย")
                    ->where('blockage_locations.blk_location_id', '<', "L00263")
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
                $amp = "จังหวัดเชียงราย (ระยะ1)";
                $amp1 = "อำเภอ (ระยะ1)";
                // dd($countNum);

            }else if($request->amp=="ระยะ2"){
                $countNum =DB::table('blockage_locations')
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
                    ->where('blockage_locations.blk_province', '=', "เชียงราย")
                    ->where('blockage_locations.blk_location_id', '>=', "L00375")
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
                    ->where('blockage_locations.blk_province', '=', "เชียงราย")
                    ->where('blockage_locations.blk_location_id', '>=', "L00375")
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
                $amp = "จังหวัดเชียงราย (ระยะ2)";
                $amp1 = "อำเภอ (ระยะ2)";
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
                ->where('blockage_locations.blk_district', '=', $request->amp)
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
                    ->where('blockage_locations.blk_district', '=', $request->amp)
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

                    //dd($countNum);
                    $amp = "อำเภอ".$request->amp." จังหวัดเชียงราย";
                    $amp1 = $request->amp;
            }
            return view('chart/chart', compact('countNum','amp','countBar','amp1'));

        }
        
    }


    public function indexAll(Request $request)
    {
        //dd($request->amp);
        if($request->amp=="อำเภอทั้งหมด"){
            $countNum =DB::table('blockage_locations')
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
            ->where('blockage_locations.blk_province', '=', "เชียงราย")
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
                    ->where('blockage_locations.blk_province', '=', "เชียงราย")
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
            $amp = " จังหวัดเชียงราย ";
            $amp1 = " อำเภอทั้งหมด ";
                    
            return view('chart/chart_Allsee', compact('countNum','countBar','amp','amp1'));

        }else{
            if($request->amp=="ระยะ1"){
                $countNum =DB::table('blockage_locations')
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
                    ->where('blockage_locations.blk_province', '=', "เชียงราย")
                    ->where('blockage_locations.blk_location_id', '<', "L00263")
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
                    ->where('blockage_locations.blk_province', '=', "เชียงราย")
                    ->where('blockage_locations.blk_location_id', '<', "L00263")
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
                $amp = "จังหวัดเชียงราย (ระยะ1)";
                $amp1 = "อำเภอ (ระยะ1)";
                // dd($countNum);

            }else if($request->amp=="ระยะ2"){
                $countNum =DB::table('blockage_locations')
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
                    ->where('blockage_locations.blk_province', '=', "เชียงราย")
                    ->where('blockage_locations.blk_location_id', '>=', "L00263")
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
                    ->where('blockage_locations.blk_province', '=', "เชียงราย")
                    ->where('blockage_locations.blk_location_id', '>=', "L00263")
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
                $amp = "จังหวัดเชียงราย (ระยะ2)";
                $amp1 = "อำเภอ (ระยะ2)";
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
                ->where('blockage_locations.blk_district', '=', $request->amp)
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
                ->where('blockage_locations.blk_district', '=', $request->amp)
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

                //dd($countNum);
                $amp = "อำเภอ".$request->amp." จังหวัดเชียงราย";
                $amp1 = $request->amp;

            }
                
            return view('chart/chart_Allsee', compact('countNum','amp','countBar','amp1'));

        }
        
    }

    public function prob($amp=0)
    {
        // $data =BlockageLocation::with('Blockage','Blockage.ProblemDetail')
        //         ->where('blk_district',$amp)
        //         ->get();
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
        $countNum=[["สาเหตุจากธรรมชาติ",$nat],["สาเหตุจากมุนษย์",$hum]];
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

        //dd($countNum);
        $amp = "อำเภอ".$amp."จังหวัดเชียงราย";
        $amp1 = $amp;
        return view('chart/chart', compact('countNum','amp','countBar','amp1'));
    }

    public function probAll($amp=0)
    {
        // $data =BlockageLocation::with('Blockage','Blockage.ProblemDetail')
        //         ->where('blk_district',$amp)
        //         ->get();
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
        $countNum=[["สาเหตุจากธรรมชาติ",$nat],["สาเหตุจากมุนษย์",$hum]];
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

        //dd($countNum);
        $amp = "อำเภอ".$amp."จังหวัดเชียงราย";
        return view('chart/chart_Allsee', compact('countNum','amp','countBar'));
    }

    public function chartAll()
    {
        $countbar = ProblemDetail::select(\DB::raw("COUNT(nat_erosion) as nat_erosion, COUNT(nat_shoal) as nat_shoal,
                    COUNT(nat_missing) as nat_missing,
                    COUNT(nat_winding) as nat_winding,
                    COUNT(nat_weed) as nat_weed,
                    COUNT(nat_weed_detail) as nat_weed_detail,
                    COUNT(nat_other) as nat_other,
                    COUNT(hum_stc_bld_num) as hum_stc_bld_num,
                    COUNT(hum_stc_fence_num) as hum_stc_fence_num,
                    COUNT(hum_str_other) as hum_str_other,
                    COUNT(hum_stc_bld_bu_num) as hum_stc_bld_bu_num,
                    COUNT(hum_stc_fence_bu_num) as hum_stc_fence_bu_num,
                    COUNT(hum_str_other_bu) as hum_str_other_bu,
                    COUNT(hum_road) as hum_road,
                    COUNT(hum_smallconvert) as hum_smallconvert,
                    COUNT(hum_road_paralel) as hum_road_paralel,
                    COUNT(hum_replaced_convert) as hum_replaced_convert,
                    COUNT(hum_bridge_pile) as hum_bridge_pile,
                    COUNT(hum_soil_cover) as hum_soil_cover,
                    COUNT(hum_trash) as hum_trash,
                    COUNT(hum_other) as hum_other"))->get();
        //dd($countNum);

        $countbar=[["ตลิ่งพังการกัดเซาะ",$countbar[0]->nat_erosion],
                   ["การทับถมของตะกอน (ลำน้ำตื้นเขิน)",$countbar[0]->nat_shoal],
                   ["ลำน้ำขาดหาย",$countbar[0]->nat_missing],
                   ["ลำน้ำคดเคี้ยวมาก",$countbar[0]->nat_winding],
                   ["วัชพืช",$countbar[0]->nat_weed],
                   ["อื่นๆ(ธรรมชาติ)",$countbar[0]->nat_other],
                   ["ส่วนอาคาร(ราชการ)",$countbar[0]->hum_stc_bld_num],
                    ["รั้ว(ราชการ)",$countbar[0]->hum_stc_fence_num],
                    ["อื่นๆ(ราชการ)",$countbar[0]->hum_str_other],
                    ["ส่วนอาคาร(เอกชน)",$countbar[0]->hum_stc_bld_bu_num],
                    ["รั้ว(เอกชน)",$countbar[0]->hum_stc_fence_bu_num],
                    ["อื่นๆ(เอกชน)",$countbar[0]->hum_str_other_bu],
                    ["ถนนขวางทางน้ำ",$countbar[0]->hum_road],
                    ["ท่อลอดถนนที่ตัดลำน้ำฯ",$countbar[0]->hum_smallconvert],
                    ["ถนนขนานลำน้ำสร้างกินพื้นที่ลำน้ำ",$countbar[0]->hum_road_paralel],
                    ["วางท่อตามแนวลำน้ำทดแทนลำน้ำเดิม",$countbar[0]->hum_replaced_convert],
                    ["สะพานมีหน้าตัดแคบเกินไป",$countbar[0]->hum_bridge_pile],
                    ["การถมดิน",$countbar[0]->hum_soil_cover],
                    ["สิ่งปฏิกูล",$countbar[0]->hum_trash],
                    ["อื่นๆ(มนุษย์)",$countbar[0]->hum_other]
                  ];
           // dd($countbar);    
        return view('chart/chartBar', compact('countbar'));
    }

    public function chartAmp($amp=0)
    {
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
        //dd($countNum);

        $countNum=[["ตลิ่งพังการกัดเซาะ",$countNum[0]->nat_erosion],
                   ["การทับถมของตะกอน (ลำน้ำตื้นเขิน)",$countNum[0]->nat_shoal],
                   ["ลำน้ำขาดหาย",$countNum[0]->nat_missing],
                   ["ลำน้ำคดเคี้ยวมาก",$countNum[0]->nat_winding],
                   ["วัชพืช",$countNum[0]->nat_weed],
                   ["อื่นๆ(ธรรมชาติ)",$countNum[0]->nat_other],
                   ["ส่วนอาคาร(ราชการ)",$countNum[0]->hum_stc_bld_num],
                    ["รั้ว(ราชการ)",$countNum[0]->hum_stc_fence_num],
                    ["อื่นๆ(ราชการ)",$countNum[0]->hum_str_other],
                    ["ส่วนอาคาร(เอกชน)",$countNum[0]->hum_stc_bld_bu_num],
                    ["รั้ว(เอกชน)",$countNum[0]->hum_stc_fence_bu_num],
                    ["อื่นๆ(เอกชน)",$countNum[0]->hum_str_other_bu],
                    ["ถนนขวางทางน้ำ",$countNum[0]->hum_road],
                    ["ท่อลอดถนนที่ตัดลำน้ำฯ",$countNum[0]->hum_smallconvert],
                    ["ถนนขนานลำน้ำสร้างกินพื้นที่ลำน้ำ",$countNum[0]->hum_road_paralel],
                    ["วางท่อตามแนวลำน้ำทดแทนลำน้ำเดิม",$countNum[0]->hum_replaced_convert],
                    ["สะพานมีหน้าตัดแคบเกินไป",$countNum[0]->hum_bridge_pile],
                    ["การถมดิน",$countNum[0]->hum_soil_cover],
                    ["สิ่งปฏิกูล",$countNum[0]->hum_trash],
                    ["อื่นๆ(มนุษย์)",$countNum[0]->hum_other]
                  ];
           // dd($countNum);    
        return view('chart/chartBar', compact('countNum'));
    }
    //--------------------------- // 
    // --------Fang ------------- //
    // -------------------------- //
    public function indexCM(Request $request)
    {
       //dd($request->amp);
       if($request->amp=="3 อำเภอ"){
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
    $amp = " 3 อำเภอ จังหวัดเชียงใหม่";
             
    return view('fang/chart', compact('countNum','countBar','amp'));

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
            ->where('blockage_locations.blk_district', '=', $request->amp)
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
    ->where('blockage_locations.blk_district', '=', $request->amp)
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
        //dd($countNum);
        $amp = "อำเภอ".$request->amp." จังหวัดเชียงใหม่";
        return view('fang/chart', compact('countNum','amp','countBar'));

        }
        
    }

    public function probCM($amp=0)
    {
        // $data =BlockageLocation::with('Blockage','Blockage.ProblemDetail')
        //         ->where('blk_district',$amp)
        //         ->get();
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
        $countNum=[["สาเหตุจากธรรมชาติ",$nat],["สาเหตุจากมุนษย์",$hum]];
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

        //dd($countNum);
        $amp = "อำเภอ".$amp."จังหวัดเชียงใหม่";
        return view('fang/chart', compact('countNum','amp','countBar'));
    }
    ////////////////////////////////////////////////////////////
    ///////----------------------------------------////////////
   

    
}
