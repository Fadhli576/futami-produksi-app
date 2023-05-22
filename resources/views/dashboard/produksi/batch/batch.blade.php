@extends('layout.layout-dashboard')

@section('content')
    @if (Auth::user()->role_id == 3)
        <div class="card p-3 mb-5 shadow-sm" style="border:none; border-left: 40px solid #98c1d9;">
            <h5>Batch</h5>
            <form class="row" action="{{ route('batch-store', $id) }}" method="POST">
                @csrf
                <div class=" col-sm-12 col-md-12">
                    <label for="">Name</label>
                    <div class="input-group">
                        <input placeholder="Batch name" class="form-control" type="text" name="name"
                            id="">
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <button class="btn text-white" style="background-color: #98c1d9">Submit</button>
                </div>
            </form>
        </div>
    @endif
    {{-- <table
        class="text-center justify-content-center align-items-center table table-hover table-responsive-sm shadow-sm rounded-4">
        <thead class="table text-white font-bold fw-bold" style="background-color: #98c1d9">
            <td>No</td>
            <td>Volume Mixing</td>
            <td>Drain Out</td>
            <td>Density</td>
            <td>Volume</td>
            <td>Counter Filling</td>
            <td>Action</td>
        </thead>
        @forelse ($processing as $processing)
            <tr class="bg-white">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $processing->volume_mixing }}</td>
                <td>{{ $processing->drain_out }}</td>
                <td>{{ $processing->density->name }}</td>
                <td>{{ $processing->volume }}</td>
                <td>{{ $processing->counter_filling }}</td>
                <td>
                    <form action="{{ route('processing-delete', $processing->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a class="btn" style="color:#98c1d9" href="{{ route('processing-edit', $processing->id) }}"><i
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

@endsection
