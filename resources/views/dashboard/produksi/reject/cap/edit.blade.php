@extends('layout.layout-dashboard')

@section('content')
    <div class="card p-3 mb-5 shadow-sm">
        <h5>Cap</h5>
        <form class="row" action="{{ route('reject-cap-update', ['id' => $id, 'reject' => $reject]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="col-6 col-md-3 botol-cap">
                <label for="">Pilih Tempat</label>
                <select class="form-select" name="id_spesifik_tempat" id="">
                    <option disabled selected value="">Pilih Tempat</option>
                    @foreach ($spesifik_rejects as $spesifik_reject)
                        <option value="{{ $spesifik_reject->id }}" {{ $spesifik_reject->id == $rejek->id_spesifik_tempat }}>
                            {{ $spesifik_reject->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 col-md-3 botol-cap">
                <label for="">Jumlah</label>
                <input placeholder="Jumlah Reject" type="text" name="jumlah_cap" value="{{ $rejek->jumlah_cap }}"
                    class="form-control">
            </div>

            <div class="col-12 mt-3">
                <button class="btn text-white" style="background-color:#98c1d9 ">Submit</button>
            </div>
        </form>
    </div>
@endsection
