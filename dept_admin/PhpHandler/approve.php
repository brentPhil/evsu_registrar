<?php
session_start();
include '../../db_conn/view.php';
$db = new view();


if(isset($_POST['prog'])){
    $uid = $_POST['id'];
    $dept_id = $_SESSION['dept_id'];
    $status = $_POST['up_status'];
    $rq_date = $_POST['sched'];
    if ($rq_date != null){
        if($db->conform_rq($uid, $dept_id, $rq_date)){
            $db->conform_update($uid, $status) ? header("Location: ../dashboard?success") : header("Location: ../ad_main.php?up_failed");
        }else{
            header("Location: ../ad_main.php?failed");
        }
        exit();
    }
}

if (isset($_POST['release'])){
    $uid = $_POST['id'];
    $status = $_POST['up_status'];
    $db->conform_update($uid, $status) ? header("Location: ../appointments.php?success") : header("Location: ../appointments.php?up_failed");
}

if(isset($_POST['released'])){
    $rq_id = $_POST['rq_id'];
    $rq_status = $_POST['up_status'];
    $view=$db->view_request($rq_id);
    $return = mysqli_fetch_assoc($view);
    $db->archive($return['rq_id'],$return['st_uid'],$return['rq_cert'],$return['dept_id'],$return['course_id'],$return['app_type'],$return['full_name'],$return['email'],$return['address'],$return['email'],$return['gender'],$return['edu_status'],$return['rq_schedule'],$rq_status);
    $db->del_rq($rq_id);
    $db->del_sched($rq_id);
    header("Location: ../appointments.php?success");
    exit();
}