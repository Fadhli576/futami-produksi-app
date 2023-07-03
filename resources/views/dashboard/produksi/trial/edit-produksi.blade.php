@extends('layout.layout-dashboard')

@section('content')
    <div class="card p-3 mb-5 shadow-sm">
        <h5>Trial</h5>
        <form class="row" action="{{ route('trial-update', $id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="col-12">
                <label for="">Edit Trial</label>
                <input class="form-control" value="{{$trial->trial_botol == '' ? $trial->trial_cap : $trial->trial_botol}}" type="number" name="{{$trial->trial_botol == '' ? 'trial_cap' : 'trial_botol'}}" id="" placeholder="Trial">
            </div>
            <div class="col-12 mt-3">
                <button class="btn text-white" style="background-color:#98c1d9 ">Submit</button>
            </div>
        </form>
    </div>
@endsection
