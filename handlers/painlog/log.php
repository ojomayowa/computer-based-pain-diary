<?php
session_start();
require_once "../../connection/connection.php";
require_once "../functions.php";

if ($_POST) {
    catch_empty_values($_POST, '../painlog.php');

    $query = $connection->prepare('INSERT INTO log (user_id, start_time, end_time, scale, pain_trigger, location, description) VALUES (:user_id, :start_time, :end_time, :scale, :pain_trigger, :location, :description)');
    $query->bindParam(':user_id', $_SESSION['details']['id']);
    $query->bindParam(':end_time', $_POST['end_time']);
    $query->bindParam(':start_time', $_POST['start_time']);
    $query->bindParam(':scale', $_POST['scale']);
    $query->bindParam(':pain_trigger', $_POST['trigger']);
    $query->bindParam(':location', $_POST['location']);
    $query->bindParam(':description', $_POST['description']);
    $query->execute();

    $_SESSION['success'] = 'Pain log recorded successfully';
    header('location: ../../painlog.php');
}
