<?php
include 'db_conn/view.php';
$view = new view();
$courses=$view->course_view();
session_start()
?>
<?php include '_libraries.php'?>
<div class="container h-100">
    <div class="row p-3 h-100 d-flex align-items-center justify-content-center">
        <div class="card border-0 p-0 shadow-lg col-sm-12 col-s-6 col-md-8 col-lg-6">
            <div class="card-header border-0 text-center rounded-bottom text-light py-4 pt-5 bg_primary">
                <h3 style="font-weight: 800; font-family: 'Poppins', sans-serif">
                    PROFILE SETUP
                </h3>
                <h6>
                    Please take a minute and set up your profile
                </h6>
            </div>
            <form action="student/PhpHandler/profile.php" method="post" autocomplete="off">
                <div class="card-body px-4">
                    <?php if (isset($_GET['error'])) { ?>
                        <div class="alert alert-danger text-center mb-3" role="alert">
                            <span class="text-danger"><i class="fa-solid fa-warning me-3"></i><?php echo $_GET['error']; ?></span>
                        </div>
                    <?php } ?>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="course" id="floatingSelectGrid">
                            <?php foreach($courses as $course){ if ($course['dept_id'] != 0 && $course['dept_id'] == $_SESSION['dept_id']){?>
                                <option value="<?php echo $course['id'] ?>"><?php echo $course['name'] ?></option>
                            <?php }} ?>
                        </select>
                        <label for="floatingSelectGrid">Course</label>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="lname" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Last Name</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="fname" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">First Name</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="middle" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Middle Initial</label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-floating">
                                <select class="form-select" name="gender" id="floatingSelectGrid">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                <label for="floatingSelectGrid">Gender</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="phone" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Contact no.</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="address" placeholder="name@example.com">
                        <label for="floatingInput">Address</label>
                    </div>

                    <div class="form-floating">
                        <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
                        <label for="floatingInput">Email address</label>
                    </div>
                </div>
                <div class="card-footer text-end px-4 border-0">
                    <button class="btn btn-danger bg_primary w-100 py-2" name="save_pro" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
