<?php
session_start();
require_once "../../connection/connection.php";
require_once "../functions.php";

if ($_POST) {
    catch_empty_values($_POST, '../index.php');
    $email = sanitise_string($_POST['email']);
    $password = sanitise_string($_POST['password']);

    $query = $connection->prepare('SELECT * FROM users WHERE email = :email');
    $query->bindParam(':email', $email);
    $query->execute();
    $fetch = $query->fetch(PDO::FETCH_ASSOC);

    if (!$query->rowCount() || $query->rowCount() != 1 || !password_verify($password, $fetch['password'])) {
        $_SESSION['error'] = 'Invalid email or password';
        header('Location: ../../index.php');
        die();
    }

    if ($query->execute()) {
        $_SESSION['details'] = [
            "id" => $fetch['id'],
            "uuid" => $fetch['uuid'],
            "email" => $fetch['email'],
            "name" => $fetch['last_name'] . " " . $fetch['last_name']
        ];
        $_SESSION['success'] = 'Login successful';
        header('Location: ../../dashboard.php');
    } else {
        $_SESSION['error'] = 'Invalid email or password';
        header('Location: ../../index.php');
    }
}
