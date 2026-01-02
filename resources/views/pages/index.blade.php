@extends('layouts.app')

@section('main')
        <main class="custom-content-area p-4">
            <div class="container-fluid">
                
                <div class="content-header">
                    <h2 class="mb-0 fw-bold">Tạo App mới</h2>
                    <a href="#" class="back"><i class="fas fa-arrow-left me-1"></i> Quay lại</a>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-md-5"> 
                        <!-- responsive tren man hinh rong hon md - 768px trở lên -->
                        <form>
                            <div class="mb-4">
                                <label for="appName" class="form-label fw-bold">Tên App <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" id="appName" placeholder="Ví dụ: My Application">
                                <div class="invalid-feedback">
                                    <!-- Vui lòng nhập Tên App. -->
                                </div>
                            </div>

                            <div class="mb-4  field-form">
                                <label for="appCode" class="form-label fw-bold">App Code <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" id="appCode" placeholder="Ví dụ: my-app">
                                <div class="invalid-feedback">
                                    <!-- Vui lòng nhập App Code hợp lệ. -->
                                </div>
                                <div class="form-text text-muted small">Mã định danh duy nhất cho app (chỉ chấp nhận chữ cái, số, dấu gạch ngang và gạch dưới)</div>
                            </div>

                            <div class="d-flex justify-content-end mt-5">
                                <button type="button" class="btn btn-secondary"><i class="fas fa-times me-1"></i> Hủy</button>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-check me-1"></i> Tạo mới</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </main>
@endsection