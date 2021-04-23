<?php
session_start();
if (!isset($_SESSION['details'])) {
    header('location: index.php');
}
require 'connection/constants.php';
require 'handlers/functions.php';
require 'connection/connection.php';
$query = $connection->prepare('SELECT * FROM log WHERE user_id = :user_id');
$query->bindParam(':user_id', $_SESSION['details']['id']);
$query->execute();
$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<?php require_once "header.php"; ?>
<div class="container">
    <div class="top-header">
        <b>Welcome <?php echo $_SESSION['details']['name'] ?></b><br>
        You are here: Report
    </div>
    <div class="content">
        <?php require_once 'handlers/alerts.php'; ?>
        <table class="table">
            <thead>
                <tr>
                    <th colspan="6"> <a href="handlers/painlog/download.php">Download Log</a> </th>
                </tr>
                <tr>
                    <th><b>Date Added</b></th>
                    <th><b>Start Time</b></th>
                    <th><b>End Time</b></th>
                    <th><b>Pain Duration</b></th>
                    <th><b>Pain Scale</b></th>
                    <th><b>Interpret Pain Scale</b></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fetch as $row) { ?>
                    <tr>
                        <td><?php echo $row['created_at']; ?></td>
                        <td><?php echo $row['start_time']; ?></td>
                        <td><?php echo $row['end_time']; ?></td>
                        <td><?php echo calculateTimeDifference($row['start_time'], $row['end_time']); ?></td>
                        <td><?php echo $row['scale']; ?></td>
                        <td><?php echo interpretPain($row['scale']); ?></td>
                        <td><a href="view-details.php?id=<?php echo $row['id']; ?>"> view details </a></td>
                        <td><a href="handlers/painlog/delete.php?id=<?php echo $row['id']; ?>"> delete </a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once "footer.php"; ?>