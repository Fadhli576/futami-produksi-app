<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\BatchList;
use App\Models\FinishGood;
use App\Models\Produksi;
use App\Models\Reject;
use App\Models\Sampel;
use App\Models\Trial;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BatchListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {

        $reject = Reject::where('produksi_id', $id)->sum('jumlah_botol');
        $sampel = Sampel::where('produksi_id', $id)->sum('jumlah_botol');

        $trial_botol = Trial::where('produksi_id', $id)->sum('trial_botol');
        $trial_cap = Trial::where('produksi_id', $id)->sum('trial_cap');

        $finish_good = FinishGood::where('produksi_id', $id)->sum('pcs');

        $batch_lists = BatchList::join('produksis', 'batch_lists.produksi_id', '=', 'produksis.id')->where('produksis.id', $id)
                                ->select('batch_lists.id as id','batch_lists.batch_id as batch_id','batch_lists.created_at as created_at_batch','batch_lists.produksi_id as produksi_id','produksis.keterangan as keterangan')->get();
        $batchs = Batch::all();
        $produksi = Produksi::where('id', $id)->first();
        $tgl_produksi =  Carbon::parse($produksi->tgl_produksi)->translatedFormat('dmY');
        return view('dashboard.produksi.batch.batch-list', compact('batchs','batch_lists','id', 'produksi','tgl_produksi','reject','sampel','trial_botol','finish_good','trial_cap'));
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
    public function store($id, Request $request)
    {
        $request->validate([
            'batch_id'=>'required'
        ]);


        BatchList::create([
            'produksi_id'=> $id,
            'batch_id'=> $request->batch_id
        ]);



        toast('Berhasil!','success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(BatchList $batchList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BatchList $batchList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BatchList $batchList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BatchList $batchList)
    {
        //
    }
}
