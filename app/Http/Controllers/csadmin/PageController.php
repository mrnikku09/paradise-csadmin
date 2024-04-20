<?php

namespace App\Http\Controllers\csadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Str;
use Hash;
use File;
use Session;
use App\Models\CsPages;


class PageController extends Controller
{
    public function page()
    {
        $title = 'Page';
        $pageData = CsPages::orderBy('page_id', 'ASC')->get();
        return view('csadmin.page.allpage', compact('title', 'pageData'));
    }
    public function addpage($id = null)
    {
        $title = 'Add Page';
        $pageData = array();
        if (isset($id) && $id > 0) {
            $pageData = CsPages::where('page_id', $id)->first();
        }
        return view('csadmin.page.addpage', compact('title', 'pageData'));
    }

    public function addpageprocess(Request $request)
    {
         $requestData = $request->all();
        $request->validate([
            'page_name' => 'required',
            'page_url' => 'required',
            'page_meta_title' => 'required',
        ]);
        if (isset($request->page_id) && $request->page_id > 0) {
            $pageObj = CsPages::where('page_id', $request->page_id)->first();
        } else {

            $pageObj = new CsPages;
        }
        $pageObj->page_name = $request->page_name;
        $pageObj->page_url = $request->page_url;
        $pageObj->page_content = $request->page_content;
        $pageObj->page_meta_title = $request->page_meta_title;
        $pageObj->page_meta_keyword = $request->page_meta_keyword;
        $pageObj->page_meta_desc = $request->page_meta_desc;

        if ($request->hasFile('page_header_image')) {

            $destination_path = public_path(env('SITE_UPLOAD_PATH') . "page/" . $pageObj->page_header_image);

                if (File::delete($destination_path)) {

                    $pageObj->page_header_image = '';

                }

            $image = $request->file('page_header_image');

            $name = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path(env('SITE_UPLOAD_PATH') . "page");

            $image->move($destinationPath, $name);

            $pageObj->page_header_image = $name;

        }

        if ($pageObj->save()) {
            if (isset($request->page_id) && $request->page_id > 0) {
                return redirect()->back()->with('success', 'Page Update Successfully');
            } else {
                return redirect()->back()->with('success', 'Page Add Successfully');
    
            }
        }
    }

    public function checkslug(Request $request)
    {
        // return $request;
        $slug = str::slug($request->title);
        $metatitle = $request->title;
        return response()->json(['slug' => $slug, 'metatitle' => $metatitle]);
    }
    public function pagestatus($id)
    {
        // return $id;
        $pageData = CsPages::where('page_id', $id)->first();
        if ($pageData->page_status == 0) {
            $status = 1;
        } else {
            $status = 0;
        }

        $statusupdate = CsPages::where('page_id', $id)->update(['page_status' => $status]);
        return redirect()->back()->with('success', 'Status Update Success');
    }
    public function deletepage($id)
    {
        // return $id;
        $pageData = CsPages::where('page_id', $id)->first();
        if($pageData->delete())
        {
            if (isset($pageData['page_id']) && $pageData['page_id'] > 0) {

                if (isset($pageData->page_header_image) && $pageData->page_header_image != '') {

                    $pageData = public_path(env('SITE_UPLOAD_PATH') . "page/" . $pageData->page_header_image);

                    File::delete($pageData);

                }

            }
        return redirect()->back()->with('success', 'Page Delete Successfully');
        }

    }


}