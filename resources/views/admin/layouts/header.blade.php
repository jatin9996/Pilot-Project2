<div class="navbar navbar-expand-md navbar-dark bg-indigo navbar-static">
    <div class="navbar-brand">
        <a href="{{ route('admin.dashboard.index') }}" class="d-inline-block">
            <img src="{{ asset('assets/images/logo_light.png') }}" alt="Logo">
        </a>
    </div>
    <div class="text-center d-xl-none w-100">
        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse"
                data-target="#navbar-demo1-mobile">
            <i class="icon-unfold mr-2"></i>
            Dark navbar component
        </button>
    </div>

    <div class="navbar-collapse collapse" id="navbar-demo1-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>
        </ul>

        <span class="navbar-text ml-xl-auto"></span>
        <ul class="navbar-nav ml-xl-3">
            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ asset('assets/images/face6.png') }}" class="rounded-circle mr-2"
                         height="34" alt="">
                    <span>{{ (isset($loginUser))?$loginUser->first_name.' '.$loginUser->last_name:"" }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('admin.logout') }}" class="dropdown-item"><i
                            class="icon-switch2"></i> {{ __('labels.logout') }}</a>
                </div>
            </li>
        </ul>
    </div>
</div>
