<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
	
	function homePage(){
    	return view('Frontend/home');
   	}

   function posts(){
   		return view('Frontend/home');
   }

   function postPage(Request $request){
   		// print_r($request->name);
   		// print_r($name);
   		return view('Frontend/singlepost');
   }


}
