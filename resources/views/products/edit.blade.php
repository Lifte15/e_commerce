@extends('layouts.app')

@section('content')

<div class="container mt-1">
    <h1 class="text-center">Edit Product</h1>
    <br>
    @if ($errors->any())
        <div class="alert alert-secondary">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="row">
        <!-- Left half: Product Image -->
        <div class="col-md-6 text-center">
            <!-- Combine the forms -->
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Hidden file input -->
                <input type="file" name="product_image" id="product_image_input" style="display: none;" onchange="updateImagePreview()">

                @if($product->product_image)
                    <a href="javascript:void(0);" onclick="document.getElementById('product_image_input').click();">
                        <img id="product_image_preview" src="{{ asset('storage/' . $product->product_image) }}" class="img-fluid" alt="{{ $product->product_name }}" style="max-height: 400px; border-radius: 15px;">
                    </a>
                @else
                    <a href="javascript:void(0);" onclick="document.getElementById('product_image_input').click();">
                        <img id="product_image_preview" src="{{ asset('storage/product_images/default-product-image.png') }}" class="img-fluid" alt="Default Image" style="max-height: 400px;">
                    </a>
                @endif
        </div>

        <!-- Right half: Product Details -->
        <div class="col-md-6">
                <div class="form-group">
                    <label for="product_name">Product Name:</label>
                    <input type="text" name="product_name" class="form-control" value="{{ old('product_name', $product->product_name) }}">
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="price">₱rice:</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price) }}">
                </div>
                <div class="form-group">
                    <label for="stock">Stock:</label>
                    <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}">
                </div>
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
            </form>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function updateImagePreview() {
        const fileInput = document.getElementById('product_image_input');
        const file = fileInput.files[0];
        const imagePreview = document.getElementById('product_image_preview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>

@endsection
