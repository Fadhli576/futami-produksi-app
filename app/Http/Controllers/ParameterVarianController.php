<?php

namespace App\Http\Controllers;

use App\Models\ParameterVarian;
use Illuminate\Http\Request;
use Mockery\Generator\Parameter;

class ParameterVarianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parameter_varian = ParameterVarian::all();
        return view('dashboard.parameter.varian.index', compact('parameter_varian'));
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
        $varians = $request->validate([
            'name'=>'required'
        ]);

        ParameterVarian::create($varians);
        toast('Berhail menambahkan!','success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(ParameterVarian $parameterVarian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ParameterVarian $parameterVarian)
    {
        return view('dashboard.parameter.varian.edit', compact('parameterVarian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ParameterVarian $parameterVarian)
    {
        $varians = $request->validate([
            'name'=>'required'
        ]);

        ParameterVarian::where('id', $parameterVarian->id)->update($varians);
        toast('Berhail mengupdate!','success');
        return redirect('/dashboard/parameter-varian');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ParameterVarian $parameterVarian)
    {
        $parameterVarian->delete();

        toast('Berhail menghapus!','success');
        return redirect()->back();
    }
}
