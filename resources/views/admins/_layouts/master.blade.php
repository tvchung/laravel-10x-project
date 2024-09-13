@include('admins._layouts.head')
<!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> 
    <!--begin::App Wrapper-->
    <div class="app-wrapper"> 
        <!--begin::Header-->
        @include('admins._layouts.header')
        <!--end::Header--> 
        <!--begin::Sidebar-->
        @include('admins._layouts.navbar')
        <!--end::Sidebar--> 
        <!--begin::App Main-->
        <main class="app-main"> 
            @yield('body-content')
        </main>
        <!--end::App Main-->
        <!--begin::Footer-->
        @include('admins._layouts.footer')
        <!--end::Footer-->
    </div> 
    <!--end::App Wrapper--> 
    <!--begin::Script--> 
    @include('admins._layouts.body-script')
    <!--end::Script-->

    @yield('Scripts')
</body>
<!--end::Body-->
</html>