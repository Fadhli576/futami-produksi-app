@extends('layout.layout-dashboard')

@section('content')
    @if (Auth::user()->role_id == 3)
        <div class="card p-3 mb-5 shadow-sm" style="border:none; border-left: 40px solid #98c1d9;">
            <div class="row">
                <div class=" col-sm-12 col-md-12 mb-4">
                    {{-- <label for="">Volume Mixing</label> --}}
                    <h4>Counter</h4>
                    @if ($batch_lists->count() == 0)
                        <p>Belum ada batch yang dipilih</p>
                    @else
                        <form class="col-"
                            action="{{ route('counter-store-multi', ['produksi_id' => $produksi_id, 'param_id' => $param_id]) }}"
                            method="POST">
                            @csrf
                            <table class="table">
                                @forelse ($batch_lists as $key => $batch_list)
                                    <tr>
                                        <td>{{ $batch_list->batch->name }}</td>
                                        <td>
                                            <div class="input-group">
                                                <input placeholder="Counter" class="form-control" type="number"
                                                    name="counter[{{ $key }}]" id="" value="">
                                            </div>
                                        </td>
                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="2">Belum ada batch yang dipilih</td>
                                    </tr>
                                @endforelse

                            </table>
                            @if (!$batch_lists->count() == 0)
                                <button class="btn text-white" style="background-color: #98c1d9">Submit</button>

                                <a href="{{ route('counter-edit', ['id' => $produksi_id, 'param_id' => $param_id]) }}"
                                    class="btn btn-primary" style="float: right"> <i class="fa-regular fa-pen-to-square"></i> Edit Counter</a>
                            @endif
                        </form>
                    @endif
                </div>
                @if ($param_id == 1)
                    <form class="col-sm-12 col-md-12 " action="{{ route('botol-detail-store', ['id' => $produksi_id]) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <label for="">Trial</label>
                        <div class="input-group">
                            <input value="{{ $varian->trial_botol }}" placeholder="Trial" class="form-control"
                                type="text" name="trial_botol" id="">
                        </div>
                        <label for="">Jatuh</label>
                        <div class="input-group">
                            <input value="{{ $varian->jatuh_botol }}" placeholder="Jatuh" value=""
                                class="form-control" type="text" name="jatuh_botol" id="">
                        </div>

                        <button class="btn text-white mt-3" style="background-color: #98c1d9">Submit</button>
                    </form>
                @endif

            </div>
        </div>
    @endif

@endsection
