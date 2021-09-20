@extends('admin::translate')

@section('title', __('core::general.administrator'))

@section('navigation')

    {{ Button::back('admin.administrator.index') }}

    {{ Button::add('admin.administrator.show', $post->exists) }}

@endsection

@section('content')

    {{ Form::model($post) }}

        {{ Form::fields() }}

    {{ Form::close() }}

@endsection

