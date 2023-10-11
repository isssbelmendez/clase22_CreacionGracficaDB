<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <title>Document</title>
</head>
<body>
<figure class="highcharts-figure">
    <div id="container"></div>
</figure>
<?php
include_once'conexion.php';
?>
</body>
</html>
<script>
    Highcharts.chart('container', {

title: {
    text: 'Empresa XYZ',
    align: 'center'
},

subtitle: {
    text: 'Total de ventas anuales de los ultimos 10 años',
    align: 'center'
},

yAxis: {
    title: {
        text: 'Ventas en $'
    }
},

xAxis: {
    accessibility: {
        rangeDescription: 'Desde 2013 al 2022'
    }
},

legend: {
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'middle'
},

plotOptions: {
    series: {
        label: {
            connectorAllowed: false
        },
        pointStart: 2013
    }
},

series: [{
    name: 'Ventas anuales',
    data: [
        <?php
        include_once'conexion.php';
        $consulta = "SELECT sum(venta) as venta, fecha  from detalle_fact
       inner join encabezado_fact on detalle_fact.codigo=encabezado_fact.codigo
        GROUP by YEAR(fecha)";
        $executar= mysqli_query($conexion,$consulta);
        while($dato=mysqli_fetch_array($executar))
        {
            $d= number_format($dato[0],2,'.','');
            echo $dato[0] . ",";
        }
        ?>
       ]
}],

responsive: {
    rules: [{
        condition: {
            maxWidth: 500
        },
        chartOptions: {
            legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom'
            }
        }
    }]
}

});

</script>