<?php

if (!empty($_POST)) {
    if (!isset($_POST['nombre'])) {
        die("El nombre es obligatorio");
    }
    if (!isset($_POST['email'])) {
        die("El email es obligatorio");
    }
    if (!isset($_POST['usuario'])) {
        die("El usuario es obligatorio");
    }
    if (!isset($_POST['clave'])) {
        die("La contraseña es obligatoria");
    }
    if (empty($_POST['nombre'])) {
        die("El nombre no puede quedar vacio");
    }
    if (empty($_POST['email'])) {
        die("El email no puede estar vacio");
    }
    if (empty($_POST['usuario'])) {
        die("El usuario no puede estar vacio");
    }
    if (empty($_POST['clave'])) {
        die("La clave no puede quedar vacia");
    }

    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $clave = $_POST['clave'];
    $clave_encriptada = password_hash($clave, PASSWORD_BCRYPT);

    $conexion = mysqli_connect('localhost', 'root', '', 'tododb');
    if (!$conexion) {
        die("Fallo la conexion a la base de datos");
    }
    //Verificamos que no se repita usuario
    $sql_prueba = "SELECT * FROM usuarios WHERE usuario='%$usuario%' OR email='$email'";
    $respuesta_prueba = mysqli_query($conexion, $sql_prueba);
    if (mysqli_num_rows($respuesta_prueba) > 0) {
        echo ("Usuario o email ya registrado");
    } else {
        $sql = "INSERT INTO usuarios VALUES(NULL,'$nombre','$email','$usuario','$clave_encriptada')";
        $respuesta_consulta = mysqli_query($conexion, $sql);

        if ($respuesta_consulta) {
            Header("Location: usuario_ingreso.php");
            die();
        } else {
            echo ("No se pudo realizar el registro");
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Registro de usuario</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width initial-scale=1, shrink-to-fit=no">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
    <form class="container" method="POST">

        <div class="form-group row">
            <h2 class="display-3">Registro de usuario</h2>
        </div>
        <div class="form-group row">
            <label for="usuario">Nombre completo:</label>
            <input type="text" class="form-control" name="nombre">
        </div>
        <div class="form-group row">
            <label for="usuario">Usuario:</label>
            <input type="text" class="form-control" name="usuario">
        </div>
        <div class="form-group row">
            <label for="usuario">Email:</label>
            <input type="email" class="form-control" name="email">
        </div>
        <div class="form-group row">
            <label for="pass">Contraseña:</label>
            <input type="password" class="form-control" name="clave">
        </div>
        <div class="form-group row">
            <button type="submit" class="btn btn-primary">Registrarse</button>
        </div>

    </form>
</body>

</html>