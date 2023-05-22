<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\BatchList;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        return view('dashboard.produksi.batch.batch', compact('id'));
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
        $batch =  $request->validate([
            'name'=>'required'
        ]);

        Batch::create($batch);
        toast('Berhasil!','success');
        return redirect()->route('batch-list-index', $id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Batch $batch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Batch $batch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Batch $batch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Batch $batch)
    {
        //
    }
}
