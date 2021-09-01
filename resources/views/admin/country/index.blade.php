@extends('admin::default')

@section('title', __('multilanguage::general.countries'))

@section('navigation')

    {{ \Button::edit(['admin.country.manage'], true, false)->modal()->label('Manage Active Countries')->render() }}

@endsection