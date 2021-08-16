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
             
               
               
                var Off_Net_Ene = 185793
                var Off_Net_Feb = '<?php  echo  $Off_Net_Feb;  ?>'
                var Off_Net_Mar = '<?php  echo  $Off_Net_Mar;  ?>'
                var Off_Net_Abr = '<?php  echo  $Off_Net_Abr;  ?>'
                var Off_Net_May = '<?php echo $Off_Net_May; ?>'
                var Off_Net_Jun = '<?php echo $Off_Net_Jun; ?>'
                var Off_Net_Jul = '<?php echo $Off_Net_Jul; ?>'
                var Off_Net_Ago = '<?php echo $Off_Net_Ago; ?>'
                var Off_Net_Sep = '<?php echo $Off_Net_Sep; ?>'
                var Off_Net_Oct = '<?php echo $Off_Net_Oct; ?>'
                var Off_Net_Nov = '<?php echo $Off_Net_Nov; ?>'
                var Off_Net_Dic = '<?php echo $Off_Net_Dic; ?>'
                 var Off_Pub_Ene = 222053
                var Off_Pub_Feb = '<?php echo $Off_Pub_Feb; ?>'
                var Off_Pub_Mar = '<?php echo $Off_Pub_Mar; ?>'
                var Off_Pub_Abr = '<?php echo $Off_Pub_Abr; ?>'
                var Off_Pub_May = '<?php echo $Off_Pub_May; ?>'
                var Off_Pub_Jun = '<?php echo $Off_Pub_Jun; ?>'
                var Off_Pub_Jul = '<?php echo $Off_Pub_Jul; ?>'
                var Off_Pub_Ago = '<?php echo $Off_Pub_Ago; ?>'
                var Off_Pub_Sep = '<?php echo $Off_Pub_Sep; ?>'
                var Off_Pub_Oct = '<?php echo $Off_Pub_Oct; ?>'
                var Off_Pub_Nov = '<?php echo $Off_Pub_Nov; ?>'
                var Off_Pub_Dic = '<?php echo $Off_Pub_Dic; ?>'
                
              
                
                //                      alert  ( Tot_Pub_Feb ) ;
                
                var myChart = ec.init(document.getElementById('main')); 
                
                var option = {
                   
                    title : {
                    text: 'VENTAS OKTRIP  --OFFLINE-- ',
                    subtext: 'NETO/PÚBLICO'
                   },
                    
                    
                    tooltip: {
                        show: true
                    },
                    legend: {
                        padding: 5,
                        itemGap: 10,
                        data:['NETO', 'PUBLICO']
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
                           "name":'NETO',
                            "type":'bar',
                            "data":[Off_Net_Ene, Off_Net_Feb, Off_Net_Mar, Off_Net_Abr, Off_Net_May, Off_Net_Jun, Off_Net_Jul, Off_Net_Ago, Off_Net_Sep, Off_Net_Oct, Off_Net_Nov, Off_Net_Dic],                                                                                                                                                                                                                                                                                                        
                           // "data":[50000,40000,30000,20000,10000,60000,70000,80000,90000,10000,20000,40000]   
                            
                            
                           
                            
                            
                            
                        },
                        {
                           "name":'PUBLICO',
                            "type":'bar',
                            "data":[Off_Pub_Ene, Off_Pub_Feb, Off_Pub_Mar, Off_Pub_Abr, Off_Pub_May, Off_Pub_Jun, Off_Pub_Jul, Off_Pub_Ago, Off_Pub_Sep, Off_Pub_Oct, Off_Pub_Nov, Off_Pub_Dic],                                                                                                                                                                                                                                                                                                        
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

