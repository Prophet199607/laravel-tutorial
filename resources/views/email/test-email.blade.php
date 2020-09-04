@component('mail::message')
# Welcome

Hi {{ $data['name'] }}!

This is your confirmation key - {{ $data['verification_code'] }}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
