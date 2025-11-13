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
    <form id="form-tamu" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="kategori_tamu" class="form-label">Kateori Tamu<span class="text-danger">*</span></label>
                    <select name="kategori_tamu" id="kategori_tamu" class="form-control" required>
                        <option value="KELUARGA_PRIA" {{ $tamu->kategori_tamu == 'KELUARGA_PRIA' ? 'selected' : '' }}>Keluarga Pria</option>
                        <option value="KELUARGA_WANITA" {{ $tamu->kategori_tamu == 'KELUARGA_WANITA' ? 'selected' : '' }}>Keluarga Wanita</option>
                        <option value="TEMAN_PRIA" {{ $tamu->kategori_tamu == 'TEMAN_PRIA' ? 'selected' : '' }}>Teman Pria</option>
                        <option value="TEMAN_WANITA" {{ $tamu->kategori_tamu == 'TEMAN_WANITA' ? 'selected' : '' }}>Teman Wanita</option>
                        <option value="REKAN_KERJA_PRIA" {{ $tamu->kategori_tamu == 'REKAN_KERJA_PRIA' ? 'selected' : '' }}>Rekan Kerja Pria</option>
                        <option value="REKAN_KERJA_WANITA" {{ $tamu->kategori_tamu == 'REKAN_KERJA_WANITA' ? 'selected' : '' }}>Rekan Kerja Wanita</option>
                        <option value="TETANGGA_PRIA" {{ $tamu->kategori_tamu == 'TETANGGA_PRIA' ? 'selected' : '' }}>Tetangga Pria</option>
                        <option value="TETANGGA_WANITA" {{ $tamu->kategori_tamu == 'TETANGGA_WANITA' ? 'selected' : '' }}>Tetangga Wanita</option>
                        <option value="TETANGGA_WANITA" {{ $tamu->kategori_tamu == 'LAINNYA' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    <div id="kategori_tamuFeedback" class="invalid-feedback"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                        placeholder="Masukkan nama lengkap" value="{{ $tamu->nama_lengkap }}">
                    <div id="nama_lengkapFeedback" class="invalid-feedback"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="nama_panggilan" class="form-label">Nama Panggilan </label>
                    <input type="text" class="form-control" id="nama_panggilan" name="nama_panggilan"
                        placeholder="Masukkan nama panggilan" value="{{ $tamu->nama_panggilan }}">
                    <div id="nama_panggilanFeedback" class="invalid-feedback"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="no_hp" class="form-label">Nomor HP </label>
                    <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="08xxxxxxxxx" value="{{ $tamu->no_hp }}">
                    <div id="no_hpFeedback" class="invalid-feedback"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="email" class="form-label">Email </label>
                    <input type="email" class="form-control" id="email" name="email"
                        placeholder="example@gmail.com" value="{{ $tamu->email }}">
                    <div id="emailFeedback" class="invalid-feedback"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan Alamat">{{ $tamu->alamat }}</textarea>
                    <div id="alamatFeedback" class="invalid-feedback"></div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary mb-3" onclick="update('{{ $tamu->id }}')">Simpan</button>
        </div>
    </form>
@endif
