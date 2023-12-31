<html>
<head>
    <meta charset="utf-8">
    <meta name = "description"   content="TIP3">
    <meta name = "author"   content="Cao Tuan Luong">
    <meta name = "keywords" content="php, mysql">
    <title>Retrieving record to database</title>
</head>
<body>
<h1>Send Question to Teacher</h1>
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
        $question = htmlspecialchars($_POST["inputquestion"]);
        $subject = htmlspecialchars($_POST["subject"]);
        $id = "QT". (time() % 10000000); 
        $sessionid = htmlspecialchars($_POST["sessionid1"]);
    $sql_table = "Question";
    $query = "INSERT INTO $sql_table(QuestionID, Question, SubjectAreaID, SessionID, StudentID) VALUES ('$id','$question','$subject','$sessionid', '104362047')";

//Execute the querry
    $result = mysqli_query($conn, $query);

    if(!$result){
            echo "<p class=\"wrong\"> Something is wrong with ", $query, "</p>"; 
    }
    else{
        echo "<script>
        var popupMessage = 'Send Question Successful';
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

</body>
</html>