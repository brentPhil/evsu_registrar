<?php
require_once('dbconfig.php');

class view extends dbconfig
{
    public function students(): mysqli_result|bool
    {
        global $view;
        return mysqli_query($view->conn, "SELECT * FROM student a INNER JOIN deppartment b ON a.dept_id = b.id");
    }
    public function dept_view(): mysqli_result|bool
    {
        global $view;
        return mysqli_query($view->conn, "SELECT * FROM deppartment");
    }

    public function request_count(): mysqli_result|bool
    {
        global $view;
        return mysqli_query($view->conn, "SELECT RequestStatus, COUNT(*) as count FROM request GROUP BY RequestStatus");
    }

    public function st_request_count($st_id): mysqli_result|bool
    {
        global $view;
        return mysqli_query($view->conn, "SELECT RequestStatus, COUNT(*) as count FROM request WHERE StudentID = '$st_id'");
    }

    public function view_all_documents(): mysqli_result|bool
    {
        global $view;
        $query = "SELECT * FROM Documents";
        return mysqli_query($view->conn, $query);
    }
    public function document_mappings($request_id): mysqli_result|bool
    {
        global $view;
        $query = "SELECT d.DocumentName, d.DocumentDescription 
        FROM Documents d 
        JOIN DocumentMapping dm ON d.DocumentID = dm.DocumentID 
        WHERE dm.RequestID = '$request_id'";
        return mysqli_query($view->conn, $query);
    }
    public function view_all_requests(): mysqli_result|bool
    {
        global $view;
        $query = "SELECT * FROM Request
LEFT JOIN AuthorizedPersonnel
ON Request.AuthorizedPersonnelID = AuthorizedPersonnel.AuthorizedPersonnelID
";
        return mysqli_query($view->conn, $query);
    }
    public function approved_requests(): mysqli_result|bool
    {
        global $view;
        $query = "SELECT * FROM Request
LEFT JOIN AuthorizedPersonnel ON Request.AuthorizedPersonnelID = AuthorizedPersonnel.AuthorizedPersonnelID 
WHERE RequestStatus != null;";
        return mysqli_query($view->conn, $query);
    }
    public function event_view(): mysqli_result|bool
    {
        global $view;
        return mysqli_query($view->conn, "SELECT * FROM calendar WHERE app_uid = 3");
    }
    public function st_request_view($request_id): mysqli_result|bool
    {
        global $view;
        return mysqli_query($view->conn, "SELECT * FROM Request r
LEFT JOIN AuthorizedPersonnel
ON r.AuthorizedPersonnelID = AuthorizedPersonnel.AuthorizedPersonnelID
WHERE r.StudentID = '$request_id'");
    }
    public function specific_request_view($student_id): mysqli_result|bool
    {
        global $view;
        return mysqli_query($view->conn, "SELECT * FROM Request
LEFT JOIN AuthorizedPersonnel
ON Request.AuthorizedPersonnelID = AuthorizedPersonnel.AuthorizedPersonnelID
WHERE r.StudentID = '$student_id'");
    }
    public function dept_view_id($id): mysqli_result|bool
    {
        global $view;
        return mysqli_query($view->conn, "SELECT * FROM deppartment WHERE id = '$id'");
    }
    public function pro_view($id): mysqli_result|bool
    {
        global $view;
        $query = "SELECT *
FROM st_profile
INNER JOIN courses ON st_profile.course_id = courses.id WHERE st_profile.id = '$id'";
        return mysqli_query($view->conn, $query);
    }
    public function course_view(): mysqli_result|bool
    {
        global $view;
        return mysqli_query($view->conn, "SELECT * FROM courses");
    }
    public function course_view_id($id): mysqli_result|bool
    {
        global $view;
        return mysqli_query($view->conn, "SELECT * FROM courses WHERE dept_id = '$id'");
    }
    public function admins(): mysqli_result|bool
    {
        global $view;
        return mysqli_query($view->conn, "SELECT * FROM admin_request.php a INNER JOIN deppartment b ON a.dept_id = b.id");
    }

//    Insert Functions
}