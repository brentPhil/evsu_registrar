<?php
require_once('dbconfig.php');

class archive extends dbconfig
{
    public function st_request_archive($request_id): mysqli_result|bool
    {
        global $archive;
        return mysqli_query($archive->conn, "SELECT * FROM Request_archive r
LEFT JOIN authorizedpersonnel_archive a
ON r.AuthorizedPersonnelID = a.AuthorizedPersonnelID
WHERE r.StudentID = '$request_id'");
    }

    public function docArchive_mappings($request_id): mysqli_result|bool
    {
        global $archive;
        $query = "SELECT d.DocumentName, d.DocumentDescription 
        FROM Documents d 
        JOIN DocumentMapping_archive dm ON d.DocumentID = dm.DocumentID 
        WHERE dm.RequestID = '$request_id'";
        return mysqli_query($archive->conn, $query);
    }

    public function archive_count(): mysqli_result|bool
    {
        global $archive;
        return mysqli_query($archive->conn, "SELECT RequestStatus, COUNT(*) as count FROM request_archive GROUP BY RequestStatus");
    }

    public function st_archive_count($st_id): mysqli_result|bool
    {
        global $archive;
        return mysqli_query($archive->conn, "SELECT RequestStatus, COUNT(*) as count FROM request_archive WHERE StudentID = '$st_id' GROUP BY RequestStatus");
    }

    public function request_archive(): mysqli_result|bool
    {
        global $archive;
        return mysqli_query($archive->conn, "SELECT * FROM Request_archive r
LEFT JOIN authorizedpersonnel_archive a
ON r.AuthorizedPersonnelID = a.AuthorizedPersonnelID");
    }
    public function archive_Requests($requestID, $status): mysqli_result|bool
    {
        try {
            // Start transaction
            $this->conn->begin_transaction();

            $stmt6 = $this->conn->prepare("UPDATE request SET RequestStatus = ? WHERE RequestID = ?");
            $stmt6->bind_param("ss", $status, $requestID);
            $stmt6->execute();
            $stmt6->close();

            // Archive requests
            $stmt1 = $this->conn->prepare("INSERT INTO request_archive SELECT * FROM request WHERE RequestID = ?");
            $stmt1->bind_param("s", $requestID);
            $stmt1->execute();
            $stmt1->close();

            // Archive document mappings
            $stmt2 = $this->conn->prepare("INSERT INTO documentmapping_archive SELECT * FROM documentmapping WHERE RequestID = ?");
            $stmt2->bind_param("s", $requestID);
            $stmt2->execute();
            $stmt2->close();

            // Archive authorized personnel
            $stmt3 = $this->conn->prepare("INSERT INTO authorizedpersonnel_archive SELECT * FROM authorizedpersonnel WHERE AuthorizedPersonnelID IN (SELECT DISTINCT AuthorizedPersonnelID FROM request_archive)");
            $stmt3->execute();
            $stmt3->close();

            // Delete calendar row related to archived request
            $stmt4 = $this->conn->prepare("DELETE FROM calendar WHERE app_uid = ?");
            $stmt4->bind_param("s", $requestID);
            $stmt4->execute();
            $stmt4->close();

            // Clear requests and associated records from original tables
            $stmt5 = $this->conn->prepare("DELETE FROM documentmapping WHERE RequestID = ?");
            $stmt5->bind_param("s", $requestID);
            $stmt5->execute();
            $stmt5->close();

            $stmt6 = $this->conn->prepare("DELETE FROM request WHERE RequestID = ?");
            $stmt6->bind_param("s", $requestID);
            $stmt6->execute();
            $stmt6->close();

            // Delete authorized personnel associated with archived requests
            $stmt7 = $this->conn->prepare("DELETE FROM authorizedpersonnel WHERE AuthorizedPersonnelID IN (SELECT DISTINCT AuthorizedPersonnelID FROM request_archive)");
            $stmt7->execute();
            $stmt7->close();

            // Commit transaction
            $this->conn->commit();

            return true;
        } catch (Exception $e) {
            error_log("Error archiving request: " . $e->getMessage());
            $this->conn->rollback();
            return false;
        }
    }
}