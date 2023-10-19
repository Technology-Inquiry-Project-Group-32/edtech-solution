<?php
require_once __DIR__ . "/../common/db.php";

function insert($firstname, $lastname, $contact, $username, $password)
{
    $schema = array("TutorID", "Firstname", "Lastname", "Contact", "Username","Password");
    $id = "TUT" . (time() % 10000000);
    $insertQuery = "insert into Tutor(TutorID, Firstname, Lastname, Contact, Username, Password) values ('$id','$firstname',$lastname,'$contact','$username','$password')";
    executeNonReturnQuery($insertQuery);
    $selectQuery = "select * from Tutor where TutorID = '$id'";
    $results = executeSelectQuery($selectQuery,$schema);
    if(count($results) == 0){
        return null;
    }else{
        return $results[0];
    }
}
function update($id,$firstname, $lastname, $contact, $username, $password)
{
    $schema = array("TutorID", "Firstname", "Lastname", "Contact", "Username","Password");
    $updateQuery = "update Tutor set 
                  Firstname = '$firstname', 
                  Lastname = $lastname,
                  Contact = $contact,
                  Username = $username,
                  Password = $password where TutorID = '$id'";
    executeNonReturnQuery($updateQuery);
    $selectQuery = "select * from Tutor where TutorID = '$id'";
    $results = executeSelectQuery($selectQuery,$schema);
    if(count($results) == 0){
        return null;
    }else{
        return $results[0];
    }
}
function delete($id)
{
    $deleteQuery = "delete from Tutor where TutorID = '$id'";
    executeNonReturnQuery($deleteQuery);
    return true;
}
function get($id = null)
{
    if($id == null){
        $selectQuery = "select * from Tutor";
    }else{
        $selectQuery = "select * from Tutor where TutorID = '$id'";
    }
    $schema = array("TutorID", "Firstname", "Lastname", "Contact", "Username","Password");
    $result = executeSelectQuery($selectQuery,$schema);
    return $result;
}
function getByUsername($username="", $password="")
{

    $selectQuery = "select * from Tutor where Username = '$username' and Password = '$password'";
    $schema = array("TutorID", "Firstname", "Lastname", "Contact", "Username","Password");
    $result = executeSelectQuery($selectQuery,$schema);
    return $result;
}
function getQuestionByTutors($id)
{

    $selectQuery = "select count(*) numQuestions from Question";
    $schema = array("numQuestions");
    $result = executeSelectQuery($selectQuery,$schema);
    return $result;
}
function getNumQuestionByTutors($id)
{

    $selectQuery = "select count(*) numQuestions from Question";
    $schema = array("numQuestions");
    $result = executeSelectQuery($selectQuery,$schema);
    return $result;
}
function getNumAnswersByTutors($id)
{

    $selectQuery = "select count(*) numAnswers from Answer where TutorID = '$id'";
    $schema = array("numAnswers");
    $result = executeSelectQuery($selectQuery,$schema);
    return $result;
}
