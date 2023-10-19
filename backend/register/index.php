<?php
require_once "repository.php";
header('Content-Type: application/json; charset=utf-8');
http_response_code(200);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // handle GET request
    http_response_code(405);
    return true;
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // handle POST request
    $result = register();
    echo json_encode($result);
    http_response_code(200);
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // handle PUT request
    http_response_code(405);

    return true;
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // handle DELETE request
    http_response_code(405);

    return true;
}
function register(){
    $registerRequestJson = file_get_contents('php://input');
    $registerRequest = json_decode($registerRequestJson, true);
    if($registerRequest != null){
        $username = trim($registerRequest["username"]);
        $password = trim($registerRequest["password"]);
        $lastname = trim($registerRequest["lastname"]);
        $firstname = trim($registerRequest["firstname"]);
        $contact = trim($registerRequest["contact"]);
        $usertype = trim($registerRequest["usertype"]);
        if(getAccount($username)!= null){
            return ["errorMessage" => "account exists"];
        }
        if($usertype == "student"){
            return createStudentAccount($username,$password,$lastname,$firstname,$contact);
        }
        if($usertype == "tutor"){
            return createTutorAccount($username,$password,$lastname,$firstname,$contact);
        }
        return ["errorMessage" => "error"];
    }
    return null;
}
