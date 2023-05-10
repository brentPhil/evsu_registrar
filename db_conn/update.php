<?php
require_once('dbconfig.php');
$update = new dbconfig();

class update extends dbconfig
{
    public function conform_update($uid, $status) {
        $stmt = $this->conn->prepare("UPDATE request SET RequestStatus=? WHERE RequestID=?");
        $stmt->bind_param("si", $status, $uid);
        return $stmt->execute();
    }

}