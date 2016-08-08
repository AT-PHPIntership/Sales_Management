@lang('auth.reset_body_email')<br>
<br>
<br>@lang('auth.label_link'): <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a><br>
<br><br><br>
<br>@lang('auth.reset_mail_note')<br>
<br><i>@lang('auth.reset_signature')</i>
