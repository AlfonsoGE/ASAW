<?php
session_start();
require_once 'func.php';
    // Estructura: campos del formulario
$_SESSION['datos'] = (isset($_SESSION['datos']))?
            $_SESSION['datos']:Array('','','');
$_SESSION['errores'] = (isset($_SESSION['errores']))?
            $_SESSION['errores']:Array(FALSE,FALSE,FALSE);
$_SESSION['hayErrores'] = (isset($_SESSION['hayErrores']))?
            $_SESSION['hayErrores']:FALSE;
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Examen 2T</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="estilo.css">
    </head>
    <body>
        <div class="formulario">&nbsp;</div>
        <h1>Alta Producto 2 (con val)</h1>
        <ul>         
        <li><a href="listado.php">Listado</a></li>
        </ul>
        <form action="galta2.php" method="GET">
            <div>Nombre Producto: <input type="text" name="NombreProducto"
                                         value="<?php echo $_SESSION['datos'][0]; ?>"/>
            </div>
             <?php
                if ($_SESSION['errores'][0]) {
                    echo "<div class 'error'>".MSG_ERR_PRODUCTO."</div>";
                }
            ?>
            <div>Precio Unidad <input type="text" name="PrecioUnidad" 
                                      value="<?php echo $_SESSION['datos'][1]; ?>"/>
            </div>
             <?php
                if ($_SESSION['errores'][1]) {
                    echo "<div class 'error'>".MSG_ERR_PRECIO."</div>";
                }
            ?>
             <div>Existencias <input type="text" name="UnidadesExistencia" 
                                     value="<?php echo $_SESSION['datos'][2]; ?>"/></div>
             <?php
                if ($_SESSION['errores'][2]) {
                    echo "<div class 'error'>".MSG_ERR_EXISTENCIA."</div>";
                }
            ?>
            <input type="submit" value="Grabar" />
        </form>
    </body>
</html>