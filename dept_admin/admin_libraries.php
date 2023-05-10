<link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" type="text/css">
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../assets/fontawesome-free-6.2.1-web/css/all.min.css" type="text/css">
<script src="../assets/fontawesome-free-6.2.1-web/css/all.min.css" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../assets/css/hmbrgr.min.css" type="text/css">
<link rel="stylesheet" href="../assets/css/sideBar.css" type="text/css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">


<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['admin_login'])) {
    header('Location: ../admin_login.php');
    exit;
}
?>