<?php
require_once "repository.php";
header('Content-Type: application/json; charset=utf-8');



if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // handle GET request
    $results = getQuestion();
    echo json_encode($results);
    return true;
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // handle POST request
    $result = createAnswer();
    echo json_encode($result);
    return true;
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // handle PUT request
    $result = updateAnswer();
    echo json_encode($result);
    return true;
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // handle DELETE request
    deleteAnswer();
    echo "{}";
    return true;
}
function createAnswer(){
    $answerRequestJson = file_get_contents('php://input');
    $answerRequest = json_decode($answerRequestJson, true);
    if($answerRequest != null){
        $answer = trim($answerRequest["answer"]);
        $timeTakenToAnswer = trim($answerRequest["timeTakenToAnswer"]);
        $tutorId = trim($answerRequest["tutorId"]);
        $questionId = trim($answerRequest["questionId"]);
        $answerModel = insert($answer,$timeTakenToAnswer, $tutorId, $questionId);
        return $answerModel;
    }
    return null;
}
function updateAnswer(){
    $answerRequestJson = file_get_contents('php://input');
    $answerRequest = json_decode($answerRequestJson, true);
    if($answerRequest != null){
        $id = trim($answerRequest["id"]);
        $answer = trim($answerRequest["answer"]);
        $timeTakenToAnswer = trim($answerRequest["timeTakenToAnswer"]);
        $tutorId = trim($answerRequest["tutorId"]);
        $questionId = trim($answerRequest["questionId"]);
        $answerModel = update($id,$answer,$timeTakenToAnswer, $tutorId, $questionId);
        return $answerModel;

    }
}
function deleteAnswer(){
    $queries = array();
    parse_str($_SERVER['QUERY_STRING'],$queries);
    $id = $queries["id"];
    delete($id);
}
function getQuestion()
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