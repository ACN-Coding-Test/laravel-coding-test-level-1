<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
    <body>
        @component('mail::message')
            Hello **{{$name}}**,  {{-- use double space for line break --}}
            New event were created, let's check it out before it's over!  
            You might get discount voucher, have fun!
                @component('mail::button', ['url' => $link])
                    Go to your inbox
                @endcomponent
            Sincerely,
            Mailtrap team.
        @endcomponent
    </body>
</html>