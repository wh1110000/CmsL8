@extends('admin::default')

@section('title',  $post->exists ? '- '.$post->getTitle() : '')
