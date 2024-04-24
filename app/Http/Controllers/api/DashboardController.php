<?php

namespace App\Http\Controllers\api;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Http\JsonResponse;

use App\Models\CsProduct;

use App\Models\CsAppearanceMenu;
use App\Models\CsAppearanceSlider;
use App\Models\CsCategory;

use App\Models\CsFooter;
use App\Models\CsFaq;

use App\Models\CsPages;
use App\Models\CsOurTeams;
use App\Models\CsContacts;

use App\Models\CsThemeAdmin;

use DB;

use Validator;



class DashboardController extends Controller
{

    public function settingsData()
    {

        $settings = CsThemeAdmin::where('id', 1)->first();

        $setting_image_path = env('SETTING_IMAGE');

        $settings->makeHidden(['admin_password']);

        return response()->json(['status' => 'success', 'setting_image_path' => $setting_image_path, 'settings' => $settings], 200);

    }



    public function page(Request $request)
    {
        if($request->isMethod('post')){
            $requestData=$request->all();
            $pageImageUrl=env('PAGE_IMAGE');
        $pageData = CsPages::where('page_url', $request->page_url)->where('page_status',1)->first();



        return response()->json(['status' => 'success','PAGE_IMAGE_URL'=>$pageImageUrl, 'pageData' => $pageData], 200);
        }
    }



    public function menu()
    {

        $menuData = CsAppearanceMenu::orderBy('menu_id', 'ASC')->where('menu_status',1)->get();

        return response()->json(['status' => 'success', 'menuData' => $menuData], 200);

    }

    public function footer()
    {

        $footerData = CsFooter::orderBy('footer_id', 'ASC')->first();

        return response()->json(['status' => 'success', 'footerData' => $footerData], 200);

    }

    public function contactprocess(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'contact_name'=>'required',
            'contact_email'=>'required',
            'contact_mobile'=>'required',
            'contact_subject'=>'required',
        ]);
        if($validator->fails())
        {
            return response(["status" => 'error', "message" => 'Please fill the required fields'], 201);
        }
        $contactObj=new CsContacts;
        $contactObj->contact_name=$request->contact_name;
        $contactObj->contact_email=$request->contact_email;
        $contactObj->contact_subject=$request->contact_subject;
        $contactObj->contact_mobile=$request->contact_mobile;
        $contactObj->contact_message=$request->contact_message;

        if($contactObj->save())
        {   
            return response(["status" => 'success', "message" => 'Successfully Submited'], 201);
        }else{
            return response(["status" => 'error', "message" => 'Something Went Wrong'], 201);

        }


    }

    public function sliderbanner()
    {
        $sliderData=CsAppearanceSlider::orderBy('slider_id','ASC')->where('slider_status',1)->select('slider_id','slider_name','slider_position','slider_image','slider_status')->get();
        $sliderImage=env('SLIDER_IMAGE');
        return response(["status" => 'success','SLIDER_IMAGE_PATH'=>$sliderImage ,"sliderData" => $sliderData], 201);

    }
    public function faq()
    {
        $faqData=CsFaq::orderBy('faq_id','ASC')->where('faq_status',1)->get();
        return response(["status" => 'success' ,"faqData" => $faqData], 201);

    }

    public function product(Request $request)
    {
        $productData=null;
        $categorywiseproduct=null;
        $featuredProduct=CsProduct::orderBy('product_id','ASC')->where('product_status',1)->where('product_featured',1)->get();
        if($request->type=='all')
        {
         $productData=CsProduct::orderBy('product_id','ASC')->where('product_status',1)->get();
        }else{
            if($request->cat_slug)
            {
                $category=CsCategory::where('cat_slug',$request->cat_slug)->first();
                $categorywiseproduct=CsProduct::where('product_status', 1)->whereRaw("FIND_IN_SET(?,product_category_id)",$category->cat_id)->get();
            }else{
            $productData=CsProduct::orderBy('product_id','ASC')->where('product_status',1)->get();
            }
        }
        $productImage=env('PRODUCT_IMAGE');
        return response(["status" => 'success','PRODUCT_IMAGE_PATH'=>$productImage ,'featuredProduct'=>$featuredProduct,'catergorywiseproduct'=>$categorywiseproduct,"productData" => $productData], 201);
    }

    public function productDetails(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'product_slug'=>'required',
            
        ]);
        if($validator->fails())
        {
            return response(["status" => 'error', "message" => 'Product is not available'], 201);
        }

        $productDetails=CsProduct::where('product_status',1)->where('product_slug',$request->product_slug)->select('product_id','product_uniqueid','product_name','product_content','product_description','product_sku','product_featured','product_price','product_selling_price','product_discount','product_slug','product_moq','product_image','product_status','product_highlight','product_meta_title','product_meta_keyword','product_meta_desc','product_rating')->first();
        $productImage=env('PRODUCT_IMAGE');
        if($productDetails)
        {
            return response(["status" => 'success', 'PRODUCT_IMAGE_PATH'=>$productImage ,"productDetails" => $productDetails], 201);
            
        }else{            
            return response(["status" => 'error', 'message'=>'somthing went wrong'], 201);
        }
    }

    public function category()
    {
        $categoryData=CsCategory::orderBy('cat_id','ASC')->where('cat_status',1)->get();
        return response(["status" => 'success',"categoryData" => $categoryData], 201);
    }
    
    public function categorywiseproduct(Request $request)
    {
        $category=CsCategory::where('cat_slug',$request->cat_slug)->first();

        $categorywiseproduct=CsProduct::where('product_status', 1)->whereRaw("FIND_IN_SET(?,product_category_id)",$category->cat_id)->get();
        return response(["status" => 'success',"categoryData" => $categorywiseproduct], 201);
    }
    
    public function featuredourteam()
    {
        $teamData=CsOurTeams::where('team_status',1)->where('team_featured',1)->orderBy('team_id','ASC')->get();
        $teamImage=env('OURTEAM_IMAGE');
        return response(["status" => 'success','TEAM_IMAGE'=>$teamImage,"teamData" => $teamData], 201);
    }

}