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
    <form id="form-galeri" enctype="multipart/form-data">
        @csrf
        <div class="row">
            {{-- Kolom Kiri --}}
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="jenis_foto" class="form-label">Jenis Foto <span class="text-danger">*</span></label>
                    <select name="jenis_foto" id="jenis_foto" class="form-control" required>
                        <option value="" selected disabled>Pilih Jenis Foto</option>
                        <option value="PREWEDDING">Prewedding</option>
                        <option value="WEDDING">Wedding</option>
                        <option value="ENGAGEMENT">Engagement</option>
                        <option value="FOTO_MEMPELAI_PRIA">Foto Mempelai Pria</option>
                        <option value="FOTO_MEMPELAI_WANITA">Foto Mempelai Wanita</option>
                        <option value="FOTO_BERSAMA">Foto Bersama</option>
                    </select>
                    <div id="jenis_fotoFeedback" class="invalid-feedback"></div>
                </div>

                <div class="mb-3">
                    <label for="file_foto" class="form-label">Unggah Foto <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" id="file_foto" name="file_foto" accept="image/*"
                        required>
                    <div id="file_fotoFeedback" class="invalid-feedback"></div>
                </div>
            </div>

            {{-- Kolom Kanan --}}
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="is_featured" class="form-label">Unggulan <span class="text-danger">*</span></label>
                    <div class="form-check form-switch">
                        <input type="hidden" name="is_featured" value="0">
                        <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured"
                            value="1">
                        <label class="form-check-label" for="is_featured">Tandai sebagai foto unggulan</label>
                    </div>
                    <div id="is_featuredFeedback" class="invalid-feedback"></div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <button type="button" class="btn btn-primary" onclick="store()">
                <i class="ti-save me-1"></i> Simpan
            </button>
        </div>
    </form>
@endif
