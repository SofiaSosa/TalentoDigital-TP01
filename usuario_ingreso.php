<?php
    if(!empty($_POST))
    {
        
        if(!isset($_POST['usuario'])){
            die("El usuario es obligatorio");
        }
        if(!isset($_POST['clave'])){
            die("La contraseña es obligatoria");
        }
        if(empty($_POST['usuario'])){
            die("El usuario no puede estar vacio");
        }
        if(empty($_POST['clave'])){
            die("La clave no puede quedar vacia");
        }

        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $conexion = mysqli_connect("localhost", "root", "", "tododb");
        if (!$conexion) {
            die("Fallo la conexion a la base de datos");
        }

        $sql = "SELECT * FROM usuarios WHERE usuario='%$usuario%'";//aca puse like y es =
        $respuesta_consulta = mysqli_query($conexion, $sql);
        $registro = mysqli_fetch_array($respuesta_consulta);

        if ($registro) {
            $clave_db = $registro['clave'];
            if (password_verify($clave, $clave_db)) {
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['id'] = $registro['id'];
                Header( "Location: tarea_listado.php");
                die();
            } else {
                echo("Contraseña incorrecta");
            }
        } else {
                echo("No existe el usuario");
        }

    }

?>

<!DOCTYPE html>
<html>

<head>
    <title>Ingreso Usuario</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <form class="container" method="post">

        <div class="form-group">
            <h2 class="display-3">Ingreso usuario</h2>
        </div>
        <div class="form-group">
            <label for="usuario">Usuario:</label>
            <input type="text" class="form-control" name="usuario">
        </div>
        <div class="form-group">
            <label for="pass">Contraseña:</label>
            <input type="password" class="form-control" name="clave">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Ingresar</button>
        </div>

    </form>
    
</body>


</html>

