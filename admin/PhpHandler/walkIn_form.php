<?php
session_start();
require '../../main_libraries.php';
include '../../db_conn/view.php';
$view = new view();
$documents=$view->view_all_documents();

include '../../toast.php';
isset($_POST['date']) && $_SESSION['sched'] = $_POST['date'];
?>
<style>
    .container{
        font-family: 'Poppins', sans-serif !important;
    }

    .docCardIMG:hover {
        height: 200px !important; /* set the desired increased height */
    }

    .docCardIMG {
        transition: all 0.3s ease;
        position: relative;
        height: 150px; /* set the desired height of the container */
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

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-12">
            <form action="admin_request.php" method="post">
                <input type="hidden" name="date" class="form-control my-2" value="<?= $_SESSION['sched'] ?>">
                <div class="card">
                    <div class="card-header fs-5">
                        <strong>Request Form</strong>
                    </div>
                    <div class="card-body row gx-5">
                        <div class="col-md-12 col-lg-4 border-end">
                            <h5 class="mb-5">Personal info</h5>
                            <div class="form-group row mb-3">
                                <div class="col">
                                    <label for="first-name-input">First Name</label>
                                    <input type="text" class="form-control" id="first-name-input" name="first-name" required autocomplete="given-name" placeholder="">
                                </div>
                                <div class="col">
                                    <label for="last-name-input">Last Name</label>
                                    <input type="text" class="form-control" id="last-name-input" name="last-name" required autocomplete="family-name" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col">
                                    <label for="middle-initial-input">Middle Initial</label>
                                    <input type="text" class="form-control" id="middle-initial-input" name="middle-initial" autocomplete="additional-name" placeholder="">
                                </div>
                                <div class="col d-grid">
                                    <label for="last-name-input">Gender</label>
                                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                        <input type="radio" class="btn-check" value="male" name="gender" id="male" autocomplete="off" checked>
                                        <label class="btn btn-outline-secondary" for="male">Male</label>

                                        <input type="radio" class="btn-check" value="female" name="gender" id="female" autocomplete="off">
                                        <label class="btn btn-outline-secondary" for="female">Female</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col">
                                    <label for="email-input">Email</label>
                                    <input type="email" class="form-control" id="email-input" name="email" required autocomplete="email" placeholder="">
                                </div>
                                <div class="col">
                                    <label for="phone-input">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone-input" name="phone" required autocomplete="tel-national" placeholder="">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="address-input">Address</label>
                                <input type="text" class="form-control" id="address-input" name="address" required autocomplete="address-line1" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-8">
                            <h5>Documents</h5>
                            <div class="overflow-auto" style="max-height: 70vh;">
                                <div class="row m-0 row-cols-1 row-cols-md-3 row-cols-sm-2 g-3">
                                    <?php while ($row = mysqli_fetch_assoc($documents)) : ?>
                                        <div class="col">
                                            <div onclick="toggleCheckbox(<?= $row['DocumentID'] ?>)" style="cursor: pointer" class="card h-100" id="card<?= $row['DocumentID'] ?>">
                                                <div class="position-relative border-bottom">
                                                    <?php if (!isset($row['PreviewImage']) || $row['PreviewImage'] === '') : ?>
                                                        <div class="docCardIMG">
                                                            <img src="/evsu_registrar/img/docx_default.png" class="card-img-top" id="cardImg" alt="<?= $row['DocumentName'] ?>">
                                                        </div>
                                                    <?php else : ?>
                                                        <div class="docCardIMG">
                                                            <img src="<?= $row['PreviewImage'] ?>" class="card-img-top" id="cardImg" alt="<?= $row['DocumentDescription'] ?>">
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="position-absolute p-3 top-0 d-flex justify-content-between w-100">
                                                        <div class="form-check">
                                                            <label>
                                                                <input type="checkbox" name="requestedDocuments[]" value="<?= $row['DocumentID'] ?>" class="form-check-input" autocomplete="off" <?php if (isset($_POST['requestedDocuments']) && in_array($row['DocumentID'], $_POST['requestedDocuments'])) { echo 'checked'; } ?>>
                                                            </label>
                                                        </div>
                                                        <button class="btn p-1 text-dark" type="button" data-bs-toggle="modal" data-bs-target="#documentModal<?= $row['DocumentID'] ?>">
                                                            <i class="fa-solid fa-expand fa-lg"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body h-100">
                                                    <div class="fs-6 fw-bold mb-2"><?= $row['DocumentName'] ?></div>
                                                    <?php
                                                    $description = $row['DocumentDescription'];
                                                    $lines = explode("\n", $description); // Split the text into an array of lines
                                                    $output = implode("\n", array_slice($lines, 0, 2)); // Join the first two lines with a newline character
                                                    if (strlen($output) > 55) { // Limit the output to 50 characters
                                                        $output = substr($output, 0, 55) . '...';
                                                    }
                                                    echo '<small class="text-muted">' . $output . '</small>'; // Output the result
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Document modal -->
                                        <div class="modal fade" id="documentModal<?= $row['DocumentID'] ?>" tabindex="-1" aria-labelledby="documentModalLabel<?= $row['DocumentID'] ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"><?= $row['DocumentName'] ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body p-0">
                                                        <?php if (!isset($row['PreviewImage']) || $row['PreviewImage'] === '') : ?>
                                                            <img src="/evsu_registrar/img/docx_default.png" class="img-fluid" alt="<?= $row['DocumentDescription'] ?>">
                                                        <?php else : ?>
                                                            <img src="<?= $row['PreviewImage'] ?>" class="img-fluid" alt="<?= $row['DocumentDescription'] ?>">
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="modal-footer justify-content-start">
                                                        <div><?= $row['DocumentDescription'] ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-white py-3">
                        <a href="select_sched.php" class="btn btn-light">
                            <i class="fa-solid fa-chevron-left"></i> Back to Portal
                        </a>
                        <button type="submit" class="btn btn-outline-primary px-5">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include '../includes/footer.php' ?>
<script>

    function toggleCheckbox(id) {
        const checkbox = $('#card'+id).find('.form-check-input');
        const target = event.target;
        if (!$(target).closest('.form-check-input').length) {
            checkbox.prop('checked', !checkbox.prop('checked'));
        }
    }

    $(document).ready(function() {
        $(function() {
            $('.education-btn').click(function() {
                const educationType = $(this).data('education-type');
                if (educationType === 'undergraduate') {
                    $('.graduate-section').removeClass('d-none').find('select').prop('disabled', false);
                    $('#studentType').val('undergraduate');
                } else {
                    $('.graduate-section').addClass('d-none').find('select').prop('disabled', true);
                    $('#studentType').val('graduate');
                }
                $('.education-btn').removeClass('active');
                $(this).addClass('active');
            });

            $('#idPictureInput').on('change', function() {
                const input = this;
                const url = $(this).val();
                const ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0] && (ext === "gif" || ext === "png" || ext === "jpeg" || ext === "jpg")) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#idPicturePreview').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $('#idPicturePreview').attr('src', '..//evsu_registrar/img/docx_default.png');
                }
            });

            $('#idPicture').click(function() {
                $('#idPictureInput').click();
            });
        });
    });
</script>
