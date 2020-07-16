<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\User;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{

    function loginForm(){
    	return view("Backend/loginform");
    }

    function login(Request $request){

		$validator = Validator::make($request->all(),[
			'email' => 'required|email',
			'password'  => 'required|min:2',
		], [
		  'email.required' => 'Email is required',
		  'password.required' => 'Password is required',
		]);

		if ($validator->fails()) {
		 return redirect()
		       ->back()
		       ->withErrors($validator)
		       ->withInput();
		}

		// $data = [
		// 	'email' => strtolower($request->input('useremail')) ,
		// 	'password' => bcrypt($request->input('password')) 
		// ];

		$credentials = $request->except(['_token']);
		
		if (auth()->attempt($credentials)) {
			return redirect()->route('homepage');
		}

		$this->setErrorMessage('Login Invalid');
	  
	  	return redirect()->back();
    }

    function logout(){
    	auth()->logout();
    	$this->setSuccessMessage('User has been loged out');
    	return redirect()->route('login');
    }

	function registrationForm(){
	     return view('Frontend/registrationForm');
	}

	function register(Request $request){

		// validation
		// error handaling
		// save Data

		$validator = Validator::make($request->all(),[
		 'name'  => 'required',
		 'useremail' => 'required|email|unique:users,email',
		 'photo'     => 'image|max:10240',
		 'password'  => 'required|min:6|confirmed'

		], [
		  'name.required' => 'Name is required.',
		  'useremail.required' => 'Email is required',
		  'password.required' => 'Password is required',
		]);

		if ($validator->fails()) {
		 return redirect()
		       ->back()
		       ->withErrors($validator)
		       ->withInput();
		}

		$data = [
			'name' => $request->input('name') ,
			'email' => strtolower($request->input('useremail')) ,
			'address' => $request->input('address') ,
			'city' => $request->input('city') ,
			'state' => $request->input('choosestate') ,
			'zipcode' => $request->input('zipcode') ,
			'photo' => 'Photo', 
			'password' => bcrypt($request->input('password')) ,
			
		];

		try{
			
			User::create($data);
			$this->setSuccessMessage('User account created');
			return redirect()->route('loginForm');

		}catch(Exception $e){
			
			$this->setErrorMessage($e->getMessage());
			return redirect()->back();

		}
	
	}


}
