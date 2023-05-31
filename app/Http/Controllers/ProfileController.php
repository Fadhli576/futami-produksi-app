<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return view('dashboard.profile.profile', compact('user'));
    }

    /**
     * Display the specified resource.
     *
     * Show the form for editing the specified resource.
     *
     */
    public function edit()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return view('dashboard.profile.edit-profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'address'=>'required',
            'no_hp'=>'required',
            // 'password'=>'required',
            'email'=>'required'
        ]);

        User::where('id', Auth::user()->id)->update([
            'name'=> $request->name,
            'address'=> $request->address,
            'no_hp'=> $request->no_hp,
            // 'password'=> bcrypt($request->password),
            'email'=> $request->email
        ]);

        toast('Berhasil mengupdate profile!','success');
        return redirect('/dashboard/profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy()
    {

    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'password'=>'required',
        ]);

        User::where('id', Auth::user()->id)->update([
            'password'=> bcrypt($request->password),
        ]);

        toast('Berhasil mengupdate password!','success');
        return redirect('/dashboard/profile');
    }
}
