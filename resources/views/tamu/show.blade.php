<div class="row mb-3">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="qr_code" class="form-label">Kode</label>
            <input type="text" class="form-control" id="qr_code" name="qr_code" placeholder="Masukkan nama lengkap"
                value="{{ $tamu->qr_code }}" disabled>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="kategori_tamu" class="form-label">Kateori Tamu<span class="text-danger">*</span></label>
            <select name="kategori_tamu" id="kategori_tamu" class="form-control" disabled>
                <option value="KELUARGA_PRIA" {{ $tamu->kategori_tamu == 'KELUARGA_PRIA' ? 'selected' : '' }}>Keluarga
                    Pria</option>
                <option value="KELUARGA_WANITA" {{ $tamu->kategori_tamu == 'KELUARGA_WANITA' ? 'selected' : '' }}>
                    Keluarga Wanita</option>
                <option value="TEMAN_PRIA" {{ $tamu->kategori_tamu == 'TEMAN_PRIA' ? 'selected' : '' }}>Teman Pria
                </option>
                <option value="TEMAN_WANITA" {{ $tamu->kategori_tamu == 'TEMAN_WANITA' ? 'selected' : '' }}>Teman Wanita
                </option>
                <option value="REKAN_KERJA_PRIA" {{ $tamu->kategori_tamu == 'REKAN_KERJA_PRIA' ? 'selected' : '' }}>
                    Rekan Kerja Pria</option>
                <option value="REKAN_KERJA_WANITA" {{ $tamu->kategori_tamu == 'REKAN_KERJA_WANITA' ? 'selected' : '' }}>
                    Rekan Kerja Wanita</option>
                <option value="TETANGGA_PRIA" {{ $tamu->kategori_tamu == 'TETANGGA_PRIA' ? 'selected' : '' }}>Tetangga
                    Pria</option>
                <option value="TETANGGA_WANITA" {{ $tamu->kategori_tamu == 'TETANGGA_WANITA' ? 'selected' : '' }}>
                    Tetangga Wanita</option>
                <option value="TETANGGA_WANITA" {{ $tamu->kategori_tamu == 'LAINNYA' ? 'selected' : '' }}>Lainnya
                </option>
            </select>
            <div id="kategori_tamuFeedback" class="invalid-feedback"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                placeholder="Masukkan nama lengkap" value="{{ $tamu->nama_lengkap }}" disabled>
            <div id="nama_lengkapFeedback" class="invalid-feedback"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="nama_panggilan" class="form-label">Nama Panggilan </label>
            <input type="text" class="form-control" id="nama_panggilan" name="nama_panggilan"
                placeholder="Masukkan nama panggilan" value="{{ $tamu->nama_panggilan }}" disabled>
            <div id="nama_panggilanFeedback" class="invalid-feedback"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="no_hp" class="form-label">Nomor HP </label>
            <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="08xxxxxxxxx"
                value="{{ $tamu->no_hp }}" disabled>
            <div id="no_hpFeedback" class="invalid-feedback"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="email" class="form-label">Email </label>
            <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com"
                value="{{ $tamu->email }}" disabled>
            <div id="emailFeedback" class="invalid-feedback"></div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan Alamat" disabled>{{ $tamu->alamat }}</textarea>
            <div id="alamatFeedback" class="invalid-feedback"></div>
        </div>
    </div>
</div>
