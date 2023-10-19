<?php
require_once "repository.php";
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // handle GET request
    $results = getTutorSessions();
    echo json_encode($results);
    return true;
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // handle POST request
    $result = createTutorSession();
    echo json_encode($result);
    return true;
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // handle PUT request
    $result = updateTutorSession();
    echo json_encode($result);
    return true;
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // handle DELETE request
    deleteTutorSession();
    echo "{}";
    return true;
}
function createTutorSession(){
    $answerRequestJson = file_get_contents('php://input');
    $answerRequest = json_decode($answerRequestJson, true);
    if($answerRequest != null){
        $firstname = trim($answerRequest["firstname"]);
        $lastname = trim($answerRequest["lastname"]);
        $contact = trim($answerRequest["contact"]);
        $username = trim($answerRequest["username"]);
        $password = trim($answerRequest["password"]);
        $answerModel = insert($firstname,$lastname, $contact, $username,$password);
        return $answerModel;
    }
    return null;
}
function updateTutorSession(){
    $answerRequestJson = file_get_contents('php://input');
    $answerRequest = json_decode($answerRequestJson, true);
    if($answerRequest != null){
        $id = trim($answerRequest["id"]);
        $firstname = trim($answerRequest["firstname"]);
        $lastname = trim($answerRequest["lastname"]);
        $contact = trim($answerRequest["contact"]);
        $username = trim($answerRequest["username"]);
        $password = trim($answerRequest["password"]);
        $answerModel = update($id,$firstname,$lastname, $contact, $username,$password);
        return $answerModel;

    }
}
function deleteTutorSession(){
    $queries = array();
    parse_str($_SERVER['QUERY_STRING'],$queries);
    $id = $queries["id"];
    delete($id);
}
function getTutorSessions()
{
    $queries = array();
    parse_str($_SERVER['QUERY_STRING'],$queries);
    if(isset($queries["id"])){
        $id = $queries["id"];
        return get($id);
    }else{
        return get();
    }
}