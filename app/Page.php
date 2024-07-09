<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Page extends Model
{
// Fetch district
   public static function getDistrict(){
    $value=DB::table('info_village')->distinct()->get('vill_district'); 
    //$value=DB::table('villages')->distinct()->get(); 
    return $value;
  }

  public static function getDistrictCR(){
    $value=DB::table('info_village')->where('vill_province','=','เชียงราย')->distinct()->get('vill_district'); 
    //$value=DB::table('villages')->distinct()->get(); 
    return $value;
  }

  //Fetch District
    public static function getprovinceDistrict($vill_provinceid=0){

        $value=DB::table('info_village')->where('vill_province', $vill_provinceid)->distinct()->get('vill_district');

        return $value;
    }

    // Fetch Tumtol
    public static function getdistrictTumbol($vill_districtid=0){

        
        $value=DB::table('info_village')->where('vill_district', $vill_districtid)->distinct()->get('vill_tunbol');

        return $value;
    }

    //Fetch Tumtol
    public static function gettumbolVillage($vill_tumbolid=0){

        $value=DB::table('info_village')->where('vill_tunbol', $vill_tumbolid)->orderBy('vill_code')->distinct()->get();

        return $value;
    }


}
