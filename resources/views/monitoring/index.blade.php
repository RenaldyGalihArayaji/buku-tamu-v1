<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link rel="stylesheet" href="{{ asset('template-admin/vendor/bootstrap/css/bootstrap.min.css') }}">
    <title>Display</title>
</head>
<body style="background: radial-gradient(circle,rgba(238, 174, 202, 1) 0%, rgba(148, 187, 233, 1) 100%);">
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="border shadow rounded" style="width: 100%; height: 70vh; background: white">
            <div class="p-5">
                <h1 class="text-center"><strong>SELAMAT DATANG</strong></h1>
                <h3 class="text-center">Di Aplikasi Monitoring Persiapan Pernikahan</h3>
                <h3 class="text-center">SMA Budi Luhur Yogyakarta</h3>
                <div class="d-flex justify-content-center align-items-center" style="height: 30vh;">
                    <h1 style="font-size: 80px;"><strong>{{ ucwords($tamu->nama_lengkap) }}</strong></h1>
                </div>
            </div>
        </div>
    </div>
</body>
</html>