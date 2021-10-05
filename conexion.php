<?php
    class Conexion extends PDO {
        private $db_type = "mysql";
        private $host_name = "localhost";
        private $db_name = "id17551679_contacto_clientes";
        private $user_name = "id17551679_root";
        private $user_password = "aUJVFs4qmW-Bq2*3";

        public function __construct()
        {
            try {
                parent::__construct ("{$this -> db_type}:host={$this -> host_name};dbname={$this -> db_name};charset=utf8", $this -> user_name, $this -> user_password);
            }catch (PDOException $e) {
                echo "Error de conexión con la BBDD" . $e -> getMessage();
                exit;
            }
            
        }
    }
?>