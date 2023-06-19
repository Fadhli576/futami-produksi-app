@extends('layout.layout-dashboard')

@section('content')
    <div class="card p-3 mb-5 shadow-sm">
        <h5>Cap</h5>
        <form class="row" action="{{ route('trial-cap-store', ['produksi_id'=>$produksi_id, 'batch_id'=>$batch_id]) }}" method="POST">
            @csrf
            <div class="col-12">
                <label for="">Trial Cap</label>
                <input class="form-control" type="number" name="trial_cap" id="" placeholder="Trial">
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
        <td>Trial</td>
        <td>Action</td>
    </thead>
    @forelse ($trials as $trial)
        <tr class="bg-white">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $trial->trial_botol }}</td>
            <td>
                <form action="{{ route('trial-delete', $trial->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <a class="btn" style="color:#98c1d9" href="{{ route('trial-edit', $trial->id) }}"><i
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
