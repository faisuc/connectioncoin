@component('mail::message')
# Your Story has been reported

Message: {{ $message }}

@component('mail::button', ['url' => route('stories.show', ['story' => $story])])
View Story
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
