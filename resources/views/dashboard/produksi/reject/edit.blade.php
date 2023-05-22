@extends('layout.layout-dashboard')

@section('content')
    <div class="card p-3 mb-5 shadow-sm">
        <h5>Reject</h5>
        <form class="row" action="{{ route('reject-update', $reject->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="col-6 col-md-3">
                <label for="">Pilih Jenis</label>
                <select disabled class="form-select" name="id_jenis_reject" id="pilih-jenis">
                    <option disabled selected value="">Jenis Rejct</option>
                    @foreach ($jenis_rejects as $jenis_reject)
                        <option value="{{ $jenis_reject->id }}"
                            {{ $jenis_reject->id == $reject->id_jenis_reject ? 'selected' : '' }}>{{ $jenis_reject->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @if ($reject->id_jenis_reject == '1')
                <div class="col-6 col-md-3 botol">
                    <label for="">Pilih Tempat</label>
                    <select class="form-select" name="id_tempat_reject" id="">
                        <option disabled selected value="">Pilih Tempat</option>
                        @foreach ($tempat_rejects as $tempat_reject)
                            <option value="{{ $tempat_reject->id }}"
                                {{ $tempat_reject->id == $reject->id_tempat_reject ? 'selected' : '' }}>
                                {{ $tempat_reject->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            <div class="col-6 col-md-3 botol-cap">
                <label for="">Pilih Tempat</label>
                <select class="form-select" name="id_spesifik_tempat" id="">
                    <option disabled selected value="">Pilih Tempat</option>
                    @foreach ($spesifik_rejects as $spesifik_reject)
                        <option value="{{ $spesifik_reject->id }}"
                            {{ $spesifik_reject->id == $reject->id_spesifik_reject ? 'selected' : '' }}>
                            {{ $spesifik_reject->name }}</option>
                    @endforeach
                </select>
            </div>
            @if ($reject->id_jenis_reject == '1')
                <div class="col-6 col-md-3 botol">
                    <label for="">Parameter Reject</label>
                    <select class="form-select" name="id_paramater_reject" id="">
                        <option disabled selected value="">Parameter Reject</option>
                        @foreach ($parameter_rejects as $parameter_reject)
                            <option value="{{ $parameter_reject->id }}"
                                {{ $parameter_reject->id == $reject->id_paramater_reject ? 'selected' : '' }}>
                                {{ $parameter_reject->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            <div class="col-6 col-md-3 botol-cap">
                <label for="">Jumlah</label>
                <input placeholder="Jumlah Reject" type="text" name="jumlah_reject" value="{{ $reject->jumlah_reject }}"
                    class="form-control">
            </div>

            <div class="col-12 mt-3">
                <a href="/dashboard/reject-produksi" class="btn text-white" style="background-color: #98c1d9">Back</a>
                <button class="btn text-white" style="background-color:#98c1d9 ">Submit</button>
            </div>
        </form>
    </div>
@endsection
