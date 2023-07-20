<?php

namespace App\Exports;

use App\Models\Batch;
use App\Models\BatchList;
use App\Models\Counter;
use App\Models\FinishGood;
use App\Models\Processing;
use App\Models\Reject;
use App\Models\Sampel;
use App\Models\Varian;
use Carbon\Carbon;
use App\Models\Produksi;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Color;


class ProduksiExport implements FromView, ShouldAutoSize, WithStyles
{

    protected $id;
    function __construct($id) {
            $this->id = $id;
    }

    public function styles(Worksheet $sheet)
    {
        $varian = Varian::where('id', $this->id)->first();

        $styleArray = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_DOTTED,
                    'color' => ['argb' => 'FF6D60'],
                ],
            ],
        ];
        $sheet->getStyle('A1:Q5')->getFont()->setBold(true);

        $sheet->getStyle('A5:Q5')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'C6E0B4'],]);
        $sheet->getStyle('H3:L4')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => '00B0F0'],]);
        $sheet->getStyle('A3:G4')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'FFFF00'],]);
        $sheet->getStyle('M3:M4')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => '00B050'],]);
        $sheet->getStyle('N3:N4')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'A9D08E'],]);
        $sheet->getStyle('O3:O4')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'BF8F00'],]);
        $sheet->getStyle('P3:P4')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'FDE9D9'],]);

        if ($varian->lakban2) {

            $sheet->getStyle('M6:M11')->getFont()->setBold(true);
            $sheet->getStyle('F6:F11')->getFont()->setBold(true);
            $sheet->getStyle('B12')->getFont()->setBold(true);
            $sheet->getStyle('B15')->getFont()->setBold(true);
            $sheet->getStyle('B20')->getFont()->setBold(true);

            //fill color


            $sheet->getStyle('D6:D11')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'E4DFEC'],]);
            $sheet->getStyle('F6:F11')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'E4DFEC'],]);
            $sheet->getStyle('G6:G11')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'F4B084'],]);

            $sheet->getStyle('M6:M11')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'E4DFEC'],]);
            $sheet->getStyle('N6:N11')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'A9D08E'],]);
            $sheet->getStyle('O6:O11')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'F4B084'],]);
            $sheet->getStyle('P6:P11')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'E4DFEC'],]);
            $sheet->getStyle('Q3:Q11')->getFont()->setColor(new Color('000080'));
        } else {

            $sheet->getStyle('M6:M10')->getFont()->setBold(true);
            $sheet->getStyle('F6:F10')->getFont()->setBold(true);
            $sheet->getStyle('B11')->getFont()->setBold(true);
            $sheet->getStyle('B14')->getFont()->setBold(true);
            $sheet->getStyle('B19')->getFont()->setBold(true);

            $sheet->getStyle('D6:D10')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'E4DFEC'],]);
            $sheet->getStyle('F6:F10')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'E4DFEC'],]);
            $sheet->getStyle('G6:G10')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'F4B084'],]);

            $sheet->getStyle('M6:M10')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'E4DFEC'],]);
            $sheet->getStyle('N6:N10')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'A9D08E'],]);
            $sheet->getStyle('O6:O10')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'F4B084'],]);
            $sheet->getStyle('P6:P10')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'E4DFEC'],]);
            $sheet->getStyle('Q3:Q10')->getFont()->setColor(new Color('000080'));

        }


        //font bold



        // $sheet->getStyle('P1:P2')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'C7753D'],]);
        $sheet->getStyle('A3:' . $sheet->getHighestColumn() . $sheet->getHighestRow())->applyFromArray($styleArray);
    }

    public function view(): \Illuminate\Contracts\View\View
    {
        $varian = Varian::where('id', $this->id)->first();

        $reject = Reject::where('produksi_id', $this->id)->sum('jumlah_botol');
        // $reject_produksi = Reject::where([['produksi_id', $this->id],['id_spesifik_tempat', 1]])->sum('jumlah_botol');
        $reject_produksi = Reject::where([['produksi_id', $this->id],['id_spesifik_tempat', 1]])->sum('jumlah_botol');
        $reject_hci = Reject::where([['produksi_id', $this->id],['id_spesifik_tempat', 2]])->whereIn('id_tempat_reject', [1,2])->sum('jumlah_botol');
        $defect_hci = Reject::where([['produksi_id', $this->id],['id_spesifik_tempat', 2]])->whereIn('id_tempat_reject', [3,4])->sum('jumlah_botol');
        $reject_cap = Reject::where('produksi_id', $this->id)->whereIn('id_paramater_reject', [33])->sum('jumlah_botol');

        $sampel = Sampel::where('produksi_id', $this->id)->sum('jumlah_botol');
        // $trial_botol = Varian::where('produksi_id', $this->id)->first()->trial_botol;
        // $trial_cap = Varian::where('produksi_id', $this->id)->first()->trial_cap;
        $jatuh_botol = Varian::where('produksi_id', $this->id)->first()->jatuh_botol;
        // $jatuh_filling_cap = Varian::where('produksi_id', $this->id)->first()->jatuh_filling_cap;

        $reject_produksi_cap = $reject_produksi - $reject_cap + $varian->jatuh_filling_cap;

        $finish_good = FinishGood::where('produksi_id', $this->id)->sum('pcs');

        $counter_coding = Counter::where('produksi_id', $this->id)->sum('counter_coding');
        $counter_filling = Counter::where('produksi_id', $this->id)->sum('counter_filling');
        $counter_label = Counter::where('produksi_id', $this->id)->sum('counter_label');

        $unidentified = $reject + $sampel + $finish_good - $counter_filling;
        $pakai_botol = $finish_good + $reject_produksi + $varian->trial_botol + $varian->jatuh_botol + $sampel + $reject_hci + $defect_hci - $unidentified;
        $pakai_cap = $finish_good + $reject_produksi_cap + $varian->trial_cap + $sampel + $reject_hci + $defect_hci;

        $batch_lists = BatchList::join('produksis', 'batch_lists.produksi_id', '=', 'produksis.id')->where('produksis.id', $this->id)
                                ->select('batch_lists.id as id','batch_lists.batch_id as batch_id','batch_lists.created_at as created_at_batch','batch_lists.produksi_id as produksi_id','produksis.keterangan as keterangan')->get();

        $liquid = Processing::where('produksi_id', $this->id)->first();
        if (!$liquid == '') {
            $volume_mixing = $liquid->volume_mixing / $liquid->density->name;
            $finish_good_liter = $finish_good * number_format(floatval($liquid->volume) / 1000, 5, '.', '');
            // dd(floatval($liquid->volume)  / 1000);
            $loss_liquid = $volume_mixing -$finish_good_liter;
        } else {
            $volume_mixing = '';
            $loss_liquid = '';
            $yield = '';
            $finish_good_liter = '';
        }



        $batchs = Batch::all();
        $produksi = Produksi::where('id', $this->id)->first();
        $tgl_produksi =  Carbon::parse($produksi->tgl_produksi)->translatedFormat('dmY');

        return view('exports.export-produksi', [
            'produksi' => $produksi,
            'batch_lists' => $batch_lists,
            'batchs' => $batchs,
            'varian' => $varian,
            'reject' => $reject,
            'reject_produksi' => $reject_produksi,
            'reject_produksi_cap' => $reject_produksi_cap,
            'reject_hci' => $reject_hci,
            'defect_hci' => $defect_hci,
            'reject_cap' => $reject_cap,
            'sampel' => $sampel,
            'finish_good' => $finish_good,
            'finish_good_liter' => $finish_good_liter,
            'counter_coding' => $counter_coding,
            'counter_filling' => $counter_filling,
            'counter_label' => $counter_label,
            'unidentified' => $unidentified,
            'pakai_botol' => $pakai_botol,
            'pakai_cap' => $pakai_cap,
            'volume_mixing' => $volume_mixing,
            'loss_liquid' => $loss_liquid,
            'jatuh_botol' => $jatuh_botol,
            'jatuh_filling_cap' => $varian->jatuh_filling_cap,
            'tgl_produksi' => $tgl_produksi,

        ]);
    }
}
