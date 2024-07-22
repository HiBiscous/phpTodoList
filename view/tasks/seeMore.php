<?php


//session start, so the global variable $_SESSION is enable
session_start();
var_dump($_SESSION);
//if the user is not connected, this header will redirect him to the connection page
if (!$_SESSION['id_users']) {
    header('Location: /phptodolist/view/authentification/connection.php');
    exit();
}

//$userId stock the id of the current connected user for future use
$userId = $_SESSION['id_users'];

//import the BDD connection config
require_once '../../model/db_connect.php';

$rqt = 'SELECT title, id_tasks FROM tasks WHERE userId = :userId OFFSET 5';

$stmt = $pdo->prepare($rqt);
$stmt->bindParam(':userId', $userId);
$stmt->execute();
$nb_row = $stmt->rowCount();

$arr = $stmt->fetchAll();

var_dump($arr);
