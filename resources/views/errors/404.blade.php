<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Task Manage</title>
          <link rel="shortcut icon" type="image/png" href="favicon.png"/>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .links > a{
                color: #3097D1;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

                <div class="top-right links">

                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>

                </div>


            <div class="content">
                <div class="title m-b-md">
                    404 You are lost here!
                </div>

                <div class="links">
                    <a href="https://hrshadhin.me">H.R.Shadhin</a>
                    <a href="https://blog.hrshadhin.me">Blog</a>
                    <a href="mailto:root@hrshadhin.me">MailBox</a>
                    <a href="https://twitter.com/hrshadhin">@hrshadhin</a>
                    <a href="https://github.com/hrshadhin/task-manage">Source Code</a>
                </div>
            </div>
        </div>
    </body>
</html>
