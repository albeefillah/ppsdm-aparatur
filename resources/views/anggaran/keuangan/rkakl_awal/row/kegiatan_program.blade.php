<!-- resources/views/kegiatan_program_row.blade.php -->

<tr>
    <td style="background: #DDEBF7;" align="center"> <b> {{ $item['kode'] }} </b></td>
    <td style="background: #DDEBF7;"><b>{{ $item['deskripsi'] }}</b></td>
    <td style="background: #DDEBF7;" align="right"><b>{{ number_format( $item['pagu'], 0, ",", ".") }}</b></td>
    <td style="background: #DDEBF7;"></td>
</tr>

@if (!empty($item['kro']))
    @foreach ($item['kro'] as $kro)
        @include('anggaran/keuangan/rkakl_awal/row/kro', ['item' => $kro, 'id_rkakl' => $rkakl->id])
    @endforeach
@endif
