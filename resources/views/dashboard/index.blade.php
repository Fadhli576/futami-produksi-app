@extends('layout.layout-dashboard')

@section('content')
    <div class="card bg-white p-3 shadow-sm" style="border-left: 40px solid #98c1d9">
        <strong style="font-size: 25px">Selamat Datang!</strong>
        <p>Selamat datang, {{ Auth::user()->name }}.</p>
    </div>

    <div class="d-flex mt-3 gap-4">
        <div class="card bg-white p-3 shadow-sm" style="border-left: 20px solid #98c1d9">
            <strong style="font-size: 25px">Total Varian</strong>
            <strong style="font-size: 25px">{{ $varians }}</strong>
        </div>
    </div>
@endsection
