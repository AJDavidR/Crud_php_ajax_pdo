<?php
    include("conexion.php");
    include("funciones.php");

    if($_POST["operacion"] == "Crear") {
        $imagen = '';
        if ($_FILES["imagen_producto"]["name"] !=''){
            $imagen = subir_imagen();
        }
    $stmt = $conexion->prepare("INSERT INTO productos(codigo, nombre, precio)VALUES(:codigo, :nombre, :precio)");
    }
    $resultado = $stmt->execute(
        array(
            ':codigo'       => $_POST["codigo"],
            ':nombre'       => $_POST["nombre"],
            ':precio'       => $_POST["precio"]
        )
        );

        if(!empty($resultado)){
            echo 'Registro Creado'
        };
?>