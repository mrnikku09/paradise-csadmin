<?php

namespace App\Http\Controllers\csadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\CsAppearanceMenu;
use App\Models\CsFooter;
use App\Models\CsFaq;
use Hash;
use File;
use Session;

class FaqController extends Controller
{

    // *************************************FAQ*****************************************
    public function faq()
    {
        $title = 'FAQ';
        $faqIdData = CsFaq::orderBy('faq_id', 'ASC')->get();
        return view('csadmin.faq.faq', compact('title', 'faqIdData'));
    }
    public function addfaq($id=null)
    {
        $title = 'Add FAQ';
        $faqIdData = array();
        if (isset($id) && $id > 0) {
            $faqIdData = CsFaq::where('faq_id', $id)->first();
        }
        
        return view('csadmin.faq.addfaq', compact('title', 'faqIdData'));
    }

    public function faqProcess(Request $request)
    {
         $requestData= $request->all();
        if (isset($requestData['faq_id']) && $requestData['faq_id'] > 0) {
            $faqObj = CsFaq::where('faq_id', $requestData['faq_id'])->first();
            $request->validate([
                'faq_title' => 'required',
                'faq_description' => 'required',
            ]);
        } else {
            $request->validate([
                'faq_title' => 'required',
                'faq_description' => 'required',
            ]);
            $faqObj = new CsFaq;
        }
        
        $faqObj->faq_title = $request->faq_title;
        $faqObj->faq_description = $request->faq_description;
        $faqObj->save();

        if (isset($requestData['faq_id']) && $requestData['faq_id'] > 0) {
            return redirect()->route('csadmin.faq.faq')->with('success', 'Faq Updated Successfully');
        } else {
            return redirect()->route('csadmin.faq.faq')->with('success', 'Faq Added Successfully');
        }
    }

    public function faqDelete($id=null)
    {
        $faqIdData = CsFaq::where('faq_id', $id)->first();
        if ($faqIdData->delete()) {
            
            return redirect()->back()->with('success', 'Faq Deleted Successfully');
        }
    }
    
    public function faqstatus($id = null)
    {
        $faqObj = CsFaq::where('faq_id', $id)->first();
        if ($faqObj->faq_status == 0) {
            $faqObj->faq_status = 1;
        } else {
            $faqObj->faq_status = 0;
        }
        if ($faqObj->save()) {
            return redirect()->back()->with('success', 'Status Updated Successfully');
        }
        return redirect()->back()->with('error', 'Something Went Wrong');
    }

}