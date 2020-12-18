<div class="sidebar" data-color="purple" data-background-color="white"
     data-image="{{ asset('assets/img/sidebar-1.jpg') }}">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
    -->
    <div class="logo"><a href="{{ route($userTitle . '.home') }}" class="simple-text logo-normal">
            {{ $userTitle }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item active  ">
                <a class="nav-link" href="{{ route($userTitle . '.home') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{ route($userTitle . '.profile') }}">
                    <i class="material-icons">person</i>
                    <p>User Profile</p>
                </a>
            </li>
            @if($userTitle == 'admin')
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('admin.users.index') }}">
                        <i class="material-icons">people</i>
                        <p>Users Manager</p>
                    </a>
                </li>
            @else
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('editor.catalogs.index') }}">
                        <i class="material-icons">filter_list</i>
                        <p>Catalogs Manager</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('editor.products.index') }}">
                        <i class="material-icons">headset</i>
                        <p>Products Manager</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('editor.orders.index') }}">
                        <i class="material-icons">assignment</i>
                        <p>Orders Manager</p>
                    </a>
                </li>
            @endif
            <li class="nav-item back-store ">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="material-icons">keyboard_return</i>
                    <p>Back To Store</p>
                </a>
            </li>
        </ul>
    </div>
</div>
