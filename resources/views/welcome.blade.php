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
                font-weight: 200;
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
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif


                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Leonie's verjaardag in:
                </div>
                <div style="display: grid; grid-template-columns: repeat(5, auto)">
                    <p>maanden: {{ Carbon\Carbon::now()->diff(Carbon\Carbon::createFromDate(2020, 9, 24))->m }}</p>
                    <p>dagen: <span id="days"></span>
                    <p>uren: <span id="hours"></span></p>
                    <p>minuten: <span id="minutes"></span></p>
                    <p>seconden: <span id="seconds"></span></p>
                </div>

                <script>
                    let birthdayDate = new Date("24/sep/2020");

                    function setTime() {
                        var now = Date.now();


                        var diff = birthdayDate - now;

                        var days = Math.floor(diff / (1000 * 60 * 60 * 24));
                        diff -=  days * (1000 * 60 * 60 * 24);

                        var hours = Math.floor(diff / (1000 * 60 * 60));
                        diff -= hours * (1000 * 60 * 60);

                        var minutes = Math.floor(diff / (1000 * 60));
                        diff -= minutes * (1000 * 60);

                        var seconds = Math.floor(diff / (1000));
                        diff -= seconds * (1000);

                        document.querySelector('#days').innerHTML = days;
                        document.querySelector('#hours').innerHTML = hours;
                        document.querySelector('#minutes').innerHTML = minutes;
                        document.querySelector('#seconds').innerHTML = seconds;

                        ctx.clearRect(0, 0, c.width, c.height);
                        drawTime(seconds, 60, 100, "#800080");
                        drawTime(minutes, 60, 80, "#FF1493");
                        drawTime(hours, 24, 60, "#ffff00");
                        drawTime(days, 7, 40, "#00DBFF");

                    }

                    let intervalId = window.setInterval(setTime, 1);
                </script>


                <canvas id="canvas"></canvas>

                <script>
                    let c = document.querySelector("canvas");
                    c.style.width = "15rem";
                    c.style.height = "15rem";
                    // c.style.border = "1px solid red";

                    let size = c.getBoundingClientRect();
                    let center = {x: size.width, y: size.height};
                    c.width = size.width * 2;
                    c.height = size.height * 2;

                    let ctx = c.getContext("2d");

                    function drawTime(part, whole, radius, color) {
                        ctx.beginPath();
                        ctx.lineWidth = 30;
                        ctx.strokeStyle = color;
                        let startingAngel = -((Math.PI * 1) / 2)
                        let endAngle = (((Math.PI / 2) * 3) / whole) * part;
                        ctx.arc(center.x , center.y, radius * 2, startingAngel, endAngle);
                        ctx.stroke();
                    }


                </script>
            </div>
        </div>
    </body>
</html>
