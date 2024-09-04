@extends('layouts.app')

@section('content')
<div class="container mt-1">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Products</h1>
        <form action="{{ route('products.index') }}" method="GET" class="form-inline">
            <input type="text" name="search" class="form-control mr-sm-2" placeholder="Search products..."
                value="{{ request('search') }}">
            <button type="submit" class="btn btn-secondary">Search</button>
        </form>
        <a href="{{ route('products.create') }}" class="btn btn-secondary">Add Product</a>
    </div>
    @if (session('success'))
        <div class="alert alert-secondary">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-3 mb-4">
                <a href="{{ route('products.edit', $product->id) }}" class="card-link">
                    <div class="card bg-dark text-white">
                        @if($product->product_image)
                            <img src="{{ asset('storage/' . $product->product_image) }}" class="card-img-top"
                                alt="{{ $product->product_name }}">
                        @else
                            <img src="{{ asset('storage/product_images/default-product-image.png') }}" class="card-img-top" alt="Default Image">
                        @endif
                        <div class="card-body text-center">
                            <h5 class="card-title">
                                @if(strlen($product->product_name) > 15)
                                    {{ substr($product->product_name, 0, 15) }}<span class="view-product_name">...</span>
                                @else
                                    {{ $product->product_name }}
                                @endif
                            </h5>
                            <p class="card-text text-justify">
                                @if(strlen($product->description) > 28)
                                    {{ substr($product->description, 0, 28) }}<span class="view-description">...</span>
                                @else
                                    {{ $product->description }}
                                @endif
                                <br>
                                <span style="font-size: 1rem; font-weight: bold;">₱rice: ₱{{ number_format($product->price, 2, '.', ',') }}</span><br>
                                Stock: {{ $product->stock }}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    {{ $products->links() }}
</div>
@endsection
