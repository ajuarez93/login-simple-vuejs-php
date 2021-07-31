<?php
// phpcs:ignoreFile
class coneccion_mysql
{
    private $mysqli = null;
    private $consulta = "";

    function __construct()
    {
        $this->conectar();
    }
    function __destruct()
    {
        $this->desconectar();
    }

    function conectar()
    {
        include 'config.php';
        

        $this->mysqli = new mysqli(
            SERVER,
            USUARIO,
            CONTRASENA,
            BASE
        );
        if ($this->mysqli->connect_errno) {
            printf("Falló la conexión: %s\n", $this->mysqli->connect_error);
            exit();
        }

        $this->mysqli->set_charset("utf8");
    }
    
 

    function desconectar()
    {
        if ($this->mysqli->ping()) $this->mysqli->close();
    }

    function select($consulta)
    {
        try {
            $this->consulta = $consulta;
            if ($resultado = $this->mysqli->query($this->consulta)){
                return (object)  array('estatus' => true, 'data' => $resultado->fetch_assoc());
            }else{
                return (object)  array('estatus' => false, 'data' => '');
            }
           
        } catch (Exception $e) {
            return (object)  array('estatus' => false, 'data' => $this->mysqli->error);
        }
    }

    function insert($consulta)
    {
        try {
            $this->consulta = $consulta;
            if ($this->mysqli->query($this->consulta)){
                return (object)  array('estatus' => true, 'data' => $this->mysqli->insert_id);
            }else{
                return (object)  array('estatus' => false, 'data' => '');
            }
           
        } catch (Exception $e) {
            return (object)  array('estatus' => false, 'data' => $this->mysqli->error);
        }
    }

    function update($consulta)
    {
        try {
            $this->consulta = $consulta;
            if ($this->mysqli->query($this->consulta)){
                return (object)  array('estatus' => true, 'data' => $this->mysqli->insert_id);
            }else{
                return (object)  array('estatus' => false, 'data' => '');
            }
           
        } catch (Exception $e) {
            return (object)  array('estatus' => false, 'data' => $this->mysqli->error);
        }
    }
}
