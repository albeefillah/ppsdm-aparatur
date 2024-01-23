<!-- resources/views/rincian_row.blade.php -->

<tr>
    <td style="background: #DDEBF7;" align="center"> <b> {{ $item['kode_lengkap'] }} </b></td>
    <td style="background: #DDEBF7;"><b>{{ $item['deskripsi'] }}</b></td>
    <td style="background: #DDEBF7;" align="right"><b>{{ number_format( $item['pagu'], 0, ",", ".") }}</b></td>
    <td style="background: #DDEBF7;"></td>
</tr>

@if (!empty($item['subkom']))
    @foreach ($item['subkom'] as $subkom)
        @include('anggaran/keuangan/rkakl_awal/row/subkom', ['item' => $subkom])
    @endforeach
@endif
