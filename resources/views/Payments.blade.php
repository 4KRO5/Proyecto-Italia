<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos</title>
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
        <h1>Registro de Pagos</h1>
        <form action="/home" method="GET">
            @csrf
            <button type="submit">Home</button>
        </form>
        <button id="crearButton">Crear Pago</button>
        <button onclick="togglePayments()">
            {{ $showAll ? 'Ver Pagos Activos' : 'Ver Todos los Pagos' }}
        </button>
        <table id="tablaDatos">
            <tr>
                <th>Nombre del Usuario</th>
                <th>Nombre de la Membresía</th>
                <th>Precio</th>
                <th>Fecha</th>
            </tr>
            @foreach ($payments as $payment)
                <tr class="{{ $payment->trashed() ? 'deleted-row' : '' }}">
                    <td>{{ $payment->user->name }}</td>
                    <td>{{ $payment->membership->name }}</td>
                    <td>{{ $payment->membership->price }}</td>
                    <td>{{ $payment->date }}</td>
                </tr>
            @endforeach
        </table>

        <div id="popup">
            <h2 id="popupTitle">Crear Pago</h2>
            <form id="paymentForm" action="/payments" method="POST">
                @csrf
                <input type="hidden" id="method" name="_method" value="POST">
                <label for="user_id">Nombre del Usuario:</label><br>
                <select id="user_id" name="user_id">
                    @if($users instanceof \App\Models\User)
                    <option value="{{ $users->id }}">{{ $users->name }}</option>
                    @elseif($users instanceof \Illuminate\Database\Eloquent\Collection)
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                    @else
                    <option>No se pudo obtener el usuario</option>
                    @endif
                </select>
                <br>
                <label for="memberships_id">Membresía:</label><br>
                <select id="memberships_id" name="memberships_id">
                    @foreach ($memberships as $membership)
                    <option value="{{ $membership->id }}">{{ $membership->name }}</option>
                    @endforeach
                </select>
                <br>
                <input type="submit" id="submitButton" value="Crear">
            </form>
            <button onclick="document.getElementById('popup').style.display='none'">Cerrar</button>
        </div>
    </div>

    <script>
        function togglePayments() {
            var showAll = {{ $showAll ? 'true' : 'false' }};
            window.location.href = '/payments?show_all=' + (showAll ? '0' : '1');
        }

        document.getElementById('crearButton').onclick = function() {
            document.getElementById('popupTitle').textContent = 'Crear Pago';
            document.getElementById('paymentForm').action = '/payments';
            document.getElementById('method').value = 'POST';
            document.getElementById('submitButton').value = 'Crear';
            document.getElementById('user_id').value = '';
            document.getElementById('memberships_id').value = '';
            document.getElementById('popup').style.display = 'block';
        };

        function editarPago(id, userId, membershipsId, date) {
            document.getElementById('popupTitle').textContent = 'Editar Pago';
            document.getElementById('paymentForm').action = '/payments/' + id;
            document.getElementById('method').value = 'PUT';
            document.getElementById('submitButton').value = 'Guardar';
            document.getElementById('user_id').value = userId;
            document.getElementById('memberships_id').value = membershipsId;
            document.getElementById('popup').style.display = 'block';
        }
    </script>
</body>
</html>
