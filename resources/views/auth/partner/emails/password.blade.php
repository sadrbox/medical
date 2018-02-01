Пройдите по ссылке, чтобы сбросить пароль.: <a href="{{ $link = url('partner/password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
