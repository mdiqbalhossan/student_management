<?php include 'inc/header.php'; ?>

<div class="container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title align-self-center">All Materials</h3>
                        <a href="#" id="add_materials" class="btn btn-info float-right" data-toggle="modal" data-target="#addMaterialsModal">Add Materials</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="10">ID No</th>
                                    <th width="30">Title</th>
                                    <th width="30">Class</th>
                                    <th width="30">Description</th>
                                    <th width="10">File</th>
                                    <th width="10">Date</th>
                                    <th width="10">Action</th>
                                </tr>
                            </thead>
                            <tbody id="materials_body">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th width="10">ID No</th>
                                    <th width="30">Title</th>
                                    <th width="30">Class</th>
                                    <th width="30">Description</th>
                                    <th width="10">File</th>
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

<!-- Add Materials Modal -->

<div class="modal fade" id="addMaterialsModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-light">Add New Materials</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="addmaterials_form" enctype="multipart/form-data" class="px-3">
                    <div class="form-group">
                        <label for="class">Class <span class="text-danger">*</span></label>
                        <select name="class" id="class" class="form-control">
                            <?php foreach ($class as  $value): ?>
                                <option value="<?= $value['id'] ?>"><?= $value['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control form-control-lg" placeholder="Enter Title" required>
                    </div>
                    <div class="form-group">
                        <label for="details">Details</label>
                        <textarea name="materials" class="form-control form-control-lg" placeholder="Write your details here..." rows="6"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="customFile">If You have pdf/image upload here</label>

                        <div class="custom-file">
                            <input type="file" name="materials" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="addMaterials" id="addmaterials_btn" value="Add Materials" class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Notice modal End -->

<!-- Show Notice Details Modal -->
<div class="modal fade" id="showMaterials">
    <div class="modal-dialog modal-dialog-centered mw-100 w-50">
        <div class="modal-content">
            <div class="modal-header border-info bg-info text-white">
                <h4 class="modal-title" id="getMaterialsTitle"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card-deck">
                    <div class="card border-primary">
                        <div class="card-body">
                            <h4 id="getTitlebody"></h4>
                            <strong id="getTime"></strong>
                            <hr>
                            <p id="getBody"></p>
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

<!-- Show Notice details Modal End -->

<!-- Edit Modal -->
<div class="modal fade" id="editMaterialsModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light">Edit Materials</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="editmaterials_form" enctype="multipart/form-data" class="px-3">
                    <input type="hidden" name="old_file" id="old_file">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="class">Class <span class="text-danger">*</span></label>
                        <select name="class" id="class" class="form-control">
                            <?php foreach ($class as  $value): ?>
                                <option value="<?= $value['id'] ?>"><?= $value['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control form-control-lg" placeholder="Enter Title" required>
                    </div>
                    <div class="form-group">
                        <label for="details">Details</label>
                        <textarea name="materials" id="details" class="form-control form-control-lg" placeholder="Write your details here..." rows="6"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="customFile">If You have pdf/image upload here</label>

                        <div class="custom-file">
                            <input type="file" name="materials_file" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="updateMaterials" id="updatematerials_btn" value="Update Materials" class="btn btn-info btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Modal -->

<?php include 'inc/footer.php'; ?>