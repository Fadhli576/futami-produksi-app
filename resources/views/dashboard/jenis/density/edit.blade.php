@extends('layout.layout-dashboard')

@section('content')
    @if (Auth::user()->role_id == 3)
        <div class="card p-3 mb-5 shadow-sm">
            <h5>Jenis Density</h5>
            <form class="row" action="{{ route('density-update', $density->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-12 col-md-6">
                    <label for="">Jenis Density</label>
                    <input class="form-control" type="number" name="name" id="" step="any"
                        value="{{ $density->name }}" placeholder="Density">
                </div>
                <div class="col-12 col-md-6">
                    <label for="">Spesifikasi</label>
                    <input class="form-control" type="text" name="spesifikasi" id="" placeholder="Spesifikasi"
                        value="{{ $density->spesifikasi }}">
                </div>
                <div class="col-12 mt-3">
                    <button class="btn text-white" style="background-color:#98c1d9 ">Submit</button>
                </div>
            </form>
        </div>
    @endif
@endsection
