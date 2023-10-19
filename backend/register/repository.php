<?php
require_once __DIR__ . "/../common/db.php";

function createStudentAccount($username, $password, $lastname, $firstname, $contact)
{
    $id = "STU" . (time() % 10000000);
    $studentSchema = array("StudentID", "Firstname", "Lastname", "Contact", "Username","Password");
    $insertQuery = "insert into Student(StudentID, Username, Password, Lastname, Firstname,Contact) values ('$id','$username','$password','$lastname','$firstname','$contact')";
    executeNonReturnQuery($insertQuery);
    $selectQuery = "select * from Student where StudentID = '$id'";
    $results = executeSelectQuery($selectQuery,$studentSchema);
    if(count($results) == 0){
        return null;
    }else{
        return $results[0];
    }
}
function createTutorAccount($username, $password, $lastname, $firstname, $contact)
{
    $id = "TUT" . (time() % 10000000);
    $tutorSchema = array("TutorID", "Firstname", "Lastname", "Contact", "Username","Password");
    $insertQuery = "insert into Tutor(TutorID, Username, Password, Lastname, Firstname,Contact) values ('$id','$username','$password','$lastname','$firstname','$contact')";
    executeNonReturnQuery($insertQuery);
    $selectQuery = "select * from Tutor where TutorID = '$id'";
    $results = executeSelectQuery($selectQuery,$tutorSchema);
    if(count($results) == 0){
        return null;
    }else{
        return $results[0];
    }
}

function getAccount($username)
{

    $tutorSchema = array("TutorID", "Firstname", "Lastname", "Contact", "Username","Password");
    $tutorQuery = "select * from Tutor where Username = '$username'";
    $results = executeSelectQuery($tutorQuery,$tutorSchema);
    if(count($results) > 0){
        return $results[0];
    }
    $studentSchema = array("StudentID", "Firstname", "Lastname", "Contact", "Username","Password");
    $studentQuery = "select * from Student where Username = '$username'";
    $results = executeSelectQuery($studentQuery,$studentSchema);
    if(count($results) > 0){
        return $results[0];
    }
    return null;
}