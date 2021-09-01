@extends('admin::admin')

@section('title', __('pages::general.pages'))

@section('navigation')

    {{ Button::add(['admin.page.show', 'type' => 'internal'] ) }}

    {{ Button::add(['admin.page.show', 'type' => 'external'] ) }}

@endsection

@section('content')

    {{ $data->render() }}

@endsection
