@if ($message = Session::get('message'))
    @dd($message);
    <script>
    document.addEventListener('DOMContentLoaded', function () {
    showAlert('info', '{{ $message }}');
    });
    </script>
@endif

@if ($message = Session::get('success'))
    <script>
    document.addEventListener('DOMContentLoaded', function () {
    showAlert('success', '{{ $message }}');
    });
    </script>
@endif

@if ($message = Session::get('warning'))
    <script>
    document.addEventListener('DOMContentLoaded', function () {
    showAlert('warning', '{{ $message }}');
    });
    </script>
@endif

@if ($message = Session::get('error'))
    <script>
    document.addEventListener('DOMContentLoaded', function () {
    showAlert('error', '{{ $message }}');
    });
    </script>
@endif

@if ($message = Session::get('info'))
    <script>
    document.addEventListener('DOMContentLoaded', function () {
    showAlert('info', '{{ $message }}');
    });
    </script>
@endif