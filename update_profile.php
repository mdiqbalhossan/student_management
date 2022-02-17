<?php

require_once 'lib/session.php';
if ($verified == 'Not Verified') {
	header('location:profile.php');
	exit();
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Update Student Profile</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/css/bootstrap.min.css"/>
	<style type="text/css">
		#second,#third,#fourth,#result{
			display: none;
		}
        .dropzone {
            min-height: 150px;
            border: 1px solid rgba(42, 42, 42, 0.05);
            background: rgba(204, 204, 204, 0.15);
            padding: 20px;
            border-radius: 5px;
            -webkit-box-shadow: inset 0 0 5px 0 rgba(43, 43, 43, 0.1);
            box-shadow: inset 0 0 5px 0 rgba(43, 43, 43, 0.1)
        }
        .card-block {
            padding: 1.25rem
        }

        .dropzone.dz-clickable {
            cursor: pointer
        }
	</style>
</head>
<body class="bg-dark">

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8 bg-light p-4 rounded mt-5">
				<h5 class="text-center text-light bg-success mb-2 p-2 rounded lead" id="result">Hello World!</h5>
				<div class="progress mb-3 rounded" style="height: 40px;">
					<div class="progress-bar bg-danger rounded" role="progressbar" style="width: 25%;" id="progressBar">
					<b class="lead" id="progressBarText">Step-1</b>
				</div>
				</div>
				<form action="" method="post" id="form-data" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?= $student['id']; ?>">
					<input type="hidden" name="id_num" value="<?= $student['id_num']; ?>">
					<div id="first">
						<h4 class="text-center bg-primary p-1 rounded text-light">Personal Information</h4>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="name">Name<strong class="text-danger">*</strong></label>
								<input type="text" name="name" class="form-control" value="<?= $student['name']; ?>" placeholder="Full Name" id="name">
								<strong class="form-text text-danger" id="nameErr"></strong>
							</div>
							<div class="form-group col-md-6">
								<label for="email">Email<strong class="text-danger">*</strong></label>
								<input type="email" name="email" class="form-control" value="<?= $student['email']; ?>" placeholder="E-mail" id="email">
								<strong class="form-text text-danger" id="emailErr"></strong>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="gender">Gender<strong class="text-danger">*</strong></label>
								<select id="gender" name="gender" class="form-control" required>
                                    <option selected value="">Choose..</option>
									<option <?= ($student['gender'] == 'Male') ? 'selected': ''; ?> value="Male">Male</option>
									<option <?= ($student['gender'] == 'Female') ? 'selected': ''; ?> value="Female">Female</option>
								</select>
                                <strong class="form-text text-danger" id="genderErr"></strong>
							</div>
							<div class="form-group col-md-6">
								<label for="dob">Date Of Birth<strong class="text-danger">*</strong></label>
								<input type="date" name="dob" class="form-control" value="<?= $student['dob']; ?>" placeholder="" id="dob" required>
								<strong class="form-text text-danger" id="dobErr"></strong>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="religion">Religion<strong class="text-danger">*</strong></label>
								<select id="religion" name="religion" class="form-control" required>
                                    <option selected value="">Choose..</option>
									<option <?= ($student['religion'] == 'Islam') ? 'selected': ''; ?> value="Islam">Islam</option>
									<option <?= ($student['religion'] == 'Hindu') ? 'selected': ''; ?> value="Hindu">Hindu</option>
									<option <?= ($student['religion'] == 'Budhist') ? 'selected': ''; ?> value="Budhist">Budhist</option>
								</select>
                                <strong class="form-text text-danger" id="religionErr"></strong>
							</div>
							<div class="form-group col-md-6">
								<label for="phone">Phone<strong class="text-danger">*</strong></label>
								<input type="tel" name="phone" class="form-control" value="<?= $student['phone']; ?>" placeholder="Phone Number" id="phone">
								<strong class="form-text text-danger" id="phoneErr"></strong>
							</div>
						</div>
						<div class="form-group">
						    <label for="address">Address<strong class="text-danger">*</strong></label>
						    <input type="text" class="form-control" id="address" name="address" value="<?= $student['address']; ?>" placeholder="1234 Main St">
                            <strong class="form-text text-danger" id="addressErr"></strong>
						</div>
						<div class="form-row">
						    <div class="form-group col-md-6">
						      <label for="city">City<strong class="text-danger">*</strong></label>
						      <input type="text" class="form-control" id="city" name="city" value="<?= $student['city']; ?>" placeholder="Dhaka">
                              <strong class="form-text text-danger" id="cityErr"></strong>
						    </div>
						    <div class="form-group col-md-4">
						      <label for="country">Country<strong class="text-danger">*</strong></label>
						      <input type="text" class="form-control" id="country" name="country" value="<?= $student['country']; ?>" placeholder="Bangladesh">
                              <strong class="form-text text-danger" id="countryErr"></strong>
						    </div>
						    <div class="form-group col-md-2">
						      <label for="bg">Blood Group</label>
						      <input type="text" name="bg" class="form-control" value="<?= $student['bg']; ?>" id="bg" placeholder="O+">
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
								<input type="date" name="admission_date" class="form-control" value="<?= $student['admission_date']; ?>" placeholder="" id="admission_date" required>
								<strong class="form-text text-danger" id="admission_dateErr"></strong>
							</div>
							<div class="form-group col-md-6">
								<label for="admission_number">Admission Number<strong class="text-danger">*</strong></label>
								<input type="number" name="admission_number" class="form-control" value="<?= $student['admission_number']; ?>" placeholder="Admission Number" id="admission_number">
								<strong class="form-text text-danger" id="admission_numberErr"></strong>
							</div>
						</div>
						<div class="form-row">
                            <div class="form-group col-md-4">
								<label for="class">Class/Course<strong class="text-danger">*</strong></label>
								<select id="class" name="class" class="form-control" required>
                                    <option value="" selected>Choose..</option>
                                    <?php foreach ($data as $value):?>
									<option <?= ($student['class'] == $value['id']) ? 'selected': ''; ?> value="<?= $value['id'] ?>"><?= $value['name']; ?></option>
                                    <?php endforeach; ?>
								</select>
                                <strong class="form-text text-danger" id="classErr"></strong>
							</div>
						    <div class="form-group col-md-4">
								<label for="section">Section</label>
								<select id="section" name="section" class="form-control" required>
                                    <option disabled selected>Choose..</option>
									<option <?= ($student['section'] == 'A') ? 'selected': ''; ?> value="A">A</option>
									<option <?= ($student['section'] == 'B') ? 'selected': ''; ?> value="B">B</option>
								</select>
							</div>
						    <div class="form-group col-md-4">
                            <label for="roll">Roll Number<strong class="text-danger">*</strong></label>
								<input type="number" name="roll" value="<?= $student['roll']; ?>" class="form-control" placeholder="Roll" id="roll">
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
                                    <input type="text" name="father_name" class="form-control" value="<?= $student['father_name']; ?>" placeholder="Father Name" id="father_name">
                                    <strong class="form-text text-danger" id="father_nameErr"></strong>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="father_phone">Father Phone<strong class="text-danger">*</strong></label>
                                    <input type="tel" name="father_phone" class="form-control" value="<?= $student['father_phone']; ?>" placeholder="Father Phone Number" id="father_phone">
                                    <strong class="form-text text-danger" id="father_phoneErr"></strong>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="father_occupation">Father Occupation</label>
                                    <input type="text" name="father_occupation" class="form-control" value="<?= $student['father_occupation']; ?>" placeholder="Father occupation" id="father_occupation">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="mother_name">Mother Name<strong class="text-danger">*</strong></label>
                                    <input type="text" name="mother_name" class="form-control" value="<?= $student['mother_name']; ?>" placeholder="mother Name" id="mother_name">
                                    <strong class="form-text text-danger" id="mother_nameErr"></strong>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="mother_phone">Mother Phone<strong class="text-danger">*</strong></label>
                                    <input type="tel" name="mother_phone" class="form-control" value="<?= $student['mother_phone']; ?>" placeholder="mother Phone Number" id="mother_phone">
                                    <strong class="form-text text-danger" id="mother_phoneErr"></strong>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="mother_occupation">Mother Occupation</label>
                                    <input type="text" name="mother_occupation" class="form-control" value="<?= $student['mother_occupation']; ?>" placeholder="mother occupation" id="mother_occupation">
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
                            <div class="card border-info align-self-center">   
                                <?php if(!$student['photo']): ?>
									<img src="assets/img/avater.png" class="img-thumbnail img-fluid" width="408px">
								<?php else: ?>
									<img src="<?= 'assets/img/'.$student['photo'] ?>" class="img-thumbnail img-fluid" width="408px">
								<?php endif; ?>
                            </div>
                            <div class="card">
                                <h4 class="card-header bg-info border-info text-white">Upload Student Picture</h4>
                                <div class="card-body">
                                    <input type="hidden" name="oldimage" value="<?= $student['photo']; ?>">
                                    <div class="form-group m-0">
                                        <label for="profilePhoto" class="m-1">Upload Profile Image</label>
                                        <input type="file" name="image" id="profilePhoto">
                                        <strong class="form-text text-danger" id="imageErr"></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
							<a href="#" class="btn btn-primary" id="prev-4">Previous</a>
							<input type="submit" name="submit" value="Submit" id="submit" class="btn btn-success float-right">
						</div>
                    </div>
				</form>
			</div>
            <h5 class="text-center text-white mt-2">If You don't update your profile please<a href="profile.php" class="ml-2">Skip Now</a></h5>
		</div>
	</div>	

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>s
<script src="assets/js/update_profile.js"></script>

</body>
</html>