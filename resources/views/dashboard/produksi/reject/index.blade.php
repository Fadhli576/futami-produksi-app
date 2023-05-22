@extends('layout.layout-dashboard')

@section('content')
    <div class="card p-3 mb-5 shadow-sm">
        <h5>Reject</h5>
        <form class="row" action="{{ route('reject-store') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="col-6 col-md-3">
                <label for="">Pilih Jenis</label>
                <select class="form-select" name="id_jenis_reject" id="pilih-jenis">
                    <option disabled selected value="">Jenis Rejct</option>
                    @foreach ($jenis_rejects as $jenis_reject)
                        <option value="{{ $jenis_reject->id }}">{{ $jenis_reject->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 col-md-3 botol d-gaada">
                <label for="">Pilih Tempat</label>
                <select class="form-select" name="id_tempat_reject" id="">
                    <option disabled selected value="">Pilih Tempat</option>
                    @foreach ($tempat_rejects as $tempat_reject)
                        <option value="{{ $tempat_reject->id }}">{{ $tempat_reject->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 col-md-3 botol-cap d-gaada">
                <label for="">Pilih Tempat</label>
                <select class="form-select" name="id_spesifik_tempat" id="">
                    <option disabled selected value="">Pilih Tempat</option>
                    @foreach ($spesifik_rejects as $spesifik_reject)
                        <option value="{{ $spesifik_reject->id }}">{{ $spesifik_reject->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 col-md-3 botol d-gaada">
                <label for="">Parameter Reject</label>
                <select class="form-select" name="id_paramater_reject" id="">
                    <option disabled selected value="">Parameter Reject</option>
                    @foreach ($parameter_rejects as $parameter_reject)
                        <option value="{{ $parameter_reject->id }}">{{ $parameter_reject->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 col-md-3 botol-cap d-gaada">
                <label for="">Jumlah</label>
                <input placeholder="Jumlah Reject" type="text" name="jumlah_reject" class="form-control">
            </div>

            <div class="col-12 mt-3">
                <button class="btn text-white" style="background-color:#98c1d9 ">Submit</button>
            </div>
        </form>
    </div>

    <table
        class="text-center justify-content-center align-items-center table table-hover table-responsive-sm shadow-sm rounded-4">
        <thead class="table text-white font-bold fw-bold" style="background-color: #98c1d9">
            <td>No</td>
            <td>Jenis</td>
            <td>Tempat</td>
            <td>Spesifik</td>
            <td>Parameter</td>
            <td>Jumlah</td>
            <td>Action</td>
        </thead>
        @forelse ($rejects as $reject)
            <tr class="bg-white">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $reject->jenisReject->name }}</td>
                <td>{{ $reject->tempatReject->name }}</td>
                <td>{{ $reject->spesifikTempat->name }}</td>
                <td>{{ $reject->parameterReject->name }}</td>
                <td>{{ $reject->jumlah_reject }}</td>
                <td>
                    <form action="{{ route('reject-delete', $reject->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a class="btn" style="color:#98c1d9" href="{{ route('reject-edit', $reject->id) }}"><i
                                class="fa-solid fa-pen fa-lg"></i></a>
                        <button class="btn" type="submit"><i
                                class="fa-solid fa-trash-can fa-lg text-danger"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td class="text-center h5 bg-white" colspan="7">Result not found.</td>
            </tr>
        @endforelse
    </table>
@endsection
