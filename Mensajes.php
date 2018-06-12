<?php
    require 'Database.php';

    class Mensajes{
        function __construct(){}
        
        public static function CreateTable($NameTable){
            try{
                $consultar = "CREATE TABLE $NameTable (
                    id VARCHAR (50) PRIMARY KEY,
                    mensaje VARCHAR(500) NOT NULL, 
                    tipo_mensaje VARCHAR(10) NOT NULL,
                    hora_del_mensaje VARCHAR(50) NOT NULL)";
                $respuesta = Database::getInstance()->getDb()->prepare($consultar);
                $respuesta -> execute(array());
                return 200;
            }catch(PDOException $e){
                return -1;
            }       
        }

        public static function EnviarMensaje($TableName, $id,$mensaje,$tipo_mensaje, $hora_del_mensaje){
            try{
                $consultar = "INSERT INTO $TableName(id,mensaje,tipo_mensaje,hora_del_mensaje) VALUES (?,?,?,?)";
                $respuesta =  Database::getInstance()->getDb()->prepare($consultar);
                $respuesta ->execute(array($id,$mensaje,$tipo_mensaje,$hora_del_mensaje));

                return 200;
            }catch(PDOException $e){
                return -1;
            }
        }
    }
?>