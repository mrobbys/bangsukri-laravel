<div class="bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
            class="fas fa-money-bill me-2"></i>Bangsukri</div>
    <div class="list-group list-group-flush my-3">
        <a href="{{ route('dashboard') }}"
            class="list-group-item list-group-item-action bg-transparent second-text @if (Request::is('') || Request::is('/*')) active @endif"><i
                class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
        <a href="{{ route('barang_masuk.index') }}"
            class="list-group-item list-group-item-action bg-transparent second-text fw-bold @if (Request::is('barang_masuk') || Request::is('barang_masuk/*')) active @endif"><i
                class="fas fa-warehouse me-2"></i>Barang Masuk</a>
        <a href="{{ route('ruang.index') }}"
            class="list-group-item list-group-item-action bg-transparent second-text fw-bold @if (Request::is('ruang') || Request::is('ruang/*')) active @endif"><i
                class="fas fa-building me-2"></i>Ruang</a>
        <a href="{{ route('karyawan.index') }}"
            class="list-group-item list-group-item-action bg-transparent second-text fw-bold  @if (Request::is('karyawan') || Request::is('karyawan/*')) active @endif"><i
                class="fas fa-users me-2"></i>Karyawan</a>
        <a href="{{ route('jabatan.index') }}"
            class="list-group-item list-group-item-action bg-transparent second-text fw-bold  @if (Request::is('jabatan') || Request::is('jabatan/*')) active @endif"><i
                class="fas fa-user-tie me-2"></i>Jabatan</a>
        <a href="{{ route('pemasok.index') }}"
            class="list-group-item list-group-item-action bg-transparent second-text fw-bold @if (Request::is('pemasok') || Request::is('pemasok/*')) active @endif"><i
                class="fas fa-truck me-2"></i>Pemasok</a>
        <a href="{{ route('barang.index') }}"
            class="list-group-item list-group-item-action bg-transparent second-text fw-bold @if (Request::is('barang') || Request::is('barang/*')) active @endif"><i
                class="fas fa-box me-2"></i>Barang</a>
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="logout-button list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                    class="fas fa-power-off me-2"></i>Logout</button>
        </form>
    </div>
</div>
