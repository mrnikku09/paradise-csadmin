<?php 
namespace App\Http\Controllers\csadmin; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use Session;
use App\Models\CsThemeAdmin;



class LoginController extends Controller
{
	public function adminLogin(){
// 		return Hash::make('paradise@nikkblink');	
		if(Session::has('CS_ADMIN')){
	        return redirect()->route('csadmin.dashboard.index');    
	    }
	$title='Login';
	return view('csadmin.auth.index',compact('title'));
	}

	public function adminlogincheck(Request $request){
		
	$request->validate([
            'admin_email' => 'required',
            'admin_password' => 'required',
        ]);
		 $adminData=CsThemeAdmin::where('admin_email',$request->admin_email)->first();
		 if($adminData){
		 	if (Hash::check($request->admin_password, $adminData->admin_password)) {
		 		Session::put('CS_ADMIN', $adminData);
		 		Session::save();
		 		return redirect()->route('csadmin.dashboard.index')->with(['success'=>'Login successfull']);
		     }else{
		 		return redirect()->back()->with(['error'=>'Wrong Email or Password. Please try again']);
		           }
        }else{
		 	return redirect()->back()->with(['error'=>'Wrong Email or Password. Please try again']);
         }

	}
	public function forgotpassword(){			
		$title='Forgot Password';
		return view('csadmin.auth.forgotpassword');
		}
	public function logout(Request $request){	
		Session::forget('CS_ADMIN');
		return redirect()->route('adminLogin')->withErrors("logged out.");
	}

}