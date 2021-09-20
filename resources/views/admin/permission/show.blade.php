@extends('admin::translate')

@section('title', __('core::general.permission'))

@section('navigation')

    {{ Button::back(['admin.permission.index', request('guard')]) }}

    {{ Button::add(['admin.permission.show', request('guard')], $post->exists) }}

@endsection

@section('content')

    {{ Form::model($post, ['route' => ['admin.permission.save', request('guard'), $post]]) }}

        {{ Form::fields() }}

    {{ Form::close() }}

@endsection
