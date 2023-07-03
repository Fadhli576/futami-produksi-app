@extends('layout.layout-dashboard')

@section('content')
    @if (Auth::user()->role_id == 3)
        <div class="card p-3 mb-5 shadow-sm" style="border:none; border-left: 40px solid #98c1d9;">
            <div class="row">
                <div class=" col-sm-12 col-md-12 mb-4">
                    {{-- <label for="">Volume Mixing</label> --}}
                    <h4>Counter</h4>
                    @if ($batch_lists->count() == 0)
                        <p>Belum ada counter</p>
                    @else
                        <form class="col" action="{{ route('counter-update',  ['id' => $id, 'param_id' => 1]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <table class="table">
                                @forelse ($batch_lists as $batch_list)
                                    <tr>
                                        <td>{{ $batch_list->batch_name }}</td>
                                        <td>
                                            <div class="input-group">
                                                <input placeholder="Counter" class="form-control" type="number"
                                                    name="counter[{{ $batch_list->id }}]" id=""
                                                    value="{{ $batch_list->counter }}">
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
                            @endif
                        </form>
                    @endif
                </div>
                {{-- <form class="col-sm-12 col-md-12 " action="{{ route('processing-store', $id) }}" method="POST">
                    @csrf
                    <label for="">Drain Out</label>
                    <div class="input-group">
                        <input value="{{ $processing_self == '' ? '' : $processing_self->drain_out }}"
                            placeholder="Drain Out" class="form-control" type="text" name="drain_out" id="">
                    </div>
                    <label for="">Density</label>
                    <div class="input-group">
                        <select name="density_id" id="" class="form-select">
                            <option selected disabled value="">Pilih Density</option>
                            @foreach ($densities as $density)
                                <option value="{{ $density->id }}"
                                    {{ $processing_self == '' ? '' : ($processing_self->density_id == $density->id ? 'selected' : '') }}>
                                    {{ $density->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="">Volume</label>
                    <div class="input-group">
                        <input placeholder="Volume (Gunakan . untuk desimal)"
                            value="{{ $processing_self == '' ? '' : $processing_self->volume }}" class="form-control"
                            type="text" name="volume" id="">
                        <span class="input-group-text">ml</span>
                    </div>
                    <div class="col-12 mt-2">
                        @if ($processing_self == null)
                            <button class="btn text-white" style="background-color: #98c1d9">Submit</button>
                        @endif
                        @if ($processing_self)
                        <a href={{ route('processing-edit', ['id' => $id, 'processing_id' => $processing_self->id]) }}
                            class="btn btn-primary my-2 mx-1" style="float: right"><i class="fa-solid fa-thumbs-up"></i>
                            Edit Loss Liquid</a>
                        @endif

                    </div>
                </form> --}}
            </div>
        </div>
    @endif

@endsection
