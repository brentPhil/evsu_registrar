<div class="modal fade" id="add_dept" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered border-3">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">New department</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="PhpHandler/mysql_dept_course.php" method="POST" class="pb-0">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Department</label>
                        <input name="dept" type="text" required class="form-control" id="exampleFormControlInput1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                        <textarea name="Desc" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" name="new_dept" type="submit">save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="add_course" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered border-3">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">New Course</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                <form action="PhpHandler/mysql_dept_course.php" method="POST" class="pb-0">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="floatingSelect" class="form-label"">Department</label>
                            <select class="form-select" id="floatingSelect" name="dept">
                                <?php foreach ($departments as $dept){ if ($dept['dept'] != ''){?>
                                    <option value="<?php echo $dept['id'] ?>"><?php echo $dept['dept'] ?></option>
                                <?php }} ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">course</label>
                            <input name="name" type="text" required class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                            <textarea name="Desc" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" name="new_course" type="submit">save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


