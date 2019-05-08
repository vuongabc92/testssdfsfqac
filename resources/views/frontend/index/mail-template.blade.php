<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style type="text/css">
        @font-face {
            font-family: 'Roboto Mono';
            font-style: normal;
            font-weight: 400;
            src: url("{{ asset('assets/frontend/fonts/roboto-mono/regular.woff2') }}") format('woff2'),
            url("{{ asset('assets/frontend/fonts/roboto-mono/regular.woff') }}") format('woff'),
            url("{{ asset('assets/frontend/fonts/roboto-mono/regular.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'Roboto Mono';
            font-style: normal;
            font-weight: 700;
            src: url("{{ asset('assets/frontend/fonts/roboto-mono/bold.woff2') }}") format('woff2'),
            url("{{ asset('assets/frontend/fonts/roboto-mono/bold.woff') }}") format('woff'),
            url("{{ asset('assets/frontend/fonts/roboto-mono/bold.ttf') }}") format('truetype');
        }
    </style>
</head>
<body style="width:100%;padding:0;margin:0;background-color:#eee;font-family:'Roboto Mono',monospace;font-size:16px;color:#333;">
<table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#eee">
    <tbody>
    <tr>
        <td>
            <table style="margin:0 auto;" width="520" cellspacing="0" cellpadding="0" border="0">
                <tbody>
                <tr>
                    <td style="width:100%;padding:20px;">
                        <table style="width:100%;float:left;" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                            <tr>
                                <td>
                                    <table width="100%" bgcolor="#fff" cellpadding="0" cellspacing="0" style="float:left;border:solid 1px #e9e9e9;border-radius:5px;-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px;">
                                        <tbody>
                                        <tr>
                                            <td align="center" style="padding-top:15px;padding-bottom:15px;border-bottom: solid 1px #eee;">
                                                <a href="{{ route('front_index') }}"><img src="{{ asset('assets/frontend/images/logo.png') }}" width="150px" /></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding:20px 20px 10px;">
                                                <p>{{ trans('mail.reset-password.hi') }} Vuong,</p>
                                                <p>{{ trans('mail.reset-password.receive-request') }}.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-left:20px;padding-right:20px;" align="center">
                                                <a href="{{ '' }}" target="_blank" style="float:left;padding:10px 15px;background-color:#70be44;color:#fff;border-radius:3px;-webkit-border-radius:3px;text-decoration:none;">{{ trans('mail.reset-password.resetBtn') }}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding:30px 20px 15px;">
                                                {{ trans('mail.reset-password.ignore') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding:10px 20px 20px;font-size:13px;">
                                                <div style="width:100%;float:left;padding-top:20px;border-top:solid 1px #eee;">
                                                    {{ trans('mail.reset-password.link-fails') }}
                                                </div>
                                                <div style="width:100%;float:left;margin-top:10px;background-color:#f5f5f5;border-radius:3px;-webkit-border-radius:3px;color:#007aff;">
                                                    <span style="float:left;padding:10px;color:#007aff;">{{ '' }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <p style="color:#666;">{{ trans('reset-password.team') }} | <a href="mailto:support@octocv.co" style="color:#5f94ce;text-decoration:none;">support@octocv.co</a><p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
