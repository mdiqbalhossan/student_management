<?php include 'inc/header.php'; ?>

<div class="container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title align-self-center">All Result</h3>
                        <a href="#" class="btn btn-info float-right" data-toggle="modal" data-target="#addResultModal">Add Result</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Student Name</th>
                                    <th>Exam Name</th>
                                    <th>Obtained Marks</th>
                                    <th>Note</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="result_body">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Student Name</th>
                                    <th>Exam Name</th>
                                    <th>Obtained Marks</th>
                                    <th>Note</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>


    </div>
</div>

<!-- Add Result Modal End -->
<div class="modal fade" id="addResultModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-light">Add New Result</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="addresult_form" class="px-3">
                    <div class="form-group">
                        <label>Student Name</label>
                        <select class="select2" name="st_id" data-placeholder="Select a Student" style="width: 100%;">
                            <?php foreach ($student as $value) : ?>
                                <option value="<?= $value['st_idnum']; ?>"><?= $value['st_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Exam Title <span class="text-danger">*</span></label>
                        <select name="exam" id="exam" class="form-control">
                            <?php foreach ($exam as $value) : ?>
                                <option value="<?= $value['id'] ?>"><?= $value['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="descrption">Note</label>
                        <textarea name="note" class="form-control form-control-lg" placeholder="Write your note here..." rows="6"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="marks">Obtained Marks <span class="text-danger">*</span></label>
                        <input type="number" name="marks" class="form-control form-control-lg" placeholder="Enter marks" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="addresult" id="addresult_btn" value="Add result" class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Result Modal End -->

<!-- Edit Result Modal -->
<div class="modal fade" id="editResultModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-light">Edit Result</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="editresult_form" class="px-3">
                    <input type="hidden" id="result_id" name="result_id">
                    <div class="form-group">
                        <label>Student Name</label>
                        <select class="select2" id="student_id" name="st_id" data-placeholder="Select a Student" style="width: 100%;">
                            <?php foreach ($student as $value) : ?>
                                <option value="<?= $value['st_idnum']; ?>"><?= $value['st_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Exam Title <span class="text-danger">*</span></label>
                        <select name="exam" id="exam" class="form-control">
                            <?php foreach ($exam as $value) : ?>
                                <option value="<?= $value['id'] ?>"><?= $value['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="descrption">Note</label>
                        <textarea name="note" id="note" class="form-control form-control-lg" placeholder="Write your note here..." rows="6"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="grade">Obtained Grade <span class="text-danger">*</span></label>
                        <input type="text" id="obtained_grade" name="grade" class="form-control form-control-lg" placeholder="Enter grade" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="editresult" id="editresult_btn" value="Edit result" class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Result Modal End -->


<?php include 'inc/footer.php'; ?>