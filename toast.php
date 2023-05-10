<?php
$message = $_SESSION['error'] ?? ($_SESSION['success'] ?? '');
$iconState = isset($_SESSION['error']) ? 'fa-triangle-exclamation' : 'fa-circle-check';
$color = isset($_SESSION['error']) ? 'danger' : 'success';


include_once 'main_libraries.php'?>

<div aria-live="polite" aria-atomic="true" class="bg-body-secondary position-relative bd-example-toasts rounded-3">
    <div class="toast-container p-3 top-0 start-50 translate-middle-x">
        <div id="liveToast" class="toast bg-white overflow-hidden border-0 align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body d-flex align-items-center text-<?= $color ?>">
                    <span class="bg-<?= $color ?>-subtle p-2 rounded me-2"><i class="fa-solid <?= $iconState ?> fa-lg"></i></span><div><?= $message ?></div>
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="progress" role="progressbar" aria-label="Example 3px high" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 2px">
                <div class="progress-bar bg-<?= $color ?>" style="width: 100%;"></div>
            </div>
        </div>
    </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<?php
if (isset($_SESSION['error']) || isset($_SESSION['success'])) {
    echo '
        <script>
            const toastLiveExample = $("#liveToast");
            const toastBootstrap = new bootstrap.Toast(toastLiveExample[0]);
            const progressBar = toastLiveExample.find(".progress-bar");
            progressBar.width("100%");
            toastBootstrap.show();
            let progress = 100;
            const interval = setInterval(() => {
                progress -= 1;
                progressBar.width(`${progress}%`);

                if (progress === 0) {
                    clearInterval(interval);
                }
            }, 50);
        </script>';
    unset($_SESSION['error'], $_SESSION['success']);
}
?>
