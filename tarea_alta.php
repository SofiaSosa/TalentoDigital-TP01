<?php
include("sesion.php");
if (!empty($_POST)) {
    
    if (!isset($_POST['tarea'])) {
        die('El nombre es obligatorio');
    }
    if (empty($_POST['tarea'])) {
        die('Debes ingresar el nombre de la tarea');
    }

    $conexion = mysqli_connect("localhost", "root", "", "tododb");
    if (!$conexion) {
        echo "Fallo la conexion";
        die();
    }

    $tarea = $_POST['tarea'];

    if (isset($_POST['finalizada'])) {
        $finalizada = 1;
        if(!$_POST['fecha_finalizada']){
            $fecha_finalizada = date('Y-m-d');
            $sql = "INSERT INTO tareas VALUES (NULL,'$tarea','$finalizada','$fecha_finalizada')";
        } else {
            $fecha_finalizada = $_POST['fecha_finalizada'];
            $sql = "INSERT INTO tareas VALUES (NULL,'$tarea','$finalizada','$fecha_finalizada')";
        }
    } else {
        $finalizada = 0;
        $sql = "INSERT INTO tareas VALUES (NULL,'$tarea','$finalizada', NULL)";
    }

    $respuesta = mysqli_query($conexion, $sql);

    if ($respuesta) {
        Header("Location: tarea_listado.php");
        die();
    } else {
        die("No se pudo ingresar el registro en la base de datos");
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Alta de tarea</title>
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
    <form class="container" method="post">

        <div class="form-group row">
            <h2 class="display-3">Alta de tarea</h2>
        </div>
        <div class="form-group row">
            <label for="usuario">Nombre tarea:</label>
            <input type="text" class="form-control" name="tarea">
        </div>
        <!-- Group of material radios - option 1 -->
        <div class="form-group row">
            <label for="usuario">¿Esta realizada?</label>
        </div>
        <div class="form-check row">
            <input type="checkbox" class="form-check-input" name="finalizada" value="1">
            <label class="form-check-label">Si</label>
        </div>

        <div class="form-group row">
            <label for="example-date-input" class="col-form-label">*Si esta realizada ingresar fecha:</label>
            <input class="form-control" type="date" name="fecha_finalizada">
        </div>

        <div class="form-group row">
            <button type="submit" class="btn btn-primary">Agregar</button>
        </div>

    </form>
</body>

</html>