@extends('layouts.app')

@section('user-lists')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h2 fw-bold mb-0">Danh sách Người dùng</h2>
        <a href="{{ route('user-lists.create') }}" class="btn btn-primary shadow-sm d-flex align-items-center gap-2 fs-0.25">
            <i class="fas fa-plus"></i> Thêm mới
        </a>
    </div>

    <div class="card shadow-sm border-0 py-0 mx-4" style="height: auto;">
        <div class="card-body p-4"> 
            <div class="d-flex justify-content-between mb-3">
                <div class="input-group w-25">
                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" class="form-control border-start-0 ps-0" placeholder="Tìm tên, email...">
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-secondary btn-sm"><i class="fas fa-filter me-1"></i> Bộ lọc</button>
                    <button class="btn btn-outline-secondary btn-sm"><i class="fas fa-download me-1"></i> Xuất file</button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Họ và Tên</th>
                            <th>Email</th>
                            <th>Trạng thái</th>
                            <th>Ngày tham gia</th>
                            <th class="text-end pe-4">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td class="ps-4 text-muted">{{ $user->id }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-sm bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 30px; height: 30px;">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <span class="fw-semibold">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->is_active)
                                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">Hoạt động</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">Khóa</span>
                                @endif
                            </td>
                            <td class="text-muted">{{ $user->created_at->format('d/m/Y') }}</td>
                            <td class="text-end pe-4">
                                <div class="btn-group">
                                    <a href="" class="btn btn-sm btn-light border" title="Sửa">
                                        <i class="fas fa-edit text-primary"></i>
                                    </a>
                                    <button class="btn btn-sm btn-light border text-danger" title="Xóa">  {{--onclick="confirmDelete({{ $user->id }})">--}}
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <img src="" width="100" class="mb-3 opacity-50">
                                <p>Chưa có người dùng nào trong danh sách.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- <div class="p-3 border-top">
                {{ $users->links() }}
            </div> --}}
        </div>
    </div>
</div>
@endsection