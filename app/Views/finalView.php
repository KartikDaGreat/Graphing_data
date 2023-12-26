<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Styles -->
<style>
    #chartdiv {
        width: 100%;
        height: 500px;
    }
</style>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<script>
    am5.ready(function() {
        <?php
        $json = '<?php echo $result?>';
        ?>
        let emp = json_parse($json);
        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new("chartdiv");

        const myTheme = am5.Theme.new(root);

        // Move minor label a bit down
        myTheme.rule("AxisLabel", ["minor"]).setAll({
            dy: 1
        });

        // Tweak minor grid opacity
        myTheme.rule("Grid", ["minor"]).setAll({
            strokeOpacity: 0.08
        });

        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([
            am5themes_Animated.new(root),
            myTheme
        ]);


        // Create chart
        // https://www.amcharts.com/docs/v5/charts/xy-chart/
        var chart = root.container.children.push(am5xy.XYChart.new(root, {
            panX: false,
            panY: false,
            wheelX: "panX",
            wheelY: "zoomX",
            paddingLeft: 0
        }));


        // Add cursor
        // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
            behavior: "zoomX"
        }));
        cursor.lineY.set("visible", false);


        function generateDatas() {
            var data = [];
            emp.forEach((rec) => {
                var date = new Date();
                var temp = rec.REPORTINGDATETIME;
                var year = temp.slice(0, 4);
                var mon = temp.slice(4, 6);
                var day = temp.slice(6, 8);
                var hour = temp.slice(9, 11);
                var mint = temp.slice(11, 13);
                date.setFullYear(parseInt(year));
                date.setMonth(parseInt(mon));
                date.setDate(parseInt(day));
                date.setHours(parseInt(hour), parseInt(mint), 1, 0); //hour:min:sec:millisec
                var val = rec.CPULOAD;
                data.push({
                    date: date,
                    value: val
                });
            });
            return data;
        }


        // Create axes
        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
        var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
            maxDeviation: 0,
            baseInterval: {
                timeUnit: "day",
                count: 1
            },
            renderer: am5xy.AxisRendererX.new(root, {
                minorGridEnabled: true,
                minGridDistance: 200,
                minorLabelsEnabled: true
            }),
            tooltip: am5.Tooltip.new(root, {})
        }));

        xAxis.set("minorDateFormats", {
            day: "dd",
            month: "MM"
        });

        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
            renderer: am5xy.AxisRendererY.new(root, {})
        }));


        // Add series
        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
        var series = chart.series.push(am5xy.LineSeries.new(root, {
            name: "Series",
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: "value",
            valueXField: "date",
            tooltip: am5.Tooltip.new(root, {
                labelText: "{valueY}"
            })
        }));

        // Actual bullet
        series.bullets.push(function() {
            var bulletCircle = am5.Circle.new(root, {
                radius: 5,
                fill: series.get("fill")
            });
            return am5.Bullet.new(root, {
                sprite: bulletCircle
            })
        })

        // Add scrollbar
        // https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
        chart.set("scrollbarX", am5.Scrollbar.new(root, {
            orientation: "horizontal"
        }));

        var data = generateDatas();
        series.data.setAll(data);


        // Make stuff animate on load
        // https://www.amcharts.com/docs/v5/concepts/animations/
        series.appear(1000);
        chart.appear(1000, 100);

    }); // end am5.ready()
</script>

<!-- HTML -->
<div id="chartdiv"></div>