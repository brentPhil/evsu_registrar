<?php
include '../db_conn/archive.php';
$archive = new archive();
include '../main_libraries.php';
include_once '../middleware.php';
include '../toast.php';
$uid = $_SESSION['id'];
$requests = $archive->st_request_archive($uid);
$result = $archive->st_archive_count($uid);

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
?>
    <style>
        .body{
            font-family: 'Poppins', sans-serif;
        }
        th, td {
            padding: 1em !important;
        }

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
            <?php include 'includes/st_sideBar.php' ?>
        </div>

        <div class="sidebar open"></div>
        <div class="w-100">
            <?php include 'includes/st_navBar.php' ?>

            <div class="container">
                <div class="p-5">

                    <nav aria-label="breadcrumb" class="d-flex justify-content-between">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href=>Home</a></li>
                            <li class="breadcrumb-item text-secondary" aria-current="page">Reports</li>
                        </ol>
                    </nav>
                    <div class="card shadow-sm">
                        <div class="card-header ps-2 bg-white position-relative">
                            <div class="nav nav-tabs card-header-tabs">
                                <div class="nav-item p-0">
                                    <div class="nav-link text-secondary active" data-target="#all">All <span class="badge bg-secondary-subtle rounded-1 align-top text-dark"><?= $all_count ?></span></div>
                                </div>
                                <div class="nav-item p-0">
                                    <div class="nav-link text-secondary" data-target="#complete">Completed <span class="badge bg-secondary-subtle rounded-1 align-top text-dark"><?= $claimed ?></span></div>
                                </div>
                                <div class="nav-item p-0">
                                    <div class="nav-link text-secondary" data-target="#canceled">Canceled <span class="badge bg-secondary-subtle rounded-1 align-top text-dark"><?= $canceled ?></span></div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-0">

                            <div class="d-flex justify-content-between p-3 border-bottom border-secondary">
                                <div></div>
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
                                    <?php require_once 'st_tables/archived_request.php'?>
                                </div>
                                <div class="tab-pane fade" id="complete">
                                    <?php require_once 'st_tables/claimed_request.php'?>
                                </div>
                                <div class="tab-pane fade" id="canceled">
                                    <?php require_once 'st_tables/canceled_request.php'?>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <?php
                foreach ($requests as $request):
                    $documents = $archive->docArchive_mappings($request['RequestID']); ?>
                    <?php include 'modal.php'; ?>
                <?php endforeach ?>

            </div>
        </div>
    </div>
<?php include 'includes/footer.php'; ?>