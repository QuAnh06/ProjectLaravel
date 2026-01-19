@extends('layouts.app')

@section('app-lists')
<div class="container p-5">
    <div class="card shadow-sm border-0 p-4">
        <h3>Sửa App</h3>
        <form action="{{ route('apps.update', ['id' => $app->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Tên App</label>
                <input type="text" name="name" class="form-control 
                    @error('name') is-invalid @enderror" value="{{ $app->name }}" required>
                
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>
            <div class="mb-3">
                <label>App Code</label>
                <input type="text" name="code" class="form-control 
                    @error('code') is-invalid @enderror" value="{{ $app->code }}" required>
                
                @error('code')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>
            <button type="submit" class="btn btn-primary">Lưu lại</button>
            <a href="{{ route('apps') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</div>
@endsection