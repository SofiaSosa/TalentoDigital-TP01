<?php
session_start();
if (!isset($_SESSION['id'])) {
    Header("Location: index.php");
    die();
}
?>