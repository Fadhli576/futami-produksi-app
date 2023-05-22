@extends('layout.layout-dashboard')

@section('content')
    @if (Auth::user()->role_id == 3)
        <div class="card p-3 mb-5 shadow-sm">
            <h5>Tempat</h5>
            <form class="row" action="{{ route('tempat-update', $tempatReject->id) }}" method="POST">
                @csrf
                <div class="col-12">
                    <label for="">Name</label>
                    <input class="form-control" type="text" name="name" id="" placeholder="Tempat" value="{{ $tempatReject->name }}">
                </div>
                <div class="col-12 mt-3">
                    <button class="btn text-white" style="background-color:#98c1d9 ">Submit</button>
                </div>
            </form>
        </div>
    @endif

    {{-- {{ $lakbans->links('pagination::bootstrap-4') }} --}}
@endsection
