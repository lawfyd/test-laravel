@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
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
    <section class="comments">
        <h3>Комментарии</h3>
        <comments-component :id="{{$post->id}}" :type="'post'"></comments-component>
    </section>
@endsection()