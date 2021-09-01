@extends('admin::default')

@section('navigation')

    {{ Button::add('admin.shop.show') }}

    {{ Button::back('admin.shop.index') }}

@endsection

@section('content')


    <div class="pt-4">

        @yield('tab')

    </div>

@endsection
