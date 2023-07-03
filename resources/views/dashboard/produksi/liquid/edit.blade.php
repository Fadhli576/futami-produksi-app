@extends('layout.layout-dashboard')

@section('content')
    @if (Auth::user()->role_id == 3)
        <div class="card p-3 mb-5 shadow-sm" style="border:none; border-left: 40px solid #98c1d9;">
            <h5>Processing</h5>
            <form class="row" action="{{ route('processing-update', ['id'=>$id, 'processing_id'=>$processing_id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class=" col-sm-12 col-md-6">
                    <label for="">Drain Out</label>
                    <div class="input-group">
                        <input placeholder="Drain Out" value="{{ $processing->drain_out }}" class="form-control"
                            type="text" name="drain_out" id="">
                    </div>
                    <label for="">Density</label>
                    <div class="input-group">
                        <select name="density_id" id="" class="form-select">
                            <option disabled value="">Pilih Density</option>
                            @foreach ($densities as $density)
                                <option
                                    value="{{ $density->id }} {{ $processing->density_id == $density->id ? 'selected' : '' }}">
                                    {{ $density->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 ">
                    <label for="">Volume</label>
                    <div class="input-group">
                        <input placeholder="Volume" value="{{ $processing->volume }}" class="form-control" type="text"
                            name="volume" id="">
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <button class="btn text-white" style="background-color: #98c1d9">Submit</button>
                </div>

            </form>
        </div>
    @endif

@endsection
