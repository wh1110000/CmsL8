@extends('admin::admin')

@section('title', __('core::general.permissions') )

@section('navigation')

    {{ Button::add(['admin.permission.show', request('guard')]) }}

@endsection

@section('content')

    {{ $data->render() }}

@endsection
