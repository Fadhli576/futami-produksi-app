<?php

namespace App\Http\Controllers;

use App\Models\BatchList;
use App\Models\Counter;
use App\Models\Varian;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($produksi_id, $batch_id, $param_id)
    {
        return view('dashboard.produksi.counter.index', compact('produksi_id', 'batch_id','param_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($produksi_id, $param_id)
    {
        $batch_lists = BatchList::with('counter')->where('produksi_id', $produksi_id)->get();
        $varian = Varian::where('produksi_id', $produksi_id)->select('trial_botol','jatuh_botol')->first();
        return view('dashboard.produksi.varian.counter', compact('param_id', 'produksi_id', 'batch_lists', 'varian'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function storeMultiple(Request $request, $produksi_id, $param_id)
    {
        $batch_lists = BatchList::where('produksi_id', $produksi_id)->get();
        foreach ($batch_lists as $key => $batch_list) {
            $counter = Counter::where('batch_id', $batch_list->batch_id)->where('produksi_id', $produksi_id)->first();
            if ($counter == null) {
                if ($param_id == 1) {
                    Counter::create([
                        'produksi_id'=>$batch_list->produksi_id,
                        'batch_id'=>$batch_list->batch_id,
                        'counter_filling'=>$request->counter[$key]
                    ]);
                    toast('Berhasil menambahkan!', 'success');
                } elseif($param_id == 2) {
                    Counter::create([
                        'produksi_id'=>$batch_list->produksi_id,
                        'batch_id'=>$batch_list->batch_id,
                        'counter_coding'=>$request->counter[$key]
                    ]);
                    toast('Berhasil menambahkan!', 'success');
                } elseif ($param_id == 3) {
                    Counter::create([
                        'produksi_id'=>$batch_list->produksi_id,
                        'batch_id'=>$batch_list->batch_id,
                        'counter_label'=>$request->counter[$key]
                    ]);
                    toast('Berhasil menambahkan!', 'success');
                }
            } else {
                if ($param_id == 1) {
                    $counter->update([
                        'produksi_id'=>$produksi_id,
                        'batch_id'=>$batch_list->batch_id,
                        'counter_filling'=>$request->counter[$key]
                    ]);
                } elseif($param_id == 2) {
                    $counter->update([
                        'produksi_id'=>$produksi_id,
                        'batch_id'=>$batch_list->batch_id,
                        'counter_coding'=>$request->counter[$key]
                    ]);
                } elseif ($param_id == 3) {
                    $counter->update([
                        'produksi_id'=>$produksi_id,
                        'batch_id'=>$batch_list->batch_id,
                        'counter_label'=>$request->counter[$key]
                    ]);
                }
                toast('Data berhasil diupdate!', 'error');
            }

        }
        return redirect()->back();
    }


    public function store(Request $request, $produksi_id, $batch_id, $param_id)
    {
        $request->validate([
            'counter'=>'required'
        ]);

        $counter = Counter::where('batch_id', $batch_id)->where('produksi_id', $produksi_id)->first();

        if ($counter != null) {
            if ($param_id == 1) {
                $counter->update([
                    'produksi_id'=>$produksi_id,
                    'batch_id'=>$batch_id,
                    'counter_filling'=>$request->counter
                ]);
            } elseif($param_id == 2) {
                $counter->update([
                    'produksi_id'=>$produksi_id,
                    'batch_id'=>$batch_id,
                    'counter_coding'=>$request->counter
                ]);
            } elseif ($param_id == 3) {
                $counter->update([
                    'produksi_id'=>$produksi_id,
                    'batch_id'=>$batch_id,
                    'counter_label'=>$request->counter
                ]);
            }
        } else {

            if ($param_id == 1) {
                Counter::create([
                    'produksi_id'=>$produksi_id,
                    'batch_id'=>$batch_id,
                    'counter_filling'=>$request->counter
                ]);
            } elseif($param_id == 2) {
                Counter::create([
                    'produksi_id'=>$produksi_id,
                    'batch_id'=>$batch_id,
                    'counter_coding'=>$request->counter
                ]);
            } elseif ($param_id == 3) {
                Counter::create([
                    'produksi_id'=>$produksi_id,
                    'batch_id'=>$batch_id,
                    'counter_label'=>$request->counter
                ]);
            }
        }
        toast('Berhasil menambahkan!', 'success');
        return redirect()->route('batch-list-index', $produksi_id);

    }

    /**
     * Display the specified resource.
     */
    public function show(Counter $counter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, $param_id)
    {
        if ($param_id == 1) {
            $batch_lists = Counter::join('batch_lists', 'counters.batch_id', '=', 'batch_lists.batch_id')->join('batches', 'batch_lists.batch_id', '=', 'batches.id')
            ->where('counters.produksi_id', $id)
            ->select('counters.id as id','counters.batch_id as batch_id','counters.created_at as created_at_batch','counters.produksi_id as produksi_id',
            'counters.counter_filling as counter', 'batches.name as batch_name')->where('batch_lists.produksi_id', $id)->where('counters.counter_filling', '>',0)->get();
        }
        elseif ($param_id == 2) {
            $batch_lists = Counter::join('batch_lists', 'counters.batch_id', '=', 'batch_lists.batch_id')->join('batches', 'batch_lists.batch_id', '=', 'batches.id')
            ->where('counters.produksi_id', $id)
            ->select('counters.id as id','counters.batch_id as batch_id','counters.created_at as created_at_batch','counters.produksi_id as produksi_id',
            'counters.counter_coding as counter', 'batches.name as batch_name')->where('batch_lists.produksi_id', $id)->where('counters.counter_coding', '>',0)->get();
        }
        elseif ($param_id == 3) {
            $batch_lists = Counter::join('batch_lists', 'counters.batch_id', '=', 'batch_lists.batch_id')->join('batches', 'batch_lists.batch_id', '=', 'batches.id')
            ->where('counters.produksi_id', $id)
            ->select('counters.id as id','counters.batch_id as batch_id','counters.created_at as created_at_batch','counters.produksi_id as produksi_id',
            'counters.counter_label as counter', 'batches.name as batch_name')->where('batch_lists.produksi_id', $id)->where('counters.counter_label', '>',0)->get();
        }

        return view('dashboard.produksi.counter.edit', compact('batch_lists', 'param_id', 'id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, $param_id, Request $request)
    {

        if ($param_id == 1) {
        $counters = Counter::where('produksi_id', $id)->where('counter_filling','>',0)->get();
        } elseif ($param_id == 2) {
        $counters = Counter::where('produksi_id', $id)->where('counter_coding','>',0)->get();
        } elseif ($param_id == 3) {
        $counters = Counter::where('produksi_id', $id)->where('counter_label','>',0)->get();
        }

        foreach ($counters as  $counter) {

            if ($param_id == 1) {
                $counter->update([
                    'counter_filling'=>$request->counter[$counter->id]
                ]);
            } elseif ($param_id == 2) {
                $counter->update([
                    'counter_coding'=>$request->counter[$counter->id]
                ]);
            } elseif ($param_id == 3) {
                $counter->update([
                    'counter_label'=>$request->counter[$counter->id]
                ]);
            }

        }

        toast('Berhasil update!', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Counter $counter)
    {
        $counter->delete();
        toast('Berhasil dihapus!', 'success');
        return redirect()->back();
    }
}
