<?php include '_libraries.php'?>

<div class="container">
    <div class="row vh-100 align-items-center justify-content-center">
        <div class="col-12 col-md-8 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-header bg_primary p-4 text-light text-center">
                    <img src="img/logo.png" alt="" style="max-width: 130px;">
                    <h3 class="mt-3 mb-0 font-weight-bold">ADMIN LOGIN</h3>
                    <h6 class="mb-0">OFFICE OF THE REGISTRAR EVSU-TC</h6>
                </div>
                <div class="card-body">
                    <?php if (isset($_GET['error'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="fa-solid fa-warning me-3"></i>
                            <span><?php echo $_GET['error']; ?></span>
                        </div>
                    <?php } ?>
                    <form action="db_conn/admin_login.php" method="POST">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="username" placeholder="Username">
                            <label for="floatingInput"><i class="fa-solid fa-user me-3"></i>Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingInput" name="password" placeholder="password">
                            <label for="floatingInput"><i class="fa-solid fa-lock me-3"></i>Password</label>
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