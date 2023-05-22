<?php

namespace App\Http\Controllers;

use App\Models\Density;
use Illuminate\Http\Request;

class DensityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $densities = Density::all();
        return view('dashboard.jenis.density.index', compact('densities'));
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
    public function store(Request $request)
    {
        $density =  $request->validate([
            'name'=>'required',
            'spesifikasi'=>'required'

        ]);

        Density::create($density);
        return redirect('/dashboard/density');
    }

    /**
     * Display the specified resource.
     */
    public function show(Density $density)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Density $density)
    {
        return view('dashboard.density.edit', compact('density'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Density $density)
    {
        $densityOld =  $request->validate([
            'name'=>'required',
        ]);

        Density::where('id', $density->id)->update([$densityOld]);
        return redirect('/dashboard/density');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Density $density)
    {
        $density->delete();
        return redirect()->back();
    }
}
