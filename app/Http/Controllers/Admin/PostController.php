<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\post;
use App\Http\Requests\StorepostRequest;
use App\Http\Requests\UpdatepostRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories =Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorepostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepostRequest $request)
{
    // Recupera tutti i dati dal form
    $form_data = $request->all();
    
    // Crea una nuova istanza del modello Post
    $post = new Post();
    
    // Verifica se è stata caricata un'immagine di copertina
    if ($request->hasFile('cover_image')) {
        // Salva l'immagine di copertina nella directory 'post_image' nell'archivio di memorizzazione
        $path = Storage::put('post_image', $request->file('cover_image'));
        
        // Assegna il percorso dell'immagine di copertina ai dati del form
        $form_data['cover_image'] = $path;
    }
    
    // Genera lo slug dal titolo e assegnalo ai dati del form
    $slug = $post->generateSlug($form_data['title']);
    $form_data['slug'] = $slug;
    
    // Compila il modello Post con i dati del form
    $post->fill($form_data);
    
    // Salva il post nel database
    $post->save();
    
    // Reindirizza alla pagina di visualizzazione degli indici dei post
    return redirect()->route('admin.posts.index');
}
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        $categories =Category::all();
        return view('admin.posts.edit', compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepostRequest  $request
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepostRequest $request, Post $post)
    {
        $form_data = $request->all();
    
        if ($request->hasFile('cover_image')) {
            if ($post->cover_image) {
                Storage::delete($post->cover_image);
            }
            $path = Storage::put('post_image', $request->cover_image);
            $form_data['cover_image'] = $path;
        }
    
        $slug = $post->generateSlug($form_data['title']);
        $form_data['slug'] = $slug;
    
        $post->update($form_data);
    
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
