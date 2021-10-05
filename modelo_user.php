<?php
    class User {
        private $id;
        private $user;
        private $pass;

        //setters y getters
        public function setId($id) {
            $this -> id = $id;
        }

        public function getId() {
            return $this -> id;
        }

        public function setUser($u) {
            $this -> user = $u;
        }

        public function getUser() {
            return $this -> user;
        }

        public function setPass($p) {
            $this -> pass = $p;
        }

        public function getPass() {
            return $this -> pass;
        }

        //método para insertar un nuevo usuario en la tabla users
        public function insertar_user($user, $pass) {
            try {
                $conexion = new Conexion();
                if($conexion) {
                    $sql = "INSERT INTO users(user, pass) VALUES(?, ?)";
                    $insert = $conexion -> prepare($sql);
                    $insert -> bindParam(1, $user);
                    $insert -> bindParam(2, $pass);
                    $insert -> execute();
                    return true;
                }else {
                    return false;
                }
            }catch(Exception $e) {
                die($e -> getMessage());
            } finally {
                $consulta = null;
                $conexion = null;
            }
            
            
        }

        //método para autentificar el usuario y contraseña en el login
        public function autenticar_user($user, $pass) {
            try {
                $conexion = new Conexion();
                if($conexion) {
                    $sql = "SELECT user, pass FROM users WHERE user = '$user'";
                    $select = $conexion -> prepare($sql);
                    $select -> execute();

                    while($registro = $select -> fetch(PDO::FETCH_OBJ)) {
                        if(password_verify($pass, $registro -> pass)) {
                            session_start();
                            $_SESSION["user"] = $registro -> user;
                            return true;
                        }else {
                            return false;
                        }
                    }

                }else {
                    return false;
                }
            }catch(Exception $e) {
                die($e -> getMessage());
            } finally {
                $consulta = null;
                $conexion = null;
            }
        }
    }
?>