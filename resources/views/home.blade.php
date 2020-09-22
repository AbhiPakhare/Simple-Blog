@extends('blogs.layouts.master')

@section('content')
<h2>All Posts</h2>
<p class="paginator-results">Showing {{$posts->currentPage()}} - {{$posts->lastPage()}} out of {{$posts->total()}} results</p>
@if (count($posts) > 0)
    <div class="card">
        <div class="card-body">
            <div class="table-responsive py-4">
                <table class="table table-flush" id="datatable-basic">
                    <thead class="thead-light">
                        <tr>
                            <th>Id</th>
                            <th>title</th>
                            <th>Category</th>
                            <th>Created On</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td>{{$post->title}}</td>
                            @if (isset($post->categories))
                                <td>{{implode(', ',$post->categories->pluck('category_name')->toArray())}}</td>
                            @else
                                <td>No Category assigned</td>
                            @endif
                            <td>{{date_format($post->created_at," d/M/Y")  }}</td>
                            <td>
                                <a target="_blank" href="{{url('guest/posts/'.$post->id)}}">
                                    <button
                                    type="submit" 
                                    class="btn btn-info btn-sm" 
                                    >
                                        View Post
                                    </button>
                                </a>
                            </td>
                                
                        </tr>
                        
                    @endforeach

                    </tbody>
                </table>
            </div>
            {{--  paginator starts--}}
            @component('components.paginator', ['posts' => $posts])
            @endcomponent
        {{-- paginator ends --}}
        </div>
    </div>
@else
    There area no post trashed
    <a href="/author/posts">
    View my blogs >
    </a>
@endif
@endsection