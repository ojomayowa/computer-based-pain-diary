<?php
session_start();
require_once "../../connection/connection.php";
require_once "../functions.php";


$query = $connection->prepare('DELETE FROM users WHERE id = :id');
$query->bindParam(':id', $_SESSION['details']['id']);
$query->execute();

$query = $connection->prepare("DELETE FROM log WHERE user_id = :id");
$query->bindParam(':id', $_SESSION['details']['id']);
$query->execute();


if ($query->execute()) {
    unset($_SESSION['details']);
    $_SESSION['success'] = 'Account details deleted';
    header('Location: ../../index.php');
} else {
    $_SESSION['error'] = 'Unable to delete account';
    header('Location: ../../index.php');
}
