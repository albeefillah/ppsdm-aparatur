<!-- resources/views/kro_row.blade.php -->

<tr>
    <td style="background: #DDEBF7;" align="center"> <b> {{ $item['kode_lengkap'] }} </b></td>
    <td style="background: #DDEBF7;"><b>{{ $item['deskripsi'] }}</b></td>
    <td style="background: #DDEBF7;" align="right"><b>{{ number_format( $item['pagu'], 0, ",", ".") }}</b></td>
    <td style="background: #DDEBF7;"></td>
</tr>

@if (!empty($item['rincian']))
    @foreach ($item['rincian'] as $rincian)
        @include('anggaran/keuangan/rkakl_awal/row/rincian', ['item' => $rincian])
    @endforeach
@endif
