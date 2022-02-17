<?php include 'inc/header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php if($verified == 'Not Verified'): ?>
                <div class="alert alert-danger alert-dismissible fade show text-center mt-2 m-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>Your E-Mail is not verified! We've sent you an E-Mail Verification link on your E-mail, check & Verify now!. If you don't verify your email You cannot update your Profile!</strong>
                </div>
            <?php endif; ?>
            <hr>
            <div class="bg-info rounded text-white p-2 text-center font-weight-bold my-2 lead">
                <strong>Welcome <?= $student['name']; ?></strong>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-3">
            <!-- Personal Details Card -->
            <div class="card border-primary">
                <h5 class="card-header bg-primary d-flex justify-content-between">
                    <span class="text-light lead align-self-center"><i class="fas fa-user-tag"></i>&nbsp;&nbsp;Personal Details</span>
                </h5>
                <div class="card-body">
                    <img src="<?= $profile_photo; ?>" class="img-fluid rounded-circle img-thumbnail" width="150px">
                    <hr>
                    <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>Name: </b><?= $student['name']; ?></p>

                    <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>ID No: </b><?= $student['id_num']; ?></p>

                    <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>Phone: </b><?= $student['phone']; ?></p>
                </div>
            </div>
            <!-- Personal Details Card End -->

            <!-- Upcoming Class Card -->
            <div class="card border-danger mt-2">
                <h5 class="card-header bg-danger d-flex justify-content-between">
                    <span class="text-light lead align-self-center"><i class="fas fa-hourglass"></i>&nbsp;&nbsp;Upcoming Class</span>
                </h5>
                <div class="card-body">
                    <div id="upcoming_class">
                        Please Wait...
                    </div>
                </div>
            </div>
            <!-- Upcoming Class Card end-->

            <!-- Upcoming Exam Card -->
            <div class="card border-dark mt-2">
                <h5 class="card-header bg-dark d-flex justify-content-between">
                    <span class="text-light lead align-self-center"><i class="fas fa-stream"></i>&nbsp;&nbsp;Upcoming Exam</span>
                </h5>
                <div class="card-body">
                    <div id="upcoming_exam">
                        Please Wait...
                    </div>
                </div>
            </div>
            <!-- Upcoming Exam Card end-->

        </div>
        <!-- Left Column End -->
        <!-- Center Column -->
        <div class="col-lg-6">
            <!-- Notice Card -->
            <div class="card border-info">
                <h5 class="card-header bg-info d-flex justify-content-between">
                    <span class="text-light lead align-self-center"><i class="fas fa-info-circle"></i>&nbsp;&nbsp;Latest Notice</span>
                </h5>
                <div class="card-body">
                    <div id="notice">
                        Please Wait...
                    </div>
                </div>
            </div>
            <!-- Notice Card End -->
            <!-- Study Material Card -->
            <div class="card border-success mt-2">
                <h5 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light lead align-self-center"><i class="fas fa-book-open"></i>&nbsp;&nbsp;Study Materials</span>
                </h5>
                <div class="card-body">
                    <div id="materials">
                        <input type="hidden" id="cid" value="<?= $student['class']; ?>">
                        Please Wait...
                    </div>
                </div>
            </div>
            <!-- Study Material Card End -->
        </div>
        <!-- Center Column End -->
        <!-- Right Side Column -->
        <div class="col-lg-3">
            
            <!--Latest Exam Result Card -->
            <div class="card border-primary">
                <h5 class="card-header bg-primary d-flex justify-content-between">
                    <span class="text-light lead align-self-center"><i class="fas fa-poll-h"></i>&nbsp;&nbsp;Latest Exam Result</span>
                </h5>
                <div class="card-body">
                    <div id="latest_result">Please Wait...</div>
                </div>
            </div>
            <!-- Personal Details Card End -->

            <!-- Upcoming Class Card -->
            <div class="card border-danger mt-2">
                <h5 class="card-header bg-danger d-flex justify-content-between">
                    <span class="text-light lead align-self-center"><i class="fas fa-file-invoice-dollar"></i>&nbsp;&nbsp;Payable Fees</span>
                </h5>
                <div class="card-body">
                    <div id="payable_fees">
                        <input type="hidden" id="st_id" value="<?= $student['id_num']; ?>">
                        Please Wait...
                    </div>
                </div>
            </div>
            <!-- Upcoming Class Card end-->
            <!-- Certificate card -->
            <div class="card border-warning mt-2">
                <h5 class="card-header bg-warning d-flex justify-content-between">
                    <span class="text-light lead align-self-center"><i class="fas fa-bookmark"></i>&nbsp;&nbsp;Certificate</span>
                </h5>
                <div class="card-body">
                    <div id="course_details">
                        Please Wait...
                    </div>
                </div>
            </div>
            <!-- Certificate Card-->

        </div>
        <!-- Right side Column End -->
    </div>
</div>

<!-- Notice View Modal -->
<div class="modal fade" id="showNotice">
    <div class="modal-dialog modal-dialog-centered mw-100 w-50">
        <div class="modal-content">
            <div class="modal-header border-info bg-info text-white">
                <h4 class="modal-title" id="getTitle"></h4>
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

<!-- Notice View Modal End -->
<!-- Materials View Modal -->
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
                            <h4 id="getMatrialsTitlebody"></h4>
                            <strong id="getMaterialsTime"></strong>
                            <hr>
                            <p id="getMaterialsBody"></p>
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
<!-- Material View Modal End -->
<!-- Pay Form -->
<?php require_once 'inc/fees_modal.php'; ?>
<!-- Pay Form -->

<?php include 'inc/footer.php'; ?>