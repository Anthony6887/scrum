<!DOCTYPE html>
<html>

<head>
    <title>Formulario Modal con Bootstrap</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.min.js"> </script>
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"> </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js">    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"> </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"> </script>
    <script src="{{ asset('js/controlTeclado.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>

<body class="well">
    <header>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Agregar Tarea</button>
                <a class="navbar-brand mx-auto" href="#">Gestión de Proyectos</a>
                <a class="principal ml-auto" href="/principal/participantes">Gestionar Participantes</a>
            </div>
        </nav>
    </header>


    @section('content')
    <!-- <div class="contenedor" align="center">
        <h2>Registro de Tareas</h2>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Agregar Tarea</button>

        <div class="row">
            <div class="col-md-4">
                <div class="card-columns">
                    @foreach($listaTareas as $tarea)
                        <div class="card mb-3" data-state="{{ $tarea['estado'] }}">
                            <div class="card-header">
                                <h3>{{ $tarea['nombre'] }}</h3>
                            </div>
                            <div class="card-body">
                                <p>{{ $tarea['descripcion'] }}</p>
                                <p><strong>Estado:</strong> {{ $tarea['estado'] }}</p>
                                <p><strong>Encargado:</strong> {{ $tarea['encargado'] }}</p>
                            </div>
                            <div class="card-footer">
                                @if($tarea['estado'] != 'FINALIZADO')
                                    @if($tarea['estado'] == 'PENDIENTE')
                                        <form class="formTareasAsignar" data-id="{{ $tarea['id'] }}">
                                            <input type="text" value="{{ $tarea['id'] }}" name="idTarea" hidden>
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Asignarme Tarea</button>
                                        </form>
                                    @else
                                        @if($tarea['encargado'] == $usuario)
                                            <form class="formTareasFinalizar" data-id="{{ $tarea['id'] }}">
                                                <input type="text" value="{{ $tarea['id'] }}" name="idTarea" hidden>
                                                @csrf
                                                <button type="submit" class="btn btn-primary">Finalizar Tarea</button>
                                            </form>
                                        @endif
                                    @endif
                                @endif
                                <button type="button" class="btn btn-success eliminarTarea" id="{{ $tarea['id'] }}">Eliminar</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div> -->
    <div id="container">
        <div id="header"> Listado de tareas </div>

        <div class="task-list task-container" id="pending">
            <h3>Pendientes</h3>
            @foreach($listaTareas as $tarea)
            @if($tarea['estado'] === 'PENDIENTE')
            <div class="todo-task">
                <div class="task-header"><strong>Tarea: </strong>{{ $tarea['nombre'] }}</div>
                <div class="task-date"><strong>Encargado: </strong>{{ $tarea['encargado'] }}</div>
                <div class="task-description"><strong>Descripción: </strong>{{ $tarea['descripcion'] }}</div>
                <div class="task-buttons">
                    <form class="formTareasAsignar" data-id="{{ $tarea['id'] }}">
                        <input type="text" value="{{ $tarea['id'] }}" name="idTarea" hidden>
                        @csrf
                        <button type="submit" class="btn btn-primary">Asignarme Tarea</button>
                    </form>
                </div>
            </div>
            @endif
            @endforeach
        </div>

        <div class="task-list task-container" id="inProgress">
            <h3>En Curso</h3>
            @foreach($listaTareas as $tarea)
            @if($tarea['estado'] === 'EN PROGRESO')
            <div class="todo-task">
                <div class="task-header"><strong>Tarea: </strong>{{ $tarea['nombre'] }}</div>
                <div class="task-date"><strong>Encargado: </strong>{{ $tarea['encargado'] }}</div>
                <div class="task-description"><strong>Descripción: </strong>{{ $tarea['descripcion'] }}</div>
                <div class="task-buttons">
                    <form class="formTareasFinalizar" data-id="{{ $tarea['id'] }}">
                        <input type="text" value="{{ $tarea['id'] }}" name="idTarea" hidden>
                        @csrf
                        <button type="submit" class="btn btn-warning">Finalizar Tarea</button>
                    </form>
                </div> 
            </div>
            @endif
            @endforeach
        </div>

        <div class="task-list task-container" id="completed">
            <h3>Finalizadas</h3>
            @foreach($listaTareas as $tarea)
            @if($tarea['estado'] === 'FINALIZADO')
            <div class="todo-task">
                <div class="task-header"><strong>Tarea: </strong>{{ $tarea['nombre'] }}</div>
                <div class="task-date"><strong>Estado: </strong>{{ $tarea['encargado'] }}</div>
                <div class="task-description"><strong>Descripción: </strong>{{ $tarea['descripcion'] }}</div>
                <div class="task-buttons">
                    <button type="button" class="btn btn-danger eliminarTarea" id="{{ $tarea['id'] }}">Eliminar</button>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>

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
                        <label for="text">¿Está seguro de eliminar?</label>
                        <input type="text" id="idTareaH" name="idTarea" hidden>
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

            $(".eliminarTarea").click(function () {
                idTarea = $(this).attr("id");
                $("#idTareaH").val(idTarea);
                $("#eliminarModal").modal("show");
            });

            $("#formEliminar").submit(function (event) {
                event.preventDefault();

                var formData = $(this).serialize();
                $.ajax({
                    url: "{{route('eliminarTareas') }}", type: "DELETE", data:
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

            $(".formTareasAsignar").submit(function (event) {
                event.preventDefault();
                var formData = $(this).serialize();
                var idTarea = $(this).data('id');

                $.ajax({
                    url: "{{ route('actualizarTareas') }}",
                    type: "PUT",
                    data: formData + "&idTarea=" + idTarea + "&estado=progreso",
                    dataType: "json",
                    encode: true,

                    success: function (data) {
                        window.location.href = "{{ route('actualizarTareas')}}";
                    },
                    error: function (xhr, status, error) {
                    }
                });
            });

            $(".formTareasFinalizar").submit(function (event) {
                event.preventDefault();
                var formData = $(this).serialize();
                var idTarea = $(this).data('id');

                $.ajax({
                    url: "{{ route('actualizarTareas') }}",
                    type: "PUT",
                    data: formData + "&idTarea=" + idTarea + "&estado=finalizar",
                    dataType: "json",
                    encode: true,

                    success: function (data) {
                        window.location.href = "{{ route('mostrarTareas')}}";
                    },
                    error: function (xhr, status, error) {
                    }
                });
            });
        });
    </script>
</body>

</html>