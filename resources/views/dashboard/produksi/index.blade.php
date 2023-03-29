@extends('layout.layout-dashboard')

@section('content')
    @if (Auth::user()->role_id == 3)
        <div class="card p-3 mb-5 shadow-sm" style="border:none; border-left: 40px solid #98c1d9;">
            <h5>Varian</h5>
            <form class="row" action="{{ route('varian-store') }}" method="POST">
                @csrf
                <div class=" col-sm-12 col-md-6">
                    <label for="">Nama Varian</label>
                    <div class="input-group">
                        <input placeholder="Nama" class="form-control" type="text" name="name" id="">
                    </div>
                    <label for="">Jenis Botol</label>
                    <div class="input-group">
                        <select name="botol_id" id="" class="form-select">
                            <option selected disabled value="">Pilih Jenis Botol</option>
                            @foreach ($botols as $botol)
                                <option value="{{$botol->id}}">{{$botol->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="">Jenis Cap</label>
                    <div class="input-group">
                        <select name="cap_id" id="" class="form-select">
                            <option selected disabled value="">Pilih Jenis Cap</option>
                        @foreach ($caps as $cap)
                            <option value="{{$cap->id}}">{{$cap->name}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 ">
                    <label for="">Jenis Label</label>
                    <div class="input-group">
                        <select name="label_id" id="" class="form-select">
                            <option selected disabled value="">Pilih Jenis Label</option>
                        @foreach ($labels as $label)
                            <option value="{{$label->id}}">{{$label->name}}</option>
                        @endforeach
                        </select>
                    </div>
                    <label for="">Jenis Karton</label>
                    <div class="input-group">
                        <select name="karton_id" id="" class="form-select">
                            <option selected disabled value="">Pilih Jenis Karton</option>
                            @foreach ($kartons as $karton)
                                <option value="{{$karton->id}}">{{$karton->name}}</option>
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
    {{-- <table
        class="text-center justify-content-center align-items-center table table-hover table-responsive-sm shadow-sm rounded-4">
        <thead class="table text-white font-bold fw-bold" style="background-color: #98c1d9">
            <td>No</td>
            <td>Nama</td>
            <td>Email</td>
            <td>No HP</td>
            <td>Address</td>
            <td>Role</td>
            <td>Action</td>
        </thead>
        @forelse ($users as $user)
            <tr class="bg-white">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->no_hp }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->role->name }}</td>
                <td>
                    <form action="{{ route('delete-user', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a class="btn" style="color:#98c1d9" href="{{ route('edit-user', $user->id) }}"><i
                                class="fa-solid fa-pen fa-lg"></i></a>
                        <button class="btn" type="submit"><i
                                class="fa-solid fa-trash-can fa-lg text-danger"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td class="text-center h5 bg-white" colspan="7">Result not found.</td>
            </tr>
        @endforelse
    </table> --}}

    {{-- {{ $users->links('pagination::bootstrap-4') }} --}}
@endsection
