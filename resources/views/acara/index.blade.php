@extends('layouts.app')

@section('content')
    <div class="title">
        <h1 class="h3 mb-0 text-gray-800">Master | <span class="text-secondary fs-5">Data Acara</span></h1>
    </div>

    <div class="content-wrapper">
        <div class="row same-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Form Data Acara</h5>
                    </div>
                    <div class="card-body">
                        @if ($acara)
                            <form action="{{ route('acara.update', $acara->id) }}" method="POST" id="formAcara">
                                @method('PUT')
                            @else
                                <form action="{{ route('acara.store') }}" method="POST" id="formAcara">
                        @endif
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama_mempelai_pria" class="form-label">Nama Mempelai Pria <span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @error('nama_mempelai_pria') is-invalid @enderror"
                                        id="nama_mempelai_pria" name="nama_mempelai_pria"
                                        value="{{ old('nama_mempelai_pria', $acara->nama_mempelai_pria ?? '') }}"
                                        placeholder="Masukkan Nama Mempelai Pria">
                                    @error('nama_mempelai_pria')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama_mempelai_wanita" class="form-label">Nama Mempelai Wanita <span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @error('nama_mempelai_wanita') is-invalid @enderror"
                                        id="nama_mempelai_wanita" name="nama_mempelai_wanita"
                                        value="{{ old('nama_mempelai_wanita', $acara->nama_mempelai_wanita ?? '') }}"
                                        placeholder="Masukkan Nama Mempelai Wanita">
                                    @error('nama_mempelai_wanita')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama_acara" class="form-label">Nama Acara <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama_acara') is-invalid @enderror"
                                        id="nama_acara" name="nama_acara"
                                        value="{{ old('nama_acara', $acara->nama_acara ?? 'Pernikahan') }}"
                                        placeholder="Masukkan Nama Acara">
                                    @error('nama_acara')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal_acara" class="form-label">Tanggal Acara <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('tanggal_acara') is-invalid @enderror"
                                        id="tanggal_acara" name="tanggal_acara"
                                        value="{{ old('tanggal_acara', $acara->tanggal_acara ?? '') }}">
                                    @error('tanggal_acara')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="deskripsi_acara" class="form-label">Deskripsi Acara</label>
                                    <textarea class="form-control @error('deskripsi_acara') is-invalid @enderror" id="deskripsi_acara"
                                        name="deskripsi_acara" rows="3" placeholder="Masukkan Deskripsi Acara">{{ old('deskripsi_acara', $acara->deskripsi_acara ?? '') }}</textarea>
                                    @error('deskripsi_acara')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            @if ($acara)
                                <button type="button" class="btn btn-secondary confirm-delete">Hapus</button>
                            @endif
                            <button type="submit" class="btn btn-primary">{{ $acara ? 'Perbarui' : 'Simpan' }}</button>
                        </div>
                        </form>
                        @if ($acara)
                            <form id="delete-form" action="{{ route('acara.destroy', $acara->id) }}" method="post"
                                style="display: none;">
                                @csrf
                                @method('delete')
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $('.confirm-delete').click(function(event) {
            // Mengubah ini untuk menargetkan ID formulir hapus secara langsung
            var form = $('#delete-form');
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Data ini akan dihapus permanen. Seluruh data terkait, akan ikut terhapus.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Sukses',
                        'Data berhasil dihapus',
                        'success'
                    ).then(() => {
                        // Submit formulir hapus
                        form.submit();
                    });
                }
            })
        });
    </script>
@endpush
