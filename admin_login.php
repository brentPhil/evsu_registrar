<?php
session_start();
if (isset($_SESSION["admin_login"]) && $_SESSION['admin_login']) {
    header("Location: /evsu_registrar/admin/dashboard.php");
    exit();
} else {
    unset(
        $_SESSION["admin_login"],
        $_SESSION["id"],
        $_SESSION["ad_name"],
        $_SESSION["dept_id"]);
}
include 'main_libraries.php';
?>

<style>
    .container{
        font-family: 'Poppins', sans-serif;
    }
</style>

<div class="container">
    <div class="row vh-100 align-items-center justify-content-center">
        <div class="col-12 col-md-8 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-header bg_primary p-4 text-light text-center">
                    <img src="/evsu_registrar/img/logo.png" alt="" style="max-width: 130px;">
                    <h3 class="mt-3 mb-0 font-weight-bold">ADMIN LOGIN</h3>
                    <h6 class="mb-0">OFFICE OF THE REGISTRAR EVSU-TC</h6>
                </div>
                <div class="card-body">
                    <?php
                    $validation_pass = '';
                    $validation = '';
                    $validation_feedback = '';
                    if(isset($_SESSION['error_pass'])){
                        $validation_feedback = $_SESSION['error_pass'];
                        $validation_pass = 'is-invalid';
                    }elseif(isset($_SESSION['error'])){
                        $validation_feedback = $_SESSION['error'];
                        $validation = 'is-invalid';
                    }
                    unset($_SESSION['error_pass']);
                    unset($_SESSION['error']);
                    ?>
                    <form action="/evsu_registrar/db_conn/admin_login.php" method="POST">
                        <div class="input-group has-validation mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                            <div class="form-floating <?= $validation ?>">
                                <input type="text" name="username" class="form-control <?= $validation ?>" id="floatingInputGroup1" placeholder="Username">
                                <label for="floatingInputGroup1">Username</label>
                            </div>
                            <div class="invalid-feedback">
                                <?= $validation_feedback ?>
                            </div>
                        </div>
                        <div class="input-group has-validation mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                            <div class="form-floating <?= $validation_pass ?>">
                                <input type="password" name="password" class="form-control <?= $validation_pass ?>" id="floatingInputGroup1" placeholder="Username">
                                <label for="floatingInputGroup1">Password</label>
                            </div>
                            <div class="invalid-feedback">
                                <?= $validation_feedback ?>
                            </div>
                        </div>
                        <button class="btn btn-danger bg_primary w-100 py-3" name="login" type="submit">Login</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <p>Click <a href="student_login.php">here!</a> for Student</p>
                </div>
            </div>
        </div>
    </div>
</div>