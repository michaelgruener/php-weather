<?php

    $City = basename($_SERVER['REQUEST_URI']);

    include 'year_temp_by_city.php';
    $data = year_temp_by_city($City);

    $dataPoints = array();
    $y = 40;
    $i = 0;
    while($data[$i] != null){
        $y = $data[$i]['AvgTemperature'];
        array_push($dataPoints, array("x" => $i, "y" => $y));
        $i++;
    }

    
    ?>

    <!DOCTYPE HTML>
    <html>
    <head> 
    <script>
    window.onload = function () {
    
    var chart = new CanvasJS.Chart("chartContainer", {
        theme: "light1", // "light1", "light2", "dark1", "dark2"
        animationEnabled: true,
        zoomEnabled: true,
        title: {
            text: "Try Zooming and Panning"
        },
        data: [{
            type: "area",     
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();
    
    }
    </script>
    </head>
    <body>
    <h1>City name: <?php echo basename($_SERVER['REQUEST_URI']); ?>  </h1>
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    </body>
    </html>    