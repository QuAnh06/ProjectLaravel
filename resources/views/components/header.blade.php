    <header class="navbar navbar-expand-lg custom-header sticky-top">
        <div class="container-fluid">
            <button class="btn btn-sm d-lg-none me-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas">
                <i class="fas fa-bars fa-lg"></i>
            </button>
    
            <a class="logo" href="{{ route('index') }}">SSO Server</a>
    
            <div class="d-flex align-items-center ms-auto header-icons-group">

                @php
                $currentLocale = session('locale', 'vi');
                $languages = [
                'vi' => ['name' => 'Tiếng Việt', 'flag' => 'vn.png'],
                'en' => ['name' => 'English', 'flag' => 'united-kingdom.png'],
                'jp' => ['name' => 'Japanese', 'flag' => 'japan.png'],
                ];
                @endphp

                <div class="dropdown">
                    <button class="btn btn-sm dropdown-toggle custom-dropdown-btn" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('assets/images/' . $languages[$currentLocale]['flag']) }}" width="17" class="rounded-sm" >

                        <span>{{ $languages[$currentLocale]['name'] }}</span>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">
                        @foreach($languages as $key => $lang)
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-3 {{ $currentLocale == $key ? 'active' : '' }}" href="{{ route('lang.switch', $key) }}">

                                <img src="{{ asset('assets/images/' . $lang['flag']) }}" width="18" class="rounded-sm">

                                {{ $lang['name'] }}

                                @if($currentLocale == $key)
                                <i class="fas fa-check ms-auto text-info" style="font-size: 10px;"></i>
                                @endif
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>


    
                <div class="dropdown">
                    <button class="btn btn-sm dropdown-toggle custom-dropdown-btn" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="admin"><i class="fa-regular fa-user"></i></span> {{ Auth::user()->name }} 
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <h6 class="dropdown-header">{{ Auth::user()->name }}</h6>
                        </li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Cài đặt tài khoản</a></li>
                        <li>
                            <hr>
                        </li>
                        <li>
                            @auth
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}" data-turbo="false">
                                    <i class="fas fa-sign-out-alt me-2"></i> Đăng xuất
                                </a>

                            @endauth
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>