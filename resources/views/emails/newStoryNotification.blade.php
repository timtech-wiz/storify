@component('mail::message')
# Introduction

A new story with a title "{{$title}} was added

@component('mail::button', ['url' => route('dashboard.index')])
View story
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
