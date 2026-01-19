@extends(('layouts.app'))

@section('payment-lists')

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom py-3">
                    <h2 class="card-title mb-0 fw-bold text-primary">
                        Thêm gói thanh toán mới
                    </h2>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('payments.store') }}" method="POST">
                        @csrf
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Ứng dụng</label>
                                <div class="input-group">
                                    <select name="name" class="form-select
                                         @error('name') is-invalid @enderror" >
                                        <option value="" disabled selected hidden>Chọn Ứng dụng...</option>

                                        @foreach($apps as $app)
                                            <option value="{{ $app->name }}" {{ old('name') == $app->name ? 'selected' : '' }}> {{--  --}}
                                                {{ $app->name }} 
                                            </option>

                                        @endforeach
                                    </select>
                                    @error('name') <div class="invalid-feedback"> {{ $message }} </div>  @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tên gói</label>
                                <input type="text" name="package" class="form-control
                                    @error('package') is-invalid @enderror" 
                                       placeholder="VD: Full Services" value="{{ old('package') }}" >

                                @error('package') <div class="invalid-feedback"> {{ $message }} </div>  @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Giá</label>
                                <div class="input-group">
                                    <input type="number" name="price" class="form-control 
                                        @error('price') is-invalid @enderror" 
                                           placeholder="0" value="{{ old('price') }}" >
                                           
                                @error('price') <div class="invalid-feedback"> {{ $message }} </div>  @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top d-flex gap-2 justify-content-end">
                            <a href="{{ route('payments') }}" class="btn btn-light px-4">Hủy bỏ</a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i>Lưu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection