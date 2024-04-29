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
        <div class="col-md-10" d-flex justify-content-end>
            <a href="{{ route('products.index') }}" class="btn btn-dark">Back</a>
        </div>
        <h2 class="mb-4">Edit Product</h2>
        <form enctype="multipart/form-data" action="{{ route('products.update', $product->id) }}" method="post">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="productName">Name:</label>
                <input value="{{ old('name', $product->name) }}" type="text"
                    class="@error('name') is-invalid @enderror form-control" id="productName"
                    placeholder="Enter product name" name="name">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="productSku">SKU:</label>
                <input value="{{ old('sku', $product->sku) }}" type="text"
                    class="@error('sku') is-invalid @enderror form-control" id="productSku"
                    placeholder="Enter product SKU" name="sku">
                @error('sku')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="productPrice">Price:</label>
                <input value="{{ old('price', $product->price) }}" type="number"
                    class="@error('price') is-invalid @enderror form-control" id="productPrice"
                    placeholder="Enter product price" name="price">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="productDescription">Description:</label>
                <textarea class="form-control" id="productDescription" rows="3" placeholder="Enter product description"
                    name="description">{{ old('description', $product->description) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="productImage">Image:</label>
                <input type="file" class="form-control-file" id="productImage" name="image">
                @if ($product->image)
                    <img height="auto" width="50" src="{{ asset('uploads/products/' . $product->image) }}"
                        alt="Product Image" style="max-width: 100px;">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <!-- Bootstrap JS and jQuery (Optional for form validation) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>

</html>
