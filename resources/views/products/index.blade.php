
@extends('layouts.admin')

@section('content')

<h2>Products</h2>

<a href="{{ route('products.create') }}" class="btn btn-primary mb-3">
    Add Product
</a>

<table class="table table-bordered text-center align-middle">
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
                    <img src="{{ asset('storage/' . $product->image_path) }}" width="70">
                @endif
            </td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->sku }}</td>
            <td>Rs. {{number_format($product->price, 2) }}</td>
            <td>{{ $product->stock_quantity }}</td>
            <td>{{ $product->category->name }}</td>
            <td>
                @foreach($product->tags as $tag)
                    <span class="badge bg-secondary">{{ $tag->name }}</span>
                @endforeach
            </td>
            <td>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('products.destroy', $product->id) }}"
                      method="POST"
                      style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Delete this product?')">
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

@endsection
