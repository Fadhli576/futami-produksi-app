@extends('layout.layout-dashboard')

@section('content')
    @if (Auth::user()->role_id == 3)
        <div class="card p-3 mb-5 shadow-sm" style="border:none; border-left: 40px solid #98c1d9;">
            <h5>Processing</h5>
            <form class="row" action="{{ route('processing-store', $id) }}" method="POST">
                @csrf
                <div class=" col-sm-12 col-md-6">
                    <label for="">Volume Mixing</label>
                    <div class="input-group">
                        <input placeholder="Volume Mixing" class="form-control" type="text" name="volume_mixing"
                            id="">
                    </div>
                    <label for="">Drain Out</label>
                    <div class="input-group">
                        <input placeholder="Drain Out" class="form-control" type="text" name="drain_out" id="">
                    </div>
                    <label for="">Density</label>
                    <div class="input-group">
                        <select name="density_id" id="" class="form-select">
                            <option selected disabled value="">Pilih Density</option>
                            @foreach ($densities as $density)
                                <option value="{{ $density->id }}">{{ $density->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- <div class="col-sm-12 col-md-6 ">
                    <label for="">Counter Filling</label>
                    <div class="input-group">
                        <input placeholder="Counter Filling" class="form-control" type="text" name="counter_filling" id="">
                    </div>
                </div> --}}
                <div class="col-sm-12 col-md-6 ">
                    <label for="">Volume</label>
                    <div class="input-group">
                        <input placeholder="Volume" class="form-control" type="text" name="volume" id="">
                        <span class="input-group-text">ml</span>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <button class="btn text-white" style="background-color: #98c1d9">Submit</button>
                </div>

            </form>
        </div>
    @endif

@endsection
