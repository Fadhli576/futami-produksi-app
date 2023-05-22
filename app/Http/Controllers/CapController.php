<?php

namespace App\Http\Controllers;

use App\Models\Cap;
use Illuminate\Http\Request;

class CapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $caps = Cap::all();
        return view('dashboard.jenis.cap.cap', compact('caps'));
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
        $request->validate([
            'name'=>'required',
        ]);



        Cap::create([
            'name'=> $request->name,
            'spesifikasi'=> $request->spesifikasi
        ]);

        toast('Berhasil!','success');
        return redirect('/dashboard/jenis-cap');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cap $cap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cap $cap)
    {
        return view('dashboard.jenis.cap.cap-edit', compact('cap'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cap $cap)
    {
        $request->validate([
            'name'=>'required',
        ]);

        Cap::where('id', $cap->id)->update([
            'name'=>$request->name,
            'spesifikasi'=>$request->spesifikasi
        ]);

        toast('Berhasil!','success');
        return redirect('/dashboard/jenis-cap');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cap $cap)
    {
        $cap->delete();
        return redirect('dashboard/jenis-cap');
    }
}
