@extends('layout.layout-dashboard')

@section('content')
    @if (Auth::user()->role_id == 3)
        <div class="card p-3 mb-5 shadow-sm" style="border:none; border-left: 40px solid #98c1d9;">
            <h5>Batch List - {{ $produksi->varian->parameter->name }} {{ $tgl_produksi }} </h5>
            <form class="row" action="{{ route('batch-list-store', $id) }}" method="POST">
                @csrf
                <div class=" col-sm-12 col-md-12">
                    <label for="">Batch List</label>
                    <div class="input-group">
                        <select name="batch_id" id="" class="form-select">
                            <option selected disabled value="">Pilih Batch</option>
                            @foreach ($batchs as $batch)
                                <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <button class="btn text-white" style="background-color: #98c1d9">Submit</button>
                </div>
            </form>
        </div>
    @endif
    <div class="d-flex flex-wrap gap-4">
        <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
            <strong style="font-size: 25px">Total Reject</strong>
            <strong style="font-size: 25px">{{ $reject }}</strong>
        </div>
        <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
            <strong style="font-size: 25px">Total Sampel</strong>
            <strong style="font-size: 25px">{{ $sampel }}</strong>
        </div>
        <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
            <strong style="font-size: 25px">Total Trial</strong>
            <strong style="font-size: 25px">{{ $trial }}</strong>
        </div>
        <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
            <strong style="font-size: 25px">Total Finish Good</strong>
            <strong style="font-size: 25px">{{ $finish_good }}</strong>
        </div>
    </div>

    <a href={{ route('batch-index', $id) }} class="btn btn-primary my-2" style="float: right"><i
            class="fa-solid fa-plus"></i> Tambah Batch</a>
    <a href={{ route('processing-index', $id) }} class="btn btn-primary my-2 mx-1" style="float: right"><i
            class="fa-solid fa-prescription-bottle"></i></i> Loss Liquid</a>
    <table
        class="text-center justify-content-center align-items-center table table-hover table-responsive-sm shadow-sm rounded-4">
        <thead class="table text-white font-bold fw-bold" style="background-color: #98c1d9">
            <td>No</td>
            <td>Batch</td>
            <td>Keterangan</td>
            <td>Tgl Batch</td>
            <td>Action</td>
        </thead>
        @forelse ($batch_lists as $batch_list)
            <tr class="bg-white">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $batch_list->batch->name }} </td>
                <td>{{ $batch_list->keterangan }}</td>
                <td>{{ \Carbon\Carbon::parse($batch_list->created_at_batch)->format('d/m/Y') }}</td>
                <td>
                    {{-- <form action="{{ route('processing-delete', $batch_list->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a class="btn" style="color:#98c1d9" href="{{ route('processing-edit', $processing->id) }}"><i
                                class="fa-solid fa-pen fa-lg"></i></a>
                        <button class="btn" type="submit"><i
                                class="fa-solid fa-trash-can fa-lg text-danger"></i></button>
                    </form> --}}
                    <a href="{{ route('reject-botol-index', ['produksi_id' => $batch_list->produksi_id, 'batch_id' => $batch_list->batch_id]) }}"
                        class="btn btn-primary">Reject</a>

                    <!-- Modal -->

                    <a href="{{ route('sampel-botol-index', ['produksi_id' => $batch_list->produksi_id, 'batch_id' => $batch_list->batch_id]) }}"
                        class="btn btn-primary">Sampel</a>

                    <!-- Modal -->


                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop3{{ $batch_list->produksi_id }}{{ $batch_list->batch_id }}">
                        Trial
                    </button>

                    <div class="modal fade" id="staticBackdrop3{{ $batch_list->produksi_id }}{{ $batch_list->batch_id }}"
                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Pilih Trial
                                        {{ $batch_list->batch->name }} yang akan dilakukan
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <a href="{{ route('trial-botol', ['produksi_id' => $batch_list->produksi_id, 'batch_id' => $batch_list->batch_id]) }}"
                                        class="btn btn-primary">Botol</a>
                                    <a href="{{ route('trial-cap', ['produksi_id' => $batch_list->produksi_id, 'batch_id' => $batch_list->batch_id]) }}"
                                        class="btn btn-primary">Cap</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop4{{ $batch_list->produksi_id }}{{ $batch_list->batch_id }}">
                        Finish Good
                    </button>

                    <div class="modal fade" id="staticBackdrop4{{ $batch_list->produksi_id }}{{ $batch_list->batch_id }}"
                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Finish Good
                                        {{ $batch_list->batch->name }}
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="row" action="{{ route('finish-store', ['produksi_id' => $batch_list->produksi_id, 'batch_id' => $batch_list->batch_id]) }}"
                                        method="POST">
                                        @csrf
                                        <div class="col-12">
                                            <label for="pcs">Pcs</label>
                                            <input class="form-control" type="number" name="pcs" id="pcs">
                                        </div>
                                        <div class="col-12 mt-3">
                                            <button class="btn text-white" style="background-color:#98c1d9 ">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td class="text-center h5 bg-white" colspan="7">Result not found.</td>
            </tr>
        @endforelse
    </table>

@endsection
