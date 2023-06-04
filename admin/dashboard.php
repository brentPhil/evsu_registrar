<?php
include '../db_conn/view.php';
$view = new view();
$dept = $view->dept_view();
$docx = $view->view_all_documents();
$requests = $view->view_all_requests();
$events_v = $view->event_view();
$result = $view->request_count();

$all_count = 0;
$pending_count = 0;
$processing_count = 0;
$for_release_count = 0;

while ($row = mysqli_fetch_assoc($result)) {
    switch ($row['RequestStatus']) {
        case null:
            $pending_count = $row['count'];
            break;
        case '0':
            $processing_count = $row['count'];
            break;
        case '1':
            $for_release_count = $row['count'];
            break;
    }
    $all_count += $row['count'];
}
require_once 'admin_middleware.php';
include '../main_libraries.php';
include '../toast.php';
?>
    <link href="../calendar/calendar.css" rel="stylesheet" type="text/css">
    <style>
        .body{
            font-family: 'Poppins', sans-serif !important;
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

        .doc_card:hover{
            cursor: pointer;
            box-shadow: #3a80c7;
        }
        /* Pending */
        .pending {
            width: 120px;
            color: #FFA500; /* orange */
            background-color: #FFF3E0; /* light orange */
        }

        /* Processing */
        .processing {
            width: 120px;
            color: #4cc0f6;
            background-color: #dcf1ff;
        }

        /* Release */
        .release {
            width: 120px;
            color: #42de92; /* green */
            background-color: #e0ffef; /* light green */
        }
    </style>
    <div class="d-flex body">
        <div class="sideNav shadow-sm position-fixed z-3 flex-column flex-shrink-0 bg-light text-dark open">
            <?php include 'includes/ad_sideBar.php' ?>
        </div>
        <div class="sidebar open"></div>
        <div class="w-100">
            <?php include 'includes/navBar.php' ?>
            <div class="container-fluid">
                <div class="row p-lg-5">
                    <div class="col-12 col-xl-8">

                        <div class="card shadow-sm">
                            <div class="card-header ps-2 bg-white position-relative">
                                <div class="d-flex justify-content-between">
                                    <div class="card-header-tabs nav nav-tabs ">
                                        <div class="nav-item p-0">
                                            <div class="nav-link text-secondary active" data-target="#all">All <span class="badge bg-secondary-subtle rounded-1 align-top text-dark"><?= $all_count ?></span></div>
                                        </div>
                                        <div class="nav-item p-0">
                                            <div class="nav-link text-secondary" data-target="#pending"><i class="fa-solid fa-file-circle-plus" style="color: #FFA500"></i> Pending Request <span class="badge bg-secondary-subtle rounded-1 align-top text-dark"><?= $pending_count ?></span></div>
                                        </div>
                                        <div class="nav-item p-0">
                                            <div class="nav-link text-secondary" data-target="#processing"><i class="fa-solid fa-arrow-rotate-right" style="color: #42de92"></i> In Progress <span class="badge bg-secondary-subtle rounded-1 align-top text-dark"><?= $processing_count ?></span></div>
                                        </div>
                                        <div class="nav-item p-0">
                                            <div class="nav-link text-secondary" data-target="#for-release"><i class="fa-solid fa-hourglass-half " style="color: #4cc0f6"></i> For release <span class="badge bg-secondary-subtle rounded-1 align-top text-dark"><?= $for_release_count ?></span></div>
                                        </div>
                                    </div>
                                    <form class="m-0 d-grid align-items-center" method="post" action="PhpHandler/select_sched.php">
                                        <button class="btn btn-outline-danger btn-sm" name="walk_in"><i class="fa-solid fa-plus"></i> Add request</button>
                                    </form>
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
                                        <?php require_once 'tables/all_request.php'?>
                                    </div>
                                    <div class="tab-pane fade" id="pending">
                                        <?php require_once 'tables/new_request.php'?>
                                    </div>
                                    <div class="tab-pane fade" id="processing">
                                        <?php require_once 'tables/inPro_request.php'?>
                                    </div>
                                    <div class="tab-pane fade" id="for-release">
                                        <?php require_once 'tables/PRelease_request.php'?>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <?php
                    foreach ($requests as $request):
                        $documents = $view->document_mappings($request['RequestID']);?>
                        <?php include '../db_conn/modal.php'; ?>
                    <?php endforeach ?>

                    <div class="col-12 col-xl-4 mt-3 mt-xl-0">
                        <div class="row row-cols-md-2 row-cols-lg-1 gx-3">
                            <div class="col">
                                <div class="card border-0 shadow-sm overflow-hidden mb-3">
                                    <?php include 'ad_calendar.php' ?>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header h6">Events</div>
                                    <div class="card-body px-1 py-2">
                                        <div class="overflow-auto" style="max-height: 158px; min-height: 100px;">
                                            <?php
                                            foreach($events_v as $event_v){
                                                ?>
                                                <div class="py-1 events row mx-2 px-2">
                                                    <div class="col-1 p-0 d-flex align-items-center">
                                                        <div class="event <?php echo 'event_'.trim($event_v['event_category']) ?> rounded-3" style="width: 10px;"></div>
                                                    </div>
                                                    <div class="col-3 p-0 overflow-hidden"><?php echo $event_v['event_type'];?></div>
                                                    <div class="col-7 p-0 overflow-hidden"><?php  echo date('F d, Y', strtotime($event_v['event_date'])) ?></div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include 'includes/footer.php'?>
