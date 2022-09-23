<html>
    <head>
        <style type='text/css'>
            body, html {
                margin: 0;
                padding: 0;
            }
            body {
                color: black;
                display: table;
                font-family: Georgia, serif;
                font-size: 24px;
                text-align: center;
            }
            .container {
                border: 20px solid tan;
                width: 1080px;
                height: 750px;
                /* display: table-cell; */
                vertical-align: middle;
            }
            .logo {
                color: tan;
                padding-top: 90px;
            }

            .marquee {
                color: tan;
                font-size: 48px;
                margin: 20px;
            }
            .assignment {
                margin: 20px;
            }
            .person {
                border-bottom: 2px solid black;
                font-size: 32px;
                font-style: italic;
                margin: 20px auto;
                width: 400px;
            }
            .reason {
                margin: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="logo">
                {{-- An Organization --}}
                <img src="{{public_path() . '\\'. $participant->user->image}}" height="70px">
            </div>

            <div class="marquee">
                Certificate of Completion
            </div>

            <div class="assignment">
                This certificate is presented to
            </div>

            <div class="person">
                {{$participant->name}}
            </div>

            <div class="reason">
                For complete the training class of {{$participant->trainingClass->name}}<br/>
                with score {{$assessment}}
            </div>
        </div>
    </body>
</html>