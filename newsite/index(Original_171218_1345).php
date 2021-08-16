<?php

/*Librerias Oktrip*/

require 'vendor/autoload.php';
use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;
$router = new RouteCollector();

require 'models/db.php';
include 'models/BasicEnum.php';

require 'models/User/cliente.php';
require 'models/User/Admin.php';
include 'models/City/City.php';
include 'models/HotelCity/HotelCity.php';
include 'models/HotelDo/Hotel.php';
include 'models/Sale/sale.php';
include 'models/mapa/mapa.php';

require 'controllers/databaseController.php';
include 'controllers/AESEncriptacion.php';
require 'controllers/HomeController.php';
require 'controllers/HotelsController.php';
require 'controllers/KeysController.php';
require 'controllers/Cities/CitiesController.php';
require 'controllers/HotelsCity/HotelsCityController.php';
require 'controllers/Sales/SalesController.php';
include 'controllers/HotelDo/soapController.php';
include 'controllers/Panel/adminPanelController.php';
include 'controllers/clubestrellaController.php';
include 'controllers/Paypal/PaypalController.php';

include 'lang/Language.php';

ini_set('memory_limit', '-1');
/*Configuraciones de formato de fecha y hora*/

date_default_timezone_set("America/Cancun");
//setlocale(LC_TIME,'es_MX.utf8'); //Server
//setlocale(LC_MONETARY,'es_MX.utf8'); //Server
//setlocale(LC_TIME,'spanish'); //local
//setlocale(LC_MONETARY,"spanish"); //local

/*
*  Si tu localhost está seccionada por carpetas dejar la variable $dominio con "oktrip" o como se llame la carpeta de tu proyecto oktrip. 
Ejemplo: http://localhost/oktrip/...

*  También necesitas cambiar las rutas de los assets en los Views y agregarle la ruta relativa: ya sea "/oktrip" o solo "/".
Ejemplo:  <link rel="stylesheet" type="text/css" href="/oktripv2.0/css/bootstrap.min.css">
<script type="text/javascript" src="/oktripv2.0/js/jquery-3.2.1.min.js"></script>

*  Pero si tienes tu localhost como un dominio local dejar la variable $dominio vacía, para ello necesitas tener
los VirtualHost activado en tu servidor apache, consulta el siguiente link y seguir el tutorial:
https://styde.net/creando-virtual-hosts-con-apache-en-windows-para-wamp-o-xampp/

*/
$dominio = ""; 

try {

   /* Crear las rutas sin controladores
   $router->get($dominio.'/home', function(){ 
   include('views/home.php');
   return '<br>';
   });

   $router->get($dominio.'/account/login', function(){
   return 'Login';
   });

   */
   $router->controller($dominio.'/', 'HomeController');
   $router->controller($dominio.'/hoteles', 'HotelsController');
   $router->controller($dominio.'/ciudades', 'CitiesController');
   $router->controller($dominio.'/hoteles-destinos', 'HotelsCityController');
   $router->controller($dominio.'/ventas', 'SalesController');
   $router->controller($dominio.'/paypal', 'PaypalController');
   $router->controller($dominio.'/claves', 'KeysController');
   $router->controller($dominio.'/panel', 'adminPanelController');

   $dispatcher = new Dispatcher($router->getData());
   $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
} 
catch (Phroute\Phroute\Exception\HttpRouteNotFoundException $e) 
{
   echo "ERROR 404: NOT FOUND";
   //var_dump($e);      
   die();
}
catch (Phroute\Phroute\Exception\HttpMethodNotAllowedException $e)
{
   echo "ERROR 404: NOT FOUND";
   //var_dump($e);       
   die();
}
