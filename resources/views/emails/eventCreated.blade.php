@extends('/emails/layouts/email-layout')

@section('content')
        <tr>
            <td align="center" style="padding:40px 0 30px 0;background:rgb(93, 73, 84);">
                <h1 style="text-decoration: none;font-weight: bold;color: #F0EFF6;text-align:center;" >Event Manager</h1>
            </td>
        </tr>
        <tr>
            <td style="padding:36px 30px 42px 30px;">
                <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                    <tr>
                        <td style="padding:15px;">
                            <h4 class="text-success align-center m-10px">Event created</h4>
                            <br/>
                            <h3 class="text-success" style="margin-bottom:10px;"> Hello {{$user['name']}}! </h3> 
                            <p class="text-success">
                                You've created event, <span class="bold">{{$event['name']}}</span>!
                                <br/>
                                The event starts at <span class="bold">{{$event['start_at']}}</span>
                                and event ends at <span class="bold">{{$event['end_at']}}</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:15px;">
                            <p class="text-success">Thank you for creating event at Event Manager!</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    {{-- <div class="email-body">
        
        <h2 class="primary align-center m-10px">Welcome to footyset!</h2>
        <br/>
        <h3 class="text-success"> Hello, {{$user['first_name']}}! </h3> 
        <p class="text-success">
            Your email was succesfully registered in Footyset! You can now log-in using your username, <span class="bold">{{$user['username']}}</span>!
            <br/>
            Your registered email-id is <span class="bold">{{$user['email']}}</span>
        </p>
    
        <p class="text-success">Thank you for joining footyset!</p>
    </div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="column">
                    <small>2022 © FootySet </small><br/>
                    <small>This is an automated email. Do not reply to this email</small>
                </div>
                <div class="column">
                    <div class="row">
                        <a href="https://twitter.com/footyset" target="_blank" rel="noopener noreferrer"> <img src="/img/twitter.svg" alt="twitter"></a>
                        <a href="https://www.instagram.com/footyset/" target="_blank" rel="noopener noreferrer"><img src="/img/instagram.svg" alt="instagram"></a>
                    </div>
                </div>
            </div>
        </div>
    </footer> --}}
@endsection