<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.min.js"> </script>
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"> </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js">    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"> </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"> </script>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            /* Reemplaza 'tu_imagen_de_fondo.jpg' con la ruta de tu imagen */
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
    </style>
</head>

<body>
    <div class="container">
        <form id="nuevoRegistro">
            @csrf
            <div class="form-group">
                <label for="cedula">Cedula:</label>
                <input type="text" id="cedula" name="cedula" required>
            </div>

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" required>
            </div>

            <div class="form-group">
                <label for="fechaNacimiento">Fecha de Nacimiento:</label>
                <input type="date" id="fechaNacimiento" name="fechaNacimiento" required>
            </div>

            <div class="form-group">
                <label for="clave">Clave:</label>
                <input type="password" id="clave" name="clave" required>
            </div>

            <div class="form-group">
                <button type="submit">Registrarse</button>
            </div>
        </form>

        <p>Ya tienes una cuenta. Inicia Sesión <a href="/login">aquí</a>.</p>
    </div>


    <script>
    $(document).ready(function () {

        $("#nuevoRegistro").submit(function (event) {
            event.preventDefault();

            if (validarCedulaEcuatoriana($("#cedula").val()) == false) {
                $("#informacion").text("Cédula no válida");
                $("#modalInformativo").modal("show");
                return;
            }
            
            var formData = $(this).serialize();

            console.log(formData);
            $.ajax({
                url: "{{route('insertarParticipantes') }}", type: "POST", data:
                    formData, dataType: "json", encode: true,
            }).done(function (data) {
                setTimeout(function () {
                    window.location.href = "{{ route('login') }}";
                }, 2000);
            }).fail(function (xhr, status, error) {
                $("#informacion").text("Error de proceso : cédula duplicada");
                console.error("Error en la solicitud: " + error);
            });

        });

    });
    function validarCedulaEcuatoriana(cedula) {
        if (cedula.length !== 10) {
            return false;
        }

        if (!/^\d+$/.test(cedula)) {
            return false;
        }

        if (!/(.)\1{2,}/.test(cedula)) {
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

        return false;
    }



</script>
</body>


</html>