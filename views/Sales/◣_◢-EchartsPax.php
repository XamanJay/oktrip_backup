<!DOCTYPE html>  
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>ReporteVtasWebMensuales </title>
    <link href="../../css/animate/Ollin.css" rel="stylesheet">
     
	<?php include("views/partialViews/_adminPanelStyles.html"); ?>
	
    
</head>
<link href="../../css/tables3d.css" rel="stylesheet" type="text/css">
<body class="nav-md">
	<div class="container body">
		<div class="main_container">

			<!-- sidebar -->
			<?php include("views/partialViews/_adminPanelSidebar.php"); ?>

			<!-- top navigation -->
			<?php // include("views/partialViews/_adminPanelTopNav.php"); ?>

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="clear"></div>
				<div class="row">
					<div class="col-md-12">
						<div class="x_panel">
							<div class="x_title">
								<?php  include "◣_◢-Graficas_Filtros.php";  ?>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<div id="controlPanel"></div>
								<div class="clear"></div>
							
                           
                                
                                
                                
                          <?php    $ima = "451000";     ?>

                                    <script >
                                      /*  var img = '<?php// echo $ima;?>'
                                        alert  ( img ) ;*/
                                    </script>
                                
                                
                                
                                
                                

    <!-- Prepare a Dom with size (width and height) for ECharts -->
    <div id="main" style="height:600px"></div>
    <!-- ECharts import -->
    
    <script  src="../../js/echarts/dist/echarts.js"></script>                                


    <script type="text/javascript">
        // configure for module loader
        
        require.config({
            paths: {
                echarts: '../../js/echarts/dist'
            }
        });
        
        // use
        require(
            [
                'echarts',
               'echarts/chart/line',
                'echarts/chart/bar' // require the specific chart type
            ],
            function (ec) {
                // Initialize after dom ready
             
               
               
                var Web_Pax_Ene = 0
                var Web_Pax_Feb = '<?php  echo  $Web_Pax_Feb ;  ?>'
                var Web_Pax_Mar = '<?php  echo  $Web_Pax_Mar ;  ?>'
                var Web_Pax_Abr = '<?php  echo  $Web_Pax_Abr ;  ?>'
                var Web_Pax_May = '<?php  echo  $Web_Pax_May ;  ?>'
                var Web_Pax_Jun = '<?php  echo  $Web_Pax_Jun ;  ?>'
                var Web_Pax_Jul = '<?php  echo   $Web_Pax_Jul ;  ?>'
                var Web_Pax_Ago = '<?php  echo  $Web_Pax_Ago ;  ?>'
                var Web_Pax_Sep = '<?php  echo  $Web_Pax_Sep ;  ?>'
                var Web_Pax_Oct = '<?php  echo  $Web_Pax_Oct ;  ?>'
                var Web_Pax_Nov = '<?php  echo  $Web_Pax_Nov ;  ?>'
                var Web_Pax_Dic = '<?php  echo  $Web_Pax_Dic ;  ?>'
                var TotPaxEneOff_V = 718
                var TotPaxFebOff_V = '<?php  echo  $TotPaxFebOff_V ;  ?>'
                var TotPaxMarOff_V = '<?php  echo  $TotPaxMarOff_V ;  ?>'
                var TotPaxAbrOff_V = '<?php  echo  $TotPaxAbrOff_V ;  ?>'
                var TotPaxMayOff_V = '<?php  echo  $TotPaxMayOff_V ;  ?>'
                var TotPaxJunOff_V = '<?php  echo  $TotPaxJunOff_V ;  ?>'
                var TotPaxJulOff_V = '<?php  echo $TotPaxJulOff_V ;  ?>'
                var TotPaxAgoOff_V = '<?php  echo  $TotPaxAgoOff_V ;  ?>'
                var TotPaxSepOff_V = '<?php  echo  $TotPaxSepOff_V ;  ?>'
                var TotPaxOctOff_V = '<?php  echo  $TotPaxOctOff_V ;  ?>'
                var TotPaxNovOff_V = '<?php  echo  $TotPaxNovOff_V ;  ?>'
                var TotPaxDicOff_V = '<?php  echo $TotPaxDicOff_V ;  ?>'
                
              
                
                //                      alert  ( Tot_Pub_Feb ) ;
                
                var myChart = ec.init(document.getElementById('main')); 
                
                var option = {
                   
                    title : {
                    text: 'PAX  ',
                    subtext: 'WEB/OFFLINE(+Volaris)'
                   },
                    
                    
                    tooltip: {
                        show: true
                    },
                    legend: {
                        padding: 5,
                        itemGap: 10,
                        data:['WEB', 'OFFLINE']
                    },
                    
                    
                   
                    
                    
                    
                    
                    
                    
        toolbox: {
        show : true,
        orient: 'horizontal',     
                                   // 'horizontal' ¦ 'vertical'
        x: 'right',              
                                   // 'center' ¦ 'left' ¦ 'right'
                                   // ¦ {number}
        y: 'top',               
                                   // 'top' ¦ 'bottom' ¦ 'center'
                                   // ¦ {number}
        color : ['#1e90ff','#22bb22','#4b0082','#d2691e'],
        backgroundColor: 'rgba(0,0,0,0)', 
        borderColor: '#ccc',       
        borderWidth: 0,           
        padding: 5,                
        showTitle: true,
        feature : {
            mark : {
                show : false,
                title : {
                    mark : 'mark',
                    markUndo : 'markundo',
                    markClear : 'markclear'
                },
                lineStyle : {
                    width : 1,
                    color : '#1e90ff',
                    type : 'dashed'
                }
            },
            dataZoom : {
                show : true,
                title : {
                    dataZoom : 'ZOOM',
                    dataZoomReset : 'RESET'
                }
            },
            dataView : {
                show : false,
                title : 'title',
                readOnly: true,
                lang : ['lang', 'lang', 'lang'],
                optionToContent: function(opt) {
                    var axisData = opt.xAxis[0].data;
                    var series = opt.series;
                    var table = '<table style="width:100%;text-align:center"><tbody><tr>'
                                 + '<td>td</td>'
                                 + '<td>' + series[0].name + '</td>'
                                 + '<td>' + series[1].name + '</td>'
                                 + '</tr>';
                    for (var i = 0, l = axisData.length; i < l; i++) {
                        table += '<tr>'
                                 + '<td>' + axisData[i] + '</td>'
                                 + '<td>' + series[0].data[i] + '</td>'
                                 + '<td>' + series[1].data[i] + '</td>'
                                 + '</tr>';
                    }
                    table += '</tbody></table>';
                    return table;
                }
            },
            magicType: {
                show : true,
                title : {
                    line : 'LINEAL',
                    bar : 'BARRAS',
                    stack : 'UNIR',
                    tiled : 'DESUNIR'
                },
                type : ['line', 'bar', 'stack', 'tiled']
            },
            restore : {
                show : false,
                title : 'title',
                color : 'black'
            },
            saveAsImage : {
                show : false,
                title : 'title',
                type : 'jpeg',
                lang : ['lang'] 
            },
            myTool : {
                show : true,
                title : 'title',
                icon : 'image://../asset/ico/favicon.png',
                onclick : function (){
                    alert('myToolHandler')
                }
            }
        }
    },
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                     calculable : true,
                    
                    xAxis : [
                        {
                            type : 'category',
                            data : ["ENE.", "FEB.", "MAR.", "ABR.", "MAY.", "JUN.","JUL.", "AGO.", "SEP.", "OCT.", "NOV.", "DIC."]
                        }
                    ],
                    yAxis : [
                        {
                            type : 'value',
                           
                        }
                    ],
                    series : [
                        {
                           "name":'WEB',
                            "type":'bar',
                            "data":[Web_Pax_Ene, Web_Pax_Feb, Web_Pax_Mar, Web_Pax_Abr, Web_Pax_May, Web_Pax_Jun, Web_Pax_Jul, Web_Pax_Ago, Web_Pax_Sep, Web_Pax_Oct, Web_Pax_Nov, Web_Pax_Dic],                                                                                                                                                                                                                                                                                                        
                           // "data":[50000,40000,30000,20000,10000,60000,70000,80000,90000,10000,20000,40000]   
                            
                            
                           
                            
                            
                            
                        },
                        {
                           "name":'OFFLINE',
                            "type":'bar',
                            "data":[TotPaxEneOff_V, TotPaxFebOff_V, TotPaxMarOff_V, TotPaxAbrOff_V, TotPaxMayOff_V, TotPaxJunOff_V, TotPaxJulOff_V, TotPaxAgoOff_V, TotPaxSepOff_V, TotPaxOctOff_V, TotPaxNovOff_V, TotPaxDicOff_V],                                                                                                                                                                                                                                                                                                        
                           // "data":[500,400,300,200,100,600,700,800,900,100,200,400]    
                            
                            
                           
                            
                            
                        }
                        
                    ]
                };
        
                // Load data into the ECharts instance 
                myChart.setOption(option); 
            }
        );
    </script>

                                
                                
                                
	
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- footer content -->
			<footer>
				<div class="pull-right">
					M&eacute;xico  ||||||||||||||||||||  <a href="www.oktrip.mx">www.oktrip.mx !</a> 
				</div>
				<div class="clearfix"></div>
			</footer>
		</div>
	</div>
	<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="/js/nprogress/nprogress.js"></script>
	<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/js/scripts-admin.js"></script> 
    
   

	
</body>
</html>

