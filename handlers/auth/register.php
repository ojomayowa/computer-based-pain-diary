<?php
session_start();
require_once "../../connection/connection.php";
require_once "../functions.php";

if ($_POST) {
    catch_empty_values($_POST, '../register.php');

    if (strlen($_POST["password"]) < 8) {
        $_SESSION['error'] = 'Password too short, must be at least 8 characters';
        header('Location: ../../register.php');
        die();
    }

    $first_name = sanitise_string($_POST['first_name']);
    $last_name = sanitise_string($_POST['last_name']);
    $email = sanitise_string($_POST['email']);
    $password = password_hash(sanitise_string($_POST['password']), PASSWORD_DEFAULT);

    //check if account does not already exist
    $check = $connection->prepare('SELECT * FROM users WHERE email = :email');
    $check->bindParam(':email', $email);
    $check->execute();
    if ($check->rowCount()) {
        $_SESSION['error'] = 'Unable to create your account. Account already exists';
        header('Location: ../../register.php');
        die();
    }

    // create user account 
    $query = $connection->prepare('INSERT INTO users (uuid, first_name, last_name, email, password) VALUES (:uuid, :first_name, :last_name, :email, :password)');
    $query->bindParam(':uuid', bin2hex(random_bytes(10)));
    $query->bindParam(':first_name', $first_name);
    $query->bindParam(':last_name', $last_name);
    $query->bindParam(':email', $email);
    $query->bindParam(':password', $password);
    if ($query->execute()) {
        $_SESSION['success'] = 'Account created successfully';
        header('Location: ../../index.php');
    } else {
        $_SESSION['error'] = 'Unable to create your account. Please try again later';
        header('Location: ../../register.php');
    }
}
