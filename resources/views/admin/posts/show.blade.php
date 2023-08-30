@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="h3">{{ $post->title }}</h1>
                </div>
                <div class="card-body">
                    <img src="{{ asset('storage/' . $post->cover_image) }}" alt="Cover Image" class="img-fluid mb-3">
                    <p class="lead">{{ $post->content }}</p>
                    <div class="mt-4">
                        <strong>Categoria:</strong> {{ $post->category ? $post->category->name : 'Senza Categoria' }}
                    </div>
                    <div class="mt-4">
                        <strong>Tag:</strong>
                        @if($post->tags->count() > 0)
                            @foreach($post->tags as $tag)
                                <a href="{{ route('admin.tags.show', $tag->id) }}">{{ $tag->name }}</a>
                            @endforeach
                        @else
                            Senza Tag
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection