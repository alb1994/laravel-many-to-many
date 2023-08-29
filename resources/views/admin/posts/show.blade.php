@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h1 class="h3">{{ $post->title }}</h1>
                </div>
                <div class="card-body">
                    <img src="{{ $post->cover_image }}">
                    <p class="lead">{{ $post->content }}</p>
                    <div class="mt-4">
                        <strong>Categoria:</strong> {{ $post->category->name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection