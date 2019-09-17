@component('mail::message')
# Coin: {{ $story->coin->phrase }} - {{ $story->coin->number }}

New connection from your coin has been created.

{{--@component('mail::button', ['url' => ''])--}}
{{--Button Text--}}
{{--@endcomponent--}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
