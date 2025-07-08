<!-- https://www.youtube.com/watch?v=CMwzLURK-rQ -->
<!DOCTYPE html>
<html lang="en">

@include('template.components.head')

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        @include('template.components.sidebar')
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            @include('template.components.nav')
            <div class="container-fluid px-4">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- page-content-wrapper -->

    <!-- JavaScript Bundle with Popper -->
    @include('template.components.scripts')
</body>

</html>
