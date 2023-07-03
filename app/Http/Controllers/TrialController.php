<?php

namespace App\Http\Controllers;

use App\Models\Trial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TrialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexBotol($produksi_id, $batch_id)
    {
        $trials = Trial::where([['trial_cap', null],['produksi_id',$produksi_id],['batch_id',$batch_id]])->get();
        session()->put('previous_url', url()->previous());
        return view('dashboard.produksi.trial.botol-produksi', compact('produksi_id', 'batch_id', 'trials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function indexCap($produksi_id, $batch_id)
    {
        $trials = Trial::where([['trial_botol', null],['produksi_id',$produksi_id],['batch_id',$batch_id]])->get();
        session()->put('previous_url', url()->previous());
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


        return redirect(session()->get('previous_url'));
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
        return redirect(session()->get('previous_url'));
        }

    public function edit( $id)
    {
        $trial = Trial::where('id', $id)->first();
        return view('dashboard.produksi.trial.edit-produksi', compact('id','trial'));
    }

    public function update(Request $request, $id)
    {

        if ($request->trial_botol) {
            Trial::where('id', $id)->update([
                'trial_botol'=>$request->trial_botol
            ]);
        }
        if ($request->trial_cap) {
            Trial::where('id', $id)->update([
                'trial_cap'=>$request->trial_cap
            ]);
        }

        return redirect()->back();
    }

    public function delete($id)
    {
        Trial::where('id', $id)->delete();

        return redirect()->back();
    }

}
