@extends('admin::default')

@section('title', __('core::general.countries'))

@section('navigation')

    {{ \Button::edit(['admin.country.manage'], true, false)->modal()->label('Manage Active Countries')->render() }}

@endsection