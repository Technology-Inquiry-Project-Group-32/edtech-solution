<html>
<head>
    <meta charset="utf-8">
    <meta name = "description"   content="TIP3">
    <meta name = "author"   content="Cao Tuan Luong">
    <meta name = "keywords" content="php, mysql">
    <title>Retrieving record to HTML</title>
</head>
<body>
<h1>Check Attendance Page</h1>
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
        $sessionid = ($_POST["sessionid"]);
        $id = "QT". (time() % 10000000);
    $sql_table = "StudentAttendance";
    $query = "INSERT INTO $sql_table(AttendanceId, StudentID, SessionID) VALUES ('$id','$studentid', '$sessionid')";

//Execute the querry
    $result = mysqli_query($conn, $query);

    if(!$result){
            echo "<p class=\"wrong\"> Something is wrong with", $query, "</p>"; 
    }
    else{
        echo "<script>
        var popupMessage = 'Check Attendance Successul';
        var confirmButtonText = 'Back To Student Page';
        var result = confirm(popupMessage);
        if (result) {
            window.location.href = 'studentsession.html';
        }
        </script>";
    }

    //close the connection
    mysqli_close($conn);

}
?>
<button><a href="studentsession.html">Back To Student Page </a></button>
</body>
</html>