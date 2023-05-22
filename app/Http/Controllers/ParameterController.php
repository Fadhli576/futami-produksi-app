<?php

namespace App\Http\Controllers;

use App\Models\ParameterReject;
use App\Models\ParameterSampel;
use Illuminate\Http\Request;

class ParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexReject()
    {
        $parameter_reject = ParameterReject::all();
        return view('dashboard.parameter.reject.index', compact('parameter_reject'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeReject(Request $request)
    {
        $data = $request->validate([
            'name'=>'required',
        ]);

        ParameterReject::create([
            'name'=>$request->name,
            'spesifik'=>$request->spesifik
        ]);

        toast('Berhasil!','success');
        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function editReject(ParameterReject $parameterReject)
    {
        return view('dashboard.parameter.reject.edit', compact('parameterReject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateReject(Request $request, ParameterReject $parameterReject)
    {
        $request->validate([
            'name'=>'required',
        ]);

        $parameterReject::where('id', $parameterReject->id)->update([
            'name'=>$request->name,
            'spesifik'=>$request->spesifik
        ]);

        toast('Berhasil!','success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyReject(ParameterReject $parameterReject)
    {
        $parameterReject->delete();
        return redirect()->back();
    }

    public function indexSampel()
    {
        $parameter_sampel = ParameterSampel::all();
        return view('dashboard.parameter.sampel.index', compact('parameter_sampel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeSampel(Request $request)
    {
        $data = $request->validate([
            'name'=>'required',
        ]);

        ParameterSampel::create([
            'name'=>$request->name,
            'spesifik'=>$request->spesifik
        ]);

        toast('Berhasil!','success');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editSampel(ParameterSampel $parameterSampel)
    {
        return view('dashboard.parameter.sampel.edit', compact('parameterSampel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateSampel(Request $request, ParameterSampel $parameterSampel)
    {
        $request->validate([
            'name'=>'required',
        ]);

        ParameterSampel::where('id', $parameterSampel->id)->update([
            'name'=>$request->name,
            'spesifik'=>$request->sampel
        ]);

        toast('Berhasil!','success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroySampel(ParameterSampel $parameterSampel)
    {
        $parameterSampel->delete();
        return redirect()->back();
    }

}
