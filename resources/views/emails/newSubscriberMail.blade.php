<x-mail::message>
# Introduction
thanks for subscribing
<x-mail::button :url="route('fronted.index')">
visit our website
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
