<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// use App\Models\Post;
class CategoryController extends Controller
{
    public function index()
    {
        $data = [];
        $data['categories'] = Category::all();
        return view('Backend/category')->with($data);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category-name' => 'required|unique:categories,name',
        ], [
            'category-name.required' => 'Name is required.',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        // $url = Storage::url('file.jpg');
        $name = trim($request->input('category-name'));
        $slug = strtolower(str_replace(' ', '-', $name));
        $data = [
            'name' => $name,
            'slug' => $slug,
        ];

        try {
            Category::create($data);
            $this->setSuccessMessage('Category created');
            return redirect()->back();

        } catch (Exception $e) {

            $this->setErrorMessage($e->getMessage());
            return redirect()->back();

        }
    }

    // function show($id){
    //     $data = [] ;
    //     $data['categories'] = Category::with('posts','posts.user')->select('id','name','slug')->find($id);
    //     return view('Backend.posts.category_posts')->with($data);
    // }

    // {{ $post->created_at->format('F j, Y') }}

    public function edit($id)
    {
        $data = [];
        $data['category'] = Category::select('id', 'name', 'slug')->find($id);
        return view('Backend/category_edit')->with($data);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category-name' => 'required|unique:categories,name,', $id,
        ], [
            'category-name.required' => 'Name is required.',
            'category-name.unique' => 'Name Already taken.',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        // $url = Storage::url('file.jpg');
        $name = trim($request->input('category-name'));
        $slug = strtolower(str_replace(' ', '-', $name));
        $data = [
            'name' => $name,
            'slug' => $slug,
        ];

        try {
            $category = Category::find($id);
            $category->update($data);
            $this->setSuccessMessage('Category Updated');
            return redirect()->route('category.index');

        } catch (Exception $e) {

            $this->setErrorMessage($e->getMessage());
            return redirect()->back();

        }
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        $this->setSuccessMessage('Category Deleted');
        return redirect()->route('category.index');

    }

}