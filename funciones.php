<?php
    function subir_imagen(){
        if (isset($_FILES["imagen_producto"])){
            $extension = explode('.', $_FILES["imagen_producto"]['name']);
            $nuevo_nombre = rand() . '.' . $extension[1];
            $ubicacion = './img' . $nuevo_nombre;
            move_uploaded_file($_FILES["imagen_producto"]['tmp_name'], $ubicacion);
            return $nuevo_nombre;
        }
    }
    function obtener_nombre_imagen($id_producto){
        include('conexion.php');
        $stmt = $conexion->prepare("SELECT imagen FROM productos WHERE id = '$id_producto'");
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        foreach($resultado as $fila){
            return $fila["imagen"];
        }
    }
    function obtener_todos_registros(){
        include('conexion.php');
        $stmt = $conexion->prepare("SELECT * FROM productos");
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        return $stmt->rowCount();
    }
?>