<div class="sidebar sidebar-light sidebar-main sidebar-expand-md">
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        <span class="font-weight-semibold">Navigation</span>
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>

    <div class="sidebar-content">
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                @if($loginUser->type === \App\Enums\UserType::USER)
                    <li class="nav-item">
                        <a href="{{ route("admin.products.index") }}"
                           class="nav-link {{ Ekko::areActiveRoutes(['admin.products.*']) }}">
                            <i class="icon-list"></i>
                            <span>{{ __('menu.products') }}</span>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route("admin.users.index") }}"
                           class="nav-link {{ Ekko::areActiveRoutes(['admin.users.*']) }}">
                            <i class="icon-users"></i>
                            <span>{{ __('menu.users') }}</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
