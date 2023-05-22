<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labels = Label::all();
        return view('dashboard.jenis.label.label', compact('labels'));
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
            'name'=>'required',
        ]);


        Label::create([
            'name'=> $request->name,
            'spesifikasi'=> $request->spesifikasi
        ]);

        toast('Berhasil!','success');
        return redirect('dashboard/jenis-label');
    }

    /**
     * Display the specified resource.
     */
    public function show(Label $label)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Label $label)
    {
        return view('dashboard.jenis.label.label-edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Label $label)
    {
        $request->validate([
            'name'=>'required',
        ]);

        Label::where('id', $label->id)->update([
            'name'=>$request->name,
            'spesifikasi'=>$request->spesifikasi
        ]);

        toast('Berhasil!','success');
        return redirect('/dashboard/jenis-label');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Label $label)
    {
        $label->delete();
        return redirect('dashboard/jenis-label');
    }
}
