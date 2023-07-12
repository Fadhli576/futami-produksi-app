@extends('layout.layout-dashboard')

@section('content')
    @if (Auth::user()->role_id == 3)
        <div class="card p-3 mb-5 shadow-sm" style="border:none; border-left: 40px solid #98c1d9;">
            <h5>Produksi</h5>
            <form class="row" action="{{ route('produksi-store') }}" method="POST">
                @csrf
                <div class=" col-sm-12 col-md-4">
                    <label for="">Varian</label>
                    <div class="input-group">
                        <select name="varian_id" class="form-select" aria-label="select">
                            <option selected disabled value="">Pilih Varian</option>
                            @foreach ($varians as $varian)
                                <option value="{{ $varian->id }}">{{ $varian->parameter->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class=" col-sm-12 col-md-4">
                    <label for="">Tanggal Produksi</label>
                    <div class="input-group">
                        <input placeholder="Keterangan" class="form-control" type="date" name="tgl_produksi" id="">
                    </div>
                </div>
                <div class=" col-sm-12 col-md-4">
                    <label for="">Keterangan</label>
                    <div class="input-group">
                        <input placeholder="Keterangan" class="form-control" type="text" name="keterangan" id="">
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <button class="btn text-white" style="background-color: #98c1d9">Submit</button>
                </div>

            </form>
        </div>
    @endif
    <table
        class="text-center justify-content-center align-items-center table table-hover table-responsive-sm shadow-sm rounded-4">
        <thead class="table text-white font-bold fw-bold" style="background-color: #98c1d9">
            <td>No</td>
            <td>Varian</td>
            <td>Tgl Produksi</td>
            <td>Keterangan</td>
            <td>Action</td>
        </thead>
        @forelse ($produksis as $produksi)
            <tr class="bg-white">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $produksi->varian->parameter->name }}</td>
                <td>{{ \Carbon\Carbon::parse($produksi->tgl_produksi)->format('d/m/Y')}}</td>
                <td>{{ $produksi->keterangan }}</td>
                <td>
                    {{-- <form action="{{ route('processing-delete', $processing->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a class="btn" style="color:#98c1d9" href="{{ route('processing-edit', $processing->id) }}"><i
                                class="fa-solid fa-pen fa-lg"></i></a>
                        <button class="btn" type="submit"><i
                                class="fa-solid fa-trash-can fa-lg text-danger"></i></button>
                    </form> --}}
                    <a class="btn btn-primary" href="{{ route('varian-detail', $produksi->id) }}">Detail</a>
                    <a class="btn btn-primary" href="{{ route('batch-list-index', $produksi->id) }}">Batch List</a>
                </td>
            </tr>
        @empty
            <tr>
                <td class="text-center h5 bg-white" colspan="7">Result not found.</td>
            </tr>
        @endforelse
    </table>

@endsection
