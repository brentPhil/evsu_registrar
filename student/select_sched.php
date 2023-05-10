<?php
session_start();
include '../db_conn/view.php';
$view= new view();
$id = '';
$type  = '';
$sched  = '';
$date_s = '';
$selected_date = '';

isset($_POST['walk_in']) && $_SESSION['walk_in'] = true;

if (isset($_POST['edit'])){
    $id = $_POST['rq_id'];
    $rp_data = mysqli_fetch_assoc($view->specific_request_view($id));

    $type = $rp_data['app_type'];
    $date_s = $rp_data['rq_schedule'];

    $date_s != '' && $selected_date = $date_s != null ? date('d', strtotime($date_s)) : date('d');
}
include '../main_libraries.php';
?>
<style>
    .calendar .days .day_num {
        height: 54px!important;
    }
    .calendar .days .day_name {
        height: 50px!important;
    }

    .custom-tooltip {
        --bs-tooltip-bg: #3a80c7;
    }
    .event-tooltip {
        --bs-tooltip-bg: #f7c30d;
    }
</style>
<link href="../calendar/calendar.css" rel="stylesheet" type="text/css">
<body>
<div class="container d-flex justify-content-center py-5">
    <div class="w-75">
        <?php
        $back_location = 'st_main.php';
        isset($_SESSION['walk_in']) && $_SESSION['walk_in'] === true && $back_location = '../admin/dashboard.php'
        ?>
        <a href="<?= $back_location ?>" class="btn btn-danger border-0 text-light mb-3 bg_primary" style="font-size: .8rem;">
            <i class="fa fa-arrow-alt-circle-left me-2"></i>Back to Portal
        </a>
        <div class="card shadow shadow-md px-3">
            <div class="img w-50 m-auto">
                <img src="../img/registrar.png" style="width: 100%" alt="evsu logo">
            </div>
            <div>
                <div class="w-100 mb-3">
                    <?php include 'st_calendar.php' ?>
                    <?php if ($selected_date > 0){ ?>
                        <div class="text-end my-3">
                            <form action="RequestHandler/requestForm.php" class="mb-2" method="post">
                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                <input type="hidden" name="date" value="<?php echo $date_s ?>">
                                <input type="hidden" name="type" value="<?php echo $type ?>">
                                <button type="submit" name="edit" class="btn btn-light px-5">Skip</button>
                            </form>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>