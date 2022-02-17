<?php include 'inc/header.php'; ?>


<div class="container">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10 bg-light rounded">
                <div class="card">
                    <div class="card-body">
                        <div id="result"></div>
                        <div class="progress mb-3 rounded" style="height: 40px;">
                            <div class="progress-bar bg-danger rounded" role="progressbar" style="width: 25%;" id="progressBar">
                                <b class="lead" id="progressBarText">Step-1</b>
                            </div>
                        </div>
                        <form action="" method="post" id="form-data" enctype="multipart/form-data">
                            <div id="first">
                                <h4 class="text-center bg-primary p-1 rounded text-light">Personal Information</h4>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Name<strong class="text-danger">*</strong></label>
                                        <input type="text" name="name" class="form-control" placeholder="Full Name" id="name">
                                        <strong class="form-text text-danger" id="nameErr"></strong>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Email<strong class="text-danger">*</strong></label>
                                        <input type="email" name="email" class="form-control" placeholder="E-mail" id="email">
                                        <strong class="form-text text-danger" id="emailErr"></strong>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="gender">Gender<strong class="text-danger">*</strong></label>
                                        <select id="gender" name="gender" class="form-control" required>
                                            <option selected value="">Choose..</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        <strong class="form-text text-danger" id="genderErr"></strong>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="dob">Date Of Birth<strong class="text-danger">*</strong></label>
                                        <input type="date" name="dob" class="form-control" placeholder="" id="dob" required>
                                        <strong class="form-text text-danger" id="dobErr"></strong>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="religion">Religion<strong class="text-danger">*</strong></label>
                                        <select id="religion" name="religion" class="form-control" required>
                                            <option selected value="">Choose..</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Budhist">Budhist</option>
                                        </select>
                                        <strong class="form-text text-danger" id="religionErr"></strong>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phone">Phone<strong class="text-danger">*</strong></label>
                                        <input type="tel" name="phone" class="form-control" placeholder="Phone Number" id="phone">
                                        <strong class="form-text text-danger" id="phoneErr"></strong>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address<strong class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St">
                                    <strong class="form-text text-danger" id="addressErr"></strong>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="city">City<strong class="text-danger">*</strong></label>
                                        <input type="text" class="form-control" id="city" name="city" placeholder="Dhaka">
                                        <strong class="form-text text-danger" id="cityErr"></strong>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="country">Country<strong class="text-danger">*</strong></label>
                                        <input type="text" class="form-control" id="country" name="country" placeholder="Bangladesh">
                                        <strong class="form-text text-danger" id="countryErr"></strong>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="bg">Blood Group</label>
                                        <input type="text" name="bg" class="form-control" id="bg" placeholder="O+">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <a href="#" class="btn btn-danger float-right" id="next-1">Next</a>
                                </div>
                                <div class="clearfix mb-2"></div>
                            </div>

                            <div id="second">
                                <h4 class="text-center bg-primary p-1 rounded text-light">Admission Information</h4>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="admission_date">Admission Date<strong class="text-danger">*</strong></label>
                                        <input type="date" name="admission_date" class="form-control" placeholder="" id="admission_date" required>
                                        <strong class="form-text text-danger" id="admission_dateErr"></strong>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="admission_number">Admission Number<strong class="text-danger">*</strong></label>
                                        <input type="number" name="admission_number" class="form-control" placeholder="Admission Number" id="admission_number">
                                        <strong class="form-text text-danger" id="admission_numberErr"></strong>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="class">Class/Course<strong class="text-danger">*</strong></label>
                                        <select id="class" name="class" class="form-control" required>
                                            <option value="" selected>Choose..</option>
                                            <?php foreach ($class as $value) : ?>
                                                <option value="<?= $value['id'] ?>"><?= $value['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <strong class="form-text text-danger" id="classErr"></strong>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="section">Section</label>
                                        <select id="section" name="section" class="form-control" required>
                                            <option disabled selected>Choose..</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="roll">Roll Number<strong class="text-danger">*</strong></label>
                                        <input type="number" name="roll" class="form-control" placeholder="Roll" id="roll">
                                        <strong class="form-text text-danger" id="rollErr"></strong>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <a href="#" class="btn btn-primary" id="prev-2">Previous</a>
                                    <a href="#" class="btn btn-danger float-right" id="next-2">Next</a>
                                </div>
                            </div>

                            <div id="third">
                                <h4 class="text-center bg-primary p-1 rounded text-light">Parent Information</h4>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="father_name">Father Name<strong class="text-danger">*</strong></label>
                                        <input type="text" name="father_name" class="form-control" placeholder="Father Name" id="father_name">
                                        <strong class="form-text text-danger" id="father_nameErr"></strong>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="father_phone">Father Phone<strong class="text-danger">*</strong></label>
                                        <input type="tel" name="father_phone" class="form-control" placeholder="Father Phone Number" id="father_phone">
                                        <strong class="form-text text-danger" id="father_phoneErr"></strong>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="father_occupation">Father Occupation</label>
                                        <input type="text" name="father_occupation" class="form-control" placeholder="Father occupation" id="father_occupation">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="mother_name">Mother Name<strong class="text-danger">*</strong></label>
                                        <input type="text" name="mother_name" class="form-control" placeholder="mother Name" id="mother_name">
                                        <strong class="form-text text-danger" id="mother_nameErr"></strong>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="mother_phone">Mother Phone<strong class="text-danger">*</strong></label>
                                        <input type="tel" name="mother_phone" class="form-control" placeholder="mother Phone Number" id="mother_phone">
                                        <strong class="form-text text-danger" id="mother_phoneErr"></strong>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="mother_occupation">Mother Occupation</label>
                                        <input type="text" name="mother_occupation" class="form-control" placeholder="mother occupation" id="mother_occupation">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <a href="#" class="btn btn-primary" id="prev-3">Previous</a>
                                    <a href="#" class="btn btn-danger float-right" id="next-3">Next</a>
                                </div>
                            </div>
                            <div id="fourth">
                                <h4 class="text-center bg-primary p-1 rounded text-light">Student Picture</h4>
                                <div class="card-deck mb-2">
                                    <div class="card">
                                        <h4 class="card-header bg-info border-info text-white">Upload Student Picture</h4>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="customFile">Upload Student Picture</label>

                                                <div class="custom-file">
                                                    <input type="file" name="profile_image" class="custom-file-input" id="customFile">
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="login_email">Login Email<strong class="text-danger">*</strong></label>
                                                    <input type="email" name="login_email" class="form-control" placeholder="E-mail" id="login_email" required>
                                                    <strong class="form-text text-danger" id="login_emailErr"></strong>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="password">Password<strong class="text-danger">*</strong></label>
                                                    <input type="password" name="password" class="form-control" placeholder="password" id="password">
                                                    <strong class="form-text text-danger" id="passwordErr"></strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <a href="#" class="btn btn-primary" id="prev-4">Previous</a>
                                    <input type="submit" name="submit" value="Add Student" id="submit" class="btn btn-success float-right">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include 'inc/footer.php'; ?>