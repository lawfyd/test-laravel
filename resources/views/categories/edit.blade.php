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
                    <form method="POST" action="{{ route('categories.destroy', $category->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input type="submit" class="btn btn-danger delete-post" value="Delete">
                    </form>
                    <br>
                    <div class="tab-content">
                        <div class="tab-pane active" id="maindata">
                            <form method="POST" action="{{ route('categories.update', $category->id) }}">
                                {{--PATCH because POST not in routelists--}}
                                @method('PATCH')
                                @csrf
                                <div class="form-group">
                                    @include('errors.errors')
                                    <label for="name" class="@if($errors->has('name')) text-danger @endif">Title</label>
                                    <input name="name" value="{{ $category->name }}" id="name" type="text"
                                           class="form-control @if($errors->has('name')) is-invalid @endif">
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description"
                                              id="description"
                                              type="text"
                                              class="form-control"
                                              rows="3">{{ old('description', $category->description) }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection()