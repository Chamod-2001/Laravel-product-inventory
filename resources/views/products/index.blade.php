<!DOCTYPE html>
<html>
<head>
    <title>Products List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">

    <div class="d-flex justify-content-between mb-3">
        <h2>Products</h2>
        <a href="{{ route('products.trash') }}" class="btn btn-danger">Trash</a>

        <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>SKU</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Category</th>
                <th>Tags</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

        @forelse($products as $product)
            <tr>
                <td>
                    @if($product->image_path)
                        <img src="{{ asset('storage/' . $product->image_path) }}" width="80">
                    @endif
                </td>

                <td>{{ $product->name }}</td>
                <td>{{ $product->sku }}</td>
                <td>${{ number_format($product->price, 2) }}</td>
                <td>{{ $product->stock_quantity }}</td>
                <td>{{ $product->category->name ?? '-' }}</td>

                <td>
                    @foreach($product->tags as $tag)
                        <span class="badge bg-secondary">{{ $tag->name }}</span>
                    @endforeach
                </td>

                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">No products found.</td>
            </tr>
        @endforelse

        </tbody>
    </table>

</div>
</body>
</html>
