@if(Session::has('error'))
    <script>
        $(document).ready(function () {
            toastr.error("{{ Session('error') }}")
        });
    </script>
@endif

@if(Session::has('success'))
    <script>
        $(document).ready(function () {
            toastr.success("{{ Session('success') }}")
        });
    </script>
@endif
