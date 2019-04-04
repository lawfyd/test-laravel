<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    protected $fillable = ['name', 'content', 'category_id'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
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
}
