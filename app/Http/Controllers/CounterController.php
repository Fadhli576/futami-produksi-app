<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($produksi_id, $batch_id, $param_id)
    {
        return view('dashboard.produksi.counter.index', compact('produksi_id', 'batch_id','param_id'));
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
    public function store(Request $request, $produksi_id, $batch_id, $param_id)
    {
        $request->validate([
            'counter'=>'required'
        ]);

        if ($param_id == 1) {
            Counter::create([
                'produksi_id'=>$produksi_id,
                'batch_id'=>$batch_id,
                'counter_filling'=>$request->counter
            ]);
        } elseif($param_id == 2) {
            Counter::create([
                'produksi_id'=>$produksi_id,
                'batch_id'=>$batch_id,
                'counter_coding'=>$request->counter
            ]);
        } elseif ($param_id == 3) {
            Counter::create([
                'produksi_id'=>$produksi_id,
                'batch_id'=>$batch_id,
                'counter_label'=>$request->counter
            ]);
        }

        return redirect()->route('batch-list-index', $produksi_id);

    }

    /**
     * Display the specified resource.
     */
    public function show(Counter $counter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Counter $counter)
    {
        return view('dashboard.produksi.counter.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Counter $counter)
    {
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Counter $counter)
    {
        $counter->delete();
        return redirect()->back();
    }
}
