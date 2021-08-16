<!DOCTYPE html>
<html lang="en">
<head>
	<title>Oktrip!</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include("views/partialViews/_landingStyles.html"); ?>
</head>
<body id="home">
	<?php include("views/partialViews/_header.php"); ?>

	<!--div class="container-fluid banner" style="background-image: url('/img/banners/contacto_banner.png');">
		<div class="container">
			<?php include("views/partialViews/_searcher.php"); ?>
		</div>
	</div-->
	<div class="container" style="padding-right: 80px;padding-left: 80px;">
		<div id="contacto">
			<h3 style="padding-left: 45px;"><?php echo $GLOBALS['Contact_form_title']; ?></h3>
			<form action="" id="formContact">
				<div class="row">
					<div class="form-group col-md-6 paneles">
						<label for="nombre"><?php echo $GLOBALS['Contact_form_lbl_name']; ?></label>
						<input id="nombre" name="nombre" class="form-control" type="text">
						<label for="nombre" generated="true" class="error"></label>
					</div>
					<div class="form-group col-md-6 paneles">
						<label for="email"><?php echo $GLOBALS['Contact_form_lbl_email']; ?></label>
						<input id="email" name="email" class="form-control" type="email">
						<label for="email" generated="true" class="error"></label>
					</div>
					<div class="form-group col-md-6 paneles">
						<label for="ciudad"><?php echo $GLOBALS['Contact_form_lbl_city']; ?></label>
						<input id="ciudad" name="ciudad" class="form-control" type="text">
						<label for="ciudad" generated="true" class="error"></label>
					</div>
					<div class="form-group col-md-6 paneles">
						<label for="pais"><?php echo $GLOBALS['Contact_form_lbl_country']; ?></label>
						<select name="pais" id="pais" class="form-control chosen-select">
							<optgroup>
								<option value='MX' >Mexico</option>
								<option value='US' >United States</option>
							</optgroup>
							<optgroup>
								<option value='AF' >Afghanistan</option>
								<option value='AL' >Albania</option>
								<option value='DZ' >Algeria</option>
								<option value='AS' >American Samoa</option>
								<option value='AD' >Andorra</option>
								<option value='AO' >Angola</option>
								<option value='AI' >Anguilla</option>
								<option value='AQ' >Antarctica</option>
								<option value='AG' >Antigua and Barbuda</option>
								<option value='AR' >Argentina</option>
								<option value='AM' >Armenia</option>
								<option value='AW' >Aruba</option>
								<option value='AU' >Australia</option>
								<option value='AT' >Austria</option>
								<option value='AZ' >Azerbaidjan</option>
								<option value='BS' >Bahamas</option>
								<option value='BH' >Bahrain</option>
								<option value='BD' >Bangladesh</option>
								<option value='BB' >Barbados</option>
								<option value='BY' >Belarus</option>
								<option value='BE' >Belgium</option>
								<option value='BZ' >Belize</option>
								<option value='BJ' >Benin</option>
								<option value='BM' >Bermuda</option>
								<option value='BT' >Bhutan</option>
								<option value='BO' >Bolivia</option>
								<option value='BA' >Bosnia-Herzegovina</option>
								<option value='BW' >Botswana</option>
								<option value='BV' >Bouvet Island</option>
								<option value='BR' >Brazil</option>
								<option value='IO' >British Indian Ocean</option>
								<option value='BN' >Brunei Darussalam</option>
								<option value='BG' >Bulgaria</option>
								<option value='BF' >Burkina Faso</option>
								<option value='BI' >Burundi</option>
								<option value='KH' >Cambodia</option>
								<option value='CM' >Cameroon</option>
								<option value='CA' >Canada</option>
								<option value='CV' >Cape Verde</option>
								<option value='KY' >Cayman Islands</option>
								<option value='CF' >Central African Republic</option>
								<option value='CC' >Cocos (Keeling) Islands</option>
								<option value='CO' >Colombia</option>
								<option value='KM' >Comoros</option>
								<option value='CG' >Congo</option>
								<option value='CK' >Cook Islands</option>
								<option value='CR' >Costa Rica</option>
								<option value='HR' >Croatia</option>
								<option value='CU' >Cuba</option>
								<option value='CY' >Cyprus</option>
								<option value='CZ' >Czech Republic</option>
								<option value='TD' >Chad</option>
								<option value='CL' >Chile</option>
								<option value='CN' >China</option>
								<option value='CX' >Christmas Island</option>
								<option value='DK' >Denmark</option>
								<option value='DJ' >Djibouti</option>
								<option value='DM' >Dominica</option>
								<option value='DO' >Dominican Republic</option>
								<option value='TP' >East Timor</option>
								<option value='EC' >Ecuador</option>
								<option value='EG' >Egypt</option>
								<option value='SV' >El Salvador</option>
								<option value='GQ' >Equatorial Guinea</option>
								<option value='EE' >Estonia</option>
								<option value='ET' >Ethiopia</option>
								<option value='FK' >Falkland Islands</option>
								<option value='FO' >Faroe Islands</option>
								<option value='FJ' >Fiji</option>
								<option value='FI' >Finland</option>
								<option value='SU' >Former USSR</option>
								<option value='FR' >France</option>
								<option value='GF' >French Guyana</option>
								<option value='TF' >French Southern Territories</option>
								<option value='GA' >Gabon</option>
								<option value='GM' >Gambia</option>
								<option value='GE' >Georgia</option>
								<option value='DE' >Germany</option>
								<option value='GH' >Ghana</option>
								<option value='GI' >Gibraltar</option>
								<option value='GB' >Great Britain/UK</option>
								<option value='GR' >Greece</option>
								<option value='GL' >Greenland</option>
								<option value='GD' >Grenada</option>
								<option value='GP' >Guadeloupe (French)</option>
								<option value='GU' >Guam (USA)</option>
								<option value='GT' >Guatemala</option>
								<option value='GN' >Guinea</option>
								<option value='GW' >Guinea Bissau</option>
								<option value='GY' >Guyana</option>
								<option value='HT' >Haiti</option>
								<option value='HM' >Heard &amp; McDonald Islands</option>
								<option value='HN' >Honduras</option>
								<option value='HK' >Hong Kong</option>
								<option value='HU' >Hungary</option>
								<option value='IS' >Iceland</option>
								<option value='IN' >India</option>
								<option value='ID' >Indonesia</option>
								<option value='IR' >Iran</option>
								<option value='IQ' >Iraq</option>
								<option value='IE' >Ireland</option>
								<option value='IL' >Israel</option>
								<option value='IT' >Italy</option>
								<option value='CI' >Ivory Coast</option>
								<option value='JM' >Jamaica</option>
								<option value='JP' >Japan</option>
								<option value='JO' >Jordan</option>
								<option value='KZ' >Kazakhstan</option>
								<option value='KE' >Kenya</option>
								<option value='KI' >Kiribati</option>
								<option value='KW' >Kuwait</option>
								<option value='KG' >Kyrgyzstan</option>
								<option value='LA' >Laos</option>
								<option value='LV' >Latvia</option>
								<option value='LB' >Lebanon</option>
								<option value='LS' >Lesotho</option>
								<option value='LR' >Liberia</option>
								<option value='LY' >Libya</option>
								<option value='LI' >Liechtenstein</option>
								<option value='LT' >Lithuania</option>
								<option value='LU' >Luxembourg</option>
								<option value='MO' >Macau</option>
								<option value='MK' >Macedonia</option>
								<option value='MG' >Madagascar</option>
								<option value='MW' >Malawi</option>
								<option value='MY' >Malaysia</option>
								<option value='MV' >Maldives</option>
								<option value='ML' >Mali</option>
								<option value='MT' >Malta</option>
								<option value='MH' >Marshall Islands</option>
								<option value='MQ' >Martinique</option>
								<option value='MR' >Mauritania</option>
								<option value='MU' >Mauritius</option>
								<option value='YT' >Mayotte</option>
								<option value='MX' >Mexico</option>
								<option value='FM' >Micronesia</option>
								<option value='MD' >Moldavia</option>
								<option value='MC' >Monaco</option>
								<option value='MN' >Mongolia</option>
								<option value='MS' >Montserrat</option>
								<option value='MA' >Morocco</option>
								<option value='MZ' >Mozambique</option>
								<option value='MM' >Myanmar</option>
								<option value='NA' >Namibia</option>
								<option value='NR' >Nauru</option>
								<option value='NP' >Nepal</option>
								<option value='NL' >Netherlands</option>
								<option value='AN' >Netherlands Antillas</option>
								<option value='NT' >Neutral Zone</option>
								<option value='NC' >New Caledonia</option>
								<option value='NZ' >New Zealand</option>
								<option value='NI' >Nicaragua</option>
								<option value='NE' >Niger</option>
								<option value='NG' >Nigeria</option>
								<option value='NU' >Niue</option>
								<option value='NF' >Norfolk Island</option>
								<option value='KP' >North Corea</option>
								<option value='MP' >Northern Mariana Islands</option>
								<option value='NO' >Norway</option>
								<option value='OM' >Oman</option>
								<option value='PK' >Pakistan</option>
								<option value='PW' >Palau</option>
								<option value='PA' >Panama</option>
								<option value='PG' >Papua New Guinea</option>
								<option value='PY' >Paraguay</option>
								<option value='PE' >Peru</option>
								<option value='PH' >Philippines</option>
								<option value='PN' >Pitcairn Island</option>
								<option value='PL' >Poland</option>
								<option value='PF' >Polynesia</option>
								<option value='PT' >Portugal</option>
								<option value='PR' >Puerto Rico</option>
								<option value='QA' >Qatar</option>
								<option value='RE' >Reunion</option>
								<option value='RO' >Romania</option>
								<option value='RU' >Russian Federation</option>
								<option value='RW' >Rwanda</option>
								<option value='GS' >S. Georgia Is. </option>
								<option value='SH' >Saint Helena</option>
								<option value='KN' >Saint Kitts &amp; Nevis Anguilla</option>
								<option value='LC' >Saint Lucia</option>
								<option value='PM' >Saint Pierre and Miquelon</option>
								<option value='ST' >Saint Tome and Principe</option>
								<option value='VC' >Saint Vicent &amp; Grenadines</option>
								<option value='WS' >Samoa</option>
								<option value='SM' >San Marino</option>
								<option value='SA' >Saudi Arabia</option>
								<option value='SN' >Senegal</option>
								<option value='SC' >Seychelles</option>
								<option value='SL' >Sierra Leone</option>
								<option value='SG' >Singapore</option>
								<option value='SK' >Slovak Republic</option>
								<option value='SI' >Slovenia</option>
								<option value='SB' >Solomon Islands</option>
								<option value='SO' >Somalia</option>
								<option value='ZA' >South Africa</option>
								<option value='KR' >South Corea</option>
								<option value='ES' >Spain</option>
								<option value='LK' >Sri Lanka</option>
								<option value='SD' >Sudan</option>
								<option value='SR' >Suriname</option>
								<option value='SJ' >Svalvard &amp; Jan Mayen Is.</option>
								<option value='SZ' >Swaziland</option>
								<option value='SE' >Sweden</option>
								<option value='CH' >Switzerland</option>
								<option value='SY' >Syria</option>
								<option value='TJ' >Tadjikistan</option>
								<option value='TW' >Taiwan</option>
								<option value='TZ' >Tanzania</option>
								<option value='TH' >Thailand</option>
								<option value='TG' >Togo</option>
								<option value='TK' >Tokelau</option>
								<option value='TO' >Tonga</option>
								<option value='TT' >Trinidad and Tobago</option>
								<option value='TN' >Tunisia</option>
								<option value='TR' >Turkey</option>
								<option value='TM' >Turkmenistan</option>
								<option value='TC' >Turks and Caicos Islands</option>
								<option value='TV' >Tuvalu</option>
								<option value='UG' >Uganda</option>
								<option value='UA' >Ukraine</option>
								<option value='AE' >United Arab Emirates</option>
								<option value='US' >United States</option>
								<option value='UY' >Uruguay</option>
								<option value='MI' >USA Military</option>
								<option value='UM' >USA Minor Outlying Islands</option>
								<option value='UZ' >Uzbekistan</option>
								<option value='VU' >Vanuatu</option>
								<option value='VA' >Vatican City State</option>
								<option value='VE' >Venezuela</option>
								<option value='VN' >Vietnam</option>
								<option value='VG' >Virgin Islands (British)</option>
								<option value='VI' >Virgin Islands (USA)</option>
								<option value='WF' >Wallis and Futura Islands</option>
								<option value='EH' >Western Sahara</option>
								<option value='YE' >Yemen</option>
								<option value='YU' >Yugoslavia</option>
								<option value='ZR' >Zaire</option>
								<option value='ZM' >Zambia</option>
								<option value='ZW' >Zimbabwe</option>
							</optgroup>
						</select>
						<label for="pais" generated="true" class="error"></label>
					</div>
					<div class="form-group col-md-6 paneles">
						<label for="telefono"><?php echo $GLOBALS['Contact_form_lbl_phone']; ?></label>
						<input id="telefono" name="telefono" class="form-control" type="text">
						<label for="telefono" generated="true" class="error"></label>
					</div>
					<div class="form-group col-md-6 paneles">
						<label for="reserva"><?php echo $GLOBALS['Contact_form_lbl_reference']; ?></label>
						<input id="reserva" name="reserva" class="form-control" type="text">
						<label for="reserva" generated="true" class="error"></label>
					</div>
					<div class="form-group col-md-12 paneles">
						<label for="mensaje"><?php echo $GLOBALS['Contact_form_lbl_message']; ?></label>
						<textarea name="mensaje" id="mensaje" class="form-control" rows="10" style="resize: none;"></textarea>
						<label for="mensaje" generated="true" class="error"></label>
					</div>
					<div class="form-group col-md-offset-6 col-md-6 paneles">
						<input id="send" class="form-control pull-right" type="submit" value="<?php echo $GLOBALS['Contact_form_btn']; ?>">
						<img src="/img/gif/loading.gif" id="loading" class="hidden" alt="Loading..." style="width: 39px;">
						<div id="boxMessage" class="alert"></div>
					</div>
				</div>
			</form>
		</div>
	</div>


	<div class="container" style="padding: 80px;" id="description">
		<div class="row paneles">
			<h3 style="color: #FC5D20;margin-bottom: 30px;"><?php echo $GLOBALS['Contact_emails_title']; ?></h3>
			<div class="col-xs-12 col-sm-4"><p class="mind"><?php echo $GLOBALS['Contact_emails_lbl_1']; ?></p></div>
			<div class="col-xs-12 col-sm-4"><p class="mind"><a href="mailto:reservations@oktravel.mx">reservations@oktravel.mx</a></p></div>
		</div>
		<div class="row paneles">
			<div class="col-xs-12 col-sm-4"><p class="mind"><?php echo $GLOBALS['Contact_emails_lbl_2']; ?></p></div>
			<div class="col-xs-12 col-sm-4"><p class="mind"><a href="mailto:contabilidad@oktravel.mx">contabilidad@oktravel.mx</a></p></div>
		</div>
		<div class="row paneles">
			<div class="col-xs-12 col-sm-4"><p class="mind"><?php echo $GLOBALS['Contact_emails_lbl_3']; ?></p></div>
			<div class="col-xs-12 col-sm-4"><p class="mind"><a href="mailto:facturacion@oktravel.mx">facturacion@oktravel.mx</a></p></div>
		</div>
		<div class="row paneles">
			<div class="col-xs-12 col-sm-4"><p class="mind"><?php echo $GLOBALS['Contact_emails_lbl_4']; ?></p></div>
			<div class="col-xs-12 col-sm-4"><p class="mind"><a href="mailto:info@oktravel.mx">info@oktravel.mx</a></p></div>
		</div>
		<div class="row paneles">
			<div class="col-xs-12 col-sm-4"><p class="mind"><?php echo $GLOBALS['Contact_emails_lbl_5']; ?></p></div>
			<div class="col-xs-12 col-sm-4"><p class="mind"><a href="mailto:customerservice@oktravel.mx">customerservice@oktravel.mx</a></p></div>
		</div>
		<div class="row paneles">
			<div class="col-xs-12 col-sm-4"><p class="mind"><?php echo $GLOBALS['Contact_emails_lbl_6']; ?></p></div>
			<div class="col-xs-12 col-sm-4"><p class="mind"><a href="mailto:producto@oktravel.mx">producto@oktravel.mx</a></p></div>
		</div>
		<div class="row paneles">
			<div class="col-xs-12 col-sm-4"><p class="mind"><?php echo $GLOBALS['Contact_emails_lbl_7']; ?></p></div>
			<div class="col-xs-12 col-sm-4"><p class="mind"><a href="mailto:privacidad@oktravel.mx">privacidad@oktravel.mx</a></p></div>
		</div>
		<div class="row paneles">
			<div class="col-xs-12 col-sm-12">
				<p style="margin-top: 30px;margin-bottom: 50px;"><?php echo $GLOBALS['Contact_address_title']; ?></p>
				<p>Ok Trip - México</p>
				<p class="mind">Av. Carlos Nader Manzana 1 Lote 1 a 3 SM 2, Cancún Benito Juárez, Quintana Roo CP 77500.</p>
				<p class="mind"><?php echo $GLOBALS['Contact_address_phone']; ?></p>
				<p style="margin-bottom: 50px;"><?php echo $GLOBALS['Contact_address_schedule']; ?></p>
			</div>
			<h3 style="color: #FC5D20;margin-bottom: 30px;"><?php echo $GLOBALS['Contact_address_map']; ?></h3>
			<div id="ubicacion" style="height: 300px;margin-bottom: 60px;"></div>
		</div>
	</div>
	<?php include("views/partialViews/_loader-page.html"); ?>
	<?php include("views/partialViews/_footer.php"); ?>
	<?php include("views/partialViews/_landingScripts.html"); ?>
	<script type="text/javascript">

		$(document).ready(function(){

			initUbicacion();


		});// fin Document Ready

		function initUbicacion() {

			var posicion = {lat: 21.167931, lng:  -86.824030};
			var map = new google.maps.Map(document.getElementById('ubicacion'), {
				center: posicion,
				zoom: 15
			});

			var pin = {
				url: "/img/iconos/mapIcon.svg",
				size: new google.maps.Size(80, 60)
			};

			var marker = new google.maps.Marker({
				map: map,
				position: { lat: 21.167931, lng:  -86.824030 },
				icon: pin,
			});
		}// fin de la funcion Mapa general
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuPcjJM0GlcPgfN-woHfY2FnU_vRq8av4"></script>
</body>
</html>