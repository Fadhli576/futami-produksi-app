<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('dashboard.users_data.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->validate([
            'alias'=>'required',
            'name' => 'required',
            'no_hp'=>'required',
            'address' => 'required',
            'role_id' => 'required',
            'password'=>'required'
        ]);


        $user['password'] = bcrypt($user['password']);

        User::create($user);
        toast('Berhasil menembahkan User!','success');
        return redirect('/dashboard/user-data');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view('dashboard.users_data.edit-user', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = $request->validate([
            'name' => 'required',
            'email'=>'required',
            'no_hp'=>'required',
            'address' => 'required',
            'role_id' => 'required',
        ]);

        User::where('id',$id)->update($user);
        toast('Berhasil update User!','success');
        return redirect('/dashboard/user-data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
        Alert::warning('Sukses', 'User telah dihapus');
        return redirect()->back();
    }

}
