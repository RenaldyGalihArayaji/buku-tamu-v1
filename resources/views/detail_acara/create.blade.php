@if (empty($acara))
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-exclamation-triangle-fill fs-4 me-3 text-warning"></i>
                        <div>
                            <h5 class="alert-heading fw-bold mb-1">Perhatian!</h5>
                            <p class="mb-0">Mohon lengkapi data acara utama terlebih dahulu sebelum menambahkan detail acara.</p>
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
    <form id="form-detail-acara">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nama_detail_acara" class="form-label">Nama<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama_detail_acara" name="nama_detail_acara"
                        placeholder="Cth. Resepsi, Akad, dll">
                    <div id="nama_detail_acaraFeedback" class="invalid-feedback"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="alamat_detail_acara" class="form-label">Alamat<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="alamat_detail_acara" name="alamat_detail_acara"
                        placeholder="Masukan Alamat Acara">
                    <div id="alamat_detail_acaraFeedback" class="invalid-feedback"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="lokasi_detail_acara" class="form-label">Lokasi (Maps) <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="lokasi_detail_acara" name="lokasi_detail_acara"
                        placeholder="Masukan link lokasi">
                    <div id="lokasi_detail_acaraFeedback" class="invalid-feedback"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="tanggal_detail_acara" class="form-label">Tanggal<span
                            class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="tanggal_detail_acara" name="tanggal_detail_acara"
                        placeholder="Masukan link lokasi">
                    <div id="tanggal_detail_acaraFeedback" class="invalid-feedback"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="waktu_mulai" class="form-label">Waktu Mulai<span class="text-danger">*</span></label>
                    <input type="time" class="form-control" id="waktu_mulai" name="waktu_mulai"
                        placeholder="Masukan link lokasi">
                    <div id="waktu_mulaiFeedback" class="invalid-feedback"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="waktu_selesai" class="form-label">Waktu Selesai<span
                            class="text-danger">*</span></label>
                    <input type="time" class="form-control" id="waktu_selesai" name="waktu_selesai"
                        placeholder="Masukan link lokasi">
                    <div id="waktu_selesaiFeedback" class="invalid-feedback"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="deskripsi_detail_acara" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi_detail_acara" name="deskripsi_detail_acara" p rows="3"></textarea>
                    <div id="deskripsi_detail_acaraFeedback" class="invalid-feedback"></div>
                </div>
            </div>
        </div>

         <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary mb-3" onclick="store()">Simpan</button>
        </div>
    </form>
@endif
