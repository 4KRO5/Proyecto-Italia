<!DOCTYPE html>
<html>
<head>
    <title>Instructores</title>
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
<div id="container">
    <h1>Registro de Instructores</h1>
    <form action="/home" method="GET">
        @csrf
        <button type="submit">Home</button>
    </form>
    <button id="crearButton">Crear Instructor</button>
    <button onclick="toggleInstructors()">
        {{ $showAll ? 'Ver Instructores Activos' : 'Ver Todos los Instructores' }}
    </button>
    <table id="tablaDatos">
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Especialidad</th>
            <th>Acciones</th>
        </tr>
        @foreach ($instructors as $instructor)
        <tr class="{{ $instructor->trashed() ? 'deleted-row' : '' }}">
            <td>{{ $instructor->name }}</td>
            <td>{{ $instructor->last_name }}</td>
            <td>{{ $instructor->specialty }}</td>
            <td>
                <div style="display: flex; gap: 10px;">
                    <button onclick="editarInstructor('{{ $instructor->id }}', '{{ $instructor->name }}', '{{ $instructor->last_name }}', '{{ $instructor->specialty }}')" {{ $instructor->trashed() ? 'disabled' : '' }}>
                        Editar
                    </button>
                    <form action="/instructors/{{ $instructor->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" {{ $instructor->trashed() ? 'disabled' : '' }}>
                            Eliminar
                        </button>
                    </form>
                    @if ($instructor->trashed())
                        <form action="/instructors/restore/{{ $instructor->id }}" method="POST">
                            @csrf
                            <button type="submit">Habilitar Instructor</button>
                        </form>
                    @endif
                </div>
            </td>
        </tr>
        @endforeach
    </table>

    <!-- Ventana emergente con el formulario para crear un instructor -->
    <div id="popup">
        <h2 id="popupTitle">Crear Instructor</h2>
        <form id="instructorForm" action="/instructors" method="POST">
            @csrf
            <input type="hidden" id="method" name="_method" value="POST">
            <label for="name">Nombre:</label><br>
            <input type="text" id="name" name="name"><br>
            <label for="last_name">Apellido:</label><br>
            <input type="text" id="last_name" name="last_name"><br>
            <label for="specialty">Especialidad:</label><br>
            <input type="text" id="specialty" name="specialty"><br>
            <input type="submit" id="submitButton" value="Crear">
        </form>
        <button onclick="document.getElementById('popup').style.display='none'">Cerrar</button>
    </div>
</div>

<script>
    function toggleInstructors() {
        var showAll = {{ $showAll ? 'true' : 'false' }};
        window.location.href = '/instructors?show_all=' + (showAll ? '0' : '1');
    }

    document.getElementById('crearButton').onclick = function() {
        document.getElementById('popupTitle').textContent = 'Crear Instructor';
        document.getElementById('instructorForm').action = '/instructors';
        document.getElementById('method').value = 'POST';
        document.getElementById('submitButton').value = 'Crear';
        document.getElementById('name').value = '';
        document.getElementById('last_name').value = '';
        document.getElementById('specialty').value = '';
        document.getElementById('popup').style.display = 'block';
    };

    function editarInstructor(id, name, lastName, specialty) {
        document.getElementById('popupTitle').textContent = 'Editar Instructor';
        document.getElementById('instructorForm').action = '/instructors/' + id;
        document.getElementById('method').value = 'PUT';
        document.getElementById('submitButton').value = 'Guardar';
        document.getElementById('name').value = name;
        document.getElementById('last_name').value = lastName;
        document.getElementById('specialty').value = specialty;
        document.getElementById('popup').style.display = 'block';
    }
</script>
</body>
</html>
