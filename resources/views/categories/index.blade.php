@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @if(Session::has('message'))
                    <div class="alert alert-success" id="successMessage">
                        {{ Session::get('message') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-blody">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Categories</th>
                                <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>
                                        <a href="{{ route('categories.show', $category->id) }}">
                                            {{ $category->name }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($category->description)
                                            {{ $category->description }}
                                        @else
                                            Нет описания
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()