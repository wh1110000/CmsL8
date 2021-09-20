@extends('admin::default')

@section('title', __('core::general.shops'))

@section('navigation')

    {{ Button::add('admin.shop.show') }}

@endsection

@section('content')

    {{ $data->render() }}

@endsection