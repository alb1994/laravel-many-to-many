@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mt-5">
            <h1>I nostri post</h1>
        </div>
        <div class="col-12 mt-5">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Slug</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $Category)
                    <tr>
                        <td>{{ $Category->id }}</td>
                        <td>{{ $Category->name }}</td>
                        <td>{{ $Category->slug }}</td>
                        <td>
                            <a href="{{ route('admin.categories.show', $Category->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.categories.edit', $Category->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form class="d-inline-block delete-post-form" action="{{ route('admin.categories.destroy', $Category->id)}}" 
                            method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('admin.partials.modal_delete')
@endsection