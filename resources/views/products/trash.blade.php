
@extends('layouts.admin')

@section('content')

<h2>Trash Products</h2>

<table class="table table-bordered text-center align-middle">
    <thead>
        <tr>
            <th>Name</th>
            <th>SKU</th>
            <th>Deleted At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

    @forelse($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->sku }}</td>
            <td>{{ $product->deleted_at }}</td>
            <td>
                 <!-- Restore -->
                <form action="{{ route('products.restore', $product->id) }}"
                    method="POST"
                    style="display:inline;">
                    @csrf
                    <button class="btn btn-success btn-sm">
                        Restore
                    </button>
                </form>

                <!-- Permanent Delete -->
                <form action="{{ route('products.forceDelete', $product->id) }}"
                    method="POST"
                    style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                            onclick="return confirm('This will permanently delete the product. Continue?')">
                        Delete Permanently
                    </button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4" class="text-center">
                Trash is empty.
            </td>
        </tr>
    @endforelse

    </tbody>
</table>

@endsection
