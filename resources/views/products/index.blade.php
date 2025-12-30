@extends('layout')

@section('page-title')
EEC - Products
@endsection

@section('content')
<div class="row align-items-center mb-4">

    {{-- Search --}}
    <div class="col-md-6">
        <form method="GET" action="{{ route('products') }}">
            <div class="input-group">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    class="form-control"
                    placeholder="Search by name, description or price...">
                <button class="btn btn-primary" type="submit">
                    🔍 Search
                </button>
            </div>
        </form>
    </div>

    {{-- Add Product Button --}}
    <div class="col-md-6 text-end">
        <a href="{{ route('products.create') }}"
            class="btn btn-success">
            ➕ Add New Product
        </a>
    </div>

</div>


{{-- Products --}}
<div class="row g-4">
    @forelse ($products as $product)
    <div class="col-lg-3 col-md-4 col-sm-6">
        <a href="{{ route('products.show', $product) }}" target="_blank"
            class="text-decoration-none text-dark d-block h-100">

            <div class="card h-100 shadow-sm product-card">
                <img
                    loading="eager"
                    src="{{ asset('storage/' . $product->image) }}"
                    class="card-img-top"
                    style="height:200px; object-fit:cover">

                <div class="card-body">
                    <h5 class="card-title">{{ $product->title }}</h5>
                    <p class="card-text text-muted">
                        {{ Str::limit($product->description, 80) }}
                    </p>
                </div>

                <div class="card-footer bg-white border-0">
                    <strong>{{ $product->price }} EGP</strong>
                </div>
            </div>

        </a>
    </div>
    @empty
    <div class="col-12 text-center">
        <div class="alert alert-warning">
            No products found.
        </div>
    </div>
    @endforelse
</div>

{{-- Pagination --}}
<div class="d-flex justify-content-center mt-4">
    {{ $products->withQueryString()->links() }}
</div>

@endsection