
@extends('layouts.admin')

@section('content')

<h2>Create Product</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('products.store') }}"
      method="POST"
      enctype="multipart/form-data">
    @csrf

    <!-- Name -->
    <div class="mb-3">
        <label class="form-label">Name *</label>
        <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
    </div>

    <!-- SKU -->
    <div class="mb-3">
        <label class="form-label">SKU (Optional)</label>
        <input type="text" name="sku" class="form-control">
    </div>

    <!-- Price -->
    <div class="mb-3">
        <label class="form-label">Price *</label>
        <input type="number" step="0.01" min="0" name="price" value="{{ old('price') }}"
               class="form-control" required>
    </div>

    <!-- Stock -->
    <div class="mb-3">
        <label class="form-label">Stock *</label>
        <input type="number" min="0" name="stock_quantity" value="{{ old('stock_quantity') }}"
               class="form-control" required>
    </div>

    <!-- Category -->
    <div class="mb-3">
        <label class="form-label">Category *</label>
        <select name="category_id" class="form-select" required>
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                           value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}
                           class="form-check-input">
                    <label class="form-check-label">
                        {{ $tag->name }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Image -->
    <div class="mb-3">
        <label class="form-label">Product Image *</label>
        <input type="file" name="image" 
               class="form-control" accept=".jpeg,.png" required>
    </div>

    <button type="submit" class="btn btn-success">
        Save Product
    </button>

</form>

@endsection

    