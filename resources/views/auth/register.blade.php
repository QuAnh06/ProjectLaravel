<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSO Server</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card border-0 shadow-lg" style="border-radius: 15px;">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-primary">TẠO TÀI KHOẢN</h3>
                        <p class="text-muted">Tham gia cùng chúng tôi để trải nghiệm dịch vụ tốt nhất</p>
                    </div>

                    <form action="{{ route('register.post') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-semibold">Họ và Tên</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                       placeholder="Nguyễn Văn A" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-semibold">Địa chỉ Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                       placeholder="email@example.com" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Mật khẩu</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                                       placeholder="••••••••" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold">Xác nhận mật khẩu</label>
                                <input type="password" name="password_confirmation" class="form-control" 
                                       placeholder="••••••••" required>
                            </div>
                        </div>

                        <div class="mb-4 small text-muted">
                            Bằng cách đăng ký, bạn đồng ý với <a href="#">Điều khoản dịch vụ</a> của chúng tôi.
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm" style="border-radius: 10px;">
                            Đăng Ký Tài Khoản
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <p class="mb-0 text-muted">Đã có tài khoản? <a href="{{ route('login') }}" class="fw-bold text-decoration-none">Đăng nhập</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>