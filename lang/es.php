<?php

#Lenguaje en Español

$to = new DateTime();
$from = new DateTime();
$to->add(new DateInterval('P2D'));
$from->add(new DateInterval('P1D'));

$aux = explode("/es", $_SERVER['REQUEST_URI']);

/*Configuraciones de formato de fecha y hora*/
date_default_timezone_set("America/Cancun");
setlocale(LC_TIME,'es_MX.utf8'); //Server
setlocale(LC_MONETARY,'es_MX.utf8'); //Server
//setlocale(LC_TIME,'spanish'); //local
//setlocale(LC_MONETARY,"spanish"); //local

#View _header

setcookie("Lang", "es", time() + (86400 * 30), "/");

$GLOBALS['lang'] = "es";
$GLOBALS['_header_lang_lbl'] = "Esp";
$GLOBALS['_header_lang_img'] = "/img/iconos/mexico.svg";
$GLOBALS['_header_lang_img_alt'] = "USA flag";


if(count($aux) > 1)
{
	$GLOBALS['_header_lang_redirect_1'] = $aux[0]."/es".$aux[1];
	$GLOBALS['_header_lang_redirect_2'] = $aux[0]."/en".$aux[1];
}
else
{
	$GLOBALS['_header_lang_redirect_1'] = "/es";
	$GLOBALS['_header_lang_redirect_2'] = "/en";
}


$GLOBALS['_header_menu_opt_1'] = "Inicio";
$GLOBALS['_header_menu_opt_2'] = "Hoteles";
$GLOBALS['_header_menu_opt_3'] = "Contacto";
$GLOBALS['_header_label_tel'] = "LLÁMANOS O ENVÍANOS UN WHATSAPP";

#btn Reserva
$GLOBALS['btn_row'] = "Reserva Ahora!";


#Meta´s
$GLOBALS['_ok_description'] = "OkTrip! La mejor agencia de viajes en Cancun, especializada para tu satisfacción y diversión. Hoteles, Transporte y Tours en la riviera Maya. México. ";
$GLOBALS['_ok_author'] = "oktrip.mx";
$GLOBALS['_ok_keywords'] = "Exclusivas  ofertas,  agencias  de  Viajes  en  Cancún,  Hot Sale 2019, Outlet  Cancún, paquetes, vuelos,  tours,  traslados,  ofertas, reservaciones, Hasta 40% de descuentos  en  las  mejores  playas, reserva  tu  viaje con  anticipación  con  los  precios  más  bajos, ofertas  de viajes, Agencias  de  viajes En  Cancun  centro,  hoteles  en  zona  hotelera, hoteles  todo  incluido, comparación  de  precios,  hotel  adhara, hotel  margaritas,  hotel  riu,  hotel barcelo, Hotel  costa  mujeres, hotel hard rock, compra  y  ahorra  en  tus  vacaciones,  buen  fin  2019  ";


#Currency
$GLOBALS['Hoteles_Currency'] = "MXN";
$GLOBALS['Currency_HotelDo'] = "pe";
$GLOBALS['Lang_HotelDo'] = "esp";
$GLOBALS['Locale_string'] = "es-MX";

#View _searcher

$GLOBALS['_searcher_label_reserve'] = "¡Reserva!";
$GLOBALS['_searcher_label_destiny'] = "Destino / Hotel";
$GLOBALS['_searcher_label_from'] = "Llegada";
$GLOBALS['_searcher_label_to'] = "Salida";
$GLOBALS['_searcher_label_rooms'] = "Habitaciones";
$GLOBALS['_searcher_label_room'] = "Habitación";
$GLOBALS['_searcher_label_adults'] = "Adultos";
$GLOBALS['_searcher_label_kids'] = "Niños";
$GLOBALS['_searcher_btn_search'] = "Buscar";
$GLOBALS['_searcher_ph_destiny'] = "Busca tu ciudad y selecciona";
$GLOBALS['_searcher_label_age_kid'] = "Edad niño";
$GLOBALS['_searcher_label_policie'] = "Políticas de cancelación";

$GLOBALS['_searcher_label_clubestrella'] = "¡ SUSCRIBETE A CLUB ESTRELLA !";
$GLOBALS['_searcher_label_p'] = "Para ser parte de un socio con tarifas preferenciales";
$GLOBALS['_searcher_label_p2'] = "en TODOS nuestros destinos y en TODAS las temporadas.";
$GLOBALS['_searcher_label_button'] = "¡ SUSCRIBETE AQUÍ !";


#View _footer

$GLOBALS['Footer_top_destinies_title'] = "Lo más buscado";
$GLOBALS['Footer_top_destinies_lbl_1'] = "Cancún";
$GLOBALS['Footer_top_destinies_lbl_2'] = "Riviera Maya";
$GLOBALS['Footer_top_destinies_lbl_3'] = "Los cabos";
$GLOBALS['Footer_top_destinies_lbl_4'] = "Mazatlán";
$GLOBALS['Footer_top_destinies_lbl_5'] = "Puerto Vallarta";
$GLOBALS['Footer_top_destinies_lbl_6'] = "Ciudad de México";
$GLOBALS['Footer_top_destinies_lbl_7'] = "Monterrey";
$GLOBALS['Footer_top_destinies_lbl_8'] = "Guadalajara";
$GLOBALS['Footer_top_destinies_lbl_9'] = "Mérida";
$GLOBALS['Footer_top_destinies_lbl_10'] = "León";
$GLOBALS['Footer_top_destinies_lbl_11'] = "Acapulco";
$GLOBALS['Footer_top_destinies_lbl_12'] = "Manzanillo";
$GLOBALS['Footer_top_destinies_lbl_13'] = "Ixtapa";
$GLOBALS['Footer_top_destinies_lbl_14'] = "Huatulco";
$GLOBALS['Footer_top_destinies_lbl_15'] = "Veracruz";

$GLOBALS['Footer_top_oktrip'] = "Oktrip pertenece a:";
$GLOBALS['Footer_add_oktrip'] = "Encuentranos en:";
$GLOBALS['Footer_add_oktrip_1'] = "Al interior del Hotel Adhara Hacienda Cancún en:";

$GLOBALS['Footer_top_destinies_url_1'] = "/hoteles/search/es?destiny=Cancun&idCity=2&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0&coupon=";
$GLOBALS['Footer_top_destinies_url_2'] = "/hoteles/search/es?destiny=Riviera+Maya&idCity=13&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0&coupon=";
$GLOBALS['Footer_top_destinies_url_3'] = "/hoteles/search/es?destiny=Los+Cabos&idCity=8&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0&coupon=";
$GLOBALS['Footer_top_destinies_url_4'] = "/hoteles/search/es?destiny=Mazatlan&idCity=9&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0&coupon=";
$GLOBALS['Footer_top_destinies_url_5'] = "/hoteles/search/es?destiny=Puerto+Vallarta&idCity=12&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0&coupon=";
$GLOBALS['Footer_top_destinies_url_6'] = "/hoteles/search/es?destiny=Ciudad+de+Mexico&idCity=11&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0&coupon=";
$GLOBALS['Footer_top_destinies_url_7'] = "/hoteles/search/es?destiny=Monterrey%2C+Mexico&idCity=32&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0&coupon=";
$GLOBALS['Footer_top_destinies_url_8'] = "/hoteles/search/es?destiny=Guadalajara%2C+Mexico&idCity=15&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0&coupon=";
$GLOBALS['Footer_top_destinies_url_9'] = "/hoteles/search/es?destiny=Merida%2C+Mexico&idCity=10&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0&coupon=";
$GLOBALS['Footer_top_destinies_url_10'] = "/hoteles/search/es?destiny=Leon%2C+Mexico&idCity=54&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0&coupon=";
$GLOBALS['Footer_top_destinies_url_11'] = "/hoteles/search/es?destiny=Acapulco%2C+Mexico&idCity=1&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0&coupon=";
$GLOBALS['Footer_top_destinies_url_12'] = "/hoteles/search/es?destiny=Manzanillo%2C+Mexico&idCity=30&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0&coupon=";
$GLOBALS['Footer_top_destinies_url_13'] = "/hoteles/search/es?destiny=Ixtapa%2C+Mexico&idCity=7&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0&coupon=";
$GLOBALS['Footer_top_destinies_url_14'] = "/hoteles/search/es?destiny=Huatulco%2C+Mexico&idCity=5&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0&coupon=";
$GLOBALS['Footer_top_destinies_url_15'] = "/hoteles/search/es?destiny=Veracruz%2C+Mexico&idCity=31&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0&coupon=";

$GLOBALS['Footer_btn_1'] = "Registro Club Estrella";
$GLOBALS['Footer_btn_2'] = "Contáctenos";
$GLOBALS['Footer_btn_3'] = "Aviso de privacidad";
$GLOBALS['Footer_btn_4'] = "Términos y condiciones";

$GLOBALS['Footer_copy_text'] = "Se prohíbe cualquier reproducción total o parcial de este contenido sin autorización por escrito de su titular.<br>
Es responsabilidad de la cadena hotelera y/o de la propiedad garantizar la exactitud de las fotografías mostradas. <br>
No nos hacemos responsables por inexactitudes en las fotografías.";

#View Index

$GLOBALS['Home_warranty_piggy_label_1'] = "Los mejores precios para tí";
$GLOBALS['Home_warranty_piggy_label_2'] = "Atención personalizada.";
$GLOBALS['Home_warranty_hotel_label_1'] = "Más de 9 mil opciones de Hoteles";
$GLOBALS['Home_warranty_hotel_label_2'] = "Nacionales e Internacionales.";
$GLOBALS['Home_warranty_no-feels_label_1'] = "Sin cargos ocultos";
$GLOBALS['Home_warranty_no-feels_label_2'] = "Todos nuestros precios incluyen impuestos.";
$GLOBALS['Home_warranty_no-feels_label_3'] = "Sin sorpresas en nuestros precios.";
$GLOBALS['Home_warranty_secure_label_1'] = "Reserva de manera segura";
$GLOBALS['Home_warranty_secure_label_2'] = "Sitio confiable.";
$GLOBALS['Home_warranty_confirm_label_1'] = "Confirmacion inmediata.";
$GLOBALS['Home_warranty_confirm_label_2'] = "Recibe notificacion con tus datos de reserva";
$GLOBALS['Home_warranty_confirm_label_3'] = "y comprobante de pago.";
$GLOBALS['Home_our_destinies_label'] = "Favoritos Oktrip";
$GLOBALS['Home_our_destinies_label_2'] = "Recomendaciones Oktrip";

/* Banners Principales */

$GLOBALS['Home_url_baja-california'] = "/hoteles/search/es?destiny=Los+Cabos%2C+Mexico&idCity=8&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_baja-california'] = "/img/banners/Enero-2018/bann-bc-esp.png";

$GLOBALS['Home_url_valle-bravo'] = "/hoteles/search/es?destiny=Valle+de+Bravo%2C+Mexico&idCity=113&&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_valle-bravo'] = "/img/banners/Enero-2018/bann-vb-esp.png";
$GLOBALS['Home_banner_generic'] = "/img/banners/banner-generico-esp.png";

$GLOBALS['Home_url_veracruz'] = "/hoteles/search/es?destiny=Veracruz%2C+Mexico&idCity=31&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_veracruz'] = "/img/banners/Enero-2018/bann-ver-esp.png";
$GLOBALS['Home_url_ixtapa'] = "/hoteles/search/es?destiny=Ixtapa%2C+Mexico&idCity=7&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_ixtapa'] = "/img/banners/Enero-2018/bann-ixt-esp.png";
$GLOBALS['Home_url_habana'] = "/hoteles/search/es?destiny=Habana%2C+Cuba&idCity=140&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_habana'] = "/img/banners/Enero-2018/bann-hab-esp.png";
$GLOBALS['Home_img_whats'] = "/img/banners/Enero-2018/banner-whats.png";

$GLOBALS['Home_url_nayarit'] = "/hoteles/search/es?destiny=Nayarit%2C+Mexico&idCity=112&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_nayarit'] = "/img/banners/Enero-2018/bann-nay-esp.png";

$GLOBALS['Home_url_cancun'] = "/hoteles/search/es?destiny=Cancun%2C+Mexico&idCity=2&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_cancun'] = "/img/banners/Enero-2018/bann-cun-esp.png";

$GLOBALS['Home_url_costarica'] = "/hoteles/search/es?destiny=CostaRica%2C+Mexico&idCity=3488&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_costarica'] = "/img/banners/Enero-2018/bann-cost-esp.png";

$GLOBALS['Home_url_garrafon'] = "/hoteles/search/es?destiny=Isla%2C+Mexico&idCity=6&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_garrafon'] = "/img/banners/Enero-2018/bann-garra-esp.png";


$GLOBALS['Home_url_toluca'] = "/hoteles/search/es?destiny=Toluca%2C+Mexico&idCity=44&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_toluca'] = "/img/banners/Enero-2018/bann-tol-esp.png";

$GLOBALS['Home_url_queretaro'] = "/hoteles/search/es?destiny=Queretaro%2C+Mexico&idCity=40&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_queretaro'] = "/img/banners/Enero-2018/bann-que-esp.png";

$GLOBALS['Home_url_puebla'] = "/hoteles/search/es?destiny=Puebla%2C+Mexico&idCity=39&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_puebla'] = "/img/banners/Enero-2018/bann-pue-esp.png";

$GLOBALS['Home_url_newyork'] = "/hoteles/search/es?destiny=NY%2C+USA&idCity=16929&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_newyork'] = "/img/banners/Enero-2018/bann-ny-esp.png";

$GLOBALS['Home_url_cozumel'] = "/hoteles/search/es?destiny=Cozumel%2C+Mexico&idCity=4&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_cozumel'] = "/img/banners/Enero-2018/bann-coz-esp.png";

$GLOBALS['Home_url_potosi'] = "/hoteles/search/es?destiny=Potosi%2C+Mexico&idCity=59&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_potosi'] = "/img/banners/Enero-2018/bann-luis-esp.png";

$GLOBALS['Home_url_michoacan'] = "/hoteles/search/es?destiny=Michoacan%2C+Mexico&idCity=107&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_michoacan'] = "/img/banners/Enero-2018/bann-mich-esp.png";


$GLOBALS['Home_url_guatemala'] = "/hoteles/search/es?destiny=Guatemala%2C+Guatemala&idCity=108&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_guatemala'] = "/img/banners/Enero-2018/bann-guat-esp.png";

$GLOBALS['Home_url_mazatlan'] = "/hoteles/search/es?destiny=Mazatlan%2C+Mexico&idCity=9&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_mazatlan'] = "/img/banners/Enero-2018/bann-maz-esp.png";

$GLOBALS['Home_url_oaxaca'] = "/hoteles/search/es?destiny=Oaxaca%2C+Mexico&idCity=17&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_oaxaca'] = "/img/banners/Enero-2018/bann-oax-esp.png";

$GLOBALS['Home_url_chiapas'] = "/hoteles/search/es?destiny=Chiapas%2C+Mexico&idCity=3&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_chiapas'] = "/img/banners/Enero-2018/bann-crist-esp.png";

$GLOBALS['Home_url_panama'] = "/hoteles/search/es?destiny=Panama%2C+Mexico&idCity=900036&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_panama'] = "/img/banners/Enero-2018/bann-pan-esp.png";

$GLOBALS['Home_url_coahuila'] = "/hoteles/search/es?destiny=Coahuila%2C+Mexico&idCity=58&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_coahuila'] = "/img/banners/Enero-2018/bann-coah-esp.png";

$GLOBALS['Home_url_monterrey'] = "/hoteles/search/es?destiny=Monterrey%2C+Mexico&idCity=32&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_monterrey'] = "/img/banners/Enero-2018/bann-mont-esp.png";

$GLOBALS['Home_url_sanMiguel'] = "/hoteles/search/es?destiny=Allende%2C+Mexico&idCity=69&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_sanMiguel'] = "/img/banners/Enero-2018/bann-san-esp.png";

$GLOBALS['Home_url_zacatecas'] = "/hoteles/search/es?destiny=Zacatecas%2C+Mexico&idCity=60&&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_zacatecas'] = "/img/banners/Enero-2018/bann-zac-esp.png";

$GLOBALS['Home_url_guadalajara'] = "/hoteles/search/es?destiny=Guadalajara%2C+Mexico&idCity=15&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_guadalajara'] = "/img/banners/Enero-2018/bann-gua-esp.jpg";

$GLOBALS['Home_url_vegas'] = "/hoteles/search/es?destiny=Vegas%2C+USA&idCity=15394&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_vegas'] = "/img/banners/Enero-2018/bann-vegas-esp.png";

$GLOBALS['Home_url_merida'] = "/hoteles/search/es?destiny=Merida%2C+Mexico&idCity=10&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_merida'] = "/img/banners/Enero-2018/bann-merida-esp.png";

$GLOBALS['Home_url_chihuahua'] = "/hoteles/search/es?destiny=Chihuahua%2C+Mexico&idCity=48&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_chihuahua'] = "/img/banners/Enero-2018/bann-chi-esp.png";






$GLOBALS['Home_url_morelia'] = "/hoteles/search/es?destiny=Morelia%2C+Mexico&idCity=51&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_morelia'] = "/img/banners/Enero-2018/bann-morelia-esp.png";

$GLOBALS['Home_url_acapulco'] = "/hoteles/search/es?destiny=Acapulco%2C+Mexico&idCity=1&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_acapulco'] = "/img/banners/Enero-2018/bann-acapulco-esp.png";

$GLOBALS['Home_url_cholula'] = "/hoteles/search/es?destiny=Cholula%2C+Mexico&idCity=612&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_cholula'] = "/img/banners/Enero-2018/bann-cholula-esp.png";

$GLOBALS['Home_url_orlando'] = "/hoteles/search/es?destiny=Orlando%2C+USA&idCity=17408&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_orlando'] = "/img/banners/Enero-2018/bann-orlando-esp.png";

$GLOBALS['Home_url_vallarta'] = "/hoteles/search/es?destiny=Vallarta%2C+Mexico&idCity=12&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_vallarta'] = "/img/banners/Enero-2018/bann-vall-esp.png";

$GLOBALS['Home_url_promo'] = "#";
$GLOBALS['Home_img_promo'] = "img/banners/Enero-2018/bann-offer-esp.png";
$GLOBALS['Home_img_buenfin'] = "img/banners/Enero-2018/bann_buenfin-esp.png";



$GLOBALS['Home_url_costarica'] = "/hoteles/search/es?destiny=Costa%2C+Rica&idCity=900165&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_costarica'] = "/img/banners/Enero-2018/bann-costa-esp.png";

$GLOBALS['Home_url_cabos'] = "/hoteles/search/es?destiny=Cabos%2C+Mexico&idCity=8&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_cabos'] = "/img/banners/Enero-2018/bann-cabos-esp.png";

$GLOBALS['Home_url_taxco'] = "/hoteles/search/es?destiny=Taxco%2C+Mexico&idCity=41&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_taxco'] = "/img/banners/Enero-2018/bann-taxco-esp.png";

$GLOBALS['Home_url_navidad'] = "#";
$GLOBALS['Home_img_navidad'] = "img/banners/Enero-2018/bann-navidad-esp.png";



/* Banners Nuestros Destinos */

$GLOBALS['Home_img_dt-tabasco'] = "/img/banners/Enero-2018/dt-tab-esp.png";
$GLOBALS['Home_url_dt-tabasco'] = "/hoteles/search/es?destiny=Villahermosa%2C+Mexico&idCity=42&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_destinies_generic'] = "/img/banners/destinos-generico-esp.png";

$GLOBALS['Home_url_dt-texcoco'] = "/hoteles/search/es?destiny=Texcoco%2C+Mexico&idCity=615&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-texcoco'] = "/img/banners/Enero-2018/dt-tex-esp.jpg";
$GLOBALS['Home_url_dt-mexico'] = "/hoteles/search/es?destiny=Mexico%2C+Mexico&idCity=615&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-mexico'] = "/img/banners/Enero-2018/dt-mex-esp.jpg";
$GLOBALS['Home_url_dt-chichen'] = "/hoteles/search/es?destiny=Mexico%2C+Mexico&idCity=615&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-chichen'] = "/img/banners/Enero-2018/dt-df-esp.jpg";

$GLOBALS['Home_url_dt-aguascalientes'] = "/hoteles/search/es?destiny=Aguascalientes%2C+Mexico&idCity=49&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-aguascalientes'] = "/img/banners/Enero-2018/dt-mar-esp.png";

$GLOBALS['Home_url_dt-cozumel'] = "/hoteles/search/es?destiny=Cozumel%2C+Mexico&idCity=4&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-cozumel'] = "/img/banners/Enero-2018/dt-coz-esp.png";

$GLOBALS['Home_url_dt-ecatepec'] = "/hoteles/search/es?destiny=Mexico%2C+Mexico&idCity=615&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-ecatepec'] = "/img/banners/Enero-2018/dt-edo-esp.png";

$GLOBALS['Home_url_dt-veracruz'] = "/hoteles/search/en?destiny=Veracruz%2C+Mexico&idCity=31&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-veracruz'] = "/img/banners/Enero-2018/dt-ver-esp.png";

$GLOBALS['Home_url_dt-potosi'] = "/hoteles/search/es?destiny=Potosi%2C+Mexico&idCity=59&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-potosi'] = "/img/banners/Enero-2018/dt-luis-esp.png";

$GLOBALS['Home_url_dt-more'] = "/hoteles/search/es?destiny=Morelia%2C+Mexico&idCity=51&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-more'] = "/img/banners/Enero-2018/dt-more-esp.png";

$GLOBALS['Home_url_dt-cabos'] = "/hoteles/search/es?destiny=Cabos%2C+Mexico&idCity=8&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-cabos'] = "/img/banners/Enero-2018/dt-bc-esp.png";

$GLOBALS['Home_url_dt-cabos2'] = "/hoteles/search/es?destiny=Cabos%2C+Mexico&idCity=8&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-cabos2'] = "/img/banners/Enero-2018/dt-bc2-esp.png";

$GLOBALS['Home_url_dt-durango'] = "/hoteles/search/es?destiny=Durango%2C+Mexico&idCity=61&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-durango'] = "/img/banners/Enero-2018/dt-dur-esp.png";

$GLOBALS['Home_url_dt-oaxaca'] = "/hoteles/search/es?destiny=Oaxaca%2C+Mexico&idCity=17&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-oaxaca'] = "/img/banners/Enero-2018/dt-oax-esp.png";

$GLOBALS['Home_url_dt-saltillo'] = "/hoteles/search/es?destiny=Saltillo%2C+Mexico&idCity=74&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-saltillo'] = "/img/banners/Enero-2018/dt-salt-esp.png";

$GLOBALS['Home_url_dt-coahuila'] = "/hoteles/search/es?destiny=Coahuila%2C+Mexico&idCity=58&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-coahuila'] = "/img/banners/Enero-2018/dt-coah-esp.png";

$GLOBALS['Home_url_dt-guadalajara'] = "/hoteles/search/es?destiny=Guadalajara%2C+Mexico&idCity=47&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-guadalajara'] = "/img/banners/Enero-2018/dt-gua-esp.png";


$GLOBALS['Home_url_dt-monterrey'] = "/hoteles/search/es?destiny=Monterrey%2C+Mexico&idCity=32&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-monterrey'] = "/img/banners/Enero-2018/dt-mont-esp.png";


$GLOBALS['Home_url_dt-chihuahua'] = "/hoteles/search/es?destiny=Chihuahua%2C+Mexico&idCity=48&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-chihuahua'] = "/img/banners/Enero-2018/dt-chi-esp.png";

$GLOBALS['Home_url_dt-hidalgo'] = "/hoteles/search/es?destiny=Hidalgo%2C+Mexico&idCity=615&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-hidalgo'] = "/img/banners/Enero-2018/dt-hi-esp.png";

$GLOBALS['Home_url_dt-zacatecas'] = "/hoteles/search/es?destiny=Zacatecas%2C+Mexico&idCity=60&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-zacatecas'] = "/img/banners/Enero-2018/dt-zac-esp.png";

$GLOBALS['Home_url_dt-guanajuato'] = "/hoteles/search/es?destiny=Guanajuato%2C+Mexico&idCity=47&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-guanajuato'] = "/img/banners/Enero-2018/dt-guanajuato-esp.png";

$GLOBALS['Home_url_dt-playa'] = "/hoteles/search/es?destiny=Playa%2C+Mexico&idCity=16&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-playa'] = "/img/banners/Enero-2018/dt-playa-esp.png";

$GLOBALS['Home_url_dt-guadalajara'] = "/hoteles/search/es?destiny=Guadalajara%2C+Mexico&idCity=15&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-guadalajara'] = "/img/banners/Enero-2018/dt-gua-esp.png";

$GLOBALS['Home_url_dt-toluca'] = "/hoteles/search/es?destiny=Toluca%2C+Mexico&idCity=44&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-toluca'] = "/img/banners/Enero-2018/dt-toluca-esp.png";


$GLOBALS['Home_url_dt-morelia'] = "/hoteles/search/es?destiny=Morelia%2C+Mexico&idCity=51&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-morelia'] = "/img/banners/Enero-2018/dt-mich-esp.png";

$GLOBALS['Home_url_dt-yucatan'] = "/hoteles/search/es?destiny=Yucatan%2C+Mexico&idCity=93&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-yucatan'] = "/img/banners/Enero-2018/dt-yuc-esp.png";

$GLOBALS['Home_url_dt-queretaro'] = "/hoteles/search/es?destiny=Queretaro%2C+Mexico&idCity=40&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-queretaro'] = "/img/banners/Enero-2018/dt-que-esp.png";





$GLOBALS['Home_url_dt-chiapas'] = "/hoteles/search/es?destiny=Chiapas%2C+Mexico&idCity=3&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-chiapas'] = "/img/banners/Enero-2018/dt-chia-esp.png";

$GLOBALS['Home_url_dt-leon'] = "/hoteles/search/es?destiny=Leon%2C+Mexico&idCity=54&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-leon'] = "/img/banners/Enero-2018/dt-leon-esp.png";

$GLOBALS['Home_url_dt-tabasco'] = "#";
$GLOBALS['Home_img_dt-tabasco'] = "/img/banners/Enero-2018/dt-taba-esp.png";

$GLOBALS['Home_url_dt-campeche'] = "/hoteles/search/es?destiny=Campeche%2C+Mexico&idCity=46&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-campeche'] = "/img/banners/Enero-2018/dt-camp-esp.png";



/* Hoteles Grupo Peninsular de Hoteles */
$GLOBALS['Home_url_adhara'] = "/hoteles/details/es?idDestiny=2&idHotel=70&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0";
$GLOBALS['Home_url_margaritas'] = "/hoteles/details/es?idDestiny=2&idHotel=2870&idDestiny=3&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0";
$GLOBALS['Home_url_ramada'] = "/hoteles/details/es?idDestiny=2&idHotel=310&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0";
$GLOBALS['Home_banner_club'] = "/img/banners/clubestrella/clubestrella.png";

#View Contacto

$GLOBALS['Contact_form_title'] = "Contacto";
$GLOBALS['Contact_form_lbl_name'] = "Nombre";
$GLOBALS['Contact_form_lbl_email'] = "Correo electrónico";
$GLOBALS['Contact_form_lbl_city'] = "Ciudad";
$GLOBALS['Contact_form_lbl_country'] = "País";
$GLOBALS['Contact_form_plh_country'] = "Seleccionar";
$GLOBALS['Contact_form_lbl_phone'] = "Teléfono";
$GLOBALS['Contact_form_lbl_reference'] = "Número de referencia (en caso de tenerla)";
$GLOBALS['Contact_form_lbl_message'] = "Mensaje";
$GLOBALS['Contact_form_btn'] = "Enviar";

$GLOBALS['Contact_emails_title'] = "Cuentas de Correo";
$GLOBALS['Contact_emails_lbl_1'] = "Reservaciones";
$GLOBALS['Contact_emails_lbl_2'] = "Contabilidad";
$GLOBALS['Contact_emails_lbl_3'] = "Facturación";
$GLOBALS['Contact_emails_lbl_4'] = "Comentarios";
$GLOBALS['Contact_emails_lbl_5'] = "Servicio al Cliente";
$GLOBALS['Contact_emails_lbl_6'] = "Contratación Hoteles";
$GLOBALS['Contact_emails_lbl_7'] = "Privacidad";
$GLOBALS['Contact_emails_lbl_7'] = "Privacidad";

$GLOBALS['Contact_address_title'] = "Dirección";
$GLOBALS['Contact_address_phone'] = "Teléfonos: +52 (998) 140 6570 | Reservaciones 01 800 333 6539 (998) 140 6580";
$GLOBALS['Contact_address_schedule'] = "Horarios: Lunes a Sábado de 08:00 a 18:00 hrs.";
$GLOBALS['Contact_address_map'] = "Mapa";

#View Hoteles - Index

$GLOBALS['Hoteles_Index_title'] = "OkTrip te recomienda:";
$GLOBALS['Hoteles_Index_about_title'] = "Acerca del hotel";
$GLOBALS['Hoteles_Index_btn_reserve'] = "Reservar";
$GLOBALS['Hoteles_Index_lbl_location'] = "Cancún, Zona centro";

$GLOBALS['Hoteles_Index_ser_title'] = "Servicios del hotel";
$GLOBALS['Hoteles_Index_res_title'] = "Restaurante";
$GLOBALS['Hoteles_Index_fac_title'] = "Facilidades";

$GLOBALS['Hoteles_Index_ser_opt_1'] = "Internet inalámbrico";
$GLOBALS['Hoteles_Index_ser_opt_2'] = "Caja de seguridad";
$GLOBALS['Hoteles_Index_ser_opt_3'] = "Lavandería";
$GLOBALS['Hoteles_Index_ser_opt_4'] = "Elevador";

$GLOBALS['Hoteles_Index_res_opt_1'] = "Restaurante Adhara Grill: Cocina mexicana";
$GLOBALS['Hoteles_Index_res_opt_2'] = "Restaurante El Patio Snack Bar: Comida ligera <br><span style='margin-left: 30px;'></span> y bebidas refrescantes";
$GLOBALS['Hoteles_Index_res_opt_3'] ="Restaurante El jardin: Cocina Internacional <br><span style='margin-left: 30px;'></span> Servicio buffet o a la carta";

$GLOBALS['Hoteles_Index_fac_opt_1'] = "Piscina (s)";
$GLOBALS['Hoteles_Index_fac_opt_2'] = "Estacionamiento";
$GLOBALS['Hoteles_Index_fac_opt_3'] = "Gimnasio";
$GLOBALS['Hoteles_Index_fac_opt_4'] = "Bar (es)";
$GLOBALS['Hoteles_Index_fac_opt_5'] = "Centro de negocios";
$GLOBALS['Hoteles_Index_fac_opt_6'] = "Salón (es) para Eventos";

/*About hoteles*/
$GLOBALS['Hoteles_Index_Adhara_title'] = "Hotel Adhara Hacienda Cancún";
$GLOBALS['Hoteles_Index_Adhara_txt_about'] = "Con una linda arquitectura estilo mexicano contemporáneo, el Hotel Adhara Hacienda Cancún es el punto de encuentro de la sociedad cancunense y el sitio preferido por visitantes nacionales y extranjeros en su paso por Cancún.";
$GLOBALS['Hoteles_Index_Adhara_txt_about_2'] = "Localizado en el centro de la ciudad, el hotel ofrece un espléndido diseño horizontal con habitaciones confortables y vistas a la piscina, el jardín o la calle. Cuenta con instalaciones amplias y agradables donde encontrarás restaurante y bar, un bien equipado gimnasio, centro de negocios y agradables salones para eventos sociales y empresariales.";

$GLOBALS['Hoteles_Index_Margar_title'] = "Hotel Margaritas Cancún";
$GLOBALS['Hoteles_Index_Margar_txt_about'] = "Si buscas un lugar tranquilo, acogedor, con funcionales instalaciones y convenientes servicios, el Hotel Margaritas Cancún ofrece todo ello, además de una cálida hospitalidad. Cuenta con una decoración contemporánea mexicana, y detalles de gran colorido, lo cual crea una atmósfera agradable.";
$GLOBALS['Hoteles_Index_Margar_txt_about_2'] = "Hotel Margaritas Cancún se localiza en el corazón de Cancún y ofrece un centro de negocios, salón para eventos, acceso a Internet inalámbrico y transportación a Plaza Las Américas. Esta propiedad es ideal para el ejecutivo y para el viajero que busca confort y precios accesibles para disfrutar al máximo su estancia en este destino de playa.";

$GLOBALS['Hoteles_Index_ramada_title'] = "Hotel Ramada Cancún";
$GLOBALS['Hoteles_Index_ramada_txt_about'] = "Por la modernidad y conveniencia de sus instalaciones, el Hotel Ramada Cancún City es ideal para ese viaje de negocios
o placer. Acondicionado para satisfacer las necesidades del vacacionista o el ejecutivo por igual, ofrece una linda piscina
al aire libre con área para los niños, un restaurante de platillos mexicanos y un salón para eventos con capacidad de 150 personas.
Por su ubicación justo en el corazón de Cancún, tu desplazamiento a los sitios turísticos resulta cómodo y sencillo.";
$GLOBALS['Hoteles_Index_ramada_txt_about_2'] = "Para consentirte durante tu estadía, se cuenta con transportación redonda a la playa en cortesía.";

/* Generalidades */

$GLOBALS['Hoteles_lbl_adults'] = " adultos";
$GLOBALS['Hoteles_lbl_adult'] = " adulto";
$GLOBALS['Hoteles_lbl_kids'] = " niños";
$GLOBALS['Hoteles_lbl_kid'] = " niño";
$GLOBALS['Hoteles_lbl_rooms'] = " habitaciones";
$GLOBALS['Hoteles_lbl_room'] = " habitación";
$GLOBALS['Hoteles_lbl_and'] = " y ";

#View Hoteles - Search

$GLOBALS['Hoteles_Search_Home'] = "Inicio";
$GLOBALS['Hoteles_Search_Hotels'] = "Hoteles";
$GLOBALS['Hoteles_Search_Result'] = "concuerdan con tu búsqueda";
$GLOBALS['Hoteles_Search_tittle'] = "¡Reserva tu Hotel!";
$GLOBALS['Hoteles_Search_New_Search'] = "Nueva búsqueda";
$GLOBALS['Hoteles_Search_Order_by'] = "Ordernar por:";
$GLOBALS['Hoteles_Search_Order_Desc']= "Mayor precio";
$GLOBALS['Hoteles_Search_Order_Asc']= "Menor precio";
$GLOBALS['Hoteles_Search_Stars']= "Estrellas";
$GLOBALS['Hoteles_Search_Tripadvisor']= "Calificación Tripadvisor";
$GLOBALS['Hoteles_Search_List']= "Lista";
$GLOBALS['Hoteles_Search_Location']= "Locación por hotel";
$GLOBALS['Hoteles_Search_Close']= "Cerrar";

$GLOBALS['Hoteles_Search_lbl_service'] = "Servicios sin costo:";
$GLOBALS['Hoteles_Search_lbl_cancellation'] = "Política cancelacion:";
$GLOBALS['Hoteles_Search_lbl_price_club'] = "Precio Clubestrella";
$GLOBALS['Hoteles_Search_lbl_price_oktrip'] = "Precio Oktrip";
$GLOBALS['Hoteles_Search_lbl_average'] = "* Promedio por noche.";
$GLOBALS['Hoteles_Search_lbl_tax'] = "* Impuestos incluidos.";
$GLOBALS['Hoteles_Search_btn_reserve'] = "Reservar";


#View Hoteles - Details

$GLOBALS['Hoteles_Details_Dates'] = "Cambiar fechas";
$GLOBALS['Hoteles_Details_Disponibility'] = "Checar disponibilidad";
$GLOBALS['Hoteles_Details_Services'] = "Servicios del hotel";
$GLOBALS['Hoteles_Details_About'] = "Acerca del hotel";
$GLOBALS['Hoteles_Details_Search_Result'] = "No se encontraron resultados para su búsqueda, intente cambiando el número de adultos, niños, de habitaciones o cambiando fechas";
$GLOBALS['Hoteles_Details_Capacity'] = "Ocupación máxima:";
$GLOBALS['Hoteles_Details_Facilities'] = "Facilidades";
$GLOBALS['Hoteles_Details_No_Facilities'] = "Este hotel no cuenta con facilidades.";
$GLOBALS['Hoteles_Details_Restaurants'] = "Restaurantes";
$GLOBALS['Hoteles_Details_No_Restaurants'] = "Este hotel no cuenta con servicio de restaurant.";
$GLOBALS['Hoteles_Details_People']= "personas";

#View reserve

$GLOBALS['Hoteles_Reserve_member'] = "Soy <br> miembro";
$GLOBALS['Hoteles_Reserve_account'] = "Crear <br> perfil";
$GLOBALS['Hoteles_Reserve_password'] = "Recuperar <br> contraseña";
$GLOBALS['Hoteles_Reserve_tittle_form'] = "Completa el siguiente formulario";
$GLOBALS['Hoteles_Reserve_name_form'] = "Nombre (s)";
$GLOBALS['Hoteles_Reserve_lastname_form'] = "Apellido paterno";
$GLOBALS['Hoteles_Reserve_lastname'] = "Apellido materno";
$GLOBALS['Hoteles_Reserve_email_form'] = "Correo eletrónico";
$GLOBALS['Hoteles_Reserve_confirm_email'] = "Confirma correo electrónico";
$GLOBALS['Hoteles_Reserve_country_form'] = "Pais";
$GLOBALS['Hoteles_Reserve_state_form'] = "Estado";
$GLOBALS['Hoteles_Reserve_city_form'] = "Ciudad";
$GLOBALS['Hoteles_Reserve_cp_form'] = "Codigo postal";
$GLOBALS['Hoteles_Reserve_address_form'] = "Direccion";
$GLOBALS['Hoteles_Reserve_comments_form'] = "Comentarios adicionales";
$GLOBALS['Hoteles_Reserve_payment_form'] = "Metodo de pago";
$GLOBALS['Hoteles_Reserve_card_form'] = "Tarjeta de credito";
$GLOBALS['Hoteles_Reserve_paypal_form'] = "Paypal";
$GLOBALS['Hoteles_Reserve_points_form'] = "Puntos";
$GLOBALS['Hoteles_Reserve_terms_form'] = "He leído y esto de acuerdo con los";
$GLOBALS['Hoteles_Reserve_conditions_form'] = "Términos y Condiciones";
$GLOBALS['Hoteles_Reserve_terms_text_form'] = "de esta reservación. Entiendo que será requerido una identificación oficial o la tarjeta de crédito utilizada en esta reservación al momento del registro de llegada al hotel o al momento de registro del servicio prestado.";
$GLOBALS['Hoteles_Reserve_button_form'] = "Continuar";
$GLOBALS['Hoteles_Reserve_clubestrella'] = "Cuentas con:";
$GLOBALS['Hoteles_Reserve_points_estrella'] = "puntos";
$GLOBALS['Hoteles_Reserve_pay_points'] = "¡Paga tu reserva con puntos!";
$GLOBALS['Hoteles_Reserve_data'] = "Datos de reservación";
$GLOBALS['Hoteles_Reserve_login'] = "Inicia sesion";
$GLOBALS['Hoteles_Reserve_login_email'] = "Correo electrónico";
$GLOBALS['Hoteles_Reserve_login_password'] = "Contraseña";
$GLOBALS['Hoteles_Reserve_login_button'] = "Ingresar";
$GLOBALS['Hoteles_Reserve_signup'] = "Registrate en Clubestrella";
$GLOBALS['Hoteles_Reserve_username'] = "Username";
$GLOBALS['Hoteles_Reserve_company'] = "Compañia";
$GLOBALS['Hoteles_Reserve_confirm_password'] = "Confirma contraseña";
$GLOBALS['Hoteles_Reserve_phone'] = "Teléfono";
$GLOBALS['Hoteles_Reserve_password_estrella'] = "Recuperar contraseña";


?>