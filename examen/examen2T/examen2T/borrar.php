<?php
session_start();
require_once 'bbdd.php';
    
    $_SESSION['IdProducto'] = (isset($_SESSION['IdProducto']))?
            $_SESSION['IdProducto']:0;
    
    $db = conectaBd();
     
    $consulta = "DELETE FROM producto WHERE IdProducto = :IdProducto ";
    $resultado = $db->prepare($consulta);
    if ($resultado->execute(array(":IdProducto" => $_SESSION['IdProducto']))) {
            unset($_SESSION['IdProducto']);
            $url = "listado.php";
            header('Location:'.$url);
    } else {
        $url = "error.php?msg_error=Error_Eliminar_Producto";
        header('Location:'.$url);
    }

    $db = null;


?>