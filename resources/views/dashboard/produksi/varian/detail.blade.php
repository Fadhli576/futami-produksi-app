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
                                    <input placeholder="Counter Filling" value="{{ $varian->counter_filling }}"
                                        class="form-control" type="number" name="counter_filling" id="">
                                </div>
                                <label for="">Counter Coding</label>
                                <div class="input-group">
                                    <input placeholder="Counter Coding" value="{{ $varian->counter_coding }}"
                                        class="form-control" type="number" name="counter_coding" id="">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="">Counter Label</label>
                                <div class="input-group">
                                    <input placeholder="Counter Label" value="{{ $varian->counter_label }}"
                                        class="form-control" type="number" name="counter_label" id="">
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
                                    <input placeholder="Saldo Akhir" value="{{ $varian->saldo_cap }}" class="form-control"
                                        type="number" name="saldo_cap" id="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="">Pakai</label>
                                <div class="input-group">
                                    <input disabled placeholder="Pakai" value="{{ $varian->pakai_cap }}" class="form-control"
                                        type="number" name="pakai_cap" id="" autocomplete="off">
                                </div>
                                <label for="">Varians</label>
                                <div class="input-group">
                                    <input disabled placeholder="Varians" value="{{ $varian->pakai_cap == '' ? '' : $varian->pakai_cap - $finish_good }}"
                                        class="form-control" type="number" id="">
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
                                    <input step="any" placeholder="Masuk" value="{{ $varian->masuk_label }}" class="form-control"
                                        type="number" name="masuk_label" id="" autocomplete="off">
                                </div>
                                <label for="">Saldo Akhir</label>
                                <div class="input-group">
                                    <input step="any" placeholder="Saldo Akhir" value="{{ $varian->saldo_label }}"
                                        class="form-control" type="number" name="saldo_label" id="">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="">Pakai</label>
                                <div class="input-group">
                                    <input step="any" disabled placeholder="Pakai" value="{{ $varian->pakai_label }}" class="form-control"
                                        type="number" name="pakai_label" id="">
                                </div>
                                <label for="">Varians</label>
                                <div class="input-group">
                                    <input step="any" disabled placeholder="Varians" value="{{ $varian->pakai_label == '' ? '' : $varian->pakai_label * 8475 - $finish_good }}"
                                        class="form-control" type="number" name="sisa_label" id="">
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
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="">Pakai</label>
                                <div class="input-group">
                                    <input disabled placeholder="Terpakai" value="{{ $varian->terpakai_karton }}"
                                        class="form-control" type="number" name="terpakai_karton" id="">
                                </div>
                                <label for="">Reject Supplier</label>
                                <div class="input-group">
                                    <input placeholder="Reject Supplier" value="{{ $varian->reject_karton }}"
                                        class="form-control" type="number" name="reject_karton" id="">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="">Varians</label>
                                <div class="input-group">
                                    <input disabled placeholder="Varians" value="{{ $varian->terpakai_karton == '' ? '' :  $varian->terpakai_karton - $finish_good }}"
                                        class="form-control" type="number" name="terpakai_karton" id="">
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
                                    <input disabled placeholder="Terpakai" value="{{ $varian->terpakai_lakban }}"
                                        class="form-control" type="number" name="terpakai_lakban" id="">
                                </div>
                                <label for="">Reject Supplier</label>
                                <div class="input-group">
                                    <input placeholder="Reject Supplier" value="{{ $varian->reject_lakban }}"
                                        class="form-control" type="number" name="reject_lakban" id="">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="">Varians</label>
                                <div class="input-group">
                                    <input disabled placeholder="Varians" value="{{  $varian->terpakai_lakban == '' ? '' : $varian->terpakai_lakban - $finish_good }}"
                                        class="form-control" type="number" name="terpakai_lakban" id="">
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <button class="btn text-white" style="background-color: #98c1d9">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
