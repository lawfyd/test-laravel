@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <br>
                    <div class="category-show">
                        <h1>{{$category->name}}</h1>
                        <p>{{$category->description}}<br/>
                            <a href="{{route('categories.edit', $category->id)}}">Изменить</a>
                        </p>

                        <h3>Posts:</h3>
                        <div class="row posts-list">
                            <ul>
                                @foreach($category->posts as $post)
                                    <li><a href="{{ route('posts.edit', $post->id) }}">{{ $post->name }}</a></li>
                                    <p>{{ $post->content }}</p>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="comments">
                        <h3>Comments:</h3>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()