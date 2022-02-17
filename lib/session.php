<?php

    session_start();
    require_once 'Auth.php';
    $student_obj = new Auth();

    if(!isset($_SESSION['user'])){
        header("location:index.php");
        die();
    }

    $login_email = $_SESSION['user'];
    $data = $student_obj->currentUser($login_email);

    // All Student Data

    $student = [
        'id'        => $data['st_id'],
        'name'      => $data['st_name'],
        'religion'  => $data['st_religion'],
        'address'  => $data['st_address'],
        'city'  => $data['st_city'],
        'id_num'  => $data['st_idnum'],
        'gender'  => $data['st_gender'],
        'phone'  => $data['st_phone'],
        'dob'  => $data['st_dob'],
        'bg'  => $data['st_blood'],
        'email'  => $data['st_email'],
        'country'  => $data['st_country'],
        'admission_date'  => $data['st_admissiondate'],
        'admission_number'  => $data['st_admissionnumber'],
        'roll'  => $data['st_roll'],
        'class'  => $data['cid'],
        'section'  => $data['st_section'],
        'photo' => $data['st_photo'],
        'father_name' => $data['st_father_name'],
        'mother_name' => $data['st_mother_name'],
        'father_phone' => $data['st_father_phone'],
        'mother_phone' => $data['st_mother_phone'],
        'father_occupation' => $data['st_father_occupation'],
        'mother_occupation' => $data['st_mother_occupation'],
        'login_email' => $data['st_login_email'],
        'password'  => $data['st_password'],
        'verified' => $data['verified'],
        'created' => $data['created_at']
    ];

    $fname = strtok($student['name'], " ");

    if($student['verified'] == 0){
        $verified = 'Not Verified';
    }else{
        $verified = 'Verified';
    }

    if($student['photo'] == null){
        $profile_photo = 'assets/img/avater.png';
    }else{
        $profile_photo = 'assets/img/'.$student['photo'];
    }

    $data = $student_obj->fetchClass();

    foreach ($data as $value) {
        if($student['class'] == $value['id']){
            $classname = $value['name'];
        }
    }

    $unpaid_fees = $student_obj->fetchFees(0, $student['id_num']);

    $paid_fees = $student_obj->fetchFees(1, $student['id_num']);
    $result = $student_obj->fetchResultByStudentId($student['id_num']);


    


?>