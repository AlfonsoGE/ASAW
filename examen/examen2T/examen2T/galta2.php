<?php
session_start();
require_once 'bbdd.php';
require_once 'func.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    
    
    function validarDatosRegistro() {
    $datos = Array();
    $datos[0] = (isset($_REQUEST['NombreProducto']))?
            $_REQUEST['NombreProducto']:"";
    $datos[0] = limpiar($datos[0]);
    $datos[1] = (isset($_REQUEST['PrecioUnidad']))?
            $_REQUEST['PrecioUnidad']:"";
    $datos[2] = (isset($_REQUEST['UnidadesExistencia']))?
            $_REQUEST['UnidadesExistencia']:"";

    //-----validar ---- //
    $errores = Array();
    $errores[0] = !validarNombreProducto($datos[0]);
    $errores[1] = !validarPrecio($datos[1]);
    $errores[2] = !validarExistencia($datos[2]);

    // ----- Asignar a variables de Sesión ----//
    $_SESSION['datos'] = $datos;
    $_SESSION['errores'] = $errores;  
    $_SESSION['hayErrores'] = 
            ($errores[0] || $errores[1] || $errores[2]);
    
}


// PRINCIPAL //
validarDatosRegistro();
if ($_SESSION['hayErrores']) {
    $url = "falta2.php";
    header('Location:'.$url);
} else {
    $db = conectaBd();
    $producto = $_SESSION['datos'][0];
    $precio = $_SESSION['datos'][1];  
    $existencias = $_SESSION['datos'][2];
    $consulta = "INSERT INTO producto 
    (NombreProducto, PrecioUnidad, UnidadesExistencia)
    VALUES (:NombreProducto, :PrecioUnidad, :UnidadesExistencia)";
    $resultado = $db->prepare($consulta);
    if ($resultado->execute(array(":NombreProducto" => $producto, ":PrecioUnidad" => $precio, ":UnidadesExistencia" => $existencias))) {
        unset($_SESSION['datos']);
        unset($_SESSION['errores']);
        unset($_SESSION['hayErrores']);
        $url = "listado.php";
        header('Location:'.$url);
    } else {
        $url = "error.php?msg_error=Error_Grabar_Nuevo_Producto";
        header('Location:'.$url);
    }

    $db = null;

}

?>