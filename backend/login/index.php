<?php
require_once "repository.php";
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // handle GET request
    http_response_code(405);
    return true;
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // handle POST request
    $result = login();
    echo json_encode($result);
    return true;
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // handle PUT request
    http_response_code(405);

    return true;
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // handle DELETE request
    http_response_code(405);

    return true;
}
function login(){
    $loginRequestJson = file_get_contents('php://input');
    $loginRequest = json_decode($loginRequestJson, true);
    if($loginRequest != null){
        $username = trim($loginRequest["username"]);
        $password = trim($loginRequest["password"]);
        $loginModel = getUserByUserNamePassword($username,$password);
        return $loginModel;
    }
    return null;
}