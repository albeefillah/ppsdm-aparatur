<tr>
    <td style="background: #DDEBF7;" align="center"> <b> {{ $item['kode'] }} </b></td>
    <td style="background: #DDEBF7;"><b>{{ $item['deskripsi'] }}</b></td>
    <td style="background: #DDEBF7;" align="right"><b>{{ number_format( $item['pagu'], 0, ",", ".") }}</b></td>
    <td style="background: #DDEBF7;">
        <center>
            <a href="{{ route('rkakl.list-akun',  ['detkom' => json_encode($item), 'id_rkakl' => $rkakl->id]) }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Tambah Akun"> <i class="mdi mdi-plus"></i><i class="mdi mdi-wallet"></i></a>
            <a href="{{ route('kegiatan.index') }}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Tambah Kegiatan"> <i class="mdi mdi-plus"></i> <i class="mdi mdi-run"></i></a>
        </center>
        </td>
</tr>   

@if (!empty($item['akun']))
    @foreach ($item['akun'] as $akun)
        @include('anggaran/keuangan/rkakl_awal/row/akun', ['item' => $akun])
    @endforeach
@endif