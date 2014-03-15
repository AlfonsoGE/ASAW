<?php
require_once 'bbdd.php';
require_once 'func.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    $db = conectaBd();
    $login = $_REQUEST['login'];
    $pass = $_REQUEST['password'];
    $nombre =  $_REQUEST['nombre'];
    
    $consulta = "INSERT INTO usuario 
    (login, password, nombre)
    VALUES (:login, :password, :nombre)";
    $resultado = $db->prepare($consulta);
    if ($resultado->execute(array(":login" => $login, ":password" => $pass,
        ":nombre" => $nombre))) {
        $url = "listado.php";
        header('Location:'.$url);
    } else {
        $url = "error.php?msg_error=Error_Grabar_Nuevo_Usuario";
        header('Location:'.$url);
    }

    $db = null;


?>