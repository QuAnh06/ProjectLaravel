@extends('layouts.app')

@section('main')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 px-4">
        <h2 class="h4 fw-bold mb-0">{{ __('messages.subscriptions') }}</h2>
    </div>

    <div class="card shadow-sm border-0 mx-4">
        <div class="card-body p-4">

            <form action="{{ route('payment-subscriptions') }}" method="GET" class="mb-4">
                <div class="row g-2">
                    <div class="col">
                        <input type="text" class="form-control" name="search" 
                               value="{{ request('search') }}" 
                               placeholder="{{ __('messages.search_in_service') }}">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-search me-1"></i> {{ __('messages.search') }}
                        </button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle border-top">
                    <thead class="table-light">
                        <tr>
                            <th class="text-muted fw-normal">#</th>
                            <th class="text-muted fw-normal text-center">{{ __('messages.actions') }}</th>
                            <th class="text-muted fw-normal">{{ __('messages.customers') }}</th>
                            <th class="text-muted fw-normal">{{ __('messages.registration_date') }}</th>
                            <th class="text-muted fw-normal">{{ __('messages.application') }}</th>
                            <th class="text-muted fw-normal">{{ __('messages.service_package') }}</th>
                            <th class="text-muted fw-normal">{{ __('messages.subscription_price') }}</th>
                            <th class="text-muted fw-normal">{{ __('messages.status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subscriptions as $index => $sub)
                        <tr>
                            <td class="text-muted">{{ $index + 1 }}</td>

                            <td class="text-center">
                                <a href="{{--route('payment-subscriptions.edit', $sub->id) --}}" class="btn btn-warning btn-sm text-white p-2" style="border-radius: 4px;">
                                    <i class="fas fa-edit fa-fw"></i>
                                </a>
                            </td>

                            <td class="fw-medium">{{ $sub->user->name ?? 'N/A' }}</td>

                            <td class="text-muted">{{ $sub->created_at->format('Y-m-d') }}</td>
                            
                            <td>{{ $sub->app->name ?? 'N/A' }}</td>
                            
                            <td>{{ $sub->plan->package ?? 'N/A' }}</td>
                            
                            <td class="fw">
                                {{ ($sub->plan->currency == 'EN') ? '$' : '¥' }} {{ number_format($sub->plan->price ?? 0) }}

                            </td>
                            
                            <td>
                                @if($sub->status == 'active')
                                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">{{ __('messages.active') }}</span>
                                @else
                                    <span class="badge bg-secondary-subtle text-success px-3 py-2 rounded-pill">{{ __('messages.no_active') }}</span>
                                @endif
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">{{ __('messages.no_data') }}</td>
                        </tr>

                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
               
                <div>
                    {{ $subscriptions->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection