<?php
include '../calendar/Calendar.php';
$calendar = new Calendar();
$conn = mysqli_connect("localhost", "root", "", "sched_system");
$events = [];
$results = mysqli_query($conn, "SELECT * FROM calendar ORDER BY event_date");
while($event = mysqli_fetch_assoc($results)){
    $st_id = $event['app_uid'];
    $type = $event['event_type'];
    $date = $event['event_date'];
    $length = $event['event_length'];
    $category = $event['event_category'];
    $events = $calendar->add_event($st_id, $type, $date, $length, $category);
}

$active_year = $calendar->active_year();
$active_month = $calendar->active_month();
$active_day = $calendar->active_day();
$num_days = date('t', strtotime($active_day . '-' . $active_month. '-' . $active_year));
$num_days_last_month = date('j', strtotime('last day of previous month', strtotime($active_day . '-' . $active_month . '-' . $active_year)));
$days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];
$first_day_of_week = array_search(date('D', strtotime($active_year . '-' . $active_month . '-1')), $days);
?>

<link href="../calendar/calendar.css" rel="stylesheet" type="text/css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<div class="calendar bg-light pt-3 rounded-3">
    <div class="header">
        <div class="month-year p-1 px-3 d-flex justify-content-between">
            <h5 class="m-0 sd">Select a date</h5>
            <?php echo date('F Y', strtotime($active_year . '-' . $active_month . '-' . $active_day));?>
        </div>
    </div>
    <div class="days">
        <?php foreach ($days as $day) {?>
            <div class="day_name d-flex justify-content-center">
                <?php echo $day ?>
            </div>
        <?php } for ($i = $first_day_of_week; $i > 0; $i--) {?>
            <div class="day_num ignore">
                <?php echo ($num_days_last_month-$i+1)?>
            </div>
        <?php }

        for ($i = 1; $i <= $num_days; $i++) {
            $selected = '';
            $e_date = '';
            $ac = '';
            $c_date = date('Y-m-d', strtotime($active_year . '-' . $active_month . '-' . $i));
            $s_date = date('F d, Y', strtotime($active_year . '-' . $active_month . '-' . $i));
            $current_date = date('Y-m-d', strtotime($active_year . '-' . $active_month . '-' . $active_day));

            $ac_event = 0;
            $a_event = 0;
            $b_event = 0;
            $c_event = 0;
            $d_event = 0;
            $event_limit = 0;
            $event_array = [];
            foreach ($events as $event) {
                for ($d = 0; $d <= ($event[2] - 1); $d++) {
                    if (date('y-m-d', strtotime($active_year . '-' . $active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
                        if ($event[4] == 3) {
                            $e_date = 3;
                        }
                        $ac_event = $event[1];

                        if ($event[3] == 1) {
                            $a_event = 1;
                            $event_array[] = $event[0];
                        }
                        if ($event[3] == 2) {
                            $b_event = 1;
                            $event_array[] = $event[0];
                        }
                        if ($event[3] == 3) {
                            $c_event = 1;
                        }
                        if ($event[3] == 4) {
                            $d_event = 1;
                            $event_limit++;
                        }

                    }
                }
            }
            if ($i == $active_day) {
                $selected = 'selected';
            }
            if ($c_date == $ac_event || $e_date == 3) {
                $ac = 'ac_event';
            }
            ?>
        <div class="day_num <?php echo $selected ?>" id="<?php echo $ac, $i?>" style="font-size: .8rem" onclick="getPartID(<?php echo $i;?>)">
            <div class="d-flex justify-content-center"><?php echo $i ?></div>
                <?php if ($c_date == $ac_event || $e_date == 3){?>
                    <div class="px-2">
                        <div class="d-flex mt-1 w-100">
                            <?php
                            if ($d_event == 1){?>
                                <div class="event event_4"></div>
                            <?php }
                            if ($a_event == 1){?>
                                <div class="event event_1"></div>
                            <?php }
                            if ($b_event == 1){?>
                                <div class="event"></div>
                            <?php }
                            if ($c_event == 1){?>
                                <div class="event event_3"></div>
                            <?php } ?>
                        </div>
                        <div class="position-relative pt-1">
                            <div id="event<?php echo $i ?>" class="position-absolute bg-light text-capitalize py-1 fw-light shadow-lg" style="z-index: 4; right: 0">
                                <?php
                                $request = false;
                                foreach ($events as $event_desc){
                                    for ($d = 0; $d <= ($event_desc[2] - 1); $d++) {
                                        if (date('y-m-d', strtotime($active_year . '-' . $active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event_desc[1]))){
                                        $event_d = trim($event_desc[3]);
                                            if ($event_desc[4] == 3){ ?>
                                            <div class="d-flex align-items-center px-2">
                                                <div class="event <?php echo 'event_'.$event_d ?> me-2" style="width: 10px;"></div>
                                                <div><?php echo $event_desc[0] ?></div>
                                            </div>
                                        <?php } else {$request = true;}
                                        }
                                    }
                                }
                                if ($request){?>
                                    <div class="d-flex align-items-center px-2">
                                        <div class="event <?php echo 'event_'.$event_d ?> me-2" style="width: 10px;"></div>
                                        <div class="d-flex"><div class="me-2"><?php echo $event_limit ?></div><div>Request</div></div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

        <?php if($c_date > $current_date && $e_date != 3 && $event_limit <= 3){ ?>
            <div class="modal fade" id="modal<?php echo $c_date ?>" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title fs-5" id="exampleModalLabel">Schedule</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body pb-0">
                            <div>
                                <form action="app_options.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                    <input type="hidden" name="type" value="<?php echo $type ?>">
                                    <div class="mb-3">
                                        <label for="floatingInput">Selected date</label>
                                        <input type="hidden" name="date" class="form-control my-2" value="<?php echo $c_date ?>">
                                        <input type="text" readonly class="form-control my-2" value="<?php echo $s_date ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="floatingInput">Select time</label>
                                        <input type="time" name="time" class="form-control my-2">
                                    </div>
                                    <?php if ($selected_date != ''){?>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" name="edit" class="btn btn-primary px-4" role="button">Proceed</button>
                                        </div>
                                    <?php }else{?>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" name="submit" class="btn btn-primary px-4" role="button">Proceed</button>
                                        </div>
                                    <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
            <script>
                $('#event<?php echo $i?>').fadeOut();
                $("#ac_event<?php echo $i?>").hover(function () {
                        $('#event<?php echo $i?>').fadeIn();
                    }, function () {
                        $('#event<?php echo $i?>').fadeOut();
                    }
                );
            </script>
        <?php }
        for ($i = 1; $i <= (42-$num_days-max($first_day_of_week, 0)); $i++) { ?>

            <div class="day_num ignore">
                <?php echo $i ?>
            </div>
        <?php } ?>
    </div>
</div>