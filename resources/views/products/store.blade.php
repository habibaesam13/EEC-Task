@extends('layout')

@section('page-title')
Add New Product
@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Create Product</h5>
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

                {{-- Success Message --}}
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                {{-- Error Message --}}
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif


                <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title"
                            value="{{ old('title') }}"
                            class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="4"
                            class="form-control" required>{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Price (EGP)</label>
                            <input type="number" step="0.01"
                                name="price"
                                value="{{ old('price') }}"
                                class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Quantity</label>
                            <input type="number"
                                name="quantity"
                                value="{{ old('quantity') }}"
                                class="form-control" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-success">
                            💾 Save Product
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection