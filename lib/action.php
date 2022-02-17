<?php

session_start();

include 'Auth.php';
$auth = new Auth();



// Handle Register Form
if (isset($_POST['action']) && $_POST['action'] == 'register') {
    $name = $auth->sanitize_data($_POST['name']);
    $email = $auth->sanitize_data($_POST['email']);
    $password = $auth->sanitize_data($_POST['password']);

    $hash_pass = password_hash($password, PASSWORD_BCRYPT);

    if ($auth->user_exists($email)) {
        echo $auth->message('danger', 'This email is already registered!');
    } else {
        if ($auth->register($name, $email, $hash_pass)) {
            echo 'register';
            $_SESSION['user'] = $email;
            $subject = 'Verify E-Mail';
            $body = '<h3>Click the below link to Verify Your E-mail. <br><a href="http://localhost:3030/verify-email.php?email=' . $email . '">Verify Email <br>http://localhost:3030/reset-pass.php?email=' . $email . '</a><br>Regards<br>Md Iqbal</h3>';
            $auth->send_mail($email,$subject,$body);
        } else {
            echo $auth->message('danger', 'Something went Wrong! Please try again later!');
        }
    }
}

// Handle Login Form
if (isset($_POST['action']) && $_POST['action'] == 'login') {
    $email = $auth->sanitize_data($_POST['email']);
    $password = $auth->sanitize_data($_POST['password']);

    $loggedIn = $auth->login($email);

    if ($loggedIn != null) {
        if (password_verify($password, $loggedIn['st_password'])) {
            if (!empty($_POST['rem'])) {
                setcookie("email", $email, time() + (30 * 24 * 60 * 60), '/');
                setcookie("password", $password, time() + (30 * 24 * 60 * 60), "/");
            } else {
                setcookie("email", "", 1, "/");
                setcookie("password", "", 1, "/");
            }

            echo 'login';
            $_SESSION['user'] = $email;
        } else {
            echo $auth->message('danger', 'Password didn\'t matched with your email!');
        }
    } else {
        echo $auth->message('danger', 'We didn\'t find your email in our database!');
    }
}

// Handle Forgot Password
if (isset($_POST['action']) && $_POST['action'] == 'forgot') {
    $email = $auth->sanitize_data($_POST['email']);

    $student_found = $auth->currentUser($email);
    if ($student_found != null) {
        $token = uniqid();
        $token = str_shuffle($token);
        $auth->forgotPassword($token, $email);
        $subject = 'Reset Password';
        $body = '<h3>Click the below link to reset your password. <br><a href="http://localhost:3030/reset-pass.php?email=' . $email . '&token=' . $token . '">Reset Password <br>http://localhost:3030/reset-pass.php?email=' . $email . '&token=' . $token . '</a><br>Regards<br>Md Iqbal</h3>';

        if($auth->send_mail($email,$subject,$body)){
            echo $auth->message('success', 'We have send you the reset link in your e-mail ID, please check your e-mail!');
        }else{
            echo $auth->message('danger', 'Something went wrong. Please try again later!');
        }
    } else {
        echo $auth->message('danger', 'Your email didn\'t find in our database. Please Input your correct email and try again later!');
    }
}

// Handle Logout Request
if (isset($_POST['action']) && $_POST['action'] == 'logout') {
    unset($_SESSION['user']);
    echo 'logout';
}

// Handle Fetch Notice

if (isset($_POST['action']) && $_POST['action'] == 'fecthNotice') {
    $output = '';
    $data = $auth->fecthNotice();
    if ($data) {
        $output .= '<ul class="list-group">';
        foreach ($data as $row) {
            $output .= '<li class="list-group-item">
                            <i class="fas fa-info-circle text-info mx-2"></i>
                            ' . $row['title'] . '
                            <a href="#" id="' . $row['id'] . '" class="float-right notice_btn btn btn-success btn-sm" data-toggle="modal" data-target="#showNotice">
                                <i class="fas fa-eye"></i>
                            </a>
                            <span class="text-danger ml-5 d-block">' . $auth->timeAgo($row['created_at']) . '</span>
                            </li>';
        }
        $output .= '</ul>';

        echo $output;
    } else {
        echo '<h3 class="text-center text-danger">You have no notice yet!</h3>';
    }
}

// Handle Fetch Materials
if (isset($_POST['action']) && $_POST['action'] == 'fetchMaterials') {
    $cid = $_POST['cid'];
    $output = '';
    $data = $auth->fetchMaterials($cid);

    if ($data) {
        $output .= '<table class="table table-striped text-center table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>';

        foreach ($data as $value) {
            $output .= '<tr>
                            <td>' . $value['id'] . '</td>
                            <td>' . $value['title'] . '</td>
                            <td>' . $auth->timeAgo($value['created_at']) . '</td>
                            <td><a href="#" id="' . $value['id'] . '" class="float-right materials_btn btn btn-success btn-sm" data-toggle="modal" data-target="#showMaterials">
                            <i class="fas fa-eye"></i>
                            </a></td>
                            </tr>';
        }
        $output .= '</tbody></table>';

        echo $output;
    } else {
        echo '<h3 class="text-danger text-center">You have no materials yet!</h3>';
    }
}

// Handle Fetch Upcoming Class
if (isset($_POST['action']) && $_POST['action'] == 'fetchUpcomingClass') {
    $cid = $_POST['cid'];
    $data = $auth->fetchUpcoming('class', $cid);

    $output = '';
    if ($data) {
        foreach ($data as $value) {
            $output .= '<h3 class="text-success py-2" style="border-bottom: 1px solid #0275d8;">' . $value['title'] . '</h3>
                            <span class="text-info"><b>Date: </b>' . date('d M Y', strtotime($value['date'])) . '</span><br>
                            <span class="text-secondary"><b>Start Time: </b>' . date('H:i A', strtotime($value['start_time'])) . '</span><br>
                            <span class="text-secondary"><b>End Time: </b>' . date('H:i A', strtotime($value['end_time'])) . '</span>
                            ';
        }

        echo $output;
    } else {
        echo '<h4 class="text-danger text-center">You have no Upcoming Class!</h4>';
    }
}

// Handle Fetch Upcoming Exam
if (isset($_POST['action']) && $_POST['action'] == 'fetchUpcomingExam') {
    $cid = $_POST['cid'];
    $data = $auth->fetchUpcoming('exam', $cid);

    $output = '';
    if ($data) {
        foreach ($data as $value) {
            $output .= '<h3 class="text-success py-2" style="border-bottom: 1px solid #0275d8;">' . $value['title'] . '</h3>
                            <span class="text-info"><b>Date: </b>' . date('d M Y', strtotime($value['date'])) . '</span><br>
                            <span class="text-secondary"><b>Start Time: </b>' . date('H:i A', strtotime($value['start_time'])) . '</span><br>
                            <span class="text-secondary"><b>End Time: </b>' . date('H:i A', strtotime($value['end_time'])) . '</span>
                            ';
        }

        echo $output;
    } else {
        echo '<h4 class="text-danger text-center">You have no Upcoming Exam!</h4>';
    }
}

// Handle Fetch Latest Result
if (isset($_POST['action']) && $_POST['action'] == 'fetchLatestResult') {
    $st_id = $_POST['st_id'];
    $data = $auth->fetchLatestResult($st_id);

    $output = '';
    if ($data) {
        foreach ($data as $value) {
            $output .= '<h3 class="text-success py-2" style="border-bottom: 1px solid #0275d8;">' . $value['title'] . '</h3>
                            <span class="text-info"><b>Note: </b>' . $value['teacher_note'] . '</span><br>
                            <span class="text-secondary"><b>Grade/Marks: </b>' . $value['obtained_marks'] . '</span><br>
                            <span class="text-secondary"><b></b>' . $auth->timeAgo($value['crated_at']) . '</span>
                            ';
        }

        echo $output;
    } else {
        echo '<h4 class="text-danger text-center">You have no Latest Result!</h4>';
    }
}



// Handle Profile Update
if (isset($_FILES['image'])) {
    $id = $_POST['id'];
    $name = $auth->sanitize_data($_POST['name']);
    $email = $auth->sanitize_data($_POST['email']);
    $gender = $auth->sanitize_data($_POST['gender']);
    $dob = $auth->sanitize_data($_POST['dob']);
    $religion = $auth->sanitize_data($_POST['religion']);
    $phone = $auth->sanitize_data($_POST['phone']);
    $address = $auth->sanitize_data($_POST['address']);
    $city = $auth->sanitize_data($_POST['city']);
    $country = $auth->sanitize_data($_POST['country']);
    $blood_group = $auth->sanitize_data($_POST['bg']);
    $admission_date = $auth->sanitize_data($_POST['admission_date']);
    $admission_number = $auth->sanitize_data($_POST['admission_number']);
    $class = $auth->sanitize_data($_POST['class']);
    $section = $auth->sanitize_data($_POST['section']);
    $roll = $auth->sanitize_data($_POST['roll']);
    $father_name = $auth->sanitize_data($_POST['father_name']);
    $father_phone = $auth->sanitize_data($_POST['father_phone']);
    $father_occupation = $auth->sanitize_data($_POST['father_occupation']);
    $mother_name = $auth->sanitize_data($_POST['mother_name']);
    $mother_phone = $auth->sanitize_data($_POST['mother_phone']);
    $mother_occupation = $auth->sanitize_data($_POST['mother_occupation']);
    if ($_POST['id_num'] == null || $_POST['id_num'] == 0) {
        $id_num = rand(10, 1000000);
    } else {
        $id_num = $_POST['id_num'];
    }


    $old_image = $_POST['oldimage'];
    $folder = '../assets/img/';

    if (isset($_FILES['image']['name']) && ($_FILES['image']['name'] != "")) {
        $upload_path = $folder . $_FILES['image']['name'];
        $newimage = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $upload_path);

        if ($old_image != null) {
            unlink($folder . $old_image);
        }
    } else {
        $newimage = $old_image;
    }

    $update = $auth->updateProfile($name, $religion, $address, $city, $gender, $phone, $dob, $blood_group, $email, $country, $admission_date, $admission_number, $class, $section, $roll, $father_name, $mother_name, $father_phone, $mother_phone, $father_occupation, $mother_occupation, $newimage, $id_num, $id);
    if ($update) {
        echo 'Profile Updated Succesfully! Now you can back your Profile Page<a href="profile.php" class="btn btn-danger ml-2">Profile</a>';
    }
}

// Handle Change Password
if (isset($_POST['action']) && $_POST['action'] == 'change_pass') {
    $currpass = $auth->sanitize_data($_POST['curpass']);
    $newpass  = $auth->sanitize_data($_POST['newpass']);
    $cnewpass = $auth->sanitize_data($_POST['cnewpass']);
    $old_pass = $_POST['old_passowrd'];
    $id = $_POST['id'];

    $hpass = password_hash($newpass, PASSWORD_DEFAULT);

    if ($newpass != $cnewpass) {
        echo $auth->message('danger', 'Password did not matched!');
    } else {
        if (password_verify($currpass, $old_pass)) {
            $auth->changePassword($hpass, $id);
            echo $auth->message('success', 'Password chnaged succesfully!');
            //$auth->notification($id,'admin','Password Changed');
        } else {
            echo $auth->message('danger', 'Current Password is Wrong!');
        }
    }
}

// Hnadle Display Notice In Details
if (isset($_POST['action']) && $_POST['action'] == 'notice_details') {
    $id = $_POST['id'];

    $data = $auth->fecthNoticeById($id);

    echo json_encode($data);
}

// Hnadle Display Materials In Details
if (isset($_POST['action']) && $_POST['action'] == 'materials_details') {
    $id = $_POST['id'];

    $data = $auth->fecthMaterialsById($id);

    echo json_encode($data);
}

// Handle Payable Fees
if (isset($_POST['action']) && $_POST['action'] == 'fetchfees') {
    $st_id = $_POST['st_id'];
    $data = $auth->fetchFees(0, $st_id);

    $output = '';
    if ($data) {
        foreach ($data as $value) {
            $output .= '<h5 class="text-success py-2" style="border-bottom: 1px solid #0275d8;">' . $value['title'] . '</h5>
                            <span class="text-info"><b>Payable Amount: </b>' . $value['total_amount'] . 'tk</span><br>
                            <span class="text-secondary"><b>Issued Date: </b>' . date('d M Y', strtotime($value['issued_date'])) . '</span><br>
                            <span class="text-secondary"><b>Due Date: </b>' . date('d M Y', strtotime($value['due_date'])) . '</span><br>
                            <span class="text-danger" style="font-size:12px;">If you don\'t pay due time you must pay with fine(' . $value['fine'] . 'tk).</span>
                            <button class="btn btn-success btn-block btn-sm pay" data-toggle="modal" data-target="#pay">Pay Now</button>
                            ';
        }

        echo $output;
    } else {
        echo '<h4 class="text-danger text-center">You have no Payable Fees!</h4>';
    }
}

// Handle Pay Fees
if (isset($_POST['action']) && $_POST['action'] == 'pay') {
    $amount = $auth->sanitize_data($_POST['paid_amount']);
    $date = $auth->sanitize_data($_POST['payment_date']);
    $method = $auth->sanitize_data($_POST['payment_method']);
    $trid = $auth->sanitize_data($_POST['tr_id']);
    $notes = $auth->sanitize_data($_POST['notes']);
    $id = $_POST['id'];

    $update = $auth->pay($id, $amount, $date, $method, $trid, $notes);
}

//Handle Send Msg By User To admin
if (isset($_POST['action']) && $_POST['action'] == 'send_msg') {
    $id = $_POST['student_id'];
    $fname = $auth->sanitize_data($_POST['fname']);
    $lname = $auth->sanitize_data($_POST['lname']);
    $email = $auth->sanitize_data($_POST['email']);
    $msg = $auth->sanitize_data($_POST['message']);

    $auth->send_message($id, $fname, $lname, $email, $msg);
}





/***************************************************************************/
/**************** Admin Action Section | Admin Area*************************/
/***************************************************************************/


// Handle Admin Login
if (isset($_POST['action']) && $_POST['action'] == 'admin_login') {
    $email = $auth->sanitize_data($_POST['email']);
    $password = $auth->sanitize_data($_POST['password']);

    $hash_password = sha1($password);

    $loggedIn = $auth->admin_login($email, $hash_password);

    if ($loggedIn != null) {
        echo 'admin_login';
        $_SESSION['email'] = $email;
    } else {
        echo $auth->message('danger', 'Email or Password is Incorrect!');
    }
}

// Handle Logout Request
if (isset($_POST['action']) && $_POST['action'] == 'admin_logout') {
    unset($_SESSION['email']);
    echo 'logout';
}

// Fetch Student
if (isset($_POST['fetchStudent']) && $_POST['fetchStudent'] == 'fetchStudent') {
    $output = '';
    $student = $auth->fetchStudent();
    $path = '../assets/img/';

    if ($student) {
        foreach ($student as $value) {
            if ($value['st_photo'] != '') {
                $uphoto = $path . $value['st_photo'];
            } else {
                $uphoto = '../assets/img/avater.png';
            }
            $output .= '<tr>
                        <td>' . $value['st_idnum'] . '</td>
                        <td><img src="' . $uphoto . '" class="rounded-circle" width="40px"></td>
                        <td>' . $value['st_name'] . '</td>
                        <td>' . $value['name'] . '</td>
                        <td>' . $value['st_gender'] . '</td>
                        <td>' . $value['st_phone'] . '</td>
                        <td>' . $value['st_email'] . '</td>
                        <td>
                            <a href="#" id="' . $value['st_id'] . '" title="View Details" class="text-info infoBtn" data-toggle="modal" data-target="#detailsStudentModal"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;
                            <a href="#" id="' . $value['st_id'] . '" title="Delete student" class="text-danger dltBtn"><i class="fas fa-trash-alt fa-lg"></i></a>
                        </td>
                        </tr>';
        }

        echo $output;
    } else {
        echo '<h3 class="text-secondary text-center p-2">:( You have no student yet!</h3>';
    }
}

// Handle Display Student By ID

if (isset($_POST['action']) && $_POST['action'] == 'fetchById') {
    $id = $_POST['id'];

    $data = $auth->fetchStudentDetailsById($id);

    echo json_encode($data);
}

// Handle Delete an Student
if (isset($_POST['action']) && $_POST['action'] == 'delete_student') {
    $id = $_POST['del_id'];

    $auth->studentAction($id, 1);
}


// Add Student
if (isset($_FILES['profile_image'])) {

    $id_num = rand(10, 1000000);

    $folder = '../assets/img/';

    if (isset($_FILES['profile_image']['name']) && ($_FILES['profile_image']['name'] != "")) {
        $file_name = time() . '-' . $_FILES['profile_image']['name'];
        $upload_path = $folder . $file_name;
        $newimage = $file_name;
        move_uploaded_file($_FILES['profile_image']['tmp_name'], $upload_path);
    } else {
        $newimage = '';
    }
    $password = $auth->sanitize_data($_POST['password']);
    $hash_pass = password_hash($password, PASSWORD_BCRYPT);

    if ($auth->user_exists($_POST['login_email'])) {
        echo $auth->message('danger', 'This email is already registered!');
    } else {
        $student = array(
            'st_name' => $auth->sanitize_data($_POST['name']),
            'st_email' => $auth->sanitize_data($_POST['email']),
            'st_gender' => $auth->sanitize_data($_POST['gender']),
            'st_dob' => $auth->sanitize_data($_POST['dob']),
            'st_religion' => $auth->sanitize_data($_POST['religion']),
            'st_phone' => $auth->sanitize_data($_POST['phone']),
            'st_address' => $auth->sanitize_data($_POST['address']),
            'st_city' => $auth->sanitize_data($_POST['city']),
            'st_idnum' => $id_num,
            'st_country' => $auth->sanitize_data($_POST['country']),
            'st_blood' => $auth->sanitize_data($_POST['bg']),
            'st_admissiondate' => $auth->sanitize_data($_POST['admission_date']),
            'st_admissionnumber' => $auth->sanitize_data($_POST['admission_number']),
            'cid' => $auth->sanitize_data($_POST['class']),
            'st_section' => $auth->sanitize_data($_POST['section']),
            'st_roll' => $auth->sanitize_data($_POST['roll']),
            'st_photo' => $newimage,
            'st_father_name' => $auth->sanitize_data($_POST['father_name']),
            'st_father_phone' => $auth->sanitize_data($_POST['father_phone']),
            'st_father_occupation' => $auth->sanitize_data($_POST['father_occupation']),
            'st_mother_name' => $auth->sanitize_data($_POST['mother_name']),
            'st_mother_phone' => $auth->sanitize_data($_POST['mother_phone']),
            'st_mother_occupation' => $auth->sanitize_data($_POST['mother_occupation']),
            'st_login_email' => $auth->sanitize_data($_POST['login_email']),
            'st_password' => $hash_pass,
            'verified' => 1
        );

        $auth->admit_student($student);
        echo 'done';
    }
}

// Fetch Notice
if (isset($_POST['fetchNotice']) && $_POST['fetchNotice'] == 'fetchNotice') {
    $output = '';
    $notice = $auth->fetchNotice();

    if ($notice) {
        foreach ($notice as $key => $value) {
            if ($value['file'] == '') {
                $file = 'No File';
            } else {
                $file = $value['file'];
            }
            $output .= '<tr>
                        <td>' . $value['id'] . '</td>
                        <td>' . $value['title'] . '</td>
                        <td>' . strtr($value['details'], 0, 20) . '</td>
                        <td>' . $file . '</td>
                        <td>' . $auth->timeAgo($value['created_at']) . '</td>
                        <td>
                            <a href="#" id="' . $value['id'] . '" title="View Details" class="text-info notice_info_btn" data-toggle="modal" data-target="#showNotice"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;
                            <a href="#" id="' . $value['id'] . '" title="Edit Notice" class="text-primary editNoticeBtn"><i class="fas fa-edit fa-lg" data-toggle="modal" data-target="#editNoticeModal"></i></a>&nbsp;
                            <a href="#" id="' . $value['id'] . '" title="Delete Notice" class="text-danger dltnoticeBtn"><i class="fas fa-trash-alt fa-lg"></i></a>
                        </td>
                        </tr>';
        }

        echo $output;
    } else {
        echo '<h3 class="text-secondary text-center p-2">:( You have no student yet!</h3>';
    }
}

// Add Notice Via Ajax Request
if (isset($_FILES['notice'])) {
    $title = $auth->sanitize_data($_POST['title']);
    if ($_POST['details']) {
        $details = $auth->sanitize_data($_POST['details']);
    } else {
        $details = '';
    }


    $folder = '../assets/img/';

    if (isset($_FILES['notice']['name']) && ($_FILES['notice']['name'] != "")) {
        $file_name = time() . '-' . $_FILES['notice']['name'];
        $upload_path = $folder . $file_name;
        $newfile = $file_name;
        move_uploaded_file($_FILES['notice']['tmp_name'], $upload_path);
    } else {
        $newfile = '';
    }

    $auth->add_notice($title, $details, $newfile);
}

// Hnadle Display Notice In Details
if (isset($_POST['action']) && $_POST['action'] == 'notice_details_by_id') {
    $id = $_POST['id'];

    $data = $auth->fecthNoticeById($id);

    echo json_encode($data);
}

// Handle Delete a Notice
if (isset($_POST['del_notice_id'])) {
    $id = $_POST['del_notice_id'];

    $auth->deleteNotice($id);
}

// Handle Edit Notice of an user
if (isset($_POST['edit_notice_id'])) {
    $id = $_POST['edit_notice_id'];

    $row = $auth->fecthNoticeById($id);
    echo json_encode($row);
}

// Handle Update Notice
if (isset($_FILES['notice_file'])) {
    $id  = $_POST['id'];
    $title = $auth->sanitize_data($_POST['title']);
    if ($_POST['details']) {
        $details = $auth->sanitize_data($_POST['details']);
    } else {
        $details = '';
    }

    $old_file = $_POST['old_file'];
    $folder = '../assets/img/';

    if (isset($_FILES['notice_file']['name']) && ($_FILES['notice_file']['name'] != "")) {
        $file_name = time() . '-' . $_FILES['notice_file']['name'];
        $upload_path = $folder . $file_name;
        $newfile = $file_name;
        move_uploaded_file($_FILES['notice_file']['tmp_name'], $upload_path);
    } else {
        $newfile = $old_file;
    }

    $auth->update_notice($title, $details, $newfile, $id);
}



// Fetch Materials
if (isset($_POST['fetchMaterials']) && $_POST['fetchMaterials'] == 'fetchMaterials') {
    $output = '';
    $materials = $auth->fetchMaterialsAll();

    if ($materials) {
        foreach ($materials as $key => $value) {
            if ($value['file'] == '') {
                $file = 'No File';
            } else {
                $file = $value['file'];
            }
            $output .= '<tr>
                        <td>' . $value['id'] . '</td>
                        <td>' . $value['title'] . '</td>
                        <td>' . $value['name'] . '</td>
                        <td>' . strtr($value['materials'], 0, 20) . '</td>
                        <td>' . $file . '</td>
                        <td>' . $auth->timeAgo($value['created_at']) . '</td>
                        <td>
                            <a href="#" id="' . $value['id'] . '" title="View Details" class="text-info materials_info_btn" data-toggle="modal" data-target="#showMaterials"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;
                            <a href="#" id="' . $value['id'] . '" title="Edit Materials" class="text-primary editMaterialsBtn"><i class="fas fa-edit fa-lg" data-toggle="modal" data-target="#editMaterialsModal"></i></a>&nbsp;
                            <a href="#" id="' . $value['id'] . '" title="Delete Materials" class="text-danger dltMaterialsBtn"><i class="fas fa-trash-alt fa-lg"></i></a>
                        </td>
                        </tr>';
        }

        echo $output;
    } else {
        echo '<h3 class="text-secondary text-center p-2">:( You have no Materials yet!</h3>';
    }
}

// Add Materials Via Ajax Request
if (isset($_FILES['materials'])) {
    $title = $auth->sanitize_data($_POST['title']);
    $class = $auth->sanitize_data($_POST['class']);
    if ($_POST['materials']) {
        $details = $auth->sanitize_data($_POST['materials']);
    } else {
        $details = '';
    }


    $folder = '../assets/img/';

    if (isset($_FILES['materials']['name']) && ($_FILES['materials']['name'] != "")) {
        $file_name = time() . '-' . $_FILES['materials']['name'];
        $upload_path = $folder . $file_name;
        $newfile = $file_name;
        move_uploaded_file($_FILES['materials']['tmp_name'], $upload_path);
    } else {
        $newfile = '';
    }

    $auth->add_materials($title, $details, $newfile, $class);
}

// Hnadle Display Materials In Details
if (isset($_POST['action']) && $_POST['action'] == 'materials_details_by_id') {
    $id = $_POST['id'];

    $data = $auth->fetchMaterialsById($id);

    echo json_encode($data);
}

// Handle Delete a Materials
if (isset($_POST['del_materials_id'])) {
    $id = $_POST['del_materials_id'];

    $auth->deleteMaterials($id);
}

// Handle Edit Materials of an user
if (isset($_POST['edit_materials_id'])) {
    $id = $_POST['edit_materials_id'];

    $row = $auth->fetchMaterialsById($id);
    echo json_encode($row);
}

// Handle Update Materials
if (isset($_FILES['materials_file'])) {
    $id  = $_POST['id'];
    $title = $auth->sanitize_data($_POST['title']);
    $class = $auth->sanitize_data($_POST['class']);
    if ($_POST['materials']) {
        $details = $auth->sanitize_data($_POST['materials']);
    } else {
        $details = '';
    }

    $old_file = $_POST['old_file'];
    $folder = '../assets/img/';

    if (isset($_FILES['materials_file']['name']) && ($_FILES['materials_file']['name'] != "")) {
        $file_name = time() . '-' . $_FILES['materials_file']['name'];
        $upload_path = $folder . $file_name;
        $newfile = $file_name;
        move_uploaded_file($_FILES['materials_file']['tmp_name'], $upload_path);
    } else {
        $newfile = $old_file;
    }

    $auth->update_materials($title, $details, $newfile, $id, $class);
}


// Hnadle Fetch Class
if (isset($_POST['fetchClass']) && $_POST['fetchClass'] == 'fetchClass') {
    $output = '';
    $class = $auth->fetchClass();

    if ($class) {
        foreach ($class as $key => $value) {
            $output .= '<tr>
                        <td>' . $value['id'] . '</td>
                        <td>' . $value['name'] . '</td>
                        <td>' . $auth->timeAgo($value['created_at']) . '</td>
                        <td>
                            <a href="#" id="' . $value['id'] . '" title="Edit class" class="text-primary editclassBtn"><i class="fas fa-edit fa-lg" data-toggle="modal" data-target="#editclassModal"></i></a>&nbsp;
                            <a href="#" id="' . $value['id'] . '" title="Delete class" class="text-danger dltclassBtn"><i class="fas fa-trash-alt fa-lg"></i></a>
                        </td>
                        </tr>';
        }

        echo $output;
    } else {
        echo '<h3 class="text-secondary text-center p-2">:( You have no class yet!</h3>';
    }
}

// Handle Add Class
if (isset($_POST['action']) && $_POST['action'] == 'add_class') {
    $name = $auth->sanitize_data($_POST['name']);

    $auth->add_class($name);
}

// Hnadle Edit class

if (isset($_POST['action']) && $_POST['action'] == 'edit_class') {
    $id = $_POST['id'];

    $data = $auth->fetchClassById($id);

    echo json_encode($data);
}

// Handle Update Class
if (isset($_POST['action']) && $_POST['action'] == 'update_class') {
    $id = $_POST['id'];
    $name = $_POST['name'];

    $auth->update_class($name, $id);
}

// Handle Delete Class
if (isset($_POST['del_class_id'])) {
    $id = $_POST['del_class_id'];

    $auth->deleteClass($id);
}

// Hnadle Fetch Subject
if (isset($_POST['fetchSubject']) && $_POST['fetchSubject'] == 'fetchSubject') {
    $output = '';
    $subject = $auth->fetchSubject();

    if ($subject) {
        foreach ($subject as $key => $value) {
            $output .= '<tr>
                        <td>' . ++$key . '</td>
                        <td>' . $value['subject'] . '</td>
                        <td>' . $value['name'] . '</td>
                        <td>' . $auth->timeAgo($value['created_at']) . '</td>
                        <td>
                            <a href="#" id="' . $value['id'] . '" title="Edit subject" class="text-primary editSubjectBtn"><i class="fas fa-edit fa-lg" data-toggle="modal" data-target="#editSubjectModal"></i></a>&nbsp;
                            <a href="#" id="' . $value['id'] . '" title="Delete Subject" class="text-danger dltSubjectBtn"><i class="fas fa-trash-alt fa-lg"></i></a>
                        </td>
                        </tr>';
        }

        echo $output;
    } else {
        echo '<h3 class="text-secondary text-center p-2">:( You have no class yet!</h3>';
    }
}

// Handle Add Subject
if (isset($_POST['action']) && $_POST['action'] == 'add_subject') {
    $name = $auth->sanitize_data($_POST['name']);
    $class = $auth->sanitize_data($_POST['class']);
    $auth->add_subject($name, $class);
}

// Hnadle Edit Subject

if (isset($_POST['action']) && $_POST['action'] == 'edit_subject') {
    $id = $_POST['id'];

    $data = $auth->fetchSubjectById($id);

    echo json_encode($data);
}

// Handle Update Subject
if (isset($_POST['action']) && $_POST['action'] == 'update_subject') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $class = $_POST['class'];

    $auth->update_subject($name, $class, $id);
}

// Handle Delete Subject
if (isset($_POST['del_sub_id'])) {
    $id = $_POST['del_sub_id'];

    $auth->deleteSub($id);
}

// Hnadle Fetch Exam
if (isset($_POST['fetchExam']) && $_POST['fetchExam'] == 'fetchExam') {
    $output = '';
    $exam = $auth->fetchExam();

    if ($exam) {
        foreach ($exam as $key => $value) {
            $output .= '<tr>
                        <td>' . ++$key . '</td>
                        <td>' . $value['name'] . '</td>
                        <td>' . $value['title'] . '</td>
                        <td>' . date('d M Y', strtotime($value['date'])) . '</td>
                        <td>' . date('H:i A', strtotime($value['start_time'])) . '</td>
                        <td>' . date('H:i A', strtotime($value['end_time'])) . '</td>
                        <td>
                            <a href="#" id="' . $value['id'] . '" title="View Exam" class="text-info examInfoBtn" data-toggle="modal" data-target="#showExam"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;
                            <a href="#" id="' . $value['id'] . '" title="Edit exam" class="text-primary editexamBtn"><i class="fas fa-edit fa-lg" data-toggle="modal" data-target="#editexamModal"></i></a>&nbsp;
                            <a href="#" id="' . $value['id'] . '" title="Delete exam" class="text-danger dltexamBtn"><i class="fas fa-trash-alt fa-lg"></i></a>
                        </td>
                        </tr>';
        }

        echo $output;
    } else {
        echo '<h3 class="text-secondary text-center p-2">:( You have no exam yet!</h3>';
    }
}

// Handle Add Exam
if (isset($_POST['action']) && $_POST['action'] == 'add_exam') {
    $data = array(
        'cid' => $auth->sanitize_data($_POST['class']),
        'title' => $auth->sanitize_data($_POST['title']),
        'description' => $auth->sanitize_data($_POST['description']),
        'date' => $auth->sanitize_data($_POST['date']),
        'start_time' => $auth->sanitize_data($_POST['start_time']),
        'end_time' => $auth->sanitize_data($_POST['end_time']),
        'type' => 'exam'
    );

    $auth->addExam($data);
}

// Handle Delete Exam
if (isset($_POST['del_exam_id'])) {
    $id = $_POST['del_exam_id'];

    $auth->deleteExam($id);
}

// Hnadle Display Exam In Details
if (isset($_POST['action']) && $_POST['action'] == 'exam_details') {
    $id = $_POST['id'];

    $data = $auth->fetchExamByID($id);

    echo json_encode($data);
}

// Hnadle Edit Exam

if (isset($_POST['action']) && $_POST['action'] == 'edit_exam') {
    $id = $_POST['id'];

    $data = $auth->fetchExamByID($id);

    echo json_encode($data);
}

// Handle Update Exam
if (isset($_POST['action']) && $_POST['action'] == 'update_exam') {
    $id = $auth->sanitize_data($_POST['id']);
    $class = $auth->sanitize_data($_POST['class']);
    $title = $auth->sanitize_data($_POST['title']);
    $description = $auth->sanitize_data($_POST['description']);
    $date = $auth->sanitize_data($_POST['date']);
    $start_time = $auth->sanitize_data($_POST['start_time']);
    $end_time = $auth->sanitize_data($_POST['end_time']);

    $auth->updateExam($id, $class, $title, $description, $date, $start_time, $end_time);
}


// Hnadle Fetch Class Schedule
if (isset($_POST['fetchClassSchedule']) && $_POST['fetchClassSchedule'] == 'fetchClassSchedule') {
    $output = '';
    $class_schedule = $auth->fetchClassSchedule();

    if ($class_schedule) {
        foreach ($class_schedule as $key => $value) {
            $output .= '<tr>
                        <td>' . ++$key . '</td>
                        <td>' . $value['title'] . '</td>
                        <td>' . $value['name'] . '</td>
                        <td>' . date('d M Y', strtotime($value['date'])) . '</td>
                        <td>' . date('H:i A', strtotime($value['start_time'])) . '</td>
                        <td>' . date('H:i A', strtotime($value['end_time'])) . '</td>
                        <td>
                            <a href="#" id="' . $value['id'] . '" title="View class schedule" class="text-info class_scheduleInfoBtn" data-toggle="modal" data-target="#showclassSchedule"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;
                            <a href="#" id="' . $value['id'] . '" title="Edit class schedule" class="text-primary editclass_scheduleBtn"><i class="fas fa-edit fa-lg" data-toggle="modal" data-target="#editclassScheduleModal"></i></a>&nbsp;
                            <a href="#" id="' . $value['id'] . '" title="Delete class schedule" class="text-danger dltclass_scheduleBtn"><i class="fas fa-trash-alt fa-lg"></i></a>
                        </td>
                        </tr>';
        }

        echo $output;
    } else {
        echo '<h3 class="text-secondary text-center p-2">:( You have no class_schedule yet!</h3>';
    }
}

// Handle Add Class Schedule
if (isset($_POST['action']) && $_POST['action'] == 'add_class_schedule') {
    $data = array(
        'cid' => $auth->sanitize_data($_POST['class']),
        'title' => $auth->sanitize_data($_POST['title']),
        'description' => $auth->sanitize_data($_POST['description']),
        'date' => $auth->sanitize_data($_POST['date']),
        'start_time' => $auth->sanitize_data($_POST['start_time']),
        'end_time' => $auth->sanitize_data($_POST['end_time']),
        'type' => 'class'
    );

    $auth->addScheduleClass($data);
}

// Handle Delete Class Schedule
if (isset($_POST['del_class_schedule_id'])) {
    $id = $_POST['del_class_schedule_id'];

    $auth->deleteClassSchedule($id);
}

// Hnadle Display Class Schedule In Details
if (isset($_POST['action']) && $_POST['action'] == 'classSchedule_details') {
    $id = $_POST['id'];

    $data = $auth->fetchClassScheduleById($id);

    echo json_encode($data);
}

// Hnadle Edit Class Schedule

if (isset($_POST['action']) && $_POST['action'] == 'edit_classSchedule') {
    $id = $_POST['id'];

    $data = $auth->fetchClassScheduleById($id);

    echo json_encode($data);
}

// Handle Update Exam
if (isset($_POST['action']) && $_POST['action'] == 'update_class_schedule') {
    $id = $auth->sanitize_data($_POST['id']);
    $class = $auth->sanitize_data($_POST['class']);
    $title = $auth->sanitize_data($_POST['title']);
    $description = $auth->sanitize_data($_POST['description']);
    $date = $auth->sanitize_data($_POST['date']);
    $start_time = $auth->sanitize_data($_POST['start_time']);
    $end_time = $auth->sanitize_data($_POST['end_time']);

    $auth->updateClassSchedule($id, $class, $title, $description, $date, $start_time, $end_time);
}

// Fetch Student
if (isset($_POST['fetchDeletedStudent']) && $_POST['fetchDeletedStudent'] == 'fetchDeletedStudent') {
    $output = '';
    $student = $auth->fetchDeletedStudent();
    $path = '../assets/img/';

    if ($student) {
        foreach ($student as $value) {
            if ($value['st_photo'] != '') {
                $uphoto = $path . $value['st_photo'];
            } else {
                $uphoto = '../assets/img/avater.png';
            }
            $output .= '<tr>
                        <td>' . $value['st_idnum'] . '</td>
                        <td><img src="' . $uphoto . '" class="rounded-circle" width="40px"></td>
                        <td>' . $value['st_name'] . '</td>
                        <td>' . $value['name'] . '</td>
                        <td>' . $value['st_gender'] . '</td>
                        <td>' . $value['st_phone'] . '</td>
                        <td>' . $value['st_email'] . '</td>
                        <td>
                            <a href="#" id="' . $value['st_id'] . '" title="Restore student" class="text-danger restore_btn"><i class="fas fa-undo-alt fa-lg"></i></a>
                        </td>
                        </tr>';
        }

        echo $output;
    } else {
        echo '<h3 class="text-secondary text-center p-2">:( You have no Deleted student yet!</h3>';
    }
}


// Hnadle Restore Student
if (isset($_POST['action']) && $_POST['action'] == 'restore_student') {
    $id = $_POST['restore_id'];

    $auth->studentAction($id, 0);
}

// Handle Fetch All Fees
if (isset($_POST['fetchFees']) && $_POST['fetchFees'] == 'fetchFees') {
    $output = '';
    $fees = $auth->fetchAllFees();

    if ($fees) {
        foreach ($fees as $key => $value) {
            $output .= '<tr>
                        <td>' . ++$key . '</td>
                        <td>' . $value['st_name'] . '</td>
                        <td>' . $value['title'] . '</td>
                        <td>' . number_format($value['total_amount'], 2) . '</td>
                        <td>' . date('d M Y', strtotime($value['due_date'])) . '</td>
                        <td>' . ($value['paid'] == 1 ? '<span class="badge badge-success">Paid</span>' : '<span class="badge badge-danger">UnPaid</span>') . '</td>
                        <td>' . ($value['paid'] == 1 ? '<a href="#" id="' . $value['id'] . '" title="View Paid Information" class="text-success paidInfoBtn" data-toggle="modal" data-target="#showPaidFees"><i class="fas fa-question-circle fa-lg"></i></a>&nbsp;' : '') . '
                            
                            <a href="#" id="' . $value['id'] . '" title="View Fees Detail" class="text-info feesInfoBtn" data-toggle="modal" data-target="#showFees"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;                            
                            ' . ($value['paid'] == 0 ? '<a href="#" id="' . $value['id'] . '" title="Edit Fees" class="text-primary editfeesBtn"><i class="fas fa-edit fa-lg" data-toggle="modal" data-target="#editFeesModal"></i></a>&nbsp;' : '') . '                            
                            <a href="#" id="' . $value['id'] . '" title="Delete Fees" class="text-danger dltfeesBtn"><i class="fas fa-trash-alt fa-lg"></i></a>
                        </td>
                        </tr>';
        }

        echo $output;
    } else {
        echo '<h3 class="text-secondary text-center p-2">:( You have no fees yet!</h3>';
    }
}

// Handle Add New Fees
if (isset($_POST['action']) && $_POST['action'] == 'add_fees') {
    foreach ($_POST['st_id'] as $value) {
        $title = $auth->sanitize_data($_POST['title']);
        $description = $auth->sanitize_data($_POST['description']);
        $total_amount = $auth->sanitize_data($_POST['total_amount']);
        $issued_date = $auth->sanitize_data($_POST['issued_date']);
        $due_date = $auth->sanitize_data($_POST['due_date']);
        $fine = $auth->sanitize_data($_POST['fine']);
        $st_id = $value;

        $auth->add_fees($st_id, $title, $description, $total_amount, $issued_date, $due_date, $fine);
    }
}


// Handle Delete Fees
if (isset($_POST['fees_del_id'])) {
    $id = $_POST['fees_del_id'];

    $auth->deleteFees($id);
}

// Hnadle Display Fees In Details
if (isset($_POST['action']) && $_POST['action'] == 'fees_details') {
    $id = $_POST['id'];

    $data = $auth->fetchFeesById($id);

    echo json_encode($data);
}

// Hnadle Edit Fees

if (isset($_POST['action']) && $_POST['action'] == 'edit_fees') {
    $id = $_POST['id'];

    $data = $auth->fetchFeesById($id);

    echo json_encode($data);
}

// Handle Update Fees
if (isset($_POST['action']) && $_POST['action'] == 'update_fees_by_admin') {
    $id = $_POST['fees_id'];
    $title = $auth->sanitize_data($_POST['title']);
    $description = $auth->sanitize_data($_POST['description']);
    $total_amount = $auth->sanitize_data($_POST['total_amount']);
    $issued_date = $auth->sanitize_data($_POST['issued_date']);
    $due_date = $auth->sanitize_data($_POST['due_date']);
    $fine = $auth->sanitize_data($_POST['fine']);
    $st_id = $auth->sanitize_data($_POST['st_id']);

    $auth->updateFeesByAdmin($id, $st_id, $title, $description, $total_amount, $issued_date, $due_date, $fine);
}

// Hnadle Fetch Result
if (isset($_POST['fetchResult']) && $_POST['fetchResult'] == 'fetchResult') {
    $output = '';
    $result = $auth->fetchResult();

    if ($result) {
        foreach ($result as $key => $value) {
            $output .= '<tr>
                        <td>' . ++$key . '</td>
                        <td>' . $value['st_name'] . '</td>
                        <td>' . $value['title'] . '</td>
                        <td>' . $value['obtained_marks'] . '</td>
                        <td>' . $value['teacher_note'] . '</td>
                        <td>' . $auth->timeAgo($value['crated_at']) . '</td>
                        <td>
                            <a href="#" id="' . $value['id'] . '" title="Edit result" class="text-primary editResultBtn"><i class="fas fa-edit fa-lg" data-toggle="modal" data-target="#editResultModal"></i></a>&nbsp;
                            <a href="#" id="' . $value['id'] . '" title="Delete result" class="text-danger dltresultBtn"><i class="fas fa-trash-alt fa-lg"></i></a>
                        </td>
                        </tr>';
        }

        echo $output;
    } else {
        echo '<h3 class="text-secondary text-center p-2">:( You have no result yet!</h3>';
    }
}

// Add Result By Ajax Request
if (isset($_POST['action']) && $_POST['action'] == 'add_result') {
    $st_id = $auth->sanitize_data($_POST['st_id']);
    $exam = $auth->sanitize_data($_POST['exam']);
    $note = $auth->sanitize_data($_POST['note']);
    $marks = $auth->sanitize_data($_POST['marks']);

    $auth->add_result($st_id, $exam, $note, $marks);
}

// Handle Delete Result
if (isset($_POST['result_del_id'])) {
    $id = $_POST['result_del_id'];

    $auth->deleteResult($id);
}

// Handle Edit Result
if (isset($_POST['action']) && $_POST['action'] == 'edit_result') {
    $id = $_POST['id'];

    $data = $auth->fetchResultById($id);

    echo json_encode($data);
}

// Handle Update Fees
if (isset($_POST['action']) && $_POST['action'] == 'update_result') {
    $id = $_POST['result_id'];
    $st_id = $auth->sanitize_data($_POST['st_id']);
    $exam = $auth->sanitize_data($_POST['exam']);
    $note = $auth->sanitize_data($_POST['note']);
    $marks = $auth->sanitize_data($_POST['grade']);

    $auth->updateResult($id, $st_id, $exam, $note, $marks);
}

// Fetch Contact Message
if (isset($_POST['fetchMsg']) && $_POST['fetchMsg'] == 'fetchMsg') {
    $output = '';
    $result = $auth->fetchContactMessage();

    if ($result) {
        foreach ($result as $key => $value) {
            $output .= '<tr>
                        <td>' . ++$key . '</td>
                        <td>' . $value['fname'] . ' ' . $value['lname'] . '</td>
                        <td>' . $value['email'] . '</td>
                        <td>' . $value['msg'] . '</td>
                        <td>' . $auth->timeAgo($value['created_at']) . '</td>
                        <td>' .
                ($value['replied'] == 0 ? '<a href="#" id="' . $value['id'] . '" title="Reply Message" class="text-danger replyBtn"><i class="fas fa-reply fa-lg" data-toggle="modal" data-target="#replyMsgModal"></i></a>' : '<span class="badge badge-success">Replied</span>')
                . '</td>
                        </tr>';
        }

        echo $output;
    } else {
        echo '<h3 class="text-secondary text-center p-2">:( You have no Contact Message yet!</h3>';
    }
}

// Fetch Contact Message By Id
if (isset($_POST['action']) && $_POST['action'] == 'fetchDataById') {
    $id = $_POST['id'];
    $data = $auth->fetchContactById($id);
    echo json_encode($data);
}

/// Reply Msg
if (isset($_POST['action']) && $_POST['action'] == 'reply_msg') {
    $id = $_POST['msg_id'];
    $email = $_POST['email'];
    $subject = $auth->sanitize_data($_POST['subject']);
    $msg = $auth->sanitize_data($_POST['message']);
    $auth->UpdateContactMessage($id);
    $auth->send_mail($email,$subject,$msg);
}
