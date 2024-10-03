<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>TribalEssence</title>
  <!-- Bootstrap CSS CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
    integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('css/infobox.css')}}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/logos.css') }}">

  <!-- Font Awesome JS -->

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
  .exclamation {
    z-index: 5;
    top: 5px;
    right: 15px;
    border-radius: 50%;
    background-color: rgb(225, 0, 0);
    font-size: 15px;
  }

  .exclamation.hidden {
    display: none;
  }
</style>

<body class="">
  <div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar">
      <div class="sidebar-header">
        <img src="{{asset('img/logo-tribal-essence-white.jpg')}}" alt="logo" class="logo-sidebar mx-auto d-block">
      </div>

      <ul class="list-unstyled components">
        <div class="d-flex justify-content-center">
          <p><b>Bienvenido {{ auth()->user()->name }}!</b></p>
        </div>
        <li><a href="{{route('profile.edit')}}">Perfil</a></li>
        <li>
          <a href="{{route('dashboard')}}">Panel de mando</a>
        </li>
        <li>
          <a href="{{ route('caja.index') }}" class="">Caja</a>
        </li>
        <li>
          <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Gestion
            General</a>
          <ul class="collapse list-unstyled" id="pageSubmenu">
            <li><a href="{{ route('stock') }}">Stock</a></li>
            <li><a href="{{ route('proveedores.index') }}">Proveedores</a></li>
            <li><a href="{{ route('marcas.index') }}">Marcas</a></li>
            <li><a href="{{ route('productos.index') }}">Productos</a></li>
            <li><a href="{{ route('aromas.index') }}">Aromas</a></li>
            <li><a href="{{ route('metodo_pagos.index') }}">Métodos de Pago</a></li>
            <li><a href="{{ route('clientes.index') }}">Clientes</a></li>
          </ul>
        </li>
        <li>
          <a href="#sesionSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Sesión</a>
          <ul class="collapse list-unstyled" id="sesionSubmenu">

            <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
              @csrf
            </form>
            <li><a href="#" onclick="document.getElementById('logout-form').submit(); return false;">
                Cerrar Sesión</a></li>
          </ul>
        </li>
      </ul>
    </nav>

    <!-- Page Content -->
    <div id="content">
      <nav class="navbar navbar-expand-lg navbar-light color-navbar rounded">
        <div class="container-fluid">
          <div class="d-flex justify-content-start gap">
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="bi bi-layout-sidebar"></i>
              <span>Barra Lateral</span>
            </button>

            <a href="{{ route('compras') }}"><button class="d-flex align-items-center btn btn-primary"><i
                  class="mx-1 bi bi-bag-plus-fill"></i>Ingresar Mercaderías</button></a>

            <a href="{{ route('vender') }}"><button class="d-flex align-items-center btn btn-primary"><i
                  class="bi bi-currency-dollar"></i>Vender Mercaderías</button></a>

          </div>

          <div>
            <div class="position-absolute text-white exclamation hidden" id="exclamation">
              <i class="bi bi-exclamation-lg"></i>
            </div>
            <div class="div-notifications" id="div-notifications">
              <div class="dropdown dropleft">
                <button class="btn amarillo dropdown-toggle" type="button" id="dropdownMenuButton"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bi bi-bell-fill"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <li><a class="dropdown-item" href="#">Notificaciones</a></li>
                  <ul class="lista_notificaciones p-2" id="lista_notificaciones">

                  </ul>
                  <div class="dropdown-divider"></div>
                </ul>
              </div>
            </div>
          </div>

          <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fas fa-align-justify"></i>
          </button>
        </div>
      </nav>
      <!-- Page Content -->
      <main>
        @if (isset($slot))
      {{ $slot }}
    @endif
        @yield('content')
      </main>
    </div>
  </div>

  <!-- Scripts -->
  <script type="text/javascript">
    const ul = document.getElementById('lista_notificaciones');
      const exclamation = document.querySelector('#exclamation');

      async function getNotificaciones() {
        // Limpiar la lista de notificaciones antes de agregar nuevas
        ul.innerHTML = ''; // Esto asegura que no haya duplicados

        // Hacemos fetch a las notificaciones
        await fetch('notificaciones')
          .then(response => response.json())
          .then(notificaciones => {
            console.log(notificaciones);

            if (notificaciones.length > 0) {
              exclamation.classList.remove('hidden');
              notificaciones.forEach(notif => {

                let li = document.createElement('li');
                let a = document.createElement('a');

                li.setAttribute('id', notif.id);
                a.classList.add('text-white');
                a.textContent = "Leído";
                a.setAttribute('href', '#');
                a.setAttribute('id', notif.id);

                a.addEventListener('click', (e) => {
                  e.preventDefault();
                  marcarComoLeida(notif.id, li);
                });

                li.textContent = notif.descripcion + " - ";
                li.appendChild(a);
                ul.appendChild(li);
              });
            } else {
              exclamation.classList.add('hidden');
            }
          });
      }

      getNotificaciones();

      // Función para marcar la notificación como leída y eliminarla del DOM
      function marcarComoLeida(notificacionId, liElemento) {
        fetch('marcar-notificacion', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Token CSRF
          },
          body: JSON.stringify({
            id: notificacionId // Pasamos el ID de la notificación
          })
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              getNotificaciones(); // Recargamos la lista de notificaciones
              liElemento.remove(); // Eliminamos la notificación del DOM
            } else {
              alert('Error al marcar la notificación como leída.');
            }
          })
          .catch(error => {
            console.error('Error:', error);
          });
      }

  </script>


  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
    integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
    integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
    </script>

  <script type="text/javascript">
    $(document).ready(function () {
      $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
      });
    });
  </script>


</body>

</html>