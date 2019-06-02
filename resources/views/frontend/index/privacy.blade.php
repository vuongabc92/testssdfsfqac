@extends('frontend.layouts._layout')

@section('title')
    - Privacy policy
@stop

@section('link_style')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/page.css') }}">
@stop

@section('inline_style')
    <style>
        .page-term.page-container {
            max-width: 100%;
            background: #f4f4f4;
        }
        .page-term .page-inside {
            width: 70%;
            margin: 40px auto;
        }
        .page-term .page-content {
            margin-bottom: 40px;
            padding: 50px;
            background-color: #fff;
            border: solid 1px #ddd;
            border-radius: 5px;
            -webkit-border-radius: 5px;
        }
        .page-updated-at {
            padding-bottom: 10px;
            margin-bottom: 20px;
            border-bottom: solid 1px #ddd;
        }
    </style>
@stop

@section('body')
<div class="_fwfl">
    <div class="_fwfl page-term page-container">
        <div class="page-inside">
            <h3 class="_fwfl _mb10">{{ $page->title }}</h3>
            <div class="_fwfl page-content">
                <span class="_fwfl page-updated-at"><strong>Updated {{ $page->updated_at->format('M d, Y') }}</strong></span>
                {!! $page->content !!}
            </div>
        </div>
    </div>
</div>
@stop