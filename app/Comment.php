<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Comment extends Model
{
    public static function getComments($commentable_type, $commentable_id)
    {
        $comments = Comment::where('commentable_type', $commentable_type)
            ->where('commentable_id', $commentable_id)->get();
//        $comments = $comments->toArray();
//        dd($comments);
        return $comments;
    }

    public static function addComment(Request $request)
    {
        $comment = new static;
        $comment->author = $request->author;
        $comment->content = $request->message;
        $comment->commentable_id = $request->commentable_id;
        $comment->commentable_type = $request->commentable_type;
        $comment->save();

        return $comment;
    }

    public function messages()
    {
        return [
            'is_author' => 'A title is required',
        ];
    }
}
