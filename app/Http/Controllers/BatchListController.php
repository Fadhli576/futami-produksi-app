<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\BatchList;
use App\Models\Counter;
use App\Models\FinishGood;
use App\Models\Processing;
use App\Models\Produksi;
use App\Models\Reject;
use App\Models\Sampel;
use App\Models\Trial;
use App\Models\Varian;
use App\Models\VolumeMixing;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BatchListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $varian = Varian::where('id', $id)->first();

        $reject = Reject::where('produksi_id', $id)->sum('jumlah_botol');
        $reject_produksi = Reject::where([['produksi_id', $id],['id_spesifik_tempat', 1]])->sum('jumlah_botol');
        $reject_hci = Reject::where([['produksi_id', $id],['id_spesifik_tempat', 2]])->whereIn('id_tempat_reject', [1,2])->sum('jumlah_botol');
        $defect_hci = Reject::where([['produksi_id', $id],['id_spesifik_tempat', 2]])->whereIn('id_tempat_reject', [3,4])->sum('jumlah_botol');
        $reject_cap = Reject::where('produksi_id', $id)->whereIn('id_paramater_reject', [33])->sum('jumlah_botol');

        $sampel = Sampel::where('produksi_id', $id)->sum('jumlah_botol');
        $trial_botol = Varian::where('produksi_id', $id)->first()->trial_botol;
        $trial_cap = Varian::where('produksi_id', $id)->first()->trial_cap;
        $jatuh_botol = Varian::where('produksi_id', $id)->first()->jatuh_botol;
        $jatuh_filling_cap = Varian::where('produksi_id', $id)->first()->jatuh_filling_cap;

        $reject_produksi_cap = $reject_produksi - $reject_cap + $jatuh_filling_cap;

        $finish_good = FinishGood::where('produksi_id', $id)->sum('pcs');
        $pakai_botol = $finish_good + $reject_produksi + $trial_botol + $sampel + $reject_hci + $defect_hci;
        $pakai_cap = $finish_good + $reject_produksi_cap + $trial_cap + $sampel + $reject_hci + $defect_hci;

        $counter_coding = Counter::where('produksi_id', $id)->sum('counter_coding');
        $counter_filling = Counter::where('produksi_id', $id)->sum('counter_filling');
        $counter_label = Counter::where('produksi_id', $id)->sum('counter_label');

        $batch_lists = BatchList::join('produksis', 'batch_lists.produksi_id', '=', 'produksis.id')->where('produksis.id', $id)
                                ->select('batch_lists.id as id','batch_lists.batch_id as batch_id','batch_lists.created_at as created_at_batch','batch_lists.produksi_id as produksi_id','produksis.keterangan as keterangan')->get();

        $liquid = Processing::where('produksi_id', $id)->first();
        if (!$liquid == '') {
            $volume_mixing = $liquid->volume_mixing / $liquid->density->name;
            $finish_good_liter = $finish_good * number_format(floatval($liquid->volume) / 1000, 5, '.', '');
            // dd(floatval($liquid->volume)  / 1000);
            $loss_liquid = $volume_mixing -$finish_good_liter;
        } else {
            $volume_mixing = '';
            $loss_liquid = '';
        }


        $batchs = Batch::all();
        $produksi = Produksi::where('id', $id)->first();
        $tgl_produksi =  Carbon::parse($produksi->tgl_produksi)->translatedFormat('dmY');
        return view('dashboard.produksi.batch.batch-list', compact('varian','pakai_cap','pakai_botol','reject_produksi_cap', 'jatuh_filling_cap','jatuh_botol','reject_hci','defect_hci','reject_produksi','loss_liquid','volume_mixing','counter_coding','counter_filling','counter_label','batchs','batch_lists','id', 'produksi','tgl_produksi','reject','sampel','trial_botol','finish_good','trial_cap'));
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
    public function destroy($produksi_id, $batch_id)
    {

        BatchList::where([['batch_id', $batch_id],['produksi_id',$produksi_id]])->delete();
        Reject::where([['batch_id', $batch_id],['produksi_id',$produksi_id]])->delete();
        Sampel::where([['batch_id', $batch_id],['produksi_id',$produksi_id]])->delete();
        FinishGood::where([['batch_id', $batch_id],['produksi_id',$produksi_id]])->delete();
        Counter::where([['batch_id', $batch_id],['produksi_id',$produksi_id]])->delete();
        Trial::where([['batch_id', $batch_id],['produksi_id',$produksi_id]])->delete();
        VolumeMixing::where([['batch_id', $batch_id],['produksi_id',$produksi_id]])->delete();
        toast('Berhasil!','success');
        return redirect()->back();
    }
}
