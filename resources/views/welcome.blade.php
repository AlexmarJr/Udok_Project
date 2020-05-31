<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        background-image: url('/img/back.png');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: 100% 100%;
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
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}" style="font-size: 20px">Home</a>
                    @else
                        <a href="{{ route('login') }}" style="font-size: 20px">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" style="font-size: 20px">Registrar</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Projeto para a Udok
                </div>

                <div class="links">
                    <a href="https://github.com/AlexmarJr/Udok_Project" style="font-size: 20px">Projeto no GitHub</a>
                    <a href="https://www.linkedin.com/in/alexmar-noronha-1b4596160/" style="font-size: 20px">Linkedin</a>
                    <a href="http://udok-project.herokuapp.com/" style="font-size: 20px">Site no Ar</a>
                    
                </div>
            </div>
        </div>
    </body>
</html>
