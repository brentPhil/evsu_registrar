<style>
    .setxt{
        font-size: 1rem;
        font-weight: 600;
        color: #3b3b3b;
        cursor: pointer;
    }
    .col-lg-4{
        border-right: 1px solid #d4dee1;
    }
    .setxt:hover{
        color: #262626;
        background: #f3f3f3;
    }
</style>
<?php include 'linkScript.php'?>
<div class="d-flex body h-100">
    <?php include 'includes/st_sideBar.php' ?>
    <div class="w-100">
        <?php include 'includes/st_navBar.php' ?>
        <div class="container p-5">
            <div class="card border-0 h-75 shadow-lg mb-4">
                <div class="card-body">
                    <div class="row h-100 p-3">
                        <div class="col-lg-4 py-3">
                            <div class="w-100 text-dark mb-3 pb-2 border-bottom">
                                <p class="h3 m-0">Settings</p>
                            </div>
                            <div class="py-3 ps-2 setxt"><a>My Profile</a></div>
                            <div class="py-3 ps-2 setxt"><a>Account Settings</a></div>
                        </div>
                        <div class="col-lg-8 pt-3 px-5 h-100">
                            <div class="w-100">
                                <p class="h6 text-dark mb-3">My Profile</p>
                                <div class="shadow-lg" style="width: 150px; height: 150px; border-radius: 100%">
                                    <img src="../img/logo.png" style="width: 100%; height: 100%; object-fit: cover;" alt="picture">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>