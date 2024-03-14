<!DOCTYPE html>
<html>

<head>
    <title>Registro de usuario</title>
    <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">
    <!-- Agrega los enlaces a Bootstrap u otros estilos si es necesario -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #1C1C1C;">

    <div class="bg text-center">
    <a href="{{ route('login') }}" class="circular-button"></a>
        <div class="centered">
            
            <p class="firstLine"> R &nbsp;&nbsp;&nbsp; E &nbsp;&nbsp;&nbsp; G &nbsp;&nbsp;&nbsp; I &nbsp;&nbsp;&nbsp; S &nbsp;&nbsp;&nbsp; T &nbsp;&nbsp;&nbsp; E &nbsp;&nbsp;&nbsp; R </p>

            <p class="secondLine">&nbsp;&nbsp;&nbsp;</p>

            <form class="register-form" method="POST" action="{{ route('register.submit') }}">
                @csrf

                <div class="form-group">
                    <input type="text" class="form-control CustomInput" id="name" name="name" placeholder="Name" required onkeypress="return isNaN(event.key)">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control CustomInput" id="last_name" name="last_name" placeholder="last_name" required onkeypress="return isNaN(event.key)">
                </div>

                <div class="form-group">
                    <input type="email" class="form-control CustomInput" id="email" name="email" placeholder="Email" required autocomplete="off">
                </div>

                <div class="form-group">
                    <input type="password" class="form-control CustomInput" id="password" name="password" placeholder="Password (between 6 and 10 characters)" minlength="6" maxlength="10" required autocomplete="off">
                    <span style="color: red;">@error('password') {{ $message }} @enderror</span>
                </div>

                <p class="secondLine">&nbsp;&nbsp;&nbsp;</p>
                <button type="submit" class="btn btn-success" id="registerButton">register</button>
            </form>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>