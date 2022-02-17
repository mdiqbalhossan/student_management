<?php include 'inc/header.php'; ?>

<div class="container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title align-self-center">All Exam</h3>
                        <a href="#" class="btn btn-info float-right" data-toggle="modal" data-target="#addExamModal">Add Exam</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Class</th>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="exam_body">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Class</th>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
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

<!-- Add Exam Modal End -->
<div class="modal fade" id="addExamModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-light">Add New Exam</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="addexam_form" class="px-3">
                    <div class="form-group">
                        <label for="class">Class <span class="text-danger">*</span></label>
                        <select name="class" id="class" class="form-control">
                            <?php foreach ($class as  $value) : ?>
                                <option value="<?= $value['id'] ?>"><?= $value['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control form-control-lg" placeholder="Enter Title" required>
                    </div>
                    <div class="form-group">
                        <label for="descrption">Description</label>
                        <textarea name="description" class="form-control form-control-lg" placeholder="Write your Description here..." rows="6"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="date">Date <span class="text-danger">*</span></label>
                        <input type="date" name="date" class="form-control form-control-lg" placeholder="Enter date" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="start_time">Start Time <span class="text-danger">*</span></label>
                            <input type="time" name="start_time" class="form-control form-control-lg" placeholder="Enter start time" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="end_time">End Time <span class="text-danger">*</span></label>
                            <input type="time" name="end_time" class="form-control form-control-lg" placeholder="Enter End time" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="addexam" id="addexam_btn" value="Add exam" class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Exam Modal End -->
<!-- Show Exam Details Modal -->
<div class="modal fade" id="showExam">
    <div class="modal-dialog modal-dialog-centered mw-100 w-50">
        <div class="modal-content">
            <div class="modal-header border-info bg-info text-white">
                <h4 class="modal-title" id="getExamTitle"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card-deck">
                    <div class="card border-primary">
                        <div class="card-body">
                            <h4 id="getExamBodyTitle"></h4>
                            <hr>
                            <p id="getExamBody"></p>
                            <strong id="getExamDate"></strong><br>
                            <strong id="getExamStartTime"></strong><br>
                            <strong id="getExamEndTime"></strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Show Exam Details Modal end -->

<!-- Edit Exam Modal -->
<div class="modal fade" id="editexamModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-light">Edit Exam</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="editexam_form" class="px-3">
                    <input type="hidden" id="exam_id" name="id" value="">
                    <div class="form-group">
                        <label for="class">Class <span class="text-danger">*</span></label>
                        <select name="class" id="class_update" class="form-control">
                            <?php foreach ($class as  $value) : ?>
                                <option value="<?= $value['id'] ?>"><?= $value['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control form-control-lg" placeholder="Enter Title" required>
                    </div>
                    <div class="form-group">
                        <label for="descrption">Description</label>
                        <textarea name="description" id="description" class="form-control form-control-lg" placeholder="Write your Description here..." rows="6"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="date">Date <span class="text-danger">*</span></label>
                        <input type="date" id="date" name="date" class="form-control form-control-lg" placeholder="Enter date" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="start_time">Start Time <span class="text-danger">*</span></label>
                            <input type="time" id="start_time" name="start_time" class="form-control form-control-lg" placeholder="Enter start time" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="end_time">End Time <span class="text-danger">*</span></label>
                            <input type="time" id="end_time" name="end_time" class="form-control form-control-lg" placeholder="Enter End time" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="updateexam" id="updateexam_btn" value="Update exam" class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Exam Modal End -->


<?php include 'inc/footer.php'; ?>