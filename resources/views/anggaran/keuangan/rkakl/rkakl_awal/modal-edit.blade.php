<!-- resources/views/posts/edit.blade.php -->
<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Ubah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Include your edit form here, for example: -->
                <!-- resources/views/posts/edit.blade.php -->
            <form action="{{ route('rkakl.update', ['id' => $item->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="kode">Kode</label>
                    <input type="text" class="form-control" id="kode" name="kode" value="{{ $item->kode }}">
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ $item->deskripsi }}">
                </div>
                <div class="form-group">
                    <label for="jumlah_biaya">Jumlah Biaya</label>
                    <input type="text" class="form-control" id="jumlah_biaya" name="jumlah_biaya" value="{{ $item->jumlah_biaya }}">
                </div>
                <!-- Tambahkan input lain sesuai kebutuhan -->
                <button type="submit" class="btn btn-primary">Update</button>
            </form>

            </div>
        </div>
    </div>
</div>
