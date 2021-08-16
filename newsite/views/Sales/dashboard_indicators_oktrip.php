

<!DOCTYPE html>
<html lang="en"><head>  <title> Dashboard Oktrip.mx! </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="icon" href="/img/iconos/favicon.png" />
  <style>
  .fakeimg {
      height: 100px;
      background: #aaa;
  }
  </style></head><body>
    

<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
  <a class="navbar-brand" href="#">
      <img src="../../img/Reportes_Vtas/LogoOkTripSuperior.png" width="95" height="34">  </a>
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="#">Informe de Cifras Oktrip en Tiempo Real.</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#"></a>
    </li>
  </ul>
</nav>
    
 
    
<div class="container" style="margin-top:10px">
   <div class="row">
    
	 <div class="col-sm-4">
            <div class="alert alert-primary" align="center">
            <h4 class="display-4">Total Público </h4>
            <h4 class="display-4"><?php echo "$". number_format($TOT_P_2019,0,".",",") ;  ?> </h4>
            </div>
      </div>
	  
	  <div class="col-sm-4">
            <div class="alert alert-primary" align="center">
            <h4 class="display-4">+ Total Neto</h4>
            <h4 class="display-4"> <?php  echo "$". number_format($TOT_N_2019,0,".",",") ;  ?> </h4>
            </div>
      </div>
      
       <div class="col-sm-4">
            <div class="alert alert-primary" align="center">
            <h4 class="display-4">= Gran Total  </h4>
            <h4 class="display-4"> <?php echo "$".number_format($GRAN_TOT,0,".",","); ?>  </h4>
           </div>
       </div>
                
  </div>
</div> 
    
    
    
<div class="container" style="margin-top:10px">
  <div class="row" style="">
       <div class="col-sm-10">
              
           
           
             
<!-- Prepare a Dom with size (width and height) for ECharts -->
    <div id="main" style="height:300px"></div>
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
             
               
                
                var Tot_Net_Ene = 194889
                var Tot_Net_Feb = '<?php echo $Tot_Net_Feb; ?>'
                var Tot_Net_Mar = '<?php echo $Tot_Net_Mar; ?>'
                var Tot_Net_Abr = '<?php echo $Tot_Net_Abr; ?>'
                var Tot_Net_May = '<?php echo $Tot_Net_May; ?>'
                var Tot_Net_Jun = '<?php echo $Tot_Net_Jun; ?>'
                var Tot_Net_Jul = '<?php echo $Tot_Net_Jul; ?>'
                var Tot_Net_Ago = '<?php echo $Tot_Net_Ago; ?>'
                var Tot_Net_Sep = '<?php echo $Tot_Net_Sep; ?>'
                var Tot_Net_Oct = '<?php echo $Tot_Net_Oct; ?>'
                var Tot_Net_Nov = '<?php echo $Tot_Net_Nov; ?>'
                var Tot_Net_Dic = '<?php echo $Tot_Net_Dic; ?>'
                 var Tot_Pub_Ene = 233140
                var Tot_Pub_Feb = '<?php echo $Tot_Pub_Feb; ?>'
                var Tot_Pub_Mar = '<?php echo $Tot_Pub_Mar; ?>'
                var Tot_Pub_Abr = '<?php echo $Tot_Pub_Abr; ?>'
                var Tot_Pub_May = '<?php echo $Tot_Pub_May; ?>'
                var Tot_Pub_Jun = '<?php echo $Tot_Pub_Jun; ?>'
                var Tot_Pub_Jul = '<?php echo $Tot_Pub_Jul; ?>'
                var Tot_Pub_Ago = '<?php echo $Tot_Pub_Ago; ?>'
                var Tot_Pub_Sep = '<?php echo $Tot_Pub_Sep; ?>'
                var Tot_Pub_Oct = '<?php echo $Tot_Pub_Oct; ?>'
                var Tot_Pub_Nov = '<?php echo $Tot_Pub_Nov; ?>'
                var Tot_Pub_Dic = '<?php echo $Tot_Pub_Dic; ?>'
                
              
                
                //                      alert  ( Tot_Pub_Feb ) ;
                
                var myChart = ec.init(document.getElementById('main')); 
                
                var option = {
                   
                    title : {
                    text: 'WEB/OFFLINE ',
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
                            "data":[Tot_Net_Ene, Tot_Net_Feb, Tot_Net_Mar, Tot_Net_Abr, Tot_Net_May, Tot_Net_Jun, Tot_Net_Jul, Tot_Net_Ago, Tot_Net_Sep, Tot_Net_Oct, Tot_Net_Nov, Tot_Net_Dic],                                                                                                                                                                                                                                                                                                        
                           // "data":[50000,40000,30000,20000,10000,60000,70000,80000,90000,10000,20000,40000]   
                            
                            
                           
                            
                            
                            
                        },
                        {
                           "name":'PUBLICO',
                            "type":'bar',
                            "data":[Tot_Pub_Ene, Tot_Pub_Feb, Tot_Pub_Mar, Tot_Pub_Abr, Tot_Pub_May, Tot_Pub_Jun, Tot_Pub_Jul, Tot_Pub_Ago, Tot_Pub_Sep, Tot_Pub_Oct, Tot_Pub_Nov, Tot_Pub_Dic],                                                                                                                                                                                                                                                                                                        
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
      
      
       
      <div class="col-sm-2">
              <div class="alert alert-primary">
                   <h3> Vtas.WEB:ok </h3>
                   <h3>  <?php echo "$".number_format($GRAN_TOT_VTAS_WEB,0,".",","); ?> </h3>
              </div>
              <div class="alert alert-primary">
                   <h3> Vtas.OFF:ok </h3> 
                   <h3> <?php echo "$".number_format($GRAN_TOT_VTAS_OFFF,0,".",","); ?> </h3>
                </div>
     </div>
      
    
          
          
          
             
             
                        
              <hr class="d-sm-none">
    </div>
      </div>
</div>


    
    
  
  
  
  
  
  <div class="container" style="margin-top:10px">
   <div class="row">
    
	 <div class="col-sm-4">
            <div class="alert alert-primary" align="center">
            <h4 class="display-4">Vtas. WEB</h4>
            <h4 class="display-4"><?php echo "$". number_format($TOT_P_2019,0,".",",") ;  ?> </h4>
            </div>
      </div>
	  
	  <div class="col-sm-4">
            <div class="alert alert-primary" align="center">
            <h4 class="display-4">+ Vtas. OFF</h4>
            <h4 class="display-4"> <?php  echo "$". number_format($TOT_N_2019,0,".",",") ;  ?> </h4>
            </div>
      </div>
      
       <div class="col-sm-4">
            <div class="alert alert-primary" align="center">
            <h4 class="display-4">= Total</h4>
            <h4 class="display-4"> <?php echo "$".number_format($GRAN_TOT,0,".",","); ?>  </h4>
           </div>
       </div>
                
  </div>
</div> 

  
  
  
  
  
  
    
    
    
 <div class="container" style="margin-top:10px">
  <div class="row">
      
           <div class="col-sm-3">
              <div class="alert alert-primary">
                                <h4> Vtas offline Reps ok</h4>
                                <h4> <?php echo "$".number_format($GRAN_TOT_VTAS_OFFLINE_REPS,0,".",","); ?>    </h4>
                            
              </div>
               <div class="alert alert-primary">
                                <h4> Vtas Ultramar ok </h4>
                                <h4> <?php echo "$".number_format($GRAN_TOT_VTAS_ULTRAMAR,0,".",","); ?> </h4>
                            
                </div>
           </div>
    
           <div class="col-sm-3">
              <div class="alert alert-primary">
                                <h4> Vtas Tras 7USD ok </h4>
                                <h4>  <?php echo "$".number_format($GRAN_TOT_VTAS_TRAS_7USD,0,".",","); ?>   </h4>
              </div>
                   <div class="alert alert-primary">
                                <h4> Vtas Tras 12USD ok </h4>
                                <h4>  <?php echo "$".number_format($GRAN_TOT_VTAS_TRAS_12USD,0,".",","); ?> </h4>
              </div>
			  
			  <div class="alert alert-primary">
                                <h4> Vtas Tras Privadas ok </h4>
                                <h4>  <?php echo "$".number_format($GRAN_TOT_VTAS_TRAS_PRIVADAS,0,".",","); ?> </h4>
              </div>
			  
			  
          </div>
      
     
      
      
      
      
      
      <div class="col-sm-6">
             
              
            
             
          
 <!-- Prepare a Dom with size (width and height) for ECharts -->
    <div id="mainn" style="height:250px"></div>
    <!-- ECharts import -->
    <script // src="../../js/echarts/dist/echarts.js" > </script>                                
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
                
                var myChart = ec.init(document.getElementById('mainn')); 
                
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
                            //"data":[50000,40000,30000,20000,10000,60000,70000,80000,90000,10000,20000,40000,3584]   
                            
                            
                           
                            
                            
                            
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
    
 
    
    
  <div class="container" style="margin-top:10px">
  <div class="row">
      
           <div class="col-sm-2">
              <div class="alert alert-primary">
                               <p> Reservas <BR> GPH  </p>
                               <p>$7,980</p>
                        </div>
     </div>
    
      <div class="col-sm-2">
              <div class="alert alert-primary">
                                <p> Transportaciones pagadas </p>
                               <p>$7,980</p>
                            
                        </div>
     </div>
      
      <div class="col-sm-3">
            <div class="alert alert-primary">
                                <p> Transportación Volaris salidas  </p>
                               <p>$7,980</p>
                            
                        </div>
    </div>
      
      <div class="col-sm-3">
              <div class="alert alert-primary">
                                <p> Transportación Volaris llegadas </p>
                               <p>$7,980</p>
                            
                        </div>
    </div>
      
       <div class="col-sm-2">
              <div class="alert alert-primary">
                                <p> Transportación <BR> cortesia  </p>
                               <p>$7,980</p>
                            
                        </div>
    </div>
      
      
      
      
      
      
     
  </div>
</div>
      
    
    
    
    
    
    
    
    
    
    
    
    
    
<div class="jumbotron text-center" style="margin-bottom:0">
    <img src="../../img/Reportes_Vtas/LogoOkTripSuperior.png">
  <p>2019</p>
</div>

</body></html>

