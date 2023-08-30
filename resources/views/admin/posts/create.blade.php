@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mt-4">
                <div class="card-header">
                    <h2>Nuovo Post</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Titolo</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Inserisci il titolo" value="{{ old('title') }}">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="cover_image" class="form-label">Immagine di Copertina</label>
                            <input type="file" name="cover_image" id="cover_image" class="form-control @error('cover_image') is-invalid @enderror">
                            @error('cover_image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Categoria</label>
                            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                <option value="">Seleziona la categoria</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tags" class="form-label">Seleziona i tag</label>
                            <div class="form-check @error('tags') is-invalid @enderror">
                                @foreach ($tags as $tag)
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="tags[]" value="{{ $tag->id }}" id="tag{{ $tag->id }}" 
                                        {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="tag{{ $tag->id }}">{{ $tag->name }}</label>
                                    </div>
                                @endforeach
                                @error('tags')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Contenuto</label>
                            <textarea class="form-control" name="content" id="content" placeholder="Inserisci il contenuto">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Salva</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection