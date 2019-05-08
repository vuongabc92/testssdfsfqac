{!! Form::open(['route' => 'front_register_post', 'method' => 'POST', 'class' => '_fwfl auth-form', 'id' => 'landingRegisterForm', 'data-required' => 'email|username|password']) !!}
<h1 class="_fwfl _m0 _p0 auth-form-title">{{ _t('register.joinus') }}</h1>
<div class="_fwfl outworld-auth auth-field-group first-field-group">
    <button type="button" class="btn _btn btn-fb" onclick="document.location.href='{{ $fbLoginUrl }}'"><span>{{ _t('login_with') }} </span>Facebook</button>
    <button type="button" class="btn _btn btn-google" onclick="document.location.href='{{ $googleLoginUrl }}'"><span>{{ _t('login_with') }} </span>Google</button>
    <span class="auth-or">Or</span>
</div>
<div class="_fwfl auth-field-group">
    <label class="_fwfl _fs14 _fwn _tg5" for="email">
        @if ($errors->has('email'))
            <span class="_tr5">{{ $errors->first('email') }}</span>
        @else
            {{ _t('common.email') }}
        @endif
    </label>
    <div class="_fwfl">
        {!! Form::text('email', '', ['class' => '_fwfl  _ff0 _r2 auth-field', 'id' => 'email', 'maxlength' => '128', 'autocomplete' => 'off']) !!}
    </div>
</div>
<div class="_fwfl auth-field-group">
    <label class="_fwfl _fs14 _fwn _tg5" for="username">
        @if ($errors->has('username'))
            <span class="_tr5">{{ $errors->first('username') }}</span>
        @else
            {{ _t('common.uname') }}<strong>|</strong><span class="_h320" id="slugToBeComplete" data-text-uname="USERNAME" data-url="{{ url('/') }}">{!! url('/') . '/' . '<strong>USERNAME</strong>' !!}</span>
        @endif
    </label>
    <div class="_fwfl">
        {!! Form::text('username', '', ['class' => '_fwfl  _ff0 _r2 auth-field register-user-autocomplete-slug', 'id' => 'username', 'maxlength' => '64', 'autocomplete' => 'off']) !!}
    </div>
</div>
<div class="_fwfl auth-field-group">
    <label class="_fwfl _fs14 _fwn _tg5" for="password">
        @if ($errors->has('password'))
            <span class="_tr5">{{ $errors->first('password') }}</span>
        @else
            {{ _t('common.pass') }}
        @endif

    </label>
    <div class="_fwfl">
        {!! Form::password('password', ['class' => '_ff0 _r2 _fwfl auth-field', 'id' => 'password', 'maxlength' => '60', 'autocomplete' => 'off']) !!}
    </div>
</div>
<div class="_fwfl _tg5 _fs13 auth-field-group">
    {!! _t('signup.agree', ['privacyUrl' => route('front_privacy_policy'), 'termsUrl' => route('front_terms_conditions')]) !!}
</div>
<div class="_fwfl auth-field-group">
    <button class="_fwfl btn _btn _btn-green auth-btn"><i class="fa fa-arrow-right"></i></button>
</div>
{!! Form::close() !!}