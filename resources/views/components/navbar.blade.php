        <div class="d-none d-lg-flex flex-column flex-shrink-0 bg-white custom-sidebar">
            <ul class="nav nav-pills flex-column mb-auto custom-sidebar-nav">
                <li class="menu-item {{ Request::is('home') ? 'active' : '' }} ">
                    <a href="{{ url('/home') }}" class="menu-link active" aria-current="page"><i class="fas fa-home me-2"></i>Trang chủ</a>
                </li>
                <li class="menu-item {{ Request::is('application-lists*') ? 'active' : '' }}">
                    <a href="{{ url('/application-lists') }}" class="menu-link"><i class="fa-solid fa-table-cells-large"></i>Danh sách ứng dụng</a>
                </li>
                <li class="menu-item {{ Request::is('service-list*') ? 'active' : '' }}">
                    <a href="{{ url('/service-list')}}" class="menu-link"><i class="fa-solid fa-box"></i>Danh sách Gói dịch vụ</a>
                </li>
                <li class="menu-item {{ Request::is('payment-list*') ? 'active' : '' }}">
                    <a href="{{ url('/payment-list')}}" class="menu-link"><i class="fa-regular fa-credit-card"></i>Danh sách Gói thanh toán</a>
                </li>
                <li class="menu-item {{ Request::is('user-list*') ? 'active' : '' }}">
                    <a href="{{ url('/user-list')}}" class="menu-link"><i class="fa-solid fa-users"></i>Danh dách Người dùng</a>
                </li>
            </ul>
        </div>

        <div class="offcanvas offcanvas-start bg-white d-lg-none custom-offcanvas-sidebar" tabindex="-1" id="sidebarOffcanvas" aria-labelledby="sidebarOffcanvasLabel">
            <div class="offcanvas-header custom-offcanvas-header">
                <h5 class="offcanvas-title fw-bold" id="sidebarOffcanvasLabel">SSO Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body p-0">
                <ul class="nav nav-pills flex-column mb-auto custom-sidebar-nav">
                    <li class="menu-item {{ Request::is('home') ? 'active' : '' }} ">
                        <a href="{{ url('/home') }}" class="menu-link active" aria-current="page"><i class="fas fa-home me-2"></i>Trang chủ</a>
                    </li>
                    <li class="menu-item {{ Request::is('application-lists*') ? 'active' : '' }}">
                        <a href="{{ url('/application-lists') }}" class="menu-link"><i class="fa-solid fa-table-cells-large"></i>Danh sách ứng dụng</a>
                    </li>
                    <li class="menu-item {{ Request::is('service-list*') ? 'active' : '' }}">
                        <a href="{{ url('/service-list')}}" class="menu-link"><i class="fa-solid fa-box"></i>Danh sách Gói dịch vụ</a>
                    </li>
                    <li class="menu-item {{ Request::is('payment-list*') ? 'active' : '' }}">
                        <a href="{{ url('/payment-list')}}" class="menu-link"><i class="fa-regular fa-credit-card"></i>Danh sách Gói thanh toán</a>
                    </li>
                    <li class="menu-item {{ Request::is('user-list*') ? 'active' : '' }}">
                        <a href="{{ url('/user-list')}}" class="menu-link"><i class="fa-solid fa-users"></i>Danh dách Người dùng</a>
                    </li>
                </ul>
            </div>
        </div>
