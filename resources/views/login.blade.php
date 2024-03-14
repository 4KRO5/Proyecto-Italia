<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">
    <!-- Agrega los enlaces a Bootstrap u otros estilos si es necesario -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #1C1C1C;">

    <div class="bg text-center">
        <div class="centered">

            <p class="firstLine"> L &nbsp;&nbsp;&nbsp; O &nbsp;&nbsp;&nbsp; G &nbsp;&nbsp;&nbsp; I &nbsp;&nbsp;&nbsp; N </p>

            <p class="secondLine">&nbsp;&nbsp;&nbsp;</p>

            <form class="login-form" method="POST" action="{{ route('login.submit') }}">
                @csrf

                <div class="form-group">
                    <input type="email" class="form-control CustomInput" id="email" name="email" placeholder="Email" autocomplete="off">
                </div>

                <div class="form-group">
                    <input type="password" class="form-control CustomInput" id="password" name="password" placeholder="Password" autocomplete="off">
                    <p class="secondLine">&nbsp;&nbsp;&nbsp;</p>
                    <p class="redirectText"><a href="{{ route('register') }}">Register here</a></p>
                </div>

                <p class="secondLine">&nbsp;&nbsp;&nbsp;</p>
                <button type="submit" class="btn btn-success" id="loginButton">Login</button>
            </form>


        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>