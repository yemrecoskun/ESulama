<!DOCTYPE html>
<html>
<?php
require_once 'Firestore.php';
$graph;
if (isset($_POST["date"])) {
  $date = reverseDate($_POST["date"]);
  for ($i = 1; $i <= 24; $i++) {
    $graph[$i-1] = getGraphic($date, $i);
  }
}
function reverseDate($date)
{
  $splitDate = explode("-", $date);
  $newDate = $splitDate[2] . "-" . $splitDate[1] . "-" . $splitDate[0];
  return $newDate;
}
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
  <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
  <script src="script.js"></script>
  <script src="script.js"></script>


  <link href="style.css" rel="stylesheet">
  <!-- The core Firebase JS SDK is always required and must be listed first -->
  <script src="https://www.gstatic.com/firebasejs/7.6.2/firebase-app.js"></script>

  <!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
  <script defer src="https://www.gstatic.com/firebasejs/7.6.2/firebase-firestore.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.6.2/firebase-database.js"></script>
</head>

<body>
  <div id="Header">
    <div id="main">
      <span style="font-size:30px; cursor:pointer; padding-left:20px;" onclick="openNav()">&#9776;</span>
    </div>
  </div>

  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="index.php">Kontrol Paneli<span class="fa fa-dashboard fa-pull-right"></span></a>
    <a href="veriler.php">Geçmiş Veriler<span class="fa fa-calendar fa-pull-right"></span></a>
    <a href="#">Çıkış<span></span></a>
  </div>

  <div id="AnaAlan">
    <div id="uzunluk2">
      <div id="DuzenlemeAlani" style="height:100%; min-height:100%; max-height:100%;">
        <div class="Baslik">Veri Grafiği</div>
        <div style="color:#FFFBF7; margin-bottom:5px;"><b>Tarih:</b></div>
        <form method="post" action="veriler.php">
          <div style="float:left;">
            <table id="TarihTablosu" style="width: 100%;">
              <tr>
                <td class="Tarih"><input name="date" type="date" class="TarihGirdisi"></td>
              </tr>
            </table>
          </div>
          <button type="submit" class="btn btn-outline-info" style="position:relative; float:left;">Graifiği Görüntüle</button>
        </form>
        <br><br><br><br>
        <?php
        if (isset($_POST["date"])) {
          echo '<div id="chartContainer" style="height: 750px; width: 100%;border:2px solid #2E3858;"></div>';
        }
        ?>
        <script>
          function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
            document.getElementById("AnaAlan").style.width = "calc(100% - 250px)";
            document.getElementById("AnaAlan").style.left = "250px";
            document.getElementById("uzunluk2").style.padding = "0 350px 0 50px";
          };

          function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("AnaAlan").style.width = "100%";
            document.getElementById("AnaAlan").style.left = "0";
            document.getElementById("uzunluk2").style.padding = "0 10%";
          };
          <?php if (isset($_POST["date"])) {
            echo 'onload = function() {
              var options = {
                  theme: "dark2",
                  exportEnabled: true,
                  animationEnabled: true,
                  backgroundColor: "#1C2337",
                  title: {
                      text: "Sulama Sistemi Veri Grafiği"
                  },
                  subtitles: [{
                      text: "' . $date . '"
                  }],
                  axisX: {
                      title: "Veriler"
                  },
                  axisY: {
                      title: "Celsius ( °C )",
                      titleFontColor: "#C0504E",
                      lineColor: "#C0504E",
                      labelFontColor: "#C0504E",
                      tickColor: "#C0504E",
                      includeZero: false
                  },
                  axisY2: {
                      title: "Yüzde ( % )",
                      titleFontColor: "#4F81BC",
                      lineColor: "#4F81BC",
                      labelFontColor: "#4F81BC",
                      tickColor: "#4F81BC",
                      includeZero: false,
                  },
                  toolTip: {
                      shared: true
                  },
                  legend: {
                      cursor: "pointer",
                      itemclick: toggleDataSeries
                  },
                  data: [
                      //SICAKLIK
                      {
                          type: "spline",
                          name: "Ortam Sıcaklığı",
                          showInLegend: true,
                          xValueFormatString: "HH",
                          yValueFormatString: "#,##0  °C",
                          dataPoints: [{
                                  x: new Date(1998, 01, 12, 0),
                                  y: '.$graph[23]["Temperature"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 1),
                                  y: '.$graph[0]["Temperature"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 2),
                                  y: '.$graph[1]["Temperature"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 3),
                                  y: '.$graph[2]["Temperature"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 4),
                                  y: '.$graph[3]["Temperature"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 5),
                                  y: '.$graph[4]["Temperature"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 6),
                                  y: '.$graph[5]["Temperature"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 7),
                                  y: '.$graph[6]["Temperature"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 8),
                                  y: '.$graph[7]["Temperature"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 9),
                                  y: '.$graph[8]["Temperature"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 10),
                                  y: '.$graph[9]["Temperature"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 11),
                                  y: '.$graph[10]["Temperature"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 12),
                                  y: '.$graph[11]["Temperature"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 13),
                                  y: '.$graph[12]["Temperature"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 14),
                                  y: '.$graph[13]["Temperature"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 15),
                                  y: '.$graph[14]["Temperature"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 16),
                                  y: '.$graph[15]["Temperature"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 17),
                                  y: '.$graph[16]["Temperature"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 18),
                                  y: '.$graph[17]["Temperature"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 19),
                                  y: '.$graph[18]["Temperature"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 20),
                                  y: '.$graph[19]["Temperature"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 21),
                                  y: '.$graph[20]["Temperature"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 22),
                                  y: '.$graph[21]["Temperature"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 23),
                                  y: '.$graph[22]["Temperature"].'
                              }
                          ]
                      },
                      //NEM
                      {
                          type: "spline",
                          name: "Ortam Nemi",
                          axisYType: "secondary",
                          showInLegend: true,
                          xValueFormatString: "HH",
                          yValueFormatString: "##,## %",
                          dataPoints: [{
                                  x: new Date(1998, 01, 12, 0),
                                  y: '.$graph[23]["Humidity"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 1),
                                  y: '.$graph[0]["Humidity"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 2),
                                  y: '.$graph[1]["Humidity"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 3),
                                  y: '.$graph[2]["Humidity"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 4),
                                  y: '.$graph[3]["Humidity"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 5),
                                  y: '.$graph[4]["Humidity"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 6),
                                  y: '.$graph[5]["Humidity"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 7),
                                  y: '.$graph[6]["Humidity"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 8),
                                  y: '.$graph[7]["Humidity"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 9),
                                  y: '.$graph[8]["Humidity"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 10),
                                  y: '.$graph[9]["Humidity"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 11),
                                  y: '.$graph[10]["Humidity"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 12),
                                  y: '.$graph[11]["Humidity"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 13),
                                  y: '.$graph[12]["Humidity"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 14),
                                  y: '.$graph[13]["Humidity"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 15),
                                  y: '.$graph[14]["Humidity"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 16),
                                  y: '.$graph[15]["Humidity"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 17),
                                  y: '.$graph[16]["Humidity"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 18),
                                  y: '.$graph[17]["Humidity"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 19),
                                  y: '.$graph[18]["Humidity"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 20),
                                  y: '.$graph[19]["Humidity"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 21),
                                  y: '.$graph[20]["Humidity"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 22),
                                  y: '.$graph[21]["Humidity"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 23),
                                  y: '.$graph[22]["Humidity"].'
                              }
                          ]
                      },
                      //ISIK
                      { 
                          type: "spline",
                          name: "Işık",
                          axisYType: "secondary",
                          showInLegend: true,
                          xValueFormatString: "HH",
                          yValueFormatString: "##,## %",
                          dataPoints: [{
                                  x: new Date(1998, 01, 12, 0),
                                  y: '.$graph[23]["Light"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 1),
                                  y: '.$graph[0]["Light"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 2),
                                  y: '.$graph[1]["Light"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 3),
                                  y: '.$graph[2]["Light"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 4),
                                  y: '.$graph[3]["Light"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 5),
                                  y: '.$graph[4]["Light"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 6),
                                  y: '.$graph[5]["Light"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 7),
                                  y: '.$graph[6]["Light"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 8),
                                  y: '.$graph[7]["Light"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 9),
                                  y: '.$graph[8]["Light"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 10),
                                  y: '.$graph[9]["Light"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 11),
                                  y: '.$graph[10]["Light"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 12),
                                  y: '.$graph[11]["Light"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 13),
                                  y: '.$graph[12]["Light"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 14),
                                  y: '.$graph[13]["Light"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 15),
                                  y: '.$graph[14]["Light"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 16),
                                  y: '.$graph[15]["Light"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 17),
                                  y: '.$graph[16]["Light"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 18),
                                  y: '.$graph[17]["Light"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 19),
                                  y: '.$graph[18]["Light"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 20),
                                  y: '.$graph[19]["Light"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 21),
                                  y: '.$graph[20]["Light"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 22),
                                  y: '.$graph[21]["Light"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 23),
                                  y: '.$graph[22]["Light"].'
                              }
                          ]
                      },
                      //Su Seviyesi
                      {
                          type: "spline",
                          axisYType: "secondary",
                          name: "Su Seviyesi",
                          showInLegend: true,
                          xValueFormatString: "HH",
                          yValueFormatString: "##,## %",
                          dataPoints: [{
                                  x: new Date(1998, 01, 12, 0),
                                  y: '.$graph[23]["WaterLevel"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 1),
                                  y: '.$graph[0]["WaterLevel"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 2),
                                  y: '.$graph[1]["WaterLevel"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 3),
                                  y: '.$graph[2]["WaterLevel"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 4),
                                  y: '.$graph[3]["WaterLevel"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 5),
                                  y: '.$graph[4]["WaterLevel"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 6),
                                  y: '.$graph[5]["WaterLevel"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 7),
                                  y: '.$graph[6]["WaterLevel"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 8),
                                  y: '.$graph[7]["WaterLevel"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 9),
                                  y: '.$graph[8]["WaterLevel"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 10),
                                  y: '.$graph[9]["WaterLevel"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 11),
                                  y: '.$graph[10]["WaterLevel"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 12),
                                  y: '.$graph[11]["WaterLevel"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 13),
                                  y: '.$graph[12]["WaterLevel"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 14),
                                  y: '.$graph[13]["WaterLevel"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 15),
                                  y: '.$graph[14]["WaterLevel"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 16),
                                  y: '.$graph[15]["WaterLevel"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 17),
                                  y: '.$graph[16]["WaterLevel"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 18),
                                  y: '.$graph[17]["WaterLevel"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 19),
                                  y: '.$graph[18]["WaterLevel"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 20),
                                  y: '.$graph[19]["WaterLevel"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 21),
                                  y: '.$graph[20]["WaterLevel"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 22),
                                  y: '.$graph[21]["WaterLevel"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 23),
                                  y: '.$graph[22]["WaterLevel"].'
                              }
                          ]
                      },
                      //Toprak Nem
                      {
                          type: "spline",
                          name: "Toprak Nemi",
                          axisYType: "secondary",
                          showInLegend: true,
                          xValueFormatString: "HH",
                          yValueFormatString: "##,## %",
                          dataPoints: [{
                                  x: new Date(1998, 01, 12, 0),
                                  y: '.$graph[23]["EarthHumidty"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 1),
                                  y: '.$graph[0]["EarthHumidty"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 2),
                                  y: '.$graph[1]["EarthHumidty"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 3),
                                  y: '.$graph[2]["EarthHumidty"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 4),
                                  y: '.$graph[3]["EarthHumidty"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 5),
                                  y: '.$graph[4]["EarthHumidty"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 6),
                                  y: '.$graph[5]["EarthHumidty"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 7),
                                  y: '.$graph[6]["EarthHumidty"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 8),
                                  y: '.$graph[7]["EarthHumidty"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 9),
                                  y: '.$graph[8]["EarthHumidty"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 10),
                                  y: '.$graph[9]["EarthHumidty"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 11),
                                  y: '.$graph[10]["EarthHumidty"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 12),
                                  y: '.$graph[11]["EarthHumidty"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 13),
                                  y: '.$graph[12]["EarthHumidty"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 14),
                                  y: '.$graph[13]["EarthHumidty"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 15),
                                  y: '.$graph[14]["EarthHumidty"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 16),
                                  y: '.$graph[15]["EarthHumidty"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 17),
                                  y: '.$graph[16]["EarthHumidty"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 18),
                                  y: '.$graph[17]["EarthHumidty"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 19),
                                  y: '.$graph[18]["EarthHumidty"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 20),
                                  y: '.$graph[19]["EarthHumidty"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 21),
                                  y: '.$graph[20]["EarthHumidty"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 22),
                                  y: '.$graph[21]["EarthHumidty"].'
                              },
                              {
                                  x: new Date(1998, 01, 12, 23),
                                  y: '.$graph[22]["EarthHumidty"].'
                              }
                          ]
                      }
                  ]
              };
              $("#chartContainer").CanvasJSChart(options);
      
              function toggleDataSeries(e) {
                  if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                      e.dataSeries.visible = false;
                  } else {
                      e.dataSeries.visible = true;
                  }
                  e.chart.render();
              }
          }';
          }
          ?>
        </script>

</body>

</html>