@extends('admin::admin')

@section('title', __('cms::general.permissions') )

@section('navigation')

    {{ Button::add(['admin.permission.show', request('guard')]) }}

@endsection

@section('content')

    {{ $data->render() }}

@endsection
