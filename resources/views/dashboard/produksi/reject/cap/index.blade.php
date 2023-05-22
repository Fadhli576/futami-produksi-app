@extends('layout.layout-dashboard')

@section('content')
    <div class="card p-3 mb-5 shadow-sm">
        <h5>Cap</h5>
        <form class="row" action="{{ route('reject-cap-store', ['produksi_id'=>$produksi_id, 'batch_id'=>$batch_id]) }}" method="POST">
            @csrf
            <div class="col-6 col-md-3 botol-cap">
                <label for="">Pilih Tempat</label>
                <select class="form-select" name="id_spesifik_tempat" id="">
                    <option disabled selected value="">Pilih Tempat</option>
                    @foreach ($spesifik_rejects as $spesifik_reject)
                        <option value="{{ $spesifik_reject->id }}">{{ $spesifik_reject->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 col-md-3 botol-cap">
                <label for="">Jumlah</label>
                <input placeholder="Jumlah Reject" type="number" name="jumlah_cap" class="form-control">
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
            <td>Spesifik</td>
            <td>Parameter</td>
            <td>Jumlah</td>
            <td>Action</td>
        </thead>
        @forelse ($rejects as $reject)
            <tr class="bg-white">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $reject->jenisReject->name }}</td>
                <td>{{ $reject->spesifikTempat->name }}</td>
                <td>{{ $reject->parameterReject->name }}</td>
                <td>{{ $reject->jumlah_cap }}</td>
                <td>
                    <form action="{{ route('reject-cap-delete', $reject->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a class="btn" style="color:#98c1d9" href="{{ route('reject-cap-edit', $reject->id) }}"><i
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
