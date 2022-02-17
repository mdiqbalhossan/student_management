<?php

    session_start();
    require_once 'Auth.php';
    $auth = new Auth();

    if(!isset($_SESSION['email'])){
        header("location:index.php");
        die();
    }

    $login_email = $_SESSION['email'];
    $data = $auth->currentAdmin($login_email);

    $name  = $data['name'];

    $class = $auth->fetchClass();
    $subject = $auth->fetchSubject();
    $student = $auth->fetchStudent();
    $exam = $auth->fetchExam();

    $contact = $auth->fetchContactMessage(3,'0');

    // $groupByClass = 


?>