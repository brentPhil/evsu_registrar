<div class="modal fade" id="approve<?php  echo $request['rq_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-6" id="exampleModalLabel">Approve</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="PhpHandler/approve.php" method="post">
                <label>
                    <input hidden name="e_uid" value="<?php  echo $request['op_id']; ?>">
                    <input hidden name="app_type" value="<?php  echo $request['app_type']; ?>">
                    <input hidden name="date" value="<?php  echo $request['rq_schedule']; ?>">
                </label>
                <div class="modal-body">
                    Would you like to continue?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="approve" class="btn btn-primary">Continue</button>
                </div>
            </form>
        </div>
    </div>
</div>