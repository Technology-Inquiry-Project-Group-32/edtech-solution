<?php
require_once __DIR__ . "/../constants/Constants.php";
function executeInsertQuery($query)
{
    $dbConnect = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbSchema);
    mysqli_query($dbConnect,$query);
    mysqli_close($dbConnect);
}
function executeSelectQuery($query,$attributes)
{
    $dbConnect = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbSchema);
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
    mysqli_close($dbConnect);
    return $results;
}
