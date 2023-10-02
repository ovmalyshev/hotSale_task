<?php

function logContent( $userEmail, $text = true ) {
    $logFolder = "log";
    fileCheck($logFolder);
    $date = date("Y-m-d H:i:s");
    if ($text !== false) {
        $logMessage = $date . " User with email '$userEmail' is created";
        $logFileData = $logFolder."/log_" . date("d-M-Y") . ".log";
    } else {
        $logMessage = $date . " User with email '$userEmail' exist";
        $logFileData = $logFolder."/error_log_" . date("d-M-Y") . ".log";
    }
    file_put_contents($logFileData, $logMessage . PHP_EOL, FILE_APPEND);
};

function fileCheck($logFolder) {
    if (!file_exists($logFolder))
    {
        mkdir($logFolder, 0777, true);
    }
};