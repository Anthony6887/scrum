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
                <a class="navbar-brand mx-auto" href="#">Registro Participantes</a>
                <a class="principal ml-auto" href="/">Principal</a>
            </div>
        </nav>
    </header>


    @section('content ')
    <div class="contenedor" align="center">
        <h2>Registro de Participantes</h2>                
        <button type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#myModal">Agregar Participante</button>
    <div class="table">
        <table class="table table - striped " id=" tablaParticipantes">
            <thead>
                <tr>
                    <th scope="col">Cedula</th>
                    <th scope=" col"> Nombre </th>
                    <th scope=" col"> Apellido </th>
                    <th scope="col"> Fecha de Nacimiento </th>
                    <th scope=" col"> Rol </th>
                    <th scope="col"> Clave</th>
                    <th scope=" col"> Acciones </th>
                </tr>
            </thead>
            <tbody>
                @foreach($listaParticipantes as $participante)
                <tr>
                    <td> {{ $participante['cedula']}}</td>
                    <td> {{ $participante['nombre']}}</td>
                    <td> {{ $participante['apellido']}}</td>
                    <td> {{ $participante['fechaNacimiento']}}</td>
                    <td> {{ $participante['rol']}}</td>
                    <td> {{ $participante['clave']}}</td>
                    <td>
                        <button type="button" class="btn btn-warning cargarModal" data-toggle="modal"
                            data-target="#myModalEditar">
                            Actualizar </button>
                        <button type="button" class="btn btn-danger cargarModal" data-toggle="modal"
                            data-target="#eliminarModal">
                            Eliminar </button>

                    </td>
                </tr>
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
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control bloquearNumeros" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellido:</label>
                            <input type="text" class="form-control bloquearNumeros" id="apellido" name="apellido" required>
                        </div>
                        <div class="form-group">
                            <label for="fechaNacimiento">Fecha de
                                Nacimiento:</label><span id="fechaValida" hidden>Tiene que ser mayor de edad</span>
                            <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" max="2004-01-01" min="1980-01-01"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="rol">Rol:</label>
                            <select class="form-control" id="rol" name="rol" required>
                                <option value="scrumMaster">Scrum Master</option>
                                <option value="desarrollador">Desarrollador</option>
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="clave">Clave:</label>
                            <input type="password" class="form-control" id="clave" name="clave" required>
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
                    <form id="actualizarParticipantes">
                        @csrf
                        <div class="form-group">
                            <label for="cedula">Cédula:</label>
                            <input type="text" class="form-control" id="cedulaE" name="cedula" required readOnly>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control bloquearNumeros" id="nombreA" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellido:</label>
                            <input type="text" class="form-control bloquearNumeros" id="apellidoE" name="apellido" required>
                        </div>
                        <div class="form-group">
                            <label for="fechaNacimiento">Fecha de
                                Nacimiento:</label><span id="fechaValidaE" hidden>Tiene que ser mayor de edad</span>
                                <input type="date" class="form-control" id="fechaNacimientoE" name="fechaNacimiento" max="2004-01-01" min="1980-01-01"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="rol">Rol:</label>
                            <select class="form-control" id="rol" name="rol" required>
                                <option value="scrumMaster">Scrum Master</option>
                                <option value="desarrollador">Desarrollador</option>
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="clave">Clave:</label>
                            <input type="password" class="form-control" id="claveA" name="clave" required>
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

            $('#fechaNacimiento').on('input', function() {
                var selectedDate = new Date($(this).val());
                var minDate = new Date('2004-01-01');
                if (selectedDate > minDate) {
                    $(this).val('');
                    $('#fechaValida').attr("hidden", false);
                }else{
                    $('#fechaValida').attr("hidden", true);
                }
            });

            $('#fechaNacimientoE').on('input', function() {
                var selectedDate = new Date($(this).val());
                var minDate = new Date('2004-01-01');
                if (selectedDate > minDate) {
                    $(this).val('');
                    $('#fechaValidaE').attr("hidden", false);
                }else{
                    $('#fechaValidaE').attr("hidden", true);
                }
            });

            $("#agregarParticipantes").submit(function (event) {
                event.preventDefault();

                if (validarCedulaEcuatoriana($("#cedula").val()) == false){
                    $("#informacion").text("Cédula no válida");
                    $("#modalInformativo").modal("show");
                    return;
                }

                var formData = $(this).serialize();
                $.ajax({
                    url: "{{route('insertarParticipantes') }}", type: "POST", data:
                        formData, dataType: "json", encode: true,
                }).done(function (data) {
                    $("#informacion").text("Proceso realizado con éxito");
                    $("#modalInformativo").modal("show");
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }).fail(function (xhr, status, error) {
                    $("#informacion").text("Error de proceso : cédula duplicada");
                    console.error("Error en la solicitud: " + error);
                });

            });

            $(".cargarModal").click(function () {
                var fila = $(this).closest("tr");
                var cedula = fila.find("td:eq(0)").text();
                var nombre = fila.find("td:eq(1)").text();
                var apellido = fila.find("td:eq(2)").text();
                var fechaNacimiento = fila.find("td:eq(3)").text();
                var rol = fila.find("td:eq(4)").text();
                var clave = fila.find("td:eq(5)").text();
                $("#cedulaE").val(cedula);
                $("#nombreA").val(nombre);
                $("#apellidoE").val(apellido);
                $("#fechaNacimientoE").val(fechaNacimiento);
                $("#rolE").val(rol);
                $("#claveA").val(clave);
                $("#cedulaH").val(cedula);
            });

            $("#actualizarParticipantes").submit(function (event) {
                event.preventDefault();
                var formData = $(this).serialize(); $.ajax({
                    url: "{{route('actualizarParticipantes') }}",
                    type: "PUT", data: formData, dataType: "json", encode: true,
                }).done(function (data) {
                    $("#informacion").text("Proceso realizado con éxito");
                    $("#modalInformativo").modal("show");
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }).fail(function (xhr, status, error) {
                    $("#informacion").text("Error de proceso : Conexión Perdida");
                    $("#modalInformativo").modal("show");
                    console.error("Error en la solicitud: " + error);
                });
            });

            $("#eliminarParticipantes").submit(function (event) {

                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{route('eliminarParticipantes')}}",
                    type: "DELETE",
                    data: formData,
                    dataType: "json",
                    encode: true,
                }).done(function (data) {
                    $("#informacion").text("Proceso realizado con éxito");
                    $("#modalInformativo").modal("show");
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }).fail(function (xhr, status, error) {
                    $("#informacion").text("Error de proceso : Conexión Perdida");
                    $("#modalInformativo").modal("show");
                    console.error("Error en la solicitud: " + error);
                });

            });

        });
    function validarCedulaEcuatoriana(cedula) {
    if (cedula.length !== 10) {
        return false;
    }

    const digitos = cedula.split('').map(Number);
    const coeficientes = [2, 1, 2, 1, 2, 1, 2, 1, 2];
    let suma = 0;

    for (let i = 0; i < 9; i++) {
        let resultado = digitos[i] * coeficientes[i];
        if (resultado > 9) {
            resultado -= 9;
        }
        suma += resultado;
    }

    const digitoVerificador = (10 - (suma % 10)) % 10;

    return digitoVerificador === digitos[9];
}
    </script>
</body>

</html>