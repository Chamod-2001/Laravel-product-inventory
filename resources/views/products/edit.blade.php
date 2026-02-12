{{-- <!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">

    <h2>Edit Product</h2>

    <form action="{{ route('products.update', $product->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-3">
            <label class="form-label">Name *</label>
            <input type="text"
                   name="name"
                   value="{{ $product->name }}"
                   class="form-control"
                   required>
        </div>

        <!-- SKU -->
        <div class="mb-3">
            <label class="form-label">SKU</label>
            <input type="text"
                   name="sku"
                   value="{{ $product->sku }}"
                   class="form-control"
                   readonly> <!-- can't edit sku during this phase -->
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label class="form-label">Price *</label>
            <input type="number"
                   step="0.01"
                   min="0"
                   name="price"
                   value="{{ $product->price }}"
                   class="form-control"
                   required>
        </div>

        <!-- Stock -->
        <div class="mb-3">
            <label class="form-label">Stock *</label>
            <input type="number"
                   min="0"
                   name="stock_quantity"
                   value="{{ $product->stock_quantity }}"
                   class="form-control"
                   required>
        </div>

        <!-- Category -->
        <div class="mb-3">
            <label class="form-label">Category *</label>
            <select name="category_id" class="form-select" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Tags -->
        <div class="mb-3">
            <label class="form-label">Tags</label>
            <div>
                @foreach($tags as $tag)
                    <div class="form-check form-check-inline">
                        <input type="checkbox"
                               name="tags[]"
                               value="{{ $tag->id }}"
                               class="form-check-input"
                               {{ $product->tags->contains($tag->id) ? 'checked' : '' }}>
                        <label class="form-check-label">
                            {{ $tag->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Image -->
        <div class="mb-3">
            <label class="form-label">Replace Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button class="btn btn-success">Update Product</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>

    </form>

</div>
</body>
</html> --}}


@extends('layouts.admin')

@section('content')

<h2>Edit Product</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('products.update', $product->id) }}"
      method="POST"
      enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Name -->
    <div class="mb-3">
        <label class="form-label">Name *</label>
        <input type="text" name="name"
               value="{{ $product->name }}"
               class="form-control" required>
    </div>

    <!-- SKU -->
    <div class="mb-3">
        <label class="form-label">SKU</label>
        <input type="text" name="sku"
               value="{{ $product->sku }}"
               class="form-control">
    </div>

    <!-- Price -->
    <div class="mb-3">
        <label class="form-label">Price *</label>
        <input type="number" step="0.01" min="0"
               name="price"
               value="{{ $product->price }}"
               class="form-control" required>
    </div>

    <!-- Stock -->
    <div class="mb-3">
        <label class="form-label">Stock *</label>
        <input type="number" min="0"
               name="stock_quantity"
               value="{{ $product->stock_quantity }}"
               class="form-control" required>
    </div>

    <!-- Category -->
    <div class="mb-3">
        <label class="form-label">Category *</label>
        <select name="category_id" class="form-select" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Tags -->
    <div class="mb-3">
        <label class="form-label">Tags</label>
        <div>
            @foreach($tags as $tag)
                <div class="form-check form-check-inline">
                    <input type="checkbox"
                           name="tags[]"
                           value="{{ $tag->id }}"
                           class="form-check-input"
                           {{ $product->tags->contains($tag->id) ? 'checked' : '' }}>
                    <label class="form-check-label">
                        {{ $tag->name }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Replace Image -->
    <div class="mb-3">
        <label class="form-label">Replace Image</label>
        <input type="file" name="image" class="form-control">
    </div>

    <button class="btn btn-success">Update Product</button>
</form>

@endsection
