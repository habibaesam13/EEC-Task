@extends('layout')

@section('page-title')
{{ $pharmacy->title }}
@endsection

@section('content')

<div class="row">
    <div class="d-flex justify-content-end mt-4 gap-2">

        <a href="{{ route('pharmacies.edit', $pharmacy) }}"
            class="btn btn-warning">
            ✏ Edit
        </a>

        <form method="POST"
            action="{{ route('pharmacies.delete', $pharmacy) }}"
            onsubmit="return confirm('Are you sure you want to delete this pharmacy?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">
                🗑 Delete
            </button>
        </form>

    </div>

    {{-- Pharmacy Info --}}

    <div class="col-md-6">
        <h2>{{ $pharmacy->name }}</h2>
        <p class="text-muted mt-3">
            {{ $pharmacy->address }}
        </p>
    </div>

</div>
@endsection