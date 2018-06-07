<?php
    require 'Login.php';
    if($_SERVER['REQUEST_METHOD']=='GET'){
        if(isset($_GET['id'])){
            $identificador = $_GET['id']; 
            
            $respuesta = Registro:: ObtenerDatosPorId($identificador);
            
            if($respuesta){
                echo json_encode($respuesta);
            }else{
                echo json_encode(array('resultado' => 'El usuario no existe'));
            }
          
        }
        
        
    }
?>