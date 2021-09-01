@extends('admin::admin')

@section('title', __('multilanguage::general.languages'))

@section('navigation')

    {{ \Button::edit(['admin.language.manage'], config('app.translationby') == 'language', false)->modal()->label('Manage Active Languages')->render() }}

@endsection

@section('content')

    {{ $data->render() }}

@endsection
