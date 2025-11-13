@if (empty($acara))
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-exclamation-triangle-fill fs-4 me-3 text-warning"></i>
                        <div>
                            <h5 class="alert-heading fw-bold mb-1">Perhatian!</h5>
                            <p class="mb-0">Mohon lengkapi data acara utama terlebih dahulu sebelum menambahkan data
                                orang tua.</p>
                        </div>
                    </div>
                    <div class="ms-3">
                        <a href="{{ route('acara.index') }}" class="btn btn-warning">
                            <i class="bi bi-arrow-right-circle me-1"></i>
                            Ke Halaman Data Acara
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <form id="form-rekening" method="POST">
        @csrf
        @method('PUT')
     <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nama_bank" class="form-label">Nama Bank <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama_bank" name="nama_bank"
                        placeholder="Masukkan nama lengkap" value="{{ $rekening->nama_bank }}">
                    <div id="nama_bankFeedback" class="invalid-feedback"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nomor_rekening" class="form-label">Nomor Rekening <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nomor_rekening" name="nomor_rekening"
                        placeholder="Masukkan nama panggilan"  value="{{ $rekening->nomor_rekening }}">
                    <div id="nomor_rekeningFeedback" class="invalid-feedback"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nama_pemilik_rekening" class="form-label">Nama Pemilik <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama_pemilik_rekening" name="nama_pemilik_rekening"
                        placeholder="Masukkan nama_pemilik_rekening"  value="{{ $rekening->nama_pemilik_rekening }}">
                    <div id="nama_pemilik_rekeningFeedback" class="invalid-feedback"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="is_active" class="form-label">Status <span class="text-danger">*</span></label>
                    <div class="form-check form-switch">
                        <input type="hidden" name="is_active" value="0">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                            value="1" {{ $rekening->is_active ? 'checked' : '' }}>
                    </div>
                    <div id="is_activeFeedback" class="invalid-feedback"></div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary mb-3"
                onclick="update('{{ $rekening->id }}')">Simpan</button>
        </div>
    </form>
@endif
