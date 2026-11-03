@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-3">
        <a href="{{ route('categories.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>

        <a href="{{ route('categories.edit', $category) }}"
           class="btn btn-warning">
            Edit Kategori
        </a>

        <a
            href="{{ route('categories.pdf', $category->id) }}"
            class="btn btn-danger"
            target="_blank"
        >
            Cetak PDF
        </a>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            Detail Kategori
        </div>

        <div class="card-body">
            <p>
                <strong>Nama Kategori:</strong>
                {{ $category->name }}
            </p>

            <p>
                <strong>Kode Kategori:</strong>
                {{ $category->code }}
            </p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Daftar Master Items
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Item</th>
                        <th>Nama Item</th>
                        <th>Supplier</th>
                        <th>Harga</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($category->items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->supplier }}</td>
                            <td>{{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                Belum ada item pada kategori ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection