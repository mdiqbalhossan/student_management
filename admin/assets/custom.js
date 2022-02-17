$(document).ready(function () {
  // Handle Logout With Ajax request
  $("#logout").click(function (e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: { action: "admin_logout" },
      success: function (response) {
        if (response == "logout") {
          window.location = "index.php";
        }
      }
    });
  });

  // Fetch All Student
  fetchStudent();
  function fetchStudent() {
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: { fetchStudent: "fetchStudent" },
      success: function (response) {
        $("#student").html(response);
      }
    });
  }

  // Fetch Student By Id
  $("body").on("click", ".infoBtn", function (e) {
    e.preventDefault();

    id = $(this).attr("id");
    $.ajax({
      url: "../lib/action.php",
      type: "POST",
      data: { action: "fetchById", id: id },
      success: function (response) {
        data = JSON.parse(response);
        $("#getIdNum").text("ID Num: " + data.st_idnum + "");
        $("#name").text("Name : " + data.st_name);
        $("#email").text("E-mail : " + data.st_email);
        $("#gender").text("Gender : " + data.st_gender);
        $("#phone").text("Phone : " + data.st_phone);
        $("#dob").text("Date Of Birth : " + data.st_dob);
        $("#religion").text("Religion : " + data.st_religion);
        $("#address").text("Address : " + data.st_address);
        $("#city").text("City : " + data.st_city);
        $("#country").text("Country : " + data.st_country);
        $("#bg").text("Blood Group : " + data.st_blood);
        $("#verified").text("Verified : " + data.verified);
        $("#date").text("Admission Date : " + data.st_admissiondate);
        $("#number").text("Admission Number : " + data.st_admissionnumber);
        $("#roll").text("Roll : " + data.st_roll);
        $("#class").text("Class : " + data.name);
        $("#sec").text("Section : " + data.st_section);
        $("#fname").text("Father Name : " + data.st_father_name);
        $("#fphone").text("Father Phone : " + data.st_father_phone);
        $("#foccupation").text(
          "Father Occupation : " + data.st_father_occupation
        );
        $("#mname").text("Mother Name : " + data.st_mother_name);
        $("#mphone").text("Mother Phone : " + data.st_mother_phone);
        $("#moccupation").text(
          "Mother Occupation : " + data.st_mother_occupation
        );
        $("#login_email").text("Login Email : " + data.st_login_email);
        $("#password").text("Default Pasword : 123456");

        if (data.st_photo != "") {
          img =
            '<img src="../../assets/img/' +
            data.st_photo +
            '" class="img-fluid rounded-circle img-thumbnail" width="150px">';
          $("#image").html(img);
        } else {
          img =
            '<img src="../assets/img/avater.png" class="img-fluid rounded-circle img-thumbnail" width="150px">';
          $("#image").html(img);
        }
      }
    });
  });

  // Delete a Student of an admin Ajax Request
  $("body").on("click", ".dltBtn", function (event) {
    event.preventDefault();

    del_id = $(this).attr("id");
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to delete this!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: "../lib/action.php",
          type: "POST",
          data: { action: "delete_student", del_id: del_id },
          success: function (response) {
            Swal.fire(
              "Deleted!",
              "User has been deleted succesfully.",
              "success"
            );
            fetchStudent();
          }
        });
      }
    });
  });

  // Admit Student by an user
  $("#next-1").click(function (event) {
    event.preventDefault();
    $("#nameErr").html("");
    $("#emailErr").html("");
    $("#genderErr").html("");
    $("#dobErr").html("");
    $("#religionErr").html("");
    $("#phoneErr").html("");
    $("#addressErr").html("");
    $("#cityErr").html("");
    $("#countryErr").html("");

    if ($("#name").val() == "") {
      $("#nameErr").html(" * name is required!");
      return false;
    } else if (!isNaN($("#name").val())) {
      $("#nameErr").html(" * Numbers are not allowed!");
      return false;
    } else if ($("#email").val() == "") {
      $("#emailErr").html(" * email is required!");
      return false;
    } else if (!validateEmail($("#email").val())) {
      $("#emailErr").html(" * email is not valid!");
      return false;
    } else if ($("#phone").val() == "") {
      $("#phoneErr").html(" * Phone Number is required!");
      return false;
    } else if (isNaN($("#phone").val())) {
      $("#phoneErr").html(" * phone is not valid.Only Numbers are allowed!");
      return false;
    } else if ($("#phone").val().length != 11) {
      $("#phoneErr").html(" * phone number must be of more than 11 character!");
      return false;
    } else if ($("#gender").val() == "") {
      $("#genderErr").html(" * Gender is required!");
      return false;
    } else if ($("#dob").val() == "") {
      $("#dobErr").html(" * Date Of Birth is Required!");
      return false;
    } else if ($("#religion").val() == "") {
      $("#religionErr").html(" * Religion is required!");
      return false;
    } else if ($("#address").val() == "") {
      $("#addressErr").html(" * Address is required!");
      return false;
    } else if ($("#city").val() == "") {
      $("#cityErr").html(" * City is required!");
      return false;
    } else if ($("#country").val() == "") {
      $("#countryErr").html(" * Country is required!");
      return false;
    } else {
      $("#second").show();
      $("#first").hide();
      $("#progressBar").css("width", "50%");
      $("#progressBarText").html("Step-2");
    }
  });

  $("#next-2").click(function (event) {
    event.preventDefault();

    $("#admission_dateErr").html("");
    $("#admission_numberErr").html("");
    $("#classErr").html("");
    $("#rollErr").html("");

    if ($("#admission_date").val() == "") {
      $("#admission_dateErr").html(" * Admission Date is Required!");
      return false;
    } else if ($("#admission_number").val() == "") {
      $("#admission_numberErr").html(" * Admission Number is Required!");
      return false;
    } else if (isNaN($("#admission_number").val())) {
      $("#admission_numberErr").html(
        " * phone is not valid.Only Numbers are allowed!"
      );
      return false;
    } else if ($("#admission_number").val().length != 6) {
      $("#admission_numberErr").html(
        " * Admission number must be of 6 character!"
      );
      return false;
    } else if ($("#class").val() == "") {
      $("#classErr").html(" * Class is Required!");
      return false;
    } else if ($("#roll").val() == "") {
      $("#rollErr").html(" * Roll Number is Required!");
      return false;
    } else if (isNaN($("#roll").val())) {
      $("#rollErr").html(" * roll is not valid.Only Numbers are allowed!");
      return false;
    } else {
      $("#second").hide();
      $("#third").show();
      $("#progressBar").css("width", "75%");
      $("#progressBarText").html("Step-3");
    }
  });

  $("#next-3").click(function (e) {
    e.preventDefault();

    $("#father_nameErr").html("");
    $("#father_phoneErr").html("");
    $("#mother_nameErr").html("");
    $("#mother_phoneErr").html("");

    if ($("#father_name").val() == "") {
      $("#father_nameErr").html("* Father Name is Required!");
      return false;
    } else if ($("#father_phone").val() == "") {
      $("#father_phoneErr").html(" * Phone Number is required!");
      return false;
    } else if (isNaN($("#father_phone").val())) {
      $("#father_phoneErr").html(
        " * phone is not valid.Only Numbers are allowed!"
      );
      return false;
    } else if ($("#father_phone").val().length != 11) {
      $("#father_phoneErr").html(
        " * phone number must be of more than 11 character!"
      );
      return false;
    } else if ($("#mother_name").val() == "") {
      $("#mother_nameErr").html("* Mother Name is Required!");
      return false;
    } else if ($("#mother_phone").val() == "") {
      $("#mother_phoneErr").html(" * Phone Number is required!");
      return false;
    } else if (isNaN($("#mother_phone").val())) {
      $("#mother_phoneErr").html(
        " * phone is not valid.Only Numbers are allowed!"
      );
      return false;
    } else if ($("#mother_phone").val().length != 11) {
      $("#mother_phoneErr").html(
        " * phone number must be of more than 11 character!"
      );
      return false;
    } else {
      $("#third").hide();
      $("#fourth").show();
      $("#progressBar").css("width", "100%");
      $("#progressBarText").html("Step-4");
    }
  });

  $("#form-data").submit(function (e) {
    e.preventDefault();
    $("#submit").val("Please Wait...");

    if ($("#login_email").val() == "") {
      $("#login_emailErr").html(" * login email is required!");
      return false;
    } else if (!validateEmail($("#login_email").val())) {
      $("#login_emailErr").html(" * login email is not valid!");
      return false;
    } else if ($("#password").val() == "") {
      $("#passwordErr").html(" * Password is required!");
      return false;
    } else if ($("#password").val().length < 6) {
      $("#passwordErr").html(
        " * phone number must be of more than 6 character!"
      );
      return false;
    } else {
      $.ajax({
        url: "../lib/action.php",
        type: "POST",
        processData: false,
        contentType: false,
        cache: false,
        data: new FormData(this),
        success: function (response) {
          // $("#result").show();
          // $("#result").html(response);
          $("#form-data")[0].reset();
          $("#submit").val("Add Student");
          if (response == "done") {
            Swal.fire({
              title: "Student Admited Succesfully!",
              type: "success"
            });
            setTimeout(function () {
              window.location = "student.php";
            }, 2000);
          } else {
            Swal.fire({
              title: "This email is already register!",
              type: "danger"
            });
            setTimeout(function () {
              window.location = "student.php";
            }, 2000);
          }
        }
      });
    }
  });

  $("#prev-2").click(function (event) {
    event.preventDefault();
    $("#second").hide();
    $("#first").show();
    $("#progressBar").css("width", "25%");
    $("#progressBarText").html("Step-1");
  });

  $("#prev-3").click(function (event) {
    event.preventDefault();
    $("#second").show();
    $("#third").hide();
    $("#progressBar").css("width", "50%");
    $("#progressBarText").html("Step-2");
  });

  $("#prev-4").click(function (event) {
    event.preventDefault();
    $("#third").show();
    $("#fourth").hide();
    $("#progressBar").css("width", "75%");
    $("#progressBarText").html("Step-3");
  });

  function validateEmail($email) {
    var eamilReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return eamilReg.test($email);
  }

  // Fetch All Notice
  fetchNotice();
  function fetchNotice() {
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: { fetchNotice: "fetchNotice" },
      success: function (response) {
        $("#notice_body").html(response);
      }
    });
  }

  // Handle Add Notice Ajax Request
  $("#addnotice_form").submit(function (e) {
    e.preventDefault();
    $("#addnotice_btn").val("Please Wait...");
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      processData: false,
      contentType: false,
      cache: false,
      data: new FormData(this),
      success: function (response) {
        $("#addnotice_btn").val("Add Notice");
        $("#addnotice_form")[0].reset();
        $("#addNoticeModal").modal("hide");
        Swal.fire({
          title: "Note added Succesfully!",
          type: "success"
        });
        fetchNotice();
      }
    });
  });

  // Show Notice By id in details
  $("body").on("click", ".notice_info_btn", function (e) {
    e.preventDefault();
    id = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: { action: "notice_details_by_id", id: id },
      success: function (response) {
        data = JSON.parse(response);
        $("#getTitle").text("Title: " + data.title);
        $("#getTitlebody").text("Title: " + data.title);
        $("#getTime").text("Published On: " + data.created_at);
        if (data.details == "") {
          $file =
            '<a href="../assets/img/' + data.file + '">' + data.file + "</a>";
          $("#getBody").html($file);
        } else if (data.details != "" && data.file != "") {
          $show =
            '<p class="text-center text-secondary">' +
            data.details +
            '</p><hr><a href="../assets/img/' +
            data.file +
            '">' +
            data.file +
            "</a>";
          $("#getBody").html($show);
        } else {
          $("#getBody").text(data.details);
        }
      }
    });
  });

  // Delete a notice of an user Ajax Request
  $("body").on("click", ".dltnoticeBtn", function (event) {
    event.preventDefault();

    del_notice_id = $(this).attr("id");
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: "../lib/action.php",
          type: "POST",
          data: { del_notice_id: del_notice_id },
          success: function (response) {
            Swal.fire(
              "Deleted!",
              "Your Notice has been deleted succesfully.",
              "success"
            );
            fetchNotice();
          }
        });
      }
    });
  });

  // Edit Notice of an admin Ajax Requests
  $("body").on("click", ".editNoticeBtn", function (e) {
    e.preventDefault();
    edit_id = $(this).attr("id");
    $.ajax({
      url: "../lib/action.php",
      type: "POST",
      data: { edit_notice_id: edit_id },
      success: function (response) {
        data = JSON.parse(response);
        $("#id").val(data.id);
        $("#title").val(data.title);
        $("#details").val(data.details);
        $("#old_file").val(data.file);
      }
    });
  });

  // Update Note Ajax Request
  $("#editnotice_form").submit(function (event) {
    event.preventDefault();

    $("#updatenotice_btn").val("Please Wait.....");
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      processData: false,
      contentType: false,
      cache: false,
      data: new FormData(this),
      success: function (response) {
        $("#updatenotice_btn").val("Update Notice");
        $("#editnotice_form")[0].reset();
        $("#editNoticeModal").modal("hide");
        Swal.fire({
          title: "Notice Updated Succesfully!",
          type: "success"
        });
        fetchNotice();
      }
    });
  });

  // Fetch All Materials
  fetchMaterials();
  function fetchMaterials() {
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: { fetchMaterials: "fetchMaterials" },
      success: function (response) {
        $("#materials_body").html(response);
      }
    });
  }

  // Handle Add Notice Ajax Request
  $("#addmaterials_form").submit(function (e) {
    e.preventDefault();
    $("#addmaterials_btn").val("Please Wait...");
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      processData: false,
      contentType: false,
      cache: false,
      data: new FormData(this),
      success: function (response) {
        $("#addmaterials_btn").val("Add Notice");
        $("#addmaterials_form")[0].reset();
        $("#addMaterialsModal").modal("hide");
        Swal.fire({
          title: "Materials added Succesfully!",
          type: "success"
        });
        fetchMaterials();
      }
    });
  });

  // Show Notice By id in details
  $("body").on("click", ".materials_info_btn", function (e) {
    e.preventDefault();
    id = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: { action: "materials_details_by_id", id: id },
      success: function (response) {
        data = JSON.parse(response);
        $("#getMaterialsTitle").text("Title: " + data.title);
        $("#getTitlebody").text("Title: " + data.title);
        $("#getTime").text("Published On: " + data.created_at);
        if (data.materials == "") {
          $file =
            '<a href="../assets/img/' + data.file + '">' + data.file + "</a>";
          $("#getBody").html($file);
        } else if (data.materials != "" && data.file != "") {
          $show =
            '<p class="text-center text-secondary">' +
            data.materials +
            '</p><hr><a href="../assets/img/' +
            data.file +
            '">' +
            data.file +
            "</a>";
          $("#getBody").html($show);
        } else {
          $("#getBody").text(data.materials);
        }

        // console.log(response);
      }
    });
  });

  // Delete a notice of an user Ajax Request
  $("body").on("click", ".dltMaterialsBtn", function (event) {
    event.preventDefault();

    del_materials_id = $(this).attr("id");
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: "../lib/action.php",
          type: "POST",
          data: { del_materials_id: del_materials_id },
          success: function (response) {
            Swal.fire(
              "Deleted!",
              "Your Materials has been deleted succesfully.",
              "success"
            );
            fetchMaterials();
          }
        });
      }
    });
  });

  // Edit Mayerials of an admin Ajax Requests
  $("body").on("click", ".editMaterialsBtn", function (e) {
    e.preventDefault();
    edit_id = $(this).attr("id");
    $.ajax({
      url: "../lib/action.php",
      type: "POST",
      data: { edit_materials_id: edit_id },
      success: function (response) {
        data = JSON.parse(response);
        $("#id").val(data.id);
        $("#title").val(data.title);
        $("#details").val(data.materials);
        $("#old_file").val(data.file);
      }
    });
  });

  // Update Materiasl Ajax Request
  $("#editmaterials_form").submit(function (event) {
    event.preventDefault();

    $("#updatematerials_btn").val("Please Wait.....");
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      processData: false,
      contentType: false,
      cache: false,
      data: new FormData(this),
      success: function (response) {
        $("#updatematerials_btn").val("Update Notice");
        $("#editmaterials_form")[0].reset();
        $("#editMaterialsModal").modal("hide");
        Swal.fire({
          title: "Materials Updated Succesfully!",
          type: "success"
        });
        fetchMaterials();
      }
    });
  });

  // Fetch All Class
  fetchClass();
  function fetchClass() {
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: { fetchClass: "fetchClass" },
      success: function (response) {
        $("#class_body").html(response);
      }
    });
  }

  // Handle Add Class Ajax Request
  $("#addclass_btn").click(function (e) {
    e.preventDefault();
    $("#addclass_btn").val("Please Wait...");
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: $("#addclass_form").serialize() + "&action=add_class",
      success: function (response) {
        $("#addclass_btn").val("Add Class");
        $("#addclass_form")[0].reset();
        $("#addClassModal").modal("hide");
        Swal.fire({
          title: "Class Added Succesfully!",
          type: "success"
        });
        fetchClass();
      }
    });
  });

  // Hnadle Edite class
  $("body").on("click", ".editclassBtn", function (e) {
    e.preventDefault();
    id = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: { action: "edit_class", id: id },
      success: function (response) {
        data = JSON.parse(response);
        $("#id").val(data.id);
        $("#name").val(data.name);
      }
    });
  });

  // Hnadle  Update Class
  $("#editclass_btn").click(function (e) {
    e.preventDefault();
    $("#editclass_btn").val("Please Wait...");
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: $("#editclass_form").serialize() + "&action=update_class",
      success: function (response) {
        $("#editclass_btn").val("Update Class");
        $("#editclass_form")[0].reset();
        $("#editclassModal").modal("hide");
        Swal.fire({
          title: "Class Update Succesfully!",
          type: "success"
        });
        fetchClass();
      }
    });
  });

  // Handle Delete Class
  $("body").on("click", ".dltclassBtn", function (event) {
    event.preventDefault();

    del_class_id = $(this).attr("id");
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: "../lib/action.php",
          type: "POST",
          data: { del_class_id: del_class_id },
          success: function (response) {
            Swal.fire(
              "Deleted!",
              "Your Class has been deleted succesfully.",
              "success"
            );
            fetchClass();
          }
        });
      }
    });
  });

  // Fetch All Subject
  fetchSubject();
  function fetchSubject() {
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: { fetchSubject: "fetchSubject" },
      success: function (response) {
        $("#subject_body").html(response);
      }
    });
  }

  // Handle Add Subject Ajax Request
  $("#addsubject_btn").click(function (e) {
    e.preventDefault();
    $("#addsubject_btn").val("Please Wait...");
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: $("#addsubject_form").serialize() + "&action=add_subject",
      success: function (response) {
        $("#addsubject_btn").val("Add Class");
        $("#addsubject_form")[0].reset();
        $("#addSubjectModal").modal("hide");
        Swal.fire({
          title: "Subject Added Succesfully!",
          type: "success"
        });
        fetchSubject();
      }
    });
  });

  // Hnadle Edit Subject
  $("body").on("click", ".editSubjectBtn", function (e) {
    e.preventDefault();
    id = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: { action: "edit_subject", id: id },
      success: function (response) {
        data = JSON.parse(response);
        $("#subject_id").val(data.id);
        $("#subject").val(data.subject);
      }
    });
  });

  // Hnadle  Update Subject
  $("#editsubject_btn").click(function (e) {
    e.preventDefault();
    $("#editsubject_btn").val("Please Wait...");
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: $("#editsubject_form").serialize() + "&action=update_subject",
      success: function (response) {
        $("#editsubject_btn").val("Update Class");
        $("#editsubject_form")[0].reset();
        $("#editSubjectModal").modal("hide");
        Swal.fire({
          title: "Subject Update Succesfully!",
          type: "success"
        });
        fetchSubject();
      }
    });
  });

  // Handle Delete Class
  $("body").on("click", ".dltSubjectBtn", function (event) {
    event.preventDefault();

    del_sub_id = $(this).attr("id");
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: "../lib/action.php",
          type: "POST",
          data: { del_sub_id: del_sub_id },
          success: function (response) {
            Swal.fire(
              "Deleted!",
              "Your Subject has been deleted succesfully.",
              "success"
            );
            fetchSubject();
          }
        });
      }
    });
  });

  // Fetch All Exam
  fetchExam();
  function fetchExam() {
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: { fetchExam: "fetchExam" },
      success: function (response) {
        $("#exam_body").html(response);
      }
    });
  }

  // Add Exam Ajax Request
  $("#addexam_btn").click(function (e) {
    e.preventDefault();
    $("#addexam_btn").val("Please Wait...");
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: $("#addexam_form").serialize() + "&action=add_exam",
      success: function (response) {
        $("#addexam_btn").val("Add Exam");
        $("#addexam_form")[0].reset();
        $("#addExamModal").modal("hide");
        Swal.fire({
          title: "Exam Added Succesfully!",
          type: "success"
        });
        fetchExam();
      }
    });
  });

  // Delete Exam Ajax Request
  $("body").on("click", ".dltexamBtn", function (event) {
    event.preventDefault();

    del_exam_id = $(this).attr("id");
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: "../lib/action.php",
          type: "POST",
          data: { del_exam_id: del_exam_id },
          success: function (response) {
            Swal.fire(
              "Deleted!",
              "Your Exam has been deleted succesfully.",
              "success"
            );
            fetchExam();
          }
        });
      }
    });
  });

  // Display Exam In details
  $("body").on("click", ".examInfoBtn", function (e) {
    e.preventDefault();
    id = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: { action: "exam_details", id: id },
      success: function (response) {
        data = JSON.parse(response);
        $("#getExamTitle").text("Title: " + data.title);
        $("#getExamBodyTitle").text("Title: " + data.title);
        $("#getExamBody").text("Description: " + data.description);
        $("#getExamDate").text("Exam Date: " + data.date);
        $("#getExamStartTime").text("Start Time: " + data.start_time);
        $("#getExamEndTime").text("End Time: " + data.end_time);
        //console.log(data);
      }
    });
  });

  // Hnadle Edit Exam
  $("body").on("click", ".editexamBtn", function (e) {
    e.preventDefault();
    id = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: { action: "edit_exam", id: id },
      success: function (response) {
        data = JSON.parse(response);
        $("#exam_id").val(data.id);
        $("#title").val(data.title);
        $("#description").val(data.description);
        $("#date").val(data.date);
        $("#start_time").val(data.start_time);
        $("#end_time").val(data.end_time);
        $('#class_update option[value="' + data.cid + '"]').prop(
          "selected",
          true
        );
      }
    });
  });

  // Hnadle  Update Exam
  $("#updateexam_btn").click(function (e) {
    e.preventDefault();
    $("#updateexam_btn").val("Please Wait...");
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: $("#editexam_form").serialize() + "&action=update_exam",
      success: function (response) {
        $("#updateexam_btn").val("Update Class");
        $("#editexam_form")[0].reset();
        $("#editexamModal").modal("hide");
        Swal.fire({
          title: "Exam Update Succesfully!",
          type: "success"
        });
        fetchExam();
      }
    });
  });

  // Fetch Class Schedule
  fetchClassSchedule();
  function fetchClassSchedule() {
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: { fetchClassSchedule: "fetchClassSchedule" },
      success: function (response) {
        $("#schedule_body").html(response);
      }
    });
  }

  // Add Class Schedule Ajax Request
  $("#addclassschedule_btn").click(function (e) {
    e.preventDefault();
    $("#addclassschedule_btn").val("Please Wait...");
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data:
        $("#addclassschedule_form").serialize() + "&action=add_class_schedule",
      success: function (response) {
        $("#addclassschedule_btn").val("Add Exam");
        $("#addclassschedule_form")[0].reset();
        $("#addClassScheduleModal").modal("hide");
        Swal.fire({
          title: "Class Schedule Added Succesfully!",
          type: "success"
        });
        fetchClassSchedule();
        //console.log(response);
      }
    });
  });

  // Delete Class Schedule Ajax Request
  $("body").on("click", ".dltclass_scheduleBtn", function (event) {
    event.preventDefault();

    del_class_schedule_id = $(this).attr("id");
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: "../lib/action.php",
          type: "POST",
          data: { del_class_schedule_id: del_class_schedule_id },
          success: function (response) {
            Swal.fire(
              "Deleted!",
              "Your Class schedule has been deleted succesfully.",
              "success"
            );
            fetchClassSchedule();
            //console.log(response);
          }
        });
      }
    });
  });

  // Display Class Schedule In details
  $("body").on("click", ".class_scheduleInfoBtn", function (e) {
    e.preventDefault();
    id = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: { action: "classSchedule_details", id: id },
      success: function (response) {
        data = JSON.parse(response);
        $("#getclassScheduleTitle").text("Title: " + data.title);
        $("#getclassScheduleBodyTitle").text("Title: " + data.title);
        $("#getclassScheduleBody").text("Description: " + data.description);
        $("#getclassScheduleDate").text("Class Date: " + data.date);
        $("#getclassScheduleStartTime").text("Start Time: " + data.start_time);
        $("#getclassScheduleEndTime").text("End Time: " + data.end_time);
        //console.log(data);
      }
    });
  });

  // Hnadle Edit Class Schedule
  $("body").on("click", ".editclass_scheduleBtn", function (e) {
    e.preventDefault();
    id = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: { action: "edit_classSchedule", id: id },
      success: function (response) {
        data = JSON.parse(response);
        $("#classSchedule_id").val(data.id);
        $("#title").val(data.title);
        $("#description").val(data.description);
        $("#date").val(data.date);
        $("#start_time").val(data.start_time);
        $("#end_time").val(data.end_time);
        $('#class_update option[value="' + data.cid + '"]').prop(
          "selected",
          true
        );
      }
    });
  });

  // Hnadle  Update Class Schedule
  $("#updateclassSchedule_btn").click(function (e) {
    e.preventDefault();
    $("#updateclassSchedule_btn").val("Please Wait...");
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data:
        $("#editclassSchedule_form").serialize() +
        "&action=update_class_schedule",
      success: function (response) {
        $("#updateclassSchedule_btn").val("Update Class");
        $("#editclassSchedule_form")[0].reset();
        $("#editclassScheduleModal").modal("hide");
        Swal.fire({
          title: "Class Schedule Update Succesfully!",
          type: "success"
        });
        fetchClassSchedule();
      }
    });
  });

  // Fetch All Deleted Student
  fetchDeletedStudent();
  function fetchDeletedStudent() {
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: { fetchDeletedStudent: "fetchDeletedStudent" },
      success: function (response) {
        $("#deleted_student").html(response);
      }
    });
  }

  // Restore Student
  $("body").on("click", ".restore_btn", function (event) {
    event.preventDefault();

    restore_id = $(this).attr("id");
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to restore this!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, restored it!"
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: "../lib/action.php",
          type: "POST",
          data: { action: "restore_student", restore_id: restore_id },
          success: function (response) {
            Swal.fire(
              "Restored!",
              "User has been restored succesfully.",
              "success"
            );
            fetchDeletedStudent();
          }
        });
      }
    });
  });

  // Fetch All Fees
  fetchFees();
  function fetchFees() {
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: { fetchFees: "fetchFees" },
      success: function (response) {
        $("#fees_body").html(response);
      }
    });
  }

  // Add New Fees
  $("#addfees_btn").click(function (e) {
    e.preventDefault();

    $("#addfees_btn").val("Please Wait...");
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: $("#addfees_form").serialize() + "&action=add_fees",
      success: function (response) {
        $("#addfees_btn").val("Add Fees");
        $("#addfees_form")[0].reset();
        $("#addFeesModal").modal("hide");
        Swal.fire("Added!", "Fees Added Succesfully!.", "success");
        fetchFees();
      }
    });
  });

  // Delete Fees Ajax Request
  $("body").on("click", ".dltfeesBtn", function (event) {
    event.preventDefault();

    fees_id = $(this).attr("id");
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: "POST",
          url: "../lib/action.php",
          data: { fees_del_id: fees_id },
          success: function (response) {
            Swal.fire(
              "Deleted!",
              "Your Fees has been deleted succesfully.",
              "success"
            );
            fetchFees();
          }
        });
      }
    });
  });

  // Display Fees In details
  $("body").on("click", ".feesInfoBtn", function (e) {
    e.preventDefault();
    id = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: { action: "fees_details", id: id },
      success: function (response) {
        data = JSON.parse(response);
        $("#getStudentID").text("ID: " + data.st_id);
        $("#getStudentName").text("Name: " + data.st_name);
        $("#getFeesTitle").text("Title: " + data.title);
        $("#getFeesBody").text("Description: " + data.description);
        $("#getTotalAmount").text("Total Amount: " + data.total_amount);
        $("#getIssueDate").text("Issued Date: " + data.issued_date);
        $("#getDueDate").text("Due Date: " + data.due_date);
        $("#getFine").text("Fine: " + data.fine);
        //console.log(data);
      }
    });
  });

  // Display Paid Fees In details
  $("body").on("click", ".paidInfoBtn", function (e) {
    e.preventDefault();
    id = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: { action: "fees_details", id: id },
      success: function (response) {
        data = JSON.parse(response);
        $("#getPaidStudentID").text("ID: " + data.st_id);
        $("#getPaidStudentName").text("Name: " + data.st_name);
        $("#getPaidFeesTitle").text("Title: " + data.title);
        $("#getPaidNote").text("Note: " + data.note);
        $("#getPaidAmount").text("Paid Amount: " + data.paid_amount);
        $("#getPaymentDate").text("Payment Date: " + data.payment_date);
        $("#getPaymentMethod").text("Payment Method: " + data.payment_method);
        $("#getTrId").text("Tr. Id: " + data.transaction_id);
        //console.log(data);
      }
    });
  });

  // Hnadle Edit Class Schedule
  $("body").on("click", ".editfeesBtn", function (e) {
    e.preventDefault();
    id = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: { action: "edit_fees", id: id },
      success: function (response) {
        data = JSON.parse(response);
        $("#fees_id").val(data.id);
        $("#title").val(data.title);
        $("#total_amount").val(data.total_amount);
        $("#description").val(data.description);
        $("#issued_date").val(data.issued_date);
        $("#due_date").val(data.due_date);
        $("#fine").val(data.fine);
        $('#student_name_update option[value="' + data.st_id + '"]').prop(
          "selected",
          true
        );
      }
    });
  });

  // Hnadle  Update Fees
  $("#updatefees_btn").click(function (e) {
    e.preventDefault();
    $("#updatefees_btn").val("Please Wait...");
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: $("#editfees_form").serialize() + "&action=update_fees_by_admin",
      success: function (response) {
        $("#updatefees_btn").val("Update Class");
        $("#editfees_form")[0].reset();
        $("#editFeesModal").modal("hide");
        Swal.fire({
          title: "Fees Update Succesfully!",
          type: "success"
        });
        fetchFees();
        //console.log(response);
      }
    });
  });

  // Fetch All Result
  fetchResult();
  function fetchResult() {
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: { fetchResult: "fetchResult" },
      success: function (response) {
        $("#result_body").html(response);
      }
    });
  }

  // Add New Result
  $("#addresult_btn").click(function (e) {
    e.preventDefault();

    $("#addresult_btn").val("Please Wait...");
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: $("#addresult_form").serialize() + "&action=add_result",
      success: function (response) {
        $("#addresult_btn").val("Add Fees");
        $("#addresult_form")[0].reset();
        $("#addResultModal").modal("hide");
        Swal.fire("Added!", "Result Added Succesfully!.", "success");
        fetchResult();
        // console.log(response);
      }
    });
  });

  // Delete Result Ajax Request
  $("body").on("click", ".dltresultBtn", function (event) {
    event.preventDefault();

    result_id = $(this).attr("id");
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: "POST",
          url: "../lib/action.php",
          data: { result_del_id: result_id },
          success: function (response) {
            Swal.fire(
              "Deleted!",
              "Your Result has been deleted succesfully.",
              "success"
            );
            fetchResult();
          }
        });
      }
    });
  });

  // Handle Edit Result
  $("body").on("click", ".editResultBtn", function (e) {
    e.preventDefault();
    id = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: { action: "edit_result", id: id },
      success: function (response) {
        data = JSON.parse(response);
        $("#result_id").val(data.id);
        $("#note").val(data.teacher_note);
        $("#obtained_grade").val(data.obtained_marks);
        $('#student_id option[value="' + data.st_id + '"]').prop(
          "selected",
          true
        );
        $('#exam option[value="' + data.exam_id + '"]').prop("selected", true);
      }
    });
  });

  // Handle Update Result
  $("#editresult_btn").click(function (e) {
    e.preventDefault();
    $("#editresult_btn").val("Please Wait...");
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: $("#editresult_form").serialize() + "&action=update_result",
      success: function (response) {
        $("#editresult_btn").val("Update Class");
        $("#editresult_form")[0].reset();
        $("#editResultModal").modal("hide");
        Swal.fire({
          title: "Result Update Succesfully!",
          type: "success"
        });
        fetchResult();
        //console.log(response);
      }
    });
  });

  //Fetch Contact Message
  fetchMsg();
  function fetchMsg() {
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: { fetchMsg: "fetchMsg" },
      success: function (response) {
        $("#contact_body").html(response);
      }
    });
  }

  //Fetch Contact Data By id
  $("body").on('click','.replyBtn', function(){
    id = $(this).attr('id');
    $.ajax({
      type: "POST",
      url: "../lib/action.php",
      data: {action: 'fetchDataById', id: id},
      success:function(response){
        data = JSON.parse(response);
        $("#msg_id").val(data.id);
        $("#msg_email").val(data.email);
      }
    })
  });

  //Reply Email
  $("#reply_msg").click(function(e){
    e.preventDefault();
    $("#reply_msg").val('Please Wait..');
    $.ajax({
      type: 'POST',
      url: '../lib/action.php',
      data: $('#reply_msg_form').serialize()+'&action=reply_msg',
      success:function(response){
        $("#reply_msg").val('Reply Message');
        $("#reply_msg_form")[0].reset();
        $("#replyMsgModal").modal('hide');
        Swal.fire({
          title: "Reply Send Succesfully!",
          type: "success"
        });

      }
    })
  })
  /*****End******/
});
