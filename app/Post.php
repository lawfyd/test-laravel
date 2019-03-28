<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{

    /*
     * mass assignment
     */
    protected $fillable = ['name', 'content', 'category_id'];

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

    public function edit($fields)
    {

        $this->fill($fields);
        $this->save();
    }

    public function removeFile($filename)
    {
        Storage::delete($filename);
    }

    public function uploadFile($request)
    {
        if(!$request->hasFile('file')) return;

        $request->file('file');
        $file = Storage::putFile('uploads', $request->file('file'));
        $this->file = $file;
        $this->save();
    }

    /**
     * get string ids of categories.
     *
     * @return string
     */

    public static function getCategoriesIds()
    {
        $categories = Category::all();
        $categoriesId = implode(', ', $categories->pluck('id')->toArray());
        return $categoriesId;
    }

//    public function setCategory($id)
//    {
//        if($id == null) return;
//
//        $this->category_id = $id;
//        $this->save();
//    }
}
