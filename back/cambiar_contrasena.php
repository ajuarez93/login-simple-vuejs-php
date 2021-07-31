<?php
// phpcs:ignoreFile
$contrasena_anterior = $_POST['contrasena_anterior'];
$contrasena_nueva = $_POST['contrasena_nueva'];
$contrasena_nueva_confirmar = $_POST['contrasena_nueva_confirmar'];
$data = array(
    'estatus' => true
);
$paso = true;
if (empty($contrasena_anterior)) {
    $data = array(
        'estatus' => false,
        'data' => 'contraseña invalido'
    );
}

if (empty($contrasena_nueva)) {
    $data = array(
        'estatus' => false,
        'data' => 'contraseña invalido'
    );
}


if (empty($contrasena_nueva_confirmar)) {
    $data = array(
        'estatus' => false,
        'data' => 'contraseña invalido'
    );
}

if (!empty($contrasena_anterior) && !empty($contrasena_nueva) && $contrasena_anterior == $contrasena_nueva) {
    $data = array(
        'estatus' => false,
        'data' => 'Las contraseña nueva no puede ser igual a la anterior'
    );
}

if (!empty($contrasena_nueva_confirmar) && !empty($contrasena_nueva) && $contrasena_nueva_confirmar != $contrasena_nueva) {
    $data = array(
        'estatus' => false,
        'data' => 'Las contraseñas no coinciden'
    );
}

if ($paso) {
    $data = array(
        'estatus' => false,
        'data' => 'Contraseña anterior invalida'
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

                    $id = $res_jwt->id;
                    $contrasena = md5($contrasena_anterior);
                    $consulta = "SELECT count(*) as total FROM usuario WHERE contrasena = '$contrasena' AND id = '$id' AND active = 1 AND deleted = 0";
                    $res = $mysql->select($consulta);
                    if ($res->estatus) {
                        $_data = $res->data;
                        if (isset($_data['total'])) {
                            if ($_data['total'] == 1) {
                                
                                $contrasena = md5($contrasena_nueva);
                                $consulta = "UPDATE usuario SET contrasena = '$contrasena', modify_by = '$id', modify_date = NOW() WHERE id = '$id'";
                                $mysql->update($consulta);
                                $data = array(
                                    'estatus' => true,
                                    'data' => 'Contraseña cambiada correctamente'
                                );
                            }
                        }
                    }


                }
            }
        }
    }
}




echo json_encode($data);
