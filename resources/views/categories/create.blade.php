@extends('layouts.adminlte')

@section('title', 'Tambah Kategori')
@section('page_title', 'Tambah Kategori')

@section('content')
    <div class="card">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="card-body">
                @include('categories.partials.form')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
