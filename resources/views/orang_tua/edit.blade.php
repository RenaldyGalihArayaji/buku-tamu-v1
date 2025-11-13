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
    <form id="form-orang-tua" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="jenis_orang_tua" class="form-label">Pihak Mempelai<span
                            class="text-danger">*</span></label>
                    <select name="jenis_orang_tua" id="jenis_orang_tua" class="form-control">
                        <option value="MEMPELAI_PRIA"
                            {{ $orangTua->jenis_orang_tua == 'MEMPELAI_PRIA' ? 'selected' : '' }}>
                            Mempelai Pria</option>
                        <option value="MEMPELAI_WANITA"
                            {{ $orangTua->jenis_orang_tua == 'MEMPELAI_WANITA' ? 'selected' : '' }}>Mempelai Wanita
                        </option>
                    </select>
                    <div id="jenis_orang_tuaFeedback" class="invalid-feedback"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="jenis" class="form-label">Status Keluarga<span class="text-danger">*</span></label>
                    <select name="jenis" id="jenis" class="form-control">
                        <option value="AYAH" {{ $orangTua->jenis == 'AYAH' ? 'selected' : '' }}>Ayah</option>
                        <option value="IBU" {{ $orangTua->jenis == 'IBU' ? 'selected' : '' }}>Ibu</option>
                    </select>
                    <div id="jenisFeedback" class="invalid-feedback"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                        placeholder="Masukkan nama lengkap" value="{{ old('nama_lengkap', $orangTua->nama_lengkap) }}">
                    <div id="nama_lengkapFeedback" class="invalid-feedback"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nama_panggilan" class="form-label">Nama Panggilan</label>
                    <input type="text" class="form-control" id="nama_panggilan" name="nama_panggilan"
                        placeholder="Masukkan nama panggilan"
                        value="{{ old('nama_panggilan', $orangTua->nama_panggilan) }}">
                    <div id="nama_panggilanFeedback" class="invalid-feedback"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                        placeholder="Masukkan pekerjaan" value="{{ old('pekerjaan', $orangTua->pekerjaan) }}">
                    <div id="pekerjaanFeedback" class="invalid-feedback"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="masih_hidup" class="form-label">Status Keberadaan<span
                            class="text-danger">*</span></label>
                    <select name="masih_hidup" id="masih_hidup" class="form-control">
                        <option value="1" {{ $orangTua->masih_hidup == 1 ? 'selected' : '' }}>Masih Hidup</option>
                        <option value="0" {{ $orangTua->masih_hidup == 0 ? 'selected' : '' }}>Meninggal Dunia
                        </option>
                    </select>
                    <div id="masih_hidupFeedback" class="invalid-feedback"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat">{{ old('alamat', $orangTua->alamat) }}</textarea>
                    <div id="alamatFeedback" class="invalid-feedback"></div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary mb-3"
                onclick="update('{{ $orangTua->id }}')">Simpan</button>
        </div>
    </form>
@endif
