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

            <form action="{{ route('user-lists') }}" method="GET">    
                <div class="d-flex justify-content-between mb-3 gap-2">
                    <div class="input-group w-50">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" class="form-control border-start-0 ps-0" name="search"
                            value="{{ request('search') }}" placeholder="Tìm tên, email...">
                    </div>
                    <div class="d-flex gap-2">
                        
                        <select name="status" class="form-select form-select-sm" style="width: 160px;" >
                            <option value="" disabled selected hidden>-- Trạng thái --</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Online</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Offline</option>
                        </select>
                        
                        @if(request()->has('search') || request()->has('status'))
                            <a href="{{ route('user-lists') }}" class="btn btn-outline-danger">Xóa lọc</a>
                        @endif

                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-filter me-1"></i> Lọc
                    </button>
                </div>
            </form>

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

                                {{-- @if(Auth::check() && $user->id === Auth::user()->id)
                                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">Online</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">Offline</span>
                                @endif --}}
                            
                                @if ($user->status == '1')
                                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">Online</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">Offline</span>
                                @endif
                            </td>
                            <td class="text-muted">{{ $user->created_at->format('d/m/Y') }}</td>
                            <td class="text-end pe-4">
                                <div class="btn-group">
                                    <a href="{{ route('user-lists.edit', ['id' => $user->id]) }}" class="btn btn-sm btn-light border" title="Sửa">
                                        <i class="fas fa-edit text-primary"></i>
                                    </a>
                                    
                                    <form id="delete-form" method="POST" style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    
                                    <button type="button" class="btn btn-sm btn-light border text-danger" onclick="confirmDelete({{ $user->id }})" title="Xóa">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <p>Không có kết quả người dùng được tìm kiếm.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-3 border-top">
                {{ $users->links('vendor.pagination.bootstrap-5') }}
            </div>
        
        </div>
    </div>
</div>  


@endsection

    <template id="create-success">
        <swal-title>
            Thành công!
        </swal-title>
        <swal-icon type="success" color="#28a745"></swal-icon>
        <swal-button type="confirm" color="#0d6efd">
            Đồng ý
        </swal-button>
        <swal-param name="timer" value="3000" /> <swal-param name="allowEscapeKey" value="true" />
        <swal-param name="customClass" value='{ "popup": "border-radius-15" }' />
    </template> 

    @push('scripts')
        <script>
        @if(session('message'))
        Swal.fire({
            template: "#create-success",
            text: "{{ session('message') }}"
        });
        @endif

        function confirmDelete(userId){
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-danger",
                cancelButton: "btn btn-secondary"
            },
            buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete",
                cancelButtonText: "No, cancel",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = document.getElementById('delete-form');

                    // var url = "{{ route('user-lists.destroy', 'id') }}";
                    // form.action = url.replace('id', userId);

                    form.action = "/user-lists/" + userId;

                    form.submit();
                } 
            });
        }

        </script>    
    @endpush
    