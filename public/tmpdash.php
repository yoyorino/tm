<?php
/**
 * Created by PhpStorm.
 * User: stanoja
 * Date: 5/23/16
 * Time: 1:45 PM
 */

//require_once 'search.php';
echo '<br />';
//$tmpdata = DataSearch::getData();
?>
<head>
    <link href="morrisjs/morris.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="jquery/jquery.min.js"></script>
    <script src="raphael/raphael-min.js"></script>
    <script src="morrisjs/morris.min.js"></script>
</head>
<body>
<!--    <div id="myfirstchart" style="height: 250px; width: 640px"></div>-->
    <div id="mysecondchart" style="height: 250px; width: 80%"></div>
    <div id="mythirdchart" style="height: 250px; width: 80%"></div>
    <div id="myfourthchart" style="height: 250px; width: 80%"></div>


    <script>
        $.ajax({
            url: "search.php",
            cache: false,
            type: "POST",
            data: {anyVar: 'specialValue4PHPScriptAndDataBaseFilter'},
            dataType: "json",
            timeout:3000,
            success : function (data) {
                Morris.Line({
                    element: 'mysecondchart',
                    data: data,
                    xkey: 'Broj',
                    ykeys: ['y'],
                    labels: ['P'],
                    resize: true
                });
                Morris.Bar({
                    element: 'mythirdchart',
                    data: data,
                    xkey: 'Broj',
                    ykeys: ['y'],
                    labels: ['P'],
                    resize: true
                });
                var poz = 0, neg = 0, neu = 0;

                for (i=0; i < data.length; i++){
                    if (data[i]["y"] < 40)
                        neg++;
                    else if (data[i]["y"]>60)
                        poz++;
                    else
                        neu++;

                }
                Morris.Donut({
                    element: 'myfourthchart',
                    data: [
                        {label: "Positive", value: poz},
                        {label: "Neutral", value: neu},
                        {label: "Negative", value: neg}
                    ],
                    colors:["#00D000","#D0D000","#D00000"],
                    resize: true
                });

            },
            error : function (xmlHttpRequest, textStatus, errorThrown) {
                alert("Error " + errorThrown);
                if(textStatus==='timeout')
                    alert("request timed out");
            }
        });

        /*new Morris.Line({
            // ID of the element in which to draw the chart.
            element: 'myfirstchart',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.

            data: [
                { year: '2008', value: 20 },
                { year: '2009', value: 10 },
                { year: '2010', value: 5 },
                { year: '2011', value: 5 },
                { year: '2012', value: 20 }
            ],
            // The name of the data record attribute that contains x-values.
            xkey: 'year',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['value'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['Value']
        });*/
    </script>


</body>