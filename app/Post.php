<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{

    /*
     * mass assignment
     */
    protected $fillable = ['name', 'content', 'category_id', 'file'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public static function add($fields)
    {
        $post = new static;
        $post->fill($fields);
        $post->save();

        return $post;
    }

    public function remove()
    {
        //delete file
        Storage::delete('uploads/' . $this->file);
        $this->delete();
    }

    public function uploadFile($request)
    {
        if(!$request->hasFile('file')) return;

        $request->file('file');
        $file = Storage::putFile('uploads', $request->file('file'));
        $this->file = $file;
        $this->save();
    }

//    public function setCategory($id)
//    {
//        if($id == null) return;
//
//        $this->category_id = $id;
//        $this->save();
//    }
}
