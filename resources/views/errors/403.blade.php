<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Akses Ditolak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .error-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .error-code {
            font-size: 8rem;
            font-weight: bold;
            color: #dc3545;
        }
        .error-message {
            font-size: 1.5rem;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container text-center error-container">
        <div>
            <div class="error-code">403</div>
            <p class="error-message mb-4">AKSES DITOLAK</p>
            <p class="lead text-muted mb-5">
                Maaf, Anda tidak memiliki izin yang cukup untuk mengakses halaman ini.
            </p>
            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg px-4">
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</body>
</html>