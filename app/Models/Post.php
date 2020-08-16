<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\PostCreated;
use App\Events\PostDeleted;
use App\Events\PostUpdated;
class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 
        'category_id',
        'title',
        'content',
        'thumbnail_path',
        'status',
    ];

    // protected $dates = [
    //     'created_at'
        
    // ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => PostCreated::class,
        'updated' => PostUpdated::class,
        'deleted' => PostDeleted::class,
    ];
    

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }


}
