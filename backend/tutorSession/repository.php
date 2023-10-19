<?php
require_once __DIR__ . "/../common/db.php";

function insert($firstname, $lastname, $contact, $username, $password)
{
    $schema = array("TutorSessionID", "Firstname", "Lastname", "Contact", "Username","Password");
    $id = "TUT" . (time() % 10000000);
    $insertQuery = "insert into TutorSession(TutorSessionID, Firstname, Lastname, Contact, Username, Password) values ('$id','$firstname',$lastname,'$contact','$username','$password')";
    executeNonReturnQuery($insertQuery);
    $selectQuery = "select * from TutorSession where TutorSessionID = '$id'";
    $results = executeSelectQuery($selectQuery,$schema);
    if(count($results) == 0){
        return null;
    }else{
        return $results[0];
    }
}
function update($id,$firstname, $lastname, $contact, $username, $password)
{
    $schema = array("TutorSessionID", "Firstname", "Lastname", "Contact", "Username","Password");
    $updateQuery = "update TutorSession set 
                  Firstname = '$firstname', 
                  Lastname = $lastname,
                  Contact = $contact,
                  Username = $username,
                  Password = $password where TutorSessionID = '$id'";
    executeNonReturnQuery($updateQuery);
    $selectQuery = "select * from TutorSession where TutorSessionID = '$id'";
    $results = executeSelectQuery($selectQuery,$schema);
    if(count($results) == 0){
        return null;
    }else{
        return $results[0];
    }
}
function delete($id)
{
    $deleteQuery = "delete from TutorSession where TutorSessionID = '$id'";
    executeNonReturnQuery($deleteQuery);
    return true;
}
function get($id = null)
{
    if($id == null){
        $selectQuery = "select * from TutorSession";
    }else{
        $selectQuery = "select * from TutorSession where TutorSessionID = '$id'";
    }
    $schema = array("TutorSessionID", "TutorID", "SessionID");
    $result = executeSelectQuery($selectQuery,$schema);
    return $result;
}
function getByUsername($username="", $password="")
{

    $selectQuery = "select * from TutorSession where Username = '$username' and Password = '$password'";
    $schema = array("TutorSessionID", "Firstname", "Lastname", "Contact", "Username","Password");
    $result = executeSelectQuery($selectQuery,$schema);
    return $result;
}