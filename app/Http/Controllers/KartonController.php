<?php

namespace App\Http\Controllers;

use App\Models\Karton;
use Illuminate\Http\Request;

class KartonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kartons = Karton::all();
        return view('dashboard.jenis.karton.karton', compact('kartons'));
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



        Karton::create([
            'name'=> $request->name,
            'spesifikasi'=> $request->spesifikasi
        ]);

        toast('Berhasil!','success');
        return redirect('/dashboard/jenis-karton');
    }

    /**
     * Display the specified resource.
     */
    public function show(Karton $karton)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karton $karton)
    {
        return view('dashboard.jenis.karton.karton-edit', compact('karton'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karton $karton)
    {
        $request->validate([
            'name'=>'required',
        ]);

        Karton::where('id', $karton->id)->update([
            'name'=>$request->name,
            'spesifikasi'=>$request->spesifikasi
        ]);

        toast('Berhasil!','success');
        return redirect('/dashboard/jenis-karton');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karton $karton)
    {
        $karton->delete();
        return redirect('dashboard/jenis-karton');
    }
}
