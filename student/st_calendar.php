<?php
include '../calendar/Calendar.php';
$calendar = new Calendar();
$conn = mysqli_connect("localhost", "root", "", "sched_system");
$events = [];

$results = $conn->query("SELECT app_uid, event_type, event_date, event_length, event_category FROM calendar ORDER BY event_date");
while ($event = $results->fetch_assoc()) {
    $events = $calendar->add_event(
        $event['app_uid'],
        $event['event_type'],
        $event['event_date'],
        $event['event_length'],
        $event['event_category']
    );
}

[$active_year, $active_month, $active_day] = [$calendar->active_year(), $calendar->active_month(), $calendar->active_day()];
$num_days = date('t', strtotime("$active_day-$active_month-$active_year"));
$num_days_last_month = date('j', strtotime("last day of previous month", strtotime("$active_day-$active_month-$active_year")));
$days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];
$first_day_of_week = array_search(date('D', strtotime("$active_year-$active_month-1")), $days);
?>

<link href="../calendar/calendar.css" rel="stylesheet" type="text/css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<div class="calendar bg-light pt-3 rounded-3">
    <div class="header">
        <div class="month-year p-1 px-3 d-flex justify-content-between">
            <h5 class="m-0">Select a date</h5>
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
            $selected = $e_date = $ac = '';
            $ac_event = $a_event = $b_event = $c_event = $d_event = $event_limit = 0;
            $event_array = [];

            $c_date = date('Y-m-d', strtotime($active_year . '-' . $active_month . '-' . $i));
            $s_date = date('F d, Y', strtotime($active_year . '-' . $active_month . '-' . $i));
            $current_date = date('Y-m-d', strtotime($active_year . '-' . $active_month . '-' . $active_day));

            foreach ($events as $event) {
                for ($d = 0; $d <= ($event[2] - 1); $d++) {
                    if (date('y-m-d', strtotime($active_year . '-' . $active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
                        $ac_event = $event[1];
                        switch ($event[3]) {
                            case 1:
                                $a_event = 1;
                                $event_array[] = $event[0];
                                break;
                            case 2:
                                $b_event = 1;
                                $event_array[] = $event[0];
                                break;
                            case 3:
                                $c_event = 1;
                                break;
                            case 4:
                                $d_event = 1;
                                $event_limit++;
                                break;
                        }
                        $e_date = ($event[4] == 3) ? 3 : null;
                    }
                }
            }
            $selected = ($i == $active_day) ? 'selected' : '';
            $ac = ($c_date == $ac_event || $e_date == 3) ? 'ac_event' : '';

            ?>
            <div class="day_num <?= $selected ?>" id="<?= $ac . $i ?>" style="font-size: .8rem" data-bs-toggle="modal" data-bs-target="#modal<?= $c_date ?>">
                <?php if ($selected_date == $i && $selected_date != ''): ?>
                    <div class="event event_4">
                        <div class="text-center"
                             data-bs-toggle="tooltip" data-bs-placement="bottom"
                             data-bs-custom-class="custom-tooltip"
                             data-bs-title="Selected schedule">
                            <?= $i ?> / <?= date('h: i a', strtotime($selected_date)) ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="d-flex justify-content-center"><?= $i ?></div>
                <?php endif; ?>

                <?php if ($c_date == $ac_event || $e_date == 3): ?>
                    <div class="px-2">
                        <div class="d-flex mt-1 w-100">
                            <?php if ($d_event == 1): ?><div class="event event_4"></div><?php endif; ?>
                            <?php if ($a_event == 1): ?><div class="event event_1"></div><?php endif; ?>
                            <?php if ($b_event == 1): ?><div class="event"></div><?php endif; ?>
                            <?php if ($c_event == 1): ?><div class="event event_3"></div><?php endif; ?>
                        </div>
                        <div class="position-relative pt-1">
                            <div id="event<?= $i ?>" class="position-absolute bg-light text-capitalize py-1 shadow-lg" style="z-index: 4; right: 0">
                                <?php
                                $slots = 1;
                                $request = false;
                                foreach ($events as $event_desc):
                                    for ($d = 0; $d <= ($event_desc[2] - 1); $d++):
                                        if (date('y-m-d', strtotime($active_year . '-' . $active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event_desc[1]))):
                                            $event_d = trim($event_desc[3]);
                                            if ($event_desc[4] == 3): ?>
                                                <div class="d-flex align-items-center px-2">
                                                    <div class="event <?= 'event_' . $event_d ?> me-2" style="width: 10px;"></div>
                                                    <div><?= $event_desc[0] ?></div>
                                                </div>
                                            <?php else:
                                                $slots = 10 - $event_limit;
                                                $request = true;
                                            endif;
                                        endif;
                                    endfor;
                                endforeach;
                                if ($request): ?>
                                    <div class="d-flex align-items-center px-2">
                                        <div><?= $slots ?>&nbsp;/ 10 slots available</div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

        <?php if ($c_date > $current_date && $e_date != 3 && $event_limit <= 10) { ?>
            <div class="modal fade" id="modal<?php echo $c_date ?>" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title fs-5" id="exampleModalLabel">Schedule</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body pb-0">
                            <?php
                            $sub_location = '';
                            isset($_SESSION['walk_in']) && $_SESSION['walk_in'] === true
                                ? $sub_location = '../admin/PhpHandler/walkIn_form.php'
                                : $sub_location = 'RequestHandler/requestForm.php'; ?>
                            <form action="<?= $sub_location ?>" method="post">
                                <div class="mb-3">
                                    <label for="floatingInput">Selected date</label>
                                    <input type="hidden" name="date" class="form-control my-2" value="<?php echo $c_date ?>">
                                    <input type="text" readonly class="form-control my-2" value="<?php echo $s_date ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="floatingInput">Select time</label>
                                    <input type="time" name="time" class="form-control my-2">
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" name="submit" class="btn btn-primary px-4" role="button">Proceed</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
            <script>
                $('#event<?php echo $i?>').fadeOut();
                $("#ac_event<?php echo $i?>").hover(function () {
                    $('#event<?php echo $i?>').fadeToggle();
                });
            </script>
        <?php }
        for ($i = 1; $i <= (42-$num_days-max($first_day_of_week, 0)); $i++) { ?>
            <div class="day_num ignore">
                <?php echo $i ?>
            </div>
        <?php } ?>
    </div>
</div>
