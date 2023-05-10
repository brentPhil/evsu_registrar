<?php
class ad_Calendar {

private $active_date;
private $events = [];

public function __construct($date = null) {
$this->active_date = $date != null ? new DateTime($date) : new DateTime();
}

public function add_event($st_id, $txt, $date, $days = 1, $color = '') {
$this->events[] = [$txt, new DateTime($date), $days, $color, $st_id];
}

public function __toString() {
$num_days = $this->active_date->format('t');
$num_days_last_month = $this->active_date->modify('last day of previous month')->format('j');
$days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
$first_day_of_week = array_search($this->active_date->modify('first day of this month')->format('D'), $days);
$this->active_date->modify('first day of this month');
$html = '<div class="calendar">';
    $html .= '<div class="header">';
        $html .= '<div class="month-year">';
            $html .= $this->active_date->format('F Y');
            $html .= '</div>';
        $html .= '</div>';
    $html .= '<div class="days">';
        foreach ($days as $day) {
        $html .= '<div class="day_name d-flex justify-content-center">' . $day . '</div>';
        }
        for ($i = $first_day_of_week; $i > 0; $i--) {
        $html .= '<div class="day_num ignore">' . ($num_days_last_month-$i+1) . '</div>';
        }
        for ($i = 1; $i <= $num_days; $i++) {
        $active = '';
        if ($i == $this->active_date->format('d')) {
        $active = ' selected';
        }
        $c_date = $this->active_date->format('Y-m-d');
        $s_date = $this->active_date->format('F d, Y');
        $html .= '<div class="day_num' . $active . '">';
            $html .= '<span class="d-flex justify-content-center w-100">' . $i . '</span>';
            $html .= '<div class="d-flex">';
                foreach ($this->events as $event) {
                if ($c_date == $event[1]->format('Y-m-d')) {
                $html .= '<div class="event' . ($event[3] ? ' ' . $event[3] : '') . '"></div>';
                }
                }
                $html .= '</div>';
            $html .= '</div>';
        $this->active_date->modify('+1 day');
        }
        for ($i = 1; $i <= (42-$num_days-max($first_day_of_week, 0)); $i++) {
        $html .= '<div class="day_num ignore">' . $i . '</div>';
        }
        $html .= '</div>';
    $html .= '</div>';
return $html;
}

}
