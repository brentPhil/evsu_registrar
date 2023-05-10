<?php
require_once ('db/dbconfig.php');

$connection = mysqli_connect("localhost", "root", "", "student");
/*  
buttons for admin_request.php
$adminConn = mysqli_connect("localhost", "root", "", "admin_request.php");
$limit = "SELECT limit FROM users";
$limiter = mysqli_query($adminConn, $limit);
*/

$query = "SELECT * FROM authorize WHERE DATE(r_date) = DATE(NOW()) ORDER BY r_date ASC"; // fetch/select all data's date equal to today's date
$query_run = mysqli_query($connection, $query);

    //NOTE: THIS IS ONLY SET'S THE APPOINTMENT PER DAY, NOT THE QUANTITY.

$i = 1;
while($data = mysqli_fetch_assoc($query_run))
{
    $i++;
    // $i = to number of registration entered today
    if ($i >= 19) //limit of the user that can schedule an appointment
    {
        header('Location: ..\display_message2.php');// display error message
    }
}
