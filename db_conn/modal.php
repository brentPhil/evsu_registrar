<div class="modal fade" id="modal<?php  echo $request['RequestID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fs-5" id="exampleModalLabel">Request Details</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="px-2" style="font-size: 1rem; text-transform: capitalize">
                    <?php if ($request['RequestType'] == 'authorized'){?>
                        <div class="row py-1 border-bottom">
                            <div class="col-4 py-2">Authorized Personnel:</div>
                            <div class="col-8 py-2 bg-light">
                                <?php  echo 'name: '.$request['AuthorizedPersonnelName']?>
                            </div>
                        </div>
                    <?php } else {?>
                        <div class="row py-1 border-bottom">
                            <div class="col-4 py-2">Type:</div>
                            <div class="col-8 py-2 bg-light"><?php  echo $request['RequestType']; ?></div>
                        </div>
                    <?php } ?>
                    <div class="row py-1 border-bottom">
                        <div class="col-4 py-2">Full name:</div>
                        <div class="col-8 py-2 bg-light"><?php  echo $request['StudentFullName']; ?></div>
                    </div>
                    <div class="row py-1 border-bottom">
                        <div class="col-4 py-2">Email:</div>
                        <div class="col-8 py-2 bg-light text-lowercase"><?php  echo $request['StudentEmail']; ?></div>
                    </div>
                    <div class="row py-1 border-bottom">
                        <div class="col-4 py-2">Address:</div>
                        <div class="col-8 py-2 bg-light"><?php  echo $request['StudentAddress']; ?></div>
                    </div>
                    <div class="row py-1 border-bottom">
                        <div class="col-4 py-2">Gender:</div>
                        <div class="col-8 py-2 bg-light"><?php  echo $request['StudentGender']; ?></div>
                    </div>
                    <div class="row py-1 border-bottom">
                        <div class="col-4 py-2">Phone:</div>
                        <div class="col-8 py-2 bg-light"><?php  echo $request['StudentPhone']; ?></div>
                    </div>
                    <?php if($request['RequestType'] != 'Walk in'): ?>
                    <div class="row py-1 border-bottom">
                        <div class="col-4 py-2">Department:</div>
                        <div class="col-8 py-2 bg-light"><?php  echo $request['Department']; ?></div>
                    </div>
                    <div class="row py-1 border-bottom">
                        <div class="col-4 py-2">Course:</div>
                        <div class="col-8 py-2 bg-light"><?php  echo $request['Course']; ?></div>
                    </div>
                    <div class="row py-1 border-bottom">
                        <div class="col-4 py-2">Education:</div>
                        <div class="col-8 py-2 bg-light"><?php  echo $request['Education']; ?></div>
                    </div>
                    <?php endif;?>
                    <div class="row py-1 border-bottom">
                        <div class="col-4 py-2">Schedule:</div>
                        <div class="col-8 py-2 bg-light"><?php  echo date('F d, Y | h: i a', strtotime($request['Schedule'])); ?></div>
                    </div>
                    <div>
                        <div class="py-2 my-3">Requested documents:</div>
                        <div class="row row-cols-3 gx-3">
                            <?php foreach($documents as $doc): ?>
                                <div class="col mb-3">
                                    <div class="bg-white doc_card border rounded shadow-sm" style="max-width: 180px">
                                        <div class="docCardIMG">
                                            <img src="../img/ID_cardDefault.jpg" class="card-img-top" alt="<?= $doc['DocumentName'] ?>">
                                        </div>
                                        <div class="px-2 pt-2">
                                            <div style="font-size: 12px; font-weight: bold" class="text-truncate"><?= $doc['DocumentName'] ?></div>
                                            <p style="font-size: 8px"><?= $doc['DocumentDescription'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete<?php  echo $request['RequestID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this request?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form class="m-0" action="PhpHandler/approve.php" method="POST">
                    <input type="hidden" name="request_id" value="<?php echo $request['RequestID']; ?>">
                    <button type="submit" name="deleteRequest" class="btn btn-danger">Archive</button>
                </form>
            </div>
        </div>
    </div>
</div>