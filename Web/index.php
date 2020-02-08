<!DOCTYPE html>
<html>
<?php
require_once 'Firestore.php';
getDocument2();
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
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <script src="script.js"></script>
  <link href="style.css" rel="stylesheet">
  <script>

  </script>
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
    <a href="#">Çıkış<span class="fa fa-calendar fa-pull-right"></span></a>
  </div>

  <div id="AnaAlan">
    <div id="uzunluk">
    <div id="chartContainer" style="position:relative; height: 500px; width: 100%;"></div>
      <div id="DuzenlemeAlani">
        <div class="Baslik" style="color:#ACB3CB; padding:15px;">SULAMA SİSTEMİ</div>
        <div id="tempID" class="degerler" style="background-image:linear-gradient(to right,#E47A67 25%,#B35673 70%,#523A55 100%);">
          <b id="temperature"></b><i class='fas fa-temperature-low' style="float:right; font-size:30px; margin-right:5px; position:relative; top:10px;"></i><br><small>Ortam Sıcaklığı</small></div>


        <div class="degerler" style="background-image:linear-gradient(to right,#2CBCC8 25%,#236D93 70%,#253B57 100%);"><b id="humidity"></b>%
          <i class='fas fa-sun' style="float:right; font-size:30px; margin-right:5px; position:relative; top:10px;"></i><br /><small>Ortam Nemi</small></div>


        <div class="degerler" style="background-image:linear-gradient(to right,#886FFB 25%,#9552DD 70%,#443770 100%);"><b id="earthHumidity"></b>%
          <i class='fas fa-tint' style="float:right; font-size:30px; margin-right:5px; position:relative; top:10px;"></i><br /><small>Toprak Nemi</small></div>


        <div class="degerler" style="background-image:linear-gradient(to right,#FFB902 25%,#BC7445 70%,#493E47 100%);"><b id="light"></b>%
          <i class='far fa-lightbulb' style="float:right; font-size:30px; margin-right:5px; position:relative; top:10px;"></i> <br /><small>Ortam Işığı</small></div>

        <div class="degerler" style="background-image:linear-gradient(to right,#E47A67 25%,#B35673 70%,#523A55 100%);"><b id="weather"></b>
          <i class='fas fa-cloud-sun-rain' style="float:right; font-size:30px; margin-right:5px; position:relative; top:10px;"></i><br /><small>Hava Durumu</small></div>

        <div class="degerler" style="background-image:linear-gradient(to right,#2CBCC8 25%,#236D93 70%,#253B57 100%);"><b id="waterLevel"></b>%
          <i class='fas fa-water' style="float:right; font-size:30px; margin-right:5px; position:relative; top:10px;"></i><br /><small>Su Seviyesi</small></div>


        <div class="degerler" style="background-image:linear-gradient(to right,#886FFB 25%,#9552DD 70%,#443770 100%);"><b id="autoSulama"></b><i class='fas fa-wifi' style="float:right; font-size:30px; margin-right:5px; position:relative; top:10px;"></i> <br /><small>OTOMATİK SULAMA SİSTEMİ</small>
        </div>


        <div class="degerler" style="background-image:linear-gradient(to right,#FFB902 25%,#BC7445 70%,#493E47 100%);"><b id="esikDeger"></b> % <i class='fas fa-arrows-alt-h' style="float:right; font-size:30px; margin-right:5px; position:relative; top:15px;"></i><br />
          <small>SULAMA EŞİK DEĞERİ</small>
        </div>
      </div>
    </div>
    <div id="AlanAyirmaCizgisi"></div>
    <div id="uzunluk1">
      <div id="DuzenlemeAlani">
        <div class="Baslik" style="color:#ACB3CB;">SULAMA AYARLARI</div>
        <div id="ButonAlani">
          <input type="submit" id="kapa" onClick="kapa()" value="KAPALI"><input type="submit" id="ac" onClick="ac()" value="AÇIK"></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#ACB3CB;">Otomatik Sistem</span>
        <div id="AlanAyirmaCizgisi" style="margin-top:30px; margin-bottom:20px;"></div>
        <!-- TOPRAK NEM AYARI-->
        <div style="color:#ACB3CB; margin-bottom:20px;">Eşik Toprak Nem Değeri (%);</div>
        <div class="slidecontainer" style="margin-bottom:3px;">
          <input type="range" min="1" max="100" value="50" class="slider" id="myRange">
          <p style="color:#ACB3CB;">*Toprak Nemi Eşik Değeri değeri: <span id="demo"></span></p>
          <button type="button" onclick="setToprakEsik();" class="btn btn-outline-info">Uygula</button>
          <!-- SICAKLIK AYARI-->
          <div id="AlanAyirmaCizgisi" style="margin-top:30px; margin-bottom:20px;"></div>
          <div style="color:#ACB3CB; margin-bottom:20px;">Eşik Sıcaklık Değeri (°C);</div>
          <div class="slidecontainer" style="margin-bottom:3px;">
            <input type="range" min="1" max="100" value="50" class="slider" id="myRangeTemp">
            <p style="color:#ACB3CB;">*Sıcaklık Eşik Değeri: <span id="demoTemp"></span></p>
            <button type="button" onclick="setTempControl();" class="btn btn-outline-info">Uygula</button>
          </div>
          <div id="AlanAyirmaCizgisi" style="margin-top:30px; margin-bottom:20px;"></div>
          <button type="button" onclick="setPumpControl();" class="btn btn-outline-info">Sulama Yap</button>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#ACB3CB;">*Motoru manuel olarak çalıştır.</span>
        </div>
      </div>
    </div>
    <script>
      var autoControl;
      var esikDeger;
      var tempEsikDeger;
      var tempDoc = document.getElementById("temperature");
      var humDoc = document.getElementById("humidity");
      var earthDoc = document.getElementById("earthHumidity");
      var lightDoc = document.getElementById("light");
      var esikDegerDoc = document.getElementById("esikDeger");
      var myRangeDoc = document.getElementById("myRange");
      var myRangeTempDoc = document.getElementById("myRangeTemp");
      var demoDoc = document.getElementById("demo");
      var demoTempDoc = document.getElementById("demoTemp");
      var weatherDoc = document.getElementById("weather");
      var waterLevelDoc = document.getElementById("waterLevel");
      var autoDoc = document.getElementById("autoSulama");
      onLoad();
      var dataPoints1 = [];
      var dataPoints2 = [];
      var dataPoints3 = [];
      var dataPoints4 = [];
      var dataPoints5 = [];

      var chart = new CanvasJS.Chart("chartContainer", {
        theme: "dark2",
        backgroundColor: "#1C2337",
        zoomEnabled: true,
        title: {
          text: "Canlı Veri Grafiği"
        },
        axisX: {
          title: ""
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
          verticalAlign: "top",
          fontSize: 22,
          fontColor: "dimGrey",
          itemclick: toggleDataSeries
        },
        data: [{
            type: "spline",
            name: "Ortam Sıcaklığı",
            showInLegend: true,
            xValueFormatString: "dateTime",
            yValueFormatString: "#,##0 °C",
            dataPoints: dataPoints1
          },
          {
            type: "line",
            xValueType: "dateTime",
            yValueFormatString: "##,## %",
            showInLegend: true,
            name: "Ortam Nemi",
            axisYType: "secondary",
            dataPoints: dataPoints2
          },
          {
            type: "line",
            xValueType: "dateTime",
            yValueFormatString: "##,## %",
            showInLegend: true,
            name: "Ortam Işığı",
            axisYType: "secondary",
            dataPoints: dataPoints3
          },
          {
            type: "line",
            xValueType: "dateTime",
            yValueFormatString: "##,## %",
            showInLegend: true,
            name: "Toprak Nemi",
            axisYType: "secondary",
            dataPoints: dataPoints4
          },
          {
            type: "line",
            xValueType: "dateTime",
            yValueFormatString: "##,## %",
            showInLegend: true,
            name: "Su Seviyesi",
            axisYType: "secondary",
            dataPoints: dataPoints5
          },
        ]
      });

      function toggleDataSeries(e) {
        if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
          e.dataSeries.visible = false;
        } else {
          e.dataSeries.visible = true;
        }
        chart.render();
      }

      // initial value
      var yValue1 = 0;
      var yValue2 = 0;
      var yValue3 = 0;
      var yValue4 = 0;
      var yValue5 = 0;

      var time = new Date;


      function updateChart(dizi) {
        time.setTime(time.getTime() + 5000);
        if (dizi != null) {
          // adding new value and rounding it to  digits. 
          yValue1 = parseInt(dizi[0]);
          yValue2 = parseInt(dizi[1]);
          yValue3 = parseInt(dizi[2]);
          yValue4 = parseInt(dizi[3]);
          yValue5 = parseInt(dizi[4]);
        }
        // pushing the new values
        dataPoints1.push({
          x: time.getTime(),
          y: yValue1
        });
        dataPoints2.push({
          x: time.getTime(),
          y: yValue2
        });
        dataPoints3.push({
          x: time.getTime(),
          y: yValue3
        });
        dataPoints4.push({
          x: time.getTime(),
          y: yValue4
        });
        dataPoints5.push({
          x: time.getTime(),
          y: yValue5
        });


        // updating legend text with  updated with y Value 
        chart.options.data[0].legendText = " Ortam Sıcaklık " + yValue1 + "C";
        chart.options.data[1].legendText = " Ortam Nemi " + yValue2 + "%";
        chart.options.data[2].legendText = " Ortam Işığı " + yValue3 + "%";
        chart.options.data[3].legendText = " Toprak Nemi " + yValue4 + "%"
        chart.options.data[4].legendText = " Su Seviyesi " + yValue5 + "%";
        chart.render();
      }
      // generates first set of dataPoints 
      updateChart();

      function onLoad() {
        refresh();
        autoControl = <?php echo $_SESSION["pump"]["autoControl"]; ?>;
        esikDeger = <?php echo $_SESSION["pump"]["EarthHumidty"]; ?>;
        tempEsikDeger = <?php echo $_SESSION["pump"]["tempControl"] ?>;
        weatherControl = <?php echo $_SESSION["data"]["Weather"]; ?>;
        myRangeDoc.value = esikDeger;
        demoDoc.innerHTML = esikDeger;
        myRangeTempDoc.value = tempEsikDeger;
        demoTempDoc.innerHTML = tempEsikDeger;
        if (weatherControl == 0) {
          weatherDoc.innerHTML = "Yağış Yok";
        } else if (weatherControl == 1) {
          weatherDoc.innerHTML = "Yağış Var";
        }
        if (autoControl) {
          document.getElementById("ac").style.backgroundColor = "white";
          document.getElementById("ac").style.color = "#1AE8D1";
          document.getElementById("kapa").style.backgroundColor = "#1AE8D1";
          document.getElementById("kapa").style.color = "white";
          autoDoc.innerHTML = "Açık";
        } else {
          document.getElementById("kapa").style.backgroundColor = "white";
          document.getElementById("kapa").style.color = "#1AE8D1";
          document.getElementById("ac").style.backgroundColor = "#1AE8D1";
          document.getElementById("ac").style.color = "white";
          autoDoc.innerHTML = "Kapalı";
        }
      }

      setInterval(myMethod, 5000);

      function myMethod() {
        refresh();
      }

      function refresh() {
        $.ajax({
          type: "post",
          url: "getData.php",
          success: function(response) {
            sRes = splitResponse(response);
            if (tempDoc.innerHTML != sRes[0] + '<sup>o</sup>C') {
              tempDoc.innerHTML = sRes[0] + '<sup>o</sup>C';
              colorChange(tempDoc);
            }
            if (humDoc.innerHTML != sRes[1]) {
              humDoc.innerHTML = sRes[1];
              colorChange(humDoc);
            }
            if (earthDoc.innerHTML != sRes[3]) {
              earthDoc.innerHTML = sRes[3];
              colorChange(earthDoc);
            }
            if (lightDoc.innerHTML != sRes[2]) {
              lightDoc.innerHTML = sRes[2];
              colorChange(lightDoc);
            }
            if (esikDegerDoc.innerHTML != sRes[7]) {
              esikDeger = sRes[7];
              myRangeDoc.value = esikDeger;
              demoDoc.innerHTML = esikDeger;
              esikDegerDoc.innerHTML = sRes[7];
              colorChange(esikDegerDoc);
            }
            if (waterLevelDoc.innerHTML != sRes[4]) {
              waterLevelDoc.innerHTML = sRes[4];
              colorChange(waterLevelDoc);
            }
            if (sRes[5] == 0 && weatherDoc.innerHTML != "Yağış Yok") {
              weatherDoc.innerHTML = "Yağış Yok";
              colorChange(weatherDoc);
            } else if (sRes[5] == 1 && weatherDoc.innerHTML != "Yağış Var") {
              weatherDoc.innerHTML = "Yağış Var";
              colorChange(weatherDoc);
            }
            updateChart(sRes);
          }
        });
      };

      function colorChange(doc) {
        doc.style = " color:rgb(70, 243, 122)";
        setTimeout(function() {
          doc.style = "color:white";
        }, 1000);

      }

      function splitResponse(data) {
        /* 
        [0] : Temperature,
        [1] : Humidity, 
        [2] : Light ,
        [3] : EarthHumidty , 
        [4] : WaterLevel,
        [5] : Weather,
        [6] : Auto Control,
        [7] : EarthHumidty Esik Degeri,
        */
        var result = data.split(":");
        return result;
      }

      function autoControlButtons() {
        if (autoControl == 1) {
          autoControl = 0;
        } else if (autoControl == 0) {
          autoControl = 1;
        }
        setAutoControl(autoControl);
      }

      function setToprakEsik() {
        let earthHumidity = myRangeDoc.value;
        $.ajax({
          type: "post",
          url: "setData.php",
          data: {
            "earthHumidty": earthHumidity,
          },
          success: function(response) {
            if (response == "success") {
              alert("İşlem Başarılı");
              esikDeger = earthHumidity;
              myRangeDoc.value = earthHumidity;
              demoDoc.innerHTML = earthHumidity;
              esikDegerDoc.innerHTML = earthHumidity;
              colorChange(esikDegerDoc);
            } else {
              alert(response);
            }
          }
        });
      };

      function setAutoControl(autoControl) {
        $.ajax({
          type: "post",
          url: "setData.php",
          data: {
            "autoControl": autoControl,
          },
          success: function(response) {
            if (response == "success") {
              alert("İşlem Başarılı");
            } else {
              alert(response);
            }
          }
        });
      };

      function setPumpControl() {
        $.ajax({
          type: "post",
          url: "setData.php",
          data: {
            "pumpControl": 1,
          },
          success: function(response) {
            if (response == "success") {
              alert("İşlem Başarılı");
            } else {
              alert(response);
            }
          }
        });
      };

      function setTempControl() {
        $.ajax({
          type: "post",
          url: "setData.php",
          data: {
            "tempControl": tempEsikDeger,
          },
          success: function(response) {
            if (response == "success") {
              alert("İşlem Başarılı");
            } else {
              alert(response);
            }
          }
        });
      };

      function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        document.getElementById("AnaAlan").style.width = "calc(100% - 250px)";
        document.getElementById("AnaAlan").style.left = "250px";
        document.getElementById("uzunluk").style.padding = "0 300px 0 50px";
        document.getElementById("uzunluk1").style.padding = "0 300px 0 50px";
      }

      function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("AnaAlan").style.width = "100%";
        document.getElementById("AnaAlan").style.left = "0";
        document.getElementById("uzunluk").style.padding = "0 10%";
        document.getElementById("uzunluk1").style.padding = "0 10%";
      }

      function ac() {
        if (autoControl != 1) {
          document.getElementById("ac").style.backgroundColor = "white";
          document.getElementById("ac").style.color = "#1AE8D1";
          document.getElementById("kapa").style.backgroundColor = "#1AE8D1";
          document.getElementById("kapa").style.color = "white";
          autoControlButtons();
          autoDoc.innerHTML = "Açık";
        }
      }

      function kapa() {
        if (autoControl != 0) {
          document.getElementById("kapa").style.backgroundColor = "white";
          document.getElementById("kapa").style.color = "#1AE8D1";
          document.getElementById("ac").style.backgroundColor = "#1AE8D1";
          document.getElementById("ac").style.color = "white";
          autoControlButtons();
          autoDoc.innerHTML = "Kapalı";
        }
      }
      var slider = document.getElementById("myRange");
      var output = document.getElementById("demo");
      output.innerHTML = slider.value;
      slider.oninput = function() {
        output.innerHTML = this.value;
        esikDeger = this.value;
      }
      var sliderTemp = document.getElementById("myRangeTemp");
      var outputTemp = document.getElementById("demoTemp");
      outputTemp.innerHTML = sliderTemp.value;
      sliderTemp.oninput = function() {
        outputTemp.innerHTML = this.value;
        tempEsikDeger = this.value;
      }
    </script>

</body>

</html>