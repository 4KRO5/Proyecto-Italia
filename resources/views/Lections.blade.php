<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecciones</title>
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

        .actions {
            display: flex;
            gap: 10px;
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

        #container {
            width: 80%;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: auto;
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
            width: calc(100% - 20px);
            border-collapse: collapse;
            margin: 10px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
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

        #lectionForm {
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
        .disabled-instructor {
            opacity: 0.5;
        }

        .disabled-user {
            opacity: 0.5;
        }

        .disabled-button {
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div id="container">
        <h1>Registro de lecciones</h1>
        <form action="/home" method="GET">
            @csrf
            <button type="submit">Inicio</button>
        </form>
        <button id="createLectionButton">Crear Lección</button>
        <button onclick="togglePayments()">
            {{ $showAll ? 'Ver Lecciones Activas' : 'Ver Todas las Lecciones' }}
        </button>
        <table id="lectionTable">
            <tr>
                <th>Usuario</th>
                <th>Instructor</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Asistencia</th>
                <th>Acciones</th>
            </tr>

            @if(count($lections) === 0)
            <tr>
                <td colspan="6">El usuario no tiene lecciones.</td>
            </tr>
            @else
            @foreach ($lections as $lection)
            <tr class="{{ $lection->trashed() ? 'deleted-row' : '' }} {{ $lection->trashed() ? 'disabled-lection' : '' }} {{ optional($lection->user)->trashed() ? 'disabled-user' : '' }}">
                <td>{{ optional($lection->user)->name }}</td>
                <td class="{{ optional($lection->instructor)->trashed() ? 'disabled-instructor' : '' }}">{{ optional($lection->instructor)->name }}</td>
                <td>{{ $lection->date }}</td>
                <td>{{ $lection->schedule }}</td>
                <td>{{ $lection->assistance ? 'Presente': 'Ausente' }}</td>
                <td class="actions">
                    <button onclick="editLection('{{ $lection->id }}')" {{ $lection->trashed() ? 'disabled' : '' }}>Editar</button>

                    <form action="/register-assistance/{{ $lection->id }}" method="POST" {{ $lection->trashed() ? 'disabled' : '' }}>
                        @csrf
                        <button type="submit" {{ $lection->trashed() ? 'disabled' : '' }}>
                            @if($lection->assistance)
                            Cancelar Asistencia
                            @else
                            Registrar Asistencia
                            @endif
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </table>

        <div id="popup">
            <h2 id="popupTitle">Crear Lección</h2>
            <form id="lectionForm" action="/lections/{id}" method="POST" onsubmit="return validateLectionForm()">
                @csrf
                @method('PUT')
                <input type="hidden" id="method" name="_method" value="POST">
                <label for="user_id">Usuario:</label><br>
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
                </select><br>
                <label for="instructor_id">Instructor:</label><br>
                <select id="instructor_id" name="instructor_id">
                    @foreach ($instructors as $instructor)
                    <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                    @endforeach
                </select><br>
                <label for="date">Fecha:</label><br>
                <input type="date" id="date" name="date"><br>
                <label for="schedule">Hora:</label><br>
                <input type="time" id="schedule" name="schedule"><br>
                <input type="submit" id="submitButton" value="Crear">
            </form>
            <button onclick="document.getElementById('popup').style.display='none'">Cerrar</button>
        </div>
    </div>

    <script>
        
document.addEventListener("DOMContentLoaded", function() {
    disableDelayedLections();
});

function disableDelayedLections() {
    var lectionRows = document.querySelectorAll("#lectionTable tr:not(:first-child)");
    var currentDate = new Date();

    lectionRows.forEach(function(row) {
        var dateString = row.cells[2].textContent;
        var timeString = row.cells[3].textContent;
        var lectionDate = new Date(dateString + " " + timeString);
        var timeDifference = currentDate.getTime() - lectionDate.getTime();
        
        if (timeDifference > 1000 * 60 * 6) {
            var buttons = row.querySelectorAll("button");
            buttons.forEach(function(button) {
                button.classList.add("disabled-button");
                button.onclick = function(event) {
                    if (!button.disabled) {
                        alert("Esta acción no está disponible para lecciones pasadas. (5 min. tolerancia)");
                    }
                    event.preventDefault();
                };
            });
            row.classList.add("disabled-lection");
        }
    });
}

function validateLectionForm() {
    var user_id = document.getElementById('user_id').value;
    var instructor_id = document.getElementById('instructor_id').value;
    var date = document.getElementById('date').value;
    var schedule = document.getElementById('schedule').value;

    if (!user_id || !instructor_id || !date || !schedule) {
        alert('Por favor, completa todos los campos.');
        return false;
    }

    var enteredDateTime = new Date(date + 'T' + schedule);
    enteredDateTime.setSeconds(0);

    var currentDate = new Date();
    currentDate.setSeconds(0);
    currentDate.setMinutes(currentDate.getMinutes() - 1);

    if (enteredDateTime < currentDate) {
        alert('La fecha y hora deben ser futuras.');
        return false;
    }

    // La validación ha pasado, se muestra una alerta de éxito dependiendo si se está creando o actualizando.
    if(document.getElementById('method').value === 'POST'){
        alert('La lección se ha creado correctamente.');
    } else {
        alert('La lección se ha actualizado correctamente.');
    }
    
    return true;
}

        function togglePayments() {
            var showAll = {{ $showAll ? 'true' : 'false' }};
            window.location.href = '/lections?show_all=' + (showAll ? '0' : '1');
        }
        
        document.getElementById('createLectionButton').onclick = function() {
            document.getElementById('popupTitle').textContent = 'Crear Lección';
            document.getElementById('lectionForm').action = '/lections';
            document.getElementById('method').value = 'POST';
            document.getElementById('submitButton').value = 'Crear';
            document.getElementById('user_id').value = '';
            document.getElementById('instructor_id').value = '';
            document.getElementById('date').value = '';
            document.getElementById('schedule').value = '';
            document.getElementById('popup').style.display = 'block';
        };

        function editLection(id) {
            fetch('/lections/' + id)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('popupTitle').textContent = 'Editar Lección';
                    document.getElementById('lectionForm').action = '/lections/' + id;
                    document.getElementById('method').value = 'PUT';
                    document.getElementById('submitButton').value = 'Guardar';
                    document.getElementById('user_id').value = data.user_id;
                    document.getElementById('instructor_id').value = data.instructor_id;
                    document.getElementById('date').value = data.date;
                    document.getElementById('schedule').value = data.schedule;
                    document.getElementById('popup').style.display = 'block';
                });
        }
    </script>
</body>
</html>
