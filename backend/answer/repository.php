<?php
require_once __DIR__ . "/../common/db.php";
function createModel($answerId, $answer, $timeTakenToAnswer, $tutorId, $questionId)
{
    return array(
        "AnswerId" => $answerId,
        "Answer" => $answer,
        "TimeTakenToAnswer" => $timeTakenToAnswer,
        "TutorID" => $tutorId,
        "QuestionID" => $questionId,
    );
}

function insert($answer, $timeTakenToAnswer, $tutorId, $questionId)
{
    $schema = array("AnswerId", "Answer", "TimeTakenToAnswer", "TutorID", "QuestionID");
    $id = "ANS" . (time() % 10000000);
    $insertQuery = "insert into Answer(AnswerID, Answer, TimeTakenToAnswer, TutorID, QuestionID) values ($id,$answer,$timeTakenToAnswer,$tutorId,$questionId)";
    executeInsertQuery($insertQuery);
    $selectQuery = "select * from Answer where AnswerID = '$id'";
    $results = executeSelectQuery($selectQuery,$schema);
    if(count($results) == 0){
        return null;
    }else{
        return $results[0];
    }
}