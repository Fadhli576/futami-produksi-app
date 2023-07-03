@extends('layout.layout-dashboard')

@section('content')
    @if (Auth::user()->role_id == 3)
        <div class="card p-3 mb-5 shadow-sm" style="border:none; border-left: 40px solid #98c1d9;">
            <div class="row">
                <div class=" col-sm-12 col-md-12 mb-4">
                    {{-- <label for="">Volume Mixing</label> --}}
                    <h4>Edit Volume Mixing</h4>
                    @if ($batch_lists->count() == 0)
                        <p>Belum ada Volume Mixing</p>
                    @else
                        <form class="col" action="{{ route('processing-volume-mixing-update', $id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <table class="table">
                                @forelse ($batch_lists as $key => $batch_list)
                                    <tr>
                                        <td>{{ $batch_list->name }}</td>
                                        <td>
                                            <div class="input-group">
                                                <input placeholder="Counter" class="form-control" type="number"
                                                    name="volume_mixing[{{ $batch_list->id }}]" id=""
                                                    value="{{ $batch_list->volume_mixing }}">
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
            </div>
        </div>
    @endif
@endsection
