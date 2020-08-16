<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Post;
class PostCacheListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {

        cache()->forget('posts');
        $posts =  Post::with('category','user')->select('id','user_id','category_id','title','content','thumbnail_path','status','created_at')->orderBy('created_at', 'DESC')->take(10)->get();
        cache()->forever('posts',$posts);
        // info(cache('posts'));

    }
}
