<?php

#Language in English

$to = new DateTime();
$from = new DateTime();
$to->add(new DateInterval('P2D'));
$from->add(new DateInterval('P1D'));

$aux = explode("/en", $_SERVER['REQUEST_URI']);

/*Configuraciones de formato de fecha y hora*/
date_default_timezone_set("America/Cancun");
//setlocale(LC_TIME,'en_US.utf8'); //Server
//setlocale(LC_MONETARY,'en_US.utf8'); //Server
setlocale(LC_TIME,'english'); //local
setlocale(LC_MONETARY,"english"); //local

#View _header

setcookie("Lang", "en", time() + (86400 * 30), "/");

$GLOBALS['lang'] = "en";
$GLOBALS['_header_lang_lbl'] = "Eng";
$GLOBALS['_header_lang_img'] = "/img/iconos/united-states.svg";
$GLOBALS['_header_lang_img_alt'] = "MX flag";

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

$GLOBALS['_header_menu_opt_1'] = "Home";
$GLOBALS['_header_menu_opt_2'] = "Hotels";
$GLOBALS['_header_menu_opt_3'] = "Contact";
$GLOBALS['_header_label_tel'] = "CALL US OR SEND US A WHATSAPP";

#btn Reserva
$GLOBALS['btn_row'] = "Book Now!";

#Currency
$GLOBALS['Hoteles_Currency'] = "USD";
$GLOBALS['Currency_HotelDo'] = "us";
$GLOBALS['Lang_HotelDo'] = "ing";
$GLOBALS['Locale_string'] = "en-US";


#View _searcher

$GLOBALS['_searcher_label_reserve'] = "¡Reserve!";
$GLOBALS['_searcher_label_destiny'] = "Destiny / Hotel";
$GLOBALS['_searcher_label_from'] = "Check in";
$GLOBALS['_searcher_label_to'] = "Check out";
$GLOBALS['_searcher_label_rooms'] = "Rooms";
$GLOBALS['_searcher_label_room'] = "Room";
$GLOBALS['_searcher_label_adults'] = "Adults";
$GLOBALS['_searcher_label_kids'] = "Kids";
$GLOBALS['_searcher_btn_search'] = "Search";
$GLOBALS['_searcher_ph_destiny'] = "Search city and select";
$GLOBALS['_searcher_label_age_kid'] = "Age Kid";
$GLOBALS['_searcher_label_policie'] = "Cancellation Policy";

$GLOBALS['_searcher_label_clubestrella'] = "SIGN IN CLUB ESTRELLA !";
$GLOBALS['_searcher_label_p'] = "Become a partner with special rates";
$GLOBALS['_searcher_label_p2'] = "in all our destinys in all the seasons.";
$GLOBALS['_searcher_label_button'] = "SUBSCRIBE HERE !";


#View _footer

$GLOBALS['Footer_top_destinies_title'] = "Most searched";
$GLOBALS['Footer_top_destinies_lbl_1'] = "Cancun";
$GLOBALS['Footer_top_destinies_lbl_2'] = "Riviera Maya";
$GLOBALS['Footer_top_destinies_lbl_3'] = "Los cabos";
$GLOBALS['Footer_top_destinies_lbl_4'] = "Mazatlan";
$GLOBALS['Footer_top_destinies_lbl_5'] = "Puerto Vallarta";
$GLOBALS['Footer_top_destinies_lbl_6'] = "Mexico City";
$GLOBALS['Footer_top_destinies_lbl_7'] = "Monterrey";
$GLOBALS['Footer_top_destinies_lbl_8'] = "Guadalajara";
$GLOBALS['Footer_top_destinies_lbl_9'] = "Merida";
$GLOBALS['Footer_top_destinies_lbl_10'] = "Leon";
$GLOBALS['Footer_top_destinies_lbl_11'] = "Acapulco";
$GLOBALS['Footer_top_destinies_lbl_12'] = "Manzanillo";
$GLOBALS['Footer_top_destinies_lbl_13'] = "Ixtapa";
$GLOBALS['Footer_top_destinies_lbl_14'] = "Huatulco";
$GLOBALS['Footer_top_destinies_lbl_15'] = "Veracruz";

$GLOBALS['Footer_top_oktrip'] = "Oktrip belongs to:";
$GLOBALS['Footer_add_oktrip'] = "Find us:";
$GLOBALS['Footer_add_oktrip_1'] = "At Adhara Hacienda Cancún Hotel:";

$GLOBALS['Footer_top_destinies_url_1'] = "/hoteles/search/en?destiny=Cancun&idCity=2&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0&coupon=";
$GLOBALS['Footer_top_destinies_url_2'] = "/hoteles/search/en?destiny=Riviera+Maya&idCity=13&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0&coupon=";
$GLOBALS['Footer_top_destinies_url_3'] = "/hoteles/search/en?destiny=Los+Cabos&idCity=8&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0&coupon=";
$GLOBALS['Footer_top_destinies_url_4'] = "/hoteles/search/en?destiny=Mazatlan&idCity=9&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0&coupon=";
$GLOBALS['Footer_top_destinies_url_5'] = "/hoteles/search/en?destiny=Puerto+Vallarta&idCity=12&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0&coupon=";
$GLOBALS['Footer_top_destinies_url_6'] = "/hoteles/search/en?destiny=Ciudad+de+Mexico&idCity=11&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0&coupon=";
$GLOBALS['Footer_top_destinies_url_7'] = "/hoteles/search/en?destiny=Monterrey%2C+Mexico&idCity=32&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0&coupon=";
$GLOBALS['Footer_top_destinies_url_8'] = "/hoteles/search/en?destiny=Guadalajara%2C+Mexico&idCity=15&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0&coupon=";
$GLOBALS['Footer_top_destinies_url_9'] = "/hoteles/search/en?destiny=Merida%2C+Mexico&idCity=10&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0&coupon=";
$GLOBALS['Footer_top_destinies_url_10'] = "/hoteles/search/en?destiny=Leon%2C+Mexico&idCity=54&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0&coupon=";
$GLOBALS['Footer_top_destinies_url_11'] = "/hoteles/search/en?destiny=Acapulco%2C+Mexico&idCity=1&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0&coupon=";
$GLOBALS['Footer_top_destinies_url_12'] = "/hoteles/search/en?destiny=Manzanillo%2C+Mexico&idCity=30&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0&coupon=";
$GLOBALS['Footer_top_destinies_url_13'] = "/hoteles/search/en?destiny=Ixtapa%2C+Mexico&idCity=7&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0&coupon=";
$GLOBALS['Footer_top_destinies_url_14'] = "/hoteles/search/en?destiny=Huatulco%2C+Mexico&idCity=5&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0&coupon=";
$GLOBALS['Footer_top_destinies_url_15'] = "/hoteles/search/en?destiny=Veracruz%2C+Mexico&idCity=31&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0&coupon=";

$GLOBALS['Footer_btn_1'] = "Register Club Estrella";
$GLOBALS['Footer_btn_2'] = "Contact Us";
$GLOBALS['Footer_btn_3'] = "Notice of Privacy";
$GLOBALS['Footer_btn_4'] = "Terms and Conditions";

$GLOBALS['Footer_copy_text'] = "It's prohibited any total or partial copy of this content with out permission written by the titular.<br>
It's responsibility of the hotel chain and/or the ownership to guarantee the veracity of the pictures shown. <br>
We don't make responsable for inaccuracies of the pictures.";

#View Index

$GLOBALS['Home_warranty_piggy_label_1'] = "The best prices for you";
$GLOBALS['Home_warranty_piggy_label_2'] = "Custom service.";
$GLOBALS['Home_warranty_hotel_label_1'] = "More than 2 thousand Hotel options";
$GLOBALS['Home_warranty_hotel_label_2'] = "National and International.";
$GLOBALS['Home_warranty_no-feels_label_1'] = "No hidden charges";
$GLOBALS['Home_warranty_no-feels_label_2'] = "All our prices include taxes.";
$GLOBALS['Home_warranty_no-feels_label_3'] = "No changes on our prices.";
$GLOBALS['Home_warranty_secure_label_1'] = "Reserva de manera segura";
$GLOBALS['Home_warranty_secure_label_2'] = "Sitio confiable.";
$GLOBALS['Home_warranty_confirm_label_1'] = "Confirmacion inmediata.";
$GLOBALS['Home_warranty_confirm_label_2'] = "Receive notification with your reservation information";
$GLOBALS['Home_warranty_confirm_label_3'] = "and proof of payment.";
$GLOBALS['Home_our_destinies_label'] = "Oktrip Favorites";
$GLOBALS['Home_our_destinies_label_2'] = "Oktrip Destinies";

/* Banners Principales */

$GLOBALS['Home_url_baja-california'] = "/hoteles/search/en?destiny=Los+Cabos%2C+Mexico&idCity=8&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=1&kids%5B0%5D=0";
$GLOBALS['Home_img_baja-california'] = "/img/banners/Enero-2018/bann-bc-en.png";

$GLOBALS['Home_url_guanajuato'] = "/hoteles/search/en?destiny=Guanajuato%2C+Mexico&idCity=47&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_guanajuato'] = "/img/banners/Enero-2018/bann-gua-en.png";

$GLOBALS['Home_url_valle-bravo'] = "/hoteles/search/en?destiny=Valle+de+Bravo%2C+Mexico&idCity=113&&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_valle-bravo'] = "/img/banners/Enero-2018/bann-vb-en.png";

$GLOBALS['Home_banner_generic'] = "/img/banners/banner-generico-esp.png";

$GLOBALS['Home_url_veracruz'] = "/hoteles/search/en?destiny=Veracruz%2C+Mexico&idCity=31&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_veracruz'] = "/img/banners/Enero-2018/bann-ver-en.png";

$GLOBALS['Home_url_ixtapa'] = "/hoteles/search/en?destiny=Ixtapa%2C+Mexico&idCity=7&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_ixtapa'] = "/img/banners/Enero-2018/bann-ixt-en.png";

$GLOBALS['Home_url_habana'] = "/hoteles/search/en?destiny=Habana%2C+Cuba&idCity=140&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_habana'] = "/img/banners/Enero-2018/bann-hab-en.png";

$GLOBALS['Home_img_whats'] = "/img/banners/Enero-2018/banner-whats.png";

$GLOBALS['Home_url_nayarit'] = "/hoteles/search/es?destiny=Nayarit%2C+Mexico&idCity=112&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_nayarit'] = "/img/banners/Enero-2018/bann-nay-en.png";

$GLOBALS['Home_url_cancun'] = "/hoteles/search/es?destiny=Cancun%2C+Mexico&idCity=2&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_cancun'] = "/img/banners/Enero-2018/bann-cun-en.png";

$GLOBALS['Home_url_costarica'] = "/hoteles/search/es?destiny=CostaRica%2C+Mexico&idCity=3488&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_costarica'] = "/img/banners/Enero-2018/bann-cost-en.png";

$GLOBALS['Home_url_garrafon'] = "/hoteles/search/es?destiny=Isla%2C+Mexico&idCity=6&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_garrafon'] = "/img/banners/Enero-2018/bann-garra-esp.png";

$GLOBALS['Home_url_toluca'] = "/hoteles/search/es?destiny=Toluca%2C+Mexico&idCity=44&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_toluca'] = "/img/banners/Enero-2018/bann-tol-en.png";

$GLOBALS['Home_url_queretaro'] = "/hoteles/search/es?destiny=Queretaro%2C+Mexico&idCity=40&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_queretaro'] = "/img/banners/Enero-2018/bann-que-en.png";

$GLOBALS['Home_url_puebla'] = "/hoteles/search/es?destiny=Puebla%2C+Mexico&idCity=39&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_puebla'] = "/img/banners/Enero-2018/bann-pue-en.png";

$GLOBALS['Home_url_newyork'] = "/hoteles/search/es?destiny=NY%2C+USA&idCity=16929&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_newyork'] = "/img/banners/Enero-2018/bann-ny-en.png";

$GLOBALS['Home_url_cozumel'] = "/hoteles/search/es?destiny=Cozumel%2C+Mexico&idCity=16929&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_cozumel'] = "/img/banners/Enero-2018/bann-coz-en.png";

$GLOBALS['Home_url_potosi'] = "/hoteles/search/es?destiny=Potosi%2C+Mexico&idCity=59&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_potosi'] = "/img/banners/Enero-2018/bann-luis-en.png";

$GLOBALS['Home_url_michoacan'] = "/hoteles/search/es?destiny=Michoacan%2C+Mexico&idCity=107&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_michoacan'] = "/img/banners/Enero-2018/bann-mich-en.png";


$GLOBALS['Home_url_guatemala'] = "/hoteles/search/es?destiny=Guatemala%2C+Guatemala&idCity=108&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_guatemala'] = "/img/banners/Enero-2018/bann-guat-en.png";

$GLOBALS['Home_url_mazatlan'] = "/hoteles/search/es?destiny=Mazatlan%2C+Mexico&idCity=9&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_mazatlan'] = "/img/banners/Enero-2018/bann-maz-en.png";

$GLOBALS['Home_url_oaxaca'] = "/hoteles/search/es?destiny=Oaxaca%2C+Mexico&idCity=17&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_oaxaca'] = "/img/banners/Enero-2018/bann-oax-en.png";

$GLOBALS['Home_url_chiapas'] = "/hoteles/search/es?destiny=Chiapas%2C+Mexico&idCity=3&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_chiapas'] = "/img/banners/Enero-2018/bann-crist-en.png";

$GLOBALS['Home_url_panama'] = "/hoteles/search/es?destiny=Panama%2C+Mexico&idCity=900036&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_panama'] = "/img/banners/Enero-2018/bann-pan-en.png";

$GLOBALS['Home_url_coahuila'] = "/hoteles/search/es?destiny=Coahuila%2C+Mexico&idCity=58&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_coahuila'] = "/img/banners/Enero-2018/bann-coah-en.png";

$GLOBALS['Home_url_monterrey'] = "/hoteles/search/es?destiny=Monterrey%2C+Mexico&idCity=32&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_monterrey'] = "/img/banners/Enero-2018/bann-mont-en.png";

$GLOBALS['Home_url_sanMiguel'] = "/hoteles/search/es?destiny=Allende%2C+Mexico&idCity=69&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_sanMiguel'] = "/img/banners/Enero-2018/bann-san-en.png";

$GLOBALS['Home_url_zacatecas'] = "/hoteles/search/es?destiny=Zacatecas%2C+Mexico&idCity=60&&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_zacatecas'] = "/img/banners/Enero-2018/bann-zac-en.png";

$GLOBALS['Home_url_guadalajara'] = "/hoteles/search/es?destiny=Guadalajara%2C+Mexico&idCity=15&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_guadalajara'] = "/img/banners/Enero-2018/bann-gua-en.png";

$GLOBALS['Home_url_vegas'] = "/hoteles/search/es?destiny=Vegas%2C+USA&idCity=15394&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_vegas'] = "/img/banners/Enero-2018/bann-vegas-en.png";

$GLOBALS['Home_url_merida'] = "/hoteles/search/es?destiny=Merida%2C+Mexico&idCity=10&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_merida'] = "/img/banners/Enero-2018/bann-merida-en.png";

$GLOBALS['Home_url_chihuahua'] = "/hoteles/search/es?destiny=Chihuahua%2C+Mexico&idCity=48&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_chihuahua'] = "/img/banners/Enero-2018/bann-chi-en.jpg";




$GLOBALS['Home_url_morelia'] = "/hoteles/search/es?destiny=Morelia%2C+Mexico&idCity=51&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_morelia'] = "/img/banners/Enero-2018/bann-morelia-en.png";

$GLOBALS['Home_url_acapulco'] = "/hoteles/search/es?destiny=Acapulco%2C+Mexico&idCity=1&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_acapulco'] = "/img/banners/Enero-2018/bann-acapulco-en.png";

$GLOBALS['Home_url_cholula'] = "/hoteles/search/es?destiny=Cholula%2C+Mexico&idCity=612&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_cholula'] = "/img/banners/Enero-2018/bann-cholula-en.png";

$GLOBALS['Home_url_orlando'] = "/hoteles/search/es?destiny=Orlando%2C+USA&idCity=17408&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_orlando'] = "/img/banners/Enero-2018/bann-orlando-en.png";

$GLOBALS['Home_url_vallarta'] = "/hoteles/search/es?destiny=Vallarta%2C+Mexico&idCity=12&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_vallarta'] = "/img/banners/Enero-2018/bann-vall-en.png";

$GLOBALS['Home_url_promo'] = "#";
$GLOBALS['Home_img_promo'] = "img/banners/Enero-2018/bann-offer-en.png";
$GLOBALS['Home_img_buenfin'] = "img/banners/Enero-2018/bann_buenfin-en.png";



$GLOBALS['Home_url_costarica'] = "/hoteles/search/es?destiny=Costa%2C+Rica&idCity=900165&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_costarica'] = "/img/banners/Enero-2018/bann-costa-en.png";

$GLOBALS['Home_url_cabos'] = "/hoteles/search/es?destiny=Cabos%2C+Mexico&idCity=8&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_cabos'] = "/img/banners/Enero-2018/bann-cabos-en.png";

$GLOBALS['Home_url_taxco'] = "/hoteles/search/es?destiny=Taxco%2C+Mexico&idCity=41&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_taxco'] = "/img/banners/Enero-2018/bann-taxco-en.png";

$GLOBALS['Home_url_navidad'] = "#";
$GLOBALS['Home_img_navidad'] = "img/banners/Enero-2018/bann-navidad-en.png";




/* Banners Nuestros Destinos */
$GLOBALS['Home_img_dt-tabasco'] = "/img/banners/Enero-2018/dt-tab-en.png";
$GLOBALS['Home_url_dt-tabasco'] = "/hoteles/search/en?destiny=Villahermosa%2C+Mexico&idCity=42&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_destinies_generic'] = "/img/banners/destinos-generico-eng.png";

$GLOBALS['Home_url_dt-texcoco'] = "/hoteles/search/en?destiny=Texcoco%2C+Mexico&idCity=615&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-texcoco'] = "/img/banners/Enero-2018/dt-tex-esp.jpg";
$GLOBALS['Home_url_dt-mexico'] = "/hoteles/search/en?destiny=Mexico%2C+Mexico&idCity=615&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-mexico'] = "/img/banners/Enero-2018/dt-mex-esp.jpg";
$GLOBALS['Home_url_dt-chichen'] = "/hoteles/search/en?destiny=Mexico%2C+Mexico&idCity=615&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-chichen'] = "/img/banners/Enero-2018/dt-df-esp.jpg";

$GLOBALS['Home_url_dt-aguascalientes'] = "/hoteles/search/es?destiny=Aguascalientes%2C+Mexico&idCity=49&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-aguascalientes'] = "/img/banners/Enero-2018/dt-mar-en.png";

$GLOBALS['Home_url_dt-queretaro'] = "/hoteles/search/es?destiny=Queretaro%2C+Mexico&idCity=40&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-queretaro'] = "/img/banners/Enero-2018/dt-que-esp.png";

$GLOBALS['Home_url_dt-cozumel'] = "/hoteles/search/es?destiny=Cozumel%2C+Mexico&idCity=4&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-cozumel'] = "/img/banners/Enero-2018/dt-coz-esp.png";

$GLOBALS['Home_url_dt-ecatepec'] = "/hoteles/search/es?destiny=Mexico%2C+Mexico&idCity=615&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-ecatepec'] = "/img/banners/Enero-2018/dt-edo-esp.png";

$GLOBALS['Home_url_dt-veracruz'] = "/hoteles/search/en?destiny=Veracruz%2C+Mexico&idCity=31&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-veracruz'] = "/img/banners/Enero-2018/dt-ver-esp.png";

$GLOBALS['Home_url_dt-potosi'] = "/hoteles/search/es?destiny=Potosi%2C+Mexico&idCity=59&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-potosi'] = "/img/banners/Enero-2018/dt-luis-en.png";

$GLOBALS['Home_url_dt-more'] = "/hoteles/search/es?destiny=Morelia%2C+Mexico&idCity=51&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-more'] = "/img/banners/Enero-2018/dt-more-en.png";

$GLOBALS['Home_url_dt-cabos'] = "/hoteles/search/es?destiny=Cabos%2C+Mexico&idCity=8&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-cabos'] = "/img/banners/Enero-2018/dt-bc-en.png";

$GLOBALS['Home_url_dt-cabos2'] = "/hoteles/search/es?destiny=Cabos%2C+Mexico&idCity=8&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-cabos2'] = "/img/banners/Enero-2018/dt-bc2-en.png";

$GLOBALS['Home_url_dt-durango'] = "/hoteles/search/es?destiny=Durango%2C+Mexico&idCity=61&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-durango'] = "/img/banners/Enero-2018/dt-dur-en.png";

$GLOBALS['Home_url_dt-oaxaca'] = "/hoteles/search/es?destiny=Oaxaca%2C+Mexico&idCity=17&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-oaxaca'] = "/img/banners/Enero-2018/dt-oax-en.png";

$GLOBALS['Home_url_dt-saltillo'] = "/hoteles/search/es?destiny=Saltillo%2C+Mexico&idCity=74&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-saltillo'] = "/img/banners/Enero-2018/dt-salt-en.png";

$GLOBALS['Home_url_dt-coahuila'] = "/hoteles/search/es?destiny=Coahuila%2C+Mexico&idCity=58&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-coahuila'] = "/img/banners/Enero-2018/dt-coah-en.png";

$GLOBALS['Home_url_dt-guadalajara'] = "/hoteles/search/es?destiny=Guadalajara%2C+Mexico&idCity=47&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-guadalajara'] = "/img/banners/Enero-2018/dt-gua-en.png";

$GLOBALS['Home_url_dt-monterrey'] = "/hoteles/search/es?destiny=Monterrey%2C+Mexico&idCity=32&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-monterrey'] = "/img/banners/Enero-2018/dt-mont-en.jpg";

$GLOBALS['Home_url_dt-chihuahua'] = "/hoteles/search/es?destiny=Chihuahua%2C+Mexico&idCity=48&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-chihuahua'] = "/img/banners/Enero-2018/dt-chi-en.png";

$GLOBALS['Home_url_dt-hidalgo'] = "/hoteles/search/es?destiny=Hidalgo%2C+Mexico&idCity=615&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-hidalgo'] = "/img/banners/Enero-2018/dt-hi-en.png";

$GLOBALS['Home_url_dt-zacatecas'] = "/hoteles/search/es?destiny=Zacatecas%2C+Mexico&idCity=60&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-zacatecas'] = "/img/banners/Enero-2018/dt-zac-en.png";

$GLOBALS['Home_url_dt-guanajuato'] = "/hoteles/search/es?destiny=Guanajuato%2C+Mexico&idCity=47&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-guanajuato'] = "/img/banners/Enero-2018/dt-guanajuato-en.png";

$GLOBALS['Home_url_dt-playa'] = "/hoteles/search/es?destiny=Playa%2C+Mexico&idCity=16&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-playa'] = "/img/banners/Enero-2018/dt-playa-en.png";

$GLOBALS['Home_url_dt-guadalajara'] = "/hoteles/search/es?destiny=Guadalajara%2C+Mexico&idCity=15&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-guadalajara'] = "/img/banners/Enero-2018/dt-gua-en.png";

$GLOBALS['Home_url_dt-toluca'] = "/hoteles/search/es?destiny=Toluca%2C+Mexico&idCity=44&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-toluca'] = "/img/banners/Enero-2018/dt-toluca-en.png";

$GLOBALS['Home_url_dt-morelia'] = "/hoteles/search/es?destiny=Morelia%2C+Mexico&idCity=51&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-morelia'] = "/img/banners/Enero-2018/dt-mich-en.png";

$GLOBALS['Home_url_dt-yucatan'] = "/hoteles/search/es?destiny=Yucatan%2C+Mexico&idCity=93&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-yucatan'] = "/img/banners/Enero-2018/dt-yuc-en.png";





$GLOBALS['Home_url_dt-chiapas'] = "/hoteles/search/es?destiny=Chiapas%2C+Mexico&idCity=3&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-chiapas'] = "/img/banners/Enero-2018/dt-chia-esp.png";

$GLOBALS['Home_url_dt-leon'] = "/hoteles/search/es?destiny=Leon%2C+Mexico&idCity=54&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-leon'] = "/img/banners/Enero-2018/dt-leon-esp.png";

$GLOBALS['Home_url_dt-tabasco'] = "#";
$GLOBALS['Home_img_dt-tabasco'] = "/img/banners/Enero-2018/dt-taba-esp.png";

$GLOBALS['Home_url_dt-campeche'] = "/hoteles/search/es?destiny=Campeche%2C+Mexico&idCity=46&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults%5B0%5D=2&kids%5B0%5D=0";
$GLOBALS['Home_img_dt-campeche'] = "/img/banners/Enero-2018/dt-camp-esp.png";


/* Hoteles Grupo Peninsular de Hoteles */

$GLOBALS['Home_url_adhara'] = "/hoteles/details/en?idDestiny=2&idHotel=70&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0";
$GLOBALS['Home_url_margaritas'] = "/hoteles/details/en?idDestiny=2&idHotel=2870&idDestiny=3&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0";
$GLOBALS['Home_url_ramada'] = "/hoteles/details/en?idDestiny=2&idHotel=310&from=".$from->format("d/m/Y")."&to=".$to->format("d/m/Y")."&rooms=1&adults[0]=2&kids[0]=0";
$GLOBALS['Home_banner_club'] = "/img/banners/clubestrella/clubestrella-en.png";

#View Contacto

$GLOBALS['Contact_form_title'] = "Contact";
$GLOBALS['Contact_form_lbl_name'] = "Name";
$GLOBALS['Contact_form_lbl_email'] = "Email";
$GLOBALS['Contact_form_lbl_city'] = "City";
$GLOBALS['Contact_form_lbl_country'] = "Country";
$GLOBALS['Contact_form_plh_country'] = "Select";
$GLOBALS['Contact_form_lbl_phone'] = "Phone";
$GLOBALS['Contact_form_lbl_reference'] = "Reference number (in case of having it)";
$GLOBALS['Contact_form_lbl_message'] = "Message";
$GLOBALS['Contact_form_btn'] = "Send";

$GLOBALS['Contact_emails_title'] = "Email accounts";
$GLOBALS['Contact_emails_lbl_1'] = "Reservations";
$GLOBALS['Contact_emails_lbl_2'] = "Accounting";
$GLOBALS['Contact_emails_lbl_3'] = "Billing";
$GLOBALS['Contact_emails_lbl_4'] = "Comments";
$GLOBALS['Contact_emails_lbl_5'] = "Customer service";
$GLOBALS['Contact_emails_lbl_6'] = "Hiring hotels";
$GLOBALS['Contact_emails_lbl_7'] = "Privacy";

$GLOBALS['Contact_address_title'] = "Address";
$GLOBALS['Contact_address_phone'] = "Phone: +52 (998) 140 6570 | Reservations 01 800 333 6539 (998) 140 6580";
$GLOBALS['Contact_address_schedule'] = "Schedule: Monday to Saturday 08:00 to 18:00 hrs.";
$GLOBALS['Contact_address_map'] = "Map";

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

$GLOBALS['Hoteles_lbl_adults'] = " adults";
$GLOBALS['Hoteles_lbl_adult'] = " adult";
$GLOBALS['Hoteles_lbl_kids'] = " kids";
$GLOBALS['Hoteles_lbl_kid'] = " kid";
$GLOBALS['Hoteles_lbl_rooms'] = " rooms";
$GLOBALS['Hoteles_lbl_room'] = " room";
$GLOBALS['Hoteles_lbl_and'] = " and ";

#View Hoteles - Search

$GLOBALS['Hoteles_Search_Home'] = "Home";
$GLOBALS['Hoteles_Search_Hotels'] = "Hotels";
$GLOBALS['Hoteles_Search_Result'] = "match with your search";
$GLOBALS['Hoteles_Search_tittle'] = "¡Reserve an Hotel!";
$GLOBALS['Hoteles_Search_New_Search'] = "New Search";
$GLOBALS['Hoteles_Search_Order_by'] = "Order by:";
$GLOBALS['Hoteles_Search_Order_Desc']= "Higher price";
$GLOBALS['Hoteles_Search_Order_Asc']= "Lower price";
$GLOBALS['Hoteles_Search_Stars']= "Stars";
$GLOBALS['Hoteles_Search_Tripadvisor']= "Tripadvisor Rate";
$GLOBALS['Hoteles_Search_List']= "List";
$GLOBALS['Hoteles_Search_Location']= "Location by hotel";
$GLOBALS['Hoteles_Search_Close']= "Close";

$GLOBALS['Hoteles_Search_lbl_service'] = "Free services:";
$GLOBALS['Hoteles_Search_lbl_cancellation'] = "Cancellation Policy:";
$GLOBALS['Hoteles_Search_lbl_price_club'] = "Price Clubestrella";
$GLOBALS['Hoteles_Search_lbl_price_oktrip'] = "Price Oktrip";
$GLOBALS['Hoteles_Search_lbl_average'] = "* Average per night.";
$GLOBALS['Hoteles_Search_lbl_tax'] = "* Taxes included.";
$GLOBALS['Hoteles_Search_btn_reserve'] = "Reserve";

#View Hoteles - Details

$GLOBALS['Hoteles_Details_Dates'] = "Change dates";
$GLOBALS['Hoteles_Details_Disponibility'] = "Check disponibility";
$GLOBALS['Hoteles_Details_Services'] = "Hotel Services";
$GLOBALS['Hoteles_Details_About'] = "About the hotel";
$GLOBALS['Hoteles_Details_Search_Result'] = "There is not match with your search, try to change the number of adults, kids, rooms or dates.";
$GLOBALS['Hoteles_Details_Capacity'] = "Maximum occupation:";
$GLOBALS['Hoteles_Details_Facilities'] = "Facilities";
$GLOBALS['Hoteles_Details_No_Facilities'] = "This hotel dont have facilities.";
$GLOBALS['Hoteles_Details_Restaurants'] = "Restaurants";
$GLOBALS['Hoteles_Details_No_Restaurants'] = "This hotel dont have restaurant service.";
$GLOBALS['Hoteles_Details_People']= "people";

#View reserve

$GLOBALS['Hoteles_Reserve_member'] = "I'm a member";
$GLOBALS['Hoteles_Reserve_account'] = "Create a profile";
$GLOBALS['Hoteles_Reserve_password'] = "Recover password";
$GLOBALS['Hoteles_Reserve_tittle_form'] = "Completa el siguiente formulario";
$GLOBALS['Hoteles_Reserve_name_form'] = "Name (s)";
$GLOBALS['Hoteles_Reserve_lastname_form'] = "Lastname";
$GLOBALS['Hoteles_Reserve_lastname'] = "Mother's lastname";
$GLOBALS['Hoteles_Reserve_email_form'] = "Email";
$GLOBALS['Hoteles_Reserve_confirm_email'] = "Confirm Email";
$GLOBALS['Hoteles_Reserve_country_form'] = "Country";
$GLOBALS['Hoteles_Reserve_state_form'] = "State";
$GLOBALS['Hoteles_Reserve_city_form'] = "City";
$GLOBALS['Hoteles_Reserve_cp_form'] = "Postal code";
$GLOBALS['Hoteles_Reserve_address_form'] = "Address";
$GLOBALS['Hoteles_Reserve_comments_form'] = "Comments";
$GLOBALS['Hoteles_Reserve_payment_form'] = "Payment method";
$GLOBALS['Hoteles_Reserve_card_form'] = "Credit card";
$GLOBALS['Hoteles_Reserve_paypal_form'] = "Paypal";
$GLOBALS['Hoteles_Reserve_points_form'] = "Points";
$GLOBALS['Hoteles_Reserve_terms_form'] = "I have read and i'm agree with the";
$GLOBALS['Hoteles_Reserve_conditions_form'] = "Terms and Conditions of the reserve.";
$GLOBALS['Hoteles_Reserve_terms_text_form'] = "I understand that will be require and id card or the credit card used for the reservation when i arrive to the hotel.";
$GLOBALS['Hoteles_Reserve_button_form'] = "Continue";
$GLOBALS['Hoteles_Reserve_clubestrella'] = "You have:";
$GLOBALS['Hoteles_Reserve_points_estrella'] = "points";
$GLOBALS['Hoteles_Reserve_pay_points'] = "¡Pay you reserve with points!";
$GLOBALS['Hoteles_Reserve_data'] = "Reservation data";
$GLOBALS['Hoteles_Reserve_login'] = "Log in";
$GLOBALS['Hoteles_Reserve_login_email'] = "Email";
$GLOBALS['Hoteles_Reserve_login_password'] = "Password";
$GLOBALS['Hoteles_Reserve_login_button'] = "Enter";
$GLOBALS['Hoteles_Reserve_signup'] = "Sign up in Clubestrella";
$GLOBALS['Hoteles_Reserve_username'] = "Username";
$GLOBALS['Hoteles_Reserve_company'] = "Company";
$GLOBALS['Hoteles_Reserve_confirm_password'] = "Confirm password";
$GLOBALS['Hoteles_Reserve_phone'] = "Phone";
$GLOBALS['Hoteles_Reserve_password_estrella'] = "Recover password";

?>