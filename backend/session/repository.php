<?php
require_once __DIR__ . "/../common/db.php";

function insert($firstname, $lastname, $contact, $username, $password)
{
    $schema = array("SessionID", "Firstname", "Lastname", "Contact", "Username","Password");
    $id = "TUT" . (time() % 10000000);
    $insertQuery = "insert into Session(SessionID, Firstname, Lastname, Contact, Username, Password) values ('$id','$firstname',$lastname,'$contact','$username','$password')";
    executeNonReturnQuery($insertQuery);
    $selectQuery = "select * from Session where SessionID = '$id'";
    $results = executeSelectQuery($selectQuery,$schema);
    if(count($results) == 0){
        return null;
    }else{
        return $results[0];
    }
}
function update($id,$firstname, $lastname, $contact, $username, $password)
{
    $schema = array("SessionID", "Firstname", "Lastname", "Contact", "Username","Password");
    $updateQuery = "update Session set 
                  Firstname = '$firstname', 
                  Lastname = $lastname,
                  Contact = $contact,
                  Username = $username,
                  Password = $password where SessionID = '$id'";
    executeNonReturnQuery($updateQuery);
    $selectQuery = "select * from Session where SessionID = '$id'";
    $results = executeSelectQuery($selectQuery,$schema);
    if(count($results) == 0){
        return null;
    }else{
        return $results[0];
    }
}
function delete($id)
{
    $deleteQuery = "delete from Session where SessionID = '$id'";
    executeNonReturnQuery($deleteQuery);
    return true;
}
function get($id = null)
{
    if($id == null){
        $selectQuery = "select * from Session";
    }else{
        $selectQuery = "select * from Session where SessionID = '$id'";
    }
    $schema = array("SessionID", "Date", "DayOfWeek");
    $result = executeSelectQuery($selectQuery,$schema);
    return $result;
}
function getByUsername($username="", $password="")
{

    $selectQuery = "select * from Session where Username = '$username' and Password = '$password'";
    $schema = array("SessionID", "Firstname", "Lastname", "Contact", "Username","Password");
    $result = executeSelectQuery($selectQuery,$schema);
    return $result;
}
function getStudentPerSession(){
    $query = "SELECT SessionID, COUNT(DISTINCT StudentID) AS Num_Attending
                  FROM StudentAttendance
                  WHERE StudentID <> '' and SessionID <> ''
                  GROUP BY SessionID ORDER BY SessionID DESC;";
    $schema = array("SessionID", "Num_Attending");
    $result = executeSelectQuery($query,$schema);
    return $result;
}