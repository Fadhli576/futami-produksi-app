@extends('layout.layout-dashboard')

@section('content')
    @if (Auth::user()->role_id == 3)
        <div class="card p-3 mb-5 shadow-sm">
            <h5>Parameter Reject</h5>
            <form class="row" action="{{ route('parameter-reject-update', $parameterReject->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <label for="">Name</label>
                    <input class="form-control" type="text" name="name" id="" placeholder="Parameter Reject" value="{{ $parameterReject->name }}">
                </div>
                <div class="col-12 mt-3">
                    <button class="btn text-white" style="background-color:#98c1d9 ">Submit</button>
                </div>
            </form>
        </div>
    @endif
    {{-- <table
        class="text-center justify-content-center align-items-center table table-hover table-responsive-sm shadow-sm rounded-4">
        <thead class="table text-white font-bold fw-bold" style="background-color: #98c1d9">
            <td>No</td>
            <td>Nama</td>
            <td>Spesifikasi</td>
            <td>Action</td>
        </thead>
        @forelse ($parameter_reject as $reject)
            <tr class="bg-white">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $reject->name }}</td>
                <td>{{ $reject->spesifikasi }}</td>
                <td>
                    <form action="{{ route('parameter-reject-delete', $reject->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a class="btn" style="color:#98c1d9" href="{{ route('parameter-reject-edit', $reject->id) }}"><i
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
    </table> --}}

    {{-- {{ $lakbans->links('pagination::bootstrap-4') }} --}}
@endsection
