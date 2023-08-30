@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-light">
                    <h1 class="h3">{{ $tag->name }}</h1>
                </div>
                <div class="card-body">
                    <h2 class="mb-4">Posts con questo tag :</h2>
                    <ul class="list-group">
                        @if($tag->posts->count() > 0)
                            @foreach($tag->posts as $post)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href="{{ route('admin.posts.show', $post->id) }}">
                                        <strong>{{ $post->title }}</strong>
                                    </a>
                                    <span class="badge badge-primary">{{ $post->id }}</span>
                                </li>
                            @endforeach
                        @else
                            <li class="list-group-item">Non sono presenti post associati a questo tag</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection