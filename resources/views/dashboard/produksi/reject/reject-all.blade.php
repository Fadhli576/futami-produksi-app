@extends('layout.layout-dashboard')

@section('content')
    <h4 class="fw-bold text-black">Data Reject </h4>
    <form class="d-flex gap-3 mb-3" method="GET" action="{{ route('reject-botol-all', $produksi_id) }}">
        <div class="d-flex flex-column">
            <label for="">Pilih filter</label>
            <select name="filter" id="" class="form-select">
                <option selected disabled value="">Pilih filter</option>
                <option value="terbesar">Terbesar</option>
                <option value="terkecil">Terkecil</option>
            </select>
        </div>
        <div class="d-flex flex-column ">
            <label for="">Filter Parameter</label>
            <select name="parameter" id="" class="form-select select2">
                <option selected disabled value="">Pilih Parameter</option>
                @foreach ($parameter_rejects as $parameter)
                    <option value="{{ $parameter->id }}">{{ $parameter->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="d-flex flex-column ">
            <label for="">Filter Tempat</label>
            <select name="tempat" id="" class="form-select select2">
                <option selected disabled value="">Pilih Tempat</option>
                @foreach ($tempat_rejects as $tempat)
                    <option value="{{ $tempat->id }}">{{ $tempat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="d-flex flex-column ">
            <label for="">Filter Spesifik</label>
            <div class="d-flex">
                <select name="spesifik" id="" class="form-select select2">
                    <option selected disabled value="">Pilih Spesifik</option>
                    @foreach ($spesifik_rejects as $spesifik)
                        <option value="{{ $spesifik->id }}">{{ $spesifik->name }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                <a class="btn btn-danger" href="{{ route('reject-botol-all', $produksi_id) }}"><i
                        class="fa-solid fa-arrows-rotate"></i></a>
            </div>
        </div>

    </form>
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
                <td>{{ $reject->jumlah_botol }}</td>
                <td>
                    <form action="{{ route('reject-botol-delete', $reject->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a class="btn" style="color:#98c1d9" href="{{ route('reject-botol-edit', $reject->id) }}"><i
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

    <script>
        let ganti = document.getElementById("ganti")

        ganti.addEventListener("change", () => {

            document.getElementById("spesifik").innerHTML = ganti.options[ganti.selectedIndex].text
            var inputFields = document.querySelectorAll('input[name^="reject"]');
            inputFields.forEach(function(input) {
                input.value = '';
            });
        })
    </script>
@endsection
