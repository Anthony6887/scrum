<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>

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
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('../recursos/login.avif');
        }

        .login-container {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-container h2 {
            margin-bottom: 30px;
            color: #333;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .login-container input[type="submit"] {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-container input[type="submit"]:hover {
            background-color: #0056b3;
        }


        .login-container a {
            text-decoration: none;
            color: #007bff;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form id="formLogin">
            <input type="text" id="cedula" name="cedula" placeholder="Cédula" maxlength="10"  required>
            <input type="password" id="clave" name="clave" placeholder="Contraseña" required>
            <input type="submit" value="Iniciar Sesión">
        </form>
        <br>
        <br>
        ¿Aún no tienes una cuenta registrate?<a href="/registro"> Aquí</a>
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
        $(document).ready(function () {

            $("#formLogin").submit(function (event) {
                event.preventDefault();
                var formData = $(this).serializeArray();
                var cedula = '';
                formData.forEach(function (field) {
                    if (field.name === "cedula") {
                        cedula = field.value;
                    }
                });

                $.ajax({
                    url: "http://localhost:81/Apis/Personas/apiPersonas.php", type: "GET", data:
                        formData, dataType: "json", encode: true,
                }).done(function (data) {
                    if (data.length != 0) {
                        cedula = data[0]['cedula'];

                        window.location.href="{{ route('establecerParticipante')}}?cedula=" + cedula;

                        setTimeout(function () {
                            window.location.href = "{{ route('mostrarProyectos')}}";
                        }, 2000);
                    } else {
                        $("#informacion").text("Credenciales Incorrectas");
                        $("#modalInformativo").modal("show");
                    }

                }).fail(function (xhr, status, error) {
                    $("#informacion").text("Error de proceso : cédula duplicada");
                    console.error("Error en la solicitud: " + error);
                });

            });

        });
    </script>
</body>

</html>