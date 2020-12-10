<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\storePostRequest;




class HomeController extends Controller
{
    // public function testroot()
    // {
    //     dd('this is the root path');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Post::orderBy('id', 'desc')->get();
        // $data = Post::latest()->first();
        return view('home', compact('data'));
    }


    public function create()
    {

        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storePostRequest $request)
    {
        $request->validate([
            'name' => 'required|unique:posts|max:255',
            'description' => 'required|max:255',
        ]);

        $post = new Post();
        $post->name = $request->name;
        $post->description = $request->description;
        $post->category_id = 1;

        $post->save();
        // Post::create([
        //     'name' => $request->name,
        //     'description' =>$request->description,
        // ]);

        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        return view('show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // $post = Post::findOrFail($id);
        return view('edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(storePostRequest $request, Post $post)
    {
        // $post = Post::findOrFail($id);
        // $request->validate([
        //     'name' => 'required|unique:$post|max:255',
        //     'description' => 'required|max:255',
        // ]);

        // $post->name = $request->name;
        // $post->description = $request->description;
        // $post->save();

        $post->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect('/posts');
    }


    public function destroy(Post $post)
    {
        // Post::findOrFail($id)->delete();
        $post->delete();
        return redirect('/posts');
    }
}
