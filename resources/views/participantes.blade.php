<!DOCTYPE html>
<html>

<head>
    <title>Formulario Modal con Bootstrap</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.min.js"> </script>
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"> </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"> </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"> </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"> </script>
    <script src="{{ asset('js/controlTeclado.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <style>
        /* Estilos para el header */
        header {
            background-color: #1e1f22;
            padding: 10px 0;
            color: #fff;
            text-align: center;
            width: 100%;
        }

        /* Estilos para el contenedor principal */
        .header-container {
            max-width: 100%;
            margin: 0 auto;
            padding: 0 15px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            align-items: center;
        }

        /* Estilos para la sección del logo */
        .logo-section {
            display: flex;
            align-items: center;
        }

        .logo-section .btn-agregar-tarea {
            margin-right: 10px;
        }

        /* Estilos para la sección de la barra de navegación */


        /* Estilos para la sección del botón de cerrar sesión */
        .cerrar-section {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 20px;
        }

        .navbar-brand {
            font-size: 24px;
            text-decoration: none;
            color: #fff;
            /* Color del texto del enlace */
        }

        .nav-link {
            text-decoration: none;
            color: #fff;
            /* Color del texto del enlace */
            font-weight: bold;
            transition: color 0.3s;
            /* Transición suave del color al pasar el mouse */
        }
    </style>
</head>

<body class="well">
    <header>
        <div class="header-container">
            <div class="logo-section">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Agregar
                    Participante</button>
            </div>

            <div class="cerrar-section">
                <div class="navbar-section">
                    <a class="nav-link" href="/principal/proyectos">Gestion de Proyectos</a>
                </div>

                <button type="button" class="btn btn-danger btn-cerrar-sesion" data-toggle="modal" data-target="#logoutModal">Cerrar Sesión</button>
            </div>
        </div>
    </header>


    @section('content ')
    <div class="contenedor" align="center">
        <h2 style="font-weight: bolder;color: white;">Gestionar mis Participantes</h2>

        <div class="table">
            <table class="table table - striped " id=" tablaParticipantes">
                <thead>
                    <tr>
                        <th scope="col">Cedula</th>
                        <th scope=" col"> Nombre </th>
                        <th scope=" col"> Apellido </th>
                        <th scope="col"> Fecha de Nacimiento </th>
                        <th scope=" col"> Acciones </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listaParticipantes as $participante)
                        @if($participante['cedula'] !== $usuario)
                    <tr>
                        <td> {{ $participante['cedula']}}</td>
                        <td> {{ $participante['nombre']}}</td>
                        <td> {{ $participante['apellido']}}</td>
                        <td> {{ $participante['fechaNacimiento']}}</td>
                        <td>
                            <button type="button" class="btn btn-danger cargarModal" data-toggle="modal" data-target="#eliminarModal">
                                Eliminar </button>
                        </td>
                    </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @show
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Formulario</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="agregarParticipantes">
                        @csrf
                        <div class="form-group">
                            <label for="cedula">Cédula:</label>
                            <input type="text" class="form-control bloquearLetras" id="cedula" name="cedula" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="eliminarModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="elimi">Advertencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="eliminarParticipantes">
                    @csrf
                    <div class="modal-body">
                        <label for="text">Está seguro de Eliminar!</label>
                        <input type="text" id="cedulaH" name="cedula" hidden>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalInformativo" tabindex="-1" role="dialog" aria-labelledby="modalInformativo" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="elimi">Sistema</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="eliminarParticipantes">
                    @csrf
                    <div class="modal-body">
                        <span id="informacion"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {

            $("#agregarParticipantes").submit(function(event) {
                event.preventDefault();

                var formData = $(this).serialize();
                $.ajax({
                    url: "{{route('agregarParticipantes') }}",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    encode: true,
                }).done(function(data) {
                    $("#informacion").text("Proceso realizado con éxito");
                    $("#modalInformativo").modal("show");
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }).fail(function(xhr, status, error) {
                    $("#informacion").text("Error de proceso : cédula no identificada");
                    console.error("Error en la solicitud: " + error);
                });

            });

            $(".cargarModal").click(function() {
                var fila = $(this).closest("tr");
                var cedula = fila.find("td:eq(0)").text();
                $("#cedulaH").val(cedula);
            });


            $("#eliminarParticipantes").submit(function(event) {

                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{route('eliminarParticipantes')}}",
                    type: "DELETE",
                    data: formData,
                    dataType: "json",
                    encode: true,
                }).done(function(data) {
                    $("#informacion").text("Proceso realizado con éxito");
                    $("#modalInformativo").modal("show");
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }).fail(function(xhr, status, error) {
                    $("#informacion").text("Error de proceso : Conexión Perdida");
                    $("#modalInformativo").modal("show");
                    console.error("Error en la solicitud: " + error);
                });

            });

            $(".btn-cerrar-sesion").click(function(){

                window.location.href = "{{route('login')}}";
            });
        });
    </script>
</body>

</html>