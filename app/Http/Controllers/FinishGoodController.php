<?php

namespace App\Http\Controllers;

use App\Models\FinishGood;
use Illuminate\Http\Request;

class FinishGoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, $produksi_id, $batch_id)
    {
        $finishgood = $request->validate([
            'pcs'=>'required'
        ]);

        FinishGood::create([
            'pcs'=>$request->pcs,
            'produksi_id'=>$produksi_id,
            'batch_id'=>$batch_id
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(FinishGood $finishGood)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinishGood $finishGood)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FinishGood $finishGood)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FinishGood $finishGood)
    {
        //
    }
}
