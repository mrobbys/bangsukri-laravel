{{-- Bootstrap --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
</script>

{{-- sweetalert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function() {
        el.classList.toggle("toggled");
    };

    function confirmation(href) {
        if (confirm("Yakin Hapus?")) {
            document.getElementById('deleteForm').action = href;
            document.getElementById('deleteForm').submit();
        }
    }

    // sweetlert2

    // modal untuk success
    @if (isset($alert))
    Swal.fire({
        title: '{{ e($alert['title']) }}',
        text: '{{ e($alert['text']) }}',
        icon: '{{ e($alert['icon']) }}',
        showConfirmButton: true,
        timer: 5000,
        showCloseButton: true,
        timerProgressBar: true,
    })
@endif

    // modal untuk error
    // @if (session()->has('error'))
    //     Swal.fire({
    //         icon: 'error',
    //         title: 'Error!',
    //         text: '{{ session('error') }}',
    //         confirmButtonText: 'Cool',
    //         showConfirmButton: false,
    //         timer: 5000,
    //         showCloseButton: true,
    //         timerProgressBar: true,
    //     })
    // @endif

    // Script untuk konfirmasi penghapusan
    const deleteButtons = document.querySelectorAll('.delete-button');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            // Mencegah form dikirim secara langsung
            event.preventDefault();

            // Mengambil form terdekat dari tombol yang diklik
            const form = this.closest('form');

            Swal.fire({
                title: 'Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
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

    // script untuk konfirmasi logout
    const logoutButtons = document.querySelectorAll('.logout-button');

    logoutButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            // Mencegah form dikirim secara langsung
            event.preventDefault();

            // Mengambil form terdekat dari tombol yang diklik
            const form = this.closest('form');

            Swal.fire({
                title: 'Anda yakin ingin logout?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, logout!',
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
