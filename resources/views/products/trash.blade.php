<!DOCTYPE html>
<html>
<head>
    <title>Trash Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">

    <div class="d-flex justify-content-between mb-3">
        <h2>Trash Products</h2>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
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
                    <form action="{{ route('products.restore', $product->id) }}"
                          method="POST">
                        @csrf
                        <button class="btn btn-success btn-sm">
                            Restore
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

</div>
</body>
</html>
