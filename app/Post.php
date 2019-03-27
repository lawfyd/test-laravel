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

    public function remove()
    {
        //delete file
        Storage::delete('uploads/' . $this->file);
        $this->delete();
    }

    public function uploadImage($file)
    {
        if ($file == null) return;

        Storage::delete('uploads/' . $this->file);
        $filename = str_random(10) . $file->extension();
        $file->saveAs('uploads', $filename);
        $this->file = $filename;
        $this->save();
    }

    public function setCategory($id)
    {
        if($id == null) return;

        $this->category_id = $id;
        $this->save();
    }
}
