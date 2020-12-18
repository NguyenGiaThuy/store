<!--
=========================================================
Material Dashboard - v2.1.2
=========================================================

Product Page: https://www.creative-tim.com/product/material-dashboard
Copyright 2020 Creative Tim (https://www.creative-tim.com)
Coded by Creative Tim

=========================================================
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en">

<!-- Head -->
@include('partials.manage.head')
<!-- End Head -->

<body>

<div class="wrapper ">
    <!-- Sidebar -->
    @include('partials.manage.sidebar')
    <!-- End Sidebar -->

    <div class="main-panel">

        <!-- Navbar -->
        @include('partials.manage.navbar')
        <!-- End Navbar -->

        <div class="content">
            <div class="container-fluid">
                <x-alert></x-alert>
                @yield('content')
            </div>
        </div>

    </div>

</div>

<!-- Scripts -->
@include('partials.manage.scripts')
<!-- End Scripts -->

</body>

</html>
