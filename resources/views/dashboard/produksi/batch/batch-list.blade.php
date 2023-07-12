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
    <div class="d-flex flex-column flex-wrap gap-4">
        <a href="{{route('varian-detail', $id)}}" class="btn btn-primary">Varian <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
        <div class="global d-flex flex-wrap gap-3">
            <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                <strong style="font-size: 20px">Unidentified</strong>
                <strong
                    style="font-size: 20px">{{ $counter_filling == null ? '0' : $reject + $sampel + $finish_good - $counter_filling }}</strong>
            </div>
            <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                <strong style="font-size: 20px">Total Sampel</strong>
                <strong style="font-size: 20px">{{ $sampel }}</strong>
            </div>
            <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                <strong style="font-size: 20px">Total Finish Good</strong>
                <strong style="font-size: 20px">{{ $finish_good }}</strong>
            </div>
            <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                <strong style="font-size: 20px">Total Coding</strong>
                <strong style="font-size: 20px">{{ $counter_coding }}</strong>
            </div>
            <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                <strong style="font-size: 20px">Total Filling</strong>
                <strong style="font-size: 20px">{{ $counter_filling }}</strong>
            </div>
            <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                <strong style="font-size: 20px">Total Label</strong>
                <strong style="font-size: 20px">{{ $counter_label }}</strong>
            </div>
            <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                <strong style="font-size: 20px">Reject HCI</strong>
                <strong style="font-size: 20px">{{ $reject_hci }}</strong>
            </div>
            <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                <strong style="font-size: 20px">Defect HCI</strong>
                <strong style="font-size: 20px">{{ $defect_hci }}</strong>
            </div>
            <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                <strong style="font-size: 20px">Reject Supplier</strong>
                <strong style="font-size: 20px">{{ $reject_hci + $defect_hci }}</strong>
            </div>
            <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                <strong style="font-size: 20px">Total Reject</strong>
                <strong style="font-size: 20px">{{ $reject ? $reject : 0}}</strong>
            </div>
        </div>
        <div class="botol">
            <h4 class="fw-bold text-black">{{$varian->botol->name}}</h4>
            <div class="d-flex flex-wrap gap-3">
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Pakai Botol</strong>
                    <strong style="font-size: 20px">{{ $pakai_botol ? $pakai_botol : 0 }}</strong>
                </div>
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Reject Produksi Botol</strong>
                    <strong style="font-size: 20px">{{ $reject_produksi ? $reject_produksi : 0 }}</strong>
                </div>
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Trial Botol</strong>
                    <strong style="font-size: 20px">{{ $varian->trial_botol ? $varian->trial_botol : '0' }}</strong>
                </div>
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Jatuh Botol</strong>
                    <strong style="font-size: 20px">{{ $jatuh_botol ? $jatuh_botol : '0' }}</strong>
                </div>
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Trial Botol & Jatuh</strong>
                    <strong
                        style="font-size: 20px">{{ $varian->trial_botol || $jatuh_botol ? $varian->trial_botol + $jatuh_botol : '0' }}</strong>
                </div>
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Loss Botol</strong>
                    <strong
                        style="font-size: 20px">{{ $pakai_botol && $finish_good ? $pakai_botol - $finish_good : 0 }}</strong>
                    <strong>{{ $pakai_botol ? number_format((($varian->trial_botol + $reject_produksi + $sampel - $unidentified) / $pakai_botol) * 100, 2) : 0}} %</strong>
                </div>
            </div>
        </div>
        <div class="cap">
            <h4 class="fw-bold text-black">{{$varian->cap->name}}</h4>
            <div class="d-flex flex-wrap gap-3">
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Masuk Cap + Saldo awal</strong>
                    <strong style="font-size: 20px">{{ $varian->masuk_cap ? $varian->masuk_cap : 0 }}</strong>
                </div>
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Pakai Cap</strong>
                    <strong style="font-size: 20px">{{ $pakai_cap ? $pakai_cap : 0 }}</strong>
                </div>
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Trial Cap & Jatuh</strong>
                    <strong
                        style="font-size: 20px">{{ $varian->trial_cap || $varian->jatuh_filling_cap ? $varian->trial_cap + $varian->jatuh_filling_cap : '0' }}</strong>
                </div>
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Trial Cap</strong>
                    <strong style="font-size: 20px">{{ $varian->trial_cap ? $varian->trial_cap : '0' }}</strong>
                </div>
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Jatuh Filling Cap</strong>
                    <strong style="font-size: 20px">{{ $varian->jatuh_filling_cap ? $varian->jatuh_filling_cap : '0' }}</strong>
                </div>
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Reject Produksi Cap</strong>
                    <strong style="font-size: 20px">{{ $reject_produksi_cap ? $reject_produksi_cap : '0' }}</strong>
                </div>
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Saldo Akhir</strong>
                    <strong
                        style="font-size: 20px">{{ $varian->masuk_cap - $pakai_cap }}</strong>
                </div>
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Loss Cap</strong>
                    <strong
                        style="font-size: 20px">{{ $pakai_cap - $finish_good }}</strong>
                    <strong>{{ $pakai_cap ? number_format((($varian->trial_cap + $reject_produksi_cap + $sampel) / $pakai_cap) * 100, 2) : 0}} %</strong>
                </div>
            </div>
        </div>
        <div class="label">
            <h4 class="fw-bold text-black">{{$varian->label->name}}</h4>
            <div class="d-flex flex-wrap gap-3">
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Masuk Label + Saldo Awal</strong>
                    <strong style="font-size: 20px">{{ $varian->masuk_label ? $varian->masuk_label : 0 }}</strong>
            </div>
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Pakai Label</strong>
                    <strong
                        style="font-size: 20px">{{ $varian->pakai_label ? $varian->pakai_label : 0 }}</strong>
                </div>
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Saldo Akhir</strong>
                    <strong style="font-size: 20px">{{ $varian->saldo_label ? $varian->saldo_label : 0 }}</strong>
                </div>
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Reject Produksi Label</strong>
                    <strong style="font-size: 20px"> {{ $varian->saldo_label == '' ? '' : number_format(($varians = $varian->pakai_label - $finish_good / $varian->conversi_label) * 1, 2) }} </strong>
                    <strong> {{$varian->saldo_label == '' ? 0 : number_format(($varians / $varian->pakai_label) * 100, 2)}} %</strong>
                </div>
            </div>
        </div>
        <div class="karton">
            <h4 class="fw-bold text-black">{{$varian->karton->name}}</h4>
            <div class="d-flex flex-wrap gap-3">
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Masuk Karton + Saldo Awal</strong>
                    <strong style="font-size: 20px">{{ $varian->masuk_karton ? $varian->masuk_karton : 0 }}</strong>
                </div>
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Pakai Karton</strong>
                    <strong
                        style="font-size: 20px">{{ $varian->terpakai_karton ? $varian->terpakai_karton : 0}}</strong>
                </div>
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Saldo Akhir</strong>
                    <strong style="font-size: 20px">{{ $varian->saldo_karton ? $varian->saldo_karton : 0 }}</strong>
                </div>
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Reject Karton</strong>
                    <strong style="font-size: 20px">{{ $varian->reject_karton ? $varian->reject_karton : 0 }}</strong>
                    <strong>{{ $varian->reject_karton && $varian->pakai_karton ? number_format(($varian->reject_karton / $varian->pakai_karton) * 100, 2) : 0 }} %</strong>
             </div>
            </div>
        </div>
        <div class="lakban1">
            <h4 class="fw-bold text-black">{{$varian->lakban->name}}</h4>
            <div class="d-flex flex-wrap gap-3">
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Masuk Lakban + Saldo Awal</strong>
                    <strong style="font-size: 20px">{{ $varian->masuk_lakban ? $varian->masuk_lakban : 0}}</strong>
                </div>
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Pakai Lakban</strong>
                    <strong
                        style="font-size: 20px">{{ $varian->terpakai_lakban ? $varian->terpakai_lakban : 0}}</strong>
                </div>
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Saldo Akhir</strong>
                    <strong style="font-size: 20px">{{ $varian->saldo_lakban ? $varian->saldo_lakban : 0 }}</strong>
                </div>
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Reject Lakban</strong>
                    <strong style="font-size: 20px">{{ $varian->reject_lakban ? $varian->reject_lakban : 0 }}</strong>
                    <strong>{{ $varian->reject_lakban2 ? number_format(($varian->reject_lakban / $varian->pakai_lakban) * 100, 2) : 0 }} %</strong>
                </div>
            </div>
        </div>
        @if ($varian->lakban2_id)
        <div class="lakban2">
            <h4 class="fw-bold text-black">{{ $varian->lakban2->name }}</h4>
            <div class="d-flex flex-wrap gap-3">
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Masuk Lakban + Saldo Awal</strong>
                    <strong style="font-size: 20px">{{ $varian->masuk_lakban2 ? $varian->masuk_lakban2 : 0 }}</strong>
                </div>
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Pakai Lakban</strong>
                    <strong
                        style="font-size: 20px">{{ $varian->terpakai_lakban2 ? $varian->terpakai_lakban : 0 }}</strong>
                </div>
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Saldo Akhir</strong>
                    <strong style="font-size: 20px">{{ $varian->saldo_lakban2 ? $varian->saldo_lakban2 : 0 }}</strong>
                </div>
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Reject Lakban</strong>
                    <strong style="font-size: 20px">{{ $varian->reject_lakban2 ? $varian->reject_lakban2 : 0 }}</strong>
                    <strong>{{ $varian->reject_lakban2 ? number_format(($varian->reject_lakban2 / $varian->pakai_lakban2) * 100, 2) : 0 }} %</strong>
                </div>
            </div>
        </div>
        @endif

        <div class="loss-liquid">
            <h4 class="fw-bold text-black">Loss Liquid</h4>
            <div class="d-flex flex-wrap gap-3">
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Volume Mixing</strong>
                    <strong
                        style="font-size: 20px">{{ $volume_mixing == '' ? '0' : number_format($volume_mixing, 2) }}</strong>
                </div>
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Loss Liquid</strong>
                    <strong
                        style="font-size: 20px">{{ $loss_liquid == '' ? '0' : number_format($loss_liquid, 2) }}</strong>
                    <strong>{{ $loss_liquid ? number_format(($loss_liquid / $volume_mixing) * 100, 2) : 0}} %</strong>
                </div>
            </div>
        </div>
        <div class="hasil-porduksi-inline">
            <h4 class="fw-bold text-black">Hasil Produksi Inline</h4>
            <div class="d-flex flex-wrap gap-3">
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Actual</strong>
                    <strong
                        style="font-size: 20px">{{ $finish_good == '0' ? '0' : $actual = $finish_good + $sampel + $reject_produksi }}</strong>
                </div>
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Yield</strong>
                    <strong
                        style="font-size: 20px">{{ $yield == '' ? '0' : $yield }}</strong>
                    <strong>{{ $yield ? number_format(($yield / $volume_mixing) * 100, 2) : 0 }} %</strong>
                </div>
                <div class="card bg-white p-3 shadow-sm" style="border-left: 10px solid #98c1d9">
                    <strong style="font-size: 20px">Reject Rate</strong>
                    <strong
                        style="font-size: 20px">{{ $finish_good == '0' ? '0' : number_format((($actual - $finish_good) / $finish_good) * 100, 2)  }} %</strong>
                </div>
            </div>
        </div>
    </div>

    <a href={{ route('batch-index', $id) }} class="btn btn-primary my-2" style="float: right"><i
            class="fa-solid fa-plus"></i> Tambah Batch</a>
    <a href={{ route('processing-index', $id) }} class="btn btn-primary my-2 mx-1" style="float: right"><i
            class="fa-solid fa-prescription-bottle"></i></i> Loss Liquid</a>
    <a href={{ route('finish-good-edit', ['produksi_id' => $id]) }} class="btn btn-primary my-2 mx-1"
        style="float: right"><i class="fa-solid fa-thumbs-up"></i> Edit Finish Good</a>

    {{-- Modal --}}

    <button type="button" class="btn btn-primary my-2 mx-1" style="float: right" data-bs-toggle="modal"
        data-bs-target="#counter{{ $id }}"> <i class="fa-regular fa-pen-to-square"></i>
        Edit Counter
    </button>

    <div class="modal fade" id="counter{{ $id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Pilih Counter Edit yang akan dilakukan
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <a href="{{ route('counter-edit', ['id' => $id, 'param_id' => 1]) }}" class="btn btn-primary">Counter
                        Filling</a>
                    <a href="{{ route('counter-edit', ['id' => $id, 'param_id' => 2]) }}" class="btn btn-primary">Counter
                        Coding</a>
                    <a href="{{ route('counter-edit', ['id' => $id, 'param_id' => 3]) }}" class="btn btn-primary">Counter
                        Label</a>
                </div>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-primary my-2 mx-1" data-bs-toggle="modal" style="float: right"
        data-bs-target="#countertambah{{ $id }}"><i class="fa-solid fa-plus"></i>
        Tambah Counter
    </button>


    <div class="modal fade" id="countertambah{{ $id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Pilih Counter Tambah
                        yang akan dilakukan
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <a href="{{ route('counter-create-multi', ['produksi_id' => $id, 'param_id' => 1]) }}"
                        class="btn btn-primary">Counter Filling</a>
                    <a href="{{ route('counter-create-multi', ['produksi_id' => $id, 'param_id' => 2]) }}"
                        class="btn btn-primary">Counter Coding</a>
                    <a href="{{ route('counter-create-multi', ['produksi_id' => $id, 'param_id' => 3]) }}"
                        class="btn btn-primary">Counter Label</a>
                </div>
            </div>
        </div>
    </div>

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
                    <div class="d-md-flex justify-content-center gap-2 d-none">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop2{{ $batch_list->produksi_id }}{{ $batch_list->batch_id }}">
                            Counter
                        </button>

                        <a href="{{ route('reject-botol-index', ['produksi_id' => $batch_list->produksi_id, 'batch_id' => $batch_list->batch_id]) }}"
                            class="btn btn-primary">Reject</a>

                        <a href="{{ route('sampel-botol-index', ['produksi_id' => $batch_list->produksi_id, 'batch_id' => $batch_list->batch_id]) }}"
                            class="btn btn-primary">Sampel</a>

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop4{{ $batch_list->produksi_id }}{{ $batch_list->batch_id }}">
                            Finish Good
                        </button>
                        <form action="{{ route('batch-list-delete', ['batch_id'=>$batch_list->batch_id, 'produksi_id'=>$batch_list->produksi_id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit"><i
                                    class="fa-solid fa-trash-can fa-lg text-white"></i></button>
                        </form>
                    </div>

                    <div class="dropdown d-md-none">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <button type="button" class="btn" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop2{{ $batch_list->produksi_id }}{{ $batch_list->batch_id }}">
                                    Counter
                                </button>
                            </li>
                            <li> <a class="btn"
                                    href="{{ route('reject-botol-index', ['produksi_id' => $batch_list->produksi_id, 'batch_id' => $batch_list->batch_id]) }}">Reject</a>
                            </li>
                            <li> <a class="btn"
                                    href="{{ route('sampel-botol-index', ['produksi_id' => $batch_list->produksi_id, 'batch_id' => $batch_list->batch_id]) }}">Sampel</a>
                            </li>
                            <li>
                                <button type="button" data-bs-toggle="modal" class="btn"
                                    data-bs-target="#staticBackdrop4{{ $batch_list->produksi_id }}{{ $batch_list->batch_id }}">
                                    Finish Good
                                </button>
                            </li>
                        </ul>
                    </div>
                    <form class="d-md-none d-inline" action="{{ route('batch-list-delete', ['batch_id'=>$batch_list->batch_id, 'produksi_id'=>$batch_list->produksi_id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit"><i
                                class="fa-solid fa-trash-can fa-lg text-white"></i></button>
                    </form>


                    {{-- Modal --}}
                    <div class="modal fade"
                        id="staticBackdrop2{{ $batch_list->produksi_id }}{{ $batch_list->batch_id }}"
                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Pilih Counter
                                        {{ $batch_list->batch->name }} yang akan dilakukan
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <a href="{{ route('counter-index', ['produksi_id' => $batch_list->produksi_id, 'batch_id' => $batch_list->batch_id, 'param_id' => 1]) }}"
                                        class="btn btn-primary">Counter Filling</a>
                                    <a href="{{ route('counter-index', ['produksi_id' => $batch_list->produksi_id, 'batch_id' => $batch_list->batch_id, 'param_id' => 2]) }}"
                                        class="btn btn-primary">Counter Coding</a>
                                    <a href="{{ route('counter-index', ['produksi_id' => $batch_list->produksi_id, 'batch_id' => $batch_list->batch_id, 'param_id' => 3]) }}"
                                        class="btn btn-primary">Counter Label</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade"
                        id="staticBackdrop4{{ $batch_list->produksi_id }}{{ $batch_list->batch_id }}"
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
                                    <form class="row"
                                        action="{{ route('finish-store', ['produksi_id' => $batch_list->produksi_id, 'batch_id' => $batch_list->batch_id]) }}"
                                        method="POST">
                                        @csrf
                                        <div class="col-12">
                                            <label for="pcs">Pcs</label>
                                            <input class="form-control" type="number" name="pcs" id="pcs">
                                        </div>
                                        <div class="col-12 mt-3">
                                            <button class="btn text-white"
                                                style="background-color:#98c1d9 ">Submit</button>
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
