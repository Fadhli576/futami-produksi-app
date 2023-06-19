<?php

namespace App\Http\Controllers;

use App\Models\BatchList;
use App\Models\Density;
use App\Models\Processing;
use App\Models\VolumeMixing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProcessingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $densities = Density::all();
        $processing = Processing::all();
        $batch_lists = BatchList::where('produksi_id', $id)->get();
        $volume_mixing = VolumeMixing::where('produksi_id', $id)->get();
        return view('dashboard.produksi.liquid.index', compact('volume_mixing','batch_lists','processing','densities','id'));
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
            'drain_out'=>'required',
            'volume'=>'required',
            'density_id'=>'required'
        ]);

        Processing::create([
            'produksi_id'=>$id,
            'volume_mixing'=>VolumeMixing::where('produksi_id', $id)->sum('volume_mixing'),
            'drain_out'=>$request->drain_out,
            'volume'=>$request->volume,
            'density_id'=>$request->density_id
        ]);
        toast('Berhasil!','success');
        return redirect()->back();
    }

    public function storeVolumeMixing(Request $request, $id)
    {
        $request->validate([
            'volume_mixing.*'=>'required',
        ]);

        foreach ($request->input('volume_mixing.*') as $key => $value) {
            if ($value == '') {

            } elseif(!$value == '') {
                 DB::table('volume_mixings')->insert([
                'produksi_id' => $id,
                'batch_id' => $key + 1,
                'volume_mixing' => $value,
            ]);
            }
        }
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
