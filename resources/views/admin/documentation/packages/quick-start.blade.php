@extends('admin::admin')

@section('title', __('core::general.documentation'))

@section('navigation')

    {{ Button::back('admin.documentation.index') }}

@endsection

@section('content')

    <style>
        code {
            background: #222;
            color: #fff;
            font-size: 14px;
            font-weight: bold;
            font-family: Consolas, Monaco, 'Andale Mono', 'Ubuntu Mono', monospace;
            padding: 2px 8px;
            padding-top: 4px;
            display: inline-block;
        }

        .btn, a.btn {
            -webkit-transition: all 0.4s ease-in-out;
            -moz-transition: all 0.4s ease-in-out;
            -ms-transition: all 0.4s ease-in-out;
            -o-transition: all 0.4s ease-in-out;
            font-weight: 600;
            font-size: 14px;
            line-height: 1.5;
        }

        .btn .svg-inline--fa, a.btn .svg-inline--fa {
            margin-right: 5px;
            position: relative;
            top: -1px;
        }

        .btn-primary, a.btn-primary {
            background: #40babd;
            border: 1px solid #40babd;
            color: #fff !important;
        }

        .btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .btn-primary.hover, a.btn-primary:hover, a.btn-primary:focus, a.btn-primary:active, a.btn-primary.active, a.btn-primary.hover {
            background: #3aa7aa;
            color: #fff !important;
            border: 1px solid #3aa7aa;
        }

        .btn-green, a.btn-green {
            background: #75c181;
            border: 1px solid #75c181;
            color: #fff !important;
        }

        .btn-green:hover, .btn-green:focus, .btn-green:active, .btn-green.active, .btn-green.hover, a.btn-green:hover, a.btn-green:focus, a.btn-green:active, a.btn-green.active, a.btn-green.hover {
            background: #63b971;
            color: #fff !important;
            border: 1px solid #63b971;
        }

        .body-green .btn-green, .body-green a.btn-green {
            color: #fff !important;
        }

        .body-green .btn-green:hover, .body-green .btn-green:focus, .body-green .btn-green:active, .body-green .btn-green.active, .body-green .btn-green.hover, .body-green a.btn-green:hover, .body-green a.btn-green:focus, .body-green a.btn-green:active, .body-green a.btn-green.active, .body-green a.btn-green.hover {
            color: #fff !important;
        }

        .btn-blue, a.btn-blue {
            background: #58bbee;
            border: 1px solid #58bbee;
            color: #fff !important;
        }

        .btn-blue:hover, .btn-blue:focus, .btn-blue:active, .btn-blue.active, .btn-blue.hover, a.btn-blue:hover, a.btn-blue:focus, a.btn-blue:active, a.btn-blue.active, a.btn-blue.hover {
            background: #41b2ec;
            color: #fff !important;
            border: 1px solid #41b2ec;
        }

        .btn-orange, a.btn-orange {
            background: #F88C30;
            border: 1px solid #F88C30;
            color: #fff !important;
        }

        .btn-orange:hover, .btn-orange:focus, .btn-orange:active, .btn-orange.active, .btn-orange.hover, a.btn-orange:hover, a.btn-orange:focus, a.btn-orange:active, a.btn-orange.active, a.btn-orange.hover {
            background: #f77e17;
            color: #fff !important;
            border: 1px solid #f77e17;
        }

        .btn-red, a.btn-red {
            background: #f77b6b;
            border: 1px solid #f77b6b;
            color: #fff !important;
        }

        .btn-red:hover, .btn-red:focus, .btn-red:active, .btn-red.active, .btn-red.hover, a.btn-red:hover, a.btn-red:focus, a.btn-red:active, a.btn-red.active, a.btn-red.hover {
            background: #f66553;
            color: #fff !important;
            border: 1px solid #f66553;
        }

        .btn-pink, a.btn-pink {
            background: #EA5395;
            border: 1px solid #EA5395;
            color: #fff !important;
        }

        .btn-pink:hover, .btn-pink:focus, .btn-pink:active, .btn-pink.active, .btn-pink.hover, a.btn-pink:hover, a.btn-pink:focus, a.btn-pink:active, a.btn-pink.active, a.btn-pink.hover {
            background: #e73c87;
            color: #fff !important;
            border: 1px solid #e73c87;
        }

        .btn-purple, a.btn-purple {
            background: #8A40A7;
            border: 1px solid #8A40A7;
            color: #fff !important;
        }

        .btn-purple:hover, .btn-purple:focus, .btn-purple:active, .btn-purple.active, .btn-purple.hover, a.btn-purple:hover, a.btn-purple:focus, a.btn-purple:active, a.btn-purple.active, a.btn-purple.hover {
            background: #7b3995;
            color: #fff !important;
            border: 1px solid #7b3995;
        }

        .btn-cta {
            padding: 7px 15px;
        }

        .search-btn {
            height: 40px;
        }

        .search-btn .svg-inline--fa {
            top: 0;
            margin-right: 0;
        }

        .form-control {
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            box-shadow: none;
            height: 40px;
            border-color: #f0f0f0;
        }

        .form-control::-webkit-input-placeholder {
            /* WebKit browsers */
            color: #afb3bb;
        }

        .form-control:-moz-placeholder {
            /* Mozilla Firefox 4 to 18 */
            color: #afb3bb;
        }

        .form-control::-moz-placeholder {
            /* Mozilla Firefox 19+ */
            color: #afb3bb;
        }

        .form-control:-ms-input-placeholder {
            /* Internet Explorer 10+ */
            color: #afb3bb;
        }

        .form-control:focus {
            border-color: #e3e3e3;
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            box-shadow: none;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="submit"],
        input[type="button"],
        textarea,
        select {
            appearance: none;
            /* for mobile safari */
            -webkit-appearance: none;
        }

        /* ====== Header ====== */
        .header {
            background: #494d55;
            color: rgba(255, 255, 255, 0.85);
            border-top: 5px solid #40babd;
            padding: 30px 0;
        }

        .header a {
            color: #fff;
        }

        .header .container {
            position: relative;
        }

        .branding {
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .branding .logo {
            font-size: 28px;
            margin-top: 0;
            margin-bottom: 0;
        }

        .branding .logo a {
            text-decoration: none;
        }

        .branding .text-highlight {
            color: #40babd;
        }

        .body-green .branding .text-highlight {
            color: #75c181;
        }

        .body-blue .branding .text-highlight {
            color: #58bbee;
        }

        .body-orange .branding .text-highlight {
            color: #F88C30;
        }

        .body-red .branding .text-highlight {
            color: #f77b6b;
        }

        .body-pink .branding .text-highlight {
            color: #EA5395;
        }

        .body-purple .branding .text-highlight {
            color: #8A40A7;
        }

        .branding .text-bold {
            font-weight: 800;
            color: #fff;
        }

        .branding .icon {
            font-size: 24px;
            color: #40babd;
        }

        .body-green .branding .icon {
            color: #75c181;
        }

        .body-blue .branding .icon {
            color: #58bbee;
        }

        .body-orange .branding .icon {
            color: #F88C30;
        }

        .body-red .branding .icon {
            color: #f77b6b;
        }

        .body-pink .branding .icon {
            color: #EA5395;
        }

        .body-purple .branding .icon {
            color: #8A40A7;
        }

        .breadcrumb {
            background: none;
            margin-bottom: 0;
            padding: 0;
        }

        .breadcrumb li {
            color: rgba(255, 255, 255, 0.5);
        }

        .breadcrumb li.active {
            color: rgba(255, 255, 255, 0.5);
        }

        .breadcrumb li a {
            color: rgba(255, 255, 255, 0.5);
        }

        .breadcrumb li a:hover {
            color: #fff;
        }

        .breadcrumb > li + li:before {
            color: rgba(0, 0, 0, 0.4);
        }

        .search-form {
            position: relative;
        }

        .search-form .search-input {
            font-size: 14px;
            -webkit-border-radius: 20px;
            -moz-border-radius: 20px;
            -ms-border-radius: 20px;
            -o-border-radius: 20px;
            border-radius: 20px;
            -moz-background-clip: padding;
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
            padding-top: 4px;
        }

        .search-form .search-input:focus {
            border-color: #616670;
        }

        .search-form .search-btn {
            color: #797f8b;
            background: none;
            border: none;
            position: absolute;
            right: 5px;
            top: 0px;
            margin-right: 0;
        }

        .search-form .search-btn:active, .search-form .search-btn:focus, .search-form .search-btn:hover {
            outline: none !important;
            color: #31343a;
        }

        .top-search-box {
            position: absolute;
            right: 15px;
            top: 15px;
        }

        /* ====== Footer ====== */
        .footer {
            background: #26282c;
            color: rgba(255, 255, 255, 0.6);
            padding: 15px 0;
        }

        .footer a {
            color: #40babd;
        }

        .footer .fa-heart {
            color: #EA5395;
        }

        @media (max-width: 575.98px) {
            .top-search-box {
                width: 100%;
                position: static;
                margin-top: 15px;
            }
        }

        /* ======= Doc Styling ======= */
        .doc-wrapper {
            padding: 45px 0;
            background: #f9f9fb;
        }

        .doc-body {
            position: relative;
        }

        .doc-header {
            margin-bottom: 30px;
        }

        .doc-header .doc-title {
            color: #40babd;
            margin-top: 0;
            font-size: 36px;
        }

        .body-green .doc-header .doc-title {
            color: #75c181;
        }

        .body-blue .doc-header .doc-title {
            color: #58bbee;
        }

        .body-orange .doc-header .doc-title {
            color: #F88C30;
        }

        .body-red .doc-header .doc-title {
            color: #f77b6b;
        }

        .body-pink .doc-header .doc-title {
            color: #EA5395;
        }

        .body-purple .doc-header .doc-title {
            color: #8A40A7;
        }

        .doc-header .icon {
            font-size: 30px;
        }

        .doc-header .meta {
            color: #a2a6af;
        }

        .doc-section {
            padding-top: 15px;
            padding-bottom: 15px;
        }

        .doc-section .section-title {
            font-size: 26px;
            margin-top: 0;
            margin-bottom: 0;
            font-weight: bold;
            padding-bottom: 10px;
            border-bottom: 1px solid #d7d6d6;
        }

        .doc-section h1 {
            font-size: 24px;
            font-weight: bold;
        }

        .doc-section h2 {
            font-size: 22px;
            font-weight: bold;
        }

        .doc-section h3 {
            font-size: 20px;
            font-weight: bold;
        }

        .doc-section h4 {
            font-size: 18px;
            font-weight: bold;
        }

        .doc-section h5 {
            font-size: 16px;
            font-weight: bold;
        }

        .doc-section h6 {
            font-size: 14px;
            font-weight: bold;
        }

        .section-block {
            padding-top: 15px;
            padding-bottom: 15px;
        }

        .section-block .block-title {
            margin-top: 0;
        }

        .section-block .list > li {
            margin-bottom: 10px;
        }

        .section-block .list ul > li {
            margin-top: 5px;
        }

        .question {
            font-weight: 400 !important;
            color: #3aa7aa;
        }

        .question .body-green {
            color: #63b971;
        }

        .body-blue .question {
            color: #41b2ec;
        }

        .body-orange .question {
            color: #f77e17;
        }

        .body-pink .question {
            color: #e73c87;
        }

        .body-purple .question {
            color: #7b3995;
        }

        .question .svg-inline--fa {
            -webkit-opacity: 0.6;
            -moz-opacity: 0.6;
            opacity: 0.6;
            position: relative;
            top: -2px;
        }

        .question .badge {
            font-size: 11px;
            vertical-align: middle;
        }

        .answer {
            color: #616670;
        }

        .code-block {
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .callout-block {
            padding: 30px;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            -ms-border-radius: 4px;
            -o-border-radius: 4px;
            border-radius: 4px;
            -moz-background-clip: padding;
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
            position: relative;
            margin-bottom: 30px;
        }

        .callout-block a {
            color: rgba(0, 0, 0, 0.55) !important;
        }

        .callout-block a:hover {
            color: rgba(0, 0, 0, 0.65) !important;
        }

        .callout-block .icon-holder {
            font-size: 30px;
            position: absolute;
            left: 30px;
            top: 30px;
            color: rgba(0, 0, 0, 0.25);
        }

        .callout-block .content {
            margin-left: 60px;
        }

        .callout-block .content p:last-child {
            margin-bottom: 0;
        }

        .callout-block .callout-title {
            margin-top: 0;
            margin-bottom: 5px;
            color: rgba(0, 0, 0, 0.65);
        }

        .callout-info {
            background: #58bbee;
            color: #fff;
        }

        .callout-success {
            background: #75c181;
            color: #fff;
        }

        .callout-warning {
            background: #F88C30;
            color: #fff;
        }

        .callout-danger {
            background: #f77b6b;
            color: #fff;
        }

        .table > thead > tr > th {
            border-bottom-color: #8bd6d8;
        }

        .body-green .table > thead > tr > th {
            border-bottom-color: #bbe1c1;
        }

        .body-blue .table > thead > tr > th {
            border-bottom-color: #b5e1f7;
        }

        .body-orange .table > thead > tr > th {
            border-bottom-color: #fbc393;
        }

        .body-pink .table > thead > tr > th {
            border-bottom-color: #f5aecd;
        }

        .body-purple .table > thead > tr > th {
            border-bottom-color: #b87fce;
        }

        .table-bordered > thead > tr > th {
            border-bottom-color: inherit;
        }

        .table-striped > tbody > tr:nth-of-type(odd) {
            background-color: #f5f5f5;
        }

        .screenshot-holder {
            margin-top: 15px;
            margin-bottom: 15px;
            position: relative;
            text-align: center;
        }

        .screenshot-holder img {
            border: 1px solid #f0f0f0;
        }

        .screenshot-holder .mask {
            display: block;
            visibility: hidden;
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            background: rgba(0, 0, 0, 0.25);
            cursor: pointer;
            text-decoration: none;
        }

        .screenshot-holder .mask .svg-inline--fa {
            color: #fff;
            font-size: 42px;
            display: block;
            position: absolute;
            left: 50%;
            top: 50%;
            margin-left: -21px;
            margin-top: -21px;
        }

        .screenshot-holder:hover .mask {
            visibility: visible;
        }

        .jumbotron h1 {
            font-size: 28px;
            margin-top: 0;
            margin-bottom: 30px;
        }

        .author-profile {
            margin-top: 30px;
        }

        .author-profile img {
            width: 100px;
            height: 100px;
        }

        .speech-bubble {
            background: #fff;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            -ms-border-radius: 4px;
            -o-border-radius: 4px;
            border-radius: 4px;
            -moz-background-clip: padding;
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
            padding: 30px;
            margin-top: 20px;
            margin-bottom: 30px;
            position: relative;
        }

        .speech-bubble .speech-title {
            font-size: 16px;
        }

        .jumbotron .speech-bubble p {
            font-size: 14px;
            font-weight: normal;
            color: #616670;
        }

        .speech-bubble:before {
            content: "";
            display: inline-block;
            position: absolute;
            left: 50%;
            top: -10px;
            margin-left: -10px;
            width: 0;
            height: 0;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-bottom: 10px solid #fff;
        }

        .theme-card {
            text-align: center;
            border: 1px solid #e3e3e3;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            -ms-border-radius: 4px;
            -o-border-radius: 4px;
            border-radius: 4px;
            -moz-background-clip: padding;
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
            position: relative;
            height: 100%;
        }

        .theme-card .card-block {
            padding: 15px;
        }

        .theme-card .mask {
            display: block;
            visibility: hidden;
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            background: rgba(0, 0, 0, 0.25);
            cursor: pointer;
            text-decoration: none;
        }

        .theme-card .mask .icon {
            color: #fff;
            font-size: 42px;
            margin-top: 25%;
        }

        .theme-card:hover .mask {
            visibility: visible;
        }

        /* Color Schemes */
        .body-green .header {
            border-color: #75c181;
        }

        .body-green a {
            color: #75c181;
        }

        .body-green a:hover {
            color: #52b161;
        }

        .body-blue .header {
            border-color: #58bbee;
        }

        .body-blue a {
            color: #58bbee;
        }

        .body-blue a:hover {
            color: #2aa8e9;
        }

        .body-orange .header {
            border-color: #F88C30;
        }

        .body-orange a {
            color: #F88C30;
        }

        .body-orange a:hover {
            color: #ed7108;
        }

        .body-pink .header {
            border-color: #EA5395;
        }

        .body-pink a {
            color: #EA5395;
        }

        .body-pink a:hover {
            color: #e42679;
        }

        .body-purple .header {
            border-color: #8A40A7;
        }

        .body-purple a {
            color: #8A40A7;
        }

        .body-purple a:hover {
            color: #6c3282;
        }

        .body-red .header {
            border-color: #f77b6b;
        }

        .body-red a {
            color: #f77b6b;
        }

        .body-red a:hover {
            color: #f4503b;
        }

        /* Sidebar */
        .doc-nav {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .sticky {
            position: -webkit-sticky;
            position: -moz-sticky;
            position: -ms-sticky;
            position: -o-sticky;
            position: sticky;
            top: 0;
        }

        .doc-menu {
            list-style: none;
        }

        .doc-menu .nav-link {
            margin-bottom: 5px;
            display: block;
            padding: 5px 15px;
            color: #616670;
        }

        .doc-menu .nav-link:hover, .doc-menu .nav-link:focus {
            color: #494d55;
            text-decoration: none;
            background: none;
        }

        .doc-menu .nav-link.active {
            background: none;
            color: #40babd;
            font-weight: 600;
        }

        .body-green .doc-menu .nav-link.active {
            color: #75c181;
            border-color: #75c181;
        }

        .body-blue .doc-menu .nav-link.active {
            color: #58bbee;
            border-color: #58bbee;
        }

        .body-orange .doc-menu .nav-link.active {
            color: #F88C30;
            border-color: #F88C30;
        }

        .body-red .doc-menu .nav-link.active {
            color: #f77b6b;
            border-color: #f77b6b;
        }

        .body-pink .doc-menu .nav-link.active {
            color: #EA5395;
            border-color: #EA5395;
        }

        .body-purple .doc-menu .nav-link.active {
            color: #8A40A7;
            border-color: #8A40A7;
        }

        .doc-sub-menu {
            list-style: none;
            padding-left: 0;
        }

        .doc-sub-menu .nav-link {
            margin-bottom: 10px;
            font-size: 12px;
            display: block;
            color: #616670;
            padding: 0;
            padding-left: 34px;
            background: none;
        }

        .doc-sub-menu .nav-link:first-child {
            padding-top: 5px;
        }

        .doc-sub-menu .nav-link:hover {
            color: #494d55;
            text-decoration: none;
            background: none;
        }

        .doc-sub-menu .nav-link:focus {
            background: none;
        }

        .doc-sub-menu .nav-link.active {
            background: none;
            color: #40babd;
        }

        .body-green .doc-sub-menu .nav-link.active {
            color: #75c181;
        }

        .body-blue .doc-sub-menu .nav-link.active {
            color: #58bbee;
        }

        .body-orange .doc-sub-menu .nav-link.active {
            color: #F88C30;
        }

        .body-red .doc-sub-menu .nav-link.active {
            color: #f77b6b;
        }

        .body-pink .doc-sub-menu .nav-link.active {
            color: #EA5395;
        }

        .body-purple .doc-sub-menu .nav-link.active {
            color: #8A40A7;
        }

        /* ===== Promo block ===== */
        .promo-block {
            background: #3aa7aa;
        }

        .body-green .promo-block {
            background: #63b971;
        }

        .body-blue .promo-block {
            background: #41b2ec;
        }

        .body-orange .promo-block {
            background: #f77e17;
        }

        .body-pink .promo-block {
            background: #e73c87;
        }

        .body-purple .promo-block {
            background: #7b3995;
        }

        .promo-block a {
            color: rgba(0, 0, 0, 0.6);
            font-weight: bold;
        }

        .promo-block a:hover {
            color: rgba(0, 0, 0, 0.7);
        }

        .promo-block .promo-block-inner {
            padding: 45px;
            color: #fff;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            -ms-border-radius: 4px;
            -o-border-radius: 4px;
            border-radius: 4px;
            -moz-background-clip: padding;
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
        }

        .promo-block .promo-title {
            font-size: 20px;
            font-weight: 800;
            margin-top: 0;
            margin-bottom: 45px;
        }

        .promo-block .promo-title .svg-inline--fa {
            color: rgba(0, 0, 0, 0.6);
        }

        .promo-block .figure-holder-inner {
            background: #fff;
            margin-bottom: 30px;
            position: relative;
            text-align: center;
        }

        .promo-block .figure-holder-inner img {
            border: 5px solid #fff;
        }

        .promo-block .figure-holder-inner .mask {
            display: block;
            visibility: hidden;
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            background: rgba(0, 0, 0, 0.7);
            cursor: pointer;
            text-decoration: none;
        }

        .promo-block .figure-holder-inner .mask .svg-inline--fa {
            color: #fff;
            font-size: 36px;
            display: inline-block;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-left: -18px;
            margin-top: -18px;
        }

        .promo-block .figure-holder-inner .mask .svg-inline--fa.pink {
            color: #EA5395;
        }

        .promo-block .figure-holder-inner:hover .mask {
            visibility: visible;
        }

        .promo-block .content-holder-inner {
            padding-left: 15px;
            padding-right: 15px;
        }

        .promo-block .content-title {
            font-size: 16px;
            font-weight: 600;
            margin-top: 0;
        }

        .promo-block .highlight {
            color: rgba(0, 0, 0, 0.6);
        }

        .promo-block .btn-cta {
            background: rgba(0, 0, 0, 0.35);
            border: none;
            color: #fff !important;
            margin-bottom: 15px;
        }

        .promo-block .btn-cta:hover {
            background: rgba(0, 0, 0, 0.5);
            border: none;
            color: #fff !important;
        }

        /* Extra small devices (phones, less than 768px) */
        @media (max-width: 767px) {
            .jumbotron {
                padding: 30px 15px;
            }
            .jumbotron h1 {
                font-size: 24px;
                margin-bottom: 15px;
            }
            .jumbotron p {
                font-size: 18px;
            }
            .promo-block .promo-block-inner {
                padding: 30px 15px;
            }
            .promo-block .content-holder-inner {
                padding: 0;
            }
            .promo-block .promo-title {
                margin-bottom: 30px;
            }
        }

        /* Small devices (tablets, 768px and up) */
        /* Medium devices (desktops, 992px and up) */
        /* Large devices (large desktops, 1200px and up) */
        .sticky {
            position: -webkit-sticky;
            position: sticky;
            top: 0;
        }

        .sticky:before,
        .sticky:after {
            content: '';
            display: table;
        }

        /* ======= Landing Page ======= */
        .landing-page .header {
            background: #494d55;
            color: rgba(255, 255, 255, 0.85);
            padding: 60px 0;
        }

        .landing-page .header a {
            color: #fff;
        }

        .landing-page .branding {
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .landing-page .branding .logo {
            font-size: 38px;
            margin-top: 0;
            margin-bottom: 0;
        }

        .landing-page .branding .text-bold {
            font-weight: 800;
            color: #fff;
        }

        .landing-page .branding .icon {
            font-size: 32px;
            color: #40babd;
        }

        .landing-page .tagline {
            font-weight: 600;
            font-size: 20px;
        }

        .landing-page .tagline p {
            margin-bottom: 5px;
        }

        .landing-page .tagline p:last-child {
            margin-bottom: 0;
        }

        .landing-page .tagline .text-highlight {
            color: #266f71;
        }

        .landing-page .fa-heart {
            color: #EA5395;
        }

        .landing-page .cta-container {
            margin-top: 30px;
        }

        .landing-page .social-container .twitter-tweet {
            display: inline-block;
            margin-right: 5px;
            position: relative;
            top: 5px;
        }

        .landing-page .social-container .fab-like {
            display: inline-block;
        }

        .cards-section {
            padding: 60px 0;
            background: #f9f9fb;
        }

        .cards-section .title {
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 24px;
            font-weight: 600;
        }

        .cards-section .intro {
            margin: 0 auto;
            max-width: 800px;
            margin-bottom: 60px;
            color: #616670;
        }

        .cards-section .cards-wrapper {
            max-width: 860px;
            margin-left: auto;
            margin-right: auto;
        }

        .cards-section .item {
            margin-bottom: 30px;
        }

        .cards-section .item .icon-holder {
            margin-bottom: 15px;
        }

        .cards-section .item .icon {
            font-size: 36px;
        }

        .cards-section .item .title {
            font-size: 16px;
            font-weight: 600;
        }

        .cards-section .item .intro {
            margin-bottom: 15px;
        }

        .cards-section .item-inner {
            padding: 45px 30px;
            background: #fff;
            position: relative;
            border: 1px solid #f0f0f0;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            -ms-border-radius: 4px;
            -o-border-radius: 4px;
            border-radius: 4px;
            -moz-background-clip: padding;
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
            height: 100%;
        }

        .cards-section .item-inner .link {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
            background-image: url("../images/empty.gif");
            /* for IE8 */
        }

        .cards-section .item-inner:hover {
            background: #f5f5f5;
        }

        .cards-section .item-primary .item-inner {
            border-top: 3px solid #40babd;
        }

        .cards-section .item-primary .item-inner:hover .title {
            color: #2d8284;
        }

        .cards-section .item-primary .icon {
            color: #40babd;
        }

        .cards-section .item-green .item-inner {
            border-top: 3px solid #75c181;
        }

        .cards-section .item-green .item-inner:hover .title {
            color: #48a156;
        }

        .cards-section .item-green .icon {
            color: #75c181;
        }

        .cards-section .item-blue .item-inner {
            border-top: 3px solid #58bbee;
        }

        .cards-section .item-blue .item-inner:hover .title {
            color: #179de2;
        }

        .cards-section .item-blue .icon {
            color: #58bbee;
        }

        .cards-section .item-orange .item-inner {
            border-top: 3px solid #F88C30;
        }

        .cards-section .item-orange .item-inner:hover .title {
            color: #d46607;
        }

        .cards-section .item-orange .icon {
            color: #F88C30;
        }

        .cards-section .item-red .item-inner {
            border-top: 3px solid #f77b6b;
        }

        .cards-section .item-red .item-inner:hover .title {
            color: #f33a22;
        }

        .cards-section .item-red .icon {
            color: #f77b6b;
        }

        .cards-section .item-pink .item-inner {
            border-top: 3px solid #EA5395;
        }

        .cards-section .item-pink .item-inner:hover .title {
            color: #d61a6c;
        }

        .cards-section .item-pink .icon {
            color: #EA5395;
        }

        .cards-section .item-purple .item-inner {
            border-top: 3px solid #8A40A7;
        }

        .cards-section .item-purple .item-inner:hover .title {
            color: #5c2b70;
        }

        .cards-section .item-purple .icon {
            color: #8A40A7;
        }

        @media (max-width: 575.98px) {
            .main-search-box {
                width: 100%;
            }
            .main-search-box .search-form .search-input {
                width: 100%;
            }
        }

        @media (max-width: 767.98px) {
            .cards-section .item-inner {
                padding: 30px 15px;
            }
        }

        @media (min-width: 576px) {
            .main-search-box .search-form .search-input {
                width: 400px;
            }
        }

        @media (min-width: 768px) {
            .main-search-box .search-form .search-input {
                width: 560px;
            }
        }
    </style>

    <!-- ******Header****** -->

    <div class="doc-wrapper">
        <div class="container">
            <div id="doc-header" class="doc-header text-center">
                <h1 class="doc-title"><i class="icon fa fa-paper-plane"></i> Quick Start</h1>

                <div class="meta"><i class="far fa-clock"></i> Last updated: July 18th, 2018</div>
            </div><!--//doc-header-->

            <div class="doc-body row">
                <div class="doc-content col-md-9 col-12 order-1">
                    <div class="content-inner">
                        <section id="download-section" class="doc-section">
                            <h2 class="section-title">Download</h2>

                            <div class="section-block">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nec imperdiet turpis. Curabitur aliquet pulvinar ultrices. Etiam at posuere leo. Proin ultrices ex et dapibus feugiat <a href="#">link example</a> aenean purus leo, faucibus at elit vel, aliquet scelerisque dui. Etiam quis elit euismod, imperdiet augue sit amet, imperdiet odio. Aenean sem erat, hendrerit  eu gravida id, dignissim ut ante. Nam consequat porttitor libero euismod congue.</p>

                                <a href="https://themes.3rdwavemedia.com/bootstrap-templates/startup/prettydocs-free-bootstrap-theme-for-developers-and-startups/" class="btn btn-green" target="_blank"><i class="fas fa-download"></i> Download PrettyDocs</a>
                            </div>
                        </section><!--//doc-section-->

                        <section id="installation-section" class="doc-section">
                            <h2 class="section-title">Installation</h2>

                            <div id="step1"  class="section-block">
                                <h3 class="block-title">Step One</h3>

                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis.</p>

                                <div class="code-block">
                                    <h6>Default code example:</h6>
                                    <p><code>bower install &lt;package&gt;</code></p>
                                    <p><code>npm install &lt;package&gt;</code></p>
                                </div><!--//code-block-->
                            </div><!--//section-block-->

                            <div id="step2"  class="section-block">
                                <h3 class="block-title">Step Two</h3>

                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p>

                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <h6>Un-ordered list example</h6>

                                        <ul class="list">
                                            <li>Lorem ipsum dolor sit amet.</li>
                                            <li>Aliquam tincidunt mauris.</li>
                                            <li>Ultricies eget vel aliquam libero.
                                                <ul>
                                                    <li>Turpis pulvinar</li>
                                                    <li>Feugiat scelerisque</li>
                                                    <li>Ut tincidunt</li>
                                                </ul>
                                            </li>
                                            <li>Pellentesque habitant morbi.</li>
                                            <li>Praesent dapibus, neque id.</li>
                                        </ul>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <h6>Ordered list example</h6>

                                        <ol class="list">
                                            <li>Lorem ipsum dolor sit amet.</li>
                                            <li>Aliquam tincidunt mauris.</li>
                                            <li>Ultricies eget vel aliquam libero.
                                                <ul>
                                                    <li>Turpis pulvinar</li>
                                                    <li>Feugiat scelerisque</li>
                                                    <li>Ut tincidunt</li>
                                                </ul>
                                            </li>
                                            <li>Pellentesque habitant morbi.</li>
                                            <li>Praesent dapibus, neque id.</li>
                                        </ol>
                                    </div>
                                </div><!--//row-->
                            </div><!--//section-block-->

                            <div id="step3"  class="section-block">
                                <h3 class="block-title">Step Three</h3>

                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis.</p>
                            </div><!--//section-block-->
                        </section><!--//doc-section-->

                        <section id="code-section" class="doc-section">
                            <h2 class="section-title">Code</h2>

                            <div class="section-block">
                                <p><a href="https://prismjs.com/" target="_blank">PrismJS</a> is used as the syntax highlighter here. You can <a href="https://prismjs.com/download.html" target="_blank">build your own version</a> via their website should you need to.</p>
                            </div><!--//section-block-->

                            <div id="html" class="section-block">
                                <div class="callout-block callout-success">
                                    <div class="icon-holder">
                                        <i class="fas fa-thumbs-up"></i>
                                    </div><!--//icon-holder-->

                                    <div class="content">
                                        <h4 class="callout-title">Useful Tip:</h4>

                                        <p>You can use this online <a href="https://mothereff.in/html-entities" target="_blank">HTML entity encoder/decoder</a> to generate your code examples.</p>
                                    </div><!--//content-->
                                </div>

                                <div class="code-block">
                                    <h6>HTML Code Example</h6>

                                    <pre><code class="language-markup"></code></pre>
                                </div><!--//code-block-->
                            </div><!--//section-block-->

                            <div id="css" class="section-block">
                                <div class="code-block">
                                    <h6>CSS Code Example</h6>

                                    <pre><code class="language-css"></code></pre>
                                </div><!--//code-block-->
                            </div><!--//section-block-->

                            <div id="sass" class="section-block">
                                <div class="code-block">
                                    <h6>SCSS Code Example</h6>

                                    <pre><code class="language-css"></code></pre>
                                </div><!--//code-block-->
                            </div><!--//section-block-->

                            <div id="less" class="section-block">
                                <div class="code-block">
                                    <h6>LESS Code Example</h6>

                                    <pre><code class="language-css">Test</code></pre>
                                </div><!--//code-block-->
                            </div><!--//section-block-->

                            <div id="javascript" class="section-block">
                                <div class="code-block">
                                    <h6>JavaScript Code Example</h6>

                                    <pre></pre>
                                </div><!--//code-block-->
                            </div><!--//section-block-->

                            <div id="python" class="section-block">
                                <div class="code-block">
                                    <h6>Python Code Example</h6>

                                    <pre><code class="language-python">... More</code></pre>
                                </div><!--//code-block-->
                            </div><!--//section-block-->

                            <div id="php" class="section-block">
                                <div class="code-block">
                                    <h6>PHP Code Example</h6>

                                    <pre><code class="language-php"></code></pre>
                                </div><!--//code-block-->
                            </div><!--//section-block-->

                            <div id="handlebars" class="section-block">
                                <div class="code-block">
                                    <h6>Handlebars Code Example</h6>

                                    <pre><code class="language-handlebars"></code></pre>
                                </div><!--//code-block-->

                                <div class="code-block">
                                    <h6>Git Code Example</h6>

                                    <pre><code class="language-git">$ git add Documentation.txt</code></pre>
                                </div><!--//code-block-->
                            </div><!--//section-block-->
                        </section><!--//doc-section-->

                        <section id="callouts-section" class="doc-section">
                            <h2 class="section-title">Callouts</h2>

                            <div class="section-block">
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p>
                            </div>

                            <div class="section-block">
                                <div class="callout-block callout-info">
                                    <div class="icon-holder">
                                        <i class="fas fa-info-circle"></i>
                                    </div><!--//icon-holder-->

                                    <div class="content">
                                        <h4 class="callout-title">Aenean imperdiet</h4>

                                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium <code>&lt;code&gt;</code> , Nemo enim ipsam voluptatem quia voluptas <a href="#">link example</a> sit aspernatur aut odit aut fugit.</p>
                                    </div><!--//content-->
                                </div><!--//callout-block-->

                                <div class="callout-block callout-warning">
                                    <div class="icon-holder">
                                        <i class="fas fa-bug"></i>
                                    </div><!--//icon-holder-->

                                    <div class="content">
                                        <h4 class="callout-title">Morbi posuere</h4>

                                        <p>Nunc hendrerit odio quis dignissim efficitur. Proin ut finibus libero. Morbi posuere fringilla felis eget sagittis. Fusce sem orci, cursus in tortor <a href="#">link example</a> tellus vel diam viverra elementum.</p>
                                    </div><!--//content-->
                                </div><!--//callout-block-->

                                <div class="callout-block callout-success">
                                    <div class="icon-holder">
                                        <i class="fas fa-thumbs-up"></i>
                                    </div><!--//icon-holder-->

                                    <div class="content">
                                        <h4 class="callout-title">Lorem ipsum dolor sit amet</h4>

                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. <a href="#">Link example</a> aenean commodo ligula eget dolor.</p>
                                    </div><!--//content-->
                                </div><!--//callout-block-->

                                <div class="callout-block callout-danger">
                                    <div class="icon-holder">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div><!--//icon-holder-->

                                    <div class="content">
                                        <h4 class="callout-title">Interdum et malesuada</h4>

                                        <p>Morbi eget interdum sapien. Donec sed turpis sed nulla lacinia accumsan vitae ut tellus. Aenean vestibulum <a href="#">Link example</a> maximus ipsum vel dignissim. Morbi ornare elit sit amet massa feugiat, viverra dictum ipsum pellentesque. </p>
                                    </div><!--//content-->
                                </div><!--//callout-block-->
                            </div>
                        </section><!--//doc-section-->

                        <section id="tables-section" class="doc-section">
                            <h2 class="section-title">Tables</h2>

                            <div class="section-block">
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis.</p>
                            </div>

                            <div class="section-block">
                                <h6>Basic Table</h6>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Username</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                            </tr>

                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Jacob</td>
                                                <td>Thornton</td>
                                                <td>@fat</td>
                                            </tr>

                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Larry</td>
                                                <td>the Bird</td>
                                                <td>@twitter</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div><!--//table-responsive-->

                                <h6>Striped Table</h6>

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Username</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                            </tr>

                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Jacob</td>
                                                <td>Thornton</td>
                                                <td>@fat</td>
                                            </tr>

                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Larry</td>
                                                <td>the Bird</td>
                                                <td>@twitter</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div><!--//table-responsive-->

                                <h6>Bordered Table</h6>

                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Username</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                            </tr>

                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Jacob</td>
                                                <td>Thornton</td>
                                                <td>@fat</td>
                                            </tr>

                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Larry</td>
                                                <td>the Bird</td>
                                                <td>@twitter</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div><!--//table-responsive-->
                            </div><!--//section-block-->
                        </section><!--//doc-section-->

                        <section id="buttons-section" class="doc-section">
                            <h2 class="section-title">Buttons</h2>

                            <div class="section-block">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nec imperdiet turpis. Curabitur aliquet pulvinar ultrices. Etiam at posuere leo. Proin ultrices ex et dapibus feugiat <a href="#">link example</a> aenean purus leo, faucibus at elit vel, aliquet scelerisque dui. Etiam quis elit euismod, imperdiet augue sit amet, imperdiet odio. Aenean sem erat, hendrerit  eu gravida id, dignissim ut ante. Nam consequat porttitor libero euismod congue.</p>

                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <h6>Basic Buttons</h6>

                                        <ul class="list list-unstyled">
                                            <li><a href="#" class="btn btn-primary">Primary Button</a></li>
                                            <li><a href="#" class="btn btn-green">Green Button</a></li>
                                            <li><a href="#" class="btn btn-blue">Blue Button</a></li>
                                            <li><a href="#" class="btn btn-orange">Orange Button</a></li>
                                            <li><a href="#" class="btn btn-red">Red Button</a></li>
                                        </ul>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <h6>CTA Buttons</h6>

                                        <ul class="list list-unstyled">
                                            <li><a href="#" class="btn btn-primary btn-cta"><i class="fas fa-download"></i> Download Now</a></li>
                                            <li><a href="#" class="btn btn-green btn-cta"><i class="fas fa-code-branch"></i> Fork Now</a></li>
                                            <li><a href="#" class="btn btn-blue btn-cta"><i class="fas fa-play-circle"></i> Find Out Now</a></li>
                                            <li><a href="#" class="btn btn-orange btn-cta"><i class="fas fa-bug"></i> Report Bugs</a></li>
                                            <li><a href="#" class="btn btn-red btn-cta"><i class="fas fa-exclamation-circle"></i> Submit Issues</a></li>
                                        </ul>
                                    </div>
                                </div><!--//row-->
                            </div><!--//section-block-->
                        </section><!--//doc-section-->

                        <section id="video-section" class="doc-section">
                            <h2 class="section-title">Video</h2>

                            <div class="section-block">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <h6>Responsive Video 16:9</h6>

                                        <!-- 16:9 aspect ratio -->
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/ejBkOjEG6F0?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <h6>Responsive Video 4:3</h6>

                                        <!-- 4:3 aspect ratio -->
                                        <div class="embed-responsive embed-responsive-4by3">
                                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/ejBkOjEG6F0?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div><!--//row-->
                            </div><!--//section-block-->

                            <section id="icons-section" class="doc-section">
                                <h2 class="section-title">Icons</h2>

                                <div class="section-block">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nec imperdiet turpis. Curabitur aliquet pulvinar ultrices. Etiam at posuere leo. Proin ultrices ex et dapibus feugiat <a href="#">link example</a> aenean purus leo, faucibus at elit vel, aliquet scelerisque dui. Etiam quis elit euismod, imperdiet augue sit amet, imperdiet odio. Aenean sem erat, hendrerit  eu gravida id, dignissim ut ante. Nam consequat porttitor libero euismod congue.</p>
                                </div><!--//section-block-->

                                <div class="section-block">
                                    <h6>Elegant Icon Font</h6>

                                    <a href="https://www.elegantthemes.com/blog/resources/elegant-icon-font" target="_blank"><img class="img-fluid" src="assets/images/demo/elegant-icon-font.jpg" alt="elegant icons" /></a>
                                </div><!--//section-block-->

                                <div class="section-block">
                                    <h6>FontAwesome Icon Font</h6>

                                    <a href="https://fortawesome.github.io/Font-Awesome/" target="_blank"><img class="img-fluid" src="assets/images/demo/fontawesome-icons.png" alt="fontawesome" /></a>
                                </div><!--//section-block-->
                            </section><!--//doc-section-->
                        </section><!--//doc-section-->
                    </div><!--//content-inner-->
                </div><!--//doc-content-->

                <div class="doc-sidebar col-md-3 col-12 order-0 d-none d-md-flex">
                    <div id="doc-nav" class="doc-nav">
                        <nav id="doc-menu" class="nav doc-menu flex-column sticky">
                            <a class="nav-link scrollto" href="#download-section">Download</a>
                            <a class="nav-link scrollto" href="#installation-section">Installation</a>

                            <nav class="doc-sub-menu nav flex-column">
                                <a class="nav-link scrollto" href="#step1">Step One</a>
                                <a class="nav-link scrollto" href="#step2">Step Two</a>
                                <a class="nav-link scrollto" href="#step3">Step Three</a>
                            </nav><!--//nav-->

                            <a class="nav-link scrollto" href="#code-section">Code</a>

                            <nav class="doc-sub-menu nav flex-column">
                                <a class="nav-link scrollto" href="#html">HTML</a>
                                <a class="nav-link scrollto" href="#css">CSS</a>
                                <a class="nav-link scrollto" href="#sass">Sass</a>
                                <a class="nav-link scrollto" href="#less">LESS</a>
                                <a class="nav-link scrollto" href="#javascript">JavaScript</a>
                                <a class="nav-link scrollto" href="#python">Python</a>
                                <a class="nav-link scrollto" href="#php">PHP</a>
                                <a class="nav-link scrollto" href="#handlebars">Handlebars</a>
                            </nav><!--//nav-->

                            <a class="nav-link scrollto" href="#callouts-section">Callouts</a>
                            <a class="nav-link scrollto" href="#tables-section">Tables</a>
                            <a class="nav-link scrollto" href="#buttons-section">Buttons</a>
                            <a class="nav-link scrollto" href="#video-section">Video</a>
                            <a class="nav-link scrollto" href="#icons-section">Icons</a>
                        </nav><!--//doc-menu-->
                    </div>
                </div><!--//doc-sidebar-->
            </div><!--//doc-body-->
        </div><!--//container-->
    </div><!--//doc-wrapper-->

@endsection
