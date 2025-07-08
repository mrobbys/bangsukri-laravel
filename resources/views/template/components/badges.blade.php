    <div class="row g-3 my-2">

        <div class="my-3">
            <div>Anda Login dengan akun: <strong>{{ Auth::user()->email }}</strong> role anda: <strong>{{ Auth::user()->role }}</strong></div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div class="text-start w-100">
                    <h3 class="fs-2">{{ $allBarangMasuk->count() }}</h3>
                    <p class="fs-5">Barang Masuk</p>
                </div>
                <i class="fas fa-warehouse fs-1 primary-text border rounded-full secondary-bg p-3"></i>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div class="text-start w-100">
                    <h3 class="fs-2">{{ $allRuang->count() }}</h3>
                    <p class="fs-5">Ruang</p>
                </div>
                <i class="fas fa-building fs-1 primary-text border rounded-full secondary-bg p-3"></i>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div class="text-start w-100">
                    <h3 class="fs-2">{{ $allKaryawan->count() }}</h3>
                    <p class="fs-5">Karyawan</p>
                </div>
                <i class="fas fa-users fs-1 primary-text border rounded-full secondary-bg p-3"></i>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div class="text-start w-100">
                    <h3 class="fs-2">{{ $allPemasok->count() }}</h3>
                    <p class="fs-5">Pemasok</p>
                </div>
                <i class="fas fa-truck fs-1 primary-text border rounded-full secondary-bg p-3"></i>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div class="text-start w-100">
                    <h3 class="fs-2">{{ $allBarang->count() }}</h3>
                    <p class="fs-5">Barang</p>
                </div>
                <i class="fas fa-box fs-1 primary-text border rounded-full secondary-bg p-3"></i>
            </div>
        </div>
    </div>
