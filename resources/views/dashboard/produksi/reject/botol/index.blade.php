@extends('layout.layout-dashboard')

@section('content')
    <div class="card p-3 mb-5 shadow-sm">
        <h5>Botol</h5>
        <form class="row"
            action="{{ route('reject-botol-store', ['produksi_id' => $produksi_id, 'batch_id' => $batch_id]) }}"
            method="POST">
            @csrf
            <div class="col-6 col-md-3 botol my-3">
                <label for="">Pilih Tempat</label>
                <select class="form-select" name="id_tempat_reject" id="ganti" required>
                    <option disabled selected value="">Pilih Tempat</option>
                    @foreach ($tempat_rejects as $tempat_reject)
                        <option value="{{ $tempat_reject->id }}">{{ $tempat_reject->name }}</option>
                    @endforeach
                </select>

            </div>
            <table class="table table-bordered text-center" style="border-collapse: collapse">
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Parameter</th>
                    <th colspan="2" id="spesifik">Pilih Spesifik tempat</th>
                </tr>
                <tr>
                    <td>Produksi</td>
                    <td>HCI</td>
                </tr>
                @foreach ($parameter_rejects as $key => $reject)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $reject['name'] }}</td>
                        <td>
                            <input {{ isset($previousData[$reject['id']][1]) ? 'disabled' : '' }}
                                id="produksi_{{ $reject['id'] }}" class="form-control" type="number"
                                name="reject[{{ $key }}][produksi]"
                                value="{{ isset($previousData[$reject['id']][1]) ? $previousData[$reject['id']][1] : '' }}">
                        </td>
                        <td>
                            <input {{ isset($previousData[$reject['id']][2]) ? 'disabled' : '' }}
                                id="hci_{{ $reject['id'] }}" class="form-control" type="number"
                                name="reject[{{ $key }}][hci]"
                                value="{{ isset($previousData[$reject['id']][2]) ? $previousData[$reject['id']][2] : '' }}">
                        </td>
                    </tr>
                @endforeach
            </table>
            <div class="col-12 mt-3">
                <button class="btn text-white" style="background-color:#98c1d9 ">Submit</button>
            </div>
    </form>

    {{-- <form class="row" action="{{ route('reject-botol-store', ['produksi_id'=>$produksi_id, 'batch_id'=>$batch_id]) }}" method="POST">
            @csrf
            <div class="col-6 col-md-3 botol">
                <label for="">Pilih Tempat</label>
                <select class="form-select" name="id_tempat_reject" id="">
                    <option disabled selected value="">Pilih Tempat</option>
                    @foreach ($tempat_rejects as $tempat_reject)
                        <option value="{{ $tempat_reject->id }}">{{ $tempat_reject->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 col-md-3 botol-cap">
                <label for="">Pilih Tempat</label>
                <select class="form-select" name="id_spesifik_tempat" id="">
                    <option disabled selected value="">Pilih Tempat</option>
                    @foreach ($spesifik_rejects as $spesifik_reject)
                        <option value="{{ $spesifik_reject->id }}">{{ $spesifik_reject->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 col-md-3 botol">
                <label for="">Parameter Reject</label>
                <select class="select2 form-select" name="id_paramater_reject" >
                    <option disabled selected value="">Parameter Reject</option>
                    @foreach ($parameter_rejects as $parameter_reject)
                        <option value="{{ $parameter_reject->id }}">{{ $parameter_reject->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 col-md-3 botol-cap">
                <label for="">Jumlah</label>
                <input placeholder="Jumlah Reject" type="number" name="jumlah_botol" class="form-control">
            </div>

            <div class="col-12 mt-3">
                <button class="btn text-white" style="background-color:#98c1d9 ">Submit</button>
            </div>
        </form> --}}
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
