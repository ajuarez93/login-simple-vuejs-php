<?php
// phpcs:ignoreFile

$data = array(
    'estatus' => true
);

// Validaciones 
$data = array(
    'estatus' => false,
    'data' => 'Sesion no valida'
);
require_once 'jwt.php';
$jwt = new jwt_helper();
$res_jwt = $jwt->validar_token();

if (isset($res_jwt->id)) {
    require_once 'coneccion_bd.php';
    $mysql = new coneccion_mysql();
    $consulta = "SELECT count(*) as total FROM usuario WHERE token = '$res_jwt->token' AND active = 1 AND deleted = 0";
    $res = $mysql->select($consulta);
    if ($res->estatus) {
       
        $_data = $res->data;
        if (isset($_data['total'])) {
            if ($_data['total'] == 1) {
                $consulta = "SELECT id, nombre_completo, fecha_ultima_modificacion_contrasena, fecha_ultimo_acceso FROM usuario WHERE token = '$res_jwt->token' AND active = 1 AND deleted = 0";
                $res = $mysql->select($consulta);
                if($res->estatus){
                    $id = $res->data['id'];
                    if($res_jwt->id == $id){
                        $data = $res;
                    }
                }

            } 
        } 
    } 
}


echo json_encode($data);
