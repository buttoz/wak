<footer class="main-footer">
  <p> <strong><?php echo $lang['copyright'] ?> <a href="#"><?php echo $lang['bakecake'] ?></a>.</strong> <?php echo $lang['all_rights'] ?>.</p>
  <p class="version"><?php echo $lang['version'] ?> 1.0.0</p>
</footer>

</div>
<!-- ./wrapper -->

<!-- jQuery -->

<script src="./js/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="./js/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- Bootstrap 4 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="./js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./js/adminlte.min.js"></script>
<!-- ChartJS -->
<script src="./js/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Sparkline -->
<script src="./js/sparkline.js"></script>


<!-- AdminLTE for demo purposes -->
<script src="./js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="./js/dashboard.js"></script>
<script src="./js/jquery.dataTables.min.js"></script>
<script src="./js/dataTables.bootstrap4.min.js"></script>
<script src="./js/dataTables.responsive.min.js"></script>
<script src="./js/responsive.bootstrap4.min.js"></script>
<script src="./js/dataTables.buttons.min.js"></script>
<script src="./js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<?php if ($_SESSION['lang'] == 'ar' || $_SESSION['lang'] == 'he') {
?>
  <script src="https://cdn.rtlcss.com/bootstrap/v4.5.3/js/bootstrap.min.js"></script>
<?php
} ?>
<script src="./js/jszip.min.js"></script>
<script src="./js/pdfmake.min.js"></script>
<script src="./js/vfs_fonts.js"></script>
<script src="./js/buttons.html5.min.js"></script>
<script src="./js/buttons.print.min.js"></script>
<script src="./js/summernote-bs4.min.js"></script>
<script src="./js/repeater.js"></script>
<script src="./js/jQuery.tagify.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="./js/systemtable.js"></script>
<?
if (!str_contains($_SERVER['REQUEST_URI'], 'client_plus')) {
?>
  <script src="./js/agents.js?<?= time() ?>"></script>
<? } ?>
<script src="./js/clients.js?<?= time() ?>"></script>
<script src="./js/custom.js?<?= time() ?>"></script>
<script src="./js/deparments.js?<?= time() ?>"></script>
<script src="./js/permissions.js?<?= time() ?>"></script>
<script src="./js/subs.js?<?= time() ?>"></script>
<script src="./js/prodandprice.js?<?= time() ?>"></script>
<script src="./js/suppliers.js?<?= time() ?>"></script>
<script src="./js/pay.js?<?= time() ?>"></script>
<script src="./js/marketers.js?<?= time() ?>"></script>
<script src="./js/settings.js?<?= time() ?>"></script>
<script src="./js/acounting.js?<?= time() ?>"></script>
<script src="./js/acounting_marketer.js?<?= time() ?>"></script>
<script src="./js/reports.js?<?= time() ?>"></script>


<script src="./js/main.js"></script>


<noscript>
  <style>
    .wrapper {
      display: none;
    }

    .nojs-content {
      display: unset !important;
    }
  </style>
</noscript>

<?php

if ($_SESSION['lang'] == 'ar') {
?>
  <script src="./js/arabic.js"></script>
<?php
} elseif ($_SESSION['lang'] == 'he') {
?>
  <script src="./js/hebrew.js"></script>
<?php
} else {
?>
  <script src="./js/english.js"></script>
<?php
}

?>


<? if (!isset($_GET['sec'])) { ?>


  <script>
    $(function() {
      $(function() {
        var cache = {};
        $("#city").autocomplete({
          minLength: 2,
          source: function(request, response) {
            var term = request.term;
            if (term in cache) {
              response(cache[term]);
              return;
            }

            $.getJSON("getcity.php", request, function(data, status, xhr) {
              cache[term] = data;
              response(data);
            });
          }
        });
      });
      $(function() {
        var cache = {};
        $("#street_customer").autocomplete({
          source: function(request, response) {
            request['test'] = $("#city_code").val();

            $.getJSON("getstreet_by_city.php", request, function(data, status, xhr) {
              response(data);
            });
          }
        });
      });

      $("#city").on("blur", function() {
        $.ajax({
          method: "GET",
          url: "getcity_id.php",
          data: {
            city: $(this).val()
          },
          success: function(data) {
            $("#city_code").val(data);
          },
        })
      })

      var cache = {};
      $("#manageagent #city").autocomplete({
        minLength: 2,
        source: function(request, response) {
          var term = request.term;
          if (term in cache) {
            response(cache[term]);
            return;
          }

          $.getJSON("getcity.php", request, function(data, status, xhr) {
            cache[term] = data;
            response(data);
          });
        }
      });
    });
    $(function() {
      /* ChartJS
       * -------
       * Here we will create a few charts using ChartJS
       */




      //--------------
      //- AREA CHART -
      //--------------

      // $.ajax({
      //   url: "utility/getallclaims_graph.php",
      //   type: "POST",

      //   success: function(res) {
      //     var data4 = JSON.parse(res);
      //     console.log(data4);

      //     var myChart1 = document.getElementById('chartarea4').getContext('2d');

      //     const data = {
      //       labels: data4[2],
      //       datasets: [{
      //           label: 'בטיפול',
      //           backgroundColor: '#28a745',
      //           data: data4[0]
      //         },
      //         {
      //           label: 'בפיגור',
      //           backgroundColor: '#dc3545',
      //           data: data4[1],
      //         }
      //       ]
      //     };
      //     chartarea1 = new Chart(myChart1, config = {
      //       type: 'bar',
      //       data: data,
      //       options: {
      //         indexAxis: 'x',
      //         // Elements options apply to all of the options unless overridden in a dataset
      //         // In this case, we are setting the border of each horizontal bar to be 2px wide
      //         elements: {
      //           bar: {
      //             borderWidth: 2,
      //           }
      //         },
      //         responsive: true,
      //         plugins: {
      //           legend: {
      //             position: 'right',
      //           },
      //           title: {
      //             display: true,
      //             text: ''
      //           }
      //         }
      //       },
      //     });

      //   },
      // });

      $.ajax({
        url: "utility/getclaims_graph.php",
        type: "POST",

        success: function(res) {
          var data3 = JSON.parse(res);

          var myChart1 = document.getElementById('chartarea1').getContext('2d');

          const labels = ['דצמבר', 'נובמבר', 'אוקטובר', 'ספטמבר', 'אוגוסט', 'יולי', 'יוני', 'מאי', 'אפריל', 'מרץ', 'פברואר', 'ינואר'];

          const data = {
            labels: labels,
            datasets: [{
                label: 'נפתח',
                backgroundColor: '#93c01f',
                data: [data3[11].opened, data3[10].opened, data3[9].opened, data3[8].opened, data3[7].opened, data3[6].opened, data3[5].opened, data3[4].opened, data3[3].opened, data3[2].opened, data3[1].opened, data3[0].opened, ]
              },
              {
                label: 'בוטל',
                backgroundColor: '#FF2F2F',
                data: [data3[11].canceled, data3[10].canceled, data3[9].canceled, data3[8].canceled, data3[7].canceled, data3[6].canceled, data3[5].canceled, data3[4].canceled, data3[3].canceled, data3[2].canceled, data3[1].canceled, data3[0].canceled, ],
              },
            ]
          };
          chartarea1 = new Chart(myChart1, config = {
            type: 'bar',
            data: data,
            options: {
              indexAxis: 'x',
              scales: {
                y: {
                  beginAtZero: true,
                  ticks: {
                    stepSize: 1
                  }
                }
              },
              // Elements options apply to all of the options unless overridden in a dataset
              // In this case, we are setting the border of each horizontal bar to be 2px wide
              elements: {
                bar: {
                  borderWidth: 2,
                }
              },
              responsive: true,
              plugins: {
                legend: {
                  position: 'right',
                },
              }
            },
          });
        },
      });


      $.ajax({
        url: "utility/getclaims.php",
        type: "POST",

        success: function(res) {
          var data = JSON.parse(res);
          var claims = data;

          var myChart3 = document.getElementById('chartarea3').getContext('2d');


          var massPopChart = new Chart(myChart3, {
            type: 'pie', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
            data: {
              labels: claims.suppliers,
              datasets: [{
                label: 'Population',
                data: claims.items,
                //backgroundColor:'green',
                backgroundColor: [
                  '#D72638',
                  '#3F88C5',
                  '#F49D37',
                  '#140F2D',
                  '#9A937E',
                  '#8B577F',
                ],
                borderWidth: 2,
                borderColor: '#777',
                hoverBorderWidth: 4,
                hoverBorderColor: '#000'
              }]
            },
            options: {

              legend: {
                display: true,
                position: 'right',
                labels: {
                  fontColor: '#000'
                }
              },
              layout: {
                padding: {
                  left: 50,
                  right: 0,
                  bottom: 0,
                  top: 0
                }
              },
              tooltips: {
                enabled: true
              }



            }
          });

        },
      });
      $.ajax({
        url: "utility/getservtypesdashboard.php",
        type: "POST",

        success: function(res) {
          var data = JSON.parse(res);
          var claims = data;

          var myChart2 = document.getElementById('chartarea2').getContext('2d');

          var massPopChart = new Chart(myChart2, {
            type: 'pie', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
            data: {
              labels: claims.serv,
              datasets: [{
                label: 'Population',
                data: claims.items,
                //backgroundColor:'green',
                backgroundColor: [
                  '#577590',
                  '#43aa8b',
                  '#90be6d',
                  '#f9c74f',
                  '#f8961e',
                  '#f3722c',
                  '#f94144',
                ],
                borderWidth: 2,
                borderColor: '#777',
                hoverBorderWidth: 4,
                hoverBorderColor: '#000'
              }]
            },
            options: {

              legend: {
                display: true,
                position: 'right',
                labels: {
                  fontColor: '#000'
                }
              },
              layout: {
                padding: {
                  left: 50,
                  right: 0,
                  bottom: 0,
                  top: 0
                }
              },
              tooltips: {
                enabled: true
              }



            }
          });

        },
      });







      // $.ajax({
      //   url: "utility/get_claim_status.php",
      //   type: "POST",
      //   success: function(res) {
      //     var data2 = JSON.parse(res);




      //     var myChart2 = document.getElementById('chartarea2').getContext('2d');

      //     $("#late_tasks").text(data2.done);

      //     var massPopChart = new Chart(myChart2, {
      //       type: 'doughnut', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
      //       data: {
      //         labels: ['בפיגור', 'לביצוע'],
      //         datasets: [{
      //           label: 'Population',
      //           data: [
      //             data2.done,
      //             data2.todo,
      //           ],
      //           //backgroundColor:'green',
      //           backgroundColor: [
      //             '#dc3545',
      //             '#28a745',

      //           ],
      //           borderWidth: 2,
      //           borderColor: '#777',
      //           hoverBorderWidth: 4,
      //           hoverBorderColor: '#000'
      //         }]
      //       },
      //       options: {
      //         title: {
      //           display: true,
      //           text: 'Largest Cities In Massachusetts',
      //           fontSize: 25,
      //           responsive: true
      //         },
      //         legend: {
      //           display: true,
      //           position: 'right',
      //           labels: {
      //             fontColor: '#000'
      //           }
      //         },
      //         layout: {
      //           padding: {
      //             left: 50,
      //             right: 0,
      //             bottom: 0,
      //             top: 0
      //           }
      //         },
      //         tooltips: {
      //           enabled: true
      //         }



      //       }
      //     });

      //   },
      // });
      // //Create the line chart
      // // Get context with jQuery - using jQuery's .get() method.
      // var areaChartCanvas = $('#chartarea').get(0).getContext('2d')
      // // This will get the first returned node in the jQuery collection.
      // var areaChart123 = new Chart(areaChartCanvas, {
      //   type: 'inline',
      //   data: [6, 7],
      // })

      // $('#chartarea').click(

      //   function(evt) {
      //     // var activePoint = areaChart.getElementAtEvent(evt);
      //     console.log('activePoint', evt)
      //     // var url = ... make link with data from activePoint

      //     //  window.location = 'http://127.0.0.1/nahal/mang/index.php?sec=projects&action=manageprojects.php'
      //   })







    });
  </script>
<? } ?>
</body>

</html>