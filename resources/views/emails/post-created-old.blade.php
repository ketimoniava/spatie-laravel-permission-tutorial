@component('mail::message')
# New Post {{ $post->title }}



@component('mail::button', ['url' => '/posts/'.$post->id])
View Post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent