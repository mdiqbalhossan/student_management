$(document).ready(function () {
  // logout Ajax Request
  $("#logout").click(function (e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "lib/action.php",
      data: { action: "logout" },
      success: function (response) {
        if (response == "logout") {
          window.location = "index.php";
        }
      }
    });
  });

  // Fetch Notice
  fecthNotice();
  function fecthNotice() {
    $.ajax({
      type: "POST",
      url: "lib/action.php",
      data: { action: "fecthNotice" },
      success: function (response) {
        $("#notice").html(response);
      }
    });
  }

  // Fetch Study Materials
  fetchMaterials();
  function fetchMaterials() {
    cid = $("#cid").val();
    $.ajax({
      type: "POST",
      url: "lib/action.php",
      data: { action: "fetchMaterials", cid: cid },
      success: function (response) {
        $("#materials").html(response);
      }
    });
  }

  // Fetch Upcoming Class
  fetchUpcomingClass();
  function fetchUpcomingClass() {
    cid = $("#cid").val();
    $.ajax({
      type: "POST",
      url: "lib/action.php",
      data: { action: "fetchUpcomingClass", cid: cid },
      success: function (response) {
        $("#upcoming_class").html(response);
      }
    });
  }

  // Fetch Upcoming Exam
  fetchUpcomingExam();
  function fetchUpcomingExam() {
    cid = $("#cid").val();
    $.ajax({
      type: "POST",
      url: "lib/action.php",
      data: { action: "fetchUpcomingExam", cid: cid },
      success: function (response) {
        $("#upcoming_exam").html(response);
        //console.log(response);
      }
    });
  }

  // Fetch Latest Result
  fetchLatestResult();
  function fetchLatestResult() {
    st_id = $("#st_id").val();
    $.ajax({
      type: "POST",
      url: "lib/action.php",
      data: { action: "fetchLatestResult", st_id: st_id },
      success: function (response) {
        $("#latest_result").html(response);
        //console.log(response);
      }
    });
  }

  // Change Password Ajax Request
  $("#change_pass_btn").click(function (e) {
    if ($("#password_change_form")[0].checkValidity()) {
      e.preventDefault();
      $("#change_pass_btn").val("Please Wait...");

      if ($("#newpass").val() != $("#cnewpass").val()) {
        $("#password_error").text("* Password did not matched!");
        $("#change_pass_btn").val("Change Password");
      } else {
        $.ajax({
          type: "POST",
          url: "lib/action.php",
          data: $("#password_change_form").serialize() + "&action=change_pass",
          success: function (response) {
            $("#alert").html(response);
            $("#change_pass_btn").val("Change Password");
            $("#password_error").text("");
            $("#password_change_form")[0].reset();
          }
        });
      }
    }
  });

  // Display Notice In details
  $("body").on("click", ".notice_btn", function (e) {
    e.preventDefault();
    id = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "lib/action.php",
      data: { action: "notice_details", id: id },
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

  // Display Materials In details
  $("body").on("click", ".materials_btn", function (e) {
    e.preventDefault();
    id = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "lib/action.php",
      data: { action: "materials_details", id: id },
      success: function (response) {
        data = JSON.parse(response);
        $("#getMaterialsTitle").text("Title: " + data.title);
        $("#getMatrialsTitlebody").text("Title: " + data.title);
        $("#getMaterialsTime").text("Published On: " + data.created_at);
        if (data.materials == "") {
          $file =
            '<a href="../assets/img/' + data.file + '">' + data.file + "</a>";
          $("#getMaterialsBody").html($file);
        } else if (data.materials != "" && data.file != "") {
          $show =
            '<p class="text-center text-secondary">' +
            data.materials +
            '</p><hr><a href="../assets/img/' +
            data.file +
            '">' +
            data.file +
            "</a>";
          $("#getMaterialsBody").html($show);
        } else {
          $("#getMaterialsBody").text(data.materials);
        }
      }
    });
  });

  // Fetch Fess
  fetchfees();
  function fetchfees() {
    st_id = $("#st_id").val();
    $.ajax({
      type: "POST",
      url: "lib/action.php",
      data: { action: "fetchfees", st_id: st_id },
      success: function (response) {
        $("#payable_fees").html(response);
        //console.log(response);
      }
    });
  }

  // Pay Tk Ajax Request
  $("#pay_submit").click(function (e) {
    e.preventDefault();
    $("#paid_amountErr").html("");
    $("#payment_dateErr").html("");
    $("#payment_methodErr").html("");
    $("#tr_idErr").html("");

    if ($("#paid_amount").val() == "") {
      $("#paid_amountErr").html("* Paid amount required!");
      return false;
    } else if ($("#payment_date").val() == "") {
      $("#payment_dateErr").html("* Payment Date required!");
      return false;
    } else if ($("#payment_method").val() == "") {
      $("#payment_methodErr").html("* Payment Method required!");
      return false;
    } else if ($("#tr_id").val() == "") {
      $("#tr_idErr").html("* Transaction id required!");
      return false;
    } else {
      $.ajax({
        type: "post",
        url: "lib/action.php",
        data: $("#fees_form").serialize() + "&action=pay",
        success: function (response) {
          $("#pay").modal("hide");
          $("#fees_form").reset();

          Swal.fire({
            title: "Payment Succesfully Completed!",
            type: "success"
          });
          fetchfees();
        }
      });
    }
  });

  // Handle Download Reciept
  $("body").on("click", ".receipt", function (e) {
    e.preventDefault();
    id = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "lib/action.php",
      data: { action: "download_reciept", id: id },
      success: function (response) {
        console.log(response);
      }
    });
  });

  //    Send Messange to Admin
  $("#msg_btn").click(function (e) {
    e.preventDefault();
    $("#msg_btn").val("Please Wait...");
    $.ajax({
      type: "POST",
      url: "lib/action.php",
      data: $("#contact_form").serialize() + "&action=send_msg",
      success: function (response) {
        $("#msg_btn").val("Send msg");
        $("#contact_form")[0].reset();
        Swal.fire({
          title: "Message Sent Succesfully!",
          type: "success"
        });
      }
    });
  });

});
