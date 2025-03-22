@component('mail::message')
# {{ __('emails.secret_accessed.subject') }}

{{ __('emails.secret_accessed.viewed_with_ip') }}: {{ $ipAddress }}

@if($remainingViews !== null)
{{ __('emails.secret_accessed.remainingViews', ['remainingViews' => $remainingViews]) }}
@endif

@if($expiresAt)
{{ __('emails.secret_accessed.expire_at') }} {{ $expiresAt->format('d/m/Y à H:i') }}.
@endif

@component('mail::button', ['url' => $url])
{{ __('emails.secret_accessed.button_see') }}
@endcomponent

{{ __('emails.thank') }},<br>
{{ config('app.name') }}

@component('mail::subcopy')
{{ __('emails.update_notifications') }}
@endcomponent
@endcomponent
