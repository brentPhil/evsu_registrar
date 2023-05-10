<?php 
    require_once('view.php');

    class dbconfig
    {
        public $conn;

        public function __construct()
        {
            $this->db_connect();
        }
       
        public function db_connect()
        {
            $this->conn = mysqli_connect('localhost','root','','sched_system');
            if(mysqli_connect_error())
            {
                die(" Connect Failed ");
            }
        }

    }

