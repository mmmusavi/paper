<footer class="footer">
    <div class="container">
        <p class="text-muted">سیستم مدیریت نشریه - طراحی و توسعه توسط <a href="/">گروه نرم افزاری آرتیسان</a></p>
    </div>
</footer>

<!-- JavaScripts -->
    @if(\Request::is('dashboard*'))
        <script src="{{ URL::asset('js/jquery2.min.js') }}"></script>
    @else
        <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
        <script src="/js/jquery.fancybox.min.js"></script>
    @endif

<script src="{{ URL::asset('js/main.js') }}"></script>

    @if(\Request::is('dashboard*'))
        <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {

                $('.iframe-btn').fancybox({
                    'width'		: 900,
                    'height'	: 600,
                    'type'		: 'iframe',
                    'autoScale'    	: false
                });
            });
        </script>
    @endif
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>