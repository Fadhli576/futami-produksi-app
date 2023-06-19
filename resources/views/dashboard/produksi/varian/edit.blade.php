@extends('layout.layout-dashboard')

@section('content')
    @if (Auth::user()->role_id == 3)
        <div class="card p-3 mb-5 shadow-sm" style="border:none; border-left: 40px solid #98c1d9;">
            <h5>Varian</h5>
            <form class="row" action="{{ route('varian-update', $varian->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class=" col-sm-12 col-md-6">
                    <label for="">Nama Varian</label>
                   <div class="input-group">
                        <select name="parameter_id" value="{{$varian->parameter_id}}" id="" class="form-select">
                            <option selected disabled value="">Pilih Jenis Botol</option>
                            @foreach ($parameters as $parameter)
                                <option value="{{$parameter->id}}" {{$parameter->id == $varian->parameter_id ? 'selected' : ''}}>{{$parameter->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="">Jenis Botol</label>
                    <div class="input-group">
                        <select name="botol_id" value="{{$varian->botol_id}}" id="" class="form-select">
                            <option selected disabled value="">Pilih Jenis Botol</option>
                            @foreach ($botols as $botol)
                                <option value="{{$botol->id}}" {{$botol->id == $varian->botol_id ? 'selected' : ''}}>{{$botol->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="">Jenis Cap</label>
                    <div class="input-group">
                        <select name="cap_id" value="{{$varian->cap_id}}" id="" class="form-select">
                            <option selected disabled value="">Pilih Jenis Cap</option>
                        @foreach ($caps as $cap)
                            <option value="{{$cap->id}}" {{$cap->id == $varian->cap_id ? 'selected' : ''}}>{{$cap->name}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 ">
                    <label for="">Jenis Label</label>
                    <div class="input-group">
                        <select name="label_id" id=""  value="{{$varian->label_id}}" class="form-select">
                            <option selected disabled value="">Pilih Jenis Label</option>
                        @foreach ($labels as $label)
                            <option value="{{$label->id}}" {{$label->id == $varian->label_id ? 'selected' : ''}}>{{$label->name}}</option>
                        @endforeach
                        </select>
                    </div>
                    <label for="">Jenis Karton</label>
                    <div class="input-group">
                        <select name="karton_id" id=""  value="{{$varian->karton_id}}" class="form-select">
                            <option selected disabled value="">Pilih Jenis Karton</option>
                            @foreach ($kartons as $karton)
                                <option value="{{$karton->id}}" {{$karton->id == $varian->karton_id ? 'selected' : ''}}>{{$karton->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="">Jenis Lakban</label>
                    <div class="input-group">
                        <select name="lakban_id" id=""  value="{{$varian->lakban_id}}" class="form-select">
                            <option selected disabled value="">Pilih Jenis Lakban</option>
                            @foreach ($lakbans as $lakban)
                                <option value="{{$lakban->id}}" {{$lakban->id == $varian->lakban_id ? 'selected' : ''}}>{{$lakban->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($varian->lakban2_id != null)
                        <label for="">Jenis Lakban 2</label>
                        <div class="input-group">
                            <select name="lakban2_id" id=""  value="{{$varian->lakban2_id}}" class="form-select">
                                <option selected disabled value="">Pilih Jenis Lakban</option>
                                @foreach ($lakbans as $lakban)
                                    <option value="{{$lakban->id}}" {{$lakban->id == $varian->lakban2_id ? 'selected' : ''}}>{{$lakban->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    @endif
                </div>
                <div class="col-12 mt-2">
                    <a href="/dashboard/produksi" class="btn text-white" style="background-color: #98c1d9">Back</a>
                    <button class="btn text-white" style="background-color: #98c1d9">Submit</button>
                </div>

            </form>
        </div>
    @endif
@endsection
