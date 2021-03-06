<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function show($commentable_type, $commentable_id)
    {
        return Comment::getComments($commentable_type, $commentable_id);
    }

    public function save(Request $request)
    {
        $this->validate(request(), [
            'author' => 'required|is_author',
            'message' => 'required'
        ]);

        return Comment::addComment($request);
    }
}
