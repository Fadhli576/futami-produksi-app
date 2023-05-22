@extends('layout.layout-dashboard')

@section('content')
    <div class="card p-3 mb-5 shadow-sm">
        <h5>Botol</h5>
        <form class="row" action="{{ route('sampel-botol-update', ['sampel'=>$sampel, 'id'=>$id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="col-6 col-md-3 botol">
                <label for="">Pilih Tempat</label>
                <select class="form-select" name="id_tempat_sampel" id="">
                    <option disabled selected value="">Pilih Tempat</option>
                    @foreach ($tempat_samples as $tempat_reject)
                        <option value="{{ $tempat_reject->id }}" {{$tempat_reject->id == $sampel->id_tempat_sampel ? 'selected' : ''}}>{{ $tempat_reject->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 col-md-3 botol-cap">
                <label for="">Pilih Tempat</label>
                <select class="form-select" name="id_spesifik_tempat" id="">
                    <option disabled selected value="">Pilih Tempat</option>
                    @foreach ($spesifik_samples as $spesifik_reject)
                        <option value="{{ $spesifik_reject->id }}" {{$spesifik_reject->id == $sampel->id_spesifik_tempat ? 'selected' : ''}}>{{ $spesifik_reject->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 col-md-3 botol">
                <label for="">Parameter Sampel</label>
                <select class="select2 form-select" name="id_paramater_sampel" id=""  onchange='checkvalue(this.value)'>
                    <option disabled selected value="">Parameter Reject</option>
                    @foreach ($parameter_samples as $parameter_reject)
                        <option value="{{ $parameter_reject->id }}" {{$parameter_reject->id == $sampel->id_paramater_sampel ? 'selected' : ''}}>{{ $parameter_reject->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 col-md-3 botol-cap">
                <label for="">Jumlah</label>
                <input placeholder="Jumlah Reject" type="text" name="jumlah_botol" value="{{$sampel->jumlah_botol}}" class="form-control">
            </div>

            <div class="col-12 mt-3">
                <button class="btn text-white" style="background-color:#98c1d9 ">Submit</button>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
