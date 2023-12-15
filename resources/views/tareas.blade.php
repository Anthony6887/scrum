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
            <div class="container">
                <a class="navbar-brand mx-auto" href="#">Gestión de Proyectos</a>
                <a class="principal ml-auto" href="/">Tareas</a>
            </div>
        </nav>
    </header>


    @section('content ')
    <div class="contenedor" align="center">
        <h2>Registro Tareas</h2>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Agregar
            Tarea</button>

        <div class="row">
            @foreach($listaTareas as $tarea)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3>{{ $tarea['nombre'] }}</h3>
                    </div>
                    <div class="card-body">
                        <p>{{ $tarea['descripcion'] }}</p>
                        <p><strong>Estado:</strong> {{ $tarea['estado'] }}</p>
                        <p><strong>Encargado:</strong> {{ $tarea['encargado'] }}</p>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary cargarModal" id="{{ $tarea['id'] }}"
                            data-toggle="modal" data-target="#myModalEditar">
                            Actualizar
                        </button>
                        <button type="button" class="btn btn-success verTareas" id="{{ $tarea['id'] }}">Revisar</button>
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
                    <form id="formAgregar">
                        @csrf
                        <div class="form-group">
                            <label for="nombreProyecto">Nombre de la Tarea:</label>
                            <input type="text" class="form-control" id="nombreTarea" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcionProyecto">Descripción de la Tarea:</label>
                            <textarea class="form-control" id="descripcionTarea" name="descripcion" rows="3"
                                required></textarea>
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
                    <form id="formActualizar">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" id="id" name="id" hidden>
                        </div>
                        <div class="form-group">
                            <label for="nombreProyecto">Nombre del Proyecto:</label>
                            <input type="text" class="form-control" id="nombreProyecto" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcionProyecto">Descripción del Proyecto:</label>
                            <textarea class="form-control" id="descripcionProyecto" name="descripcion" rows="3"
                                required></textarea>
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
                <form id="formEliminar">
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
                <form id="formEliminar">
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
            $("#formAgregar").submit(function (event) {
                event.preventDefault();

                var formData = $(this).serialize();
                $.ajax({
                    url: "{{route('insertarTareas') }}", type: "POST", data:
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
        });
    </script>
</body>

</html>