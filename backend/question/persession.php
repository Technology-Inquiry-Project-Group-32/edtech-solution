<?php
require_once "repository.php";
header('Content-Type: application/json; charset=utf-8');



if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // handle GET request
    $results = getQuestionPerSessionStats();
    echo json_encode($results);
    return true;
}