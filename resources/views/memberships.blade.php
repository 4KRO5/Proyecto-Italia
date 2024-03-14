<!DOCTYPE html>
<html>
<head>
    <title>Membresías</title>
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

        .deleted-row {
            opacity: 0.5;
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
<div id="container">
    <h1>Registro de membresías</h1>
    <form action="/home" method="GET">
            @csrf
            <button type="submit">Home</button>
        </form>
    <table id="tablaDatos">
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
        @foreach ($memberships as $membership)
        <tr>
            <td>{{ $membership->name }}</td>
            <td>${{ $membership->price }}</td>
            <td style="display: flex; gap: 10px;">
                <button onclick="editarUsuario('{{ $membership->id }}', decodeURIComponent('{{ rawurlencode($membership->name) }}'), decodeURIComponent('{{ rawurlencode($membership->price) }}'), '{{ $membership->email }}')">Editar</button>
                <!-- <form action="/memberships/{{ $membership->id }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form> -->
            </td>
        </tr>
        @endforeach
    </table>

    <!-- Ventana emergente con el formulario para crear un usuario -->
    <div id="popup">
        <h2 id="popupTitle">Crear Usuario</h2>
        <form id="userForm" action="/memberships" method="POST" onsubmit="return validateForm()">
            @csrf
            <input type="hidden" id="method" name="_method" value="POST">
            <label for="name">Nombre:</label><br>
            <input type="text" id="name" name="name"><br>
            <label for="price">Price:</label><br>
            <input type="text" id="price" name="price"><br>
            <input type="submit" id="submitButton" value="Crear">
        </form>
        <button onclick="document.getElementById('popup').style.display='none'">Cerrar</button>
    </div>
</div>
    <script>
        function validateForm() {
            var price = document.getElementById('price').value;
            var numericPrice = parseFloat(price);

            if (numericPrice < 0) {
                alert('El precio no puede ser menor a 0');
                return false;
            }

            return true;
        }

        document.getElementById('crearButton').onclick = function() {
            document.getElementById('popupTitle').textContent = 'Crear Membresía';
            document.getElementById('userForm').action = '/memberships';
            document.getElementById('method').value = 'POST';
            document.getElementById('submitButton').value = 'Crear';
            document.getElementById('name').value = '';
            document.getElementById('price').value = '';
            document.getElementById('popup').style.display = 'block';
        };

        function editarUsuario(id, name, price, email) {
            document.getElementById('popupTitle').textContent = 'Editar Membresía';
            document.getElementById('userForm').action = '/memberships/' + id;
            document.getElementById('method').value = 'PUT';
            document.getElementById('submitButton').value = 'Guardar';
            document.getElementById('name').value = name;
            document.getElementById('price').value = price;
            document.getElementById('popup').style.display = 'block';
        }
    </script>
</body>
</html>