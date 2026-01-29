@extends('layouts.app')

@section('payment-lists')
<div class="container-fluid py-4 px-3">
    <div class="row">
        <div class="col-12 px-4">
            <h2 class="fw-bold mb-4">{{ __('messages.packages') }}</h2>
            
            
                <form method="GET" class="row g-3">
                    <div class="col-md-9 d-flex">
                        <input type="text" name="search" class="form-control" placeholder="{{ __('messages.search_in_payment') }}" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100 ">
                            <i class="fas fa-search me-1"></i> {{ __('messages.search') }}
                        </button>
                        <a href="{{ route('payments.create') }}" class="btn btn-primary w-100">
                            <i class="fas fa-plus me-1"></i> {{ __('messages.add') }}
                        </a>
                    </div>
                </form>
            

            <div class="card-body border-0 shadow-sm my-3" style="border-radius:5px;">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-muted">#</th>
                                <th class="text-muted">{{ __('messages.edit') }}</th>
                                <th class="text-muted">{{ __('messages.delete') }}</th>
                                <th class="text-muted">{{ __('messages.application') }}</th>
                                <th class="text-muted">{{ __('messages.package_name') }}</th>
                                <th class="text-muted">{{ __('messages.price') }}</th>
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
                                <td class="fw-bold">{{ $payment->app->name }}</td>
                                <td>{{ $payment->package }}</td>
                                
                                <td>
                                    ¥ {{ number_format($payment->price, 0, '.', ',')}}
                                </td>
                                {{-- ->format('d/m/Y H:i')  --}}
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <p>{{ __('messages.no_data') }}</p>
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