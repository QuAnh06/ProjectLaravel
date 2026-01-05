@extends('layouts.app')

@section('main')
        <main class="custom-content-area py-5 px-4 ">
            <div class="container-fluid">
                
                <div class="content-header">
                    <h2 class="mb-0 fw-bold">Tạo App mới</h2>
                    <a href="#" class="back"><i class="fas fa-arrow-left me-1"></i> Quay lại</a>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-md-5"> 
                        <!-- responsive tren man hinh rong hon md - 768px trở lên -->
                        <form > <!--action = "{{ route('app-lists') }}" method = "POST" ; Route::post-->
                            <div class="mb-4">
                                
                                @csrf

                                <label for="appName" class="form-label fw-bold"> Tên App <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" name="appName" id="appName" placeholder="Ví dụ: My Application">
                                <div class="invalid-feedback">
                                    <!-- Vui lòng nhập Tên App. -->
                                </div>
                            </div>

                            <div class="mb-4  field-form">
                                <label for="appCode" class="form-label fw-bold"> App Code <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" name="appCode" id="appCode" placeholder="Ví dụ: my-app">
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

    @push('scripts')
        <script>
                const form = document.querySelector('form');
            if (!form) return;

            const appName = document.getElementById('appName');
            const appCode = document.getElementById('appCode');
            const codePattern = /^[a-zA-Z0-9_-]+$/;

            form.addEventListener('submit', function (e) {
            e.preventDefault(); 
            appName.classList.remove('is-invalid');
            appCode.classList.remove('is-invalid');

            if (!appName.value.trim()) {
                appName.classList.add('is-invalid');
                const errorMessage = appName.nextElementSibling;  
                if (errorMessage && errorMessage.classList.contains('invalid-feedback')) {
                errorMessage.textContent = 'Vui lòng nhập Tên App.';
                }
                appName.focus();
                return;
            }

            const code = appCode.value.trim();
            if(!code){
                appCode.classList.add('is-invalid');
                const errorMessage = appCode.nextElementSibling;  
                if (errorMessage && errorMessage.classList.contains('invalid-feedback')) {
                errorMessage.textContent = 'Vui lòng nhập App Code.';
                }
                appCode.focus();
                return;

                // const errorMessage = document.createElement("div");
                // errorMessage.classList.add('invalid-feedback');
                // errorMessage.textContent = "Vui lòng nhập App Code.";
                // appCode.parentElement.appendChild(errorMessage);
                //appCode.focus();
                // return;
            }

            if (!codePattern.test(code)) {
                appCode.classList.add('is-invalid');
                const errorMessage = appCode.nextElementSibling;
                if (errorMessage && errorMessage.classList.contains('invalid-feedback')) {
                errorMessage.textContent = 'App Code không hợp lệ.';
                }
                appCode.focus();
                // alert('App Code không hợp lệ. Chỉ chấp nhận chữ, số, dấu gạch ngang (-) và gạch dưới (_).');
                return;
            }
            form.submit();
            });
            
            const cancelBtn = document.querySelector('.btn-secondary');
            if(cancelBtn){
            cancelBtn.addEventListener('click', ()=>{
                form.reset();
                [appName, appCode].forEach(i=> i.classList.remove('is-invalid'));
            });
            }
        });
        </script>

    @endpush
@endsection