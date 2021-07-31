<?php
// phpcs:ignoreFile
require '../vendor/autoload.php';

use \Firebase\JWT\JWT;

class jwt_helper
{
    private $key = "";
    function __construct()
    {
        $this->key = 'prueba_test';
    }
    function generar_jwt($token)
    {
        return JWT::encode($token, $this->key);
    }
    function validar_token()
    {
        $result = new stdClass();
        $headers = apache_request_headers();
        if (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
            try {
                $jwt = trim(str_replace("Bearer", "", $_SERVER['REDIRECT_HTTP_AUTHORIZATION']));
                $result = JWT::decode($jwt, $this->key, array('HS256'));
                $result->token = $jwt;
                return $result;
            } catch (Exception $e) {
                return $result;
            }
        }
        if (isset($headers['Authorization'])) {
            try {
                $jwt = trim(str_replace("Bearer", "", $headers['Authorization']));
                $result = JWT::decode($jwt, $this->key, array('HS256'));
                $result->token = $jwt;
                return $result;
            } catch (Exception $e) {
                return $result;
            }
        }
        if (isset($headers['authorization'])) {
            try {
                $jwt = trim(str_replace("Bearer", "", $headers['authorization']));
                $result = JWT::decode($jwt, $this->key, array('HS256'));
                $result->token = $jwt;
                return $result;
            } catch (Exception $e) {
                return $result;
            }
        }
        return $result;
    }
}
