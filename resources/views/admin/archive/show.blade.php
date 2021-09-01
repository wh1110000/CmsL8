@extends('admin::default')

@section('title', app('DoctrineInflector')->singularize($repository->model->getPostTypeLabel()) . ( $post->exists ? '- '.$post->getTitle() : ''))
