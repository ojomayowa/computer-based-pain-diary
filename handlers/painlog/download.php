<?php
session_start();
require_once "../../connection/connection.php";
require_once "../../connection/constants.php";
require_once "../functions.php";

// Load users
$query = $connection->prepare('SELECT start_time, end_time, scale, pain_trigger, location, description, created_at FROM log WHERE user_id = :user_id');
$query->bindParam(':user_id', $_SESSION['details']['id']);
$query->execute();
$report = $query->fetchAll(PDO::FETCH_ASSOC);
$date = date('Y-m-d');
$filename = "Pain log generated for $date.xls";


header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Expires: 0");


//Define the separator line
$separator = "\t";

//If our query returned rows
if (!empty($report)) {
    $other = ['pain_duration', 'interpretation'];

    $fromDb =  array_keys($report[0]);
    $result = array_merge($fromDb, $other);

    echo str_replace('_', ' ', strtoupper(implode($separator, $result))) . "\n";

    //Loop through the rows
    foreach ($report as $row) {
        $duration =  calculateTimeDifference($row['start_time'], $row['end_time']);
        $interpret = interpretPainDownload($row['scale']);
        //Clean the data and remove any special characters that might conflict
        foreach ($row as $k => $v) {
            $row[$k] = str_replace($separator . "$", "", $row[$k]);
            $row[$k] = preg_replace("/\r\n|\n\r|\n|\r/", " ", $row[$k]);
            $row[$k] = trim(($row[$k]));
        }

        $new_array = [
            'pain_duration' => $duration,
            'interpretation' => $interpret
        ];

        $row = array_merge($row, $new_array);
        echo implode($separator, $row) . "\n";
    }
}
