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
                    <img src="{{ asset($post->cover_image) }}" alt="Cover Image" class="img-fluid mb-3">
                    <p class="lead">{{ $post->content }}</p>
                    <div class="mt-4">
                        <strong>Categoria:</strong> 
                        @if($post->category)
                            {{ $post->category->name }}
                        @else
                            Senza Categoria
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection