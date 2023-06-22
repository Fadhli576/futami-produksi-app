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

        $processing_self = Processing::where('produksi_id', $id)->first();

        $processing = Processing::all();
        $batch_lists = BatchList::where('produksi_id', $id)->get();

        // $batch_lists = BatchList::join('volume_mixings', 'batch_lists.id', '=', 'volume_mixings.batch_id')
        //                         ->where('batch_lists.produksi_id', $id)
        //                         ->select('batch_lists.id as id','batch_lists.batch_id as batch_id','batch_lists.created_at as created_at_batch','batch_lists.produksi_id as produksi_id','volume_mixings.volume_mixing as volume_mixing')->get();

        // $batch_lists = BatchList::join('volume_mixings', 'batch_lists.produksi_id', '=', 'volume_mixings.produksi_id')->get();

        $volume_mixing = VolumeMixing::where('produksi_id', $id)->get();
        return view('dashboard.produksi.liquid.index', compact('processing_self','volume_mixing','batch_lists','processing','densities','id'));
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


        foreach ($request->input('volume_mixing.*') as $key => $value) {
            if ($value == '') {

            } elseif(!$value == '') {
                if (VolumeMixing::where('batch_id', $key + 1)->where('produksi_id', $id)->first() == null) {
                    DB::table('volume_mixings')->insert([
                        'produksi_id' => $id,
                        'batch_id' => $key + 1,
                        'volume_mixing' => $value,
                    ]);
                    Processing::where('produksi_id', $id)->update([
                        'volume_mixing'=>VolumeMixing::where('produksi_id', $id)->sum('volume_mixing'),
                    ]);
                    toast('Berhasil!','success');
                    return redirect()->back();
            } else {
                toast('Volume Mixing sudah diisi pada batch ini!','error');
                return redirect()->back();}
        }
    }
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
    public function edit($processing_id, $id)
    {
        $densities = Density::all();
        $processing = Processing::where('id', $processing_id)->first();
        return view('dashboard.produksi.liquid.edit', compact('processing_id','densities','id', 'processing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $processing_id)
    {
        $proses =  $request->validate([
            'volume_mixing'=>'required',
            'drain_out'=>'required',
            'volume'=>'required',
            'density_id'=>'required'
        ]);

        Processing::where('id', $processing_id)->update($proses);
        return redirect('/dashboard/loss-liquid');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($processing_id)
    {
        $processing = Processing::find($processing_id);
        $processing->delete();
        return redirect('/dashboard/loss-liquid');
    }
}
