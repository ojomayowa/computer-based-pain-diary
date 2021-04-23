<?php
session_start();
require_once "../../connection/connection.php";
require_once "../functions.php";

if ($_GET) {
    $id = $_GET['delete'];
    $query = $connection->prepare('DELETE FROM log WHERE id = :id AND user_id = :user_id');
    $query->bindParam(':user_id', $_SESSION['details']['id']);
    $query->bindParam(':id', $_GET['id']);
    $query->execute();

    $_SESSION['success'] = 'Pain log record removed succcessfully';
    header('location: ../../report.php');
}
