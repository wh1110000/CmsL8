@extends('admin::admin')

@section('title', __('core::general.media'))

@section('navigation')

    {{ Button::back('admin.media.index') }}

@endsection

@section('content')

    <style>
        .dropzone {
            border: 2px dashed #0087F7;
            border-radius: 5px;
            background: white;
        }
    </style>

    {{ Form::open(['url' => route('admin.media.upload-files') , 'method' => 'POST', 'files' => true, 'class' => 'dropzone']) }}

    {{ Form::close(false) }}

@endsection
