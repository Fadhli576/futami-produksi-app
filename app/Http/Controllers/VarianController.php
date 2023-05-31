<?php

namespace App\Http\Controllers;

use App\Models\Botol;
use App\Models\Cap;
use App\Models\Counter;
use App\Models\FinishGood;
use App\Models\JenisReject;
use App\Models\Karton;
use App\Models\Label;
use App\Models\Lakban;
use App\Models\ParameterReject;
use App\Models\ParameterVarian;
use App\Models\Reject;
use App\Models\SpesifikTempat;
use App\Models\TempatReject;
use App\Models\Varian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Generator\Parameter;

class VarianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $botols = Botol::all();
        $caps = Cap::all();
        $kartons = Karton::all();
        $labels = Label::all();
        $varians = Varian::all();
        $lakbans = Lakban::all();
        $parameters = ParameterVarian::all();

        return view('dashboard.produksi.varian.index', compact('botols','caps','kartons','labels','varians','lakbans', 'parameters'));
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
        $varian = $request->validate([
            'parameter_id'=>'required',
            'botol_id'=>'required',
            'cap_id'=>'required',
            'karton_id'=>'required',
            'label_id'=>'required',
            'lakban_id'=>'required'
        ]);


        $id = Varian::create($varian);
        toast('Berhasil!','success');
        // return redirect('/dashboard/'.Varian::latest()->first()->id.'/botol-produksi');
        return redirect()->route('varian-detail',$id->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Varian $varian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Varian $varian)
    {
        $botols = Botol::all();
        $caps = Cap::all();
        $kartons = Karton::all();
        $labels = Label::all();
        $parameters = ParameterVarian::all();
        return view('dashboard.produksi.varian.edit', compact('varian','botols','caps','kartons','labels','parameters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Varian $varian)
    {
        $varianOld = $request->validate([
            'parameter_id'=>'required',
            'botol_id'=>'required',
            'cap_id'=>'required',
            'label_id'=>'required',
            'karton_id'=>'required'
        ]);

        Varian::where('id', $varian->id)->update($varianOld);
        toast('Berhasil mengupdate!','success');
        return redirect('/dashboard/produksi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Varian $varian)
    {
        $varian->delete();
        toast('Berhasil menghapus!','success');
        return redirect('/dashboard/varian');
    }

    public function detail($id)
    {
        $varian = Varian::where('id', $id)->first();
        $finish_good = FinishGood::where('produksi_id', $varian->produksi_id)->sum('pcs');
        $counter_filling = Counter::where('produksi_id', $varian->produksi_id)->sum('counter_filling');
        $counter_coding = Counter::where('produksi_id', $varian->produksi_id)->sum('counter_coding');
        $counter_label = Counter::where('produksi_id', $varian->produksi_id)->sum('counter_label');
        return view('dashboard.produksi.varian.detail', compact('id', 'varian','finish_good', 'counter_filling','counter_coding','counter_label'));
    }

    public function botolStore($id, Request $request)
    {
        $botol = $request->validate([
            'counter_filling'=>'required',
            'counter_coding'=>'required',
            'counter_label'=>'required'
        ]);

        Varian::where('id', $id)->update($botol);
        toast('Berhasil!','success');
    return redirect()->back();
    }

    public function capStore($id, Request $request)
    {
        $request->validate([
            'masuk_cap'=>'required',
        ]);

        $pakai_cap = $request->masuk_cap - $request->saldo_cap;
        $varians = $pakai_cap - $request->masuk_cap;

        $cap = [
            'saldo_cap'=>$request->saldo_cap,
            'masuk_cap'=>$request->masuk_cap,
            'pakai_cap'=>$pakai_cap,
        ];

        Varian::where('id', $id)->update($cap);
        toast('Berhasil!','success');
        return redirect()->back();
    }

    public function labelStore($id, Request $request)
    {
        $request->validate([
            'masuk_label'=>'required',
        ]);

        $pakai_label = $request->masuk_label - $request->saldo_label;
        $varians = $pakai_label - $request->masuk_label;

        $label = [
            'saldo_label'=>$request->saldo_label,
            'masuk_label'=>$request->masuk_label,
            'pakai_label'=>$pakai_label,
        ];

        Varian::where('id', $id)->update($label);
        toast('Berhasil!','success');
        return redirect()->back();
    }

    public function kartonStore($id, Request $request)
    {
        $request->validate([
            'masuk_karton'=>'required',
        ]);

        $pakai_karton = $request->masuk_karton - $request->saldo_karton;

        $karton = [
            'saldo_karton'=>$request->saldo_karton,
            'masuk_karton'=>$request->masuk_karton,
            'terpakai_karton'=>$pakai_karton
        ];

        Varian::where('id', $id)->update($karton);
        toast('Berhasil!','success');
        return redirect()->back();
    }

    public function lakbanStore($id, Request $request)
    {
        $request->validate([
            'masuk_lakban'=>'required',
        ]);

        $pakai_lakban = $request->masuk_lakban - $request->saldo_lakban;

        $lakban = [
            'saldo_lakban'=>$request->saldo_lakban,
            'masuk_lakban'=>$request->masuk_lakban,
            'terpakai_lakban'=>$pakai_lakban
        ];

        Varian::where('id', $id)->update($lakban);
        toast('Berhasil!','success');
        return redirect()->back();
    }

    public function botolProduksiIndex(Varian $varian)
    {
        return view('dashboard.produksi.botol-produksi', compact('varian'));
    }

    public function botolProduksi(Varian $varian, Request $request)
    {
        $botol_produksi = $request->validate([
            'trial_botol'=>'required',
            'counter_filling'=>'required',
            'counter_coding'=>'required',
            'counter_label'=>'required',
        ]);

        Varian::where('id', $varian->id)->update($botol_produksi);
        return redirect()->route('cap-produksi', $varian->id);
    }

    public function capProduksiIndex(Varian $varian)
    {
        return view('dashboard.produksi.cap-produksi', compact('varian'));
    }

    public function capProduksi(Varian $varian, Request $request)
    {
        $botol_produksi = $request->validate([
            'trial_cap'=>'required',
            'masuk_cap'=>'required',
            'pakai_cap'=>'required',
            'saldo_cap'=>'required',
            'jatuh_cap'=>'required'
        ]);

        Varian::where('id', $varian->id)->update($botol_produksi);
        return redirect()->back();
    }

    // public function rejectIndex(Varian $varian)
    // {
    //     $jenis_rejects = JenisReject::get();
    //     $parameter_rejects = ParameterReject::get();
    //     $tempat_rejects = TempatReject::get();
    //     $spesifik_rejects = SpesifikTempat::get();
    //     $rejects = Reject::get();
    //     return view('dashboard.produksi.reject.index', compact('varian','jenis_rejects','parameter_rejects','tempat_rejects','spesifik_rejects','rejects'));
    // }

    // public function reject(Request $request, Varian $varian)
    // {
    //     $request->validate([
    //         'id_jenis_reject'=>'required',
    //         'jumlah_reject'=>'required'
    //     ]);

    //     Reject::create([
    //         'id_jenis_reject'=>$request->id_jenis_reject,
    //         'id_tempat_reject'=>$request->id_tempat_reject,
    //         'id_spesifik_tempat'=>$request->id_spesifik_tempat,
    //         'id_paramater_reject'=>$request->id_paramater_reject,
    //         'jumlah_reject'=>$request->jumlah_reject,
    //     ]);

    //     return redirect()->back();
    // }

    // public function rejectUpdate(Request $request, $id)
    // {
    //     $request->validate([
    //         'id_jenis_reject'=>'required',
    //         'jumlah_reject'=>'required',
    //     ]);

    //     Reject::where('id', $id)->update([
    //         'id_jenis_reject'=>$request->id_jenis_reject,
    //         'id_tempat_reject'=>$request->id_tempat_reject,
    //         'id_spesifik_tempat'=>$request->id_spesifik_tempat,
    //         'id_paramater_reject'=>$request->id_paramater_reject,
    //         'jumlah_reject'=>$request->jumlah_reject,
    //     ]);

    //     return redirect('/dashboard/reject-produksi');
    // }

    // public function rejectEdit($id)
    // {
    //     $jenis_rejects = JenisReject::get();
    //     $parameter_rejects = ParameterReject::get();
    //     $tempat_rejects = TempatReject::get();
    //     $spesifik_rejects = SpesifikTempat::get();
    //     $reject = Reject::where('id', $id)->first();
    //     return view('dashboard.produksi.reject.edit', compact('reject','jenis_rejects','parameter_rejects','tempat_rejects','spesifik_rejects'));
    // }

    // public function rejectDestroy($id)
    // {
    //     Reject::where('id', $id)->delete();
    //     return redirect('/dashboard/reject-produksi');
    // }

    public function rejectBotol(Request $request, $produksi_id, $batch_id)
    {
        $jenis_rejects = JenisReject::get();
        $parameter_rejects = ParameterReject::get();
        $tempat_rejects = TempatReject::get();
        $spesifik_rejects = SpesifikTempat::get();
        $submittedValues = $request->input('reject');

    // Merge the submitted values with the original parameter rejects collection
        $rejects = Reject::where([['id_jenis_reject', '1'],['produksi_id', $produksi_id],['batch_id', $batch_id]])->get();

        $previousData = [];

        foreach ($rejects as $reject) {
            $parameterId = $reject->id_paramater_reject;
            $spesifikTempatId = $reject->id_spesifik_tempat;

            if (!isset($previousData[$parameterId])) {
                $previousData[$parameterId] = [];
            }

            $previousData[$parameterId][$spesifikTempatId] = $reject->jumlah_botol;
        }


        // dd($previousData);
        return view('dashboard.produksi.reject.botol.index', compact('produksi_id','batch_id','jenis_rejects','parameter_rejects','tempat_rejects','spesifik_rejects','rejects','previousData'));
    }

    // public function rejectCap($produksi_id, $batch_id)
    // {
    //     $jenis_rejects = JenisReject::get();
    //     $parameter_rejects = ParameterReject::get();
    //     $tempat_rejects = TempatReject::get();
    //     $spesifik_rejects = SpesifikTempat::get();
    //     $rejects = Reject::where([['id_jenis_reject', '2'],['produksi_id', $produksi_id],['batch_id', $batch_id]])->get();
    //     return view('dashboard.produksi.reject.cap.index', compact('produksi_id','batch_id','jenis_rejects','parameter_rejects','tempat_rejects','spesifik_rejects','rejects','previousData'));
    // }

    public function rejectBotolStore(Request $request, $produksi_id, $batch_id)
    {
        // $request->validate([
        //     'reject' => 'required|array|min:1',

        //     // 'inputSampel.*.keterangan' => 'required|min:5',
        // ]);

        foreach($request->input('reject.*.produksi') as $key => $value){
                if ($value == '') {

                } elseif(!$value == '') {
                     DB::table('rejects')->insert([
                    'produksi_id' => $produksi_id,
                    'batch_id' => $batch_id,
                    'id_jenis_reject' => 1,
                    'id_tempat_reject' => $request->id_tempat_reject,
                    'id_spesifik_tempat' => 1,
                    'id_paramater_reject'=>$key + 1,
                    'jumlah_botol' => $value,
                ]);
                }

            }


        foreach($request->input('reject.*.hci') as $key => $value){
            if ($value == '') {

            } elseif(!$value == '') {
                 DB::table('rejects')->insert([
                'produksi_id' => $produksi_id,
                'batch_id' => $batch_id,
                'id_jenis_reject' => 1,
                'id_tempat_reject' => $request->id_tempat_reject,
                'id_spesifik_tempat' => 2,
                'id_paramater_reject'=>$key + 1,
                'jumlah_botol' => $value,
            ]);
            }

            }
            toast('Berhasil menambahkan!','success');
            return redirect()->back();


        // $request->validate([
        //     'jumlah_botol'=>'required'
        // ]);

        // Reject::create([
        //     'produksi_id'=>$produksi_id,
        //     'batch_id'=>$batch_id,
        //     'id_jenis_reject'=>'1',
        //     'id_tempat_reject'=>$request->id_tempat_reject,
        //     'id_spesifik_tempat'=>$request->id_spesifik_tempat,
        //     'id_paramater_reject'=>$request->id_paramater_reject,
        //     'jumlah_botol'=>$request->jumlah_botol,
        // ]);

    }

    // public function rejectCapStore(Request $request, $produksi_id, $batch_id)
    // {
    //     $request->validate([
    //         'jumlah_cap'=>'required',
    //     ]);

    //     Reject::create([
    //         'produksi_id'=> $produksi_id,
    //         'batch_id'=>$batch_id,
    //         'id_jenis_reject'=>'2',
    //         'id_tempat_reject'=>$request->id_tempat_reject,
    //         'id_spesifik_tempat'=>$request->id_spesifik_tempat,
    //         'id_paramater_reject'=>$request->id_paramater_reject,
    //         'jumlah_cap'=>$request->jumlah_cap,
    //     ]);

    //     return redirect()->back();
    // }

    public function rejectBotolEdit($reject)
    {
        $jenis_rejects = JenisReject::get();
        $parameter_rejects = ParameterReject::get();
        $tempat_rejects = TempatReject::get();
        $spesifik_rejects = SpesifikTempat::get();
        $rejek = Reject::where('id', $reject)->first();
        return view('dashboard.produksi.reject.botol.edit', compact('rejek','jenis_rejects','parameter_rejects','tempat_rejects','spesifik_rejects', 'reject'));

    }

    // public function rejectCapEdit($reject)
    // {
    //     $jenis_rejects = JenisReject::get();
    //     $parameter_rejects = ParameterReject::get();
    //     $tempat_rejects = TempatReject::get();
    //     $spesifik_rejects = SpesifikTempat::get();
    //     $rejek = Reject::where('id', $reject)->first();
    //     return view('dashboard.produksi.reject.cap.edit', compact('rejek','jenis_rejects','parameter_rejects','tempat_rejects','spesifik_rejects', 'reject'));

    // }

    public function rejectBotolUpdate(Request $request, $reject)
    {
        $request->validate([
            'jumlah_botol'=>'required'
        ]);

        Reject::where('id', $reject)->update([
            'id_jenis_reject'=>'1',
            'id_tempat_reject'=>$request->id_tempat_reject,
            'id_spesifik_tempat'=>$request->id_spesifik_tempat,
            'id_paramater_reject'=>$request->id_paramater_reject,
            'jumlah_botol'=>$request->jumlah_botol,
        ]);

        return redirect()->back();
    }

    // public function rejectCapUpdate(Request $request, $reject)
    // {
    //     $request->validate([
    //         'jumlah_cap'=>'required',
    //     ]);

    //     Reject::where('id', $reject)->update([
    //         'id_jenis_reject'=>'2',
    //         'id_tempat_reject'=>$request->id_tempat_reject,
    //         'id_spesifik_tempat'=>$request->id_spesifik_tempat,
    //         'id_paramater_reject'=>$request->id_paramater_reject,
    //         'jumlah_cap'=>$request->jumlah_cap,
    //     ]);

    //     return redirect()->back();
    // }

    public function rejectBotolDestroy($reject)
    {
        Reject::where('id', $reject)->delete();
        return redirect()->back();
    }

    // public function rejectCapDestroy($reject)
    // {
    //     Reject::where('id', $reject)->delete();
    //     return redirect()->back();
    // }


}
