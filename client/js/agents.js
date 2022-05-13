$(document).ready(function () {
  var a = window.location.href;
  if (a.includes("agentplus")) {
    loadagreements();
    loadTradings();
    load_agent_users();
    loadhistorytable();
    //loadstatusagent();

    function loadagreements() {
      $.ajax({
        url: "utility/loadagreementsdata.php",
        type: "POST",
        data: {
          id: $("#agent_id_agree").val()
        },

        success: function (res) {
          var data = JSON.parse(res);
          var text = "";
          var i;
          for (i = 0; i < data.length; i++) {
            if (data[i].file)
              text += `<tr>
          <td  data-bs-target="#updateagreementsmodal" class="updateagree" data-bs-toggle="modal" id="${data[i].id}">${data[i].description}</td>
          <td  data-bs-target="#updateagreementsmodal" class="updateagree" data-bs-toggle="modal" id="${data[i].id}">${data[i].createdtime}</td>
          <td>
<div id="view_image">
  <i class="fas fa-search fa-lg view_image_agree" id="${data[i].id}"></i>
</div>
</td>
</tr>`;
            else
              text += `<tr data-bs-target="#updateagreementsmodal" class="updateagree" data-bs-toggle="modal" id="${data[i].id}">
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
        url: "utility/loadTradingsdata.php",
        type: "POST",
        data: {
          id: $("#agent_id").val()
        },

        success: function (res) {
          var data = JSON.parse(res);
          var text = "";
          var i;
          for (i = 0; i < data.length; i++) {
            if (data[i].file)
              text += `<tr>
          <td  data-bs-target="#updateTradingsmodal" class="updateTrading" data-bs-toggle="modal" id="${data[i].id}">${data[i].description}</td>
          <td  data-bs-target="#updateTradingsmodal" class="updateTrading" data-bs-toggle="modal" id="${data[i].id}">${data[i].createdtime}</td>
          <td>
<div id="view_image">
  <i class="fas fa-search fa-lg view_image_Trading" id="${data[i].id}"></i>
</div>
</td>
</tr>`;
            else
              text += `<tr data-bs-target="#updateTradingsmodal" class="updateTrading" data-bs-toggle="modal" id="${data[i].id}">
          <td>${data[i].description}</td>
          <td>${data[i].createdtime}</td>
</tr>`;
          }
          $("#Tradingsdata").append(text);
        },
      });
    }

    $("#agreementsdata").on("click", ".updateagree", function () {
      var depID = $(this).attr("id");
      $.ajax({
        url: "utility/loadagreesingledata.php",
        type: "POST",
        data: {
          depid: depID
        },

        success: function (res) {
          var data = JSON.parse(res);

          $("#updateagreements .view_image_agree").attr("id", data.id);
          $("#updateagreements #agree_id").val(data.id);
          $("#updateagreements .deleteagree").attr("id", data.id);
          $("#updateagreements #descriptiontoedit_agree").val(data.description);
          ///$("#updateagreements #filetoedit").val(data.file);
        },
      });
    });
    $("#addobligo").on("click", function (e) {
      var id = $("#agent_id").val();
      var obligo = $("#obligo").val();
      //  var cancel_days = $("#cancel_days").val();
      var tax_deduction = $("#tax_deduction").val();
      //  var sla_agent = $("#sla_agent").val();
      var payway = Array();
      $("[id^='agent_pay_waycheckbox']").each(function (index) {
        if ($(this).is(":checked")) {
          let id = this.id;
          id = id.slice(21);
          payway.push(id);
        }
      });
      $.ajax({
        url: "utility/saveobligo.php",
        type: "POST",
        data: {
          id: id,
          payway: payway,
          obligo: obligo,
          //      cancel_days: cancel_days,
          tax_deduction: tax_deduction,
          //      sla_agent: sla_agent,
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
        url: "utility/loadTradingsingledata.php",
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
    $("#updateagreements,#agreementsdata").on("click", ".view_image_agree", function (e) {
      var imgid = $(this).attr("id");
      $.ajax({
        url: "utility/view_img_agree.php",
        type: "POST",
        data: {
          id: imgid
        },

        success: function (res) {
          var data = JSON.parse(res);
          var url = $("#dataurl").val() + '/agreements/' + data.file;
          window.open(url, "_blank");
        },
      });
    });

    $("#updateTradings").on("click", ".view_image_Trading", function (e) {
      var imgid = $(this).attr("id");
      $.ajax({
        url: "utility/view_img_Trading.php",
        type: "POST",
        data: {
          id: imgid
        },

        success: function (res) {
          var data = JSON.parse(res);
          var url = $("#dataurl").val() + "/agreements/" + data.file;
          window.open(url, "_blank");
        },
      });
    });

    $("#updateagreements").on("click", ".deleteagree", function (e) {
      var delid = $(this).attr("id");
      if (confirm("למחוק הסכם"))
        $.ajax({
          url: "utility/delagree.php",
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
          url: "utility/delTrading.php",
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
        url: "utility/updateagreedata.php",
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
        url: "utility/updateTradingdata.php",
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
        url: "utility/addAgreement.php",
        type: "POST",
        cache: false,
        data: formdata,
        contentType: false,
        processData: false,

        success: function (res) {
          if (res) {
            $("#description_agree").val("");
            $("#file_agree").val("");
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
        url: "utility/addTradings.php",
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
          } //console.log(1)
          //!messgae
          //window.location = "index.php?sec=staff&action=managestaff";
        },
      });
    });

    ///!!!!!!!!!!!!!!!!!

    // var a = window.location.href;
    // if (a.includes("agentplus")) {
    //   loaddocs();
    // }

    //     function loaddocs() {
    //       $.ajax({
    //         url: "utility/loaddocdata.php",
    //         type: "POST",
    //         data: { id: $("#doc_agent_id").val() },

    //         success: function (res) {
    //           var data = JSON.parse(res);
    //           var text = "";
    //           var i;
    //           for (i = 0; i < data.length; i++) {
    //             if (data[i].file)
    //               text += `<tr>
    //             <td  data-bs-target="#updatedocmodal" class="updatedoc" data-bs-toggle="modal" id="${data[i].id}">${data[i].description}</td>
    //             <td  data-bs-target="#updatedocmodal" class="updatedoc" data-bs-toggle="modal" id="${data[i].id}">${data[i].createdtime}</td>
    //             <td>
    // <div id="view_image">
    //   <i class="fas fa-search fa-lg view_image_doc" id="${data[i].id}"></i>
    // </div>
    // </td>
    // </tr>`;
    //             else
    //               text += `<tr data-bs-target="#updatedocmodal" class="updatedoc" data-bs-toggle="modal" id="${data[i].id}">
    //             <td>${data[i].description}</td>
    //             <td>${data[i].createdtime}</td>
    // </tr>`;
    //           }
    //           $("#docdata").append(text);
    //         },
    //       });
    //     }

    $("#docdata").on("click", ".updatedoc", function () {
      var depID = $(this).attr("id");
      $.ajax({
        url: "utility/loaddocsingledata.php",
        type: "POST",
        data: {
          depid: depID
        },

        success: function (res) {
          var data = JSON.parse(res);

          $("#updatedoc .view_image_doc").attr("id", data.id);
          $("#updatedoc #doc_id").val(data.id);
          $("#updatedoc .deletedoc").attr("id", data.id);
          $("#updatedoc #doc_descriptiontoedit").val(data.description);
        },
      });
    });
    $("#updatedoc").on("click", ".view_image_doc", function (e) {
      var imgid = $(this).attr("id");
      $.ajax({
        url: "utility/view_img_doc.php",
        type: "POST",
        data: {
          id: imgid
        },

        success: function (res) {
          var data = JSON.parse(res);
          var url = $("#dataurl").val() + "/docs/" + data.file;
          window.open(url, "_blank");
        },
      });
    });

    // $("#updatedoc").on("click", ".deletedoc", function (e) {
    //   if (confirm("למחוק מסמך")) var delid = $(this).attr("id");
    //   $.ajax({
    //     url: "utility/deldoc.php",
    //     type: "POST",
    //     data: { id: delid },

    //     success: function (res) {
    //       $("#closeivoicee").trigger("click");
    //       $("#docdata").empty();
    //       loaddocs();
    //     },
    //   });
    // });

    $("#manageagent").on("submit", function (e) {
      e.preventDefault();
      var formdata = new FormData(this);
      $.ajax({
        url: "utility/updateagent.php",
        type: "POST",
        cache: false,
        data: formdata,
        contentType: false,
        processData: false,

        success: function (res) {
          if (res != 0) {
            location.reload();
            alert("עודכן בהצלחה");
          } else {
            location.reload();
            alert("לא עודכן");
          }
        },
      });
    });

    // $("#updatedoc").on("submit", function (e) {
    //   e.preventDefault();
    //   var formdata = new FormData(this);
    //   $.ajax({
    //     url: "utility/updatedocdata_agent.php",
    //     type: "POST",
    //     cache: false,
    //     data: formdata,
    //     contentType: false,
    //     processData: false,

    //     success: function (res) {
    //       if (res) {
    //         $("#closeivoiceedoc_edit").trigger("click");
    //         $("#docdata").empty();
    //         loaddocs();
    //       }
    //     },
    //   });
    // });

    // $("#docadd").on("submit", function (e) {
    //   e.preventDefault();

    //   var formdata = new FormData(this);
    //   $.ajax({
    //     url: "utility/adddoc.php",
    //     type: "POST",
    //     cache: false,
    //     data: formdata,
    //     contentType: false,
    //     processData: false,

    //     success: function (res) {
    //       if (res) {
    //         $("#closeivoice_doc_add").trigger("click");
    //         $("#docdata").empty();
    //         loaddocs();
    //       } //console.log(1)
    //       //!messgae
    //       //window.location = "index.php?sec=staff&action=managestaff";
    //     },
    //   });
    // });

    //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

    function load_agent_users() {
      $.ajax({
        url: "utility/load_agent_users_data.php",
        type: "POST",
        data: {
          id: $("#agent_id_agree").val()
        },

        success: function (res) {
          var data = JSON.parse(res);
          var text = "";
          var i;
          for (i = 0; i < data.length; i++) {
            text += `<tr data-bs-target="#updateagent_users" class="updateagent_users" data-bs-toggle="modal" id="${data[i].id}">
<td>${data[i].user_full_name}</td>
<td>${data[i].u_mobile}</td>
<td>${data[i].u_email}</td>
<td>${data[i].last_login}</td>
<td>${data[i].createdtime}</td>

</tr>`;
          }

          $("#agent_users_data").empty();
          $("#agent_users_data").append(text);
        },
      });
    }

    $("#agent_user_submit").on("submit", function (e) {
      e.preventDefault();

      var formdata = new FormData(this);
      $.ajax({
        url: "utility/add_agent_user.php",
        type: "POST",
        cache: false,
        data: formdata,
        contentType: false,
        processData: false,
        success: function (res) {
          if (res) {
            $("#closeivoice").trigger("click");
            $("#agent_user_submit #user_name").val("");
            $("#agent_user_submit #full_name").val("");
            $("#agent_user_submit #mobile_number").val("");
            $("#agent_user_submit #email").val("");
            $("#agent_user_submit #email").val("");
            $("#agent_user_submit #password").val("");
            load_agent_users();
          }
        },
      });
    });

    $("#agent_users_data").on("click", ".updateagent_users", function () {
      var depID = $(this).attr("id");
      $.ajax({
        url: "utility/load_agent_users_singledata.php",
        type: "POST",
        data: {
          depid: depID,
          id: $("#agent_id_user").val()
        },

        success: function (res) {
          var data = JSON.parse(res);
          $("#update_agent_users #agent_user_id").val(data.id);
          $("#update_agent_users #agent_id_user").val(data.agent_id);
          $("#update_agent_users #user_name_toedit").val(data.a_username);
          $("#update_agent_users .deleteuser").attr("id", data.id);
          $("#update_agent_users #full_name_toedit").val(data.user_full_name);
          $("#update_agent_users #mobile_number_toedit").val(data.u_mobile);
          $("#update_agent_users #email_toedit").val(data.u_email);
        },
      });
    });

    $("#update_agent_users").on("submit", function (e) {
      e.preventDefault();
      var formdata = new FormData(this);
      $.ajax({
        url: "utility/update_user_data_agent.php",
        type: "POST",
        cache: false,
        data: formdata,
        contentType: false,
        processData: false,

        success: function (res) {
          if (res) {
            $("#closeivoiceedit").trigger("click");
            $("#agent_users_data").empty();
            load_agent_users();
          }
        },
      });
    });

    //!!  status section

    //     function loadstatusagent() {
    //       $.ajax({
    //         url: "utility/loadstatusdataagent.php",
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
    // <td  id="${data[i].id}" data-bs-target="#updatestatussub" class="upstatus" data-bs-toggle="modal"><i class="fas fa-pen"></i></td>
    // <td><i id="${data[i].id}" class="fas fa-times deletestatus"></i></td>
    // </tr>`;
    //             }
    //           }
    //           $("#statusdata").append(text);
    //         },
    //       });
    //     }

    $("#manageagent").on("click", ".delete_agent", function (e) {
      var delid = $(this).attr("id");
      if (confirm("למחוק סוכן"))
        $.ajax({
          url: "utility/delete_agent.php",
          type: "POST",
          data: {
            id: delid
          },

          success: function (res) {
            window.location = "index.php?sec=agents&action=manageagent";
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
          //window.location = "index.php?sec=agents&action=manageagent";
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
            //window.location = "index.php?sec=agents&action=manageagent";
          }
        },
      });
    });
    $("#copy_from_agent_form").on("submit", function (e) {
      //e.preventDefault();
      var formdata = new FormData(this);
      $.ajax({
        url: "utility/copy_from_agent.php",
        type: "POST",
        cache: false,
        data: formdata,
        contentType: false,
        processData: false,

        success: function (res) {
          if (res == 1) {
            location.reload();
            //window.location = "index.php?sec=agents&action=manageagent";
          }
        },
      });
    });
    $(".updateagentprodsub").on("click", function (e) {
      var id = this.id;
      $.ajax({
        url: "utility/loadagentprodsingledata.php",
        type: "POST",
        data: {
          id: id
        },
        success: function (res) {
          const data = JSON.parse(res);
          $("#updateprodsub_form #new_price").val(data.c_price);
          $("#updateprodsub_form #id_to_update").val(data.c_id);
          $("#updateprodsub_form #old_price").val(data.c_price);
          $("#updateprodsub_form #prod_desc_cont").text(data.desc);
          $("#updateprodsub_form #prod_supp_cont").text(data.supp);
          $("#active_inactive_price").prop("checked", false);
          if (data.c_status == 0) {
            $("#updateprodsub_form #active_inactive_price").prop(
              "checked",
              true
            );
            $("#statusdata .toggle")
              .addClass("btn-success")
              .removeClass("btn-danger off");
          } else {
            $("#updateprodsub_form #active_inactive_price").prop(
              "checked",
              false
            );
            $("#statusdata .toggle")
              .addClass("btn-danger off")
              .removeClass("btn-success");
          }
        },
      });
    });
    $("#updateprodsub_form").on("submit", function (e) {
      e.preventDefault();
      var formdata = new FormData(this);
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
    });

    $("#marketer").on("change", function (e) {
      var marketer = $("#marketer option:selected").val();
      var agent_id = $("#agent_id").val();
      $.ajax({
        url: "utility/change_marketer.php",
        type: "POST",
        data: {
          marketer: marketer,
          agent_id: agent_id
        },
        success: function (res) {
          loadhistorytable(res);
        },
      });
    });

    function loadhistorytable() {
      var agent_id = $("#agent_id").val();
      $.ajax({
        url: "utility/loadhistorytable.php",
        type: "POST",
        data: {
          agent_id: agent_id
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
  }
  $("[id^='agent_pay_way']").on("click", function (e) {
    var id = $(this).attr("id").slice(13);
    if ($("#agent_pay_waycheckbox" + id).is(":checked")) {
      $("#agent_pay_waycheckbox" + id).prop("checked", false);
      $(this).addClass("paycolor_red").removeClass("paycolor_green");
    } else {
      $("#agent_pay_waycheckbox" + id).prop("checked", true);
      $(this).addClass("paycolor_green").removeClass("paycolor_red");
    }
  });

  $('[id^="agentcustomSwitch"]').on("change", function (e) {
    var id = $(this).attr("id").slice(17);

    $.ajax({
      url: "utility/updatesupplierstatusagent.php",
      type: "POST",
      data: {
        id: id,
        agent_id: $("#agent_id").val()
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

  $(".history_agent").on("click", function (e) {
    console.log(this.id);
    var agent_id = $("#agent_id").val();
    $.ajax({
      url: "utility/loadhistorytableagentprice.php",
      type: "POST",
      data: {
        agent_id: agent_id,
        prod_id: this.id
      },
      success: function (res) {
        var data = JSON.parse(res);
        var text = ``;
        var i;
        for (i = 0; i < data.length; i++) {
          text += `
          <tr>
          <td>${data[i].price}</td>
          <td>${data[i].new_price}</td>
          <td>${data[i].user}</td>
          <td>${data[i].c_insertdate}</td>
        </tr>`;
        }
        $("#private_history").empty();
        $("#private_history").append(text);
      },
    });
  });
});

$("#deleteuser_agent_page").on("click", function (e) {
  var id = $("#deleteuser_agent_page").data("userid");
  if (confirm("למחוק משמתמש"))
    $.ajax({
      url: "utility/del_agent_user.php",
      type: "POST",
      data: {
        id: id
      },

      success: function (res) {
        $("#closeivoiceedit").trigger("click");
        $("#agent_users_data").empty();
        window.location = "?sec=users&action=manageuser";
        load_agent_users();
      },
    });
});

$("#del_file_modal").on("submit", function (e) {
  e.preventDefault();
  var formdata = new FormData(this);
  $.ajax({
    url: "utility/check_del_code_user.php",
    type: "POST",
    cache: false,
    data: formdata,
    contentType: false,
    processData: false,
    success: function (res) {
      if (res == 1) {
        alert("קוד מחיקה לא נכון");
      } else {
        window.location = "index.php?sec=msg&action=import_customers";
        $("#del_file_modal").trigger("reset");
      }
    },
  });


});
$(".load_file_id").on("click", function (e) {
  $("#file_id").val(this.id);
});