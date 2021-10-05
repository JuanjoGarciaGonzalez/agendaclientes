<?php
	require_once "conexion.php";
	class Contacto {
		//Propiedades
		private $id;
		private $nombre;
		private $apellido;
        private $ciudad;
        private $descripcion;

		//Constructor
		public function __construct(){
			//vacío
		}

		//Métodos Getters y Setters
		public function setId($id){
			$this -> id = $id;
		}

		public function getId(){
			return $this->id;
		}

		public function setNombre($nombre){
			$this->nombre=$nombre;
		}

		public function getNombre(){
			return $this->nombre;
		}

        public function setApellido($ape){
			$this->apellido=$ape;
		}

		public function getApellido(){
			return $this->apellido;
		}

        public function setCiudad($ciu){
			$this->ciudad=$ciu;
		}

		public function getCiudad(){
			return $this->ciudad;
		}
        
		public function setDescripcion($des){
			$this->descripcion=$des;
		}

		public function getDescripcion(){
			return $this->descripcion;
		}

		//MÉTODOS CRUD
		public function guardar($nombre,$apellido,$ciudad,$descripcion){
			try {
				$conexion = new Conexion();
				if($conexion){
					$consulta=$conexion->prepare("INSERT INTO contactos(nombre,apellido,ciudad,descripcion) VALUES(?,?,?,?)");
					$consulta->bindParam(1,$nombre);
					$consulta->bindParam(2,$apellido);
                    $consulta->bindParam(3,$ciudad);
                    $consulta->bindParam(4,$descripcion);
					$consulta->execute();
					//Para que lo inserte aplicándole el último id
					$this->id = $conexion->lastInsertId();
					return true;
				}else {
					return false;
				}
			}catch(Exception $e){
				die($e->getMessage());
			}finally {
				$conexion = null;
				$consulta = null;
			}
		}


		public function mostrarTodos(){
			try {
				$conexion = new Conexion();
				if($conexion){
					$consulta = $conexion->prepare("SELECT * FROM contactos");
					$consulta->execute();
					$res = $consulta->fetchAll(PDO::FETCH_OBJ);
					//Devolvemos los datos codificados en formato JSON
					$convertir_a_json = json_encode($res);
					return $convertir_a_json;
				}else {
					return false;
				}
			}catch(Exception $e){
				die($e->getMessage());
			}finally{
				$consulta = null;
				$conexion = null;
			}
		}

		public function buscarPorId($id) {
			try {
				$conexion = new Conexion();
				$consulta = $conexion -> prepare("SELECT * FROM contactos WHERE id=:id");
				$consulta -> bindParam("id", $id);
				$consulta -> execute();
				$res = $consulta -> fetchAll(PDO::FETCH_OBJ);
				//codificamos los datos en formato JSON
				$convertir_a_JSON = json_encode($res);
				return $convertir_a_JSON;
			}catch(Exception $e) {
				die($e->getMessage());
			}finally {
				$consulta = null;
				$conexion = null;
			}
		}

		public function actualizar($id, $nombre, $apellido, $ciudad, $descripcion) {
			try {
				$conexion = new Conexion();
				if($conexion) {
					$consulta = $conexion -> prepare("UPDATE contactos SET nombre=?, apellido=?, ciudad=?, descripcion=? WHERE id=?"); //modo comodines
					$consulta -> bindParam(1, $nombre);
					$consulta -> bindParam(2, $apellido);
                    $consulta -> bindParam(3, $ciudad);
                    $consulta -> bindParam(4, $descripcion);
					$consulta -> bindParam(5, $id);
					$consulta -> execute();
					return true;
				}else {
					return false;
				}
			
				
			}catch(Exception $e) {
				die($e->getMessage());
			}finally {
				$consulta = null;
				$conexion = null;
			}
		}

		public function borrar($id) {
			try {
				$conexion = new Conexion();
				if($conexion) {
					$consulta = $conexion -> prepare("DELETE FROM contactos WHERE id=:id"); //modo comodines
					$consulta -> bindParam("id", $id);
					$consulta -> execute();
					return true;
				}else {
					return false;
				}
			
				
			}catch(Exception $e) {
				die($e->getMessage());
			}finally {
				$consulta = null;
				$conexion = null;
			}
		}

	}

?>