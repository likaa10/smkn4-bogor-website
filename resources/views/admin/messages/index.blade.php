@extends('layouts.admin')
@section('title', 'Pesan Masuk')
@section('subtitle', 'Pesan dari pengunjung website')

@section('content')
<div class="card card-stat p-3">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead><tr><th>No</th><th>Nama</th><th>Email</th><th>Pesan</th><th>Tanggal</th><th class="text-center" style="width:70px;">Aksi</th></tr></thead>
            <tbody>
            @forelse($messages as $i => $m)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $m->name }}</td>
                    <td>{{ $m->email }}</td>
                    <td>{{ Str::limit($m->message, 60) }}</td>
                    <td>{{ $m->created_at->format('d M Y H:i') }}</td>
                    <td class="text-nowrap text-center">
                        <form action="{{ route('admin.messages.destroy', $m) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pesan ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted">Belum ada pesan masuk.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection