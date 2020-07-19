<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
class CategoryController extends Controller
{
    function category(){
    	return view('Backend/category');
    }
    function create(Request $request){
    	$validator = Validator::make($request->all(),[
		 'category-name' => 'required|unique:categories,name',
		], [
		  'category-name.required' => 'Name is required.'
		]);

		if ($validator->fails()) {
		 return redirect()
		       ->back()
		       ->withErrors($validator)
		       ->withInput();
		}		
		// $url = Storage::url('file.jpg');
		$name = trim($request->input('category-name'));
		$slug = str_replace(' ', '-', $name);
		$data = [
			'name' => $name,
			'slug' => $slug
		];
		
		try{
			Category::create($data);
			$this->setSuccessMessage('Category created');
			return redirect()->back();

		}catch(Exception $e){
			
			$this->setErrorMessage($e->getMessage());
			return redirect()->back();

		}
    }
    function show(){}
    function edit(){}
    function update(){}
    function delete(){}
}
