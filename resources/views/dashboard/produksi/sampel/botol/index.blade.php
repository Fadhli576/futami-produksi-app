@extends('layout.layout-dashboard')

@section('content')
    <div class="card p-3 mb-5 shadow-sm">
        <h5>Botol</h5>
        <form class="row"
            action="{{ route('sampel-botol-store', ['produksi_id' => $produksi_id, 'batch_id' => $batch_id]) }}"
            method="POST">
            @csrf
            <div class="col-6 col-md-3 botol my-3">
                <label for="">Pilih Tempat</label>
                <select class="form-select" name="id_tempat_reject" id="ganti" required>
                    <option disabled selected value="">Pilih Tempat</option>
                    @foreach ($tempat_samples as $tempat_reject)
                        <option value="{{ $tempat_reject->id }}">{{ $tempat_reject->name }}</option>
                    @endforeach
                </select>

            </div>
            <table class="table text-center table-bordered" style="border-collapse: collapse">
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Parameter</th>
                    <th colspan="2" id="spesifik">Pilih Spesifik tempat</th>
                </tr>
                <tr>
                    <td>Produksi</td>
                    <td>HCI</td>
                </tr>
                @foreach ($parameter_samples as $key => $reject)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $reject['name'] }}</td>
                        <td>
                            <input
                                id="produksi_{{ $reject['id'] }}" class="form-control" type="number"
                                name="sampel[{{ $key }}][produksi]" placeholder="{{$reject['name']}}"
                                >
                        </td>
                        <td>
                            <input
                                id="hci_{{ $reject['id'] }}" class="form-control" type="number"
                                name="sampel[{{ $key }}][hci]" placeholder="{{$reject['name']}}"
                                >
                        </td>
                    </tr>
                @endforeach
            </table>
            <div class="col-12 mt-3">
                <button class="btn text-white" style="background-color:#98c1d9 ">Submit</button>
            </div>
        </form>
    </div>

    <table
        class="text-center justify-content-center align-items-center table table-hover table-responsive-sm shadow-sm rounded-4">
        <thead class="table text-white font-bold fw-bold" style="background-color: #98c1d9">
            <td>No</td>
            <td>Produksi</td>
            <td>Jenis Sampel</td>
            <td>Tempat Sampel</td>
            <td>Spesifik Tempat</td>
            <td>Parameter Sampel</td>
            <td>Jumlah</td>
            <td>Action</td>
        </thead>
        @forelse ($samples as $sampel)
            <tr class="bg-white">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $sampel->produksi_id }}</td>
                <td>{{ $sampel->jenisSampel->name }}</td>
                <td>{{ $sampel->tempatSampel->name }}</td>
                <td>{{ $sampel->spesifikSampel->name }}</td>
                <td>{{ $sampel->parameterSampel->name }}</td>
                <td>{{ $sampel->jumlah_botol }}</td>
                <td>
                    <form action="{{ route('sampel-botol-delete', $sampel->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a class="btn" style="color:#98c1d9" href="{{ route('sampel-botol-edit', $sampel->id) }}"><i
                                class="fa-solid fa-pen fa-lg"></i></a>
                        <button class="btn" type="submit"><i
                                class="fa-solid fa-trash-can fa-lg text-danger"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td class="text-center h5 bg-white" colspan="8">Result not found.</td>
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
