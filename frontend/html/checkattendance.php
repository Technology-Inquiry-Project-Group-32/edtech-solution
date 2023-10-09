<html>
<head>
    <meta charset="utf-8">
    <meta name = "description"   content="TIP3">
    <meta name = "author"   content="Cao Tuan Luong">
    <meta name = "keywords" content="php, mysql">
    <title>Retrieving record to HTML</title>
</head>
<body>
<h1>Creating Web Application - LAB10</h1>
<?php
    require_once("settings.php");    //connection info

    $conn = @mysqli_connect($host,
        $user,
        $pwd,
        $sql_db
);
//Check if connection is successful
    if(!$conn){
    // Display error message
    echo "<p>Database failure</p>";
}
    else{
        $studentid = htmlspecialchars($_POST["studentid"]);
    
    $sql_table = "StudentAttendance";
    $query = "INSERT INTO $sql_table(StudentID, SessionID) VALUES ('$studentid', '777')";

//Execute the querry
    $result = mysqli_query($conn, $query);

    if(!$result){
            echo "<p class=\"wrong\"> Something is wrong with", $query, "</p>"; 
    }
    else{
        echo "<p class=\"ok\"> Check Attendance Successfull </p>";
    }

    //close the connection
    mysqli_close($conn);

}
?>
<button><a href="studentPage.html">Back To Student Page </a></button>
</body>
</html>