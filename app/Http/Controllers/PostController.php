<?php

namespace App\Http\Controllers;

use App\Post;

use App\Http\Resources\posts as PostResource;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get some articles
        $posts  = Post::paginate(15);
        //return the collection as resource
        return PostResource :: collection($posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage or update it when the request is 'put'
     */
    public function store(Request $request)
    {
        $post = $request -> isMethod('put') ? Post::findorFail ( $request -> post_id) : new Post;

        $post -> id = $request -> input('post_id');
        $post -> title = $request ->input('title');
        $post -> description = $request ->input("description");

        if($post -> save()){
            return new PostResource($post);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::findorFail($id);
        //return as a resource
        return new PostResource ($post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::findorFail($id);
        //return as a resource
        if ($post -> delete()) {
            return new PostResource ($post);
        }
    }

}
