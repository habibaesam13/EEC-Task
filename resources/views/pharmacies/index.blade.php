@extends('layout')

@section('page-title')
EEC - Products
@endsection

@section('content')
<div class=" align-items-center mb-4">
    {{-- Add Product Button --}}
    <div class=" text-end">
        <a href="{{ route('pharmacies.create') }}"
            class="btn btn-success">
            ➕ Add New Pharmacy
        </a>
    </div>

</div>
{{-- Pharmacies --}}
<div class="row g-4">
    @forelse ($pharmacies as $pharmacy)
    <div class="col-lg-3 col-md-4 col-sm-6">
        <a href="{{ route('pharmacies.show', $pharmacy) }}" target="_blank"
            class="text-decoration-none text-dark d-block h-100">

            <div class="card h-100 shadow-sm product-card">
                <div class="card-body">
                    <h5 class="card-title">{{ $pharmacy->name }}</h5>
                    <p class="card-text text-muted">
                        {{ Str::limit($pharmacy->address, 80) }}
                    </p>
                </div>
            </div>

        </a>
    </div>
    @empty
    <div class="col-12 text-center">
        <div class="alert alert-warning">
            No Pharmacies found.
        </div>
    </div>
    @endforelse
</div>

{{-- Pagination --}}
<div class="d-flex justify-content-center mt-4">
    {{ $pharmacies->links() }}
</div>

@endsection