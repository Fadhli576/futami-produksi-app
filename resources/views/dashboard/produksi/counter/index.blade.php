@extends('layout.layout-dashboard')

@section('content')
    <div class="card p-3 mb-5 shadow-sm">
        <h5>Counter</h5>
        <form class="row" action="{{ route('counter-store', ['produksi_id'=>$produksi_id, 'batch_id'=>$batch_id, 'param_id'=>$param_id]) }}" method="POST">
            @csrf
            <div class="col-12">
                <label for="">Counter</label>
                <input class="form-control" type="number" name="counter" id="" placeholder="Counter">
            </div>
            <div class="col-12 mt-3">
                <button class="btn text-white" style="background-color:#98c1d9 ">Submit</button>
            </div>
        </form>
    </div>
@endsection
