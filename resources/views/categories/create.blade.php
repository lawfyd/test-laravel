@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('categories.store') }}">
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
                                    <input name="name" value=" " id="name" type="text"
                                           class="form-control @if($errors->has('name')) is-invalid @endif">
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" type="text"
                                              class="form-control" rows="3">
                                    </textarea>
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