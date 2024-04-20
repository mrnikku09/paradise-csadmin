<?php

namespace App\Http\Controllers\csadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CsMedia;
use Illuminate\Support\Facades\File;

class MediaController extends Controller
{
    public function media($id = 0)
    {
        $title = 'Media';
        $mediaIdData = array();
        $mediaIdData = CsMedia::orderBy('media_id', 'DESC')->paginate(50);
        return view('csadmin.medias.media', compact('title', 'mediaIdData'));
    }
    public function addmedia($id = 0)
    {
        $title = 'Add Media';
        $mediaIdData = array();
        if (isset($id) && $id > 0) {
            $mediaIdData = CsMedia::where('media_id', $id)->first();
        }
        return view('csadmin.medias.addmedia', compact('title', 'mediaIdData'));
    }

    public function mediaProcess(Request $request)
    {
        $requestData = $request->all();
        if (isset($request->media_id) && $request->media_id > 0) {
            $mediaObj = CsMedia::where('media_id', $request->media_id)->first();
            $request->validate([
                'media' => 'required',
            ]);
        } else {
            $request->validate([
                'media' => 'required',
            ]);
            $mediaObj = new CsMedia;
        }
        
        // return $request->media;
        if ($request->hasFile('media')) {
            $destination_path = public_path(env('SITE_UPLOAD_PATH') . "media/" . $mediaObj->media);
                if (File::delete($destination_path)) {
                    $mediaObj->media = '';
                }
            $image = $request->file('media');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path(env('SITE_UPLOAD_PATH') . "media");
            $image->move($destinationPath, $name);
            $mediaObj->media = $name;
        }

        if ($mediaObj->save()) {
            if (isset($requestData['media_id']) && $requestData['media_id'] > 0) {
                return redirect()->route('csadmin.media')->with('success', 'Media Updated Successfully');
            } else {
                return redirect()->route('csadmin.media')->with('success', 'Media Added Successfully');
            }
        }


        return view('csadmin.medias.addmedia', compact('title', 'mediaIdData'));
    }

    public function deletemedia($id = 0)
    {

        $mediaIdData = CsMedia::where('media_id', $id)->first();
        if ($mediaIdData->delete()) {
            if (isset($mediaIdData['media_id']) && $mediaIdData['media_id'] > 0) {
                if (isset($mediaIdData->media) && $mediaIdData->media != '') {
                    $mediaIdData = public_path(env('SITE_UPLOAD_PATH') . "media/" . $mediaIdData->media);
                    File::delete($mediaIdData);
                }
            }
            return redirect()->back()->with('success', 'Media Deleted Successfully');
        }


    }

}