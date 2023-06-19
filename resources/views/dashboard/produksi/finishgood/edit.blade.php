@extends('layout.layout-dashboard')

@section('content')
    @if (Auth::user()->role_id == 3)
        <div class="card p-3 mb-5 shadow-sm" style="border:none; border-left: 40px solid #98c1d9;">
            <h5>Edit Finish Good</h5>
            <form class="row" action="{{ route('finish-good-update', $produksi_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class=" col-sm-12 col-md-12">
                    <table class="table">
                        @forelse ($finishgoods as $key => $finishgood)
                            <tr>
                                <td> {{ $finishgood->batch->name }} </td>
                                <td> <input class="form-control" type="number" name="pcs[{{ $finishgood->id }}]"
                                        value="{{ $finishgood->pcs }}" id=""> </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">Belum ada finish good</td>
                            </tr>
                        @endforelse

    </table>
    </div>
    @if (!$finishgoods->count() == 0)
        <div class="col-12 mt-2">
            <button class="btn text-white" style="background-color: #98c1d9">Submit</button>
        </div>
    @endif
    </form>
    </div>
    @endif
@endsection
