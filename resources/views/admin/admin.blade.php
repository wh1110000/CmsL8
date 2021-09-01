<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>
    {{ Html::metaTags() }}

    {{ Html::script('js/app.js') }}
    {{ Html::script('vendor/jquery-3.3.1/jquery-3.3.1.min.js') }}
    {{ Html::script('js/jquery-ui.js') }}
    {{ Html::script('vendor/bootstrap-4.3.1/dist/js/bootstrap.bundle.min.js') }}
    {{ Html::script('vendor/jszip-master/dist/jszip.min.js') }}
    {{ Html::script('vendor/pdfmake-0.1.53/build/pdfmake.min.js') }}
    {{ Html::script('vendor/pdfmake-0.1.53/build/vfs_fonts.js') }}
    {{ Html::script('vendor/DataTables-1.10.16/media/js/jquery.dataTables.min.js') }}
    {{ Html::script('vendor/DataTables-1.10.16/media/js/dataTables.bootstrap4.min.js') }}
    {{ Html::script('vendor/DataTables-1.10.16/extensions/Buttons/js/dataTables.buttons.min.js') }}
    {{ Html::script('vendor/DataTables-1.10.16/extensions/Buttons/js/buttons.html5.min.js') }}
    {{ Html::script('vendor/DataTables-1.10.16/extensions/Buttons/js/buttons.flash.min.js') }}
    {{ Html::script('vendor/DataTables-1.10.16/extensions/Buttons/js/buttons.print.min.js') }}
    {{ Html::script('vendor/DataTables-1.10.16/extensions/Select/js/dataTables.select.min.js') }}
    {{ Html::script('vendor/Responsive-master/js/dataTables.responsive.js') }}
    {{ Html::script('vendor/redactor/redactor.min.js') }}
    {{ Html::script('vendor/redactor/plugins/video/video.js') }}
    {{ Html::script('vendor/redactor/plugins/imagemanager/imagemanager.js') }}
    {{ Html::script('vendor/malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.concat.min.js') }}
    {{ Html::script('vendor/bootstrap-duallistbox-4/dist/jquery.bootstrap-duallistbox.min.js') }}
    {{ Html::script('vendor/jquery-minicolors-master/jquery.minicolors.js') }}
    {{ Html::script('vendor/dropzone-master/dist/dropzone.js') }}
    {{ Html::script('vendor/bootstrap-toggle-master/js/bootstrap-toggle.js') }}
    {{ Html::script('vendor/Nestable2-master/dist/jquery.nestable.min.js') }}
    {{ Html::script('vendor/chart.js/dist/Chart.bundle.min.js') }}
    {{ Html::script('vendor/moment/min/moment-with-locales.min.js') }}
    {{ Html::script('vendor/bootstrap-4-master/build/js/tempusdominus-bootstrap-4.min.js') }}
    {{ Html::script('js/backend.js') }}
    {{ Html::script('vendor/Magnific-Popup-master/dist/jquery.magnific-popup.min.js') }}
    {{ Html::script('vendor/bootstrap-notify-master/bootstrap-notify.min.js') }}
    {{ Html::script('vendor/select2-develop/dist/js/select2.min.js') }}
    {{ Html::script('vendor/sweetalert2/dist/sweetalert2.all.min.js') }}
    {{ Html::script('vendor/bootbox-master/bootbox.js') }}
    {{ Html::script('vendor/daterangepicker-master/daterangepicker.js') }}
    {{-- Html::script('js/css-vars-ponyfill.min.js') }} <!-- IE CSS variables ponyfill -->--}}
    {{ Html::script('js/spin.min.js') }}
    {{ Html::script('js/ladda.min.js') }}
    {{ Html::script('js/global.js') }}
    <script src="https://kit.fontawesome.com/412f43a33d.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js" integrity="sha256-15owqJa8me4REHGJOz0YGNSSNjC/3wme7FRXaRVwxRY=" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            // Form repeater
            var FormRepeater = function() {
                return {
                    init: function() {
                        $(".mt-repeater").each(function() {
                            $(this).repeater({
                                show: function(e) {
                                    $(this).slideDown();
                                },
                                hide: function(e) {
                                    if(confirm("Are you sure you want to delete this element?")){
                                        $(this).slideUp(e);
                                    }
                                },
                                ready: function(e) {}
                            });
                        });
                    }
                };
            }();

            FormRepeater.init();

            // Redactor
            $(".wysiwyg-editor").redactor({
                showSource:!0,
                source:!0,
                linkTarget:"_blank",
                linkTitle:!0,
                linkSize:100,
                minHeight:"400px",
                maxHeight: '800px',
                toolbarFixed: true,
                buttons:[
                    "html","format","bold","italic","lists","link","file","image"
                ],
                plugins:[
                    "source","video","imagemanager"
                ],
                imageUpload: "{{-- route('admin.image.upload').'?_token='. csrf_token() --}}",
                imageManagerJson: "{{-- route('admin.image.manager') --}}"
            });

            $('.singleDatePicker').daterangepicker({
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
                showDropdowns: true,
                timePickerSeconds: true,
                maxDate: false,
                locale: {
                    format: 'YYYY-MM-DD HH:mm:ss'
                }
            });

            // Dropdown styling
            $('select').on('change', function()
            {
            	$(this).toggleClass('selected');
            });

            // Menu toggle
            $('.sidebar-menu-btn').on('click', function()
            {
            	$('.side-navbar').toggleClass('open');
            });

            $('.sidebar-menu-close').on('click', function()
            {
            	$('.side-navbar').removeClass('open');
            });
        });
    </script>

    @stack('scripts')

    <!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
    {{ Html::script('vendor/html5shiv-master/dist/html5shiv.min.js') }}
    {{ Html::script('vendor/Respond-master/dest/respond.min.js') }}
    <![endif]-->

    {{ Html::style('vendor/animate.css-master/animate.min.css') }}
    {{ Html::style('vendor/select2-develop/dist/css/select2.min.css') }}
    {{ Html::style('vendor/Magnific-Popup-master/dist/magnific-popup.css') }}
    {{ Html::style('vendor/malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.min.css') }}
    {{ Html::style('vendor/redactor/redactor.min.css') }}
    {{ Html::style('vendor/DataTables-1.10.16/media/css/dataTables.bootstrap4.min.css') }}
    {{ Html::style('vendor/DataTables-1.10.16/extensions/Responsive/css/responsive.dataTables.css') }}
    {{ Html::style('vendor/DataTables-1.10.16/extensions/Responsive/css/responsive.bootstrap4.css') }}
    {{ Html::style('vendor/bootstrap-duallistbox-4/dist/bootstrap-duallistbox.min.css') }}
    {{ Html::style('vendor/jquery-minicolors-master/jquery.minicolors.css') }}
    {{ Html::style('vendor/dropzone-master/dist/dropzone.css') }}
    {{ Html::style('vendor/bootstrap-toggle-master/css/bootstrap-toggle.css') }}
    {{ Html::style('vendor/bootstrap-4-master/build/css/tempusdominus-bootstrap-4.min.css') }}
    {{ Html::style('vendor/bootstrap-image-hover-master/src/css/effects.css') }}
    {{ Html::style('vendor/daterangepicker-master/daterangepicker.css') }}
    {{ Html::style('css/admin.min.css') }}
    {{ Html::style('https://lab.hakim.se/ladda/dist/ladda.min.css') }}

    <style>
        img {
            max-width: 100% !important;
        }

        .custom-control-label:after, .custom-control-label:before {
            top: 1.25rem;
        }

        form .form-row label:first-child {
            margin: 20px 0 8px;
        }

        section {
            margin-top: 3rem!important;
        }

        button[type=submit] {
            width: 100%;
            cursor: pointer;
            color: #fff;
            background-color: #999;
            display: block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border: 1px solid #999;
            padding: .35rem .9375rem;
            font-size: .875rem;
            line-height: 1.5;
            border-radius: .25rem;
            -webkit-transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }

        .required:after {
            content:" *";
            color: red;
        }

</style>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-iconpicker-1.10.0/dist/css/bootstrap-iconpicker.min.css') }}">
    <script type="text/javascript" src="{{ asset('vendor/bootstrap-iconpicker-1.10.0/dist/js/bootstrap-iconpicker.bundle.min.js') }}"></script>

    @stack('styles')
</head>

<body>
    <header class="admin">
       <nav>
           <a href="{{ route('admin.dashboard.index') }}" class="logo-wrapper">
               <img src="{{ app('SettingsManager')->get('BRAND_LOGO') ?: 'https://workhousemarketing.com//content/themes/workhouse/dist/images/logo-black.svg' }}" class="logo" alt="{{ config('app.name') }} logo">
           </a>

           <div class="user-menu">
               <div class="dropdown">
                   <a href="#" class="user-name" data-toggle="dropdown" aria-haspopup="true" data-display="static" aria-expanded="false" >
                       <span class="initial">{{ ( auth('administrator')->user()->first_name)[0] }}</span>

                       {{  auth('administrator')->user()->first_name }} {{  auth('administrator')->user()->last_name }}
                   </a>

                   <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                       <a class="dropdown-item" href="{{ route('admin.account.index') }}">
                           <i class="fas fa-user"></i> {{ __('administrators::general.my_account') }}
                       </a>

                       <a class="dropdown-item" href="{{-- route('page.homepage') --}}">
                           <i class="fas fa-location-arrow"></i> {{ __('cms::general.go_to_website') }}
                       </a>

                       <a class="dropdown-item logout" href="{{ route('admin.auth.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           <i class="fas fa-sign-out-alt"></i> {{ __('administrators::general.logout') }}
                       </a>
                   </div>
               </div>
           </div>

           <a href="#" class="sidebar-menu-btn">Menu</a>

           <form id="logout-form" action="{{ route('admin.auth.logout') }}" method="POST">{{ csrf_field() }}</form>
       </nav>
    </header>

    <nav class="side-navbar">
        <a href="#" class="sidebar-menu-close">Close</a>

       {{ Navigation::init() }}
    </nav>

    <div class="page">
       <main>
           <div class="row">
               <div class="col-lg-7">
                   <h1>@yield('title')</h1>
               </div>

               @hasSection('navigation')
                   <div class="col-lg-5 mb-4 mb-lg-0 text-lg-right">
                       @yield('navigation')
                   </div>
               @endif
           </div>

       @yield('content')
   </main>
</div>

@include('sweetalert::alert')
</body>
</html>
