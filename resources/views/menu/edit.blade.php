@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Menu</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('menu.update', $food->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Menu Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $food->name) }}" placeholder="Enter menu name">
            </div>
            <div class="col-md-6">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" class="form-control" id="price" step="0.01" value="{{ old('price', $food->price) }}" placeholder="Enter price">
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description" rows="4" placeholder="Enter description">{{ old('description', $food->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Menu Image</label>
            @if($food->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $food->image) }}" alt="Menu Image" class="img-thumbnail" width="150">
                </div>
            @endif
            <input type="file" name="image" class="form-control" id="image">
            <small class="text-muted">Upload a new image if you want to replace the existing one.</small>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Update Menu</button>
        </div>
    </form>
</div>
@endsection
