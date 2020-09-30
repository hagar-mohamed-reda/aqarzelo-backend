 
    <link href="{{ asset('backend/css/toaster.min.css') }}" rel="stylesheet">
    <script src="{{ asset('backend/js/toaster.min.js') }}"></script>
    <script>

        @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}")
        @elseif( Session::has('error'))
        toastr.error("{{ Session::get('error') }}")
        @elseif( Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}")
        @endif
    </script>