@extends('blogs.layouts.master')
@section('css')
    <link rel="stylesheet" href="{{asset('css/create-blog.css')}}">
@endsection

@section('content')
<ul class="reponse-data" ></ul>
<div class="alert-bootstrap"></div>
<div class="card">
    <div class="card-body">
    <h2 class="card-title">Create Blog</h2>
        <form class="create-blog-form">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Blog Title</label>
                <input class="form-control title" type="text" placeholder="Enter title of your blog" id="example-text-input">
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Blog Content</label>
                <textarea class="form-control body" id="exampleFormControlTextarea1" rows="5"></textarea>
            </div>
            <p for="categories">
                <b>
                    Select category
                </b>
            </p>
            @foreach ($categories as $category)
            <div class="checkbox custom-control-inline">
            <label><input type="checkbox" class="category-checkbox" value="{{$category->id}}">{{$category->category_name}}</label>
            </div>
            @endforeach

            <div>
                <button class="btn btn-icon btn-primary submit-btn" type="submit">
                    <span class="btn-inner--icon"><i class="ni  ni-check-bold"></i></span>
                    <span class="btn-inner--text">Create Blog</span>
                </button>
            </div>
        </form>

    </div>
</div>
@endsection

@section('javascript')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script >

window.author_id = {{Auth::user()->id }}

document.addEventListener("DOMContentLoaded", function() { 

const form = document.querySelector('.create-blog-form');
const formEvent = form.addEventListener('submit', event => {
    event.preventDefault();

    var category_ids = [];
    var category_checkbox = document.getElementsByClassName('category-checkbox');
    for(var i=0; category_checkbox[i]; i++){
      if(category_checkbox[i].checked){
          category_ids.push(category_checkbox[i].value);
      }
    } 
    const title = document.querySelector('.title').value;
    const body = document.querySelector('.body').value;
    const author_id = window.author_id;
    const post = { title, body, author_id, category_ids };
    createPost(post);
});

const createPost = (post) => {
    axios.post('/author/posts', post)
        .then(response => {
            const _data = response.data;
            if(_data.success) {
                onSuccess(_data);
            }else{
                onError(_data.errors)
            }
            
        })
        .catch(error => console.error(error));
};

const onSuccess = (_data) => {
    showNotification('top','right',_data.message, true)
};

const onError = (_errors) => {
  showNotification('top','right',_errors, false)  
};

function showNotification(from, align, content, success) {

if(success) {
    $.notify({
        message: content
    }, {
        type: 'success',
        timer: 3000,
        placement: {
            from: from,
            align: align
        }
    });

}else {
    Object.keys(content).map(function (key) {
        return $.notify({
            title : '<strong>'+ key + '</strong> :',
            message:  content[key]
        }, {
            type: 'danger',
            timer: 3000,
            placement: {
                from: from,
                align: align
            }
        });         
    })

}
}

})
</script>
@endsection