@include('layouts.header')
<section class="py-5">
        {{ $slot }}
</section>
        @include('layouts.footer')
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('assets/js/scripts.js') }}"></script>
        <script src="{{asset('assets/js/tinymce/tinymce.min.js')}}"></script>
        {{ $scripts ?? '' }}
    </body>
</html>