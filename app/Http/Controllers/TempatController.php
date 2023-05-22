<?php

namespace App\Http\Controllers;

use App\Models\SpesifikTempat;
use App\Models\TempatReject;
use Illuminate\Http\Request;

class TempatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexSpesifik()
    {
        $spesifik_tempat = SpesifikTempat::all();
        return view('dashboard.tempat.spesifik.index', compact('spesifik_tempat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeSpesifik(Request $request)
    {
        $data = $request->validate([
            'name'=>'required',
        ]);

        SpesifikTempat::create($data);

        toast('Berhasil!','success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(SpesifikTempat $spesifikTempat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editSpesifik(SpesifikTempat $spesifikTempat)
    {
        return view('dashboard.tempat.spesifik.edit', compact('spesifikTempat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateSpesifik(Request $request, SpesifikTempat $spesifikTempat)
    {
        $request->validate([
            'name'=>'required',
        ]);

        SpesifikTempat::where('id', $spesifikTempat->id)->update([
            'name'=>$request->name,
        ]);

        toast('Berhasil!','success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroySpesifik(SpesifikTempat $spesifikTempat)
    {
        $spesifikTempat->delete();
        return redirect()->back();
    }

    public function indexTempat()
    {
        $tempat = TempatReject::all();
        return view('dashboard.tempat.tempat.index', compact('tempat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeTempat(Request $request)
    {
        $data = $request->validate([
            'name'=>'required',
        ]);

        TempatReject::create($data);

        toast('Berhasil!','success');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editTempat(TempatReject $tempatReject)
    {
        return view('dashboard.tempat.tempat.edit', compact('tempatReject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateTempat(Request $request, TempatReject $tempatReject)
    {
        $request->validate([
            'name'=>'required',
        ]);

        TempatReject::where('id', $tempatReject->id)->update([
            'name'=>$request->name,
        ]);

        toast('Berhasil!','success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyTempat(SpesifikTempat $spesifikTempat)
    {
        $spesifikTempat->delete();
        return redirect()->back();
    }

}
