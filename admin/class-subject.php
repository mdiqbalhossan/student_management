<?php include 'inc/header.php'; ?>

<div class="container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title align-self-center">All Class</h3>
                        <a href="#" id="add_class" class="btn btn-info float-right" data-toggle="modal" data-target="#addClassModal">Add Class</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="10">ID No</th>
                                    <th width="30">Name</th>
                                    <th width="10">Date</th>
                                    <th width="10">Action</th>
                                </tr>
                            </thead>
                            <tbody id="class_body">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th width="10">ID No</th>
                                    <th width="30">Name</th>
                                    <th width="10">Date</th>
                                    <th width="10">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title align-self-center">All Subject</h3>
                        <a href="#" id="add_subject" class="btn btn-info float-right" data-toggle="modal" data-target="#addSubjectModal">Add Subject</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="10">ID</th>
                                    <th width="30">Name</th>
                                    <th width="30">Class</th>
                                    <th width="10">Date</th>
                                    <th width="10">Action</th>
                                </tr>
                            </thead>
                            <tbody id="subject_body">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th width="10">ID</th>
                                    <th width="30">Name</th>
                                    <th width="30">Class</th>
                                    <th width="10">Date</th>
                                    <th width="10">Action</th>
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

<!-- Add Class Modal -->

<div class="modal fade" id="addClassModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-light">Add New Class</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="addclass_form" class="px-3">
                    <div class="form-group">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control form-control-lg" placeholder="Enter name" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="addClass" id="addclass_btn" value="Add Class" class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Class modal End -->

<!-- Edit Class -->
<div class="modal fade" id="editclassModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-light">Update Class</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="editclass_form" class="px-3">
                    <div class="form-group">
                        <input type="hidden" name="id" id="id">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Enter name" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="editClass" id="editclass_btn" value="Update Class" class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Class -->

<!-- Add Subject Modal -->

<div class="modal fade" id="addSubjectModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-light">Add New Subject</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="addsubject_form" class="px-3">
                    <div class="form-group">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control form-control-lg" placeholder="Enter name" required>
                    </div>
                    <div class="form-group">
                        <label for="class">Class <span class="text-danger">*</span></label>
                        <select name="class" id="class" class="form-control">
                            <?php foreach ($class as  $value): ?>
                                <option value="<?= $value['id'] ?>"><?= $value['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="addSubject" id="addsubject_btn" value="Add Subject" class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Subject modal End -->

<!-- Edit Subject -->
<div class="modal fade" id="editSubjectModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-light">Update Subject</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="editsubject_form" class="px-3">
                    <div class="form-group">
                        <input type="hidden" name="id" id="subject_id">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" id="subject" name="name" class="form-control form-control-lg" placeholder="Enter name" required>
                    </div>
                    <div class="form-group">
                        <label for="class">Class <span class="text-danger">*</span></label>
                        <select name="class" id="class" class="form-control">
                            <?php foreach ($class as  $value): ?>
                                <option value="<?= $value['id'] ?>"><?= $value['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="editSubject" id="editsubject_btn" value="Update Subject" class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Subject -->

<?php include 'inc/footer.php'; ?>