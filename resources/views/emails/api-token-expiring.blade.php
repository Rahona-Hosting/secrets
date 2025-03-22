@component('mail::message')
# {{ __('emails.token_expiring.subject') }}

{{ __('emails.token_expiring.welcome') }} {{ $user->name }},

{!! __('emails.token_expiring.expire_message', ['token_name' => $token->name, '$daysUntilExpiration' => $daysUntilExpiration]) !!}

## {{ __('emails.token_expiring.details') }}
- **{{__('emails.token_expiring.details_name')}}**: {{ $token->name }}
- **{{__('emails.token_expiring.details_created_at')}}**: {{ $token->created_at->format('d/m/Y H:i') }}
- **{{__('emails.token_expiring.details_expired_at')}}**: {{ $token->expires_at->format('d/m/Y H:i') }}

{{ __('emails.token_expiring.warning') }}

@component('mail::button', ['url' => $url, 'color' => 'primary'])
{{ __('emails.token_expiring.button_handle_tokens') }}
@endcomponent

{{ __('emails.token_expiring.ignore_message') }}

@component('mail::panel')
{!! __('emails.token_expiring.security_message') !!}
@endcomponent

{{ __('emails.thank') }},<br>
{{ config('app.name') }}

@component('mail::subcopy')
{{ __('emails.update_notifications') }}
@endcomponent
@endcomponent
