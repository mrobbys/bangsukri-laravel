<div>
    <h1>Halo dari halaman admin index</h1>

    <div>Anda Login dengan akun: <strong>{{ Auth::user()->email }}</strong> role anda:
        <strong>{{ Auth::user()->role }}</strong>
    </div>

    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit"
            class="logout-button list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                class="fas fa-power-off me-2"></i>Logout</button>
    </form>
</div>
