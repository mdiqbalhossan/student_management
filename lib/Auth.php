<?php

require_once 'config.php';

/****
 * 
 * Auth Class
 * This class works for authentication system
 * Like Sign in, Sign Up, Forgot Password, Check Logged In
 * 
 */

class Auth extends Database
{
    //  Register a new user
    public function register($name, $email, $password)
    {
        $sql = "INSERT INTO student(st_name,st_login_email,st_password) VALUES(:name, :email, :password)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name, 'email' => $email, 'password' => $password]);
        return true;
    }

    // check if user already registered
    public function user_exists($email)
    {
        $sql = "SELECT st_login_email FROM student WHERE st_login_email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    // Login Existing User
    public function login($email)
    {
        $sql = "SELECT st_login_email,st_password FROM student WHERE st_login_email = :email AND deleted != 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    // Current User Details in Session
    public function currentUser($email)
    {
        $sql = "SELECT * FROM student WHERE st_login_email = :email AND deleted != 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    // Forgot Password
    public function forgotPassword($token, $email)
    {
        $sql = "UPDATE student SET token = :token, token_exp = DATE_ADD(NOW(), INTERVAL 5 MINUTE) WHERE st_login_email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['token' => $token, 'email' => $email]);

        return true;
    }

    // Reset Password
    public function resetPassword($email, $token)
    {
        $sql = "SELECT st_id FROM student WHERE st_login_email = :email AND token = :token AND token != '' AND token_exp > NOW() AND deleted != 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email, 'token' => $token]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    // Update New Password
    public function updatePassword($pass, $email)
    {
        $sql = "UPDATE student SET token='', st_password = :pass WHERE st_login_email = :email AND deleted != 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['pass' => $pass, 'email' => $email]);
        return true;
    }

    // Verify email of an user
    public function verifyEmail($email)
    {
        $sql = "UPDATE student SET verified = 1 WHERE st_login_email = :email AND deleted != 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);

        return true;
    }

    // Fetech fecthNotice
    public function fecthNotice()
    {
        $sql = "SELECT * FROM notice ORDER BY id DESC LIMIT 5";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
    }

    // Fetch Materials
    public function fetchMaterials($cid)
    {
        $sql = "SELECT * FROM materials WHERE cid = :cid ORDER BY id DESC LIMIT 10";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['cid' => $cid]);

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }

    // Fetch Upcoming Action
    public function fetchUpcoming($type, $cid)
    {
        $sql = "SELECT * FROM timetable WHERE cid = :cid AND type = :type AND (date = CURDATE() OR date > CURDATE()) ORDER BY id ASC LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['cid' => $cid, 'type' => $type]);

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
    }

    // Fetch Latest Reult
    public function fetchLatestResult($st_id)
    {
        $sql = "SELECT result.*,timetable.title FROM result 
        INNER JOIN timetable ON result.exam_id = timetable.id WHERE student_id = :st_id ORDER BY id DESC LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['st_id' => $st_id]);

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
    }

    // Fetch Result For Student
    public function fetchResultByStudentId($st_id)
    {
        $sql = "SELECT result.*,timetable.title FROM result 
        INNER JOIN timetable ON result.exam_id = timetable.id WHERE student_id = :st_id ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['st_id' => $st_id]);

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
    }

    // Fetch Class
    public function fetchClass()
    {
        $sql = "SELECT * FROM class";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
    }

    // Change Pasword for an student
    public function changePassword($pass, $id)
    {
        $sql = "UPDATE student SET st_password = :password WHERE st_id = :id AND deleted != 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['password' => $pass, 'id' => $id]);
        return true;
    }

    // Update Profile
    public function updateProfile($name, $religion, $address, $city, $gender, $phone, $dob, $bg, $email, $country, $admission_date, $admission_number, $class, $section, $roll, $father_name, $mother_name, $father_mobile, $mother_mobile, $father_occupation, $mother_occupation, $photo, $id_num, $id)
    {
        $sql = "UPDATE student SET 
                    st_name = :name, 
                    st_religion = :religion, 
                    st_address = :address, 
                    st_city = :city, 
                    st_gender = :gender, 
                    st_phone = :phone, 
                    st_dob = :dob,
                    st_blood = :bg,
                    st_email = :email,
                    st_country = :country,
                    st_admissiondate = :admission_date,
                    st_admissionnumber  = :admission_number,
                    cid = :class,
                    st_section = :section,
                    st_roll = :roll,
                    st_father_name = :fname,
                    st_mother_name = :mname,
                    st_father_phone = :fphone,
                    st_mother_phone = :mphone,
                    st_father_occupation = :foccupation,
                    st_mother_occupation = :moccupation,
                    st_photo = :photo,
                    st_idnum = :id_num
                    WHERE st_id = :id AND DELETED != 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'name' => $name,
            'religion' => $religion,
            'address' => $address,
            'city' => $city,
            'gender' => $gender,
            'phone' => $phone,
            'dob' => $dob,
            'bg' => $bg,
            'email' => $email,
            'country' => $country,
            'admission_date' => $admission_date,
            'admission_number' => $admission_number,
            'class' => $class,
            'section' => $section,
            'roll' => $roll,
            'fname' => $father_name,
            'mname' => $mother_name,
            'fphone' => $father_mobile,
            'mphone' => $mother_mobile,
            'foccupation' => $father_occupation,
            'moccupation' => $mother_occupation,
            'photo' => $photo,
            'id_num' => $id_num,
            'id' => $id
        ]);
        return true;
    }

    // Fetch Notice Details By id
    public function fecthNoticeById($id)
    {
        $sql = "SELECT * FROM notice WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    // Fetch Materials Details By id
    public function fecthMaterialsById($id)
    {
        $sql = "SELECT * FROM materials WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }


    // Fetch Payable Fees
    public function fetchFees($type, $st_id)
    {
        $sql = "SELECT * FROM fees WHERE st_id = :st_id AND paid = :type ORDER BY id DESC LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['st_id' => $st_id, 'type' => $type]);

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
    }


    // Pay Fees
    public function pay($id, $amount, $date, $method, $tr, $note)
    {
        $sql = "UPDATE fees SET paid_amount=:amount, payment_method=:method,payment_date=:date,transaction_id=:tr,note=:note,paid=1 WHERE st_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['amount' => $amount, 'method' => $method, 'date' => $date, 'tr' => $tr, 'note' => $note, 'id' => $id]);
        return true;
    }

    public function fetchFessById($id)
    {
        $sql = "SELECT * FROM fees WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

//    Send Message
    public function send_message($id,$fname,$lname,$email,$msg){
        $sql = "INSERT INTO contact (student_id,fname,lname,email,msg) VALUES (:id, :fname, :lname, :email, :msg)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'fname' => $fname,
            'lname' => $lname,
            'email' => $email,
            'msg' => $msg
        ]);

        return true;

    }




    /***************************************************************************/
    /**************** Admin Action Section | Admin Area*************************/
    /***************************************************************************/

    // Admin Login
    public function admin_login($email, $password)
    {
        $sql = "SELECT * FROM admin WHERE email = :email AND password = :password";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email, 'password' => $password]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    // Current Admin Details in Session
    public function currentAdmin($email)
    {
        $sql = "SELECT * FROM admin WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    // Fetch all Student
    public function fetchStudent($limit = null)
    {
        if($limit != null){
            $limit = "LIMIT {$limit}";
        }else{
            $limit = "";
        }
        $sql = "SELECT student.*, class.name FROM student INNER JOIN class ON student.cid=class.id WHERE student.deleted != 1 ORDER BY student.st_id DESC {$limit}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
    }

    public function latestRegisterStudent(){
        $sql = "SELECT COUNT(*) FROM student WHERE YEARWEEK(created_at) = YEARWEEK(NOW())";
        $stmt = $this->conn->prepare($sql);
        $count = $stmt->execute();
        // $count = $stmt->rowCount();
        return $count;
    }

    // Admit Student By Admin
    public function admit_student(array $student)
    {
        $prep = array();
        foreach ($student as $key => $value) {
            $prep[':' . $key] = $value;
        }

        $sql = "INSERT INTO student (" . implode(', ', array_keys($student)) . ") VALUES (" . implode(', ', array_keys($prep)) . ")";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($prep);

        return true;
    }

    // Fetch Student Details By id
    public function fetchStudentDetailsById($id)
    {
        $sql = "SELECT student.*, class.name FROM student INNER JOIN class ON student.cid=class.id WHERE student.st_id = :id AND student.deleted != 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // Deleted an Student

    public function studentAction($id, $val)
    {
        $sql = "UPDATE student SET deleted = $val WHERE st_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);

        return true;
    }


    // Fetch Notice By admin
    public function fetchNotice()
    {
        $sql = "SELECT * FROM notice ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // Add New Notice
    public function add_notice($title, $details = '', $file = '')
    {
        $sql = "INSERT INTO notice (title,details,file) VALUES (:title, :details, :file)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['title' => $title, 'details' => $details, 'file' => $file]);
        return true;
    }

    // Delete notice by an admin
    public function deleteNotice($id)
    {
        $sql = "DELETE FROM notice WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return true;
    }

    // Update Notice
    public function update_notice($title, $details = '', $file = '', $id)
    {
        $sql = "UPDATE notice SET title = :title, details = :details, file = :file WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['title' => $title, 'details' => $details, 'file' => $file, 'id' => $id]);
        return true;
    }

    // Fetch Materials By admin
    public function fetchMaterialsAll()
    {
        $sql = "SELECT materials.*,class.name FROM materials INNER JOIN class ON materials.cid = class.id ORDER BY materials.id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // Fetch Material By id

    public function fetchMaterialsById($id)
    {
        $sql = "SELECT * FROM materials WHERE id = :id ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    // Add New Materials
    public function add_materials($title, $details = '', $file = '', $class)
    {
        $sql = "INSERT INTO materials (title,materials,file, cid) VALUES (:title, :details, :file, :cid)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['title' => $title, 'details' => $details, 'file' => $file, 'cid' => $class]);
        return true;
    }

    // Delete Materials by an admin
    public function deleteMaterials($id)
    {
        $sql = "DELETE FROM materials WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return true;
    }

    // Update Materials
    public function update_materials($title, $details = '', $file = '', $id, $class)
    {
        $sql = "UPDATE materials SET title = :title, materials = :details, file = :file, cid =:cid WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['title' => $title, 'details' => $details, 'file' => $file, 'id' => $id, 'cid' => $class]);
        return true;
    }

    // Add Class

    public function add_class($name)
    {
        $sql = "INSERT INTO class (name) VALUES (:name)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name]);

        return true;
    }

    // Fetch Class By id
    public function fetchClassById($id)
    {
        $sql = "SELECT * FROM class WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    // Update Class
    public function update_class($name, $id)
    {
        $sql = "UPDATE class SET name = :name WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name, 'id' => $id]);

        return true;
    }

    // Delete Class by an admin
    public function deleteClass($id)
    {
        $sql = "DELETE FROM class WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return true;
    }

    // Fetch Sybject By admin
    public function fetchSubject()
    {
        $sql = "SELECT subject.*,class.name FROM subject INNER JOIN class ON subject.cid = class.id ORDER BY subject.id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    // Hndle Add Subject
    public function add_subject($name, $class)
    {
        $sql = "INSERT INTO subject (cid, subject) VALUES (:cid, :name)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['cid' => $class, 'name' => $name]);

        return true;
    }

    // Fetch Sunbject By id
    public function fetchSubjectById($id)
    {
        $sql = "SELECT * FROM subject WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    // Update Class
    public function update_subject($name, $cid, $id)
    {
        $sql = "UPDATE subject SET subject = :name, cid = :cid WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name, 'cid' => $cid, 'id' => $id]);

        return true;
    }

    // Delete Sub by an admin
    public function deleteSub($id)
    {
        $sql = "DELETE FROM subject WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return true;
    }

    // Fetch Exam
    public function fetchExam()
    {
        $sql = "SELECT timetable.*,class.name FROM timetable INNER JOIN class ON timetable.cid = class.id WHERE timetable.type = 'exam' ORDER BY timetable.id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // Add Exam

    public function addExam(array $data)
    {
        $prep = array();
        foreach ($data as $key => $value) {
            $prep[':' . $key] = $value;
        }

        $sql = "INSERT INTO timetable (" . implode(', ', array_keys($data)) . ") VALUES (" . implode(', ', array_keys($prep)) . ")";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($prep);

        return true;
    }

    // Delete Exam by an admin
    public function deleteExam($id)
    {
        $sql = "DELETE FROM timetable WHERE id = :id AND type = 'exam'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return true;
    }

    // Fetch Exam By id
    public function fetchExamByID($id)
    {
        $sql = "SELECT * FROM timetable WHERE id = :id AND type = 'exam'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    // Update Exam
    public function updateExam($id, $class, $title, $des, $date, $stime, $etime)
    {
        $sql = "UPDATE timetable SET title = :title, cid = :cid, description = :description, date = :date, start_time = :stime, end_time = :etime WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['cid' => $class, 'title' => $title, 'description' => $des, 'date' => $date, 'stime' => $stime, 'etime' => $etime, 'id' => $id]);

        return true;
    }

    // Fetch Exam
    public function fetchClassSchedule()
    {
        $sql = "SELECT timetable.*,class.name FROM timetable 
        INNER JOIN class ON timetable.cid = class.id WHERE timetable.type = 'class' ORDER BY timetable.id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // Add Schedule Class

    public function addScheduleClass(array $data)
    {
        $prep = array();
        foreach ($data as $key => $value) {
            $prep[':' . $key] = $value;
        }

        $sql = "INSERT INTO timetable (" . implode(', ', array_keys($data)) . ") VALUES (" . implode(', ', array_keys($prep)) . ")";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($prep);

        return true;
    }

    // Delete Class Schedule by an admin
    public function deleteClassSchedule($id)
    {
        $sql = "DELETE FROM timetable WHERE id = :id AND type = 'class'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return true;
    }

    // Fetch Class Schedule By id
    public function fetchClassScheduleById($id)
    {
        $sql = "SELECT * FROM timetable WHERE id = :id AND type = 'class'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    // Update Class Schedule
    public function updateClassSchedule($id, $class, $title, $des, $date, $stime, $etime)
    {
        $sql = "UPDATE timetable SET title = :title, cid = :cid, description = :description, date = :date, start_time = :stime, end_time = :etime WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['cid' => $class, 'title' => $title, 'description' => $des, 'date' => $date, 'stime' => $stime, 'etime' => $etime, 'id' => $id]);

        return true;
    }
    // Fetch all Student
    public function fetchDeletedStudent()
    {
        $sql = "SELECT student.*, class.name FROM student INNER JOIN class ON student.cid=class.id WHERE student.deleted != 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
    }

    // Fetch all Fees
    public function fetchAllFees()
    {
        $sql = "SELECT fees.*, student.st_name FROM fees INNER JOIN student ON fees.st_id = student.st_idnum ORDER BY fees.id DESC";
        //$sql = "SELECT * FROM fees";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
    }

    // Add New Fees By Admin
    public function add_fees($st_id, $title, $description, $total, $issued, $due, $fine)
    {
        $sql = "INSERT INTO fees (st_id,title,description,total_amount,issued_date,due_date,fine) VALUES (:st_id,:title,:description,:total,:issued,:due,:fine)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'st_id' => $st_id,
            'title' => $title,
            'description' => $description,
            'total' => $total,
            'issued' => $issued,
            'due' => $due,
            'fine' => $fine
        ]);

        return true;
    }

    // Delete Fee by an admin
    public function deleteFees($id)
    {
        $sql = "DELETE FROM fees WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return true;
    }

    // Fetch Fees By id
    public function fetchFeesById($id)
    {
        $sql = "SELECT fees.*, student.st_name FROM fees INNER JOIN student ON fees.st_id = student.st_idnum WHERE fees.id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    // Update Class Schedule
    public function updateFeesByAdmin($id, $st_id, $title, $description, $total, $issued, $due, $fine)
    {
        $sql = "UPDATE fees SET st_id = :st_id, title = :title, description = :description, total_amount = :total_amount, issued_date = :issued_date, due_date = :due_date, fine = :fine WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['st_id' => $st_id, 'title' => $title, 'description' => $description, 'total_amount' => $total, 'issued_date' => $issued, 'due_date' => $due, 'fine' => $fine, 'id' => $id]);

        return true;
    }

    // Fetch Exam
    public function fetchResult()
    {
        $sql = "SELECT result.*,student.st_name,timetable.title,timetable.type FROM result 
        INNER JOIN student ON result.student_id = student.st_idnum
        INNER JOIN timetable ON result.exam_id = timetable.id ORDER BY result.id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // Add Result
    public function add_result($st_id, $exam, $note, $marks)
    {
        try {
            $sql = "INSERT INTO result (student_id,exam_id,obtained_marks,teacher_note) VALUES (:st_id, :exam, :marks, :note)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'st_id' => $st_id,
                'exam' => $exam,
                'marks' => $marks,
                'note' => $note
            ]);
    
            return true;
        } catch (PDOException $e) {
            return var_dump($e->getMessage());
        }
    }

    // Delete Result By Admin
    public function deleteResult($id)
    {
        $sql = "DELETE FROM result WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return true;
    }

//    Fetch Result By Id
    public function fetchResultById($id)
    {
        $sql = "SELECT result.*,student.st_name,timetable.title,timetable.type FROM result 
        INNER JOIN student ON result.student_id = student.st_idnum
        INNER JOIN timetable ON result.exam_id = timetable.id WHERE result.id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

//    Update Result By Id
    public function updateResult($id, $st_id, $exam, $note, $marks)
    {
        $sql = "UPDATE result SET student_id = :st_id, exam_id = :exam, obtained_marks = :marks, teacher_note = :note WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'st_id' => $st_id,
            'exam' => $exam,
            'marks' => $marks,
            'note' => $note,
            'id' => $id
        ]);
        return true;
    }

//    Fetch Contact Message
    public function fetchContactMessage($limit = "", $replied="")
    {
        if($limit != null && $replied != null){
            $sql = "SELECT * FROM contact WHERE replied = $replied ORDER BY id DESC LIMIT $limit";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $row;
        }else{
            $sql = "SELECT * FROM contact ORDER BY id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $row;
        }
    }

//    Fetch Contact By Id
    public function fetchContactById($id)
    {
        $sql = "SELECT * FROM contact WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }
    
//    Update Contact
    public function UpdateContactMessage($id)
    {
        $sql = "UPDATE contact SET replied = :replied WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['replied' => 1, 'id' => $id]);

        return true;
    }

    // Count UnReplied Contact Message
    public function tableRowcount($table, $column = "", $condition = ""){


        if($column != null && $condition != null){
            $sql = "SELECT * FROM $table WHERE $column = :condition";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['condition' => $condition]);
            $count = $stmt->rowCount();
            return $count;
        }else{
            $sql = "SELECT * FROM $table";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $count = $stmt->rowCount();
            return $count;
        }
    }

    // Total Fees Count
    public function totalCollectFees(){
        $sql = "SELECT SUM(paid_amount) AS total FROM fees";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $total = $row['total'];
        return $total;
    }

    // Count Student Group By Class
    public function groupByClass(){
        $sql = "SELECT student.cid,class.name,COUNT(*) as total FROM student INNER JOIN class ON student.cid = class.id GROUP BY student.cid";        $stmt = $this->conn->prepare($sql);
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    // Public function total amount for chart
    public function totalfees(){
        $sql = "SELECT SUM(paid_amount) as paid_total, SUM(total_amount) as total, DATE_FORMAT(created_at, \"%M\") as month FROM fees GROUP BY MONTH(payment_date)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}
