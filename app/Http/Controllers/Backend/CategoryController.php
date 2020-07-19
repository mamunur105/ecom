<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
class CategoryController extends Controller
{
    function category(){
    	$data = [] ;
    	$data['categories'] = Category::all();
    	return view('Backend/category')->with($data);
    }

    function create( Request $request ){
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

    function edit( $id ){
    	$data = [] ;
    	$data['category'] = Category::select('id','name','slug')->find($id);
    	return view('Backend/category_edit')->with($data);
    }

    function update( $id, Request $request ){
    	$validator = Validator::make($request->all(),[
		 'category-name' => 'required|unique:categories,name,'.$id,
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
			$category = Category::find($id);
			$category->update($data);
			$this->setSuccessMessage('Category Updated');
			return redirect()->route('category');

		}catch(Exception $e){
			
			$this->setErrorMessage($e->getMessage());
			return redirect()->back();

		}
    }

    function delete( $id){
    	$category = Category::find($id);
    	$category->delete();
    	$this->setSuccessMessage('Category Deleted');
    	return redirect()->route('category');

    }

}
