<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\VerificationEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Notifications\VarifyEmail;

class AuthController extends Controller
{

    public function loginForm()
    {
        return view("Backend/loginform");
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:2',
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
            $user = auth()->user();
            if ($user->email_verified === 0) {
                $this->setErrorMessage('Your Account is not varified. Please verify your email');
                auth()->logout();
                return redirect()->route('loginForm');
            }
            return redirect()->route('dashbord');
        }
        $this->setErrorMessage('Login Invalid');
        return redirect()->back()->withInput();
    }

    public function logout()
    {
        auth()->logout();
        $this->setSuccessMessage('User has been loged out');
        return redirect()->route('loginForm');
    }

    public function registrationForm()
    {
        return view('Frontend/registrationForm');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'useremail' => 'required|email|unique:users,email',
            'phone_number' => 'required|string|min:11|max:16|unique:users,phone_number',
            'photo' => 'image|max:10240',
            'password' => 'required|min:6|confirmed'
        ], [
            'name.required' => 'Name is required.',
            'useremail.required' => 'Email is required',
            'password.required' => 'Password is required',
            'phone_number.required' => 'Phone number is required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        // $url = Storage::url('file.jpg');
        $data = [
            'name' => $request->input('name'),
            'email' => strtolower(trim($request->input('useremail'))),
            'phone_number' => trim($request->input('phone_number')),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'state' => $request->input('choosestate'),
            'zipcode' => $request->input('zipcode'),
            'password' => bcrypt($request->input('password')),
            'email_verification_token' => Str::random(32),
        ];
        
        if ($request->hasFile('photo')) {
            $photo_file = $request->file('photo');
            $file_modify_name = $this->setFileName($photo_file);
            $photo_file->storeAs('images', $file_modify_name);
            $data['photo'] = $file_modify_name;
        }

        try {
            $user = User::create($data);
            //Mail::to($user->email)->send(new VerificationEmail($user)); // Mail send by php
            // Mail::to($user->email)->queue(new VerificationEmail($user)); // Mail send by Redis (Mail send but It's not working for me)
            $user->notify( new VarifyEmail($user) );
            $this->setSuccessMessage('User account created');
            return redirect()->route('loginForm');

        } catch (Exception $e) {

            $this->setErrorMessage($e->getMessage());
            return redirect()->back();

        }

    }

    public function verification($token)
    {
        if (!$token) {
            $this->setErrorMessage('Invalid Token');
            return redirect()->route('loginForm');
        }
        $user = User::where('email_verification_token', $token)->first();
        if (!$user) {
            $this->setErrorMessage('Invalid Token');
            return redirect()->route('loginForm');
        }
        $updated = $user->update([
            'email_verified' => 1,
            'email_verified_at' => Carbon::now(),
            'email_verification_token' => '',
        ]);
        if ($updated) {
            $this->setSuccessMessage('Verification sucessfully done');
            return redirect()->route('loginForm');
        }

    }
    // function userpost($id){
    //     $data = [] ;
    //     $data['postbyuser'] = User::with('posts','posts.category')->select('id','name')->find($id);
    //     // dd($data);
    //     return view('Backend.posts.user_posts')->with($data);
    // }
    public function dashboard()
    {
        $data = [];
        $data['user'] = Auth::user();
        return view("Backend/dashboard")->with($data);
    }
}