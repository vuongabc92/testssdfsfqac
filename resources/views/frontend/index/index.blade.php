@extends('frontend.layouts._layout')

@section('link_style')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/theme-tree.css') }}">
@stop

@section('body')
<div class="_fwfl magic-show">
    @if ( ! auth()->check())
        @if($page)
            <div class="_fwfl home-hero enrique">
                <div class="enrique-inside">
                    <div class="enrique-copy">
                        <h1 class="enrique-heading">{{ $page->title }}</h1>
                        <p class="enrique-text">{{ $page->page_slogan }}</p>
                        <a class="btn _btn _btn-gray" href="{{ route('front_register') }}">{{ _t('register') }}</a>
                    </div>
                    <img class="enrique-img" src="{{ asset("uploads/pages/{$page->banner}") }}" />
                 </div>
            </div>
        @endif
    @endif
    <div class="_fwfl themes-wrapper">
        <div class="_fwfl themes-inside">
            @if($themes->count())
                <ol class="_lsn _p0 _m0 theme-tree" @if (auth()->check()) data-go-lazy data-current="0" data-url="{{ route('front_themes_lazy') }}" @endif data-theme-details>
                    @include('frontend.settings.theme-item')
                </ol>
            @endif
            
            @if ($isPaging) 
            <div class="_fwfl text-center loadmore-wrap">
                <div class="_fwfl">
                    <span class="loading-more">Loading more...</span>
                </div>
                <div class="_fwfl">
                    @if (auth()->check())
                        <a href="#" class="load-more-btn" data-load-more data-target=".theme-tree">{{ _t('load_more') }}</a>
                    @else
                        <a href="{{ route('front_login') }}" class="load-more-btn">{{ _t('load_more') }}</a>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@include('frontend.inc.popup-theme-details')
@stop