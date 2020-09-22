<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Validator;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use PDO;

class PostController extends Controller
{
    /* 
    * Filter the data according to provided parameters
    */
    public function applyFilter($posts){
        return $posts->when(request()->category_ids, function($query) use($posts) {
            $query->whereHas('categories', function ($q) use($posts) {
                $q->whereIn('categories.id',request()->category_ids);
            });
        });
    }

    /* 
    * Validate the incoming request data
    */
    public function validationRules($id = 0) {
       return [
            'author_id' => 'required|numeric|exists:App\Models\User,id',
            'title' => [
                'required', 
                'max:191',
                Rule::unique('posts')->ignore($id)
                ],
            'body' => 'required'
       ];   
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at','asc')
                    ->with('categories')
                    ->where('author_id', Auth::user()->id);

        $posts = $this->applyFilter($posts);
        
        $posts = $posts->paginate(3)->appends('categories', request()->category_ids);

        $allCategories = Category::all();

        if (request()->json == true) {
            return response()->json($posts, 200);
        } else {
            return view('blogs.my-blogs', [
                'posts' => $posts,
                'allCategories' => $allCategories
            ]);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $categories = Category::all();
        return view('blogs.create-blog',[
             'user' => $user,
             'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), $this->validationRules());

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Validation Failed',
                'errors' => $validator->messages()
            ],200);
        }

        $success = false;
        $post = new Post();

        //Only get post table data 
        $data = collect($request->all());
        $postTableData = $data->filter(function ($value, $key) {
            return $key != 'category_ids';
        });
        $post->fill($postTableData->toArray());

        DB::transaction(function() use($post, $request, &$success) {
            if($post->save()){
                $post->categories()->sync($request->category_ids);
                $success = true;
            }
        });

        list($success, $message, $data) =
        $success ? 
        [true, 'Blog saved successfully', $post] :
        [false, 'Blog did not saved successfully', null];

        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post = Post::withTrashed()->findOrFail($post->id);
        return view('blogs.view-blog', [
            'post' => $post
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $post = Post::withTrashed()
                ->with('categories')
                ->findOrFail($post->id);
        $postCategories = $post->categories->pluck('category_name', 'id');
        $allCategories = Category::all();

        return view('blogs.edit-blog', [
            'post' => $post,
            'allCategories' => $allCategories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $success = false;

        $validator = Validator::make($request->all(), $this->validationRules($post->id));

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'validation failed',
                'errors' => $validator->messages(),
                'data' => null
            ],200);
        }
        $post = Post::withTrashed()->findOrFail($post->id);

        //Only get post table data from the request
        $data = collect($request->all());
        $postTableData = $data->filter(function ($value, $key) {
            return $key != 'category_ids';
        });
        $post->fill($postTableData->toArray());

        DB::transaction(function() use($request, &$post, &$success) {
                if($post->save()){
                    $post->categories()->sync($request->category_ids);
                    $success = true;
                }
        });

        $post = $post->withTrashed()->findOrFail($post->id);

        list($success, $message, $data) = $success ? [true, "Post Updated Successfully", $post] :
        [false, "Specialization did not Updated Successfully", null];
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data
        ], 200);
    }

    /**
     * Soft delete the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $success = false;
        $post = Post::findOrFail($post->id);
        if($post->delete()) {
            $success = true;

            return response()->json([
                'success' => $success,
                'message' => 'Post deleted successfully'
            ],200);

        }else{

            return response()->json([
                'success' => $success,
                'message' => 'Something went wrong'
            ],200);

        }
    }

    /**
     * Restore post form database
     *
     * @param  $id Service's id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $success = Post::onlyTrashed()->findOrFail($id)->restore() ? true : false;

        list($success, $message) = $success ? [true, 'Post restore successfully'] : [false, 'Failed to restore'];
        
        return response()->json([
            'success' => $success,
            'message' => $message
        ],200);

    }
    /* 
    * Only Display Trashed Blogs
    */
    public function viewTrashed() {
        $posts = Post::onlyTrashed()
            ->with('categories')
            ->where('author_id', Auth::user()->id)
            ->orderBy('id', 'desc');
        $posts = $this->applyFilter($posts);
        $posts = $posts->paginate(3);
        if (request()->json == true) {
            return response()->json($posts, 200);
        } else {
            return view('blogs.trashed-blogs', ['posts' => $posts]);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function guestPost($id)
    {
        $post = Post::findOrFail($id);
        return view('blogs.view-blog', [
                'post' => $post
        ]);
    }

}
