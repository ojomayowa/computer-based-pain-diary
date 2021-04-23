<?php
session_start();
require_once "../../connection/connection.php";
require_once "../functions.php";

if (isset($_GET['start']) & isset($_GET['end'])) {
    $query = $connection->prepare('SELECT avg(scale) AS scale_per_day, DATE(created_at) AS day FROM log WHERE user_id = :user_id AND created_at >= :start AND created_at <= :end GROUP BY DAY(created_at)');
    $query->bindParam(':user_id', $_SESSION['details']['id']);
    $query->bindParam(':start', $_GET['start']);
    $query->bindParam(':end', $_GET['end']);
    $query->execute();
    $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($fetch);
} else {
    $query = $connection->prepare('SELECT avg(scale) AS scale_per_day, DATE(created_at) AS day FROM log WHERE user_id = :user_id GROUP BY DAY(created_at) ORDER BY id ASC LIMIT 7');
    $query->bindParam(':user_id', $_SESSION['details']['id']);
    $query->execute();
    $fetch = $query->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($fetch);
}
