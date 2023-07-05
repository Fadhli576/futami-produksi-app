@extends('layout.layout-dashboard')

@section('content')
    @if (Auth::user()->role_id == 3)
        <div class="card p-3 mb-5 shadow-sm">
            <h1>{{ $varian->name }}</h1>
            <div class="row">
                <div class="col-6">
                    <div class="card p-3 mb-5 shadow-sm">
                        <h5>{{ $varian->botol->name }}</h5>
                        <form class="row" action="{{ route('botol-detail-store', $id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="col-sm-12 col-md-6">
                                <label for="">Counter Filling</label>
                                <div class="input-group">
                                    <input disabled placeholder="Counter Filling" value="{{ $counter_filling }}"
                                        class="form-control" type="number" name="counter_filling" id="">
                                </div>
                                <label for="">Counter Coding</label>
                                <div class="input-group">
                                    <input disabled placeholder="Counter Coding" value="{{ $counter_coding }}"
                                        class="form-control" type="number" name="counter_coding" id="">
                                </div>
                                <label for="">Pemakaian Botol</label>
                                <div class="input-group">
                                    <input disabled placeholder="Counter Label"
                                        value="{{ $counter_filling + $varian->trial_botol + $varian->jatuh_botol }}" class="form-control" type="number"
                                        name="counter_label" id="">
                                </div>

                                <button class="btn text-white" style="background-color: #98c1d9">Submit</button>

                                <button type="button" class="btn btn-primary my-2 mx-1" data-bs-toggle="modal"
                                    data-bs-target="#counter{{ $id }}"><i class="fa-solid fa-plus"></i>
                                    Tambah Counter
                                </button>


                                <div class="modal fade" id="counter{{ $id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Pilih Counter Tambah
                                                    yang akan dilakukan
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
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
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="">Counter Label</label>
                                <div class="input-group">
                                    <input disabled placeholder="Counter Label" value="{{ $counter_label }}"
                                        class="form-control" type="number" name="counter_label" id="">
                                </div>
                                <label for="">Trial</label>
                                <div class="input-group">
                                    <input placeholder="Trial" value="{{ $varian->trial_botol }}" class="form-control"
                                        type="number" name="trial_botol" id="">
                                </div>
                                <label for="">Jatuh</label>
                                <div class="input-group">
                                    <input placeholder="Jatuh" value="{{ $varian->jatuh_botol }}" class="form-control"
                                        type="number" name="jatuh_botol" id="">
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card p-3 mb-5 shadow-sm">
                        <form class="row" action="{{ route('cap-detail-store', $id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <h5>{{ $varian->cap->name }}</h5>
                            <div class="col-sm-12 col-md-6">
                                <label for="">Masuk</label>
                                <div class="input-group">
                                    <input placeholder="Masuk" value="{{ $varian->masuk_cap }}" class="form-control"
                                        type="number" name="masuk_cap" id="" autocomplete="off">
                                </div>
                                <label for="">Saldo Akhir</label>
                                <div class="input-group">
                                    <input disabled placeholder="Saldo Akhir"
                                        value="{{ $varian->masuk_cap - $pakai_cap }}" class="form-control"
                                        type="number" name="saldo_cap" id="" autocomplete="off">
                                </div>
                                <label for="">Jatuh di Filling & Sisa</label>
                                <div class="input-group">
                                    <input placeholder="Jatuh & Sisa di jalur" value="{{ $varian->jatuh_filling_cap }}"
                                        class="form-control" type="number" name="jatuh_filling_cap" id=""
                                        autocomplete="off">
                                </div>
                                <label for="">Trial</label>
                                <div class="input-group">
                                    <input placeholder="Saldo Akhir" value="{{ $varian->trial_cap }}"
                                        class="form-control" type="number" name="trial_cap" id=""
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="">Pakai</label>
                                <div class="input-group">
                                    <input disabled placeholder="Pakai" value="{{ $pakai_cap }}" class="form-control"
                                        type="number" name="pakai_cap" id="" autocomplete="off">
                                </div>
                                <label for="">Varians</label>
                                <div class="input-group">
                                    <input disabled placeholder="Varians"
                                        value="{{ $varian->masuk_cap == '' ? '' : ($varians_cap = $pakai_cap - $finish_good) }}"
                                        class="form-control" type="number" id="">
                                    <span class="input-group-text"
                                        id="basic-addon2">{{ $varian->masuk_cap == '' ? 0 : number_format(($varians_cap / $pakai_cap) * 100, 2) }}
                                        %</span>
                                </div>
                                <label for="">Sampel</label>
                                <div class="input-group">
                                    <input placeholder="Sampel" value="{{ $varian->sampel_cap }}" class="form-control"
                                        type="number" name="sampel_cap" id="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <button class="btn text-white" style="background-color: #98c1d9">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card p-3 mb-5 shadow-sm">
                        <h5> {{ $varian->label->name }}</h5>
                        <form class="row" action="{{ route('label-detail-store', $id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="col-sm-12 col-md-6">
                                <label for="">Masuk</label>
                                <div class="input-group">
                                    <input step="any" placeholder="Masuk" value="{{ $varian->masuk_label }}"
                                        class="form-control" type="number" name="masuk_label" id=""
                                        autocomplete="off">
                                </div>
                                <label for="">Saldo Akhir</label>
                                <div class="input-group">
                                    <input step="any" placeholder="Saldo Akhir" value="{{ $varian->saldo_label }}"
                                        class="form-control" type="number" name="saldo_label" id="">
                                </div>
                                <label for="">Finish Good</label>
                                <div class="input-group">
                                    <input disabled placeholder="" value="{{ $finish_good }}" class="form-control"
                                        type="number" name="n" id="">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="">Conversi PCS</label>
                                <div class="input-group">
                                    <input step="any" placeholder="Conversi" value="{{ $varian->conversi_label }}"
                                        class="form-control" type="number" name="conversi_label" id="">
                                </div>
                                <label for="">Pakai</label>
                                <div class="input-group">
                                    <input step="any" disabled placeholder="Pakai"
                                        value="{{ $varian->pakai_label }}" class="form-control" type="number"
                                        name="pakai_label" id="">
                                    <span
                                        class="input-group-text">{{ $varian->pakai_label == '' ? '' : $varian->pakai_label * $conversi_label }}</span>
                                </div>
                                <label for="">Varians</label>
                                <div class="input-group">
                                    <input step="any" disabled placeholder="Varians"
                                        value="{{ $varian->saldo_label == '' ? '' : number_format(($varians = $varian->pakai_label - $finish_good / $conversi_label) * 1, 2) }}"
                                        class="form-control" type="number" name="sisa_label" id="">
                                    <span class="input-group-text"
                                        id="basic-addon2">{{ $varian->saldo_label == '' ? 0 : number_format(($varians / $varian->pakai_label) * 100, 2) }}
                                        %</span>
                                </div>
                            </div>

                            <div class="col-12 mt-2">
                                <button class="btn text-white" style="background-color: #98c1d9">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card p-3 mb-5 shadow-sm">
                        <h5> {{ $varian->karton->name }} </h5>
                        <form class="row" action="{{ route('karton-detail-store', $id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="col-sm-12 col-md-6">
                                <label for="">Masuk</label>
                                <div class="input-group">
                                    <input placeholder="Masuk" value="{{ $varian->masuk_karton }}" class="form-control"
                                        type="number" name="masuk_karton" id="">
                                </div>
                                <label for="">Saldo Akhir</label>
                                <div class="input-group">
                                    <input placeholder="Saldo Akhir" value="{{ $varian->saldo_karton }}"
                                        class="form-control" type="number" name="saldo_karton" id="">
                                </div>
                                {{-- <label for="">Varians</label>
                                <div class="input-group">
                                    <input disabled placeholder="Varians"
                                        value="{{ $varian->saldo_karton == '' ? '' : ($varians_karton = $varian->reject_karton / $varian->terpakai_karton) }}"
                                        class="form-control" type="number" name="terpakai_karton" id="">
                                    <span class="input-group-text"
                                        id="basic-addon2">{{ $varian->saldo_karton == '' ? 0 : number_format(($varian->reject_karton / $varian->terpakai_karton) * 100, 2) }}
                                        %</span>

                                </div> --}}
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="">Pakai</label>
                                <div class="input-group">
                                    <input disabled placeholder="Terpakai" value="{{ $varian->terpakai_karton }}"
                                        class="form-control" type="number" name="terpakai_karton" id="">
                                </div>
                                <label for="">Reject Supplier</label>
                                <div class="input-group">
                                    <input placeholder="Reject Supplier" value="{{ $varian->reject_supplier_karton }}"
                                        class="form-control" type="number" name="reject_supplier_karton"
                                        id="">
                                </div>
                                <label for="">Reject</label>
                                <div class="input-group">
                                    <input placeholder="Reject" value="{{ $varian->reject_karton }}"
                                        class="form-control" type="number" name="reject_karton" id="">
                                    <span class="input-group-text"
                                        id="basic-addon2">{{ $varian->saldo_karton == '' ? 0 : number_format(($varian->reject_karton / $varian->terpakai_karton) * 100, 2) }}
                                        %</span>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <button class="btn text-white" style="background-color: #98c1d9">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card p-3 mb-5 shadow-sm">
                        <h5> {{ $varian->lakban->name }} </h5>
                        <form class="row" action="{{ route('lakban-detail-store', $id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="col-sm-12 col-md-6">
                                <label for="">Masuk</label>
                                <div class="input-group">
                                    <input placeholder="Masuk" value="{{ $varian->masuk_lakban }}" class="form-control"
                                        type="number" name="masuk_lakban" id="">
                                </div>
                                <label for="">Saldo Akhir</label>
                                <div class="input-group">
                                    <input placeholder="Saldo Akhir" value="{{ $varian->saldo_lakban }}"
                                        class="form-control" type="number" name="saldo_lakban" id="">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="">Pakai</label>
                                <div class="input-group">
                                    <input disabled placeholder="Terpakai"
                                        value="{{ $varian->terpakai_lakban - $varian->reject_supplier_lakban }}"
                                        class="form-control" type="number" name="terpakai_lakban" id="">
                                </div>
                                <label for="">Reject Supplier</label>
                                <div class="input-group">
                                    <input placeholder="Reject Supplier" value="{{ $varian->reject_supplier_lakban }}"
                                        class="form-control" type="number" name="reject_supplier_lakban"
                                        id="">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="">Varians</label>
                                <div class="input-group">
                                    <input disabled placeholder="Varians"
                                        value="{{ $varian->saldo_lakban == '' ? '' : ($varians_lakban = $varian->masuk_lakban - $varian->terpakai_lakban - $varian->saldo_lakban) }}"
                                        class="form-control" type="number" name="" id="">
                                    <span class="input-group-text"
                                        id="basic-addon2">{{ $varian->saldo_lakban == '' ? 0 : number_format(($varians_lakban / $varian->terpakai_lakban) * 100, 2) }}
                                        %</span>

                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <button class="btn text-white" style="background-color: #98c1d9">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                @if ($varian->lakban2 != null)
                    <div class="col-6">
                        <div class="card p-3 mb-5 shadow-sm">
                            <h5> {{ $varian->lakban2->name }} </h5>
                            <form class="row" action="{{ route('lakban2-detail-store', $id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="col-sm-12 col-md-6">
                                    <label for="">Masuk</label>
                                    <div class="input-group">
                                        <input placeholder="Masuk" value="{{ $varian->masuk_lakban2 }}"
                                            class="form-control" type="number" name="masuk_lakban" id="">
                                    </div>
                                    <label for="">Saldo Akhir</label>
                                    <div class="input-group">
                                        <input placeholder="Saldo Akhir" value="{{ $varian->saldo_lakban2 }}"
                                            class="form-control" type="number" name="saldo_lakban" id="">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label for="">Pakai</label>
                                    <div class="input-group">
                                        <input disabled placeholder="Terpakai"
                                            value="{{ $varian->terpakai_lakban2 - $varian->reject_supplier_lakban2 }}"
                                            class="form-control" type="number" name="terpakai_lakban" id="">
                                    </div>
                                    <label for="">Reject Supplier</label>
                                    <div class="input-group">
                                        <input placeholder="Reject Supplier"
                                            value="{{ $varian->reject_supplier_lakban2 }}" class="form-control"
                                            type="number" name="reject_supplier_lakban2" id="">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label for="">Varians</label>
                                    <div class="input-group">
                                        <input disabled placeholder="Varians"
                                            value="{{ $varian->saldo_lakban2 == '' ? '' : ($varians_lakban2 = $varian->masuk_lakban2 - $varian->terpakai_lakban2 - $varian->saldo_lakban2) }}"
                                            class="form-control" type="number" name="" id="">
                                        <span class="input-group-text"
                                            id="basic-addon2">{{ $varian->saldo_lakban2 == '' ? 0 : number_format(($varians_lakban2 / $varian->terpakai_lakban2) * 100, 2) }}
                                            %</span>

                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <button class="btn text-white" style="background-color: #98c1d9">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    @endif
@endsection
