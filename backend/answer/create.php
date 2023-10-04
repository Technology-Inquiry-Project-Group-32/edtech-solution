<?php
require_once "repository.php";
$answerRequestJson = file_get_contents('php://input');
$answerRequest = json_decode($answerRequestJson, true);
if($answerRequest != null){
    $answer = trim($answerRequest["answer"]);
    $timeTakenToAnswer = trim($answerRequest["timeTakenToAnswer"]);
    $tutorId = trim($answerRequest["tutorId"]);
    $questionId = trim($answerRequest["questionId"]);
}

$answerModel = insert($answer,$timeTakenToAnswer, $tutorId, $questionId);
json_encode($answerModel);

