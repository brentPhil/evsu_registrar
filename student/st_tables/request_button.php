
<div class="btn-group dropstart">
    <a type="button" class="btn data-toggle rounded-3 border-0" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-solid fa-ellipsis"></i>
    </a>
    <div class="dropdown-menu p-2">
        <form class="mb-2" action="RequestHandler/archiveRequest.php" method="POST">
            <input type="hidden" name="request_id" value="<?php echo $request['RequestID']; ?>">
            <button type="submit" name="archiveRequest" class="btn btn-danger w-100">Cancel</button>
        </form>
        <form action="select_sched.php" class="mb-2" method="post">
            <input type="hidden" name="rq_id" value="<?php echo $request['RequestID'];?>">
            <button type="submit"<?php echo $request['RequestStatus'] == 'pending...' ? '' : 'disabled';?> name="edit" class="btn btn-danger w-100">Edit</button>
        </form>
    </div>
</div>
