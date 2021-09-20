@extends('admin::admin')

@section('title', __('core::general.roles'))

@section('navigation')

    {{ Button::add(['admin.role.show', request('guard')]) }}

@endsection

@section('content')

    {{ $data->render() }}

@endsection
