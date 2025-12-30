@extends('layout')

@section('page-title')
EEC - Products
@endsection

@section('content')

<div class="row g-4">
    <form method="GET" action="{{ route('products') }}" class="mb-4">
        <div class="input-group">
            <input
                type="text"
                name="search"
                value="{{ request('q') }}"
                class="form-control"
                placeholder="Search by name, description or price...">
            <button class="btn btn-primary" type="submit">
                🔍 Search
            </button>
        </div>
    </form>

    @forelse ($products as $product)
    <div class="col-md-4">
        <div class="card h-100 shadow-sm">

            {{-- Product Image --}}
            <img
                src="{{ asset('storage/' . $product->image) }}"
                class="card-img-top"
                alt="{{ $product->title }}"
                style="height: 200px; object-fit: cover;">

            <div class="card-body d-flex flex-column">
                <h5 class="card-title">
                    {{ $product->title }}
                </h5>

                <p class="card-text text-muted">
                    {{ Str::limit($product->description, 80) }}
                </p>

                <div class="mt-auto">
                    <p class="fw-bold mb-2">
                        💰 {{ number_format($product->price, 2) }} EGP
                    </p>

                    <a href="{{ url('products/show/' . $product->id) }}" class="btn btn-primary w-100">
                        View Details
                    </a>
                </div>
            </div>
        </div>
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
    {{ $products->links() }}
</div>

@endsection