@extends('layout')

@section('page-title')
{{ $product->title }}
@endsection

@section('content')

<div class="row">
    <div class="d-flex justify-content-end mt-4 gap-2">

        <a href="{{ route('products.edit', $product) }}"
            class="btn btn-warning">
            ✏ Edit
        </a>

        <form method="POST"
            action="{{ route('products.delete', $product) }}"
            onsubmit="return confirm('Are you sure you want to delete this product?')">
            @csrf
            @method('DELETE')

            <button class="btn btn-danger">
                🗑 Delete
            </button>
        </form>

    </div>

    {{-- Product Info --}}
    <div class="col-md-6">
        @php
                $imagePath = public_path('storage/' . $product->image);
                $imageUrl = file_exists($imagePath)
                ? asset('storage/' . $product->image)
                : asset('default_product_img.png');
                @endphp

                <img
                    loading="eager"
                    src="{{ $imageUrl }}"
                    class="card-img-top"
                    style="height:200px; object-fit:cover">
    </div>

    <div class="col-md-6">
        <h2>{{ $product->title }}</h2>
        <p class="text-muted mt-3">
            {{ $product->description }}
        </p>
    </div>

</div>

<hr class="my-5">

{{-- Pharmacies Table --}}
<h4 class="mb-3">Available in Pharmacies</h4>

<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr>

                <th>Pharmacy Name</th>
                <th>Price (EGP)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pharmacies as $pharmacy)
            <tr>

                <td>{{ $pharmacy->name }}</td>
                <td class="fw-bold text-success">
                    {{ number_format($pharmacy->pivot->price, 2) }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center text-muted">
                    Not available in any pharmacy
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection