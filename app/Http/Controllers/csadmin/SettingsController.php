<?php

namespace App\Http\Controllers\csadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use Session;
use App\Models\CsThemeAdmin;
use App\Models\CsState;
use App\Models\CsCities;
use App\Models\CsCurrencyRates;
use App\Models\CsCurrency;

class SettingsController extends Controller
{
    public function siteSetting()
    {
        $title = 'Site Setting';
        $settingData = CsThemeAdmin::first();
        return view('csadmin.settings.site_setting', compact('title', 'settingData'));
    }



    public function sitesettingsprocess(Request $request)
    {
        //return $request->all();
        $request->validate([
            'site_title' => 'required',
            'administration_email' => 'required',
            'logo' => 'image|mimes:jpg,png,gif,webp|max:2048',
            'favicon' => 'image|mimes:jpg,png,gif,webp|max:2048'
        ]);
        $aryObj = CsThemeAdmin::first();
        if ($request->hasFile('favicon')) {
            $image = $request->file('favicon');
            $favicon_name = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path(env('SITE_UPLOAD_PATH') . "settings");
            $image->move($destinationPath, $favicon_name);
            $aryObj->favicon = $favicon_name;
        }
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $logo_name = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path(env('SITE_UPLOAD_PATH') . "settings");
            $image->move($destinationPath, $logo_name);
            $aryObj->logo = $logo_name;
        }

        if ($request->hasFile('white_logo')) {
            $image2 = $request->file('white_logo');
            $white_logo_name = time() . uniqid() . '.' . $image2->getClientOriginalExtension();
            $destinationPath = public_path(env('SITE_UPLOAD_PATH') . "settings");
            $image2->move($destinationPath, $white_logo_name);
            $aryObj->white_logo = $white_logo_name;
        }

        if ($request->hasFile('footer_logo')) {
            $image1 = $request->file('footer_logo');
            $footer_logo_name = time() . uniqid() . '.' . $image1->getClientOriginalExtension();
            $destinationPath = public_path(env('SITE_UPLOAD_PATH') . "settings");
            $image1->move($destinationPath, $footer_logo_name);
            $aryObj->footer_logo = $footer_logo_name;
        }

        $aryObj->site_title = $request->site_title;
        $aryObj->administration_email = $request->administration_email;
        $aryObj->admin_support_email = $request->admin_support_email;
        $aryObj->admin_support_mobile = $request->admin_support_mobile;
        $aryObj->address = $request->address;
        $aryObj->address_2 = $request->address_2;
        $aryObj->office_address = $request->office_address;
        if ($aryObj->save()) {
            return redirect()->back()->with('success', 'Site Setting Updated Successfully!!');
        } else {
            return redirect()->back()->with('error', 'Site Setting could not update, Please try again.');
        }
    }
    public function socialsetting()
    {

        $title = 'Social Settings';
        $settingData = CsThemeAdmin::first();
        return view('csadmin.settings.social_settings', compact('title', 'settingData'));
    }



    public function socialsettingprocess(Request $request)
    {
        $aryObj = CsThemeAdmin::first();
        $aryObj->facebook_url = $request->facebook_url;
        $aryObj->instagram_url = $request->instagram_url;
        $aryObj->twitter_url = $request->twitter_url;
        $aryObj->youtube_url = $request->youtube_url;
        $aryObj->linkedin_url = $request->linkedin_url;
        if ($aryObj->save()) {
            return redirect()->back()->with('success', 'Social Setting Updated Successfully!!');
        } else {

            return redirect()->back()->with('error', 'Social Setting could not update, Please try again.');
        }
    }
    public function seosetting()
    {
        $title = 'SEO Settings';
        return view('csadmin.settings.seo_setting', compact('title'));
    }
    public function changepassword()
    {

        $title = 'Change Password';
        return view('csadmin.settings.change_password', compact('title'));
    }



    public function changepasswordprocess(Request $request)
    {

        $request->validate([
            'password' => 'required|confirmed',
            'confirm_password' => 'required'

        ]);

        $resuserData = CsThemeAdmin::first();
        if (!empty($resuserData)) {
            $resuserData->admin_password = Hash::make($request->password);
        }

        if ($resuserData->save()) {
            return redirect()->back()->with('success', 'Password Changed Successfully!!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }

    }

}