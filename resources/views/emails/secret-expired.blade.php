@component('mail::message')
# {{ __('emails.secret_expired.subject') }}

{!! __('emails.secret_expired.message', ['expired_at' => $expiresAt->format('d/m/Y à H:i')]) !!}

{{ __('emails.secret_expired.info') }}

@component('mail::button', ['url' => $url])
{{ __('emails.secret_expired.button_see') }}
@endcomponent

{{ __('emails.thank') }},<br>
{{ config('app.name') }}

@component('mail::subcopy')
{{ __('emails.update_notifications') }}
@endcomponent
@endcomponent
