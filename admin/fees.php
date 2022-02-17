<?php include 'inc/header.php'; ?>

<div class="container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title align-self-center">All Fees</h3>
                        <a href="#" class="btn btn-info float-right" data-toggle="modal" data-target="#addFeesModal">Add New Fees</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Student Name</th>
                                    <th>Title</th>
                                    <th>Total Amount</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="fees_body">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Student Name</th>
                                    <th>Title</th>
                                    <th>Total Amount</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
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

<!-- Add Fees Modal -->
<div class="modal fade" id="addFeesModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-light">Add New Fees</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="addfees_form" class="px-3">
                    <div class="form-group">
                        <label>Student Name</label>
                        <select class="select2" name="st_id[]" multiple="multiple" data-placeholder="Select a Student" style="width: 100%;">
                            <?php foreach($student as $value): ?>
                                <option value="<?= $value['st_idnum']; ?>"><?= $value['st_name']; ?></option>
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
                        <label for="total_amount">Total Amount <span class="text-danger">*</span></label>
                        <input type="number" name="total_amount" class="form-control form-control-lg" placeholder="Enter total amount" required>
                    </div>
                    <div class="form-group">
                        <label for="date"> Issued Date <span class="text-danger">*</span></label>
                        <input type="date" name="issued_date" class="form-control form-control-lg" placeholder="Enter Issued date" required>
                    </div>
                    <div class="form-group">
                        <label for="date"> Due Date <span class="text-danger">*</span></label>
                        <input type="date" name="due_date" class="form-control form-control-lg" placeholder="Enter Due date" required>
                    </div>
                    <div class="form-group">
                        <label for="fine"> Fine</label>
                        <input type="number" name="fine" class="form-control form-control-lg" placeholder="Enter fine">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="addfees" id="addfees_btn" value="Add Fees" class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Exam Modal End -->

<!-- Show Fees Details Modal -->
<div class="modal fade" id="showFees">
    <div class="modal-dialog modal-dialog-centered mw-100 w-50">
        <div class="modal-content">
            <div class="modal-header border-info bg-info text-white">
                <h4 class="modal-title" id="getStudentID"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card-deck">
                    <div class="card border-primary">
                        <div class="card-body">
                            <h4 id="getStudentName"></h4>
                            <hr>
                            <h4 id="getFeesTitle"></h4>
                            <p id="getFeesBody"></p>
                            <strong id="getTotalAmount"></strong><br>
                            <strong id="getIssueDate"></strong><br>
                            <strong id="getDueDate"></strong><br>
                            <strong id="getFine"></strong>
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
<!-- Show Fees Details Modal end -->

<!-- Show Fees Paid Details Modal -->
<div class="modal fade" id="showPaidFees">
    <div class="modal-dialog modal-dialog-centered mw-100 w-50">
        <div class="modal-content">
            <div class="modal-header border-info bg-info text-white">
                <h4 class="modal-title" id="getPaidStudentID"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card-deck">
                    <div class="card border-primary">
                        <div class="card-body">
                            <h4 id="getPaidStudentName"></h4>
                            <hr>
                            <h4 id="getPaidFeesTitle"></h4>
                            <p id="getPaidNote"></p>
                            <strong id="getPaidAmount"></strong><br>
                            <strong id="getPaymentDate"></strong><br>
                            <strong id="getPaymentMethod"></strong><br>
                            <strong id="getTrId"></strong>
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
<!-- Show Fees Paid Details Modal end -->

<!-- Edit Fees Modal -->
<div class="modal fade" id="editFeesModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-light">Edit Fees</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="editfees_form" class="px-3">
                    <input type="hidden" name="fees_id" id="fees_id" value="">
                    <div class="form-group">
                        <label>Student Name</label>
                        <select class="select2" name="st_id" id="student_name_update" data-placeholder="Select a Student" style="width: 100%;">
                            <?php foreach($student as $value): ?>
                                <option value="<?= $value['st_idnum']; ?>"><?= $value['st_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    </ul>
                    <div class="form-group">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" id="title" name="title" class="form-control form-control-lg" placeholder="Enter Title" required>
                    </div>
                    <div class="form-group">
                        <label for="descrption">Description</label>
                        <textarea name="description" id="description" class="form-control form-control-lg" placeholder="Write your Description here..." rows="6"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="total_amount">Total Amount <span class="text-danger">*</span></label>
                        <input type="number" id="total_amount" name="total_amount" class="form-control form-control-lg" placeholder="Enter total amount" required>
                    </div>
                    <div class="form-group">
                        <label for="date"> Issued Date <span class="text-danger">*</span></label>
                        <input type="date" id="issued_date" name="issued_date" class="form-control form-control-lg" placeholder="Enter Issued date" required>
                    </div>
                    <div class="form-group">
                        <label for="date"> Due Date <span class="text-danger">*</span></label>
                        <input type="date" id="due_date" name="due_date" class="form-control form-control-lg" placeholder="Enter Due date" required>
                    </div>
                    <div class="form-group">
                        <label for="fine"> Fine</label>
                        <input type="number" id="fine" name="fine" class="form-control form-control-lg" placeholder="Enter fine">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="editfees" id="updatefees_btn" value="Update Fees" class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Fees Modal End -->


<?php include 'inc/footer.php'; ?>