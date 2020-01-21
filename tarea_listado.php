<?php
    include("sesion.php");
    $conexion = mysqli_connect("localhost", "root", "", "tododb");

    $filtro = '';
    $finalizada = 0;
    if (isset($_GET['filtro'])) {
        $filtro = $_GET['filtro'];
    }
    if (isset($_GET['finalizada'])) {
        $finalizada = 1;
    }

    $sql = "SELECT * FROM tareas WHERE tarea LIKE '%$filtro%' AND finalizada=$finalizada";
    $respuesta_consulta = mysqli_query($conexion, $sql);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Home To-Do</title>
    <meta charset="UTF-8">
    <meta name="viewport" contente="width=device-width, initial-scale=1,shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
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

    <div class="container">
        <div>
            <h2 class="display-3">Listado de tareas</h2>
        </div>
        <div>
            <a class="btn btn-primary mb-2" href="tarea_alta.php" role="button">Agregar tarea</a>
        </div>
        <form class="form-inline" method="GET">
            <div class="form-group mb-2">
                <input type="text" class="form-control" name="filtro" placeholder="Palabra clave" value="<?php echo $filtro; ?>">
            </div>
            <div class="form-check mx-sm-3 mb-2">
                <input type="checkbox" class="form-check-input" name="finalizada" value="1" 
                <?php
                    if ($finalizada) {
                            echo "checked";
                    }
                ?>
                >
                <label class="form-check-label">Terminadas</label>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </form>

        <table class="table table-hover">
            <tr>
                <th scope="row">#</th>
                <th>Tarea</th>
                <th>Realizada</th>
                <th>Fecha Realizada</th>
                <th></th>
                <th></th>
            </tr>
            <?php

            while ($fila = mysqli_fetch_array($respuesta_consulta)) {
                $id = $fila['id'];
                $tarea = $fila['tarea'];
                $estado = $fila['finalizada'];
                $fecha_finalizada = $fila['fecha_finalizada'];
                if ($estado == false) {
                    $finalizada = "No";
                } else {
                    $finalizada = "Si";
                }
                echo "
            <tr>
                    <td>$id</td>
                    <td>$tarea</td>
                    <td>$finalizada</td>
                    <td>$fecha_finalizada</td>
                    <td><a href='tarea_edicion.php?id=$id'>Editar</a></td>
                    <td><a href='tarea_borrado.php?id=$id'>Eliminar</a></td>
            </tr>";
            }

            ?>
        </table>

        <div>
            <a class="btn btn-danger mb-2" href="usuario_salir.php" role="button">Cerrar sesión</a>
        </div>
    </div>
</body>

</html>