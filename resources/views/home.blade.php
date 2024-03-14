<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
  <!-- Agrega los enlaces a Bootstrap u otros estilos si es necesario -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Enlace a FontAwesome para el ícono de búsqueda -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
  <title>Home</title>
  <style>
    body {
      background-color: #1C1C1C;
    }

    /* Cambiar el color del texto y los títulos a blanco */
    h1,
    label,
    .form-control,
    th,
    td {
      color: #F1CCBA;
    }

    /* Cambiar el color del botón de búsqueda */
    #searchButton {
      background-color: #F1CCBA;
      border-color: #F1CCBA;
    }

    /* Cambiar el color del ícono del botón de búsqueda */
    #searchButton i {
      color: white;
    }

    .table {
      border-collapse: collapse;
    }

    .table th,
    .table td {
      border: none;
      padding: 10px;
      text-align: left;
    }

    /* Eliminar las líneas entre los registros de usuario */
    .table tr {
      border: none;
    }

    .table tr:nth-child(even) {
      background-color: #222222;
    }

    #sidebar1 {
      background: #222222;
      text-align: center;
      font-weight: bold;
      animation: slideInFromLeft 1s ease-in-out forwards;
      /* Aplicar animación desde la izquierda */
    }

    /*Barra buscadora*/
    .form-control {
      border-radius: 10px;
      /* Cambia la forma del borde del input */
      border: 1px solid #F1CCBA;
      /* Cambia el color del borde */
      background-color: rgba(241, 204, 186, 0);
      /* Cambia el color de fondo con transparencia */
      color: rgb(255, 255, 255);
      /* Cambia el color del texto */
      box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.3);
      /* Cambiar la sombra al pasar el ratón */
      background-color: transparent;
    }

    /*Estilos para quitar lo feo del autocompletado*/
    #searchInput:focus {
      background-color: transparent;
      outline: none;
      box-shadow: none;
      border-color: #F1CCBA;
      color: white;
    }

    ::-webkit-scrollbar {
      width: 10px;
    }

    ::-webkit-scrollbar-thumb {
      background: #333333;
      border-radius: 25px;
    }

    /* Animación para la barra lateral desde la izquierda */
    @keyframes slideInFromLeft {
      0% {
        transform: translateX(-100%);
        opacity: 0;
      }

      100% {
        transform: translateX(0);
        opacity: 1;
      }
    }

    /* Animación para el título h1 desde arriba */
    @keyframes slideInFromTop {
      0% {
        transform: translateY(-100%);
        opacity: 0;
      }

      100% {
        transform: translateY(0);
        opacity: 1;
      }
    }

    h1 {
      animation: slideInFromTop 1s ease-in-out forwards;
    }

    @keyframes square-in-hesitate {
      0% {
        clip-path: inset(100% 100% 100% 100%);
      }

      40% {
        clip-path: inset(33% 33% 33% 33%);
      }

      100% {
        clip-path: inset(0 0 0 0);
      }
    }

    [transition-style="in:square:hesitate"] {
      animation: 2.5s cubic-bezier(.25, 1, .30, 1) square-in-hesitate both;
    }
  </style>
</head>

<body>
  <!-- Div de cuerpo -->
  <div class="container-fluid">
    <div class="row">
      <!--Side bar-->
      <div class="d-none d-lg-block col-sm-auto sticky-top" id="sidebar1">
        <ul class="nav flex-column" id="sidebarNav">
          <li class="nav-item">
            <a href="/home" id="homeLink" class="nav-link text-light p-5" style="color: #F1CCBA !important;" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Home">
              Home
            </a>
          </li>
          <li class="nav-item">
            <a href="/users" id="dashboardLink" class="nav-link text-light p-5" style="color: #F1CCBA !important;" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Dashboard">
              Usuarios
            </a>
          </li>
          <li class="nav-item">
            <a href="/payments" id="ordersLink" class="nav-link text-light p-5" style="color: #F1CCBA !important;" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Orders">
              Pagos
            </a>
          </li>
          <li class="nav-item">
            <a href="/memberships" id="productsLink" class="nav-link text-light p-5" style="color: #F1CCBA !important;" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Products">
              Membresías
            </a>
          </li>
          <li class="nav-item">
            <a href="/instructors" id="customersLink" class="nav-link text-light p-5" style="color: #F1CCBA !important;" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Customers">
              Instructores
            </a>
          </li>
          <li class="nav-item">
            <a href="/lections" id="customersLink" class="nav-link text-light p-5" style="color: #F1CCBA !important;" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Customers">
              Lecciones
            </a>
          </li>
          <li class="nav-item mt-auto">
            <a href="/logout" id="logoutLink" class="nav-link text-light p-5" style="color: #F1CCBA !important;" title="" data-bs-toggle="tooltip" data-bs-placement="bottom-end" data-bs-original-title="LogOut">
              Cerrar Sesión
            </a>
          </li>
        </ul>
      </div>
      <!--Final de la sidebar-->

      <!-- Contenido Principal de la base de datos -->
      <div class="col-sm p-5 min-vh-100">
        <h1 class="text-center">Attendance Record</h1>
        <!--Barra de busqueda-->
        <div class="input-group">
          <input type="search" id="searchInput" class="form-control" placeholder="Search" /><label class="form-label" for="searchInput">&nbsp;</label>
          <div class="input-group-append">
            <button type="button" id="searchButton" class="btn btn-primary rounded-circle">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>

        <!--Tabla-->
        <!-- Cambia la tabla original para que tenga una clase -->
        <table class="table" id="originalTable" style="width: 100%;" transition-style="in:square:hesitate">
          <tr>
            <th>Name</th>
            <th>Last Name</th>
            <th>Email</th>
          </tr>
          <tbody>
            @foreach ($users as $user)
            <tr data-id="{{ $user->id }}" class="search-result">
              <td>{{ $user->name }}</td>
              <td>{{ $user->last_name }}</td>
              <td>{{ $user->email }}</td>
              <td>
                <form action="/lections/{{ $user->id }}" method="POST">
                  @csrf
                  <input type="hidden" name="show_all" value="1">
                  <button type="submit" class="btn btn-black" style="border: none; background-color: #F1CCBA;">Ver clases</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!--Final de la tabla-->
    </div>
  </div>
  </div>
</body>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const originalTable = document.getElementById('originalTable');
    const rows = originalTable.querySelectorAll('.search-result');

    searchInput.addEventListener('input', function() {
      const searchTerm = searchInput.value.trim().toLowerCase();

      rows.forEach(row => {
        const name = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
        const lastname = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
        const email = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

        if (name.includes(searchTerm) || lastname.includes(searchTerm) || email.includes(searchTerm)) {
          row.style.display = 'table-row'; // Mostrar la fila si coincide con la búsqueda
        } else {
          row.style.display = 'none'; // Ocultar la fila si no coincide con la búsqueda
        }
      });
    });
  });
</script>

</html>