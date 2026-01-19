@extends('layouts.app')

@section('app-lists')
        <main class="custom-content-area py-5 px-4 ">
            <div class="container-fluid">
                
                <div class="content-header">
                    <h2 class="mb-0 fw-bold">Tạo App mới</h2>
                    <a href="{{ route('apps') }}" class="back"><i class="fas fa-arrow-left me-1"></i> Quay lại</a>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-md-5"> 
                        <form action = "{{ route('apps.store') }}" method = "POST" >
                            <div class="mb-4">
                                
                                @csrf

                                <label for="appName" class="form-label fw-bold"> Tên App <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                    name="name" id="appName" placeholder="Ví dụ: My Application">
                                
                                @error('name')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>

                            <div class="mb-4  field-form">
                                <label for="appCode" class="form-label fw-bold"> App Code <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" @error('code') is-invalid @enderror 
                                    name="code" id="appCode" placeholder="Ví dụ: my-app">

                                @error('code')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                                <div class="form-text text-muted small">Mã định danh duy nhất cho app (chỉ chấp nhận chữ cái, số, dấu gạch ngang và gạch dưới)</div>
                            </div>

                            <div class="d-flex justify-content-end mt-5">
                                <a href="{{ route('apps') }}" class="btn btn-secondary">Hủy</a>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-check me-1"></i> Tạo mới</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </main>

@endsection