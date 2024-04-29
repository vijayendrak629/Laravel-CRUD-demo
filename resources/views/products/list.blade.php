<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple Laravel CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <div class="bg-dark py-3">
        <h3 class="text-white text-center">Simple Laravel CRUD</h3>
    </div>
    <div class="container mt-5">
        @if (Session::has('success'))
            <div class="col-md-10">
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            </div>
        @endif
        <div class="col-md-10" d-flex justify-content-end>
            <a href="{{ route('products.create') }}" class="btn btn-dark">Create</a>
        </div>
        <h2 class="mb-4 bg-dark text-white my-3 p-2">Products</h2>
        <div class="product-tabel">
            <table class="table table-bordered shadow">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Price</th>
                        <th>Created At</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->sku }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d M, Y') }}</td>
                            <td>
                                @if ($product->image)
                                    <img height="auto" width="50"
                                        src="{{ asset('uploads/products/' . $product->image) }}" alt="Product Image"
                                        style="max-width: 100px;">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-dark">Edit</a>
                                <a href="#" onclick="deleteProduct({{ $product->id }});"
                                    class="btn btn-danger">Delete</a>
                                <form id="delete-product-from-{{ $product->id }}"
                                    action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>

    <!-- Bootstrap JS and jQuery (Optional for form validation) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function deleteProduct(id) {
            if (confirm("Are you sure you want to ddelete product?")) {
                document.getElementById("delete-product-from-" + id).submit();
            }

        }
    </script>


</body>

</html>
