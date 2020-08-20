<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

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
		
		$credentials = $request->except(['_token']);
		if (auth()->attempt($credentials)) {
			return redirect()->route('dashbord');
		}
		$this->setErrorMessage('Login Invalid');
	  	return redirect()->back()->withInput();
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
		// $url = Storage::url('file.jpg');
		$data = [
			'name' => $request->input('name') ,
			'email' => strtolower(trim($request->input('useremail'))) ,
			'address' => $request->input('address') ,
			'city' => $request->input('city') ,
			'state' => $request->input('choosestate') ,
			'zipcode' => $request->input('zipcode') ,
			'password' => bcrypt($request->input('password')) ,	
			'email_verification_token' => str_random(32) ,	
		];
		if ($request->hasFile('photo')) {
			$photo_file = $request->file('photo');
			$file_modify_name = $this->setFileName($photo_file);
			$photo_file->storeAs('images', $file_modify_name);
			$data['photo'] = $file_modify_name;
		}
		try{
			User::create($data);
			$this->setSuccessMessage('User account created');
			return redirect()->route('loginForm');

		}catch(Exception $e){
			
			$this->setErrorMessage($e->getMessage());
			return redirect()->back();

		}
	
	}
    // function userpost($id){
    // 	$data = [] ;
    // 	$data['postbyuser'] = User::with('posts','posts.category')->select('id','name')->find($id);
    // 	// dd($data);
    // 	return view('Backend.posts.user_posts')->with($data);
    // }
	function dashboard(){
		$data = [];
		$data['user'] = Auth::user();
		return view("Backend/dashboard")->with($data);
	}
}
