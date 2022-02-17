<?php include 'inc/header.php'; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <?php if ($verified == 'Not Verified') : ?>
                <div class="alert alert-danger alert-dismissible fade show text-center mt-2 m-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>Your E-Mail is not verified! We've sent you an E-Mail Verification link on your E-mail, check & Verify now!. If you don't verify your email You cannot update your Profile!</strong>
                </div>
            <?php else: ?>
                <div class="alert alert-info alert-dismissible fade show text-center mt-2 m-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong class="text-danger">If you don't update Your Profile. Please Click Update Button and Update Your Profile!</strong> <a href="update_profile.php" id="profile_update_btn" class="btn btn-success btn-sm rounded float-right">Update Profile</a>
                </div>
            <?php endif; ?>
            <hr>
            <div class="card rounded-0 mt-3 border-primary">
                <div class="card-header border-primary">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a href="#personal_details" class="nav-link active font-weight-bold" data-toggle="tab">Personal Details</a>
                        </li>
                        <li class="nav-item">
                            <a href="#admission_details" class="nav-link font-weight-bold" data-toggle="tab">Admission Details</a>
                        </li>
                        <li class="nav-item">
                            <a href="#parent_details" class="nav-link font-weight-bold" data-toggle="tab">Parent Details</a>
                        </li>
                        <li class="nav-item">
                            <a href="#change_password" class="nav-link font-weight-bold" data-toggle="tab">Change Password</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <!-- Personal Details tab start -->
                        <div class="tab-pane container active" id="personal_details">
                            <div class="card-deck">
                                <div class="card border-primary">
                                    <div class="card-header bg-primary text-light text-center lead">
                                        ID NO: <?= $student['id_num']; ?>
                                    </div>
                                    <div class="card-body">
                                        <div id="verify_email_alert"></div>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>Name: </b><?= $student['name']; ?></p>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>E-mail: </b><?= $student['email']; ?></p>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>Gender: </b><?= $student['gender']; ?></p>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>Date Of Birth: </b><?= $student['dob']; ?></p>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>Phone: </b><?= $student['phone']; ?></p>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>Religion: </b><?= $student['religion']; ?></p>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>Address: </b><?= $student['address']; ?></p>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>City: </b><?= $student['city']; ?></p>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>Country: </b><?= $student['country']; ?></p>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>Blood Group: </b><?= $student['bg']; ?></p>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="card border-primary align-self-center">
                                    
                                    <?php if (!$student['photo']) : ?>
                                        <img src="assets/img/avater.png" class="img-thumbnail img-fluid" width="408px">
                                    <?php else : ?>
                                        <img src="<?= 'assets/img/' . $student['photo'] ?>" class="img-thumbnail img-fluid" width="408px">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!-- Personal Details tab end; -->

                        <!-- Admission Details tab start -->
                        <div class="tab-pane container fade" id="admission_details">
                            <div class="card-deck">
                                <div class="card border-danger align-self-center">
                                    <img src="assets/img/admission.jpg" class="img-thumbnail img-fluid" width="408px">
                                </div>
                                <div class="card border-danger">
                                    <div class="card-header bg-danger text-light text-center lead">
                                        ROLL NO: <?= $student['roll']; ?>
                                    </div>
                                    <div class="card-body">
                                        <div id="verify_email_alert"></div>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>Admission Date: </b><?= $student['admission_date']; ?></p>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>Admission Number: </b><?= $student['admission_number']; ?></p>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>Roll NO: </b><?= $student['roll']; ?></p>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>Class: </b><?= $classname; ?></p>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>Section: </b><?= $student['section']; ?></p>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Admission Details tab end; -->

                        <!-- Parent Details tab start -->
                        <div class="tab-pane container fade" id="parent_details">
                            <div class="card-deck">
                                <div class="card border-dark align-self-center">
                                    <img src="assets/img/parents.png" class="img-thumbnail img-fluid" width="408px">
                                </div>
                                <div class="card border-dark">
                                    <div class="card-header bg-dark text-light text-center lead">
                                        ID NO: <?= $student['id_num']; ?>
                                    </div>
                                    <div class="card-body">
                                        <div id="verify_email_alert"></div>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>Father Name: </b><?= $student['father_name']; ?></p>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>Father Mobile: </b><?= $student['father_phone']; ?></p>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>Father Occupation: </b><?= $student['father_occupation']; ?></p>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>Mother Name: </b><?= $student['mother_name']; ?></p>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>Mother Mobile: </b><?= $student['mother_phone']; ?></p>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>Mother Occupation: </b><?= $student['mother_occupation']; ?></p>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Parent Details tab end; -->

                        <!-- Password Change Tab -->
                        <div class="tab-pane container fade" id="change_password">
                            <div class="card-deck">
                                <div class="card border-success">
                                    <div class="card-header bg-success text-white text-center lead">
                                        Change Password
                                    </div>
                                    <div class="card-body">
                                        <div id="alert"></div>
                                        <form action="#" method="post" class="px-3 mt-2" id="password_change_form">
                                            <div class="form-group">
                                                <input type="hidden" name="old_passowrd" value="<?= $student['password'] ?>">
                                                <input type="hidden" name="id" value="<?= $student['id'] ?>">
                                                <label for="curpass">Enter Your Current Password</label>
                                                <input type="password" name="curpass" placeholder="Current Password.." class="form-control" id="curpass" required minlength="5">
                                            </div>
                                            <div class="form-group">
                                                <label for="newpass">Enter Your New Password</label>
                                                <input type="password" name="newpass" placeholder="New Password.." class="form-control" id="newpass" required minlength="5">
                                            </div>
                                            <div class="form-group">
                                                <label for="cnewpass">Enter Your Confirm New Password</label>
                                                <input type="password" name="cnewpass" placeholder="Confirm New Password.." class="form-control" id="cnewpass" required minlength="5">
                                            </div>
                                            <div class="form-group">
                                                <p id="password_error" class="text-danger"></p>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" name="changepass" value="Change Password" class="btn btn-success btn-block btn-lg" id="change_pass_btn">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="card border-success align-self-center">
                                    <img src="assets/img/password.png" class="img-thumbnail img-fluid" width="408px">
                                </div>
                            </div>
                        </div>
                        <!-- Password Change Tab End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include 'inc/footer.php'; ?>