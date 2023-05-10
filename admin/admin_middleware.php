<?php
session_start();
!isset($_SESSION['id']) && !isset($_SESSION['admin_login']) && !isset($_SESSION['ad_name'])
&& header("Location: ../admin_login.php");