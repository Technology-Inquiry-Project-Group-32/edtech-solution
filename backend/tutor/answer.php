<?php
require_once "repository.php";
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // handle GET request
    $results = getAnswersByTutor();
    echo json_encode($results);
    return true;
}
function getAnswersByTutor()
{
    $queries = array();
    parse_str($_SERVER['QUERY_STRING'],$queries);
    if(isset($queries["id"])){
        $id = $queries["id"];
        return getNumAnswersByTutors($id);
    }else{
        return get();
    }
}