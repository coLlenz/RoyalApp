<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\SymfonySkeletonHelper;

class AuthController extends Controller
{
	public function login()
	{
		return view('auth.login');
	}
	
	public function loginStore(Request $request)
	{
		$validator = \Validator::make(
			$request->all(), [
				   'email' => 'required|email',
				   'password' => 'required',
			   ]
		);
		if($validator->fails())
		{
			$messages = $validator->getMessageBag();

			return redirect()->back()->with('error', $messages->first());
		}
		
		$res = SymfonySkeletonHelper::authenticate($request->email, $request->password);
		$hasError = false;
		
		if($res){
			if($res->getStatusCode() == 200 && $res->getReasonPhrase() != 'OK'){
				$hasError = true;
			}
		}
		else{
			$hasError = true;
		}
		
		
		if($hasError){
			return redirect()->back()->with('error', __('Please check email and password'));
		}
		
		$user_data = \json_decode($res->getBody()->getContents());
		session()->put('user_data', $user_data);
		
		return redirect()->route('dashboard.index');
	}
	
	public function logout()
	{
		session()->put('user_data', null);
		return redirect()->route('auth.login');
	}
}