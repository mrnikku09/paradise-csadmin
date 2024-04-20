<?php

namespace App\Http\Controllers\csadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\CsAppearanceMenu;
use App\Models\CsFooter;
use App\Models\CsContacts;
use Hash;
use File;
use Session;

class EnquiryController extends Controller
{

    // *************************************Contact Us*****************************************
    public function index()
    {
        $title = 'Contact';
        $contactData = CsContacts::orderBy('contact_id', 'ASC')->get();
        return view('csadmin.enquiry.contact', compact('title', 'contactData'));
    }
    

    public function contactDelete($id=null)
    {
        $contactIdData = CsContacts::where('contact_id', $id)->first();
        if ($contactIdData->delete()) {
            
            return redirect()->back()->with('success', 'Contact Deleted Successfully');
        }
    }
    
    

}