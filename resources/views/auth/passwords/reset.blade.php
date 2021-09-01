@extends('admin::auth')

@section('title', 'Reset')

@section('content')

    {{ Form::open(['route' => 'admin.auth.password.update']) }}

        {{ Fields::hidden('token')->value($token)->add() }}

        {{ Fields::email('email')->add() }}

        {{ Fields::password('password')->add() }}

        {{ Fields::password('password_confirmation')->add() }}

    {{ Form::close(__('Reset Password')) }}

@endsection
