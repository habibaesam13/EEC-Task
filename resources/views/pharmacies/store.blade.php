@extends('layout')

@section('page-title')
Add New Pharmacy
@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Add Pharmacy</h5>
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


                <form method="POST" action="{{ route('pharmacies.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name"
                            value="{{ old('name') }}"
                            class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" rows="4"
                            class="form-control" required>{{ old('address') }}</textarea>
                    </div>
            </div>

            <div class="d-flex justify-content-end mb-3">
                <button class="btn btn-success">
                    💾 Add Pharmacy
                </button>
            </div>

            </form>

        </div>
    </div>

</div>
</div>

@endsection