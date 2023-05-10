<style>
    .btn-costume{
        transition: ease-in 200ms;
    }
    .btn-costume:hover{
        background: rgba(255, 255, 255, 0.17);
    }
    .dropdown-item.costume{
        background: #eeeeee;
        font-size: .8rem;
        font-weight: 600;
    }
    .dropdown-item.costume:hover{
        background: #e3e3e3;
    }
</style>
<div class="d-flex justify-content-end align-content-center bg-white shadow-sm" style="padding: .8rem;">
    <div class="btn-group me-4">
        <div class="btn btn-costume py-2 px-3 border-0 dropdown-toggle p-1 fw-bold text-capitalize" style="cursor: pointer; font-size: .8rem" data-bs-toggle="dropdown" aria-expanded="false">
            <?= $_SESSION['ad_name']?>
        </div>
        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2">
            <li><a class="dropdown-item costume py-2 mb-2 rounded-2" href=""><i class="fa-solid fa-gear me-3"></i>Settings</a></li>
            <li><a class="dropdown-item costume py-2 rounded-2" href="PhpHandler/ad_logout.php"><i class="fa-solid fa-sign-out me-3"></i>Logout</a></li>
        </ul>
    </div>
</div>


