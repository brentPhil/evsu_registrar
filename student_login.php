<?php
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION['loggedin']) {
    header("Location: student/st_main.php");
    exit();
} else {
    unset($_SESSION["loggedin"], $_SESSION["id"], $_SESSION["Profile_ID"], $_SESSION["dept_id"], $_SESSION["name"]);
}
?>
<?php include 'main_libraries.php'?>
<style>
    .container{
        font-family: 'Poppins', sans-serif;
    }
</style>
<div class="container">
    <div class="row vh-100 d-flex align-items-center justify-content-center">
        <div class="col-12 col-md-8 col-lg-5">
            <div class="card p-0 shadow-lg border-0">
                <div class="card-header bg_primary d-flex text-light rounded-bottom border-0">
                    <div class="m-4">
                        <img src="img/logo.png" alt="" style="min-width: 50px;max-width: 130px">
                    </div>
                    <div class="d-grid align-content-center">
                        <h3 style="font-weight: 800; font-family: 'Poppins', sans-serif">STUDENT LOGIN</h3>
                        <h6>OFFICE OF THE REGISTRAR EVSU-TC</h6>
                    </div>
                </div>
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
                <div class="form px-5 pt-4">
                    <form action="student/PhpHandler/st_login.php" method="POST">
                        <div class="input-group has-validation mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-address-card"></i></span>
                            <div class="form-floating <?= $validation ?>">
                                <input type="text" class="form-control <?= $validation ?>" id="floatingInputGroup1" name="st_id" placeholder="student ID no" oninput="formatStudentId(this)" pattern="[0-9]{4}-[0-9]{5}" maxlength="10">
                                <label for="floatingInputGroup1">Student ID no</label>
                            </div>
                            <div class="invalid-feedback">
                                <?= $validation_feedback ?>
                            </div>
                        </div>

                        <div class="input-group has-validation mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-lock" style="margin: 0 2px"></i></span>
                            <div class="form-floating <?= $validation_pass ?>">
                                <input type="password" class="form-control <?= $validation_pass ?>" name="password" id="floatingInputGroup1" placeholder="Password">
                                <label for="floatingInputGroup1">Password</label>
                            </div>
                            <div class="invalid-feedback">
                                <?= $validation_feedback ?>
                            </div>
                        </div>

                        <div class="alert alert-primary text-center" role="alert">
            <span class="text-primary" style="font-size: .9rem">
              <i class="fa-solid fa-note-sticky me-1"></i>Note: Your password is your first two(2) letters of your lastname and add your Student ID no.
            </span>
                        </div>
                        <button class="btn btn-danger bg_primary w-100 py-3" type="submit">Login</button>
                        <div class="text-center pt-3">
                            <p>Click <a href="admin_login.php">here!</a> for admin</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function formatStudentId(input) {
        // Remove non-numeric characters
        input.value = input.value.replace(/[^0-9]/g, '');

        // Add a dash after the fourth character
        if (input.value.length > 4) {
            input.value = input.value.slice(0, 4) + '-' + input.value.slice(4);
        }

        // Limit the input to the specified pattern
        if (!input.value.match(/^\d{4}-\d{5}$/)) {
            input.setCustomValidity('Please enter a valid student ID number in the format 0000-00000.');
        } else {
            input.setCustomValidity('');
        }
    }
</script>