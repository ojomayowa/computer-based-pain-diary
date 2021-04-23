<?php
session_start();
if (!isset($_SESSION['details'])) {
    header('location: index.php');
}
require 'connection/constants.php';
require 'connection/connection.php';
require 'handlers/functions.php';
$query = $connection->prepare('SELECT * FROM log WHERE user_id = :user_id AND id = :id');
$query->bindParam(':user_id', $_SESSION['details']['id']);
$query->bindParam(':id', $_GET['id']);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);
?>
<?php require_once "header.php"; ?>
<div class="container">
    <div class="top-header">
        <b>Welcome <?php echo $_SESSION['details']['name'] ?></b><br>
        You are here: Details
    </div>
    <div class="content">
        <?php require_once 'handlers/alerts.php'; ?>
        <div style="width: 50%; height: auto; display: inline-block; vertical-align: top;">
            <div style="width: 46%; margin: 10px 0; padding: 5px 10px; display: inline-block;">
                <label> Start Time </label>
                <?php echo $result['start_time']; ?>
            </div>
            <div style="width: 46%; margin: 10px 0; padding: 5px 10px; display: inline-block;">
                <label> End Time </label>
                <?php echo $result['end_time']; ?>
            </div>
            <div style="width: 46%; margin: 10px 0; padding: 5px 10px; display: inline-block;">
                <label> Pain Duration </label>
                <td><?php echo calculateTimeDifference($result['start_time'], $result['end_time']); ?></td>
            </div>
            <div style="width: 46%; margin: 10px 0; padding: 5px 10px; display: inline-block;">
                <label> Pain Scale </label>
                <?php echo $result['scale']; ?>
            </div>
            <div style="width: 46%; margin: 10px 0; padding: 5px 10px; display: inline-block;">
                <label> Interpretation </label>
                <?php echo interpretPain($result['scale']); ?>
            </div>
            <div style="width: 46%; margin: 10px 0; padding: 5px 10px; display: inline-block;">
                <label> Activities causing the pain </label>
                <?php echo $result['pain_trigger']; ?>
            </div>
            <div style="width: 46%; margin: 10px 0; padding: 5px 10px; display: inline-block;">
                <label> Location </label>
                <?php echo $result['location']; ?>
            </div>
            <div style="width: 96%; margin: 10px 0; padding: 5px 10px; display: block;">
                <label> Description </label>
                <?php echo $result['description']; ?>
            </div>
        </div>
        <div style="width: 40%; height: auto;  display: inline-block; vertical-align: top; text-align: right">
            <img src="image/scale.png">
        </div>
    </div>
</div>
<?php require_once "footer.php"; ?>