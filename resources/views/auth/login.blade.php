@extends('admin::auth')

@section('title', 'Admin Login')

@section('content')

    {{ Form::open(['route' => 'admin.auth.login']) }}

        {{ Fields::email('email')->add() }}

        {{ Fields::password('password')->add() }}

        {{ Form::submit(__('Login')) }}

        {{ Button::label(__('Forgot Your Password?'))->visible(Route::has('admin.auth.password.request'))->route('admin.auth.password.request')->render()}}

    {{ Form::close(false) }}

@endsection
