<?php
include '../../db_conn/view.php';
$view = new view();
$dept_r=$view->dept_view();

$conn = mysqli_connect("localhost", "root", "", "sched_system");

if (isset($_POST['register'])){

    $required_fields = array(
        'username' => 'Enter username',
        'email' => 'Enter email',
        'password' => 'Enter password'
    );

    foreach ($required_fields as $field_name => $error_message) {
        if (empty($_POST[$field_name])) {
            header("Location: admins.php?error=$error_message");
            exit();
        }
    }

    if ($stmt = $conn->prepare('SELECT id, password FROM admin WHERE username = ?')) {
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            header("Location: admins.php?error = Username exists, please choose another");
            exit();
        } else {
            if ($stmt = $conn->prepare('INSERT INTO admin_request.php (dept_id, username, password, email) VALUES (?, ?, ?, ?)')) {
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $stmt->bind_param('ssss', $_POST['dept'], $_POST['username'], $password, $_POST['email']);
                $stmt->execute();
                header("Location: ../Admins.php?success");
            } else {
                header("Location: admins.php?error = registration failed pls try again later");
            }
        }
        $stmt->close();
    } else {
        header("Location: admins.php?error = Could not prepare statement!");
    }
}
$conn->close();?>

<script src="https://kit.fontawesome.com/cd6fddfc69.js" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<div class="container h-100">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="card shadow shadow-md w-50">
            <div class="text-sm-center card-header pt-3">
                <img src="../../img/logo.png" alt="" style="width: 120px; padding-bottom: 1em">
                <div class="fs-5 mb-2">OFFICE OF THE REGISTRAR EVSU-TC</div>
            </div>
            <form action="" method="POST">
                <div class="card-body">
                    <?php if (isset($_GET['error'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <span class="text-danger"><i class="fa-solid fa-warning me-3"></i><?php echo $_GET['error']; ?></span>
                        </div>
                    <?php } ?>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" name="dept" aria-label="Floating label select example">
                            <?php while($dept = mysqli_fetch_assoc($dept_r)){?>
                                <option value="<?php echo $dept['id'] ?>"><?php echo $dept['dept'] ?></option>
                            <?php } ?>
                        </select>
                        <label for="floatingSelect">Select Department</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="username" placeholder="username">
                        <label for="floatingInput"><i class="fa-solid fa-user me-3"></i>Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
                        <label for="floatingInput"><i class="fa-solid fa-at me-3"></i>Email</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="floatingInput" name="password" placeholder="password">
                        <label for="floatingInput"><i class="fa-solid fa-lock me-3"></i>Password</label>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between pb-0">
                    <div><a href="../Admins.php" class="btn btn-link" type="submit"><i class="fa-solid fa-arrow-left-long me-2"></i>Go Back</a></div>
                    <div><button class="btn btn-primary px-4" name="register" type="submit">Register</button></div>
                </div>
            </form>
        </div>
    </div>
</div>