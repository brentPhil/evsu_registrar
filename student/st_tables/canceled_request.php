<div class="table-responsive" style="min-height: 70vh">
    <table id="incomplete" class="table border-secondary-subtle h-100" style="width:100%">
        <thead class="bg-light text-secondary">
        <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Schedule</th>
            <th>Status</th>
            <th>Requested documents</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody class="text-secondary">
        <?php
        $counter = 1;
        foreach ($requests as $request) { if($request['RequestStatus'] != 'completed'){
            $documents = $archive->docArchive_mappings($request['RequestID']);
            $btn_class = $request['RequestStatus'] === 'completed' ? 'claimed' : 'canceled';
            ?>
            <tr>
                <td class="align-middle"><?php echo $counter; ?></td>
                <td class="text-truncate align-middle" style="font-weight: bolder; max-width: 150px;"><?= $request['StudentFullName'] ?></td>
                <td class="text-truncate align-middle" style="max-width: 100px;"><?= (new DateTime($request['Schedule']))->format('F d, Y | h:i a') ?></td>
                <td class="align-middle">
                    <div style="padding: .5em 0 .5em 0; min-width: 110px"
                         class="fw-bold text-center text-capitalize px-3
                         <?= $btn_class ?>
                         rounded-5">
                        <?= $request['RequestStatus'] ?>
                    </div>
                </td>
                <td class="align-middle">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-file"></i> View Documents
                        </button>
                        <div class="dropdown-menu dropdown-menu-end py-3" style="width: 400px">
                            <div class="overflow-y-auto" style="max-height: 300px">
                                <div class="row row-cols-2 w-100 gx-3 ps-3">
                                    <?php foreach($documents as $doc): ?>
                                        <div class="col mb-3">
                                            <div class="bg-white doc_card border rounded shadow-sm" style="max-width: 180px">
                                                <div class="docCardIMG">
                                                    <img src="../img/ID_cardDefault.jpg" class="card-img-top" alt="<?= $doc['DocumentName'] ?>">
                                                </div>
                                                <div class="px-2 pt-2">
                                                    <div style="font-size: 12px; font-weight: bold" class="mb-1"><?= $doc['DocumentName'] ?></div>
                                                    <p style="font-size: 8px"><?= $doc['DocumentDescription'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="text-end align-middle" style="width: 20px">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-light btn-sm me-1" style="font-size: .8rem" data-bs-toggle="modal" data-bs-target="#modal<?= $request['RequestID'] ?>">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn btn-outline-danger" style="font-size: .8rem" data-bs-toggle="modal" data-bs-target="#delete<?php echo $request['RequestID']; ?>">
                            Delete
                        </button>
                    </div>
                </td>
            </tr>
            <?php
            $counter++;
        }} ?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready( function () {
        const incomplete = $('#incomplete').DataTable({
            responsive: true,
            columnDefs: [
                { responsivePriority: 2, targets: 0 },
                { responsivePriority: 3, targets: -3 },
                { responsivePriority: 1, targets: -1 }
            ],
            dom: 'topi',
            paging: false,
            info: false
        });

        $('#inlineFormInputGroupUsername').on('keyup', function() {
            incomplete.search(this.value).draw();
        });
    });
</script>