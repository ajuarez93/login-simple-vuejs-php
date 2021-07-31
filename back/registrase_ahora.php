<?php
// phpcs:ignoreFile
require_once 'validacion.php';

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$nombre = $_POST['nombre'];


$data = array(
    'estatus' => true
);

// Validaciones 
if (empty($correo) || !validateEmail($correo)) {
    $data = array(
        'estatus' => false,
        'data' => 'Correo invalido'
    );
}

if (empty($contrasena)) {
    $data = array(
        'estatus' => false,
        'data' => 'contraseña invalido'
    );
}
// FIN Validaciones 

// -- Negocio
require_once 'coneccion_bd.php';
$mysql = new coneccion_mysql();


$consulta = "SELECT count(*) as total FROM usuario WHERE correo = '$correo'";
$res = $mysql->select($consulta);
if ($res->estatus) {
    $_data = $res->data;
    if (isset($_data['total'])) {
        if ($_data['total'] == 0) {

            $contrasena = md5($contrasena);
            $consulta = "INSERT INTO usuario(nombre_completo, correo, contrasena, active, deleted, created_by, created_date) VALUES('$nombre', '$correo', '$contrasena', 1, 0, 0, NOW())";
            $data_id =  $res = $mysql->insert($consulta);
            require_once 'jwt.php';
            $jwt = new jwt_helper();
            $id = $data_id->data;
            $data_token = array(
                'id' => $id ,
                'fecha' => date("Y-m-d H:i:s"),
            );
            $token = $jwt->generar_jwt($data_token);

            $consulta = "UPDATE usuario SET token = '$token', modify_by = '$id', modify_date = NOW() WHERE id = '$id'";
            $mysql->update($consulta);

            $data = array(
                'estatus' => true,
                'token' => $token
            );
        } else {
            $data = array(
                'estatus' => false,
                'data' => 'Usuario ya registrado anteriormente'
            );
        }
    } else {
        $data = array(
            'estatus' => false,
            'data' => 'Error al registrar su usuario'
        );
    }
} else {
    $data = array(
        'estatus' => false,
        'data' => 'Error al registrar su usuario'
    );
}


// -- FIN Negocio

echo json_encode($data);
