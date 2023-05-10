<form action="PhpHandler/approve.php" method="post" class="m-0">
    <input type="hidden" name="id" value="<?= $request['RequestID'] ?>">
    <input type="hidden" name="sched" value="<?= $request['Schedule'] ?>">
    <input type="hidden" name="up_status" value="<?= $request['RequestStatus'] === null ? 0 : (!$request['RequestStatus'] && '1') ?>">
    <button type="submit" name="<?= $request['RequestStatus'] === '1' ? 'released' : 'prog' ?>" class="btn btn-outline-<?= $btn_class ?> btn-sm me-1" style="font-size: .8rem; width: 95px">
        <i class="fa-regular fa-calendar-check"></i> <?= $btn_txt ?>
    </button>
</form>