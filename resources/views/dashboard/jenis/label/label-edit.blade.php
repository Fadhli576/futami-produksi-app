@extends('layout.layout-dashboard')

@section('content')
    @if (Auth::user()->role_id == 3)
        <div class="card p-3 mb-5 shadow-sm">
            <h5>Jenis label</h5>
            <form class="row" action="{{ route('jenis-label-update', $label->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-12 col-md-6">
                    <label for="">Jenis label</label>
                    <input value="{{ $label->name }}" class="form-control" type="text" name="name" id="">
                </div>
                <div class="col-12 col-md-6">
                    <label for="">Spesifikasi</label>
                    <input value="{{ $label->spesifikasi }}" class="form-control" type="text" name="spesifikasi" id="">
                </div>
                <div class="col-12 mt-3">
                    <button class="btn text-white" style="background-color:#98c1d9 ">Submit</button>
                </div>
            </form>
        </div>
    @endif
@endsection
