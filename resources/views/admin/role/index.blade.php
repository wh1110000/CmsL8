@extends('admin::admin')

@section('title', __('cms::general.roles'))

@section('navigation')

    {{ Button::add(['admin.role.show', request('guard')]) }}

@endsection

@section('content')

    {{ $data->render() }}

@endsection
