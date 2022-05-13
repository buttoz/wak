$(document).ready(function () {
  var a = window.location.href;
  if (a.includes("client_plus")) {
    loadagreements();
    loadTradings();
    //load_client_users();
    //loadhistorytable();
    //loadstatusclient();

    function loadagreements() {
      $.ajax({
        url: "utility/loadagreementsdata_client.php",
        type: "POST",
        data: {
          id: $("#client_id_agree").val()
        },

        success: function (res) {
          var data = JSON.parse(res);
          var text = "";
          var i;
          for (i = 0; i < data.length; i++) {
            if (data[i].file)
              text += `<tr>
          <td  data-target="#updateagreementsmodal" class="updateagree" data-toggle="modal" id="${data[i].id}">${data[i].description}</td>
          <td  data-target="#updateagreementsmodal" class="updateagree" data-toggle="modal" id="${data[i].id}">${data[i].createdtime}</td>
          <td>
<div id="view_image">
  <i class="fas fa-search fa-lg view_image_agreee" id="${data[i].id}"></i>
</div>
</td>
</tr>`;
            else
              text += `<tr data-target="#updateagreementsmodal" class="updateagree" data-toggle="modal" id="${data[i].id}">
<td>${data[i].description}</td>
<td>${data[i].createdtime}</td>
</tr>`;
          }
          $("#agreementsdata").append(text);
        },
      });
    }

    function loadTradings() {
      $.ajax({
        url: "utility/loadTradingsdata_client.php",
        type: "POST",
        data: {
          id: $("#client_id").val()
        },

        success: function (res) {
          var data = JSON.parse(res);
          var text = "";
          var i;
          for (i = 0; i < data.length; i++) {
            if (data[i].file)
              text += `<tr>
          <td  data-target="#updateTradingsmodal" class="updateTrading" data-toggle="modal" id="${data[i].id}">${data[i].description}</td>
          <td  data-target="#updateTradingsmodal" class="updateTrading" data-toggle="modal" id="${data[i].id}">${data[i].createdtime}</td>
          <td>
<div id="view_image">
  <i class="fas fa-search fa-lg view_image_Trading" id="${data[i].id}"></i>
</div>
</td>
</tr>`;
            else
              text += `<tr data-target="#updateTradingsmodal" class="updateTrading" data-toggle="modal" id="${data[i].id}">
          <td>${data[i].description}</td>
          <td>${data[i].createdtime}</td>
          <td></td>
</tr>`;
          }
          $("#Tradingsdata").append(text);
        },
      });
    }

    $("#agreementsdata").on("click", ".updateagree", function () {
      var depID = $(this).attr("id");
      $.ajax({
        url: "utility/loadagreesingledata_client.php",
        type: "POST",
        data: {
          depid: depID
        },

        success: function (res) {
          var data = JSON.parse(res);

          $("#updateagreements .view_image_agreee").attr("id", data.id);
          $("#updateagreements #agree_id").val(data.id);
          $("#updateagreements .deleteagree").attr("id", data.id);
          $("#updateagreements #descriptiontoedit_agree").val(data.description);
          ///$("#updateagreements #filetoedit").val(data.file);
        },
      });
    });
    $("#addobligo_client").on("click", function (e) {
      var id = $("#client_id").val();
      //  var obligo = $("#obligo").val();
      var cancel_days = $("#cancel_days").val();
      var tax_deduction = $("#tax_deduction").val();
      //  var sla_client = $("#sla_client").val();
      var sms_num = $("#sms_num").val();
      var z_token = $("#z_token").val();

      $.ajax({
        url: "utility/saveobligo_client.php",
        type: "POST",
        data: {
          id: id,
          //    obligo: obligo,
          cancel_days: cancel_days,
          tax_deduction: tax_deduction,
          //  sla_client: sla_client,
          sms_num: sms_num,
          z_token: z_token,
          creditpay_way: $("#creditpay_way").val(),
        },

        success: function (res) {
          if (res == 1) alert("נשמר בהצלחה");
          else alert("לא נשמר");
        },
      });
    });
    $("#Tradingsdata").on("click", ".updateTrading", function () {
      var depID = $(this).attr("id");
      $.ajax({
        url: "utility/loadTradingsingledata_client.php",
        type: "POST",
        data: {
          depid: depID
        },

        success: function (res) {
          var data = JSON.parse(res);

          $("#updateTradings .view_image_Trading").attr("id", data.id);
          $("#updateTradings #Trading_id").val(data.id);
          $("#updateTradings .deleteTrading").attr("id", data.id);
          $("#updateTradings #descriptiontoedit").val(data.description);
          ///$("#updateagreements #filetoedit").val(data.file);
        },
      });
    });
    $("#updateagreements").on("click", ".view_image_agreee", function (e) {
      alert(imgid);
      var imgid = $(this).attr("id");
      $.ajax({
        url: "utility/view_img_agree_client.php",
        type: "POST",
        data: {
          id: imgid
        },

        success: function (res) {
          var data = JSON.parse(res);
          var url = "../data/agreements/" + data.file;
          window.open(url, "_blank");
        },
      });
    });
    $("#updateTradings").on("click", ".view_image_Trading", function (e) {
      var imgid = $(this).attr("id");
      $.ajax({
        url: "utility/view_img_Trading_client.php",
        type: "POST",
        data: {
          id: imgid
        },

        success: function (res) {
          var data = JSON.parse(res);
          var url = "../data/tradings/" + data.file;
          window.open(url, "_blank");
        },
      });
    });

    $("#updateagreements").on("click", ".deleteagree", function (e) {
      var delid = $(this).attr("id");
      if (confirm("למחוק הסכם"))
        $.ajax({
          url: "utility/delagree_client.php",
          type: "POST",
          data: {
            id: delid
          },

          success: function (res) {
            $("#closeivoicee").trigger("click");
            $("#agreementsdata").empty();
            loadagreements();
          },
        });
    });
    $("#updateTradings").on("click", ".deleteTrading", function (e) {
      var delid = $(this).attr("id");
      if (confirm("למחוק תנאי מסחרי"))
        $.ajax({
          url: "utility/delTrading_client.php",
          type: "POST",
          data: {
            id: delid
          },

          success: function (res) {
            $("#closeivoicee").trigger("click");
            $("#Tradingsdata").empty();
            loadTradings();
          },
        });
    });

    $("#updateagreements").on("submit", function (e) {
      e.preventDefault();
      var formdata = new FormData(this);
      $.ajax({
        url: "utility/updateagreedata_client.php",
        type: "POST",
        cache: false,
        data: formdata,
        contentType: false,
        processData: false,

        success: function (res) {
          if (res) {
            $("#closeivoiceeedit").trigger("click");

            $("#agreementsdata").empty();
            loadagreements();
          }
        },
      });
    });
    $("#updateTradings").on("submit", function (e) {
      e.preventDefault();
      var formdata = new FormData(this);
      $.ajax({
        url: "utility/updateTradingdata_client.php",
        type: "POST",
        cache: false,
        data: formdata,
        contentType: false,
        processData: false,

        success: function (res) {
          if (res == 1) {
            $("#updateTradings #closeivoiceeedit_trading").trigger("click");
            $("#Tradingsdata").empty();
            loadTradings();
          }
        },
      });
    });

    $("#Agreementsadd").on("submit", function (e) {
      e.preventDefault();

      var formdata = new FormData(this);
      $.ajax({
        url: "utility/addAgreement_client.php",
        type: "POST",
        cache: false,
        data: formdata,
        contentType: false,
        processData: false,

        success: function (res) {
          if (res) {
            $("#agreementsdata").empty();
            $("#closeivoice_agree_add").trigger("click");
            loadagreements();
          } //console.log(1)
          //!messgae
          //window.location = "index.php?sec=staff&action=managestaff";
        },
      });
    });
    $("#Tradingsadd").on("submit", function (e) {
      e.preventDefault();

      var formdata = new FormData(this);
      $.ajax({
        url: "utility/addTradings_client.php",
        type: "POST",
        cache: false,
        data: formdata,
        contentType: false,
        processData: false,

        success: function (res) {
          if (res) {
            $("#Tradingsdata").empty();
            $("#closeivoice_Trading_add").trigger("click");
            loadTradings();
          } //console.log(  1)
          //!messgae
          //window.location = "index.php?sec=staff&action=managestaff";
        },
      });
    });

    ///!!!!!!!!!!!!!!!!!

    var a = window.location.href;
    if (a.includes("client_plus")) {
      loaddocs();
    }

    function loaddocs() {
      $.ajax({
        url: "utility/loaddocdata_client.php",
        type: "POST",
        data: {
          id: $("#doc_client_id").val()
        },

        success: function (res) {
          var data = JSON.parse(res);
          var text = "";
          var i;
          for (i = 0; i < data.length; i++) {
            if (data[i].file)
              text += `<tr>
            <td  data-target="#updatedocmodal" class="updatedoc" data-toggle="modal" id="${data[i].id}">${data[i].description}</td>
            <td  data-target="#updatedocmodal" class="updatedoc" data-toggle="modal" id="${data[i].id}">${data[i].createdtime}</td>
            <td>
<div id="view_image">
  <i class="fas fa-search fa-lg view_image_docc" id="${data[i].id}"></i>
</div>
</td>
</tr>`;
            else
              text += `<tr data-target="#updatedocmodal" class="updatedoc" data-toggle="modal" id="${data[i].id}">
            <td>${data[i].description}</td>
            <td>${data[i].createdtime}</td>
</tr>`;
          }
          $("#docdata").append(text);
        },
      });
    }

    $("#docdata").on("click", ".updatedoc", function () {
      var depID = $(this).attr("id");
      $.ajax({
        url: "utility/loaddocsingledata_client.php",
        type: "POST",
        data: {
          depid: depID
        },

        success: function (res) {
          var data = JSON.parse(res);

          $("#updatedoc .view_image_docc").attr("id", data.id);
          $("#updatedoc #doc_id").val(data.id);
          $("#updatedoc .deletedoc").attr("id", data.id);
          $("#updatedoc #doc_descriptiontoedit").val(data.description);
        },
      });
    });
    $("#updatedoc").on("click", ".view_image_docc", function (e) {
      var imgid = $(this).attr("id");
      $.ajax({
        url: "utility/view_img_doc_client.php",
        type: "POST",
        data: {
          id: imgid
        },

        success: function (res) {
          var data = JSON.parse(res);
          var url = "../data/docs/" + data.file;
          window.open(url, "_blank");
        },
      });
    });

    $("#updatedoc").on("click", ".deletedoc", function (e) {
      if (confirm("למחוק מסמך")) var delid = $(this).attr("id");
      $.ajax({
        url: "utility/deldoc_client.php",
        type: "POST",
        data: {
          id: delid
        },

        success: function (res) {
          $("#closeivoicee").trigger("click");
          $("#docdata").empty();
          loaddocs();
        },
      });
    });

    // $("#manageclient").on("submit", function (e) {
    //   e.preventDefault();

    //   var formdata = new FormData(this);
    //     $.ajax({
    //       url: "utility/updateclient.php",
    //       type: "POST",
    //       cache: false,
    //       data: formdata,
    //       contentType: false,
    //       processData: false,

    //       success: function (res) {
    //         if (res != 0) {

    //           alert("עודכן בהצלחה");
    //         } else {
    //           window.location =
    //             "index.php?sec=clients&action=client_plus&id=" + res;
    //           alert("לא עודכן");
    //         }
    //       },
    //     });
    // });

    $("#updatedoc").on("submit", function (e) {
      e.preventDefault();
      var formdata = new FormData(this);
      $.ajax({
        url: "utility/updatedocdata_client.php",
        type: "POST",
        cache: false,
        data: formdata,
        contentType: false,
        processData: false,

        success: function (res) {
          if (res) {
            $("#closeivoiceedoc_edit").trigger("click");
            $("#docdata").empty();
            loaddocs();
          }
        },
      });
    });

    $("#docadd").on("submit", function (e) {
      e.preventDefault();

      var formdata = new FormData(this);
      $.ajax({
        url: "utility/adddoc_client.php",
        type: "POST",
        cache: false,
        data: formdata,
        contentType: false,
        processData: false,

        success: function (res) {
          if (res) {
            $("#closeivoice_doc_add").trigger("click");
            $("#docdata").empty();
            loaddocs();
          } //console.log(1)
          //!messgae
          //window.location = "index.php?sec=staff&action=managestaff";
        },
      });
    });

    //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

    function load_client_users() {
      $.ajax({
        url: "utility/load_client_users_data.php",
        type: "POST",
        data: {
          id: $("#client_id_agree").val()
        },

        success: function (res) {
          var data = JSON.parse(res);
          var text = "";
          var i;
          for (i = 0; i < data.length; i++) {
            text += `<tr data-target="#updateclient_users" class="updateclient_users" data-toggle="modal" id="${data[i].id}">
<td>${data[i].user_full_name}</td>
<td>${data[i].u_mobile}</td>
<td>${data[i].u_email}</td>
<td>${data[i].last_login}</td>
<td>${data[i].createdtime}</td>

</tr>`;
          }
          $("#client_users_data").empty();
          $("#client_users_data").append(text);
        },
      });
    }

    $("#client_user_submit").on("submit", function (e) {
      e.preventDefault();

      var formdata = new FormData(this);
      if (
        $(".emailerror").css("display") == "none" &&
        $(".client_user_name_user").css("display") == "none"
      )
        $.ajax({
          url: "utility/add_client_user.php",
          type: "POST",
          cache: false,
          data: formdata,
          contentType: false,
          processData: false,
          success: function (res) {
            if (res) {
              $("#closeivoice").trigger("click");
              $("#client_user_submit #user_name").val();
              $("#client_user_submit #full_name").val();
              $("#client_user_submit #mobile_number").val();
              $("#client_user_submit #email").val();
              $("#client_user_submit #email").val();
              $("#client_user_submit #password").val();

              load_client_users();
            }
          },
        });
      else {
        alert('שם משתמש או דוא"ל קיים');
      }
    });

    $("#client_users_data").on("click", ".updateclient_users", function () {
      var depID = $(this).attr("id");
      $.ajax({
        url: "utility/load_client_users_singledata.php",
        type: "POST",
        data: {
          depid: depID,
          id: $("#client_id_user").val()
        },

        success: function (res) {
          var data = JSON.parse(res);

          $("#update_client_users #client_user_id").val(data.id);
          $("#update_client_users #client_id_user").val(data.client_id);
          $("#update_client_users #user_name_toedit").val(data.a_username);
          $("#update_client_users .deleteuser").attr("id", data.id);
          $("#update_client_users #full_name_toedit").val(data.user_full_name);
          $("#update_client_users #mobile_number_toedit").val(data.u_mobile);
          $("#update_client_users #email_toedit").val(data.u_email);
          if (data.otp == 0) {
            $("#update_client_users #active_inactive_otp").prop(
              "checked",
              true
            );
            $(".toggle").addClass("btn-success").removeClass("btn-danger off");
          } else {
            $("#update_client_users #active_inactive_otp").prop(
              "checked",
              false
            );
            $(".toggle").addClass("btn-danger off").removeClass("btn-success");
          }
        },
      });
    });

    $("#update_client_users").on("submit", function (e) {
      e.preventDefault();
      var formdata = new FormData(this);
      if ($(".client_user_name_user").css("display") == "none")
        $.ajax({
          url: "utility/update_user_data_client.php",
          type: "POST",
          cache: false,
          data: formdata,
          contentType: false,
          processData: false,

          success: function (res) {
            if (res) {
              $("#closeivoiceedit").trigger("click");
              $("#client_users_data").empty();
              load_client_users();
            }
          },
        });
      else {
        alert("שם משתמש קיים");
      }
    });

    $("#update_client_users").on("click", ".deleteuser", function (e) {
      var delid = $(this).attr("id");
      if (confirm("למחוק משמתמש"))
        $.ajax({
          url: "utility/del_client_user.php",
          type: "POST",
          data: {
            id: delid
          },

          success: function (res) {
            $("#closeivoiceedit").trigger("click");
            $("#client_users_data").empty();
            load_client_users();
          },
        });
    });

    //!!  status section

    //     function loadstatusclient() {
    //       $.ajax({
    //         url: "utility/loadstatusdataclient.php",
    //         type: "GET",

    //         success: function (res) {
    //           var data = JSON.parse(res);

    //           var text = "";
    //           var i;
    //           for (i = 0; i < data.length; i++) {
    //             if (data[i].resp == "a") {
    //               text += `<tr>
    // <td>${data[i].status_description}</td>
    // <td>${data[i].SLA}</td>
    // <td>${data[i].resp}</td>
    // <td  id="${data[i].id}" data-target="#updatestatussub" class="upstatus" data-toggle="modal"><i class="fas fa-pen"></i></td>
    // <td><i id="${data[i].id}" class="fas fa-times deletestatus"></i></td>
    // </tr>`;
    //             }
    //           }
    //           $("#statusdata").append(text);
    //         },
    //       });
    //     }

    $("#updateuser").on("click", ".deleteuser", function (e) {
      var delid = $(this).attr("id");
      if (confirm("למחוק משמתמש"))
        $.ajax({
          url: "utility/delete_user.php",
          type: "POST",
          data: {
            id: delid
          },

          success: function (res) {
            window.location = "index.php?sec=users&action=manageuser";
          },
        });
    });

    $(".update_all_prices").on("click", function (e) {
      $.ajax({
        url: "utility/update_all_prices.php",
        type: "POST",
        data: {
          id: this.id
        },

        success: function (res) {
          //window.location = "index.php?sec=clients&action=manageclient";
        },
      });
    });

    $("#global_discount_form").on("submit", function (e) {
      var formdata = new FormData(this);
      $.ajax({
        url: "utility/global_discount.php",
        type: "POST",
        cache: false,
        data: formdata,
        contentType: false,
        processData: false,

        success: function (res) {
          if (res) {
            //window.location = "index.php?sec=clients&action=manageclient";
          }
        },
      });
    });
    $("#copy_from_client_form").on("submit", function (e) {
      //e.preventDefault();
      var formdata = new FormData(this);
      $.ajax({
        url: "utility/copy_from_client.php",
        type: "POST",
        cache: false,
        data: formdata,
        contentType: false,
        processData: false,

        success: function (res) {
          if (res) {
            //window.location = "index.php?sec=clients&action=manageclient";
          }
        },
      });
    });
    $(".updateclientprodsub").on("click", function (e) {
      var id = this.id;
      $.ajax({
        url: "utility/loadclientprodsingledata.php",
        type: "POST",
        data: {
          id: id
        },
        success: function (res) {
          const data = JSON.parse(res);
          $("#updateprodsub_form #new_price").val(data.c_price);
          $("#updateprodsub_form #id_to_update").val(data.c_id);
          $("#updateprodsub_form #old_price").val(data.c_price);
          if (data.c_status == 0) {
            $("#active_inactive_price").prop("checked", true);
            $(".toggle").addClass("btn-success").removeClass("btn-danger off");
          } else {
            $("#active_inactive_price").prop("checked", false);
            $(".toggle").addClass("btn-danger off").removeClass("btn-success");
          }
        },
      });
    });
    $("#updateprodsub_form").on("submit", function (e) {
      e.preventDefault();
      var formdata = new FormData(this);
      // var new_price = $("#updateprodsub_form #new_price").val();
      // var old_price = $("#updateprodsub_form #old_price").val();
      // if (old_price != new_price)
      $.ajax({
        url: "utility/new_private_price.php",
        type: "POST",
        cache: false,
        data: formdata,
        contentType: false,
        processData: false,

        success: function (res) {
          location.reload();
        },
      });
      // else{
      // }
    });

    $("#marketer").on("change", function (e) {
      var marketer = $("#marketer option:selected").val();
      var client_id = $("#client_id").val();
      $.ajax({
        url: "utility/change_marketer.php",
        type: "POST",
        data: {
          marketer: marketer,
          client_id: client_id
        },
        success: function (res) {
          loadhistorytable(res);
        },
      });
    });

    function loadhistorytable() {
      var client_id = $("#client_id").val();
      $.ajax({
        url: "utility/loadhistorytable.php",
        type: "POST",
        data: {
          client_id: client_id
        },
        success: function (res) {
          var data = JSON.parse(res);
          var text = "";
          var i;
          for (i = 0; i < data.length; i++) {
            text += `<tr>
<td>${data[i].c_id}</td>
<td>${data[i].marketer}</td>
<td>${data[i].assigned_datetime}</td>

</tr>`;
          }
          $("#historydata").empty();
          $("#historydata").append(text);
        },
      });
    }

    $(".history_client").on("click", function (e) {
      var client_id = $("#client_id").val();
      $.ajax({
        url: "utility/loadhistorytableclientprice.php",
        type: "POST",
        data: {
          client_id: client_id,
          prod_id: this.id
        },
        success: function (res) {
          var data = JSON.parse(res);
          var text = `
          <div class="row">
          <div class="col-md">מחיר ישן</div>
          <div class="col-md">מחיר חדש</div>
          <div class="col-md">משתמש</div>
          <div class="col-md">תאריך פעולה</div>
          </div>
          <hr> 
        `;
          var i;
          for (i = 0; i < data.length; i++) {
            text += `
            <div class="row">
            <div class="col-md">${data[i].price}</div>
            <div class="col-md">${data[i].new_price}</div>
            <div class="col-md">${data[i].user}</div>
            <div class="col-md">${data[i].c_insertdate}</div>
          </div>
          <hr>`;
          }
          $("#private_history").empty();
          $("#private_history").append(text);
        },
      });
    });
  }
  $("#del_pay_modal").on("submit", function (e) {
    e.preventDefault();
    var formdata = new FormData(this);
    $.ajax({
      url: "utility/delete_payment.php",
      type: "POST",
      cache: false,
      data: formdata,
      contentType: false,
      processData: false,
      success: function (res) {
        if (res == -1) {
          alert("קוד מחיקה לא נכון");
        }
        if (res == 1) {
          alert("פעולה לא בוצעה");
          $("#del_pay_modal").trigger("reset");
        } else {
          $("#del_pay_modal").trigger("reset");
        }
      },
    });
  });
  $(".delpayment").on("click", function (e) {
    $("#pay_id").val(this.id);
  });

  $('[id^="clientsupplierscont"]').on("click", function (e) {
    var id = $(this).attr("id").slice(18);
    if ($("#suppliersclient" + id).is(":checked")) {
      $("#suppliersclient" + id).prop("checked", false);
      $("#clientcontsup" + id).css("background-color", "#ffffff");
    } else {
      $("#suppliersclient" + id).prop("checked", true);
      $("#clientcontsup" + id).css("background-color", "#9edbf5");
    }
  });

  $('[id^="clientcustomSwitch"]').on("change", function (e) {
    var id = $(this).attr("id").slice(17);

    $.ajax({
      url: "utility/updatesupplierstatusclient.php",
      type: "POST",
      data: {
        id: id,
        client_id: $("#client_id").val()
      },

      success: function (res) {
        var data = JSON.parse(res);
        if (data.err > 0 || data.err == true) $("#sup_list").submit();
        else if ((data.err = -5) || data.err == false) {
          alert("אי אפשר לפעיל ספק לסוכן זה");
        }
      },
    });
  });

  $("#client_payway").on("change", function (e) {
    e.preventDefault();
    var formdata = new FormData(this);
    $.ajax({
      url: "utility/updatepaymentways_client.php",
      type: "POST",
      cache: false,
      data: formdata,
      contentType: false,
      processData: false,

      success: function (res) {},
    });
  });
});
var a = window.location.href;
if (a.includes("client_plus")) {
  loadchecks_client();
}

function loadchecks_client() {
  $.ajax({
    url: "utility/loadcheckdata_client.php",
    type: "POST",
    data: {
      id: $("#check_client_id").val()
    },

    success: function (res) {
      var data = JSON.parse(res);
      var text = "";
      var i;
      for (i = 0; i < data.length; i++) {
        if (data[i].file)
          text += `<tr>
                    <td  data-target="#updatecheckmodal" class="updatecheck" data-toggle="modal" id="${data[i].id}">${data[i].description}</td>
                    <td  data-target="#updatecheckmodal" class="updatecheck" data-toggle="modal" id="${data[i].id}">${data[i].createdtime}</td>
                    <td>
        <div id="view_image">
          <i class="fas fa-search fa-lg view_image_check" id="${data[i].id}"></i>
        </div>
        </td>
        </tr>`;
        else
          text += `<tr data-target="#updatecheckmodal" class="updatecheck" data-toggle="modal" id="${data[i].id}">
            <td>${data[i].description}</td>
            <td>${data[i].createdtime}</td>
</tr>`;
      }
      $("#checkdata").append(text);
    },
  });
}

$("#checkdata").on("click", ".updatecheck", function () {
  var depID = $(this).attr("id");
  $.ajax({
    url: "utility/loadchecksingledata_client.php",
    type: "POST",
    data: {
      depid: depID
    },

    success: function (res) {
      var data = JSON.parse(res);

      $("#updatecheck .view_image_check").attr("id", data.id);
      $("#updatecheck #check_id").val(data.id);
      $("#updatecheck .deletecheck").attr("id", data.id);
      $("#updatecheck #check_descriptiontoedit").val(data.description);
    },
  });
});
$("#updatecheck").on("click", ".view_image_check", function (e) {
  var imgid = $(this).attr("id");
  $.ajax({
    url: "utility/view_img_check_client.php",
    type: "POST",
    data: {
      id: imgid
    },

    success: function (res) {
      var data = JSON.parse(res);
      var url = "../data/checks/" + data.file;
      window.open(url, "_blank");
    },
  });
});

$("#updatecheck").on("click", ".deletecheck", function (e) {
  if (confirm("למחוק מסמך")) var delid = $(this).attr("id");
  $.ajax({
    url: "utility/delcheck_client.php",
    type: "POST",
    data: {
      id: delid
    },

    success: function (res) {
      $("#closeivoicee").trigger("click");
      $("#checkdata").empty();
      loadchecks_client();
    },
  });
});
$("#updatecheck").on("submit", function (e) {
  e.preventDefault();
  var formdata = new FormData(this);
  $.ajax({
    url: "utility/updatecheckdata_client.php",
    type: "POST",
    cache: false,
    data: formdata,
    contentType: false,
    processData: false,

    success: function (res) {
      if (res) {
        $("#closeivoiceecheck_edit").trigger("click");
        $("#checkdata").empty();
        loadchecks_client();
      }
    },
  });
});

$("#checkadd").on("submit", function (e) {
  e.preventDefault();

  var formdata = new FormData(this);
  $.ajax({
    url: "utility/addcheck_client.php",
    type: "POST",
    cache: false,
    data: formdata,
    contentType: false,
    processData: false,

    success: function (res) {
      if (res) {
        $("#closeivoice_check_add").trigger("click");
        $("#checkdata").empty();
        loadchecks_client();
      } //console.log(1)
      //!messgae
      //window.location = "index.php?sec=staff&action=managestaff";
    },
  });
});

var R_ELEGAL_INPUT = -1;
var R_NOT_VALID = -2;
var R_VALID = 1;

$("#business_id_number_client").blur(function () {
  if ($("#client_type").val() == "1") {
    valididnum($(this).val(), "#business_id_number_client");
  }
});
$("#update_business_id_number_client").blur(function () {
  if ($("#client_type").val() == "1") {
    valididnum($(this).val(), "#update_business_id_number_client");
  }
});
$("#usermanage #userid").blur(function () {
  valididnum($(this).val(), "#usermanage #userid");
});
$("#updateuser #userid").blur(function () {
  valididnum($(this).val(), "#updateuser #userid");
});

function valididnum(IDnum, inputid) {
  //INPUT VALIDATION

  // Just in case -> convert to string

  if (IDnum.length > 7 && IDnum.length < 10) {
    // Validate correct input
    if (IDnum.length > 9 || IDnum.length < 5) return R_ELEGAL_INPUT;
    if (isNaN(IDnum)) return R_ELEGAL_INPUT;

    // The number is too short - add leading 0000
    if (IDnum.length < 9) {
      while (IDnum.length < 9) {
        IDnum = "0" + IDnum;
      }
    }

    // CHECK THE ID NUMBER
    var mone = 0,
      incNum;
    for (var i = 0; i < 9; i++) {
      incNum = Number(IDnum.charAt(i));
      incNum *= (i % 2) + 1;
      if (incNum > 9) incNum -= 9;
      mone += incNum;
    }
    if (mone % 10 == 0) {
      return R_VALID;
    } else {
      $(inputid).val("");
      alert("נא לבדוק תקינות ת.ז");
      return R_NOT_VALID;
    }
  } else {
    $(inputid).val("");
    alert("נא לבדוק תקינות ת.ז");
    return false;
  }
}
$("#creditpay_way").on("change", function (e) {
  if ($(this).val() == 0)
    $("#z_token_cont").css("display", '')
  else
    $("#z_token_cont").css("display", 'none')
});