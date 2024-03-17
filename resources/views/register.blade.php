<!DOCTYPE html>
<html>

<head>
    <title>Registro de usuario</title>
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

        .register-form .form-group {
            margin-bottom: 20px;
        }

        .CustomInput {
            border-radius: 5px;
        }

        #registerButton {
            width: 100%;
        }
    </style>
</head>

<body>

    <div class="bg text-center">
        <div class="centered">
            <p class="firstLine">REGISTRO</p>

            @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            @if ($errors->has('email'))
            <div class="alert alert-danger">
                {{ $errors->first('email') }}
            </div>
            @endif

            <form class="register-form" method="POST" action="{{ route('register.submit') }}">
                @csrf

                <div class="form-group">
                    <input type="text" class="form-control CustomInput" id="name" name="name" placeholder="Nombre" required onkeypress="return isNaN(event.key)">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control CustomInput" id="last_name" name="last_name" placeholder="Apellido" required onkeypress="return isNaN(event.key)">
                </div>

                <div class="form-group">
                    <input type="email" class="form-control CustomInput" id="email" name="email" placeholder="Correo electrónico" required autocomplete="off">
                </div>

                <div class="form-group">
                    <input type="password" class="form-control CustomInput" id="password" name="password" placeholder="Contraseña (entre 6 y 10 caracteres)" minlength="6" maxlength="10" required autocomplete="off">
                    <span style="color: red;">@error('password') {{ $message }} @enderror</span>
                </div>

                <button type="submit" class="btn btn-success" id="registerButton">Registrar</button>
            </form>

            <p>¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión</a></p>
        </div>
    </div>

</body>

</html>
