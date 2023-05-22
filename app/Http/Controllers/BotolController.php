<?php

namespace App\Http\Controllers;

use App\Models\Botol;
use Illuminate\Http\Request;

class BotolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $botols = Botol::all();
        return view('dashboard.jenis.botol.botol', compact('botols'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
        ]);



        Botol::create([
            'name'=> $request->name,
            'spesifikasi'=> $request->spesifikasi
        ]);

        toast('Berhasil!','success');
        return redirect('/dashboard/jenis-botol');
    }

    /**
     * Display the specified resource.
     */
    public function show(Botol $botol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Botol $botol)
    {
        return view('dashboard.jenis.botol.botol-edit', compact('botol'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Botol $botol)
    {
        $request->validate([
            'name'=>'required',
        ]);

        Botol::where('id', $botol->id)->update([
            'name'=>$request->name,
            'spesifikasi'=>$request->spesifikasi
        ]);

        toast('Berhasil!','success');
        return redirect('/dashboard/jenis-botol');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Botol $botol)
    {
        $botol->delete();
        return redirect('dashboard/jenis-botol');
    }
}
