@extends('admin::translate')

@section('title', __('cms::general.role'))

@section('navigation')

    {{ Button::back(['admin.role.index', request('guard')]) }}

    {{ Button::add(['admin.role.show', request('guard')], $post->exists) }}

@endsection

@section('content')

    {{ Form::model($post, ['route' => ['admin.role.save', request('guard'), $post]]) }}

        {{ Form::fields() }}

    {{ Form::close() }}

@endsection
