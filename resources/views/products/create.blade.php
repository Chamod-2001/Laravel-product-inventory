<!DOCTYPE html>
<html>
<head>
    <title>Create Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">

    <h2>Create Product</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label class="form-label">Name *</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <!-- SKU -->
        <div class="mb-3">
            <label class="form-label">SKU (Optional)</label>
            <input type="text" name="sku" class="form-control">
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label class="form-label">Price *</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
        </div>

        <!-- Stock -->
        <div class="mb-3">
            <label class="form-label">Stock Quantity *</label>
            <input type="number" name="stock_quantity" class="form-control" required>
        </div>

        <!-- Category -->
        <div class="mb-3">
            <label class="form-label">Category *</label>
            <select name="category_id" class="form-select" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tags -->
        <div class="mb-3">
            <label class="form-label">Tags</label>
            <div>
                @foreach($tags as $tag)
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="form-check-input">
                        <label class="form-check-label">{{ $tag->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Image -->
        <div class="mb-3">
            <label class="form-label">Product Image *</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Save Product</button>
    </form>

</div>
</body>
</html>
