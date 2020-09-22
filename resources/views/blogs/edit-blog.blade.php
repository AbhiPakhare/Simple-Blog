@extends('blogs.layouts.master')

@section('content') 
<ul class="reponse-data" ></ul>
<div class="alert-bootstrap"></div>
<div class="card">
    <div class="card-body">
    <h2 class="card-title">Create Blog</h2>
        <form class="edit-blog-form">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Blog Title</label>
                <input class="form-control title" value="{{$post->title}}" type="text" placeholder="Enter title of your blog" id="example-text-input">
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Blog Content</label>
                <textarea class="form-control body"  id="exampleFormControlTextarea1" rows="5">
                    {{$post->body}}
                </textarea>
            </div>
            <p for="categories">
                <b>
                    Select category
                </b>
            </p>
            @foreach ($allCategories as $category)
                <div class="checkbox custom-control-inline">
                    <label>
                    <input 
                     {{
                     in_array($category->category_name, $post->categories->pluck('category_name')->toArray()) ?
                      "checked" : 
                      ""  }}
                     type="checkbox" 
                     class="category-checkbox" 
                     value="{{$category->id}}">
                     {{$category->category_name}}
                    </label>
                </div>
            @endforeach

            <div>
                <button class="btn btn-icon btn-primary submit-btn" type="submit">
                    <span class="btn-inner--icon"><i class="ni  ni-check-bold"></i></span>
                    <span class="btn-inner--text">Edit Blog</span>
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
window.post = {!!$post!!}

document.addEventListener("DOMContentLoaded", function() { 

const form = document.querySelector('.edit-blog-form');
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
    updatePost(post);
});

const updatePost = (post) => {
    axios.put('/author/posts/'+window.post.id, post)
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