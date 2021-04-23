<?php
session_start();
if (!isset($_SESSION['details'])) {
    header('location: index.php');
}
require 'connection/constants.php';
require 'connection/connection.php';
$query = $connection->prepare('SELECT avg(scale) AS scale_per_day FROM log WHERE user_id = :user_id');
$query->bindParam(':user_id', $_SESSION['details']['id']);
$query->execute();
$fetch = $query->fetch(PDO::FETCH_ASSOC);
?>
<?php require_once "header.php"; ?>
<div class="container">
    <div class="top-header">
        <b>Welcome <?php echo $_SESSION['details']['name'] ?></b> <br>
        You are here: Dashboard
    </div>
    <?php require_once 'handlers/alerts.php'; ?>
    <div class="content cf">
        <div class="stat-box">
            <h4> Average Pain Score </h4>
            <h5> <?php echo number_format($fetch['scale_per_day']); ?> </h5>
        </div>

        <div class="stat-box">
            <h4> Average Pain Duration </h4>
            <h5> 5 </h5>
        </div>

        <div class="stat-box">
            <h4> Pain Free Days </h4>
            <h5> 5 </h5>
        </div>
    </div>
</div>
<?php require_once "footer.php"; ?>