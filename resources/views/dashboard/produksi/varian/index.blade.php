@extends('layout.layout-dashboard')

@section('content')
    @if (Auth::user()->role_id == 3)
        <div class="card p-3 mb-5 shadow-sm" style="border:none; border-left: 40px solid #98c1d9;">
            <h5>Varian</h5>
            <form class="row" action="{{ route('varian-store') }}" method="POST">
                @csrf
                <div class=" col-sm-12 col-md-6">
                    <label for="">Parameter Varian</label>
                    <div class="input-group">
                        <select name="parameter_id" id="" class="form-select">
                            <option selected disabled value="">Pilih Parameter Varian</option>
                            @foreach ($parameters as $parameter)
                                <option value="{{ $parameter->id }}">{{ $parameter->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="">Jenis Botol</label>
                    <div class="input-group">
                        <select name="botol_id" id="" class="form-select">
                            <option selected disabled value="">Pilih Jenis Botol</option>
                            @foreach ($botols as $botol)
                                <option value="{{ $botol->id }}">{{ $botol->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="">Jenis Cap</label>
                    <div class="input-group">
                        <select name="cap_id" id="" class="form-select">
                            <option selected disabled value="">Pilih Jenis Cap</option>
                            @foreach ($caps as $cap)
                                <option value="{{ $cap->id }}">{{ $cap->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 ">
                    <label for="">Jenis Label</label>
                    <div class="input-group">
                        <select name="label_id" id="" class="form-select">
                            <option selected disabled value="">Pilih Jenis Label</option>
                            @foreach ($labels as $label)
                                <option value="{{ $label->id }}">{{ $label->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="">Jenis Karton</label>
                    <div class="input-group">
                        <select name="karton_id" id="" class="form-select">
                            <option selected disabled value="">Pilih Jenis Karton</option>
                            @foreach ($kartons as $karton)
                                <option value="{{ $karton->id }}">{{ $karton->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="">Jenis Lakban</label>
                    <div class="input-group">
                        <select name="lakban_id" id="" class="form-select">
                            <option selected disabled value="">Pilih Jenis Lakban</option>
                            @foreach ($lakbans as $lakban)
                                <option value="{{ $lakban->id }}">{{ $lakban->name }}</option>
                            @endforeach
                        </select>
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
            <td>Nama</td>
            <td>Jenis Botol</td>
            <td>Jenis Cap</td>
            <td>Jenis Label</td>
            <td>Jenis Karton</td>
            <td>Jenis Lakban</td>
            <td>Action</td>
        </thead>
        @forelse ($varians as $varian)
            <tr class="bg-white" data-href="{{ route('varian-detail', $varian->id) }}" style="cursor: pointer;" >
                <td>{{ $loop->iteration }}</td>
                <td>{{ $varian->parameter->name }}</td>
                <td>{{ $varian->botol->name }}</td>
                <td>{{ $varian->cap->name }}</td>
                <td>{{ $varian->label->name }}</td>
                <td>{{ $varian->karton->name }}</td>
                <td>{{ $varian->lakban->name }}</td>
                <td>
                    <form action="{{ route('varian-delete', $varian->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a class="btn" style="color:#98c1d9" href="{{ route('varian-edit', $varian->id) }}"><i
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
        var rows = document.querySelectorAll('tr[data-href]');

        rows.forEach(function(row) {
            row.addEventListener('click', function() {
                window.location.href = row.dataset.href;
                console.log(row.dataset);
            });
        });
    </script>

@endsection
