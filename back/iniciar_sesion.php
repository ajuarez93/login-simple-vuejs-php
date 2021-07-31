

<?php
// phpcs:ignoreFile
require_once 'validacion.php';

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];


$data = array(
    'estatus' => true
);

// Validaciones 
    if(empty($correo) || !validateEmail($correo)){
        $data = array(
            'estatus' => false,
            'data' => 'Correo invalido'
        );
    }

    if(empty($contrasena)){
        $data = array(
            'estatus' => false,
            'data' => 'contraseña invalido'
        );
    }
// FIN Validaciones 

// -- Negocio
require_once 'coneccion_bd.php';
$mysql = new coneccion_mysql();


$contrasena = md5($contrasena);
$consulta = "SELECT count(*) as total FROM usuario WHERE correo = '$correo' AND contrasena = '$contrasena' AND active = 1 AND deleted = 0";
$res = $mysql->select($consulta);
if($res->estatus){
    $_data = $res->data;
    if(isset($_data['total'])){
        if($_data['total'] == 1){

            require_once 'jwt.php';
            $jwt = new jwt_helper();
            $consulta = "SELECT id FROM usuario WHERE correo = '$correo' AND contrasena = '$contrasena' AND active = 1 AND deleted = 0";
            $res = $mysql->select($consulta);
            if($res->estatus){
                $id = $res->data['id'];
                $data_token = array(
                    'id' => $id,
                    'fecha' => date("Y-m-d H:i:s"),
                );
                $token = $jwt->generar_jwt($data_token);

                $consulta = "UPDATE usuario SET token = '$token', modify_by = '$id', modify_date = NOW() WHERE id = '$id'";
                $mysql->update($consulta);

                $data = array(
                    'estatus' => true,
                    'token' => $token
                );
            }
           
        }else{
            $data = array(
                'estatus' => false,
                'data' => 'Usuario no encontrado'
            );
        }
    }else{
        $data = array(
            'estatus' => false,
            'data' => 'Error al validar su usuario'
        );
    }
    

}else{
    $data = array(
        'estatus' => false,
        'data' => 'Error al validar su usuario'
    );
}


// -- FIN Negocio

echo json_encode($data);
