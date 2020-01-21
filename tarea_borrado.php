<?php
    include("sesion.php");
    $id = $_GET['id'];
    $conexion = mysqli_connect("localhost", "root", "", "tododb");

    $sql = "DELETE FROM tareas WHERE id=$id";
    $respuesta = mysqli_query($conexion, $sql);
    if($respuesta)

    Header("Location: tarea_listado.php");
?>