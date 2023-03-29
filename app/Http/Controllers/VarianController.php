<?php

namespace App\Http\Controllers;

use App\Models\Botol;
use App\Models\Cap;
use App\Models\Karton;
use App\Models\Label;
use App\Models\Varian;
use Illuminate\Http\Request;

class VarianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $botols = Botol::all();
        $caps = Cap::all();
        $kartons = Karton::all();
        $labels = Label::all();

        return view('dashboard.produksi.index', compact('botols','caps','kartons','labels'));
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
        $varian = $request->validate([
            'name'=>'required',
            'botol_id'=>'required',
            'cap_id'=>'required',
            'karton_id'=>'required',
            'label_id'=>'required',
        ]);

        Varian::create($varian);
        toast('Berhasil!','success');
        return redirect('/dashboard/produksi');
    }

    /**
     * Display the specified resource.
     */
    public function show(Varian $varian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Varian $varian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Varian $varian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Varian $varian)
    {
        //
    }
}
