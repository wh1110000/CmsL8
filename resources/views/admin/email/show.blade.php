@extends('admin.email::general')

@section('navigation')

    {{ Button::back(['admin.email.index', 'type' => request('type')]) }}

@endsection

@section('page')

    {{--<div class="float-right">
        <button class="btn btn-white btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mark as important"><i class="fa fa-exclamation"></i> </button>
        <button class="btn btn-white btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i> </button>
    </div>--}}

    <div class="small text-muted mb-4">
        <i class="fa fa-clock-o"></i> {{ $post->getDate('created_at') }}
    </div>

    <h5 class="mb-4">{{ $post->getFullName() }} - {{ $post->getEmail() }}</h5>

    <h1 class="mb-4">@if($post->important) <i class="fas fa-exclamation text-danger"></i> @endif {{ $post->getSubject() }}</h1>

    {{ $post->enquiry }}

    @if($post->data)

        <hr />

        @foreach($post->data as $label => $value)

            <div class="mb-4">{{ ucfirst($label) }}: {{ $value }}</div>

        @endforeach

    @endif

@endsection