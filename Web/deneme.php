<html>

<head>
    <script>
        window.onload = function() {

            var dataPoints1 = [];
            var dataPoints2 = [];
            var dataPoints3 = [];
            var dataPoints4 = [];
            var dataPoints5 = [];

            var chart = new CanvasJS.Chart("chartContainer", {
                zoomEnabled: true,
                title: {
                    text: "Share Value of Two Companies"
                },
                axisX: {
                    title: "chart updates every 3 secs"
                },
                axisY: {
                    prefix: "$",
                    includeZero: false
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
                        yValueFormatString: "#,##0  °C",
                        dataPoints: dataPoints1
                    },
                    {
                        type: "line",
                        xValueType: "dateTime",
                        yValueFormatString: "$####.00",
                        showInLegend: true,
                        name: "Ortam Nemi",
                        dataPoints: dataPoints2
                    },
                    {
                        type: "line",
                        xValueType: "dateTime",
                        yValueFormatString: "$####.00",
                        showInLegend: true,
                        name: "Ortam Işığı",
                        dataPoints: dataPoints3
                    },
                    {
                        type: "line",
                        xValueType: "dateTime",
                        yValueFormatString: "$####.00",
                        showInLegend: true,
                        name: "Toprak Nemi",
                        dataPoints: dataPoints4
                    },
                    {
                        type: "line",
                        xValueType: "dateTime",
                        yValueFormatString: "$####.00",
                        showInLegend: true,
                        name: "Su Seviyesi",
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

            var updateInterval = 3000;
            // initial value
            var yValue1 = 600;
            var yValue2 = 605;
            var yValue3 = 615;
            var yValue4 = 104;
            var yValue5 = 120;

            var time = new Date;
            // starting at 9.30 am
            time.setHours(9);
            time.setMinutes(30);
            time.setSeconds(00);
            time.setMilliseconds(00);

            function updateChart(count) {
                count = count || 1;
                var deltaY1, deltaY2,deltaY3;
                for (var i = 0; i < count; i++) {
                    time.setTime(time.getTime() + updateInterval);
                    deltaY1 = .5 + Math.random() * (-.5 - .5);
                    deltaY2 = .5 + Math.random() * (-.5 - .5);
                    deltaY3 = .5 + Math.random() * (-.5 - .5);
                    deltaY4 = .5 + Math.random() * (-.5 - .5);
                    deltaY5 = .5 + Math.random() * (-.5 - .5);
                    // adding random value and rounding it to two digits. 
                    yValue1 = Math.round((yValue1 + deltaY1) * 100) / 100;
                    yValue2 = Math.round((yValue2 + deltaY2) * 100) / 100;
                    yValue3 = Math.round((yValue3 + deltaY3) * 100) / 100;
                    yValue4 = Math.round((yValue3 + deltaY4) * 100) / 100;
                    yValue5 = 500;

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
                }

                // updating legend text with  updated with y Value 
                chart.options.data[0].legendText = " Ortam Sıcaklık  %" + yValue1;
                chart.options.data[1].legendText = " Ortam Nemi  %" + yValue2;
                chart.options.data[2].legendText = " Ortam Işığı  %" + yValue3;
                chart.options.data[3].legendText = " Toprak Nemi  %" + yValue4;
                chart.options.data[4].legendText = " Su Seviyesi  %" + yValue5;

                chart.render();
            }
            // generates first set of dataPoints 
            updateChart(100);
            setInterval(function() {
                updateChart()
            }, updateInterval);

        }
    </script>
</head>

<body>
    <div id="chartContainer" style="height: 300px; width: 100%;"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>

</html>