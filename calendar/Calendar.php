<?php
class Calendar {

    private $active_year, $active_month, $active_day;
    private $events = [];

    public function __construct($date = null) {
        $this->active_year = $date != null ? date('Y', strtotime($date)) : date('Y');
        $this->active_month = $date != null ? date('m', strtotime($date)) : date('m');
        $this->active_day = $date != null ? date('d', strtotime($date)) : date('d');
    }

    public function active_year(){
        return $this->active_year;
    }
    public function active_month(){
        return $this->active_month;
    }
    public function active_day(){
        return $this->active_day;
    }

    public function add_event($st_id, $txt, $date, $days = 1, $color = '') {
        $color = $color ? ' ' . $color : $color;
        $this->events[] = [$txt, $date, $days, $color, $st_id];
        return $this->events;
    }
}
