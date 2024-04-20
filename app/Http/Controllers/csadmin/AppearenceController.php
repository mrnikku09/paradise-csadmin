<?php

namespace App\Http\Controllers\csadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\CsAppearanceMenu;
use App\Models\CsFooter;
use App\Models\CsAppearanceSlider;
use Hash;
use File;
use Session;



class AppearenceController extends Controller
{

    // *************************************Menu*****************************************
    public function menu($id = 0)
    {
        $title = 'Menu';
        $menuIdData = [];
        if (isset($id) && $id > 0) {
            $menuIdData = CsAppearanceMenu::where('menu_id', $id)->first();
        }
        $menudata = CsAppearanceMenu::orderBy('menu_id', 'ASC')->get();
        return view('csadmin.appearence.menu', compact('title', 'menudata', 'menuIdData'));

    }

    public function menuprocess(Request $request)
    {
        if ($request->isMethod('post')) {
            $requestData = $request->all();

            if (isset($requestData['menu_id']) && $requestData['menu_id'] > 0) {
                $menuObj = CsAppearanceMenu::where('menu_id', $requestData['menu_id'])->first();
            } else {
                $request->validate([
                    'menu_name' => 'required',
                    'menu_slug' => 'required',
                ]);
                $menuObj = new CsAppearanceMenu;
            }
            $menuObj->menu_name = $requestData['menu_name'];
            $menuObj->menu_slug = $requestData['menu_slug'];

            if ($menuObj->save()) {
                if (isset($requestData['menu_id']) && $requestData['menu_id'] > 0) {
                    return redirect()->route('csadmin.appearence.menu')->with('success', 'Menu Updated Successfully');
                } else {
                    return redirect()->back()->with('success', 'Menu Added Successfully');
                }
            }
        } else {
            return redirect()->back()->with('error', 'Invalid Method');
        }
    }

    public function menustatus($id)
    {
        // return $id;
        $menudata = CsAppearanceMenu::where('menu_id', $id)->first();
        if ($menudata->menu_status == 0) {
            $status = 1;
        } else {
            $status = 0;
        }

        $statusupdate = CsAppearanceMenu::where('menu_id', $id)->update(['menu_status' => $status]);
        return redirect()->back()->with('success', 'Status Update Success');
    }
    public function deletemenu($id)
    {
        // return $id;
        $menudata = CsAppearanceMenu::where('menu_id', $id)->first();
        if ($menudata->delete()) {
            return redirect()->back()->with('success', 'Menu Delete Successfully');
        }

    }

    // *************************************Footer*****************************************
    public function footer()
    {
        $title = 'Footer';
        $footerIdData = CsFooter::where('footer_id', 1)->first();
        return view('csadmin.appearence.footer', compact('title', 'footerIdData'));
    }

    public function footerProcess(Request $request)
    {
        if ($request->isMethod('post')) {
            $requestData = $request->all();
            if (isset($requestData['footer_id']) && $requestData['footer_id'] > 0) {
                $footerObj = CsFooter::where('footer_id', 1)->first();
            } else {
                $footerObj = new CsFooter;
            }

            $footerObj->footer_desc1 = $requestData['footer_desc1'];
            $footerObj->footer_desc2 = $requestData['footer_desc2'];
            $footerObj->footer_desc3 = $requestData['footer_desc3'];
            $footerObj->footer_desc4 = $requestData['footer_desc4'];

            if ($footerObj->save()) {
                if (isset($requestData['footer_id']) && $requestData['footer_id'] > 0) {
                    return redirect()->route('csadmin.appearance.footer')->with('success', 'Footer Updated Successfully');
                } else {
                    return redirect()->back()->with('success', 'Footer Added Successfully');
                }
            }
        } else {
            return redirect()->back()->with('error', 'Invalid Method');
        }
    }

    // *************************************Slider & Banner*****************************************
    public function slider()
    {
        $title = 'Slider & Banner';
        $sliderIdData = CsAppearanceSlider::orderBy('slider_id', 'ASC')->get();
        $sliderPosition=array('1'=>'Top (Web)','2'=>'Top (Mobile)');
        return view('csadmin.appearence.sliderandbanner', compact('title', 'sliderIdData','sliderPosition'));
    }
    public function addslider($id=null)
    {
        $title = 'Add Slider & Banner';
        $sliderIdData = array();
        if (isset($id) && $id > 0) {
            $sliderIdData = CsAppearanceSlider::where('slider_id', $id)->first();
        }
        
        return view('csadmin.appearence.addsliderandbanner', compact('title', 'sliderIdData'));
    }

    public function sliderProcess(Request $request)
    {
         $requestData= $request->all();
        if (isset($requestData['slider_id']) && $requestData['slider_id'] > 0) {
            $sliderObj = CsAppearanceSlider::where('slider_id', $requestData['slider_id'])->first();
        } else {
            $request->validate([
                'slider_name' => 'required',
                'slider_image' => 'required',
            ]);
            $sliderObj = new CsAppearanceSlider;
        }
        if ($request->hasFile('slider_image')) {
            if (isset($requestData['slider_id']) && $requestData['slider_id'] > 0) {
                    $destinationPath = public_path(env('SITE_UPLOAD_PATH') . "slider/" . $sliderObj['slider_image']);
                    File::delete($destinationPath);
            }
            $image = $request->file('slider_image');
            $sliderName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path(env('SITE_UPLOAD_PATH') . "slider");
            $image->move($destinationPath, $sliderName);
            $sliderObj->slider_image = $sliderName;
        }
        $sliderObj->slider_name = $request->slider_name;
        $sliderObj->slider_desc = $request->slider_desc;
        $sliderObj->slider_position = $request->slider_position;
        $sliderObj->save();

        if (isset($requestData['slider_id']) && $requestData['slider_id'] > 0) {
            return redirect()->route('csadmin.appearence.slider')->with('success', 'Slider Updated Successfully');
        } else {
            return redirect()->route('csadmin.appearence.slider')->with('success', 'Slider Added Successfully');
        }
    }

    public function sliderDelete($id=null)
    {
        $sliderIdData = CsAppearanceSlider::where('slider_id', $id)->first();
        if ($sliderIdData->delete()) {
            if (isset($sliderIdData['slider_id']) && $sliderIdData['slider_id'] > 0) {
                if (isset($sliderIdData->slider_image) && $sliderIdData->slider_image != '') {
                    $sliderIdData = public_path(env('SITE_UPLOAD_PATH') . "slider/" . $sliderIdData->slider_image);
                    File::delete($sliderIdData);
                }
            }
            return redirect()->back()->with('success', 'Slider Deleted Successfully');
        }
    }
    
    public function sliderstatus($id = null)
    {
        $sliderObj = CsAppearanceSlider::where('slider_id', $id)->first();
        if ($sliderObj->slider_status == 0) {
            $sliderObj->slider_status = 1;
        } else {
            $sliderObj->slider_status = 0;
        }
        if ($sliderObj->save()) {
            return redirect()->back()->with('success', 'Status Updated Successfully');
        }
        return redirect()->back()->with('error', 'Something Went Wrong');
    }

}