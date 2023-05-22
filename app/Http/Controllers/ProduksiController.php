<?php

namespace App\Http\Controllers;

use App\Models\Produksi;
use App\Models\Varian;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProduksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $produksis = Produksi::where('id','>',0);
        $varians =  Varian::all();
        if ($request->has('tanggal_awal') && $request->has('tanggal_selesai')) {
            $tanggal_awal = Carbon::parse($request->tanggal_awal)->toDateTimeString();
            $tanggal_selesai = Carbon::parse($request->tanggal_selesai)->toDateTimeString();
            $produksis->whereBetween('tgl_produksi', [$tanggal_awal, $tanggal_selesai]);
        }

        $produksis = $produksis->orderBy('tgl_produksi')->get();
        return view('dashboard.produksi.produksi', compact('varians','produksis'));
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
            'varian_id'=>'required',
            'keterangan'=>'required',
            'tgl_produksi'=>'required'
        ]);

        $id = Produksi::create([
            'varian_id'=> $request->varian_id,
            'keterangan'=> $request->keterangan,
            'tgl_produksi'=> $request->tgl_produksi
        ]);

        Varian::where('id',$request->varian_id)->update([
            'produksi_id'=>$id->id
        ]);

        toast('Berhasil!','success');
        return redirect()->route('batch-list-index', $id->id);

    }

    /**
     * Display the specified resource.
     */
    public function show(Produksi $produksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produksi $produksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produksi $produksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produksi $produksi)
    {
        //
    }
}
