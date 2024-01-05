<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <!-- Eliminada una referencia duplicada de jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('../recursos/registro.avif');
        }

        .container {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .login-container a {
            text-decoration: none;
            color: #007bff;
            font-size: 14px;
        }

        a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <form id="nuevoRegistro">
            @csrf
            <div class="form-group">
                <label for="cedula">Cedula:</label>
                <input type="text" id="cedula" name="cedula" maxlength="10" required>
                <span class="error-message" id="cedula-error"></span>
            </div>

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
                <span class="error-message" id="nombre-error"></span>
            </div>

            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" required>
                <span class="error-message" id="apellido-error"></span>
            </div>

            <div class="form-group">
                <label for="fechaNacimiento">Fecha de Nacimiento:</label>
                <input type="date" id="fechaNacimiento" name="fechaNacimiento" min="1974-01-01" required>
                <span class="error-message" id="fechaNacimiento-error"></span>
            </div>

            <div class="form-group">
                <label for="clave">Clave:</label>
                <input type="password" id="clave" name="clave" required>
            </div>

            <div class="form-group">
                <button type="submit" id="btnRegistrarse" disabled="true">Registrarse</button>
            </div>
        </form>

        <p>Ya tienes una cuenta. Inicia Sesión <a href="/login">aquí</a>.</p>
    </div>

    <script>
        $(document).ready(function() {

            function validarCedula() {
                var cedula = $("#cedula").val();

                // Verificar que la cédula contenga solo números y tenga la longitud adecuada
                if (!/^\d+$/.test(cedula) || cedula.length !== 10) {
                    $("#cedula-error").text("La cédula debe contener 10 números.");
                    return false;
                }

                // Obtener los dígitos de la cédula y convertirlos a números
                var digitos = cedula.split('').map(Number);

                // Verificar reglas específicas para la cédula ecuatoriana
                if (digitos[0] < 0 || digitos[0] > 24 || digitos[2] > 5 || digitos[9] !== obtenerDigitoVerificador(digitos)) {
                    $("#cedula-error").text("La cédula no es válida.");
                    return false;
                }

                // Verificar si todos los dígitos son iguales (caso especial)
                if (new Set(digitos).size === 1) {
                    $("#cedula-error").text("La cédula no es válida.");
                    return false;
                }

                // Limpiar mensajes de error si la cédula es válida
                $("#cedula-error").text("");
                return true;
            }

            // Función para obtener el dígito verificador según el algoritmo del "Módulo 10"
            function obtenerDigitoVerificador(digitos) {
                var coeficientes = [2, 1, 2, 1, 2, 1, 2, 1, 2];
                var suma = 0;

                for (var i = 0; i < coeficientes.length; i++) {
                    var producto = digitos[i] * coeficientes[i];
                    suma += (producto > 9) ? producto - 9 : producto;
                }

                var residuo = suma % 10;
                return (residuo === 0) ? 0 : 10 - residuo;
            }
            // Función para validar el campo de nombre
            function validarNombre() {
                var nombre = $("#nombre").val();
                if (/[\d]/.test(nombre)) {
                    $("#nombre-error").text("El nombre no debe contener números.");
                    return false;
                } else {
                    $("#nombre-error").text("");
                    return true;
                }
            }

            // Función para validar el campo de apellido
            function validarApellido() {
                var apellido = $("#apellido").val();
                if (/[\d]/.test(apellido)) {
                    $("#apellido-error").text("El apellido no debe contener números.");
                    return false;
                } else {
                    $("#apellido-error").text("");
                    return true;
                }
            }

            //Función para validar el campo de fecha de nacimiento
            function validarFechaNacimiento() {
                var fechaNacimiento = new Date($("#fechaNacimiento").val());
                var today = new Date();
                var edad = new Date(today - fechaNacimiento).getFullYear() - 1970;

                if (edad < 18) {
                    $("#fechaNacimiento-error").text("Debes ser mayor de 18 años.");
                    return false;
                } else {
                    $("#fechaNacimiento-error").text("");
                    return true;
                }
            }


            // Agregar eventos de cambio a los campos de nombre y apellido
            $("#nombre").on("input", validarNombre);
            $("#apellido").on("input", validarApellido);
            $("#fechaNacimiento").on("input", validarFechaNacimiento);
            $("#cedula").on("input", validarCedula);
            // Agregar eventos de cambio a los campos de nombre y apellido
            $("#nombre, #apellido, #fechaNacimiento, #cedula").on("input", function() {
                validarNombre();
                validarApellido();
                validarFechaNacimiento();
                validarCedula(); // Agregado para validar la cédula
                // Habilitar o deshabilitar el botón de registro según el resultado de las validaciones
                var habilitarRegistro = validarNombre() && validarApellido() && validarFechaNacimiento() && validarCedula();
                $("#btnRegistrarse").prop("disabled", !habilitarRegistro);
            });


            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); // Enero es 0!
            var yyyy = today.getFullYear();
            today = yyyy + '-' + mm + '-' + dd;
            $("#fechaNacimiento").attr("max", today);
            $("#nuevoRegistro").submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{route('insertarParticipantes') }}",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    encode: true,
                }).done(function(data) {
                    setTimeout(function() {
                        window.location.href = "{{ route('login') }}";
                    }, 2000);
                }).fail(function(xhr, status, error) {
                    $("#informacion").text("Error de proceso : cédula duplicada");
                    alert("Mensaje Informativo : Este usuario ya se encuentra registrado");
                    console.error("Error en la solicitud: " + error);
                });
            });
        });
    </script>
</body>

</html>