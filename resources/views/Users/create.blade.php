@extends('layouts.app')

@section('main')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 px-4">
        <h2 class="h4 fw-bold mb-0">{{ __('messages.create_user') }}</h2>
        <a href="{{ route('user-lists') }}" class="text-decoration-none text-muted small">
            <i class="fas fa-arrow-left me-1"></i> {{ __('messages.back') }}
        </a>
    </div>

    <div class="card shadow-sm border-0 mx-4 h-auto">
        <div class="card-body p-5 ">
            <form action="{{ route('user-lists.store') }}" method="POST">
                @csrf

                <div class="mb-5">
                    <div class="mb-4">
                        <label class="form-label text-muted small fw-bold">{{ __('messages.phone') }}</label>
                        <input type="text" name="phone" class="form-control" placeholder="Nhập số điện thoại" value="{{ old('phone') }}">
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted small fw-bold">{{ __('messages.name') }} <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control 
                            @error('name') is-invalid @enderror" 
                            placeholder="{{ __('messages.name') }}" value="{{ old('name') }}">
                        
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted small fw-bold">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control 
                            @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}">
                        
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-5">
                    <h5 class="fw-bold mb-3">{{ __('messages.set_up_a_password') }}</h5>
                    <div class="mb-4">
                        <label class="form-label text-muted small fw-bold">{{ __('messages.password') }} <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control 
                            @error('password') is-invalid @enderror">
                        
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted small fw-bold">{{ __('messages.confirm_password') }} <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                </div>

                <div class="mb-5">
                    <h5 class="fw-bold mb-3">{{ __('messages.set_up_a_service_subscription') }}</h5>
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" name="create_service" id="createService"
                            {{ old('create_service') ? 'checked' : '' }}>
                        <label class="form-check-label text-muted small" for="createService">
                            {{ __('messages.create_a_service_subscription') }}
                        </label>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted small fw-bold">{{ __('messages.application') }}</label>
                        <select name="app_id" id="app_select" class="form-select text-muted @error('app_id') is-invalid @enderror" disabled>
                            <option selected value="" hidden disabled>{{ __('messages.select_the_app') }}</option>

                            @foreach($apps as $app)
                                <option value="{{ $app->id }}" {{ old('app_id') == $app->id ? 'selected' : '' }}>
                                    {{ $app->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('app_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted small fw-bold">{{ __('messages.service_package') }}</label>
                        <select name="package_id" id="package_select" class="form-select text-muted @error('package_id') is-invalid @enderror" disabled>
                            <option selected value="" hidden disabled>{{ __('messages.package_options') }}</option>

                            @foreach($packages as $package)
                                <option value="{{ $package->id }}" {{ old('package_id') == $package->id ? 'selected' : '' }}>
                                    {{ $package->package }}
                                </option>
                            @endforeach
                        </select>

                        @error('package_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 pt-4">
                    <button type="button" class="btn btn-secondary px-4" style="background-color: #6c757d;">
                        <i class="fas fa-times me-1"></i> {{ __('messages.cancel') }}
                    </button>
                    <button type="submit" class="btn btn-primary px-4" style="border: none;">
                        <i class="fas fa-check me-1"></i> {{ __('messages.create_user') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection