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
use App\Models\Produksi;
use App\Models\Reject;
use App\Models\Sampel;
use App\Models\SpesifikTempat;
use App\Models\TempatReject;
use App\Models\Trial;
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
        $request->validate([
            'parameter_id'=>'required',
            'botol_id'=>'required',
            'cap_id'=>'required',
            'karton_id'=>'required',
            'label_id'=>'required',
            'lakban_id'=>'required'
        ]);

        $varian = $request->all();
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
        $lakbans = Lakban::all();
        $parameters = ParameterVarian::all();
        return view('dashboard.produksi.varian.edit', compact('varian','botols','caps','kartons','labels','lakbans','parameters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Varian $varian)
    {
        $request->validate([
            'parameter_id'=>'required',
            'botol_id'=>'required',
            'cap_id'=>'required',
            'label_id'=>'required',
            'karton_id'=>'required',
            'lakban_id'=>'required'
        ]);

        if ($request->lakban2_id == null) {
            $varians = [
                'parameter_id'=>$request->parameter_id,
                'botol_id'=>$request->botol_id,
                'cap_id'=>$request->cap_id,
                'label_id'=>$request->label_id,
                'karton_id'=>$request->karton_id,
                'lakban_id'=>$request->lakban_id,
            ];
        } else {
            $varians = [
                'parameter_id'=>$request->parameter_id,
                'botol_id'=>$request->botol_id,
                'cap_id'=>$request->cap_id,
                'label_id'=>$request->label_id,
                'karton_id'=>$request->karton_id,
                'lakban_id'=>$request->lakban_id,
                'lakban2_id'=>$request->lakban2_id,
            ];
        }

        Varian::where('id', $varian->id)->update($varians);
        toast('Berhasil mengupdate!','success');
        return redirect('/dashboard/varian');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Varian $varian)
    {
        $varian->delete();
        Produksi::where('id', $varian->produksi_id)->delete();
    toast('Berhasil menghapus!','success');
        return redirect('/dashboard/varian');
    }

    public function detail($id)
    {
        $varian = Varian::where('id', $id)->first();

        $reject_produksi = Reject::where([['produksi_id', $id],['id_spesifik_tempat', 1]])->sum('jumlah_botol');
        $reject_cap = Reject::where('produksi_id', $id)->whereIn('id_paramater_reject', [33])->sum('jumlah_botol');

        $reject_produksi_cap = $reject_produksi - $reject_cap + $varian->jatuh_filling_cap;


        $finish_good = FinishGood::where('produksi_id', $varian->produksi_id)->sum('pcs');
        $reject_supplier = Reject::where('produksi_id', $varian->produksi_id)->where('id_spesifik_tempat', 2)->sum('jumlah_botol');
        $sampel = Sampel::where('produksi_id', $varian->produksi_id)->sum('jumlah_botol');
        // $reject_filling_inspectlamp = Reject::where('produksi_id', $varian->produksi_id)->where('id_spesifik_tempat', 1)->where('id_tempat_reject', '<', 3)->sum('jumlah_botol');
        // $reject_cooling_conveyor = Reject::where('produksi_id', $varian->produksi_id)->where('id_spesifik_tempat', 1)->where('id_tempat_reject','>', 2)->whereIn('id_paramater_reject', [2,3,4,9,11,15,16,19,26,27,33,34])->sum('jumlah_botol');

        // $reject_produksi = $reject_filling_inspectlamp + $reject_cooling_conveyor;
        $reject_produksi = Reject::where('produksi_id', $varian->produksi_id)->where('id_spesifik_tempat', 1)->sum('jumlah_botol');
        $reject_cap = Reject::where('produksi_id', $varian->produksi_id)->whereIn('id_paramater_reject', [33])->sum('jumlah_botol');

        $reject = $reject_produksi - $reject_cap;

        $rejectProduksi = $sampel + $reject_supplier + $reject + $varian->jatuh_filling_cap + $varian->trial_cap;
        $pakai_cap =  $finish_good + $rejectProduksi;

        $counter_filling = Counter::where('produksi_id', $varian->produksi_id)->sum('counter_filling');
        $counter_coding = Counter::where('produksi_id', $varian->produksi_id)->sum('counter_coding');
        $counter_label = Counter::where('produksi_id', $varian->produksi_id)->sum('counter_label');
        $conversi_label = Varian::where('id', $id)->first()->conversi_label;
        $trial_botol = Trial::where('produksi_id', $varian->produksi_id)->sum('trial_botol');
        $trial_cap = Trial::where('produksi_id', $varian->produksi_id)->sum('trial_cap');

        return view('dashboard.produksi.varian.detail', compact( 'reject_produksi_cap','sampel','rejectProduksi','pakai_cap', 'id','trial_botol','trial_cap', 'varian','finish_good', 'counter_filling','counter_coding','counter_label','conversi_label'));
    }

    public function botolStore($id, Request $request)
    {
        $botol = [
            'trial_botol'=>$request->trial_botol,
            'jatuh_botol'=>$request->jatuh_botol,
        ];

        Varian::where('id', $id)->update($botol);
        toast('Berhasil!','success');
        return redirect()->back();
    }

    public function capStore($id, Request $request)
    {
        $request->validate([
            'masuk_cap'=>$request->saldo_awal_cap ? '' : 'required',
            'saldo_awal_cap'=> $request->masuk_cap ? '' : 'required',
        ]);

        $pakai_cap = $request->masuk_cap + $request->saldo_awal_cap - $request->saldo_cap;
        $varians = $pakai_cap - $request->masuk_cap;

        $cap = [
            'saldo_awal_cap'=>$request->saldo_awal_cap,
            'saldo_cap'=>$request->saldo_cap,
            'masuk_cap'=>$request->masuk_cap,
            'pakai_cap'=>$pakai_cap,
            'jatuh_filling_cap'=>$request->jatuh_filling_cap,
            'sampel_cap'=>$request->sampel_cap,
            'trial_cap'=>$request->trial_cap,
        ];

        Varian::where('id', $id)->update($cap);
        toast('Berhasil!','success');
        return redirect()->back();
    }

    public function labelStore($id, Request $request)
    {
        $request->validate([
            'masuk_label'=>$request->saldo_awal_label ? '' : 'required',
            'saldo_awal_label'=> $request->masuk_label ? '' : 'required',
            'conversi_label'=>'required'
        ]);

        $pakai_label = $request->masuk_label + $request->saldo_awal_label - $request->saldo_label;
        $varians = $pakai_label - $request->masuk_label + $request->saldo_awal_label;

        $label = [
            'saldo_awal_label'=>$request->saldo_awal_label,
            'saldo_label'=>$request->saldo_label,
            'masuk_label'=>$request->masuk_label,
            'pakai_label'=>$pakai_label,
            'conversi_label'=>$request->conversi_label
        ];

        Varian::where('id', $id)->update($label);
        toast('Berhasil!','success');
        return redirect()->back();
    }

    public function kartonStore($id, Request $request)
    {
        $request->validate([
            'masuk_karton'=>$request->saldo_awal_karton ? '' : 'required',
            'saldo_awal_karton'=> $request->masuk_karton ? '' : 'required',
            'conversi_karton'=>'required'
        ]);

        $pakai_karton = $request->masuk_karton + $request->saldo_awal_karton - $request->saldo_karton - $request->reject_karton - $request->reject_supplier_karton;

        $karton = [
            'saldo_awal_karton'=>$request->saldo_awal_karton,
            'saldo_karton'=>$request->saldo_karton,
            'conversi_karton'=>$request->conversi_karton, // 'conversi_karton'=>$request->conversi_karton ? $request->conversi_karton : '0
            'masuk_karton'=>$request->masuk_karton,
            'terpakai_karton'=>$pakai_karton,
            'reject_supplier_karton'=>$request->reject_supplier_karton
        ];


        Varian::where('id', $id)->update($karton);
        toast('Berhasil!','success');
        return redirect()->back();
    }

    public function lakbanStore($id, Request $request)
    {
        $request->validate([
            'masuk_lakban'=>$request->saldo_awal_lakban1 ? '' : 'required',
            'saldo_awal_lakban1'=> $request->masuk_lakban ? '' : 'required',
        ]);

        $pakai_lakban = $request->masuk_lakban + $request->saldo_awal_lakban1 - $request->saldo_lakban + $request->reject_supplier_lakban;

        $lakban = [
            'saldo_awal_lakban1'=>$request->saldo_awal_lakban1,
            'saldo_lakban'=>$request->saldo_lakban,
            'masuk_lakban'=>$request->masuk_lakban,
            'terpakai_lakban'=>$pakai_lakban,
            'reject_supplier_lakban'=>$request->reject_supplier_lakban
        ];


        Varian::where('id', $id)->update($lakban);
        toast('Berhasil!','success');
        return redirect()->back();
    }

    public function lakbanStore2($id, Request $request)
    {
        $request->validate([
            'masuk_lakban2'=>$request->saldo_awal_lakban2 ? '' : 'required',
            'saldo_awal_lakban2'=> $request->masuk_lakban2 ? '' : 'required',
        ]);

        $pakai_lakban2 = $request->masuk_lakban2 + $request->saldo_awal_lakban2 - $request->saldo_lakban2 + $request->reject_supplier_lakban2;

        $lakban = [
            'saldo_awal_lakban2'=>$request->saldo_awal_lakban2,
            'saldo_lakban2'=>$request->saldo_lakban2,
            'masuk_lakban2'=>$request->masuk_lakban2,
            'terpakai_lakban2'=>$pakai_lakban2,
            'reject_supplier_lakban2'=>$request->reject_supplier_lakban2
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


    public function rejectBotol(Request $request, $produksi_id, $batch_id)
    {
        $jenis_rejects = JenisReject::get();
        $parameter_rejects = ParameterReject::get();
        $tempat_rejects = TempatReject::get();
        $spesifik_rejects = SpesifikTempat::get();
        $submittedValues = $request->input('reject');

    // Merge the submitted values with the original parameter rejects collection
        $rejects = Reject::where([['id_jenis_reject', '1'],['produksi_id', $produksi_id],['batch_id', $batch_id]]);

        if ($request->has('filter')) {
            if ($request->input('filter') == 'terkecil') {

                $rejects->orderByRaw('jumlah_botol + 0 ASC');
            } elseif($request->input('filter') == 'terbesar') {
                $rejects->orderByRaw('jumlah_botol + 0 DESC');
            }
        }

        if ($request->has('parameter')) {
            $rejects->where('id_paramater_reject', $request->input('parameter'));
        }

        if ($request->has('tempat')) {
            $rejects->where('id_tempat_reject', $request->input('tempat'));
        }

        if ($request->has('spesifik')) {
            $rejects->where('id_spesifik_tempat', $request->input('spesifik'));
        }

    $rejects = $rejects->get();

        // dd($previousData);
        return view('dashboard.produksi.reject.botol.index', compact('produksi_id','batch_id','jenis_rejects','parameter_rejects','tempat_rejects','spesifik_rejects','rejects'));
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

        toast('Berhasil diupdate!','success');
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
        toast('Berhasil dihapus!','success');
        return redirect()->back();
    }

    // public function rejectCapDestroy($reject)
    // {
    //     Reject::where('id', $reject)->delete();
    //     return redirect()->back();
    // }


}
