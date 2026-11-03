@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    {{ $method === 'create' ? 'Tambah Kategori' : 'Edit Kategori' }}
                </div>

                <div class="card-body">
                    <form method="POST"
                          action="{{ $method === 'create'
                              ? route('categories.store')
                              : route('categories.update', $category) }}">

                        @csrf

                        @if($method === 'edit')
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label class="form-label">Nama Kategori</label>

                            <input type="text"
                                   name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $category->name) }}"
                                   required>

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kode Kategori</label>

                            <input type="text"
                                   name="code"
                                   class="form-control @error('code') is-invalid @enderror"
                                   value="{{ old('code', $category->code) }}"
                                   required>

                            @error('code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button class="btn btn-primary">
                            Simpan
                        </button>

                        <a href="{{ route('categories.index') }}"
                           class="btn btn-secondary">
                            Kembali
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection