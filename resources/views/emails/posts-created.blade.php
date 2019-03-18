@component('mail::message')
# {{ $post->title }}

{{ $post->body }}

{{ $post->created_at->toFormattedDateString() }}

@component('mail::button', ['url' => ''])
View Post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
