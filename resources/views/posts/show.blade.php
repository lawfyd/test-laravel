@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(Session::has('message'))
                <div class="alert alert-success" id="successMessage">
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <br>
                    <a href="{{route('posts.edit', $post->id)}}">Изменить</a>
                    <h1>{{$post->name}}</h1>
                    <p>{{ $post->content }}</p>
                    <br/>
                    @if($post->file) <a href="/app/{{ $post->file }}">Download file </a> @endif
                </div>
            </div>
        </div>
    </div>
    <br>
    <section class="comments">
        <h3>Comments:</h3>
        <comments-component :id="{{$post->id}}" :type="'posts'"></comments-component>
    </section>
@endsection()