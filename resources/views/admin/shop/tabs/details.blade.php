@extends('admin.shop::show')

@section('title', __('core::general.store_details'))

@section('tab')

    {{ Form::model($post, ['route' => ['admin.shop.save' , $post]]) }}

        {{ Form::fields() }}

    {{ Form::close() }}

@endsection