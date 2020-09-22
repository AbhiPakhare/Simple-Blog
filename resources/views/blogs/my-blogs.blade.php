@extends('blogs.layouts.master')
@section('css') 
    <link rel="stylesheet" href="{{asset('css/my-blogs.css')}}">
@endsection

@section('content')
<a href="/author/posts/create">
    <button type="button" class="btn btn-primary btn-lg create-btn">Create Blog</button>
</a>

<p class="paginator-results">Showing {{$posts->currentPage()}} - {{$posts->lastPage()}} out of {{$posts->total()}} results</p>
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
                            <button
                             type="submit" 
                             class="btn btn-danger btn-sm" 
                             onclick="removePost({{$post->id}})"
                             >
                             Delete</button>
                            <a target="_blank" href="{{url('author/posts/'.$post->id)}}">
                                <button
                                type="submit" 
                                class="btn btn-info btn-sm" 
                                >
                                    View Post
                                </button>
                            </a>
                            <a target="_blank" href="posts/{{$post->id}}/edit">
                                <button
                                type="submit" 
                                class="btn btn-default btn-sm" 
                                >
                                    Edit Post
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

@endsection

@section('javascript')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() { 
    window.posts = {!! json_encode($posts->toArray()) !!} 
    let posts = window.posts.data
    window.removePost = function removePost(id) {
        axios.delete(`/author/posts/${id}`)
        .then(response => {
            window.location.href = window.location.pathname;
        })
        .catch(error => console.error(error));
    }

})
;

</script>
@endsection