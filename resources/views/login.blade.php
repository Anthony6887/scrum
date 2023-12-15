<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <style>
        /* Estilos para un diseño más atractivo */
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
        <form action="/login" method="post">
            <input type="text" name="number" placeholder="Cédula" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="submit" value="Iniciar Sesión">
        </form>
        <br>
        <br>
        ¿Aún no tienes una cuenta registrate?<a href="/registro"> Aquí</a>
    </div>
</body>

</html>