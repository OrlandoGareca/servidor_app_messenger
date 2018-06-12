<?php
    require 'Mensajes.php';
    setlocale(LC_TIME,'spanish');
    date_default_timezone_set('America/La_Paz');

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $datos = json_decode(file_get_contents("php://input"),true);
        $emisor = $datos["emisor"];
        $receptor = $datos["receptor"];
        $mensaje =$datos ["mensaje"];
        $NameTableEmisor = "Mensajes_" . $emisor;
        $NameTableReceptor = "Mensajes_" . $receptor;

        $respuestaCreateTableEmisor = Mensajes::CreateTable($NameTableEmisor);
        if($respuestaCreateTableEmisor == 200){
            echo "la tabla del emisor se ha creado correctamente";
        }else {
            echo "la tabla del emisor ya existe";
        }

        $respuestaCreateTableReceptor = Mensajes::CreateTable($NameTableReceptor);
        if($respuestaCreateTableReceptor == 200){
            echo "la tabla del receptor se ha creado correctamente";
        }else {
            echo "la tabla del receptor ya existe";
        }

        
        
        $fechaActual = getdate();
        $segundos = $fechaActual['seconds'];
        $minutos = $fechaActual['minutes'];
        $hora = $fechaActual['hours'];
        $dia = $fechaActual['mday'];
        $mes = $fechaActual['mon'];
        $year = $fechaActual['year'];
        $miliseconds = DateTime::createFromFormat('U.u',microtime(true)); 
        
      
        $id_user_emisor = $emisor . "_" . $hora . $minutos . $segundos . $miliseconds->format("u");
        $id_user_receptor = $receptor . "_" . $hora . $minutos . $segundos . $miliseconds->format("u");

        $hora_del_mensaje = strftime("%H:%M , %A, %d de %B de %Y ");
        
        $respuestaEnviarMensajeEmisor = Mensajes::EnviarMensaje($NameTableEmisor, $id_user_emisor, $mensaje,1,$hora_del_mensaje);
        if($respuestaEnviarMensajeEmisor == 200){
            echo "el mensaje del emisor se ha enviado correctamente";
        }else {
            echo "no se pudo enviar el mensaje";
        }

        $respuestaEnviarMensajeReceptor = Mensajes::EnviarMensaje($NameTableReceptor, $id_user_receptor, $mensaje,2,$hora_del_mensaje);
        if($respuestaEnviarMensajeReceptor == 200){
            echo "el mensaje del receptor se ha enviado correctamente";
        }else {
            echo "no se pudo enviar el mensaje";
        }
        

       

        

    }    
    
?>