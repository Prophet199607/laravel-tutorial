@component('mail::message')
# MADTECH

Hi, {{ $post->user->name }}
Your post is in under review..

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
