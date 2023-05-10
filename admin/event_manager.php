<?php
require_once 'admin_middleware.php';
include '../main_libraries.php';
include '../db_conn/view.php';
include '../db_conn/insert.php';
include '../db_conn/delete.php';
include '../db_conn/update.php';
$view = new view();
$insert = new insert();
$delete = new delete();
$events_v = $view->event_view();

$active_year = '';
$active_month = '';

if(isset($_POST['del'])){
    $d_id = $_POST['d_id'];
    $delete->del_event_cal($d_id) ? header("Location: event_manager.php") : header("Location: event_manager.php?error");
    exit();
}

if(isset($_POST['event'])){
    $insert->new_event(3,$_POST['event_type'],$_POST['event_date'],$_POST['event_length'],$_POST['event_category']) ?
        header("Location: event_manager.php") : header("Location: event_manager.php?error");
    exit();
}
;
?>
<link href="../calendar/calendar.css" rel="stylesheet" type="text/css">
<style>
    .events{
        font-size: .8em;
        text-transform: capitalize;
        background: #eaeaea;
        margin: 5px;
        border-radius: 5px;
        cursor: pointer;
    }
    .events:hover{
        background: #e0e0e0;
    }
    .event_cat{
        padding: 3px 6px;
    }
    .calendar .days .day_name {
        height: 5em !important;
    }
</style>
<div class="d-flex body">
    <div class="sideNav shadow-sm position-fixed z-3 flex-column flex-shrink-0 bg-light text-dark open">
        <?php include 'includes/ad_sideBar.php' ?>
    </div>
    <div class="sidebar open"></div>
    <div class="w-100">
        <?php include 'includes/navBar.php' ?>
        <div class="container-fluid">
            <div class="p-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item text-secondary" aria-current="page">Calendar</li>
                    </ol>
                </nav>
                <div class="row">
                    <div class="col-lg-8 d-grid">
                        <div class="card border-0 shadow-lg" style="min-height: 60vh">
                            <div class="card-body">
                                <?php include 'ad_calendar.php' ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mt-lg-0 mt-md-3">
                        <div class="card mb-sm-3 border-0">
                            <div class="text-light card-header bg_primary border-0">Event Management</div>
                            <div class="card-body pb-0">
                                <h6>Add Event</h6>
                                <form action="" method="post">
                                    <div class="mb-3">
                                        <input type="text" required class="form-control" name="event_type" placeholder="Event">
                                    </div>
                                    <div class="d-flex">
                                        <div class="mb-3 me-2">
                                            <input type="date" class="form-control" name="event_date" id="s_date" value="" placeholder="Date">
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" required class="form-control" value="1" name="event_length" id="floatingInput" placeholder="length">
                                        </div>
                                    </div>
                                    <select class="form-select mb-3" name="event_category" aria-label="Default select example">
                                        <option selected value="1">green</option>
                                        <option value="2">yellow</option>
                                        <option value="3">red</option>
                                    </select>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" name="event" class="btn btn-primary px-4" style="font-size: .8rem" role="button">save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card border-0 shadow-lg">
                            <div class="text-light card-header bg_primary border-0">Events</div>
                            <div class="card-body px-1 py-2">
                                <div class="overflow-auto" style="max-height: 158px; min-height: 100px;">
                                    <?php
                                    foreach($events_v as $event_v){
                                        ?>
                                        <div class="py-1 events row mx-2 px-2">
                                            <div class="col-1 p-0 d-flex align-items-center">
                                                <div class="event <?php echo 'event_'.trim($event_v['event_category']) ?> rounded-3" style="width: 10px;"></div>
                                            </div>
                                            <div class="col-3 p-0 overflow-hidden"><?php echo $event_v['event_type'];?></div>
                                            <div class="col-7 p-0 overflow-hidden"><?php  echo date('F d, Y', strtotime($event_v['event_date'])) ?></div>
                                            <div class="col-1 p-0 fs-6 d-grid align-content-center justify-content-end">
                                                <div class="btn-group dropstart">
                                                    <div class="pb-0 data-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis"></i>
                                                    </div>
                                                    <ul class="dropdown-menu px-3" style="font-size: .8rem">
                                                        <li>
                                                            <form action="" class="mb-0" method="post">
                                                                <input type="hidden" name="d_id" value="<?php echo $event_v['id'];?>">
                                                                <button type="submit" class="btn btn-danger mb-0 w-100" style="font-size: .8rem" name="del" href="#">Remove</button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function getPartID(id){
        const year = '<?php echo $active_year ?>';
        const month = '<?php echo $active_month ?>';
        //const date = new Date(year, month-1, id);
        // alert(date);
        document.getElementById('s_date').value = year + '-' + month + '-' + id;
    }
</script>