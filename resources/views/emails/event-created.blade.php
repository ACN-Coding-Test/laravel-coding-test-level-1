@component('mail::message')
{{ $eventData['name'] }}


Hey! New Event has been created. Check it out.


Here are some details:
| Title | Info |
| ------ | ------ |
| Name | {{ $eventData['name'] }} |
| Slug | {{ $eventData['slug'] }} |
| Start At | {{ $eventData['startAt'] }} |
| End At | {{ $eventData['endAt'] }} |


Cheers!

Thanks,<br>
{{ config('app.name') }}
@endcomponent