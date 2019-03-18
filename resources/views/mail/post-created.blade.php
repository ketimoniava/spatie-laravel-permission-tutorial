<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
      <title>Add new post</title>
    </head>
    <body>
       @component('mail::message')

       <h1>New Post <strong>{{ $post->title }}</strong></h1>

       <p>{{ $post->body }}</p>

        @component('mail::button', ['url' => '/posts/'.$post->id])
      View Post
    @endcomponent

    Thanks,<br>

     <p>{{ config('app.name') }}</p>
    </body>
</html>
