<?php
require_once __DIR__ . "/../common/db.php";

function insert($answer, $timeTakenToAnswer, $tutorId, $questionId)
{
    $schema = array("AnswerID", "Answer", "TimeTakenToAnswer", "TutorID", "QuestionID");
    $id = "ANS" . (time() % 10000000);
    $insertQuery = "insert into Answer(AnswerID, Answer, TimeTakenToAnswer, TutorID, QuestionID) values ('$id','$answer',$timeTakenToAnswer,'$tutorId','$questionId')";
    executeNonReturnQuery($insertQuery);
    $selectQuery = "select * from Answer where AnswerID = '$id'";
    $results = executeSelectQuery($selectQuery,$schema);
    if(count($results) == 0){
        return null;
    }else{
        return $results[0];
    }
}
function update($id,$answer, $timeTakenToAnswer, $tutorId, $questionId)
{
    $schema = array("AnswerID", "Answer", "TimeTakenToAnswer", "TutorID", "QuestionID");
    $updateQuery = "update Answer set 
                  Answer = '$answer', 
                  TimeTakenToAnswer = $timeTakenToAnswer,
                  TutorID = $tutorId,
                  $questionId = QuestionID where AnswerID = '$id'";
    executeNonReturnQuery($updateQuery);
    $selectQuery = "select * from Answer where AnswerID = '$id'";
    $results = executeSelectQuery($selectQuery,$schema);
    if(count($results) == 0){
        return null;
    }else{
        return $results[0];
    }
}
function delete($id)
{
    $deleteQuery = "delete from Answer where AnswerID = '$id'";
    executeNonReturnQuery($deleteQuery);
    return true;
}
function get($id = null)
{
    if($id == null){
        $selectQuery = "select * from Question";
    }else{
        $selectQuery = "select * from Question where QuestionID = '$id'";
    }
    $schema = array("QuestionId", "Question", "SubjectAreaID", "SessionID", "StudentId");
    $result = executeSelectQuery($selectQuery,$schema);
    return $result;
}
function getBySession($id = null)
{
    if($id == null){
        $selectQuery = "select * from Question";
    }else{
        $selectQuery = "select * from Question where SessionID = '$id'";
    }
    $schema = array("QuestionID", "Question", "SubjectAreaID", "SessionID", "StudentID");
    $result = executeSelectQuery($selectQuery,$schema);
    return $result;
}