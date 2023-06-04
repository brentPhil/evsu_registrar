<?php
include '../db_conn/view.php';
include '../db_conn/archive.php';
$view = new view();
$archive = new archive();
$docx = $view->view_all_documents();
$dept = $view->dept_view();
$requests = $archive->request_archive();
$result = $archive->archive_count();

$all_count = 0;
$claimed = 0;
$canceled = 0;


while ($row = mysqli_fetch_assoc($result)) {
    switch ($row['RequestStatus']) {
        case 'completed':
            $claimed = $row['count'];
            break;
        default:
            $canceled = $row['count'];
            break;
    }
    $all_count += $row['count'];
}

;
require_once 'admin_middleware.php';
include '../main_libraries.php';
?>
    <style>
        .body{
            font-family: 'Poppins', sans-serif;
        }
        .calendar .days .day_num{
            height: 3em !important;
        }
        .calendar .days .day_num.ignore {
            display: inline-flex;
            font-size: 13px;
            height: 3em !important;
        }
        .calendar .days .day_name{
            height: 3em !important;
        }
        .sd{
            display: none
        }
        th, td {
            padding: 1em !important;
        }
        
        .events{
            font-size: .8em;
            text-transform: capitalize;
            background: #eaeaea;
            margin: 5px;
            border-radius: 5px;
            cursor: pointer;
        }
        .events:hover{
            background: #eaeaea !important;
        }
        /* Remove border and add padding to tabs */
        .nav-tabs .nav-link {
            cursor: pointer;
            font-weight: 400;
            border: 0;
        }

        .badge{
            font-size: x-small;
        }
        /* Add primary color to active tab */
        .nav-tabs .nav-link.active,
        .nav-tabs .nav-link.active:focus,
        .nav-tabs .nav-link.active:hover {
            color: #ef5454 !important;
            border-bottom: 2px solid #ef5454;
        }

        .canceled {
            width: 120px;
            color: #ef5454;
            background-color: #fff1f1;
        }
        .claimed {
            width: 120px;
            color: #4cc0f6;
            background-color: #dcf1ff;
        }
    </style>
    <div class="d-flex body">
        <div class="sideNav shadow-sm position-fixed z-3 flex-column flex-shrink-0 bg-light text-dark open">
            <?php include 'includes/ad_sideBar.php' ?>
        </div>
        <div class="sidebar open"></div>
        <div class="w-100">
            <?php include 'includes/navBar.php' ?>
            <div class="container">
                <div class="p-lg-5">

                    <div class="card shadow-sm">
                        <div class="card-header ps-2 bg-white position-relative">
                            <div class="nav nav-tabs card-header-tabs">
                                <div class="nav-item p-0">
                                    <div class="nav-link text-secondary active" data-target="#all">All <span class="badge bg-secondary-subtle rounded-1 align-top text-dark"><?= $all_count ?></span></div>
                                </div>
                                <div class="nav-item p-0">
                                    <div class="nav-link text-secondary" data-target="#claimed"><i class="fa-solid fa-square-check text-success"></i> Claimed <span class="badge bg-secondary-subtle rounded-1 align-top text-dark"><?= $claimed ?></span></div>
                                </div>
                                <div class="nav-item p-0">
                                    <div class="nav-link text-secondary" data-target="#canceled"><i class="fa-solid fa-square-xmark text-danger"></i> Canceled <span class="badge bg-secondary-subtle rounded-1 align-top text-dark"><?= $canceled ?></span></div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-0">

                            <div class="d-flex justify-content-between p-3 border-bottom border-secondary">
                                <div class="d-flex gap-3">
                                    <select id="filter-dept" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                        <option selected value="">All Department</option>
                                        <?php foreach ($dept as $department ){
                                            echo "<option>".$department['dept']."</option>";
                                        } ?>
                                    </select>
                                    <select id="filter-docx" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                        <option selected value="">All Documents</option>
                                        <?php foreach ($docx as $doc ){
                                            echo "<option>".$doc['DocumentName']."</option>";
                                        } ?>
                                    </select>

                                    <input id="date-filter" class="form-control form-control-sm" type="date" placeholder=".form-control-sm" aria-label=".form-control-sm example">
                                </div>

                                <div>
                                    <label class="visually-hidden" for="inlineFormInputGroupUsername">Username</label>
                                    <div class="input-group">
                                        <div class="input-group-text bg-white border-end-0 text-secondary"><i class="fa-solid fa-magnifying-glass"></i></div>
                                        <input type="text" class="form-control border-start-0 ps-0" id="inlineFormInputGroupUsername" placeholder="Search request">
                                    </div>
                                </div>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="all">
                                    <?php require_once 'tables/archived_request.php'?>
                                </div>
                                <div class="tab-pane fade" id="claimed">
                                    <?php require_once 'tables/claimed_request.php'?>
                                </div>
                                <div class="tab-pane fade" id="canceled">
                                    <?php require_once 'tables/canceled_request.php'?>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <?php
                foreach ($requests as $request):
                    $documents = $archive->docArchive_mappings($request['RequestID']); ?>
                    <?php include '../db_conn/modal.php'; ?>
                <?php endforeach ?>

            </div>

        </div>
    </div>
<?php include 'includes/footer.php'?>