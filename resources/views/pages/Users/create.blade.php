@extends('layouts.app')

@section('user-lists.create')
<div class="container-fluid py-5" style="background-color: #ffffff; min-height: 100vh; color: #000000;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <div class="mb-4 border-bottom pb-3">
                <h2 class="fw-bold text-dark">Thêm Người Dùng Mới</h2>
                <p class="text-muted">Nhập thông tin chi tiết để tạo tài khoản mới trong hệ thống.</p>
            </div>

            <div class="card border shadow-sm" style="background-color: #ffffff; border-radius: 12px;">
                <div class="card-body p-4">
                    <form action="{{ route('user-lists.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold text-dark">Họ và tên</label>
                                <input type="text" name="name" 
                                       class="form-control custom-input-white @error('name') is-invalid @enderror" 
                                       placeholder="Ví dụ: Nguyễn Văn A" value="{{ old('name') }}">
                                @error('name') 
                                    <div class="invalid-feedback"> {{ $message }} </div> 
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold text-dark">Địa chỉ Email</label>
                                <input type="email" name="email" 
                                       class="form-control custom-input-white @error('email') is-invalid @enderror" 
                                       placeholder="nva@example.com" value="{{ old('email') }}">
                                @error('email') 
                                    <div class="invalid-feedback">{{ $message }}</div> 
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold text-dark">Mật khẩu</label>
                                <input type="password" name="password" 
                                       class="form-control custom-input-white @error('password') is-invalid @enderror" 
                                       placeholder="Tối thiểu 8 ký tự">
                                @error('password') 
                                    <div class="invalid-feedback">{{ $message }}</div> 
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold text-dark">Vai trò</label>
                                <select name="role" class="form-select custom-input-white">
                                    <option value="user" selected>Người dùng thường</option>
                                    <option value="admin">Quản trị viên</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <a href="{{ route('user-lists') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 8px;">
                                Hủy bỏ
                            </a>
                            <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 8px; background-color: #0d6efd;">
                                <i class="fas fa-save me-2"></i> Lưu người dùng
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    
    .custom-input-white {
        background-color: #ffffff ;
        border: 1px solid #dee2e6 ;
        border-radius: 8px ;
        padding: 12px 15px ;
        color: #000000 ;
        transition: all 0.2s ease-in-out;
    }

    .custom-input-white:focus {
        border-color: #0d6efd ;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15) ;
        outline: none;
    }

    .custom-input-white::placeholder {
        color: #adb5bd;
    }

    .form-label {
        font-size: 0.95rem;
    }
</style>
@endsection