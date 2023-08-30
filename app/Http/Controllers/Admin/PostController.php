<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $message = $request->query('message');
        $posts = Post::all();
        return view('admin.posts.index', compact('posts', 'message'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $form_data = $request->all();
    
        $post = new Post();
    
        if ($request->hasFile('cover_image')) {
            $path = Storage::put('post_image', $request->file('cover_image'));
            $form_data['cover_image'] = $path;
        }
    
        $slug = $post->generateSlug($form_data['title']);
        $form_data['slug'] = $slug;
    
        $post->fill($form_data);
        $post->save();

        if ($request->has('tags')) {
            $post->tags()->attach($request->tags);
        }

        return redirect()->route('admin.posts.index')->with('message', 'Nuovo post caricato correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $form_data = $request->all();
    
        if ($request->hasFile('cover_image')) {
            if ($post->cover_image) {
                Storage::delete($post->cover_image);
            }
            $path = Storage::put('post_image', $request->file('cover_image'));
            $form_data['cover_image'] = $path;
        }
    
        $slug = $post->generateSlug($form_data['title']);
        $form_data['slug'] = $slug;
    
        $post->update($form_data);
        
        if($request->has('tags')){
            $post->tags()->sync($request->tags);
        }
        return redirect()->route('admin.posts.index')->with('message', 'Post modificato correttamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
{
    $title_post = $post->title; // Salviamo il titolo prima di cancellare il post
    $post->tags()->sync([]); // Rimuoviamo le associazioni dei tag
    Storage::delete($post->cover_image); // Cancella l'immagine di copertina
    $post->delete(); // Cancella il post

    return redirect()->route('admin.posts.index')->with('message', "$title_post cancellato correttamente");
}
}