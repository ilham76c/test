@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Daftar Kategori Items</h4>

        <a href="{{ route('categories.create') }}"
           class="btn btn-primary">
            + Tambah Kategori
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            <form method="GET" action="{{ route('categories.index') }}"
                  class="row mb-3">

                <div class="col-md-5">
                    <input type="text"
                           name="name"
                           class="form-control"
                           placeholder="Cari nama kategori"
                           value="{{ request('name') }}">
                </div>

                <div class="col-md-5">
                    <input type="text"
                           name="code"
                           class="form-control"
                           placeholder="Cari kode kategori"
                           value="{{ request('code') }}">
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary w-100">
                        Cari
                    </button>
                </div>
            </form>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Kode</th>
                        <th>Jumlah Item</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>
                                {{ $categories->firstItem() + $loop->index }}
                            </td>

                            <td>{{ $category->name }}</td>
                            <td>{{ $category->code }}</td>
                            <td>{{ $category->items_count }}</td>

                            <td>
                                <a href="{{ route('categories.show', $category) }}"
                                   class="btn btn-info btn-sm">
                                    Detail
                                </a>

                                <a href="{{ route('categories.edit', $category) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('categories.destroy', $category) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Hapus kategori?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                Tidak ada kategori.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $categories->links() }}

        </div>
    </div>
</div>
@endsection