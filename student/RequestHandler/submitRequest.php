<?php
session_start();

require_once '../../db_conn/config.php';
include '../../db_conn/view.php';
include '../../db_conn/insert.php';

$insert = new insert();
$view = new view();
$profile_info = $view->pro_view($_SESSION['Profile_ID']);
$student_info = mysqli_fetch_assoc($profile_info);

if(isset($_POST['submit']) && !empty($_POST['requestedDocuments'])) {
    $selectedDocuments = $_POST['requestedDocuments'];
    $requestType = $_POST['submissionType'];
    $studentId = $_SESSION['id'];
    $studentFullName = $student_info['lname'] . ', ' . $student_info['fname'] . ' ' . $student_info['middle'] . '.';
    $studentEmail = $student_info['email'];
    $studentAddress = $student_info['address'];
    $studentGender = $student_info['gender'];
    $studentPhone = $student_info['phone'];
    $department = $_POST['department'];
    $education = $_POST['studentType'];
    $course = $student_info['name'];
    $schedule = $_SESSION['date'];
    $authorizedPersonnelId = null;
    $requestStatus = null;
    $createdAt = date('Y-m-d H:i:s');
    $isFileUploaded = false;

    if ($requestType === 'authorized') {
        if (empty($_POST['fullName']) || empty($_POST['address']) || !isset($_FILES['idPicture'])) {
            $_SESSION['error'] = "All fields are required.";
            header("Location: form.php");
            exit();
        }

        $fileSizeLimit = 5000000; // 5MB
        $allowedFileTypes = array("image/jpeg", "image/png", "image/gif");

        if ($_FILES['idPicture']['error'] === 0 && $_FILES['idPicture']['size'] <= $fileSizeLimit && in_array($_FILES['idPicture']['type'], $allowedFileTypes)) {
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($_FILES["idPicture"]["name"]);

            if (move_uploaded_file($_FILES["idPicture"]["tmp_name"], $targetFile)) {
                $stmt = $conn->prepare("INSERT INTO authorizedpersonnel (AuthorizedPersonnelName, AuthorizedAddress, AuthorizedPerson_IDPic) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $_POST['fullName'], $_POST['address'], $targetFile);

                if ($stmt->execute()) {
                    $authorizedPersonnelId = $stmt->insert_id; // get the generated ID
                    $_SESSION['success'] = "Record inserted successfully.";
                    $isFileUploaded = true;
                } else {
                    $_SESSION['error'] = "Error inserting record.";
                }
                $stmt->close();
            } else {
                $_SESSION['error'] = "Error uploading file.";
            }
        } else {
            $_SESSION['error'] = "Invalid file or file size exceeds limit.";
        }
    } else {
        $isFileUploaded = true;
    }
    if ($isFileUploaded && $insert->new_request($requestType, $studentId, $studentFullName, $studentEmail, $studentAddress, $studentGender, $studentPhone, $department, $course, $education, $schedule, $authorizedPersonnelId, $requestStatus, $createdAt, $selectedDocuments)) {
        $_SESSION['success'] = "Request successfully submitted.";
        header("Location: ../st_main.php?success");
    }else {
        $_SESSION['success'] = "there an error while submitting the request.";
        header("Location: requestForm.php?transaction_failed");
    }
} else {
    $_SESSION['error'] = "Pls Select a document.";
    header("Location: requestForm.php?transaction_failed");
}