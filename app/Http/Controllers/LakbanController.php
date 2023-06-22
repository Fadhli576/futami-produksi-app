<?php

namespace App\Http\Controllers;

use App\Models\Lakban;
use Illuminate\Http\Request;

class LakbanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lakbans = Lakban::all();
        return view('dashboard.jenis.lakban.lakban', compact('lakbans'));
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



        Lakban::create([
            'name'=> $request->name,
            'spesifikasi'=> $request->spesifikasi
        ]);

        toast('Berhasil!','success');
        return redirect('/dashboard/jenis-lakban');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lakban $lakban)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lakban $lakban)
    {
        return view('dashboard.jenis.lakban.lakban-edit', compact('lakban'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lakban $lakban)
    {
        $request->validate([
            'name'=>'required',
        ]);

        $lakban->update([
            'name'=> $request->name,
            'spesifikasi'=> $request->spesifikasi
        ]);

        toast('Berhasil!','success');
        return redirect('/dashboard/jenis-lakban');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lakban $lakban)
    {
        $lakban->delete();
        toast('Berhasil!','success');
        return redirect('/dashboard/jenis-lakban');
    }
}
