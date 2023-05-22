<?php

namespace App\Http\Controllers;

use App\Models\Trial;
use Illuminate\Http\Request;

class TrialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexBotol($produksi_id, $batch_id)
    {
        $trials = Trial::where([['trial_cap', null],['produksi_id',$produksi_id],['batch_id',$batch_id]])->get();
        return view('dashboard.produksi.trial.botol-produksi', compact('produksi_id', 'batch_id', 'trials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function indexCap($produksi_id, $batch_id)
    {
        $trials = Trial::where([['trial_botol', null],['produksi_id',$produksi_id],['batch_id',$batch_id]])->get();

        return view('dashboard.produksi.trial.cap-produksi', compact('produksi_id', 'batch_id', 'trials'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function Botolstore(Request $request, $produksi_id, $batch_id)
    {
        $request->validate([
            'trial_botol'=>'required'
        ]);

        Trial::create([
            'trial_botol'=>$request->trial_botol,
            'produksi_id'=>$produksi_id,
            'batch_id'=>$batch_id
        ]);
        return redirect()->back();
    }


    public function Capstore(Request $request, $produksi_id, $batch_id)
    {
        $request->validate([
            'trial_cap'=>'required'
        ]);

        Trial::create([
            'trial_cap'=>$request->trial_cap,
            'produksi_id'=>$produksi_id,
            'batch_id'=>$batch_id
        ]);
        return redirect()->back();
    }

    public function edit($id)
    {
        return view('dashboard.produksi.trial.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        $trial = $request->validate([
            'trial'=>'required'
        ]);

        Trial::where('id', $id)->update($trial);

        return redirect()->back();
    }

    public function delete($id)
    {
        Trial::where('id', $id)->delete();

        return redirect()->back();
    }

}
