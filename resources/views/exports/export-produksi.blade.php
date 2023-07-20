<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    <table>
        <tr></tr>
        <tr>
            <td>Tanggal:</td>
            <td>{{\Carbon\Carbon::parse($produksi->created_at)->format('d-M-y')}}</td>
            <td></td>
            <td>Total batch:</td>
            <td>{{$batch_lists->count()}}</td>
            <td>Produk:</td>
            <td>{{$varian->parameter->name}}</td>
            <td></td>
            <td></td>
            <td>TOTAL JAM MIXING :</td>
            <td></td>
            <td>TOTAL JAM FILLING :</td>
            <td></td>
        </tr>
        <tr>
            <td rowspan="2">NO</td>
            <td rowspan="2">NAMA BARANG</td>
            <td rowspan="2">SATUAN</td>
            <td rowspan="2">SALDO AWAL</td>
            <td rowspan="2">TERIMA</td>
            <td rowspan="2">TOTAL</td>
            <td>
                OUTPUT ARP
            </td>
            <td colspan="5">
                REJECT PRODUKSI
            </td>
            <td rowspan="2">TOTAL</td>
            <td rowspan="2">RETURN HCI</td>
            <td rowspan="2">RETURN WH</td>
            <td rowspan="2">SALDO AKHIR</td>
            <td rowspan="2">%</td>
        </tr>
        <tr>
            <td>GOOD</td>
            <td>REJECT PRODUKSI</td>
            <td>TRIAL</td>
            <td>SAMPEL QC</td>
            <td>REJECT SUPPLIER</td>
            <td>UNIDENTIFIED</td>
        </tr>
        <tr>
            <td></td>
            <td>PACKAGING</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>1</td>
            <td>{{ $varian->botol->name }}</td>
            <td>Pcs</td>
            <td>-</td>
            <td>{{ $pakai_botol }}</td>
            <td>{{ $pakai_botol }}</td>
            <td>{{ $finish_good }}</td>
            <td>{{ $reject_produksi }} </td>
            <td>{{ $varian->trial_botol + $varian->jatuh_botol }}</td>
            <td>{{ $sampel }}</td>
            <td>{{ $reject_hci + $defect_hci }}</td>
            <td>{{ $unidentified }}</td>
            <td>{{ $pakai_botol }}</td>
            <td>{{ $reject_hci + $defect_hci }}</td>
            <td>-</td>
            <td> - </td>
            <td>{{ $pakai_botol ? number_format((($varian->trial_botol + $varian->jatuh_botol + $reject_produksi + $sampel - $unidentified) / $pakai_botol) * 100, 2) : 0 }} %</td>
        </tr>
        <tr>
            <td>2</td>
            <td>{{ $varian->cap->name }}</td>
            <td>Pcs</td>
            <td>{{ $varian->saldo_awal_cap }}</td>
            <td>{{ $varian->masuk_cap }}</td>
            <td>{{ $varian->masuk_cap + $varian->saldo_awal_cap }}</td>
            <td>{{ $finish_good }}</td>
            <td>{{ $reject_produksi_cap }} </td>
            <td>{{ $varian->trial_cap + $varian->jatuh_filling_cap }}</td>
            <td>{{ $sampel }}</td>
            <td>{{ $reject_hci + $defect_hci }}</td>
            <td></td>
            <td>{{ $pakai_cap }}</td>
            <td>{{ $reject_hci + $defect_hci }}</td>
            <td>-</td>
            <td> {{ $varian->masuk_cap - $pakai_cap }} </td>
            <td>{{ $pakai_cap ? number_format((($varian->trial_cap + $reject_produksi_cap + $sampel) / $pakai_cap) * 100, 2) : 0 }} %</td>
        </tr>
        <tr>
            <td>3</td>
            <td>{{ $varian->label->name }}</td>
            <td>Roll</td>
            <td>{{ $varian->saldo_awal_label}}</td>
            <td>{{ $varian->masuk_label }}</td>
            <td>{{ $varian->masuk_label + $varian->saldo_awal_label }}</td>
            <td>{{ $varian->masuk_label - $varian->saldo_label }}</td>
            <td>{{ $varian->saldo_label == '' ? '0' : number_format(($varians = $varian->pakai_label - $finish_good / $varian->conversi_label) * 1, 2) }} </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{$varian->saldo_label == '' ? '0' : number_format(($varian->pakai_label + $varians), 2) }}</td>
            <td></td>
            <td>-</td>
            <td>{{ $varian->saldo_label }} </td>
            <td>{{ $varian->saldo_label == '' ? 0 : number_format(($varians / $varian->pakai_label) * 100, 2) }} %</td>
        </tr>
        <tr>
            <td>4</td>
            <td>{{ $varian->karton->name }}</td>
            <td>Pcs</td>
            <td>{{ $varian->saldo_awal_karton }}</td>
            <td>{{ $varian->masuk_karton }}</td>
            <td>{{ $varian->masuk_karton + $varian->saldo_awal_karton}}</td>
            <td>{{ $varian->terpakai_karton }}</td>
            <td>{{ $varian->reject_karton }} </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{ $varian->terpakai_karton + $varian->reject_karton }}</td>
            <td></td>
            <td>-</td>
            <td>{{ $varian->saldo_karton }} </td>
            <td>{{ $varian->saldo_karton == '' ? 0 : number_format(($varian->reject_karton / $varian->terpakai_karton) * 100, 2) }} %</td>
        </tr>
        <tr>
            <td>5</td>
            <td>{{ $varian->lakban->name }}</td>
            <td>Roll</td>
            <td>{{ $varian->saldo_awal_lakban1}}</td>
            <td>{{ $varian->masuk_lakban }}</td>
            <td>{{ $varian->masuk_lakban + $varian->saldo_awal_lakban1 }}</td>
            <td>{{ $varian->terpakai_lakban }}</td>
            <td>{{ $varian->reject_lakban }} </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{ $varian->terpakai_lakban }}</td>
            <td></td>
            <td>-</td>
            <td>{{ $varian->saldo_lakban }} </td>
            <td>{{ $varian->reject_lakban ? number_format(($varian->reject_lakban / $varian->pakai_lakban) * 100, 2) : 0 }} %</td>
        </tr>
        @if ($varian->lakban2)
            <tr>
                <td>6</td>
                <td>{{ $varian->lakban2->name }}</td>
                <td>Roll</td>
                <td>{{ $varian->saldo_awal_lakban2}}</td>
                <td>{{ $varian->masuk_lakban2 }}</td>
                <td>{{ $varian->masuk_lakban2 + $varian->saldo_awal_lakban2 }}</td>
                <td>{{ $varian->terpakai_lakban2 }}</td>
                <td>{{ $varian->reject_lakban2 }} </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $varian->terpakai_lakban2 }}</td>
                <td></td>
                <td>-</td>
                <td>{{ $varian->saldo_lakban2 }} </td>
                <td>{{ $varian->reject_lakban2 ? number_format(($varian->reject_lakban2 / $varian->pakai_lakban2) * 100, 2) : 0 }} %</td>
            </tr>
        @endif
        <tr>
            <td></td>
            <td>Loss Liquid</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>1</td>
            <td>Loss Liquid</td>
            <td>Liter</td>
            <td>{{ $loss_liquid == '' ? '0' : number_format($loss_liquid, 2) }}</td>
        </tr>
        <tr>
            <td>2</td>
            <td>% Loss Liquid</td>
            <td>%</td>
            <td>{{ $loss_liquid ? number_format(($loss_liquid / $volume_mixing) * 100, 2) : 0 }} %</td>
        </tr>
        <tr>
            <td></td>
            <td>Hasil Produksi Inline</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>1</td>
            <td>Actual</td>
            <td>Pcs</td>
            <td>{{ $finish_good == '0' ? '0' : ($actual = $finish_good + $sampel + $reject_produksi) }}</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Finish Produk</td>
            <td>Pcs</td>
            <td>{{ $finish_good }}</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Yield</td>
            <td>%</td>
            <td>{{ $finish_good_liter ? number_format(($finish_good_liter / $volume_mixing) * 100, 2) : 0 }} %</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Reject Rate</td>
            <td>%</td>
            <td>{{ $finish_good == '0' ? '0' : number_format((($actual - $finish_good) / $finish_good) * 100, 2) }} %</td>
        </tr>
        <tr>
            <td></td>
            <td>Hasil Inspeksi QC</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>1</td>
            <td>Release</td>
            <td>Pcs</td>
            <td>-</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Yield QC</td>
            <td>%</td>
            <td></td>
        </tr>
        <tr>
            <td>3</td>
            <td>Reject Rate</td>
            <td>%</td>
            <td>-</td>
        </tr>
    </table>
</body>

</html>
