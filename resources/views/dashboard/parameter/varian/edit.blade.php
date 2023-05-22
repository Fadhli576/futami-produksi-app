@extends('layout.layout-dashboard')

@section('content')
    @if (Auth::user()->role_id == 3)
        <div class="card p-3 mb-5 shadow-sm">
            <h5>Parameter Varian</h5>
            <form class="row" action="{{ route('parameter-varian-update', $parameterVarian->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <label for="">Name</label>
                    <input class="form-control" type="text" name="name" id="" value="{{$parameterVarian->name}}" placeholder="Parameter Varian">
                </div>
                <div class="col-12 mt-3">
                    <button class="btn text-white" style="background-color:#98c1d9 ">Submit</button>
                </div>
            </form>
        </div>
    @endif

    {{-- {{ $lakbans->links('pagination::bootstrap-4') }} --}}
@endsection
