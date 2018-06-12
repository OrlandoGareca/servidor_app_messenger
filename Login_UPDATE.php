<?php
    require 'Login.php';

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $datos = json_decode(file_get_contents("php://input"),true);
        $respuesta = Registro::ActualizarDatos($datos["id"],$datos["password"]);
        if($respuesta){
            echo "se actualizaron los datos correctamente";
        }else{
            echo "El usuario no existe";
        }

    }
?>