<?php
session_start();
include '../../db_conn/view.php';
$view = new view();
$dept_r=$view->dept_view();

$conn = mysqli_connect("localhost", "root", "", "sched_system");

if (isset($_POST['register'])){

    if (empty($_POST['dept'])){
        $_SESSION['error'] = 'Please select department';
        header("Location: ../student.php");
        exit();
    }
    if (empty($_POST['student_id'])){
        $_SESSION['error'] = 'Please enter student ID';
        header("Location: ../student.php");
        exit();
    }
    if (empty($_POST['user_name'])){
        $_SESSION['error'] = 'Please enter student username';
        header("Location: ../student.php");
        exit();
    }
    if (empty($_POST['password'])){
        $_SESSION['error'] = 'Please enter a password';
        header("Location: ../student.php");
        exit();
    }

    if ($stmt = $conn->prepare('SELECT * FROM student WHERE student_id = ?')) {
        $stmt->bind_param('s', $_POST['student_id']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $_SESSION['error'] = 'Username already exists, please choose another';
            header("Location: admins.php");
            exit();
        } else {
            if ($stmt = $conn->prepare('INSERT INTO student (dept_id, student_id, user_name, password) VALUES (?, ?, ?, ?)')) {
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $stmt->bind_param('ssss', $_POST['dept'], $_POST['student_id'], $_POST['user_name'], $password);
                $stmt->execute();
                $_SESSION['success'] = 'Student has successfully been added';
                header("Location: ../student.php");
            } else {
                $_SESSION['error'] = 'An error occurred  while adding the student';
                header("Location: ../student.php?error=registration failed pls try again later");
            }
        }
        $stmt->close();
    } else {
        header("Location: ../student.php?error=Could not prepare statement!");
    }
}
$conn->close();
