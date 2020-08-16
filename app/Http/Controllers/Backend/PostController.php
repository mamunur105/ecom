<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Redis;
// use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $data = [] ;
        // $data['posts'] = Post::with('category','user')->select('id','user_id','category_id','title','content','thumbnail_path','status','created_at')->orderBy('created_at', 'DESC')->paginate(10);
       
        $data['posts'] =  cache('posts', function(){
            // return Post::with('category','user')->select('id','user_id','category_id','title','content','thumbnail_path','status','created_at')->orderBy('created_at', 'DESC')->paginate(10);
            return Post::with('category','user')->select('id','user_id','category_id','title','content','thumbnail_path','status','created_at')->orderBy('created_at', 'DESC')->take(10)->get();
        });
        // print_r(cache('posts'));
        // dd();
        // $data['posts'] = Post::with('category','user')->select('id','user_id','category_id','title','content','thumbnail_path','status','created_at')->orderBy('created_at', 'DESC')->take(10)->get();
        return view('Backend.posts.posts')->with($data);
    }

    function postByCat($id){
    	$data = [] ;
    	$data['posts'] = Post::with('category','user')->select('id','user_id','category_id','title','content','thumbnail_path','status','created_at')->where('category_id', $id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('Backend.posts.posts')->with($data);
    }

    function userPost($id){
    	$data = [] ;
        // $data['postbyuser'] = Post::with('posts','posts.category')->select('id','name')->find($id);
        $data['posts'] = Post::with('category','user')->select('id','user_id','category_id','title','content','thumbnail_path','status','created_at')->where('user_id', $id)->orderBy('created_at', 'DESC')->paginate(10);
        // dd($data);
        return view('Backend.posts.posts')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        // die();
        return view('Backend.posts.post_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        // $post_data = $request->all();
        // print_r(Auth::id());
        // die();
        if (!Auth::check()) {
            $this->setErrorMessage("Login again");
            return redirect()->back();
        }
        $data = [
            'user_id' => Auth::id(),
            'category_id' => $request->input('category'),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'status' => $request->input('status'),
        ];
        
        if ($request->hasFile('photo')) {
            $photo_file = $request->file('photo');
            $file_modify_name = $this->setFileName($photo_file);
            $photo_file->storeAs('images', $file_modify_name);
            $data['thumbnail_path'] = $file_modify_name;
        }    
        try{
			Post::create($data);
			$this->setSuccessMessage('Post created');
			return redirect()->route('posts.index');

		}catch(Exception $e){
			
			$this->setErrorMessage($e->getMessage());
			return redirect()->back();
		}
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [] ;
        // $data['posts'] = Post::with('category','user')->select('id','user_id','category_id','title','content','thumbnail_path','status')->where('category_id', $id)->paginate(10);
        // return view('Backend.posts.posts')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [] ;
        $data['post'] = Post::select('id','user_id','category_id','title','content','thumbnail_path','status')->find($id);
        return view('Backend.posts.post_edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       die('Wait');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
