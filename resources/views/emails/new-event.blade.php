<x-mail::message>
# Notification

New event was created. <br><br>

Name: {{ $maildata['name'] }}<br>
Slug: {{ $maildata['slug'] }}<br><br><br>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
