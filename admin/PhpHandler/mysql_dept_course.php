<?php
include '../../db_conn/insert.php';
$insert = new insert();

if(isset($_POST['new_dept'])){
    $insert->new_dept($_POST['dept'], $_POST['desk']) ? header("Location: ../dept_course.php?success") : header("Location: ../dept_course.php?failed");
    exit();
}
if(isset($_POST['new_course'])){
    $insert->new_course($_POST['dept'], $_POST['name'], $_POST['desk']) ? header("Location: ../dept_course.php?success") : header("Location: ../dept_course.php?failed");
    exit();
}