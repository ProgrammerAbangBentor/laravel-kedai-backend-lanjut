<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">E - Kedai
                <img src="{{ asset('img/kedai.png') }}"
                alt="logo"
                width="70">
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <br>
        <hr>
        <ul class="sidebar-menu">
            <li class="{{ Request::is('credits') ? 'active' : '' }}">
                <a class="nav-link"
                    href=""><i class="fa-sharp-duotone fa-solid fa-house"></i>
                    </i> <b><span>Dashboard</span></b>
                </a>
            </li>

            @role('admin')
            <li class="{{ Request::is('credits') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ route('user.index')}}"><i class="fa-sharp-duotone fa-solid fa-users"></i>
                    </i> <b><span>Users</span></b>
                </a>
            </li>
            @endrole
            <li class="{{ Request::is('credits') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ route('product.index')}}"><i class="fa-sharp-duotone fa-solid fa-store"></i>
                    </i> <b><span>Product</span></b>
                </a>
            </li>
    </aside>
</div>
