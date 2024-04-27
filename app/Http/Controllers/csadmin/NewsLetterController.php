<?php



namespace App\Http\Controllers\csadmin;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Str;



use App\Models\CsNewsletter;

use Hash;

use File;

use Session;



class NewsLetterController extends Controller

{



    // *************************************NewsLetter*****************************************

    public function index()

    {

        $title = 'NewsLetter';

        $newsLetterData = CsNewsletter::orderBy('newsletter_id', 'ASC')->get();

        return view('csadmin.newsletter.newsletter', compact('title', 'newsLetterData'));

    }

    



    public function newsletterdelete($id=null)

    {

        $newsLetterIdData = CsNewsletter::where('newsletter_id', $id)->first();

        if ($newsLetterIdData->delete()) {

            

            return redirect()->back()->with('success', 'News Letter Deleted Successfully');

        }

    }

    

    



}