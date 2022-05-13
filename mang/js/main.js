$(function () {
  $("#repeater").createRepeater();

  $(".edit-buuton").on("click", function () {
    $(this).parent().children().removeAttr("readonly");
    $(this).hide();
    $(this).parent().children().css("border", "2px solid #b0ffb0;");
    // console.log($('#userName').removeAttr('readonly'))
  });

  // $('#catfile').fileupload({
  //     url: 'scripts/category/addcategory.php',
  //     dropZone: '#dropzone',
  //     dataType: 'json',
  //     autoUpload: true,
  // }).on('fileuploadadd', function (e, data){
  //     console.log(data)
  //     var fileTypeAllowed = /.\.(gif|jpg|jpeg|png)$/i;
  //     var fileName = data.originalFiles[0]['name']
  //     var fileSize = data.originalFiles[0]['size']
  //     if(!fileTypeAllowed.test(fileName)){
  //         $('#caterror').html('File type not allowed')
  //     }
  // }).on('fileuploaddone', function (e, data){
  //
  // }).on('fileuploadprogressall', function (e, data){
  //
  //         var progress = parseInt(data.loaded / data.total * 100,10)
  //     console.log(progress)
  //         $('#progress').html(`${progress}%`)
  // })
  $("#catfile").bind("change", function () {
    alert("111");
    var filename = $("#catfile").val();
    if (/^\s*$/.test(filename)) {
      $("#noFile").text("No file chosen...");
      //$("#noFile").attr("src","../data/tasks/defualt.png");
    } else {
      //$("#noFile").attr("src","../data/tasks/defualt.png");
      $("#noFile").text(filename.replace("C:\\fakepath\\", ""));
    }
  });
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $("#blah").attr("src", e.target.result);
      };

      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }

  $("#catfile").change(function (e) {
    readURL(this);
    var file, img;
    var _URL = window.URL || window.webkitURL;

    if ((file = this.files[0])) {
      img = new Image();
      img.onload = function () {
        if (this.width < 300) {
          $("#caterror").show();
          $(".file-upload").removeClass("catactive");
          $("#btn-submit").attr("disabled", true);
          $("#caterror").html("Selected image is less than 300px");
        } else {
          $("#btn-submit").attr("disabled", false);
          $("#caterror").hide();
        }
      };
      img.onerror = function () {
        alert("not a valid file: " + file.type);
      };
      img.src = _URL.createObjectURL(file);
    }
  });

  $("#catname").bind("change", function () {
    var catName = $("#catname").val().toLowerCase();
    splitCatname = catName.split(" ");
    joinCatName = splitCatname.join("-");
    $("#catslug").val(joinCatName);
  });

  $("#producteditor").summernote({
    height: 200,
    focus: true,
  });
  $("#abouteditor").summernote({
    height: 200,
    focus: true,
  });
  $("#abouteditor_more_info").summernote({
    height: 200,
    focus: true,
  });
  $("#noteseditor").summernote({
    height: 200,
    focus: true,
  });

  $(".form-check-box").each(function () {});

  $('.category-area input[type="checkbox"]').on("change", function () {
    $('.category-area input[type="checkbox"]').not(this).prop("checked", false);
  });

  var imagesPreview = function (input, placeToInsertImagePreview) {
    if (input.files) {
      var filesAmount = input.files.length;

      console.log(filesAmount);

      if (filesAmount >= 1 && filesAmount <= 10) {
        $("#save").attr("disabled", false);
      } else if (filesAmount > 10) {
        location.reload();
        alert("You can upload maximum 10 files");

        $("#save").attr("disabled", true);
      }

      for (i = 0; i < filesAmount; i++) {
        var reader = new FileReader();

        reader.onload = function (event) {
          $($.parseHTML("<img>"))
            .attr("src", event.target.result)
            .appendTo(placeToInsertImagePreview);
        };

        reader.readAsDataURL(input.files[i]);
      }
    }
  };
  $("#save").attr("disabled", true);
  $("#multifile").bind("change", function () {
    $(".previewimage").empty();
    imagesPreview(this, "div.previewimage");
  });

  $("#productselectcatmanager").on("change", function () {
    $("#frm").submit();
  });

  $(document).ready(function () {
    $.ajax({
      url: "utility/settings.php",
      success: function (res) {
        var data = JSON.parse(res);
        $("#businessName").val(data.businessname);
        $("#businesstel").val(data.business_tel);
        $(".logo").attr("src", data.logo);

        $(".cdo input").each(function (a) {
          if (data.category_option == a + 1) {
            $(this).prop("checked", true);
          }
        });
        $(".scdo input").each(function (a) {
          if (data.subcategory_option == a + 1) {
            $(this).prop("checked", true);
          }
        });
        $(".pdo input").each(function (a) {
          if (data.product_option == a + 1) {
            $(this).prop("checked", true);
          }
        });
        $(".language input").each(function (a) {
          if (data.defaultlanguage == a + 1) {
            $(this).prop("checked", true);
          }
        });

        $("#smallimage").val(data.smallimagesize);
        $("#largeimage").val(data.largeimagesize);
        $("#showrows").val(data.showrows);

        if (data.changelanguage == 1) {
          $(".changelanguage input").prop("checked", false);
        }
      },
    });
  });

  $(".changelanguage .toggle-on").on("click", function () {
    $.ajax({
      url: "utility/change_language.php",
      data: { user_id: "one" },
      type: "POST",
      success: function (res) {
        console.log(res);
      },
    });
  });
  $(".changelanguage .toggle-off").on("click", function () {
    $.ajax({
      url: "utility/change_language.php",
      data: { user_id: "zero" },
      type: "POST",
      success: function (res) {},
    });
  });
  $(".changeip .toggle-on").on("click", function () {
    $.ajax({
      url: "utility/change_ip.php",
      data: { user_id: "one" },
      type: "POST",
      success: function (res) {
        console.log(res);
      },
    });
  });
  $(".changeip .toggle-off").on("click", function () {
    $.ajax({
      url: "utility/change_ip.php",
      data: { user_id: "zero" },
      type: "POST",
      success: function (res) {
        console.log(res);
      },
    });
  });
});
