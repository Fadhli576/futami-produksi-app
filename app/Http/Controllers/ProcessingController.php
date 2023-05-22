<?php

namespace App\Http\Controllers;

use App\Models\Density;
use App\Models\Processing;
use Illuminate\Http\Request;

class ProcessingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $densities = Density::all();
        $processing = Processing::all();
        return view('dashboard.produksi.liquid.index', compact('processing','densities','id'));
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
    public function store(Request $request, $id)
    {
        $proses =  $request->validate([
            'volume_mixing'=>'required',
            'drain_out'=>'required',
            'volume'=>'required',
            'density_id'=>'required'
        ]);

        Processing::create([
            'produksi_id'=>$id,
            'volume_mixing'=>$request->volume_mixing,
            'drain_out'=>$request->drain_out,
            'volume'=>$request->volume,
            'density_id'=>$request->density_id
        ]);
        toast('Berhasil!','success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Processing $processing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Processing $processing, $id)
    {
        $densities = Density::all();
        return view('dashboard.produksi.liquid.edit', compact('processing','densities','id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Processing $processing)
    {
        $proses =  $request->validate([
            'volume_mixing'=>'required',
            'drain_out'=>'required',
            'volume'=>'required',
            'density_id'=>'required'
        ]);

        Processing::where('id', $processing->id)->update($proses);
        return redirect('/dashboard/loss-liquid');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Processing $processing)
    {
        $processing->delete();
        return redirect('/dashboard/loss-liquid');
    }
}
