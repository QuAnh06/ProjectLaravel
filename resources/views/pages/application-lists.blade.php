@extends('layouts.app')
@section('app-lists')

    <main class="custom-content-area p-4">
        <div class="container-fluid">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0 fw-bold">Danh sách Gói Dịch vụ</h2>
                <button type="button" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Tạo Gói mới</button>
            </div>
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">  
                    <div class="d-flex justify-content-between mb-3">
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Tìm kiếm theo Tên Gói, Mã Gói...">
                        </div>
                    </div>   
                    <div class="table-responsive">
                        <table class="table table-hover align-middle custom-package-table">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Mã Gói</th>
                                    <th scope="col">Tên Gói</th>
                                    <th scope="col">Giá (VNĐ)</th>
                                    <th scope="col">Số Lượng App</th>
                                    <th scope="col">Trạng Thái</th>
                                    <th scope="col">Ngày Tạo</th>
                                    <th scope="col" class="text-end">Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>BASIC-01</td>
                                    <td>Gói Cơ Bản</td>
                                    <td>Miễn phí</td>
                                    <td>1</td>
                                    <td><span class="badge text-bg-success">Hoạt động</span></td>
                                    <td>2024-01-15</td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-outline-info me-1"><i
                                                class="fas fa-eye"></i></button>
                                        <button class="btn btn-sm btn-outline-warning me-1"><i
                                                class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-outline-danger"><i
                                                class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>PRO-02</td>
                                    <td>Gói Chuyên Nghiệp</td>
                                    <td>599.000</td>
                                    <td>10</td>
                                    <td><span class="badge text-bg-success">Hoạt động</span></td>
                                    <td>2024-03-01</td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-outline-info me-1"><i
                                                class="fas fa-eye"></i></button>
                                        <button class="btn btn-sm btn-outline-warning me-1"><i
                                                class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-outline-danger"><i
                                                class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ULTRA-03</td>
                                    <td>Gói Cao Cấp</td>
                                    <td>1.999.000</td>
                                    <td>Không giới hạn</td>
                                    <td><span class="badge text-bg-warning">Sắp ra mắt</span></td>
                                    <td>2024-05-20</td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-outline-info me-1"><i
                                                class="fas fa-eye"></i></button>
                                        <button class="btn btn-sm btn-outline-warning me-1"><i
                                                class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-outline-danger"><i
                                                class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Phân trang">
                        <ul class="pagination justify-content-end mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">Trước</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Sau</a></li>
                        </ul>
                    </nav>
                </div>
            </div>        
        </div>
    </main>

@endsection