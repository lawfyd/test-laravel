@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <br>
                    <div class="category-show">
                        <a href="{{route('categories.edit', $category->id)}}">Edit</a>
                        <h1>{{$category->name}}</h1>
                        <p>{{$category->description}}<br/>
                        </p>
                        <h3>Posts:</h3>
                        <div class="row posts-list">
                            <ul>
                                @foreach($category->posts as $post)
                                    <li><a href="{{ route('posts.show', $post->id) }}">{{ $post->name }}</a></li>
                                    <p>{{ $post->content }}</p>
                                    <br>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <br>

                    <section class="comments">
                        <h3>Comments:</h3>
                        <comments-component :id="{{$category->id}}" :type="'categories'"></comments-component>
                    </section>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection()