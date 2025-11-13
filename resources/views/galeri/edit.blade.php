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
    <form id="form-galeri" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            {{-- Kolom Kiri --}}
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="jenis_foto" class="form-label">Jenis Foto <span class="text-danger">*</span></label>
                    <select name="jenis_foto" id="jenis_foto" class="form-control" required>
                        <option value="PREWEDDING" {{ $galeri->jenis_foto == 'PREWEDDING' ? 'selected' : '' }}>
                            Prewedding</option>
                        <option value="WEDDING" {{ $galeri->jenis_foto == 'WEDDING' ? 'selected' : '' }}>Wedding
                        </option>
                        <option value="ENGAGEMENT" {{ $galeri->jenis_foto == 'ENGAGEMENT' ? 'selected' : '' }}>
                            Engagement</option>
                        <option value="FOTO_MEMPELAI_PRIA"
                            {{ $galeri->jenis_foto == 'FOTO_MEMPELAI_PRIA' ? 'selected' : '' }}>Foto Mempelai Pria
                        </option>
                        <option value="FOTO_MEMPELAI_WANITA"
                            {{ $galeri->jenis_foto == 'FOTO_MEMPELAI_WANITA' ? 'selected' : '' }}>Foto Mempelai Wanita
                        </option>
                        <option value="FOTO_BERSAMA" {{ $galeri->jenis_foto == 'FOTO_BERSAMA' ? 'selected' : '' }}>Foto
                            Bersama</option>
                    </select>
                    <div id="jenis_fotoFeedback" class="invalid-feedback"></div>
                </div>

                <div class="mb-3">
                    <label for="file_foto" class="form-label">Unggah Foto <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" id="file_foto" name="file_foto" accept="image/*"
                        required>
                    <div class="form-text">Biarkan kosong jika tidak ingin mengubah foto.</div>
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
                            value="1" {{ $galeri->is_featured ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_featured">Tandai sebagai foto unggulan</label>
                    </div>
                    <div id="is_featuredFeedback" class="invalid-feedback"></div>
                </div>
            </div>

            {{-- Preview foto lama --}}
            @if ($galeri->file_foto)
                <div class="mt-3">
                    <p class="mb-1">Foto Saat Ini:</p>
                    <img src="{{ asset('storage/galeri/' . $galeri->file_foto) }}" alt="Foto Galeri"
                        style="width: 150px; height: auto; border-radius: 8px;">
                </div>
            @endif
        </div>

        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary mb-3" onclick="update('{{ $galeri->id }}')">Simpan</button>
        </div>
    </form>
@endif
