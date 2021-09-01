@extends('website::website')

@section('content')

    <h2>{{ $page->getTitle() }}</h2>

    {!! $page->getContent() !!}

@endsection
