<?php
session_start();

include '../../db_conn/archive.php';
include '../../db_conn/update.php';
include '../../db_conn/insert.php';
include '../../db_conn/delete.php';
$archive = new archive();
$update = new update();
$insert = new insert();
$delete = new delete();

if(isset($_POST['prog'])){
    $uid = $_POST['id'];
    $status = $_POST['up_status'];
    $rq_date = $_POST['sched'];
    $date = true;
    if ($rq_date != null && !$status){
        $date = false;
        $insert->conform_rq($uid, $rq_date) && $date = true;
    }
    if ($date){
        $update->conform_update($uid, $status)
            ?$_SESSION['success'] = "Request has been successfully updated"
            :$_SESSION['error'] = "Sorry, we encountered an error while updating your request. if the symptoms persist consult your doctor";
    }
    header("Location: ../dashboard.php");
    exit();
}

if(isset($_POST['released'])){
    $uid = $_POST['id'];
    $rq_date = $_POST['sched'];
    if ($rq_date != null){
        if($delete->del_event_cal($uid)){
            $archive->archive_Requests($uid, 'completed')
                ?$_SESSION['success'] = "Request has been successfully updated"
                :$_SESSION['error'] = "Sorry, we encountered an error while updating your request. if the symptoms persist consult your doctor";
        }
        $_SESSION['success'] = "Transaction complete";
        header("Location: ../dashboard.php");
        exit();
    }
}

if (isset($_POST['deleteRequest'])) {
    $requestID = $_POST['request_id'];
    if ($delete->delete_request($requestID)) {
        $_SESSION['success'] = "Request successfully deleted.";
    } else {
        $_SESSION['error'] = "Failed to delete request. Please try again later or contact support if the issue persists.";
    }
    $_SESSION['success'] = "Transaction complete";
    header("Location: ../app_archive.php");
    exit(); // to prevent further code execution after redirect
}