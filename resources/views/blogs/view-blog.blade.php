@extends('blogs.layouts.master')

@section('content')
    <div class="card" style="width: 80rem;">
        <div class="card-body">
            <h1 class="card-title">{{$post->title}}</h1>
            <p class="card-text">
                {{$post->body}}
            </p>
        </div>
    </div>
@endsection
