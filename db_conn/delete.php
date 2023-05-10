<?php
require_once('dbconfig.php');
$delete = new dbconfig();
class delete extends dbconfig
{
    public function del_event_cal($d_id): mysqli_result|bool
    {
        global $delete;
        return mysqli_query($delete->conn, "DELETE FROM calendar WHERE id = '$d_id'");
    }
    public function deleteDocuments($id): mysqli_result|bool
    {
        global $delete;
        return mysqli_query($delete->conn, "DELETE FROM Documents WHERE DocumentID = '$id'");
    }
    public function delete_request($requestId): bool
    {
        global $delete;
        $delete->conn->autocommit(false); // Start transaction

        // Delete records from documentmapping table
        $stmt1 = $delete->conn->prepare("DELETE FROM `documentmapping_archive` WHERE `RequestID` = ?");
        $stmt1->bind_param("i", $requestId);
        $stmt1->execute();
        if ($stmt1->errno !== 0) {
            $stmt1->close();
            $delete->conn->rollback(); // Rollback transaction
            return false;
        }
        $stmt1->close();

        // Delete records from request table
        $stmt2 = $delete->conn->prepare("DELETE FROM `request_archive` WHERE `RequestID` = ?");
        $stmt2->bind_param("i", $requestId);
        $stmt2->execute();
        if ($stmt2->errno !== 0) {
            $stmt2->close();
            $delete->conn->rollback(); // Rollback transaction
            return false;
        }
        $stmt2->close();

        // Delete records from authorizedpersonnel table
        $stmt3 = $delete->conn->prepare("DELETE FROM `authorizedpersonnel_archive` WHERE `AuthorizedPersonnelID` NOT IN (SELECT `AuthorizedPersonnelID` FROM `request_archive`)");
        $stmt3->execute();
        if ($stmt3->errno !== 0) {
            $stmt3->close();
            $delete->conn->rollback(); // Rollback transaction
            return false;
        }
        $stmt3->close();

        $delete->conn->commit(); // Commit transaction
        return true;
    }
}