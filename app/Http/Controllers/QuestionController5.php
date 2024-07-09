<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use App\Blockage;

use File;
use Image;
use DB;

class QuestionController5 extends Controller
{
    protected $photo;
    /**
     * [__construct description]
     * @param Photo $photo [description]
     */
    public function __construct(
        Photo $photo )
    {
        $this->Photo = $photo;
    }
    public function questionnaire5($id)
    {
        $data =  Blockage::with('blockageLocation')->where('blk_id', $id)->get();
        return view('form.questionnaire5', compact('data'));
    }

    public function BlockageId_photo($blk_id=0){
        
        $data =  Blockage::with('blockageLocation')->where('blk_id', $blk_id)->get();
        return view('form/questionnaire5', compact('data'));
       
    }


    public function uploadImage(Request $request)
    {
       //dd($request->all());
       $blk_id=$request->blk_id;
       function calCode($users,$text) {
       
            if($users== NULL){
                return ("01");
            }else{
                $names = str_split($users->$text);
                    $code =$names[13].$names[14];
                    $num=$code+1;
                    // dd($code);
                    if($num<10){
                        return ("0".$num);
                    }else{
                        return ($num);
                    }
            }
        }

        // $request->validate([
        //     'photo_type_bld' => 'required' ,
        //     'photo_type_bld.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        //     'photo_type_land' => 'required' ,
        //     'photo_type_land.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        //     'photo_type_river_before' => 'required' ,
        //     'photo_type_river_before.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        //     'photo_type_river_prob' => 'required' ,
        //     'photo_type_river_prob.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        //     'photo_type_river_after' => 'required' ,
        //     'photo_type_river_after.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        //     'photo_type_prob_sketch' => 'required' ,
        //     'photo_type_prob_sketch.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000'
        // ]);
        //dd($request->all());
        //**************** check if image photo_type_bld exist **********************//
        if ($request->hasFile('photo_type_bld')) {
            $images = $request->file('photo_type_bld');
            
            //setting flag for condition
            $org_img = $thm_img = true;
            // create new directory for uploading image if doesn't exist
            if( ! File::exists('images/originals/')) {
                $org_img = File::makeDirectory('images/originals/', 0777, true);
                
            }
            if ( ! File::exists('images/thumbnails/')) {
                $thm_img = File::makeDirectory('images/thumbnails', 0777, true);
            }
 
            // loop through each image to save and upload
            foreach($images as $key => $image) {
                
                $blockage = DB::table('blockages')->select('blk_code')->where('blk_id', $blk_id)->get();
                $photo= DB::table('photos')->select('photo_id')->where('blk_id', $blk_id)->orderBy('created_at', 'asc')->get()->last();
                
                $blockageId=$blk_id;
                
                $photosId=$blockage[0]->blk_code."-".calCode($photo,"photo_id");
               
               

                $filename = $photosId.'.'.$image->getClientOriginalExtension();
                //path of image for upload
                $org_path = 'images/originals/' . $filename;
                $thm_path = 'images/thumbnails/' . $filename;
 
                // upload image to server
                if (($org_img && $thm_img) == true) {
                    Image::make($image)->fit(900, 500, function ($constraint) {
                            $constraint->upsize();
                        })->save($org_path);
                    Image::make($image)->fit(270, 160, function ($constraint) {
                        $constraint->upsize();
                    })->save($thm_path);
                 }
                 
                $loc = new Photo(
                    [
                        'photo_id'=> $photosId,
                        'blk_id'=>$blockageId,
                        'photo_type'=>'Blockage',
                        'photo_name'=>$org_path,
                        'thumbnail_name'=>$thm_path,
                        'photo_detail'=>''
                        
                    ]
                );
                $loc->save();
            }
        }

        //**************** check if image photo_type_land exist **********************//
        if ($request->hasFile('photo_type_land')) {
            $images = $request->file('photo_type_land');
            
            //setting flag for condition
            $org_img = $thm_img = true;
            // create new directory for uploading image if doesn't exist
            if( ! File::exists('images/originals/')) {
                $org_img = File::makeDirectory('images/originals/', 0777, true);
                
            }
            if ( ! File::exists('images/thumbnails/')) {
                $thm_img = File::makeDirectory('images/thumbnails', 0777, true);
            }
 
            // loop through each image to save and upload
            foreach($images as $key => $image) {
                $blockage = DB::table('blockages')->select('blk_code')->where('blk_id', $blk_id)->get();
                $photo= DB::table('photos')->select('photo_id')->where('blk_id', $blk_id)->orderBy('created_at', 'asc')->get()->last();
                
                $blockageId=$blk_id;
                
                $photosId=$blockage[0]->blk_code."-".calCode($photo,"photo_id");
                

                $filename = $photosId.'.'.$image->getClientOriginalExtension();
                //path of image for upload
                $org_path = 'images/originals/' . $filename;
                $thm_path = 'images/thumbnails/' . $filename;
 
                // upload image to server
                if (($org_img && $thm_img) == true) {
                    Image::make($image)->fit(900, 500, function ($constraint) {
                            $constraint->upsize();
                        })->save($org_path);
                    Image::make($image)->fit(270, 160, function ($constraint) {
                        $constraint->upsize();
                    })->save($thm_path);
                 }
                 
                 $loc = new Photo(
                     [
                         'photo_id'=> $photosId,
                         'blk_id'=>$blockageId,
                         'photo_type'=>'Land',
                         'photo_name'=>$org_path,
                         'thumbnail_name'=>$thm_path,
                         'photo_detail'=>$request->photo_detail_selector
                         
                     ]
                 );
                $loc->save();
            }
        }

        //**************** check if image photo_type_river_before exist **********************//
        if ($request->hasFile('photo_type_river_before')) {
            $images = $request->file('photo_type_river_before');
            
            //setting flag for condition
            $org_img = $thm_img = true;
            // create new directory for uploading image if doesn't exist
            if( ! File::exists('images/originals/')) {
                $org_img = File::makeDirectory('images/originals/', 0777, true);
                
            }
            if ( ! File::exists('images/thumbnails/')) {
                $thm_img = File::makeDirectory('images/thumbnails', 0777, true);
            }
 
            // loop through each image to save and upload
            foreach($images as $key => $image) {
                $blockage = DB::table('blockages')->select('blk_code')->where('blk_id', $blk_id)->get();
                $photo= DB::table('photos')->select('photo_id')->where('blk_id', $blk_id)->orderBy('created_at', 'asc')->get()->last();
                
                $blockageId=$blk_id;
                
                $photosId=$blockage[0]->blk_code."-".calCode($photo,"photo_id");
                

                $filename = $photosId.'.'.$image->getClientOriginalExtension();
                //path of image for upload
                $org_path = 'images/originals/' . $filename;
                $thm_path = 'images/thumbnails/' . $filename;
 
                // upload image to server
                if (($org_img && $thm_img) == true) {
                    Image::make($image)->fit(900, 500, function ($constraint) {
                            $constraint->upsize();
                        })->save($org_path);
                    Image::make($image)->fit(270, 160, function ($constraint) {
                        $constraint->upsize();
                    })->save($thm_path);
                 }
                 
                 $loc = new Photo(
                     [
                         'photo_id'=> $photosId,
                         'blk_id'=>$blockageId,
                         'photo_type'=>'River before',
                         'photo_name'=>$org_path,
                         'thumbnail_name'=>$thm_path,
                         'photo_detail'=>''
                         
                     ]
                 );
                $loc->save();
            }
        }

        //**************** check if image photo_type_river_prob exist **********************//
        if ($request->hasFile('photo_type_river_prob')) {
            $images = $request->file('photo_type_river_prob');
            
            //setting flag for condition
            $org_img = $thm_img = true;
            // create new directory for uploading image if doesn't exist
            if( ! File::exists('images/originals/')) {
                $org_img = File::makeDirectory('images/originals/', 0777, true);
                
            }
            if ( ! File::exists('images/thumbnails/')) {
                $thm_img = File::makeDirectory('images/thumbnails', 0777, true);
            }
 
            // loop through each image to save and upload
            foreach($images as $key => $image) {
                $blockage = DB::table('blockages')->select('blk_code')->where('blk_id', $blk_id)->get();
                $photo= DB::table('photos')->select('photo_id')->where('blk_id', $blk_id)->orderBy('created_at', 'asc')->get()->last();
                
                $blockageId=$blk_id;
                
                $photosId=$blockage[0]->blk_code."-".calCode($photo,"photo_id");
                

                $filename = $photosId.'.'.$image->getClientOriginalExtension();
                //path of image for upload
                $org_path = 'images/originals/' . $filename;
                $thm_path = 'images/thumbnails/' . $filename;
 
                // upload image to server
                if (($org_img && $thm_img) == true) {
                    Image::make($image)->fit(900, 500, function ($constraint) {
                            $constraint->upsize();
                        })->save($org_path);
                    Image::make($image)->fit(270, 160, function ($constraint) {
                        $constraint->upsize();
                    })->save($thm_path);
                 }
                 
                 $loc = new Photo(
                     [
                         'photo_id'=> $photosId,
                         'blk_id'=>$blockageId,
                         'photo_type'=>'River prob',
                         'photo_name'=>$org_path,
                         'thumbnail_name'=>$thm_path,
                         'photo_detail'=>''
                         
                     ]
                 );
                $loc->save();
            }
        }

        //**************** check if image photo_type_river_after exist **********************//
        if ($request->hasFile('photo_type_river_after')) {
            $images = $request->file('photo_type_river_after');
            
            //setting flag for condition
            $org_img = $thm_img = true;
            // create new directory for uploading image if doesn't exist
            if( ! File::exists('images/originals/')) {
                $org_img = File::makeDirectory('images/originals/', 0777, true);
                
            }
            if ( ! File::exists('images/thumbnails/')) {
                $thm_img = File::makeDirectory('images/thumbnails', 0777, true);
            }
 
            // loop through each image to save and upload
            foreach($images as $key => $image) {
                $blockage = DB::table('blockages')->select('blk_code')->where('blk_id', $blk_id)->get();
                $photo= DB::table('photos')->select('photo_id')->where('blk_id', $blk_id)->orderBy('created_at', 'asc')->get()->last();
                
                $blockageId=$blk_id;
                
                $photosId=$blockage[0]->blk_code."-".calCode($photo,"photo_id");
                

                $filename = $photosId.'.'.$image->getClientOriginalExtension();
                //path of image for upload
                $org_path = 'images/originals/' . $filename;
                $thm_path = 'images/thumbnails/' . $filename;
 
                // upload image to server
                if (($org_img && $thm_img) == true) {
                    Image::make($image)->fit(900, 500, function ($constraint) {
                            $constraint->upsize();
                        })->save($org_path);
                    Image::make($image)->fit(270, 160, function ($constraint) {
                        $constraint->upsize();
                    })->save($thm_path);
                 }
                 
                 $loc = new Photo(
                     [
                         'photo_id'=> $photosId,
                         'blk_id'=>$blockageId,
                         'photo_type'=>'River after',
                         'photo_name'=>$org_path,
                         'thumbnail_name'=>$thm_path,
                         'photo_detail'=>''
                         
                     ]
                 );
                $loc->save();
            }
        }
        
        //**************** check if image photo_type_prob_sketch exist **********************//
        if ($request->hasFile('photo_type_prob_sketch')) {
            $images = $request->file('photo_type_prob_sketch');
            
            //setting flag for condition
            $org_img = $thm_img = true;
            // create new directory for uploading image if doesn't exist
            if( ! File::exists('images/originals/')) {
                $org_img = File::makeDirectory('images/originals/', 0777, true);
                
            }
            if ( ! File::exists('images/thumbnails/')) {
                $thm_img = File::makeDirectory('images/thumbnails', 0777, true);
            }
 
            // loop through each image to save and upload
            foreach($images as $key => $image) {
                $blockage = DB::table('blockages')->select('blk_code')->where('blk_id', $blk_id)->get();
                $photo= DB::table('photos')->select('photo_id')->where('blk_id', $blk_id)->orderBy('created_at', 'asc')->get()->last();
                
                $blockageId=$blk_id;
                
                $photosId=$blockage[0]->blk_code."-".calCode($photo,"photo_id");
                

                $filename = $photosId.'.'.$image->getClientOriginalExtension();
                //path of image for upload
                $org_path = 'images/originals/' . $filename;
                $thm_path = 'images/thumbnails/' . $filename;
 
                // upload image to server
                if (($org_img && $thm_img) == true) {
                    Image::make($image)->fit(900, 500, function ($constraint) {
                            $constraint->upsize();
                        })->save($org_path);
                    Image::make($image)->fit(270, 160, function ($constraint) {
                        $constraint->upsize();
                    })->save($thm_path);
                 }
               
                 $loc = new Photo(
                     [
                         'photo_id'=> $photosId,
                         'blk_id'=>$blockageId,
                         'photo_type'=>'Prob sketch',
                         'photo_name'=>$org_path,
                         'thumbnail_name'=>$thm_path,
                         'photo_detail'=>''
                         
                     ]
                 );
                $loc->save();
            }
        }
            return redirect()->route('reportBlockage', [$blk_id]);
    }
}
