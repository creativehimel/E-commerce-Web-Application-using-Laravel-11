<!DOCTYPE html>

<html
    lang="en"
    class="light-style layout-wide customizer-hide"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../../assets/"
    data-template="vertical-menu-template">
    @include('auth.layouts.includes.head')

<body>
<!-- Content -->

@yield('authContent')

<!-- / Content -->

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
@include('auth.layouts.includes.script')


</body>
</html>
