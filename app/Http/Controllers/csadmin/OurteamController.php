<?php

namespace App\Http\Controllers\csadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CsOurTeams;
use Illuminate\Support\Facades\File;

class OurteamController extends Controller
{
    public function ourteam($id = 0)
    {
        $title = 'Our Team';
        $teamIdData = array();
        $teamIdData = CsOurTeams::orderBy('team_id', 'DESC')->paginate(50);
        return view('csadmin.ourteam.ourteam', compact('title', 'teamIdData'));
    }
    public function addteam($id = 0)
    {
        $title = 'Add Team';
        $teamIdData = array();
        if (isset($id) && $id > 0) {
            $teamIdData = CsOurTeams::where('team_id', $id)->first();
        }
        return view('csadmin.ourteam.addteam', compact('title', 'teamIdData'));
    }

    public function teamProcess(Request $request)
    {
        $requestData = $request->all();
        if (isset($request->team_id) && $request->team_id > 0) {
            $teamObj = CsOurTeams::where('team_id', $request->team_id)->first();
            $request->validate([
                'team_name' => 'required',
                'team_designation' => 'required',
            ]);
        } else {
            $request->validate([
                'team_image' => 'required',
                'team_name' => 'required',
                'team_designation' => 'required',
            ]);
            $teamObj = new CsOurTeams;
        }
        
        $teamObj->team_name = $request->team_name;
        $teamObj->team_designation = $request->team_designation;
        // return $request->media;
        if ($request->hasFile('team_image')) {
            $destination_path = public_path(env('SITE_UPLOAD_PATH') . "team/" . $teamObj->team_image);
                if (File::delete($destination_path)) {
                    $teamObj->team_image = '';
                }
            $image = $request->file('team_image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path(env('SITE_UPLOAD_PATH') . "team");
            $image->move($destinationPath, $name);
            $teamObj->team_image = $name;
        }

        if ($teamObj->save()) {
            if (isset($requestData['team_id']) && $requestData['team_id'] > 0) {
                return redirect()->route('csadmin.ourteam.ourteam')->with('success', 'Team Updated Successfully');
            } else {
                return redirect()->route('csadmin.ourteam.ourteam')->with('success', 'Team Added Successfully');
            }
        }


        return view('csadmin.ourteam.addteam', compact('title', 'teamIdData'));
    }

    public function deleteteam($id = 0)
    {

        $teamIdData = CsOurTeams::where('team_id', $id)->first();
        if ($teamIdData->delete()) {
            if (isset($teamIdData['team_id']) && $teamIdData['team_id'] > 0) {
                if (isset($teamIdData->team_image) && $teamIdData->team_image != '') {
                    $teamIdData = public_path(env('SITE_UPLOAD_PATH') . "team/" . $teamIdData->team_image);
                    File::delete($teamIdData);
                }
            }
            return redirect()->back()->with('success', 'Team Deleted Successfully');
        }


    }

    public function teamfeatured($id=null,$status=null)
    {
        $teamObj = CsOurTeams::where('team_id',$id)->first();
        if($teamObj->team_featured == 0)
        {
            $teamObj->team_featured = 1;
        } else{
            $teamObj->team_featured = 0;
        }
        if ($teamObj->save())
        {
            return redirect()->back()->with('success', 'Featured Updated Successfully');
        }
        return redirect()->back()->with('error', 'Something Went Wrong');
    }

    public function statusteam($id)
    {
        // return $id;
        $teamObj = CsOurTeams::where('team_id', $id)->first();
        if ($teamObj->team_status == 0) {
            $status = 1;
        } else {
            $status = 0;
        }

        $statusupdate = CsOurTeams::where('team_id', $id)->update(['team_status' => $status]);
        return redirect()->back()->with('success', 'Status Update Success');
    }

}