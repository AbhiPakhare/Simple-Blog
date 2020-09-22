@extends('blogs.layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
        <div class="card-header card-header-warning card-header-icon">
            <p class="card-category">All Post Count</p>
            <h3 class="card-title">{{$all_post_count}}
            <small>Post</small>
            </h3>
                <div class="flex-container">
                    <h4>
                        Total Count 
                    </h4>
                </div>
        </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
        <div class="card-header card-header-warning card-header-icon">
            <p class="card-category">Live Post</p>
            <h3 class="card-title">{{$live_post}}
            <small>Post</small>
            </h3>
            <a target="_blank" href="{{url('author/posts')}}">
                <div class="flex-container">
                    <h4>
                        View Posts 
                    </h4>
                    <span class="material-icons">
                        keyboard_arrow_right
                    </span>
                </div>
            </a>
        </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
        <div class="card-header card-header-warning card-header-icon">
            <p class="card-category">Trashed Post</p>
            <h3 class="card-title">{{$trashed_post}}
            <small>Post</small>
            </h3>
            <a target="_blank" href="{{url('author/posts/view-trashed')}}">
                <div class="flex-container">
                    <h4>
                        View Trashed Posts 
                    </h4>
                    <span class="material-icons">
                        keyboard_arrow_right
                    </span>
                </div>
            </a>
        </div>
        </div>
    </div>
    
</div>



@endsection
