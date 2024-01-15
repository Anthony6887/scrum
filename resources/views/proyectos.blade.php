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
            background-color: #343a40;
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

        .card-header {
            width: 100%;
            height: 80px;

        }

        .titulo {
            margin-bottom: 25px;
            color: #007bff;

        }

        .card {
            width: 300px;
            height: 400px;
            border: 2px solid #007bff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card:hover {
            border-color: #0056b3;
            background-color: #f5f5f5;
        }

        .card-content {
            padding: 20px;
        }
    </style>
</head>

<body>
    <header>
        <div class="header-container">
            <div class="logo-section">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Agregar
                    Proyecto</button>
            </div>

            <div class="cerrar-section">

                <button type="button" class="btn btn-danger btn-cerrar-sesion" data-toggle="modal" data-target="#logoutModal">Cerrar Sesión</button>
            </div>
        </div>
    </header>




    @section('content ')
    <div class="contenedor" align="center">
        <h2 class="titulo" style="font-weight: bolder;">Registro de Proyectos</h2>
        <div class="row">
            @foreach($listaProyectos as $proyecto)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 style="font-weight: bolder;">{{ $proyecto['nombre'] }}</h3>
                    </div>

                    <div class="card-body">
                        <p>{{ $proyecto['descripcion'] }}</p>
                        <p><strong>Fecha de inicio:</strong> {{ $proyecto['fechaInicio'] }}</p>
                        <p><strong>Fecha de finalización:</strong> {{ $proyecto['fechaFin'] }}</p>
                        <p><strong>Estado:</strong> {{ $proyecto['estado'] }}</p>
                    </div>
                    <div class="card-footer">
                        @if($proyecto['rol']==='SCRUM MASTER')
                        <button type="button" style="width: 150px; margin-bottom: 5px;" class="btn btn-warning cargarModal" id="{{ $proyecto['id'] }}_{{ $proyecto['nombre'] }}_{{ $proyecto['descripcion'] }}_{{ $proyecto['fechaInicio'] }}_{{ $proyecto['fechaFin'] }}_{{ $proyecto['estado'] }}" data-toggle="modal" data-target="#myModalEditar">
                            Actualizar
                        </button>
                        @endif
                        <form class=" formTareas" data-id="{{ $proyecto['id'] }}">
                            <input type="text" value="{{ $proyecto['id'] }}" name="idProyecto" hidden>
                            @csrf
                            <button type="submit" style="width: 150px" class="btn btn-success">Revisar</button>
                        </form>

                    </div>
                </div>
            </div>
            @endforeach

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
                    <form id="agregarProyectos">
                        @csrf
                        <div class="form-group">
                            <label for="nombreProyecto">Nombre del Proyecto:</label>
                            <input type="text" class="form-control" id="nombreProyecto" name="nombreProyecto" required>
                            <span class="error-message" id="nombreProyecto-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="descripcionProyecto">Descripción del Proyecto:</label>
                            <textarea class="form-control" id="descripcionProyecto" name="descripcionProyecto" rows="3" required></textarea>
                            <span class="error-message" id="descripcionProyecto-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="fechaInicio">Fecha de Inicio:</label>
                            <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" min="2024-01-01" required>
                            <span class="error-message" id="fechaInicio-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="fechaFin">Fecha de Fin:</label>
                            <input type="date" class="form-control" id="fechaFin" name="fechaFin" required>
                            <span class="error-message" id="fechaFin-error"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" id="btnGuardar" disabled="true" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="myModalEditar">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Formulario Editar</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="actualizarProyectos">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" id="id" name="id" hidden>
                        </div>
                        <div class="form-group">
                            <label for="nombreProyectoEditar">Nombre del Proyecto:</label>
                            <input type="text" class="form-control" id="nombreProyectoEditar" name="nombreProyectoEditar" required>
                            <span class="error-message" id="nombreProyectoEditar-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="descripcionProyectoEditar">Descripción del Proyecto:</label>
                            <textarea class="form-control" id="descripcionProyectoEditar" name="descripcionProyectoEditar" rows="3" required></textarea>
                            <span class="error-message" id="descripcionProyectoEditar-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="fechaInicioEditar">Fecha de Inicio:</label>
                            <input type="date" class="form-control" id="fechaInicioEditar" name="fechaInicioEditar" min="2024-01-01" required>
                            <span class="error-message" id="fechaInicioEditar-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="fechaFinEditar">Fecha de Fin:</label>
                            <input type="date" class="form-control" id="fechaFinEditar" name="fechaFinEditar" required>
                            <span class="error-message" id="fechaFinEditar-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="rol">Estado:</label>
                            <select class="form-control" id="estado" name="estado" required>
                                <option value="pendiente">Pendiente</option>
                                <option value="finalizado">Finalizado</option>
                                </option>
                            </select>
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
            function validarNombre() {
                var nombre = $("#nombreProyecto").val();
                if (/[\d]/.test(nombre)) {
                    $("#nombreProyecto-error").text("El nombre no debe contener números.");
                    return false;
                } else {
                    $("#nombreProyecto-error").text("");
                    return true;
                }
            }

            function validarNombreEditar() {
                var nombre = $("#nombreProyectoEditar").val();
                if (/[\d]/.test(nombre)) {
                    $("#nombreProyectoEditar-error").text("El nombre no debe contener números.");
                    return false;
                } else {
                    $("#nombreProyectoEditar-error").text("");
                    return true;
                }
            }

            function validarFechas() {
                var fechaInicio = new Date($("#fechaInicio").val());
                var fechaFin = new Date($("#fechaFin").val());

                if (fechaInicio && fechaFin && fechaInicio > fechaFin) {
                    $("#fechaFin-error").text("La fecha de fin no puede ser menor a la fecha de inicio.").css("color", "red");
                    return false;
                } else {
                    $("#fechaFin-error").text("");
                    return true;
                }
            }

            function validarFechasEditar() {
                var fechaInicio = new Date($("#fechaInicioEditar").val());
                var fechaFin = new Date($("#fechaFinEditar").val());

                if (fechaInicio && fechaFin && fechaInicio > fechaFin) {
                    $("#fechaFinEditar-error").text("La fecha de fin no puede ser menor a la fecha de inicio.").css("color", "red");
                    return false;
                } else {
                    $("#fechaFinEditar-error").text("");
                    return true;
                }
            }
            function validarDescripcion() {
                var descripcion = $("#descripcionProyecto").val();
                if (descripcion.trim() === "") {
                    $("#descripcionProyecto-error").text("La descripción no puede estar vacía.");
                    return false;
                } else {
                    $("#descripcionProyecto-error").text("");
                    return true;
                }
            }
            function validarDescripcionEditar() {
                var descripcion = $("#descripcionProyectoEditar").val();
                if (descripcion.trim() === "") {
                    $("#descripcionProyectoEditar-error").text("La descripción no puede estar vacía.");
                    return false;
                } else {
                    $("#descripcionProyectoEditar-error").text("");
                    return true;
                }
            }
            $("#nombreProyecto").on("input", validarNombre);
            $("#nombreProyectoEditar").on("input", validarNombreEditar);
            $("#descripcionProyecto").on("input", validarDescripcion);
            $("#descripcionProyectoEditar").on("input", validarDescripcionEditar);
            $("#fechaInicio, #fechaFin").on("change", validarFechas);
            $("#fechaInicioEditar, #fechaFinEditar").on("change", validarFechasEditar);


            const id = ''
            $("#agregarProyectos").submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{route('insertarProyectos') }}",
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
                    var errorMessage = "Error de proceso: cédula duplicada";
                    $("#informacion").text(errorMessage);
                    alert(error);
                    $("#modalInformativo").modal("show");
                });

            });

            $(".cargarModal").click(function() {
                var informacionCompleta = $(this).attr("id");
                var arrayInformacion = informacionCompleta.split("_");

                if (arrayInformacion.length >= 6) {
                    var idProyecto = arrayInformacion[0];
                    var nombreProyecto = arrayInformacion[1];
                    var descripcionProyecto = arrayInformacion[2];
                    var fechaInicio = arrayInformacion[3];
                    var fechaFin = arrayInformacion[4];
                    var estadoProyecto = arrayInformacion[5];

                    $("#myModalEditar #id").val(idProyecto);
                    $("#myModalEditar #nombreProyectoEditar").val(nombreProyecto);
                    $("#myModalEditar #descripcionProyectoEditar").val(descripcionProyecto);
                    $("#myModalEditar #fechaInicioEditar").val(fechaInicio);
                    $("#myModalEditar #fechaFinEditar").val(fechaFin);
                    $("#myModalEditar #idEditar").val(idProyecto);
                    $("#myModalEditar #estadoEditar").val(estadoProyecto);
                } else {
                    console.error("La información no tiene el formato esperado.");
                }
            });

            $(".formTareas").submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                var idProyecto = $(this).data('id');

                $.ajax({
                    url: "{{ route('establecerTareas') }}",
                    type: "POST",
                    data: formData + "&idProyecto=" + idProyecto +"&sprint=1",
                    dataType: "json",
                    encode: true,

                    success: function(data) {
                        window.location.href = "{{ route('mostrarTareas')}}";
                    },
                    error: function(xhr, status, error) {}
                });
            });

            $("#actualizarProyectos").submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{route('actualizarProyectos') }}",
                    type: "PUT",
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
                    var errorMessage = "Error de proceso: conexión perdida";
                    $("#informacion").text(errorMessage);
                    alert(error);
                    $("#modalInformativo").modal("show");
                });
            });

            // Agregar eventos de cambio a los campos de nombre y apellido
            $("#nombreProyecto,#fechaFin,#descripcionProyecto").on("input", function() {
                validarNombre();
                validarFechas();
                validarDescripcion();
                // Habilitar o deshabilitar el botón de registro según el resultado de las validaciones
                var habilitarRegistro = validarNombre() && validarFechas() && validarDescripcion();
                $("#btnGuardar").prop("disabled", !habilitarRegistro);
            });

            $(".btn-cerrar-sesion").click(function(){

                window.location.href = "{{route('login')}}";
            });
        });
    </script>
</body>

</html>