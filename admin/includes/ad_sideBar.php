<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap" rel="stylesheet">
<style>
    .body, .tlink, .dropdown-menu li{
        font-family: 'Poppins', sans-serif !important;
    }

    .sideLink .active{
        color: #ff3636 !important;
        border-right: 3px solid #ff3636;
        background: rgb(2,0,36);
        background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(255,255,255,0) 0%, rgba(255,226,226,0.7987570028011204) 100%);
    }

    .doc_card:hover .docCardIMG {
        height: 120px; /* set the desired increased height */
    }

    .docCardIMG {
        transition: all 0.3s ease;
        position: relative;
        height: 80px; /* set the desired height of the container */
        overflow: hidden;
    }

    .docCardIMG img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: auto;
        object-fit: cover;
    }
</style>
<div class="h-100 bg-white">
<div class="px-3" style="border-radius: 0 0 1em 1em; background: #d54b4b">
    <div style="max-width: 70px; padding: 1.5em 0">
        <div class="d-flex justify-content-center">
            <a href="#" class="hmbrgr four"></a>
        </div>
    </div>

    <div class="w-100 py-3 me-3">
        <div id="btn" class="card-img rounded-circle m-auto" style="max-width: 4.5rem; max-height: 4.5rem; border: 2px solid white">
            <img src="../img/logo.png" class="" style="width: 100%; object-fit: cover" alt="logo">
        </div>
        <div class="tlink fs-4 mt-2 fw-bolder text-light text-center overflow-hidden">REGISTRAR</div>
        <div class="tlink text-light text-center" style="font-size: .8rem; font-family: 'Poppins', sans-serif">Admin Access</div>
    </div>
</div>

<div class="mt-4 sideLink">
    <ul id="menu" class="m-0 p-0" style="list-style: none">
        <li>
            <a href="dashboard.php" class="d-flex p-3 links text-decoration-none">
                <div class="iContainer">
                    <i class="fa-solid fa-chart-line text-secondary"></i>
                </div>
                <span class="tlink overflow-hidden">Dashboard</span>
            </a>
        </li>

        <li>
            <div class="d-flex links text-decoration-none" >
                <div class="btn-group dropend w-100">
                    <div class="w-100 p-3 d-flex data-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="iContainer">
                            <i class="fa-regular fa-square-plus text-secondary"></i>
                        </div>
                        <span class="tlink overflow-hidden w-100">Add</span>
                    </div>
                    <ul class="dropdown-menu shadow-lg p-0 border-0 bg-light">
                        <li><a class="dropdown-item bg-light text-secondary" href="documents.php">Documents</a></li>
                        <li><a class="dropdown-item bg-light text-secondary" href="dept_course.php">Department/Courses</a></li>
                        <li><a class="dropdown-item bg-light text-secondary" href="student.php">Student</a></li>
                    </ul>
                </div>
            </div>
        </li>
        <li>
            <a href="event_manager.php" class="d-flex p-3 links text-decoration-none">
                <div class="iContainer">
                    <i class="fa-regular fa-calendar-check text-secondary"></i>
                </div>
                <span class="tlink overflow-hidden">Calendar</span>
            </a>
        </li>

        <li>
            <a href="app_archive.php" class="d-flex p-3 links text-decoration-none">
                <div class="iContainer">
                    <i class="fa-solid fa-archive text-secondary"></i>
                </div>
                <span class="tlink overflow-hidden">Reports</span>
            </a>
        </li>
    </ul>
</div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="../assets/js/jquery.hmbrgr.js"></script>
<script src="../assets/js/sidebar.js"></script>

<script type="text/javascript">
    $(document).ready(function ($){
        var path = window.location.pathname.split("/").pop();
        if (path === ''){
            path = 'dashboard.php';
        }
        var target = $('ul li a[href="'+path+'"]');
        target.addClass('active');
    });
</script>
