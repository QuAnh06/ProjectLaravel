@extends('layouts.app')

@section('payment-lists')
<div class="container-fluid py-4 px-3">
    <div class="row">
        <div class="col-12 px-4">
            <h2 class="fw-bold mb-4">Danh sách Gói thanh toán</h2>
            
            
                <form method="GET" class="row g-3">
                    <div class="col-md-9 d-flex">
                        <input type="text" name="search" class="form-control" placeholder="Tìm theo tên, slug, tiền tệ..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100 ">
                            <i class="fas fa-search me-1"></i> Tìm kiếm
                        </button>
                        <a href="{{ route('payments.create') }}" class="btn btn-primary w-100">
                            <i class="fas fa-plus me-1"></i> Thêm
                        </a>
                    </div>
                </form>
            

            <div class="card-body border-0 shadow-sm my-3" style="border-radius:5px;">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-muted">#</th>
                                <th class="text-muted">Chỉnh sửa</th>
                                <th class="text-muted">Xóa</th>
                                <th class="text-muted">Ứng dụng</th>
                                <th class="text-muted">Tên gói</th>
                                <th class="text-muted">Giá</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse($payments as $index => $payment)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <a href="{{ route('payments.edit', ['id' => $payment->id]) }}" class="btn btn-warning btn-sm text-white">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td>

                                    <form action="{{ route('payments.destroy', ['id' => $payment->id]) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                        @csrf
                                        @method('DELETE')
                                        
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                </td>
                                <td class="fw-bold">{{ $payment->name }}</td>
                                <td>{{ $payment->package }}</td>
                                
                                <td>
                                    ¥ {{ number_format($payment->price, 0, '.', ',')}}
                                </td>
                                {{-- ->format('d/m/Y H:i')  --}}
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <p>Không có dữ liệu.</p>
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>
                    </table>
                </div>
            
                <div class="p-3 border-top">
                    {{ $payments->links('vendor.pagination.bootstrap-5') }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection