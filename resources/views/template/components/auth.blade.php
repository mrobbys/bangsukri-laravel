<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>{{ $title ?? 'bangsukri' }}</title>
    <style>
        body {
            background-color: #f3f3f3;
        }
    </style>
</head>

<body>
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        @yield('content')
    </div>

    {{-- sweetalert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Notifikasi Sukses
        @if (session()->has('alert'))
            Swal.fire({
                title: '{{ e(session('alert.title')) }}',
                text: '{{ e(session('alert.text')) }}',
                icon: '{{ e(session('alert.icon')) }}',
                showConfirmButton: false,
                timer: 5000,
                showCloseButton: true,
                timerProgressBar: true,
            });
        @endif

        // script untuk konfirmasi changePersonal
        const changePersonalButtons = document.querySelectorAll('.changePersonal-button');

        changePersonalButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                // Mencegah form dikirim secara langsung
                event.preventDefault();

                // Mengambil form terdekat dari tombol yang diklik
                const form = this.closest('form');

                Swal.fire({
                    title: 'Anda yakin ingin mengubah data?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yakin!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    // Jika pengguna menekan tombol "Ya, hapus!"
                    if (result.isConfirmed) {
                        // Kirim form secara manual
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>

</html>
