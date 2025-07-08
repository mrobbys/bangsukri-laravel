
<form action="{{ route('pemasok.destroy', $pemasok) }}" method="POST">
    @csrf
    @method('DELETE')
    <a href="{{ route('pemasok.edit', $pemasok) }}" class="btn btn-primary btn-sm">
        <i class="fa fa-edit"></i>
    </a>

    <button type="submit" class="btn btn-danger btn-sm delete-button"><i class="fa fa-trash"></i></button>
</form>
