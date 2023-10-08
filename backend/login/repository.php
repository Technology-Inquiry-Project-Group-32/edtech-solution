<?php
require_once __DIR__ . "/../common/db.php";

function login($username, $password)
{
    $tutorSchema = array("TutorID", "Firstname", "Lastname", "Contact", "Username","Password");
    $selectTutorQuery = "select * from Tutor where Username = '$username' and Password = '$password'";
    $result = executeSelectQuery($selectTutorQuery,$tutorSchema);
    if(count($result) > 0){
        return $result[0];
    }
    $studentSchema = array("StudentID", "Firstname", "Lastname", "Contact", "Username","Password");
    $selectStudentQuery = "select * from Student where Username = '$username' and Password = '$password'";
    $results = executeSelectQuery($selectStudentQuery,$studentSchema);
    if(count($results) == 0){
        return null;
    }else{
        return $results[0];
    }
}