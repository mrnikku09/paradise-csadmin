<?php
namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use App\Models\CsUsers;
use App\Models\CsPincode;
use App\Models\CsUserAddress;
use App\Models\CsState;
use App\Models\CsCountries;
use App\Models\CsThemeAdmin;
use App\Models\CsCities;
use App\Models\CsZoneCity;
use App\Models\CsProduct;
use App\Models\CsUniqueIds;
use Validator;
use Hash;

class LoginController extends Controller
{
    public function registerProcess(Request $request)
    {
        //    return $requestData = $request->header('X-authorization');
        $requestData = $request->all();
        $validator = Validator::make($request->all(), [
            'user_fname' => 'required',
            'user_email' => 'required',
            'user_mobile' => 'required',
            'user_password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => 'Please Fill All Required Field']);
        }
        $userExist = CsUsers::where('user_email', $request->user_email)->first();
        $token = str::random(500);
        if ($userExist) {
            return response()->json(['status' => 'error', 'message' => 'User Already Exist'], 201);
        } else {
            $userObj = new CsUsers;
            $userObj->user_fname = $request->user_fname;
            $userObj->user_email = $request->user_email;
            $userObj->user_mobile = $request->user_mobile;
            $userObj->user_password = Hash::make($request->user_password);
            $userObj->user_unique_id = $this->useruniqueid(2);
            $userObj->user_token = $token;
            if ($userObj->save()) {
                unset($userObj->user_password);
                return response()->json(['status' => 'success', 'message' => 'User Created Successfully', 'userData' => $userObj], 200);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Something went wrong'], 201);
            }
        }
    }

    public function useruniqueid($id)
    {
        $uniqueiddata = CsUniqueIds::where('ui_id', $id)->first();
        $incrementid = $uniqueiddata->ui_current + 1;
        $id = CsUniqueIds::where('ui_id', $id)->update(['ui_current' => $incrementid]);

        $data = $uniqueiddata->ui_prefix . $incrementid;
        return $data;
    }

    public function userLogin(Request $request)
    {
        $requestData = $request->all();
        $validator = Validator::make($request->all(), [
            'user_email' => 'required',
            'user_password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => 'Please Fill All Required Field']);
        }
         $useData=CsUsers::where('user_email',$request->user_email)->first();
         $token=Str::random(500);
        if($useData)
        {
            if(Hash::check($request->user_password,$useData->user_password)){
                $useData->user_token = $token;
                if($useData->save())
                {                    
                unset($useData->user_password);

                    return response()->json(['status' => 'success', 'message' => 'Login Successfully', 'userData' => $useData], 200);
                }
            }else{
                return response()->json(['status' => 'error', 'message' => 'Session Expired'], 201);

            }
        }
    }
}
