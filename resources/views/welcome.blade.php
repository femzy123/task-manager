<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Taskman</title>
				<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
				<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
				<link rel="manifest" href="/site.webmanifest">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Styles -->
        <style>
            body {
                background-image: url('bg.gif');
                background-size: cover;
                background-repeat: no-repeat;
                margin: 0;
                width: 100%;
                height: 100%;
                display: block;
                color: #fff;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
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
								/* text-align: center; */
								width:60%;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #fff;
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

							<div class="container">
								<div class="row">
										<div class="col-md-6 mb-5">
												<h5>Say hello to</h5>
												<div class="title">
													Taskman
												</div>
												<p>
													A visual, feature-rich productivity app for busy people to keep their schedule on track.
													Taskman app is your simple, effective and beautiful way to plan and complete tasks.
												</p>
												<a href="{{ route('register') }}" class="btn btn-primary">GET STARTED</a>
										</div>
										<div class="col-md-6">
												<img src="frame.jpg" class="img-thumbnail rounded" alt="App Image">
										</div>
								</div>
							</div>

            </div>
        </div>
    </body>
</html>
