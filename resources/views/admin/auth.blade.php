<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Workhouse - Admin Login</title>

    {{ Html::script('vendor/jquery-3.3.1/jquery-3.3.1.min.js') }}
    {{ Html::script('js/jquery-ui.js') }}
    {{ Html::script('vendor/bootstrap-4.3.1/dist/js/bootstrap.bundle.min.js') }}

    {{ Html::style('css/auth.min.css') }}
</head>

<body class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    @hasSection('title')
                        <div class="card-header">@yield('title')</div>
                    @endif

                    <div class="card-body">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
