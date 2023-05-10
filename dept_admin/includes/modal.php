<?php
$rq_id = $request['rq_cert'];
$rq_cert = $db->view_rq_cert($rq_id);
?>

<div class="modal fade" id="<?php  echo 'modal'.$i; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fs-5" id="exampleModalLabel">Appointment Details</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="px-2" style="font-size: 1rem; text-transform: capitalize">
                    <div class="row py-1 border-bottom">
                        <div class="col-4 py-2">Type:</div>
                        <div class="col-8 py-2 bg-light"><?php  echo $request['app_type']; ?></div>
                    </div>
                    <div class="row py-1 border-bottom">
                        <div class="col-4 py-2">Full name:</div>
                        <div class="col-8 py-2 bg-light"><?php  echo $request['full_name']; ?></div>
                    </div>
                    <div class="row py-1 border-bottom">
                        <div class="col-4 py-2">Email:</div>
                        <div class="col-8 py-2 bg-light text-lowercase"><?php  echo $request['email']; ?></div>
                    </div>
                    <div class="row py-1 border-bottom">
                        <div class="col-4 py-2">Address:</div>
                        <div class="col-8 py-2 bg-light"><?php  echo $request['address']; ?></div>
                    </div>
                    <div class="row py-1 border-bottom">
                        <div class="col-4 py-2">Gender:</div>
                        <div class="col-8 py-2 bg-light"><?php  echo $request['gender']; ?></div>
                    </div>
                    <div class="row py-1 border-bottom">
                        <div class="col-4 py-2">Phone:</div>
                        <div class="col-8 py-2 bg-light"><?php  echo $request['phone']; ?></div>
                    </div>
                    <div class="row py-1 border-bottom">
                        <div class="col-4 py-2">Department</div>
                        <div class="col-8 py-2 bg-light"><?php  echo $request['dept']; ?></div>
                    </div>
                    <div class="row py-1 border-bottom">
                        <div class="col-4 py-2">Course</div>
                        <div class="col-8 py-2 bg-light"><?php  echo $request['name']; ?></div>
                    </div>
                    <div class="row py-1 border-bottom">
                        <div class="col-4 py-2">Education:</div>
                        <div class="col-8 py-2 bg-light"><?php  echo $request['edu_status']; ?></div>
                    </div>
                    <div class="row py-1 border-bottom">
                        <div class="col-4">Schedule:</div>
                        <div class="col-8 py-2 bg-light"><?php  echo date('F d, Y | h: i a', strtotime($request['rq_schedule'])); ?></div>
                    </div>
                    <div class="row py-1 ">
                        <div class="col-4 py-2">Requested documents:</div>
                        <div class="col-8 py-2 bg-light"><ul><?php foreach($rq_cert as $cert){?><?php  echo '<li>'.$cert['name'].'</li>'; } ?></ul></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>