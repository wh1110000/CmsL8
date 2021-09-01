<!DOCTYPE html>

<html lang="{{ App::getLocale() }}" class="h-100">

<head>
    {{ Html::metaTags() }}

    {{ Html::favicons() }}

    {{ Html::style('vendor/bootstrap-4.3.1/dist/css/bootstrap.min.css') }}
    {{ Html::style('vendor/flag-icon-css-master/css/flag-icon.min.css') }}
    {{ Html::style('vendor/jquery-eu-cookie-law-popup-master/css/jquery-eu-cookie-law-popup.css') }}

    @stack('styles')

    <style>
        html, body {
            height: 100%;
        }

        footer a {
            color:#fff
        }
    </style>

    {{ Html::script('vendor/jquery-3.3.1/jquery-3.3.1.min.js') }}
    {{ Html::script('js/jquery-ui.js') }}
    {{ Html::script('vendor/bootstrap-4.3.1/dist/js/bootstrap.bundle.min.js') }}
    {{ Html::script('vendor/bootbox-master/bootbox.js') }}

    <script src="https://kit.fontawesome.com/e84967734e.js" crossorigin="anonymous"></script>

    @stack('scripts')

    {{-- Html::bugherd() }}

    {{ Html::googleTagManager('head') ---}}
</head>

<body class="h-100">
    {{  Html::googleTagManager() }}

   {{-- @component('components::admin-bar') @endcomponent--}}

    <div class="h-100 d-flex flex-column">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
            <div class="container">
                <a class="navbar-brand" href="{{ route('page.homepage') }}">{{ app('SettingsManager')->get('WEBSITE_TITLE') }}</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarResponsive">
                    {{ Navigation::render('header') }}
                </div>
            </div>
        </nav>

        <div class="container mt-5">
            <div class="row">
                <div class="col-12">
                    @yield('content')
                </div>
            </div>
        </div>

        <footer class="w-100 bg-dark text-white d-flex justify-content-center mt-auto">
            <div class="container py-5">
                <div class="row">
                    <div class="col-12 text-white">
                        {{ Html::socialMedia() }}
                    </div>

                    <div class="col-12">
                        {{ Html::copyright() }}
                    </div>

                    <div class="col-12">
                        {{ Html::languageSelector() }}
                    </div>

                    <div class="col-12">
                        <nav class="row d-flex justify-content-end">
                            @foreach(Navigation::blocks(['footer-block-1', 'footer-block-2']) as $block)
                                <div class="col-3">
                                    <h5>{{ $block->getTitle() }}</h5>

                                    {{  Navigation::render($block->getLink(), $block->getId()) }}
                                </div>
                            @endforeach
                        </nav>
                    </div>

                    <div class="col-12">
                        {{ Navigation::render('footer-secondary') }}
                    </div>
                </div>
            </div>
        </footer>
    </div>

    @if(auth()->check())

        <form id="logout-form-user" action="{{ route('logout') }}" method="POST">{{ csrf_field() }}</form>

        <script>
            @if(auth()->user()->isFirstTimeLogin())
                $.ajax({
                    type: "POST",
                    url: "{{ route('account.modal.welcome') }}",
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    success: function (data) {
                        bootbox.dialog({
                            size: 'medium',
                            title: " ",
                            message: data,
                        });
                    }
                });
            @endif
        </script>
    @endif
</body>

</html>
