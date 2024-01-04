<!DOCTYPE html>
<html>

<head>
    <title>Formulario Modal con Bootstrap</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.min.js"> </script>
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"> </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js">    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"> </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"> </script>

    <script src="{{ asset('js/controlTeclado.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container d-flex justify-content-between align-items-center">
                <a class="navbar-brand mx-auto" href="#">Gestión de Proyectos</a>
                <!-- Agregar enlace para cerrar sesión con clase personalizada -->
                <a class="btn btn-danger btn-cerrar-sesion align-self-end">Cerrar Sesión</a>
            </div>
        </nav>
    </header>




    @section('content')
    <div class="contenedor">
        <h2>Registro de Proyectos</h2>
        <br>
        <button type="button" class="btn btn-primary agregar" data-toggle="modal" data-target="#myModal">Agregar
            Proyecto</button>
        <br>
        <br>
        <div class="row">
            @foreach($listaProyectos as $proyecto)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3>{{ $proyecto['nombre'] }}</h3>
                    </div>
                    <div class="card-body">
                        <p>{{ $proyecto['descripcion'] }}</p>
                        <p><strong>Fecha de inicio:</strong> {{ $proyecto['fechaInicio'] }}</p>
                        <p><strong>Fecha de finalización:</strong> {{ $proyecto['fechaFin'] }}</p>
                        <p><strong>Estado:</strong> {{ $proyecto['estado'] }}</p>
                    </div>
                    <div class="card-footer d-flex align-items-center botones">
                        <button type="button" class="btn btn-primary cargarModal" id="" data-toggle="modal"
                            data-target="#myModalEditar">
                            Actualizar
                        </button>
                        <form class="formTareas" data-id="{{ $proyecto['id'] }}">
                            <input type="text" value="{{ $proyecto['id'] }}" name="idProyecto" hidden>
                            @csrf
                            <button type="submit" class="btn btn-success">Revisar</button>
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
                        </div>
                        <div class="form-group">
                            <label for="descripcionProyecto">Descripción del Proyecto:</label>
                            <textarea class="form-control" id="descripcionProyecto" name="descripcionProyecto" rows="3"
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="fechaInicio">Fecha de Inicio:</label>
                            <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" required>
                        </div>
                        <div class="form-group">
                            <label for="fechaFin">Fecha de Fin:</label>
                            <input type="date" class="form-control" id="fechaFin" name="fechaFin" required>
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
                            <label for="nombreProyecto">Nombre del Proyecto:</label>
                            <input type="text" class="form-control" id="nombreProyecto" name="nombreProyecto" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcionProyecto">Descripción del Proyecto:</label>
                            <textarea class="form-control" id="descripcionProyecto" name="descripcionProyecto" rows="3"
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="fechaInicio">Fecha de Inicio:</label>
                            <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" required>
                        </div>
                        <div class="form-group">
                            <label for="fechaFin">Fecha de Fin:</label>
                            <input type="date" class="form-control" id="fechaFin" name="fechaFin" required>
                        </div>
                        <div class="form-group">
                            <label for="rol">Estado:</label>
                            <select class="form-control" id="estado" name="estado" required>
                                <option value="pendiente">pendiente</option>
                                <option value="finalizado">finalizado</option>
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

    <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="eliminarModal"
        aria-hidden="true">
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

    <div class="modal fade" id="modalInformativo" tabindex="-1" role="dialog" aria-labelledby="modalInformativo"
        aria-hidden="true">
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
        $(document).ready(function () {
            const id = ''
            $("#agregarProyectos").submit(function (event) {
                event.preventDefault();

                var formData = $(this).serialize();
                $.ajax({
                    url: "{{route('insertarProyectos') }}", type: "POST", data:
                        formData, dataType: "json", encode: true,
                }).done(function (data) {
                    $("#informacion").text("Proceso realizado con éxito");
                    $("#modalInformativo").modal("show");
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }).fail(function (xhr, status, error) {
                    var errorMessage = "Error de proceso: cédula duplicada";
                    $("#informacion").text(errorMessage);
                    $("#modalInformativo").modal("show");
                });

            });

            $(".cargarModal").click(function () {
                var informacionCompleta = $(this).attr("id");
                var arrayInformacion = informacionCompleta.split("_");

                $("#myModalEditar #nombreProyecto").val(arrayInformacion[0]);
                $("#myModalEditar #descripcionProyecto").val(arrayInformacion[1]);
                $("#myModalEditar #fechaInicio").val(arrayInformacion[2]);
                $("#myModalEditar #fechaFin").val(arrayInformacion[3]);
                $("#myModalEditar #id").val(arrayInformacion[4]);
                $("#myModalEditar #estado").val(arrayInformacion[5]);
            });

            $(".formTareas").submit(function (event) {
                event.preventDefault();
                var formData = $(this).serialize();
                var idProyecto = $(this).data('id');

                $.ajax({
                    url: "{{ route('establecerTareas') }}",
                    type: "POST",
                    data: formData + "&idProyecto=" + idProyecto,
                    dataType: "json",
                    encode: true,

                    success: function (data) {
                        window.location.href = "{{ route('mostrarTareas')}}";
                    },
                    error: function (xhr, status, error) {
                    }
                });
            });

            $("#actualizarProyectos").submit(function (event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{route('actualizarProyectos') }}",
                    type: "PUT", data: formData, dataType: "json", encode: true,
                }).done(function (data) {
                    $("#informacion").text("Proceso realizado con éxito");
                    $("#modalInformativo").modal("show");
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }).fail(function (xhr, status, error) {
                    var errorMessage = "Error de proceso: conexión perdida";
                    $("#informacion").text(errorMessage);
                    $("#modalInformativo").modal("show");
                });
            });

        });

    </script>
</body>

</html>