<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            align-items: center; /* Align items vertically in the center */
        }

        .action-buttons button {
            padding: 8px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            margin-bottom: 0; /* Remove the margin-bottom */
        }

        #container {
            width: 80%;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: auto; /* Change from 'hidden' to 'auto' */
            margin: 20px;
            padding: 10px;
        }

        h1 {
            background-color: #333;
            color: #fff;
            padding: 20px;
            margin: 0;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        table {
            width: calc(100% - 20px); /* Establecer la anchura de la tabla al 100% del contenedor */
            border-collapse: collapse;
            margin: 10px; /* Reducir el margen de la tabla */
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .deleted-row button {
            opacity: 1;
            cursor: pointer;
        }

        .deleted-row button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .deleted-row button[disabled] {
            cursor: not-allowed;
        }

        #popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background: white;
            border: 1px solid black;
        }

        #popupTitle {
            background-color: #333;
            color: #fff;
            padding: 10px;
            margin: 0;
            border-radius: 4px 4px 0 0;
        }

        #paymentForm {
            padding: 20px;
        }

        select, input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        #submitButton {
            background-color: #4caf50;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        #popup button {
            background-color: #ccc;
            color: #333;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    @if ($errors->any())
        <script>
            function showErrorAlert() {
                alert('Este correo ya ha sido registrado. Por favor, ingrese otro.');
            }
            setTimeout(showErrorAlert, 400);
        </script>
    @endif
    @if (session('success'))
        <script>
            function showSuccessAlert() {
                alert('Usuario creado exitosamente.');
            }
            setTimeout(showSuccessAlert, 400);
        </script>
    @endif

    <div id="container">
        <h1>Registro de Usuarios</h1>
        <form action="/home" method="GET">
            @csrf
            <button type="submit">Home</button>
        </form>
        <button id="crearButton">Crear Usuario</button>
        <button onclick="toggleUsers()">
            {{ $showAll ? 'Ver Usuarios Activos' : 'Ver Todos los Usuarios' }}
        </button>
        <table id="tablaDatos">
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
            @foreach ($users as $user)
                <tr class="{{ $user->trashed() ? 'deleted-row' : '' }}">
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="action-buttons">
                        <button onclick="editarUsuario('{{ $user->id }}', decodeURIComponent('{{ rawurlencode($user->name) }}'), decodeURIComponent('{{ rawurlencode($user->last_name) }}'), '{{ $user->email }}')" {{ $user->trashed() ? 'disabled' : '' }}>Editar</button>
                        <form action="/payments/{{ $user->id }}" method="POST">
                            @csrf
                            <button type="submit">Ver pagos</button>
                        </form>
                        <form action="/users/{{ $user->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" {{ $user->trashed() ? 'disabled' : '' }}>Eliminar</button>
                        </form>
                        @if ($user->trashed())
                        <form action="/users/restore/{{ $user->id }}" method="POST">
                            @csrf
                            <button type="submit">Habilitar Cuenta</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>

        <div id="popup">
            <h2 id="popupTitle">Crear Usuario</h2>
            <form id="userForm" action="/users" method="POST" onsubmit="return validateForm()">
                @csrf
                <input type="hidden" id="method" name="_method" value="POST">
                <label for="name">Nombre:</label><br>
                <input type="text" id="name" name="name" required><br>
                <label for="last_name">Apellido:</label><br>
                <input type="text" id="last_name" name="last_name" required><br>
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"><br>
                <label for="password">Contraseña:</label><br>
                <input type="password" id="password" name="password" required><br>
                <label for="confirm_password">Confirmar Contraseña:</label><br>
                <input type="password" id="confirm_password" name="confirm_password" required><br>
                <input type="submit" id="submitButton" value="Crear">
            </form>
            <button onclick="document.getElementById('popup').style.display='none'">Cerrar</button>
        </div>
    </div>

    <script>
        function validateForm() {
            var emailRegex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;
            var name = document.getElementById('name').value;
            var lastName = document.getElementById('last_name').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirm_password').value;

            if (name.trim() === '' || lastName.trim() === '' || email.trim() === '' || password.trim() === '' || confirmPassword.trim() === '') {
                alert('Todos los campos son obligatorios');
                return false;
            }

            if (!emailRegex.test(email) || !emailRegex.test(confirmEmail)) {
                alert('Por favor, ingrese correos electrónicos válidos');
                return false;
            }

            if (email !== confirmEmail) {
                alert('Los correos electrónicos no coinciden');
                return false;
            }

            if (password !== confirmPassword) {
                alert('Las contraseñas no coinciden');
                return false;
            }

            return true;
        }

        function toggleUsers() {
            var showAll = {{ $showAll ? 'true' : 'false' }};
            window.location.href = '/users?show_all=' + (showAll ? '0' : '1');
        }

        document.getElementById('crearButton').onclick = function() {
            document.getElementById('popupTitle').textContent = 'Crear Usuario';
            document.getElementById('userForm').action = '/users';
            document.getElementById('method').value = 'POST';
            document.getElementById('submitButton').value = 'Crear';
            document.getElementById('name').value = '';
            document.getElementById('last_name').value = '';
            document.getElementById('email').value = '';
            document.getElementById('password').value = '';
            document.getElementById('popup').style.display = 'block';
        };

        function editarUsuario(id, name, lastName, email) {
            document.getElementById('popupTitle').textContent = 'Editar Usuario';
            document.getElementById('userForm').action = '/users/' + id;
            document.getElementById('method').value = 'PUT';
            document.getElementById('submitButton').value = 'Guardar';
            document.getElementById('name').value = name;
            document.getElementById('last_name').value = lastName;
            document.getElementById('email').value = email;
            document.getElementById('password').value = '';
            document.getElementById('popup').style.display = 'block';
        }
    </script>
</body>
</html>