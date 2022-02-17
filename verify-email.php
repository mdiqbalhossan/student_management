<?php
    require_once 'lib/session.php';

    if(isset($_GET['email'])){
        $email = $_GET['email'];

        $student_obj->verifyEmail($email);
        header('location: profile.php');
        exit();
    }else{
        header('location:index.php');
        exit();
    }
?>