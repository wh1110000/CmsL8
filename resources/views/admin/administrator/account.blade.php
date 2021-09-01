@extends('admin::admin')

@section('title', __('administrators::general.my_account'))

@section('content')

    {{ Form::model(auth()->user(), ['route' => 'admin.account.save', 'method' => 'POST']) }}

        {{ Form::fields() }}

    {{ Form::close() }}

@endsection

