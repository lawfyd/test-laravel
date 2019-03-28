<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categoriesId = Post::getCategoriesIds();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'content' => 'required',
            'category_id' => 'required|numeric|in:' . $categoriesId,
            'file' => 'max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $post = Post::add($request->all());
        $post->uploadFile($request);

        return redirect()->route('main')->with('message', 'Post has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $categoriesId = Post::getCategoriesIds();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'content' => 'required',
            'category_id' => 'required|numeric|in:' . $categoriesId,
            'file' => 'max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $post = Post::find($id);
        $post->edit($request->all());

        //delete exists file
        if($request->file){
            $post->removeFile($post->file);
            $post->file = null;
        }
        $post->uploadFile($request);

        return redirect()->route('posts.show', $id)
            ->with('message', 'Post has been saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->removeFile($post->file);
        $post->delete();

        return redirect()
            ->route('main')
            ->with('message', 'Post has been deleted');
    }
}
