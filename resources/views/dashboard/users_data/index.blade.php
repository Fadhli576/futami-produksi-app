@extends('layout.layout-dashboard')

@section('content')
    @if (Auth::user()->role_id == 3)
        <div class="card p-3 mb-5 shadow-sm" style="border:none; border-left: 40px solid #98c1d9;">
            <h5>Form User</h5>
            <form class="row" action="{{ route('user-store') }}" method="POST" >
                @csrf
                <div class=" col-sm-12 col-md-6">
                    <label for="">Nama</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input placeholder="Nama" class="form-control" type="text" name="name" id="">
                    </div>
                    <label for="">Alias</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-file-signature"></i></span>
                        <input placeholder="Alias" class="form-control" type="text" name="alias" id="">
                    </div>
                    <label for="">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-at"></i></span>
                        <input placeholder="Email (Optional)" class="form-control" type="email" name="email" id="">
                    </div>
                    <label for="">No HP</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                        <input placeholder="Nomor HP" class="form-control" type="number" name="no_hp" id="">
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 ">
                    <label for="">Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                        <input placeholder="Address" class="form-control" type="text" name="address" id="">
                    </div>
                    <label for="">Role</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-address-book"></i></span>
                        <select name="role_id" id="" class="form-select">
                            <option selected disabled value="">Pilih Role</option>
                            <option value="1">User</option>
                            <option value="2">Admin</option>
                            <option value="3">Super Admin</option>
                        </select>                    </div>
                    <label for="">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                        <input placeholder="Password" class="form-control" type="password" name="password" id="">
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <button class="btn text-white" style="background-color: #98c1d9">Submit</button>
                </div>

            </form>
        </div>
    @endif
    <table
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
                        <a class="btn" style="color:#98c1d9" href="{{ route('edit-user', $user->id) }}"><i class="fa-solid fa-pen fa-lg"></i></a>
                        <button class="btn" type="submit"><i class="fa-solid fa-trash-can fa-lg text-danger"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td class="text-center h5 bg-white" colspan="7">Result not found.</td>
            </tr>
        @endforelse
    </table>

    {{-- {{ $users->links('pagination::bootstrap-4') }} --}}
@endsection
