<div class="d-flex justify-content-end align-content-center bg-white" style="padding: .8rem">
    <div class="btn-group me-4">
        <div class="btn btn-costume py-2 px-3 border-0 dropdown-toggle p-1 fw-bold text-capitalize text-secondary" style="cursor: pointer; font-size: .8rem" data-bs-toggle="dropdown" aria-expanded="false">
            <?=$_SESSION['name']?>
        </div>
        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2">
            <li><a class="dropdown-item costume py-2 mb-2 rounded-2" href=""><i class="fa-solid fa-gear me-3"></i>Settings</a></li>
            <li><a class="dropdown-item costume py-2 rounded-2" href="PhpHandler/st_logout.php"><i class="fa-solid fa-sign-out me-3"></i>Logout</a></li>
        </ul>
    </div>
</div>
