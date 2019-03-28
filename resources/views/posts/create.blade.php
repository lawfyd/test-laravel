@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        {{--PATCH because POST not in routelists--}}
        @csrf
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <br>
                        <div class="tab-content">
                            <div class="tab-pane active" id="maindata">
                                <div class="form-group">
                                    @include('errors.errors')
                                    <label for="name" class="@if($errors->has('name')) text-danger @endif">Name</label>
                                    <input name="name" value="{{ old('name') }}" id="name" type="text"
                                           class="form-control @if($errors->has('name')) is-invalid @endif">
                                </div>

                                <div class="form-group">
                                    <label for="content"
                                           class="@if($errors->has('content')) text-danger @endif">Content</label>
                                    <textarea name="content" id="content" type="text"
                                              class="form-control @if($errors->has('content')) is-invalid @endif"
                                              rows="3">{{ old('content') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="category_id"
                                               class="@if($errors->has('category_id')) text-danger @endif">
                                            Category
                                        </label>
                                        <select name="category_id"
                                                class="form-control @if($errors->has('category_id')) text-danger @endif"
                                                id="category_id">
                                            <option value="">Выберите категорию</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}"
                                                        @if($category->id == old("category_id")) selected @endif>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="file" class="@if($errors->has('file')) text-danger @endif">File</label>
                                    <input name="file" value=" " id="file" type="file"
                                           class="form-control"
                                           class="@if($errors->has('file')) text-danger @endif">
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
@endsection()