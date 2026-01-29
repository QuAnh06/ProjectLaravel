        <div class="d-none d-lg-flex flex-column flex-shrink-0 bg-white custom-sidebar">
            <ul class="nav nav-pills flex-column mb-auto custom-sidebar-nav">
                <li class="menu-item {{ Request::is('home') ? 'active' : '' }} ">
                    <a href="{{ route('home') }}" class="menu-link active" aria-current="page"><i class="fas fa-home me-2"></i>{{ __('messages.home') }}</a>
                </li>
                <li class="menu-item {{ Request::is('apps*') ? 'active' : '' }}">
                    <a href="{{ route('apps') }}" class="menu-link"><i class="fa-solid fa-table-cells-large"></i>{{ __('messages.app_list') }}</a>
                </li>
                <li class="menu-item {{ Request::is('payment-subscriptions*') ? 'active' : '' }}">
                    <a href="{{ route('payment-subscriptions')}}" class="menu-link"><i class="fa-solid fa-box"></i>{{ __('messages.subscriptions') }}</a>
                </li>
                <li class="menu-item {{ Request::is('payments*') ? 'active' : '' }}">
                    <a href="{{ route('payments')}}" class="menu-link"><i class="fa-regular fa-credit-card"></i>{{ __('messages.packages') }}</a>
                </li>
                <li class="menu-item {{ Request::is('user-lists*') ? 'active' : '' }}">
                    <a href="{{ route('user-lists')}}" class="menu-link"><i class="fa-solid fa-users"></i>{{ __('messages.users') }}</a>
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
                        <a href="{{ route('home') }}" class="menu-link active" aria-current="page"><i class="fas fa-home me-2"></i>{{ __('messages.home') }}</a>
                    </li>
                    <li class="menu-item {{ Request::is('apps*') ? 'active' : '' }}">
                        <a href="{{ route('apps') }}" class="menu-link"><i class="fa-solid fa-table-cells-large"></i>{{ __('messages.app_list') }}</a>
                    </li>
                    <li class="menu-item {{ Request::is('payment-subscriptions*') ? 'active' : '' }}">
                        <a href="{{  route('payment-subscriptions') }}" class="menu-link"><i class="fa-solid fa-box"></i>{{ __('messages.subscriptions') }}</a>
                    </li>
                    <li class="menu-item {{ Request::is('payments*') ? 'active' : '' }}">
                        <a href="{{ route('payments')}}" class="menu-link"><i class="fa-regular fa-credit-card"></i>{{ __('messages.packages') }}</a>
                    </li>
                    <li class="menu-item {{ Request::is('user-lists*') ? 'active' : '' }}">
                        <a href="{{ route('user-lists')}}" class="menu-link"><i class="fa-solid fa-users"></i>{{ __('messages.users') }}</a>
                    </li>
                </ul>
            </div>
        </div>
