<form action="{{ route('barang_masuk.destroy', $barang_masuk) }}" method="POST">
    @csrf
    @method('DELETE')
    <a href="{{ route('barang_masuk.edit', $barang_masuk) }}" class="btn btn-primary btn-sm">
        <i class="fa fa-edit"></i>
    </a>

    <button type="submit" class="btn btn-danger btn-sm delete-button"><i class="fa fa-trash"></i></button>
</form>
