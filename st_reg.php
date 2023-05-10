//For PHP Code paste on the top
<?php
include 'db_conn/config.php';

$alert1 = false;

if (isset($_POST['register'])) {
    $user_id = $_POST['st_id'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    //This code is for email validation
    $getEmail = "SELECT * FROM student WHERE email='$email'";
    $runQ = mysqli_query($conn, $getEmail);
    $findEmail = mysqli_fetch_array($runQ);
    $uEmail = $findEmail['email'];


    if (!$uEmail == $email) {
        $insertData = "INSERT INTO student (`username`,`email`,`password`)VALUES('$user_id','$email','$password')";

        $runQuery = mysqli_query($conn, $insertData);
        if ($runQuery) {
            echo '<script>alert("User has been Registered Successfully")</script>';
            echo '<script>window.location.href="login.php"</script>';
        } else {
            echo '<script>alert("User not Registered")</script>';
        }
    } else {
        $alert1 = true;
    }
}
?>

//For HTML Code..
<div class="register">
    <form method="POST">
        <h3>Register Now</h3>
        <?php
        if($alert1 == true){
            echo '<span>This email already exist <a href="login.php">Login</a></span><br><br>';
        }
        ?>
        <input type="text" name="st_id" placeholder="Name" autocomplete="off"><br><br>
        <input type="email" name="email" placeholder="Email" autocomplete="off"><br><br>
        <input type="password" name="password" placeholder="Password" autocomplete="off"><br><br>
        <button type="submit" name="register">Submit</button>
    </form>
</div>