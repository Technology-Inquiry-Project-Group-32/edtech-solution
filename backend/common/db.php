<?php
function executeNonReturnQuery($query)
{
    require (__DIR__ . "/../constants/Constants.php");
    $dbConnect = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbschema);
    mysqli_query($dbConnect,$query);
    mysqli_close($dbConnect);
}
function executeSelectQuery($query,$attributes)
{
    require (__DIR__ . "/../constants/Constants.php");
    $dbConnect = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbschema);
    $rows = mysqli_query($dbConnect,$query);
    $results = [];
    if($rows) {
        while ($row = mysqli_fetch_assoc($rows)) {
            $result = [];
            foreach ($attributes as $attribute) {
                $result[$attribute] = $row[$attribute];
            }
            $results[] = $result;
        }
    }
    mysqli_free_result($rows);
    mysqli_close($dbConnect);
    return $results;
}
