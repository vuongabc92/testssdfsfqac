<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Octocv @yield('title')</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/frontend/images//apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/frontend/images/favicon/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/frontend/images/favicon/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/frontend/images/favicon/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/frontend/images/favicon/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/frontend/images/favicon/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/frontend/images/favicon/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/frontend/images/favicon/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/frontend/images/favicon/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('assets/frontend/images/favicon/android-icon-192x192.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/frontend/images/favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/frontend/images/favicon/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/frontend/images/favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('assets/frontend/images/favicon/manifest.json') }}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('assets/frontend/images/favicon/ms-icon-144x144.png') }}">
        <meta name="theme-color" content="#ffffff">
        <meta name="msapplication-tap-highlight" content="no"/>
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="ajax-error" content="{{ _t('oops') }}" />
        <!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/master.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/layout.css') }}">
        @yield('link_style')
        @yield('inline_style')
    </head>
    <body>
        <header class="_fwfl header">
            <div class="header-inside">
                <nav class="header-nav">
                    <a href="{{ url('/') }}" class="logo"><img src="{{ asset('assets/frontend/images/logo.png') }}" /> </a>
                    @if ( ! auth()->check())
                        <a href="{{ route('front_register') }}" class="_fr btn _btn _btn-green header-register-btn">{{ _t('register') }}</a>
                    @endif
                    <ul class="_fr _lsn _p0 _m0 navlist">
                        <li><a href="{{ route('front_hireus') }}"><span>{{ _t('hire_us') }}</span></a></li>

                        @if ( ! auth()->check())
                            <li><a href="{{ route('front_login') }}"><span>{{ _t('login') }}</span></a></li>
                            {{--<li><a href="{{ route('front_register') }}"><span>{{ _t('register') }}</span></a></li>--}}
                        @else
                            <li><a href="{{ route('front_logout') }}"><span>{{ _t('logout') }}</span></a></li>
                            <li><a href="{{ route('front_settings') }}"><img src="/{{ user()->userProfile->avatar() }}" class="_fl avatar" /></a></li>
                        @endif
                    </ul>
                    <button class="btn _btn _fr"><i class="fa fa-bars"></i></button>
                </nav>
            </div>
        </header>
        @if (auth()->check() && ! user()->email_verified_at && ! in_array(user()->login_provider, config('frontend.socialiteProvider')))
            <div class="_fwfl verify-email-bar">
                <span>{{ _t('setting.email.verify_msg') . user()->email }}. <a href="{{ route('verification.resend') }}">{{ _t('setting.email.verify_resend') }}</a> </span>
            </div>
        @endif

        @yield('body')

        <div class="alert alert-bar fade _dn" role="alert" id="alertBar">
            <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="container">
                <span class="_fs13 _fwb" id="alertText"></span>
            </div>
        </div>
        
        <script type="text/javascript" src="{{ asset('assets/frontend/js/jquery_v1.11.1.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/jquery-ui-1.11.4.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/popper.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/bootstrap4.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/bootstrap-switch.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/script.js') }}"></script>
        <script>
            @yield('script')
        </script>
    </body>
</html>