<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="x-apple-disable-message-reformatting">
        <!--[if mso]>
        <noscript>
            <xml>
                <o:OfficeDocumentSettings>
                    <o:PixelsPerInch>96</o:PixelsPerInch>
                </o:OfficeDocumentSettings>
            </xml>
        </noscript>
        <![endif]-->
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.9.55/css/materialdesignicons.min.css" rel="stylesheet">
        <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap");
        :root {
            --primary-color:#7565D6;
            --secondary-color:#DD6F6F;
            --dark-text-color:#253053;
            --light-text-color:#92909d;
            --dark-blue-color:#003366;
            --light-grey-color:#D3D3D3;
            --dark-grey-color:#A9A9A9;
            --background-color:#F0EFF6;
            --mobile-fontsize:1em;
        }
        body {
            background-color: var(--background-color);
            margin: 0;
            font-family: 'Poppins', sans-serif;
            min-height: 100%;
        }
        table, td, div, h1, p {font-family: Arial, sans-serif;}
        p, h1, h2, h3, h4 {
            margin: 0;
            padding: 0;
        }
        .primary {
            color: var(--primary-color);
        }

        .secondary {
            color: var(--secondary-color);
        }

        .text-success {
            color: var(--dark-text-color);
        }

        .light {
            color: var(--light-text-color);
        }

        .font-size-10px {
            font-size: 10px;
        }

        .bold{
            font-weight: bold;
        }

        .m-10px {
            margin: 10px;
        }

        .m-15px {
            margin: 15px;
        }

        .wrap {
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        .width-half {
            width: 50%;
        }

        .ml-5px {
            margin-left: 5px;
        }

        .ml-10px {
            margin-left: 10px;
        }

        .ml-15px {
            margin-left: 15px;
        }

        .mr-5px {
            margin-right: 5px;
        }

        .mr-10px {
            margin-right: 10px;
        }

        .mr-15px {
            margin-right: 15px;
        }

        .mr-30px {
            margin-right: 30px;
        }

        .pl-10px {
            padding-left: 10px;
        }

        .align-center {
            text-align: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }
        </style>
    </head>

    <body>
        <table role="presentation" style="width:100%;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
            @yield('content')
            @include('/emails/layouts/email-footer')
         </table>
    </body>
</html>