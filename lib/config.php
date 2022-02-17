<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
$instance_mail = new PHPMailer(true);
/****
 * 
 * Database Class
 * This class working for connect database and some helper 
 * Function
 * 
 */
    class Database{
        private $dsn = "mysql:host=localhost;dbname=db_student_management";
		private $dbuser = "root";
		private $dbpass = "";
		public $mail;
		public $conn;

        public function __construct()
        {
			global $instance_mail;
			$this->mail = $instance_mail;
            try {
                $this->conn = new PDO($this->dsn, $this->dbuser, $this->dbpass);
            } catch (PDOException $e) {
                echo "Error: ".$e->getMessage();
            }

            return $this->conn;

        }

        // Check Input & Sanitize input data
        public function sanitize_data($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);

            return $data;
        }

		// Mail Send
		public function send_mail($email,$subject,$body){
			try {
                $this->mail->isSMTP();
                $this->mail->Host = 'smtp.mailtrap.io';
                $this->mail->SMTPAuth = true;
                $this->mail->Port = 2525;
                $this->mail->Username = 'ef4113ce44efb0';
                $this->mail->Password = 'a0aff7124fdd5f';
                $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $this->mail->setFrom('admin@gmail.com', 'MD Iqbal Hossen');
                $this->mail->addAddress($email);
                $this->mail->isHTML(true);
                $this->mail->Subject = $subject;
                $this->mail->Body = $body;
                $this->mail->send();
            } catch (PDOException $e) {
                echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
            }
		}
        // Error Or Success Message Alert
        public function message($type, $message){
            $output='<div class="alert alert-'.$type.' alert-dismissible">
                     <button type="button" class="close" data-dismiss="alert">&times;</button>
                     <strong class="text-center">'.$message.'</strong>
                     </div>';

            return $output;
        }

        // Display Time InAgo Formate
        public function timeAgo($timestamp)
		{
			date_default_timezone_set('Asia/Dhaka');

			$timestamp = strtotime($timestamp) ? strtotime($timestamp) : $timestamp;

			$time = time() - $timestamp;

			switch ($time) {
				//second
				case $time <= 60:
					return 'Just Now!';
				// minute
				case $time >=60 && $time <3600:
					return (round($time/60) == 1) ? 'a minute ago' : round($time/60).' minutes ago';
				// hours
				case $time >=3600 && $time < 86400:
					return (round($time/3600) == 1) ? 'an hours ago' : round($time/3600).' hours ago';
				// Days
				case $time >=86400 && $time < 604800:
					return (round($time/86400) == 1) ? 'a days ago' : round($time/86400).' days ago';
				// Weeks
				case $time >=604800 && $time < 2600640:
					return (round($time/604800) == 1) ? 'a week ago' : round($time/604800).' weeks ago';
				// Months
				case $time >=2600640 && $time < 31207680:
					return (round($time/2600640) == 1) ? 'a month ago' : round($time/2600640).' months ago';
				// years
				case $time >=31207680:
					return (round($time/31207680) == 1) ? 'a year ago' : round($time/31207680).' years ago';
				default:
					// code...
					break;
			}

		}
    }



?>