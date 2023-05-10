<?php
session_start();
include '../../db_conn/archive.php';
$archive = new Archive();


if(isset($_POST['archiveRequest'])) {
    $requestID = $_POST['request_id'];
    $archive->archive_Requests($requestID, 'canceled')
        ?$_SESSION['success'] = "Request successfully archived."
        :$_SESSION['error'] = "Failed to archive request. Please try again later or contact support if the issue persists.";

    header("Location: ../st_main.php");
    exit(); // to prevent further code execution after redirect
}