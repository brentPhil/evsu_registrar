<?php
include '../db_conn/view.php';
$db = new view();

include 'admin_libraries.php';
$new_request=$db->request($_SESSION['dept_id']);
$approved=$db->approved_request($_SESSION['dept_id']);?>
    <link href="../calendar/calendar.css" rel="stylesheet" type="text/css">
    <style>
        .calendar .days .day_num {
            height: 2.5em !important;
        }
        .calendar .days .day_name {
            height: 2.5em !important;
        }
        .sd{
            display: none;
        }
    </style>
    <div class="d-flex body">
        <div id="side_bar" class="sideNav flex-column flex-shrink-0 bg-light text-dark open">
            <?php include 'includes/ad_sideBar.php' ?>
        </div>
        <div class="w-100">
            <?php include 'includes/navBar.php' ?>

            <div class="container px-5 pt-3">
                <div class="row pt-3">
                    <div class="col-md-8 d-grid">
                        <div class="card border-0 p-1 shadow-lg mb-3">
                            <div class="table-responsive p-2 text-capitalize">
                                <table id="rq">
                                    <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Schedule</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($new_request as $request){if($request['request_status'] == 'pending...'){
                                        $i++; ?>
                                        <tr>
                                            <td><div class="overflow-ellipsis" style="width: 150px;"><?php  echo $request['full_name']; ?></div></td>
                                            <td><div class="overflow-ellipsis" style="width: 150px;"><?php  echo date('F d, Y | h: i a', strtotime($request['rq_schedule'])); ?></div></td>
                                            <td><div class="td fw-bold text-<?php echo $color = $request['request_status'] != 'pending' ? 'success' : 'primary';?>"><?php echo $request['request_status']?></div></td>
                                            <td class="text-end d-flex justify-content-end">
                                                <button type="button" class="btn btn-light btn-sm me-2" style="font-size: .8rem" data-bs-toggle="modal" data-bs-target="#<?php  echo 'modal'.$i; ?>">
                                                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                                                </button>
                                                <form action="PhpHandler/approve.php" class="m-0" method="post">
                                                    <input type="hidden" name="id" value="<?php  echo $request['rq_id']; ?>">
                                                    <input type="hidden" name="sched" value="<?php  echo $request['rq_schedule']; ?>">
                                                    <input type="hidden" name="up_status" value="on process">
                                                    <button type="submit" name="prog" class="btn btn-outline-warning btn-sm me-2" style="font-size: .8rem">
                                                        <i class="fa-regular fa-calendar-check"></i> Approve
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php include 'includes/modal.php'?>
                                    <?php }} ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card border-0 p-1 shadow-lg">
                            <div class="table-responsive p-2 text-capitalize">
                                <table id="myTable">
                                    <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Schedule</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = "";
                                    while($request = mysqli_fetch_assoc($approved)){
                                        $i++;?>
                                        <tr>
                                            <td><div class="overflow-ellipsis" style="width: 150px;"><?php  echo $request['full_name']; ?></div></td>
                                            <td><div class="overflow-ellipsis" style="width: 150px;"><?php  echo date('F d, Y | h: i a', strtotime($request['rq_schedule'])); ?></div></td>
                                            <td><div class="td fw-bold text-<?php echo $color = $request['request_status'] == 'on progress' ? 'primary' : 'warning';?>"><?php echo $request['request_status']?>...</div></td>
                                            <td class="text-end d-flex justify-content-end">
                                                <button type="button" class="btn btn-light btn-sm me-2" style="font-size: .8rem" data-bs-toggle="modal" data-bs-target="#<?php  echo 'modal'.$i; ?>">
                                                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                                                </button>
                                                <?php  if($request['request_status'] == 'for release'){ ?>
                                                    <form action="PhpHandler/approve.php" class="m-0" method="post">
                                                        <input type="hidden" name="id" value="<?php  echo $request['rq_id']; ?>">
                                                        <input type="hidden" name="up_status" value="for release">
                                                        <button type="submit" name="release" class="btn btn-outline-warning me-2" style="font-size: .8rem">
                                                            <i class="fa-regular fa-calendar-check"></i> Released
                                                        </button>
                                                    </form>
                                                <?php }else{ ?>
                                                    <form action="PhpHandler/approve.php" class="m-0" method="post">
                                                        <input type="hidden" name="id" value="<?php  echo $request['rq_id']; ?>">
                                                        <input type="hidden" name="up_status" value="for release">
                                                        <button type="submit" name="release" class="btn btn-outline-warning me-2" style="font-size: .8rem">
                                                            <i class="fa-regular fa-calendar-check"></i> For release
                                                        </button>
                                                    </form>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php include 'includes/modal.php'?>
                                    <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-grid">
                        <div class="card border-0 p-1 shadow-lg mb-3">
                            <?php include 'ad_calendar.php' ?>
                        </div>
                        <div class="card border-0 shadow-lg">
                            <div class="text-light card-header bg_primary border-0">Events</div>
                            <div class="card-body px-1 py-2">
                                <div class="overflow-auto" style="max-height: 158px; min-height: 25vh; font-size: .8rem">
                                    <?php
                                    $conn = mysqli_connect("localhost", "root", "", "sched_system");
                                    $results = mysqli_query($conn, "SELECT * FROM calendar WHERE app_uid = 3");
                                    while($rp_data = mysqli_fetch_assoc($results)){
                                        ?>
                                        <div class="py-1 events row mx-2 px-2">
                                            <div class="col-1 p-0 d-flex align-items-center">
                                                <div class="event <?php echo 'event_'.trim($rp_data['event_category']) ?> rounded-3" style="width: 10px;"></div>
                                            </div>
                                            <div class="col-4 p-0 overflow-hidden"><?php echo $rp_data['event_type'];?></div>
                                            <div class="col-7 p-0 overflow-hidden"><?php  echo date('F d, Y', strtotime($rp_data['event_date'])) ?></div>
                                        </div>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include 'includes/footer.php'?>