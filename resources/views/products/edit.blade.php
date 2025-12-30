@extends('layout')

@section('page-title')
Edit Product
@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card shadow">
            <div class="card-header bg-warning">
                <h5 class="mb-0">Edit Product</h5>
            </div>

            <div class="card-body">

                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST"
                      action="{{ route('products.update', $product) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title"
                               value="{{ old('title', $product->title) }}"
                               class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="4"
                                  class="form-control">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Current Image</label><br>
                        <img src="{{ asset('storage/'.$product->image) }}"
                             width="120"
                             class="rounded shadow">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Change Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Price (EGP)</label>
                            <input type="number" step="0.01"
                                   name="price"
                                   value="{{ old('price', $product->price) }}"
                                   class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Quantity</label>
                            <input type="number"
                                   name="quantity"
                                   value="{{ old('quantity', $product->quantity) }}"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('products.show', $product) }}"
                           class="btn btn-secondary">
                            ⬅ Back
                        </a>

                        <button class="btn btn-warning">
                            ✏ Update Product
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection
