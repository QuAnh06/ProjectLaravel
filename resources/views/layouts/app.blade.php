<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSO Server</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('css/responsive.css') }}"> -->
</head>
<body>

    @include('components.header')

    <div class="custom-body-wrapper">
        
        @include('components.navbar')
        
        @yield('main')

        @yield('user-lists')
        
        @yield('app-lists')

        @yield('user-lists.create')
    </div>

    @include('components.footer')

    @if (!Route::is('user-lists.create')) 
        <script src="{{ asset('js/main.js') }}"></script>
    @endif

    {{-- <script src="{{ asset('js/main.js') }}"></script> --}}
    

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    <script>
        @if(session('create-success'))
            Swal.fire({
                template: "#create-success",
                text: "{{ session('success') }}",
            });
        @endif
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
</body>
</html>