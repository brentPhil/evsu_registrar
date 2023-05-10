<?php
session_start();
include '../../db_conn/delete.php';
$delete = new delete();

if(isset($_POST['deleteRequest'])){
    $requestID = $_POST['request_id'];
    if($delete->delete_request($requestID)){
        $_SESSION['success'] = "Request successfully deleted.";
    }else {
        $_SESSION['error'] = "Failed to delete request. Please try again later or contact support if the issue persists.";
    }
    header("Location: ../archive.php");
    exit(); // to prevent further code execution after redirect
}