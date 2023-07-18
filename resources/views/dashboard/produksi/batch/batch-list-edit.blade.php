@extends('layout.layout-dashboard')

@section('content')
    @if (Auth::user()->role_id == 3)
        <div class="card p-3 mb-5 shadow-sm" style="border:none; border-left: 40px solid #98c1d9;">
            <form class="row" action="{{ route('batch-list-update', ['batch_id'=>$batch_id, 'id'=>$id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class=" col-sm-12 col-md-12">
                    <label for="">Batch List</label>
                    <div class="input-group">
                        <select name="batch_id" id="" class="form-select">
                            @foreach ($batchs as $batch)
                                <option value="{{ $batch->id }} " {{ $batch->id == $batch_list->batch_id ? 'selected' : ''}}>{{ $batch->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <a class="btn btn-primary" href="{{route('batch-list-index', $id)}}">Back</a>
                    <button class="btn text-white" style="background-color: #98c1d9">Submit</button>
                </div>
            </form>
        </div>
    @endif
@endsection
