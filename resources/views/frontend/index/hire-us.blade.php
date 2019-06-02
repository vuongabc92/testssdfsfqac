@extends('frontend.layouts._layout')

@section('title')
    - Hide us
@stop

@section('link_style')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/page.css') }}">
@stop

@section('body')
    <div class="_fwfl">
        <div class="_fwfl page-hero contact-page enrique">
            <div class="enrique-inside">
                <div class="enrique-copy">
                    <h1>{{ $page->title }}</h1>
                    <p>{{ $page->page_slogan }}</p>
                </div>
                <img class="enrique-img" src="{{ asset("uploads/pages/{$page->banner}") }}" />
            </div>
        </div>

        <div class="page-container">
            <div class="_fwfl page-inside">
                <div class="_fwfl page-content">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
@stop