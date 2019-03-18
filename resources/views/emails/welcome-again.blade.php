@component('mail::message')
# Introduction

Thanks so much for registering!

The body of your message.

- one

- two

- three

@component('mail::button', ['url' => 'http://laracasts.com'])
Start Browsing
My test goes here
@endcomponent


@component('mail::panel', ['url' => ''])
Some Inspirational qoutes goes here. :))
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
