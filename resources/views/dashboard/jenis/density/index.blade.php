@extends('layout.layout-dashboard')

@section('content')
    @if (Auth::user()->role_id == 3)
        <div class="card p-3 mb-5 shadow-sm">
            <h5>Jenis Density</h5>
            <form class="row" action="{{ route('density-store') }}" method="POST">
                @csrf
                <div class="col-12 col-md-6">
                    <label for="">Jenis Density</label>
                    <input class="form-control" type="number" name="name" id="" step="any" placeholder="Density">
                </div>
                <div class="col-12 col-md-6">
                    <label for="">Spesifikasi</label>
                    <input class="form-control" type="text" name="spesifikasi" id="" placeholder="Spesifikasi">
                </div>
                <div class="col-12 mt-3">
                    <button class="btn text-white" style="background-color:#98c1d9 ">Submit</button>
                </div>
            </form>
        </div>
    @endif
    <table
        class="text-center justify-content-center align-items-center table table-hover table-responsive-sm shadow-sm rounded-4">
        <thead class="table text-white font-bold fw-bold" style="background-color: #98c1d9">
            <td>No</td>
            <td>Nama</td>
            <td>Spesifikasi</td>
            <td>Action</td>
        </thead>
        @forelse ($densities as $density)
            <tr class="bg-white">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $density->name }}</td>
                <td>{{ $density->spesifikasi }}</td>
                <td>
                    {{-- <form action="{{ route('jenis-cap-delete', $cap->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a class="btn" style="color:#98c1d9" href="{{ route('jenis-cap-edit', $cap->id) }}"><i
                                class="fa-solid fa-pen fa-lg"></i></a>
                        <button class="btn" type="submit"><i
                                class="fa-solid fa-trash-can fa-lg text-danger"></i></button>
                    </form> --}}
                </td>
            </tr>
        @empty
            <tr>
                <td class="text-center h5 bg-white" colspan="7">Result not found.</td>
            </tr>
        @endforelse
    </table>

   {{-- {{ $caps->links('pagination::bootstrap-4') }} --}}
@endsection
