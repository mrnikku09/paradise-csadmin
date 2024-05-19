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
use Validator;

class AddressController extends Controller
{
       public function state()
       {
              $stateData = CsState::orderBy("state_id", "ASC")->get();
              return response()->json(['status' => 'success', 'stateData' => $stateData], 200);
       }

       public function countries()
       {
              $countriesData = CsCountries::orderBy("country_id", "ASC")->get();
              return response()->json(['status' => 'success', 'countriesData' => $countriesData], 200);
       }

       public function city(Request $request)
       {
              $cityData = CsCities::where("state_id", $request->stateid)->get();
              return response()->json(['status' => 'success', 'cityData' => $cityData], 200);
       }

       public function addressProcess(Request $request)
       {
              if ($request->method('post')) {
                     $token = $request->header('X-authorization');
                     $user_token = str_replace('Bearer ', '', $token);
                     if ($user_token == null || empty($user_token)) {
                            return response()->json(['status' => 'success', 'message' => 'Session Expired'], 200);
                     }
                     $userData = CsUsers::where('user_token', $user_token)->first();
                     if ($userData) {
                            $userAddress = new CsUserAddress;

                            $userAddress->ua_user_id = $userData->user_id;
                            $userAddress->ua_name = $userData->user_fname;
                            $userAddress->ua_email = $userData->user_email;
                            $userAddress->ua_mobile = $userData->user_mobile;
                            if (!empty($request->ua_country_id)) {
                                   $countryData = CsCountries::where('country_id', $request->ua_country_id)->first();
                                   $userAddress->ua_country_id = $request->ua_country_id;

                                   if ($countryData) {
                                          $userAddress->ua_country_name = $countryData->country_name;
                                   }
                            }
                            if (!empty($request->ua_state_id)) {
                                   $stateData = CsState::where('state_id', $request->ua_state_id)->first();
                                   $userAddress->ua_state_id = $request->ua_state_id;

                                   if ($stateData) {
                                          $userAddress->ua_state_name = $stateData->state_name;
                                   }
                            }

                            if (!empty($request->ua_city_id)) {
                                   $cityData = CsCities::where('cities_id', $request->ua_city_id)->first();
                                   $userAddress->ua_city_id = $request->ua_city_id;

                                   if ($cityData) {
                                          $userAddress->ua_city_name = $cityData->cities_name;
                                   }
                            }

                            if (!empty($request->ua_pincode)) {
                                   $userAddress->ua_pincode = $request->ua_pincode;
                            }

                            if (!empty($request->ua_house_no)) {
                                   $userAddress->ua_house_no = $request->ua_house_no;
                            }

                            if (!empty($request->ua_area)) {
                                   $userAddress->ua_area = $request->ua_area;
                            }

                            if (!empty($request->ua_address_type)) {
                                   $userAddress->ua_address_type = $request->ua_address_type;
                            }

                            if ($userAddress->save()) {

                                   return response()->json(['status' => 'success', 'userAddress' => $userAddress], 200);
                            } else {

                                   return response()->json(['status' => 'error', 'message' => 'Something Went Wrong'], 200);
                            }
                     } else {

                            return response()->json(['status' => 'error', 'message' => 'User Not Found'], 200);
                     }

              } else {
                     return response()->json(['status' => 'error', 'message' => 'Inavalid Method'], 200);

              }
       }

       public function getuseraddress(Request $request)
       {
              if ($request->method('post')) {
                     $token = $request->header('X-authorization');
                     $user_token = str_replace('Bearer ', '', $token);
                     if ($user_token == null || empty($user_token)) {
                            return response()->json(['status' => 'success', 'message' => 'Session Expired'], 200);
                     }
                     $userData = CsUsers::where('user_token', $user_token)->first();
                     if ($userData) {
                            $userAddressData=CsUserAddress::where('ua_user_id',$userData->user_id)->first();
                            if($userAddressData)
                            {
                                   return response()->json(['status'=>'success','userAddressData'=>$userAddressData],200);
                            }else{

                                   return response()->json(['status' => 'error', 'message' => 'Address Not Found'], 200);
                            }
                     } else {

                            return response()->json(['status' => 'error', 'message' => 'User Not Found'], 200);
                     }

              } else {
                     return response()->json(['status' => 'error', 'message' => 'Inavalid Method'], 200);

              }
       }

}
