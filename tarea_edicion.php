<?php
    include("sesion.php");
    $id = $_GET['id'];
    $conexion = mysqli_connect("localhost", "root", "", "tododb");
    if (!empty($_POST)) {
        if(!isset($_POST)){
            die('No existe el nombre');
        }
        if(empty($_POST)){
            die('Debes ingresar un nombre para la tarea');
        }
        $tarea = $_POST['tarea'];
        $finalizada = 0;
        
        if(isset($_POST['finalizada'])){
            $finalizada = 1;
        }

        $sql = "UPDATE tareas SET tarea='$tarea', finalizada=$finalizada"; 
        if($finalizada){
            $fecha = date('Y-m-d');
            $sql = $sql . ", fecha_finalizada = '$fecha'";
        } else {
            $sql = $sql . ", fecha_finalizada = NULL";
        }
        $sql = $sql . " WHERE id=$id";
    
       
        $respuesta_consulta = mysqli_query($conexion, $sql);

        if ($respuesta_consulta) {
            Header("Location: tarea_listado.php");
        } else {
            die("No se pudo hacer la consulta.");
        }
    }

    
    $sql = "SELECT * FROM tareas WHERE id=$id";
    $respuesta = mysqli_query($conexion, $sql);
    $registro = mysqli_fetch_array($respuesta);

    if ($registro == NULL) {
        die("No existe la tarea");
    }

    $tarea = $registro['tarea'];
    $finalizada = $registro['finalizada'];
    $fecha_realizada = $registro['fecha_finalizada'];

?>

<!DOCTYPE html>
<html>

<head>
    <title>Alta de tarea</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <form class="container" method="POST">
        
        <div class="form-group row">
            <h2 class="display-3">Edicion de tarea</h2>
        </div>
        <div class="form-group row">
            <label for="usuario">Nombre tarea:</label>
            <input type="text" class="form-control" name="tarea" value="<?php echo $tarea;?> ">
        </div>
        
        <div class="form-group row">
            <label>¿Esta realizada?</label>
        </div>

        <div class="form-check row">
            <input type="checkbox" class="form-check-input" name="finalizada" value="1"
            <?php
            if($finalizada){
                echo "checked";
            }
            ?>
            >
            <label class="form-check-label">Si</label>
        </div>

        <div class=" form-group row">
            <button type="submit" class="btn btn-primary">Editar</button>
        </div>

    </form>
</body>
</html>

