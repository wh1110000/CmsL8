@extends('admin::translate')

@section('title', __('cms::general.'.($post->getType() ?: 'internal') ). ($post->exists ? ' - ' . $post->getTitle() : ''))

@section('navigation')

    {{ Button::back(['admin.page.index']) }}

    @if($post->exists)

       {{ Button::add(['admin.page.show', 'type' => 'internal'] ) }}

       {{ Button::add(['admin.page.show', 'type' => 'external'] ) }}

    @endif

@endsection

@section('content')

    {{ Form::model($post) }}

       {{  Form::fields() }}

    {{ Form::close() }}

@endsection