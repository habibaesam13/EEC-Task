@extends('layout')

@section(section: 'page-title')
Edit Pharmacy - {{ $pharmacy->name }}
@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card shadow">
            <div class="card-header bg-warning">
                <h5 class="mb-0">Edit Pharmacy - {{ $pharmacy->name }}</h5>
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
                
                <form method="POST"
                    action="{{ route('pharmacies.update', $pharmacy) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name"
                            value="{{ old('name', $pharmacy->name) }}"
                            class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" rows="4"
                            class="form-control">{{ old('description', $pharmacy->address) }}</textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('pharmacies.show', $pharmacy) }}"
                            class="btn btn-secondary">
                            ⬅ Back
                        </a>
                        <button class="btn btn-warning">
                            ✏ Update Pharmacy
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection