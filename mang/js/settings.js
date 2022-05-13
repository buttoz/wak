$(document).ready(function () {
  $("#paymentways_select").on("submit", function (e) {
    e.preventDefault();

    var formdata = new FormData(this);
    $.ajax({
      url: "utility/paymentways_select.php",
      type: "POST",
      cache: false,
      data: formdata,
      contentType: false,
      processData: false,
      success: function (res) {
        alert("עודכנו בהצלחה");
        // location.reload();
      },
    });
  });
  $("#del_code_form").on("submit", function (e) {
    e.preventDefault();

    var formdata = new FormData(this);
    $.ajax({
      url: "utility/update_del_code.php",
      type: "POST",
      cache: false,
      data: formdata,
      contentType: false,
      processData: false,
      success: function (res) {
        alert("קוד מחיקה עודכנו בהצלחה");
      },
    });
  });
  $("#renew_time_form").on("submit", function (e) {
    e.preventDefault();

    var formdata = new FormData(this);
    $.ajax({
      url: "utility/update_renew_time.php",
      type: "POST",
      cache: false,
      data: formdata,
      contentType: false,
      processData: false,
      success: function (res) {
        alert("זמן חידוש עודכנו בהצלחה");
      },
    });
  });
  $("#imgInp").on("change", function (evt) {
    const [file] = imgInp.files;
    if (file) {
      blah.src = URL.createObjectURL(file);
    }
  });
});

$("#sms_cont_form").on("submit", function (e) {
  e.preventDefault();
  var formdata = new FormData(this);
  $.ajax({
    url: "utility/save_sms_cont.php",
    type: "POST",
    cache: false,
    data: formdata,
    contentType: false,
    processData: false,
    success: function (response) {
      if (response == 1) alert("נשמר");
      else alert("לא נשמר");
    },
  });
});
