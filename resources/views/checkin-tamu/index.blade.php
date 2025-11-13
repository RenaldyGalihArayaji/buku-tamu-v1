@extends('layouts.app')

@section('content')
    <div class="title">
        <h1 class="h3 mb-0 text-gray-800">Master | <span class="text-secondary fs-5">Data Check In Tamu</span></h1>
    </div>

    <div class="content-wrapper">
        <div class="row same-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tabel Check In Tamu</h4>
                    </div>
                    <div class="card-body">
                        <button class="btn mb-3 btn-outline-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#scannerModal"><i class="bi bi-upc-scan"></i> Scann QR Code</button>
                        <a href="{{ route('display') }}" class="btn mb-3 btn-outline-danger btn-sm" target="_blank">
                            <i class="bi bi-display"></i> Display
                        </a>
                        <table id="example2" class="table dt-responsive display">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kategori Tamu</th>
                                    <th>Nama Lengkap</th>
                                    <th>Alamat</th>
                                    <th>Waktu Hadir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tamu as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($item->kategori_tamu == 'KELUARGA_PRIA')
                                                Keluarga Pria
                                            @endif
                                            @if ($item->kategori_tamu == 'KELUARGA_WANITA')
                                                Keluarga Wanita
                                            @endif
                                            @if ($item->kategori_tamu == 'TEMAN_PRIA')
                                                Teman Pria
                                            @endif
                                            @if ($item->kategori_tamu == 'TEMAN_WANITA')
                                                Teman Wanita
                                            @endif
                                            @if ($item->kategori_tamu == 'REKAN_KERJA_PRIA')
                                                Rekan Kerja Pria
                                            @endif
                                            @if ($item->kategori_tamu == 'REKAN_KERJA_WANITA')
                                                Rekan Kerja Wanita
                                            @endif
                                            @if ($item->kategori_tamu == 'TETANGGA_PRIA')
                                                Tetangga Pria
                                            @endif
                                            @if ($item->kategori_tamu == 'TETANGGA_WANITA')
                                                Tetangga Wanita
                                            @endif
                                            @if ($item->kategori_tamu == 'LAINNYA')
                                                Lainnya
                                            @endif
                                        </td>
                                        <td>{{ ucwords($item->nama_lengkap) }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->waktu_hadir)->translatedFormat('d F Y H:i:s') }}
                                        </td>
                                        <td>
                                            <button class="btn btn-outline-warning btn-sm my-1"
                                                onclick="show('{{ $item->id }}')">
                                                <i class="bi bi-printer"></i> Cetak
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="scannerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="scannerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="scannerModalLabel">Scanner</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div id="reader" width="600px"></div>
                            <input type="hidden" name="result" id="result">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script src="{{ asset('template-admin/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template-admin/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('template-admin/vendor/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('template-admin/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}">
    </script>
    <script src="{{ asset('template-admin//assets/js/pages/datatables.min.js') }}"></script>
    {{-- scanner --}}
    <script>
        DataTable.init()
    </script>
    @speechNotification

    {{-- Scanner --}}
    <script>
        // Deklarasikan variabel di luar scope agar bisa diakses di mana saja
        let html5QrcodeScanner;

        // Fungsi untuk memulai pemindai
        function startScanner() {
            // Cek jika pemindai sudah ada, jangan buat lagi
            if (!html5QrcodeScanner) {
                html5QrcodeScanner = new Html5QrcodeScanner(
                    "reader", {
                        fps: 10,
                        qrbox: {
                            width: 300,
                            height: 300
                        }
                    },
                    /* verbose= */
                    false
                );
            }
            // Mulai pemindaian
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        }

        // Fungsi yang akan dijalankan ketika QR code berhasil dipindai
        function onScanSuccess(decodedText, decodedResult) {
            // Hentikan pemindai setelah berhasil scan untuk mencegah scan ganda
            html5QrcodeScanner.clear();

            // Kirim data ke backend menggunakan AJAX
            $.ajax({
                url: "{{ route('scanner') }}",
                type: "POST",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    qr_code: decodedText,
                    acara_id: '{{ $acara->id }}'
                },
                success: function(response) {
                    $("#scannerModal").modal('hide');

                    if (response.status === 'success') {
                        Swal.fire('Sukses', response.message, 'success');
                        playNotification(response.message);

                        setTimeout(() => {
                            location.reload();
                        }, 2500); // delay 2 detik
                    } else if (response.status === 'info') {
                        Swal.fire('Info', response.message, 'info');
                        playNotification(response.message);

                        setTimeout(() => {
                            location.reload();
                        }, 2500); // delay 2 detik
                    }
                },
                error: function(xhr) {
                    $("#scannerModal").modal('hide');
                    let message = "Terjadi kesalahan.";
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }
                    Swal.fire('Gagal', message, 'error');
                    playNotification(message);

                    setTimeout(() => {
                        location.reload();
                    }, 2500); // delay 2 detik
                }
            });
        }

        // Fungsi yang akan dijalankan ketika pemindaian gagal
        function onScanFailure(error) {
            // Jangan lakukan apa-apa, biarkan pemindai terus berjalan
        }

        // Tangani event saat modal terbuka
        $('#scannerModal').on('shown.bs.modal', function() {
            startScanner();
        });

        // Tangani event saat modal tertutup
        $('#scannerModal').on('hidden.bs.modal', function() {
            // Hentikan pemindai saat modal ditutup
            if (html5QrcodeScanner) {
                html5QrcodeScanner.clear().catch(err => {
                    console.error("Gagal menghentikan pemindai", err);
                });
                // Reset instance pemindai agar bisa diinisialisasi ulang
                html5QrcodeScanner = null;
            }
        });
    </script>
@endpush
