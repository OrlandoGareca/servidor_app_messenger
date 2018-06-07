<?php
	
	require 'Database.php';

	Registro::ObtenerTodosLosUsuarios();

	class Registro{
		function _construct(){
		}

		public static function ObtenerTodosLosUsuarios(){
			$consultar = "SELECT * FROM Login";
			
			$resultado = Database::getInstance()->getDb()->prepare($consultar);

			$resultado->execute();

			$tabla = $resultado->fetchAll(PDO::FETCH_ASSOC);

			return $tabla;		

		}

		public static function ObtenerDatosPorId($id){
			$consultar = "SELECT id,Password FROM Login WHERE id = ?";
			try{
				$resultado = Database::getInstance()->getDb()->prepare($consultar);

				$resultado->execute(array($id));

				$tabla = $resultado->fetchAll(PDO::FETCH_ASSOC);

				return $tabla;	
			}catch(PDOException $e){
				return false;

			}
				

		}

	}

?>
