<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1C1C1C;
        }

        .bg {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .centered {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .firstLine {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .secondLine {
            margin-bottom: 20px;
        }

        .login-form .form-group {
            margin-bottom: 20px;
        }

        .CustomInput {
            border-radius: 5px;
        }

        .redirectText {
            font-size: 14px;
        }

        #loginButton {
            width: 100%;
        }
    </style>
</head>

<body>

    <div class="bg">
        <div class="centered">
            <p class="firstLine">LOGIN</p>

            <form class="login-form" method="POST" action="{{ route('login.submit') }}">
                @csrf

                <div class="form-group">
                    <input type="email" class="form-control CustomInput" id="email" name="email" placeholder="Email" autocomplete="off">
                </div>

                <div class="form-group">
                    <input type="password" class="form-control CustomInput" id="password" name="password" placeholder="Password" autocomplete="off">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success" id="loginButton">Login</button>
                </div>

                <div class="redirectText">
                    <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
