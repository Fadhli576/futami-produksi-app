<?php

namespace App\Http\Controllers;

use App\Models\JenisSampel;
use App\Models\ParameterSampel;
use App\Models\Sampel;
use App\Models\SpesifikTempat;
use App\Models\TempatReject;
use App\Models\TempatSampel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SampelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexBotol($produksi_id, $batch_id)
    {
        $jenis_samples = JenisSampel::get();
        $parameter_samples = ParameterSampel::get();
        $tempat_samples = TempatReject::get();
        $spesifik_samples = SpesifikTempat::get();
        $samples = Sampel::where([['id_jenis_sampel', '1'],['produksi_id', $produksi_id],['batch_id', $batch_id]])->get();
        $previousData = [];

        foreach ($samples as $sample) {
            $parameterId = $sample->id_paramater_sampel;
            $spesifikTempatId = $sample->id_spesifik_tempat;

            if (!isset($previousData[$parameterId])) {
                $previousData[$parameterId] = [];
            }

            $previousData[$parameterId][$spesifikTempatId] = $sample->jumlah_botol;
        }
        return view('dashboard.produksi.sampel.botol.index', compact('previousData','produksi_id','batch_id','jenis_samples','parameter_samples','tempat_samples','spesifik_samples','samples'));
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
    public function storeBotol(Request $request, $produksi_id, $batch_id)
    {

        foreach($request->input('sampel.*.produksi') as $key => $value){
            if ($value == '') {

            } elseif(!$value == '') {
                 DB::table('sampels')->insert([
                'produksi_id' => $produksi_id,
                'batch_id' => $batch_id,
                'id_jenis_sampel' => 1,
                'id_tempat_sampel' => $request->id_tempat_reject,
                'id_spesifik_tempat' => 1,
                'id_paramater_sampel'=>$key + 1,
                'jumlah_botol' => $value,
            ]);
            }

        }


    foreach($request->input('sampel.*.hci') as $key => $value){
        if ($value == '') {

        } elseif(!$value == '') {
             DB::table('sampels')->insert([
            'produksi_id' => $produksi_id,
            'batch_id' => $batch_id,
            'id_jenis_sampel' => 1,
            'id_tempat_sampel' => $request->id_tempat_reject,
            'id_spesifik_tempat' => 2,
            'id_paramater_sampel'=>$key + 1,
            'jumlah_botol' => $value,
        ]);
        }

        }
        toast('Berhasil menambahkan!','success');
        return redirect()->back();

    }


    /**
     * Display the specified resource.
     */
    public function show(Sampel $sampel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editBotol($sampel)
    {
        $jenis_samples = JenisSampel::get();
        $parameter_samples = ParameterSampel::get();
        $tempat_samples = TempatReject::get();
        $spesifik_samples = SpesifikTempat::get();
        $sampel = Sampel::where('id', $sampel)->first();
        return view('dashboard.produksi.sampel.botol.edit', compact('sampel','jenis_samples','parameter_samples','tempat_samples','spesifik_samples','sampel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateBotol(Request $request, $sampel)
    {
        $request->validate([
            'id_tempat_sampel'=>'required',
            'id_spesifik_tempat'=>'required',
            'id_paramater_sampel'=>'required',
            'jumlah_botol'=>'required'
        ]);

        Sampel::where('id', $sampel)->update([
            'id_jenis_sampel'=>1,
            'id_tempat_sampel'=>$request->id_tempat_sampel,
            'id_spesifik_tempat'=>$request->id_spesifik_tempat,
            'id_paramater_sampel'=>$request->id_paramater_sampel,
            'jumlah_botol'=>$request->jumlah_botol
        ]);
        toast('Berhasil!','success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyBotol($sampel)
    {
        Sampel::where('id', $sampel)->delete();
        return redirect()->back();
    }

    public function indexCap($produksi_id, $batch_id)
    {
        $jenis_samples = JenisSampel::get();
        $parameter_samples = ParameterSampel::get();
        $spesifik_samples = SpesifikTempat::get();
        $samples = Sampel::where([['id_jenis_sampel', '2'],['produksi_id', $produksi_id],['batch_id', $batch_id]])->get();
        return view('dashboard.produksi.sampel.cap.index', compact('produksi_id','batch_id','jenis_samples','parameter_samples','spesifik_samples','samples'));
    }


    public function storeCap(Request $request, $produksi_id, $batch_id)
    {
        $samples = $request->validate([
            'id_tempat_sampel'=>'required',
            'id_paramater_sampel'=>'required',
            'jumlah_botol'=>'required'
        ]);

        Sampel::create([
            'produksi_id'=>$produksi_id,
            'batch_id'=>$batch_id,
            'id_jenis_sampel'=>2,
            'id_tempat_sampel'=>$request->id_tempat_sampel,
            'id_parameter_sampel'=>$request->id_parameter_sampel,
            'jumlah_botol'=>$request->jumlah_botol
        ]);
        toast('Berhasil!','success');
        return redirect()->back();
    }

    public function editCap($sampel)
    {
        return view('dashboard.produksi.sampel.cap.index', compact('sampel'));
    }

    public function updateCap(Request $request, $sampel)
    {
        $samples = $request->validate([
            'id_tempat_sampel'=>'required',
            'id_paramater_sampel'=>'required',
            'jumlah_botol'=>'required'
        ]);

        Sampel::where('id', $sampel)->update([
            'id_jenis_sampel'=>2,
            'id_tempat_sampel'=>$request->id_tempat_sampel,
            'id_parameter_sampel'=>$request->id_parameter_sampel,
            'jumlah_botol'=>$request->jumlah_botol
        ]);
        toast('Berhasil!','success');
        return redirect()->back();
    }

    public function destroyCap($sampel)
    {
        Sampel::where('id', $sampel)->delete();
        return redirect()->back();
    }
}
