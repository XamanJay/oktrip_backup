<?php 
//require(realpath($_SERVER['DOCUMENT_ROOT'])."/models/clubestrella/cliente.php");
//require(realpath($_SERVER['DOCUMENT_ROOT'])."/controllers/clubestrellaController.php");
//session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Oktrip!</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include("views/partialViews/_landingStyles.html"); ?>
	<link rel="stylesheet" type="text/css" href="/css/chosen/chosen.min.css">
	<link rel="stylesheet" type="text/css" href="/css/chosen/bootstrap-chosen.css">

</head>
<body id="reserve">
	<?php include("views/partialViews/_header.php"); ?>
	<div class="container" >
		<div class="row" style="margin-top: 30px;">
			<?php 
			if (isset($_SESSION['cliente'])) {
				?>
				<div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-6 col-sm-offset-6">
				</div>
				<?php
			}else{
				?>
				<div class="col-xs-12 col-sm-9 col-md-9 ">
					<div class="row" style="margin-bottom: 20px;">

						<div class="col-xs-3 col-sm-3 col-md-3">
							<img src="/img/logos/ClubestrellaIcon2.svg" alt="Clubestrella" style="width: 100px; float: left;">
						</div>
						<div class="col-xs-3 col-sm-3 col-md-2 col-md-offset-3 centerText">
							<!-- Button trigger modal -->
							<button type="button" class="btn btn-primary buttonsEstrella" data-toggle="modal" data-target="#soyMiembro" data-backdrop="static">
								<img src="/img/iconos/miembro.png" alt="Soy Miembro" class="imgEstrella">
								<p><?php echo $GLOBALS['Hoteles_Reserve_member']; ?></p>
							</button>
						</div>

						<div class="col-xs-3 col-sm-3 col-md-2 centerText">
							<button type="button" class="btn btn-primary buttonsEstrella" data-toggle="modal" data-target="#newMember" data-backdrop="static">
								<img src="/img/iconos/perfil.png" alt="Crear Perfil" class="imgEstrella">
								<p><?php echo $GLOBALS['Hoteles_Reserve_account'] ?></p>
							</button>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-2 centerText">
							<button type="button" class="btn btn-primary buttonsEstrella" data-toggle="modal" data-target="#Passrecover" data-backdrop="static">
								<img src="/img/iconos/password.png" alt="Recuperar Contraseña" class="imgEstrella">
								<p><?php echo $GLOBALS['Hoteles_Reserve_password']; ?></p>
							</button>
						</div>

					</div>
				</div>
				<?php
			}
			?>
		</div>
		<div class="row">
			<div class="col-sm-9">
				<h4 id="titleForm"><?php echo $GLOBALS['Hoteles_Reserve_tittle_form']; ?></h4>
				<div class="hr-solid-wm"></div>
				<form id="formReserve" action="/hoteles/reserve" method="POST">
					<div class="row" style="margin-top: 20px;">

						<div class="form-group col-sm-6">
							<label for="nombre"><?php echo $GLOBALS['Hoteles_Reserve_name_form']; ?></label>
							<input id="nombre" name="nombre" type="text" class="form-control" value="<?php echo (isset($_SESSION['cliente'])) ? $_SESSION['cliente']->getNombre() : '' ; ?>">

						</div>
						<div class="form-group col-sm-6">
							<label for="ape_pat"><?php echo $GLOBALS['Hoteles_Reserve_lastname_form']; ?></label>
							<input id="ape_pat" name="ape_pat" type="text" class="form-control" value="<?php echo (isset($_SESSION['cliente'])) ? $_SESSION['cliente']->getApellidoPaterno() : '' ; ?>">

						</div>
						<!--div class="form-group col-sm-6">
							<label for="ape_mat"><?php echo $GLOBALS['Hoteles_Reserve_lastname']; ?></label>

						</div-->
						<input id="ape_mat" name="ape_mat" type="hidden" class="form-control" value="N">
						<div class="form-group col-sm-6">
							<label for="telefono"><?php echo $GLOBALS['Hoteles_Reserve_phone']; ?></label>
							<input id="telefono" name="telefono" type="text" class="form-control" value="<?php echo (isset($_SESSION['cliente'])) ? $_SESSION['cliente']->getTelefono() : '' ; ?>">

						</div>
						<div class="form-group col-sm-6">
							<label for="email"><?php echo $GLOBALS['Hoteles_Reserve_email_form']; ?></label>
							<input id="email" name="email" type="email" class="form-control" value="<?php echo (isset($_SESSION['cliente'])) ? $_SESSION['cliente']->getEmail() : ''; ?>">

						</div>
						<div class="form-group col-sm-6">
							<label for="conf_email"><?php echo $GLOBALS['Hoteles_Reserve_confirm_email']; ?></label>
							<input id="conf_email" name="conf_email" type="email" class="form-control" value="<?php echo (isset($_SESSION['cliente'])) ? $_SESSION['cliente']->getEmail()  : '' ; ?>">

						</div>	
						<div class="form-group col-sm-6">
							<label for="pais"><?php echo $GLOBALS['Hoteles_Reserve_country_form']; ?></label>
							<select class="form-control chosen-select" id="pais" name="pais">
								<optgroup>
									<option value="MX" selected="selected">México</option>
									<option value="US">United States</option>
								</optgroup>
								<optgroup>
									<option value="AF">Afghanistan (‫افغانستان‬‎)</option>
									<option value="AX">Åland Islands (Åland)</option>
									<option value="AL">Albania (Shqipëri)</option>
									<option value="DZ">Algeria</option>
									<option value="AS">American Samoa</option>
									<option value="AD">Andorra</option>
									<option value="AO">Angola</option>
									<option value="AI">Anguilla</option>
									<option value="AQ">Antarctica</option>
									<option value="AG">Antigua and Barbuda</option>
									<option value="AR">Argentina</option>
									<option value="AM">Armenia (Հայաստան)</option>
									<option value="AW">Aruba</option>
									<!--option value="13">Ascension Island</option-->
									<option value="AU">Australia</option>
									<option value="AT">Austria (Österreich)</option>
									<option value="AZ">Azerbaijan (Azərbaycan)</option>
									<option value="BS">Bahamas</option>
									<option value="BH">Bahrain (‫البحرين‬‎)</option>
									<option value="BD">Bangladesh (বাংলাদেশ)</option>
									<option value="BB">Barbados</option>
									<option value="BY">Belarus (Беларусь)</option>
									<option value="BE">Belgium</option>
									<option value="BZ">Belize</option>
									<option value="BJ">Benin (Bénin)</option>
									<option value="BM">Bermuda</option>
									<option value="BT">Bhutan (འབྲུག)</option>
									<option value="BO">Bolivia</option>
									<option value="BA">Bosnia and Herzegovina (Босна и Херцеговина)</option>
									<option value="BW">Botswana</option>
									<option value="BV">Bouvet Island</option>
									<option value="BR">Brazil (Brasil)</option>
									<option value="IO">British Indian Ocean Territory</option>
									<option value="VG">British Virgin Islands</option>
									<option value="BN">Brunei</option>
									<option value="BG">Bulgaria (България)</option>
									<option value="BF">Burkina Faso</option>
									<option value="BI">Burundi (Uburundi)</option>
									<option value="KH">Cambodia (កម្ពុជា)</option>
									<option value="CM">Cameroon (Cameroun)</option>
									<option value="CA">Canada</option>
									<!--option value="41">Canary Islands (Canarias)</option-->
									<!--option value="42">Cape Verde (Kabu Verdi)</option-->
									<!--option value="43">Caribbean Netherlands</option-->
									<option value="KY">Cayman Islands</option>
									<option value="CF">Central African Republic (République centrafricaine)</option>
									<!--option value="46">Ceuta and Melilla (Ceuta y Melilla)</option-->
									<option value="TD">Chad (Tchad)</option>
									<option value="CL">Chile</option>
									<option value="CN">China (中国)</option>
									<option value="CX">Christmas Island</option>
									<!--option value="51">Clipperton Island</option-->
									<option value="CC">Cocos (Keeling) Islands (Kepulauan Cocos (Keeling))</option>
									<option value="CO">Colombia</option>
									<option value="KM">Comoros (‫جزر القمر‬‎)</option>
									<option value="CG">Congo</option>
									<option value="CK">Cook Islands</option>
									<option value="CR">Costa Rica</option>
									<option value="CI">Côte d’Ivoire</option>
									<option value="HR">Croatia (Hrvatska)</option>
									<option value="CU">Cuba</option>
									<option value="CW">Curaçao</option>
									<option value="CY">Cyprus (Κύπρος)</option>
									<option value="CZ">Czechia (Česko)</option>
									<option value="DK">Denmark (Danmark)</option>
									<option value="DJ">Djibouti</option>
									<option value="DM">Dominica</option>
									<option value="DO">Dominican Republic (República Dominicana)</option>
									<option value="EC">Ecuador</option>
									<option value="EG">Egypt (‫مصر‬‎)</option>
									<option value="SV">El Salvador</option>
									<option value="GQ">Equatorial Guinea (Guinea Ecuatorial)</option>
									<option value="ER">Eritrea</option>
									<option value="EE">Estonia (Eesti)</option>
									<option value="ET">Ethiopia</option>
									<option value="FK">Falkland Islands (Islas Malvinas)</option>
									<option value="FO">Faroe Islands (Føroyar)</option>
									<option value="FJ">Fiji</option>
									<option value="FI">Finland (Suomi)</option>
									<option value="FR">France</option>
									<option value="GF">French Guiana (Guyane française)</option>
									<option value="PF">French Polynesia (Polynésie française)</option>
									<option value="TF">French Southern Territories (Terres australes françaises)</option>
									<option value="GA">Gabon</option>
									<option value="GM">Gambia</option>
									<option value="GE">Georgia (საქართველო)</option>
									<option value="DE">Germany (Deutschland)</option>
									<option value="GH">Ghana (Gaana)</option>
									<option value="GI">Gibraltar</option>
									<option value="GR">Greece (Ελλάδα)</option>
									<option value="GL">Greenland (Kalaallit Nunaat)</option>
									<option value="GD">Grenada</option>
									<option value="GP">Guadeloupe</option>
									<option value="GU">Guam</option>
									<option value="GT">Guatemala</option>
									<option value="GG">Guernsey</option>
									<option value="GN">Guinea (Guinée)</option>
									<option value="GW">Guinea-Bissau (Guiné-Bissau)</option>
									<option value="GY">Guyana</option>
									<option value="HT">Haiti</option>
									<option value="HM">Heard and McDonald Islands</option>
									<option value="HN">Honduras</option>
									<option value="HK">Hong Kong (香港)</option>
									<option value="HU">Hungary (Magyarország)</option>
									<option value="IS">Iceland (Ísland)</option>
									<option value="IN">India (भारत)</option>
									<option value="ID">Indonesia</option>
									<option value="IR">Iran (‫ایران‬‎)</option>
									<option value="IQ">Iraq (‫العراق‬‎)</option>
									<option value="IE">Ireland</option>
									<option value="IM">Isle of Man</option>
									<option value="IL">Israel (‫ישראל‬‎)</option>
									<option value="IT">Italy (Italia)</option>
									<option value="JM">Jamaica</option>
									<option value="JP">Japan (日本)</option>
									<option value="JE">Jersey</option>
									<option value="JO">Jordan (‫الأردن‬‎)</option>
									<option value="KZ">Kazakhstan (Казахстан)</option>
									<option value="KE">Kenya</option>
									<option value="KI">Kiribati</option>
									<!--option value="122">Kosovo (Kosovë)</option-->
									<option value="KW">Kuwait (‫الكويت‬‎)</option>
									<option value="KG">Kyrgyzstan (Кыргызстан)</option>
									<option value="LA">Laos (ລາວ)</option>
									<option value="LV">Latvia (Latvija)</option>
									<option value="LB">Lebanon (‫لبنان‬‎)</option>
									<option value="LS">Lesotho</option>
									<option value="LR">Liberia</option>
									<option value="LY">Libya (‫ليبيا‬‎)</option>
									<option value="LI">Liechtenstein</option>
									<option value="LT">Lithuania (Lietuva)</option>
									<option value="LU">Luxembourg</option>
									<option value="MO">Macau (澳門)</option>
									<option value="MK">Macedonia (FYROM) (Република Македонија)</option>
									<option value="MG">Madagascar (Madagasikara)</option>
									<option value="MW">Malawi</option>
									<option value="MY">Malaysia</option>
									<option value="MV">Maldives</option>
									<option value="ML">Mali</option>
									<option value="MT">Malta</option>
									<option value="MH">Marshall Islands</option>
									<option value="MQ">Martinique</option>
									<option value="MR">Mauritania (‫موريتانيا‬‎)</option>
									<option value="MU">Mauritius (Moris)</option>
									<option value="YT">Mayotte</option>
									<option value="MX">Mexico (México)</option>
									<option value="FM">Micronesia</option>
									<option value="MD">Moldova (Republica Moldova)</option>
									<option value="MC">Monaco</option>
									<option value="MN">Mongolia (Монгол)</option>
									<option value="ME">Montenegro (Crna Gora)</option>
									<option value="MS">Montserrat</option>
									<option value="MA">Morocco</option>
									<option value="MZ">Mozambique (Moçambique)</option>
									<option value="MM">Myanmar (Burma) (မြန်မာ)</option>
									<option value="NA">Namibia (Namibië)</option>
									<option value="NR">Nauru</option>
									<option value="NP">Nepal (नेपाल)</option>
									<option value="NL">Netherlands (Nederland)</option>
									<option value="NC">New Caledonia (Nouvelle-Calédonie)</option>
									<option value="NZ">New Zealand</option>
									<option value="NI">Nicaragua</option>
									<option value="NE">Niger (Nijar)</option>
									<option value="NG">Nigeria</option>
									<option value="NU">Niue</option>
									<option value="NF">Norfolk Island</option>
									<option value="MP">Northern Mariana Islands</option>
									<option value="NO">Norway (Norge)</option>
									<option value="OM">Oman (‫عُمان‬‎)</option>
									<option value="PK">Pakistan (‫پاکستان‬‎)</option>
									<option value="PW">Palau</option>
									<option value="PS">Palestine (‫فلسطين‬‎)</option>
									<option value="PA">Panama (Panamá)</option>
									<option value="PG">Papua New Guinea</option>
									<option value="PY">Paraguay</option>
									<option value="PE">Peru (Perú)</option>
									<option value="PH">Philippines</option>
									<option value="PN">Pitcairn Islands</option>
									<option value="PL">Poland (Polska)</option>
									<option value="PT">Portugal</option>
									<option value="PR">Puerto Rico</option>
									<option value="QA">Qatar (‫قطر‬‎)</option>
									<option value="RE">Réunion (La Réunion)</option>
									<option value="RO">Romania (România)</option>
									<option value="RU">Russia (Россия)</option>
									<option value="RW">Rwanda</option>
									<option value="WS">Samoa</option>
									<option value="SM">San Marino</option>
									<option value="ST">São Tomé and Príncipe (São Tomé e Príncipe)</option>
									<option value="SA">Saudi Arabia (‫المملكة العربية السعودية‬‎)</option>
									<option value="SN">Senegal</option>
									<option value="RS">Serbia (Србија)</option>
									<option value="SC">Seychelles</option>
									<option value="SL">Sierra Leone</option>
									<option value="SG">Singapore</option>
									<option value="SX">Sint Maarten</option>
									<option value="SK">Slovakia (Slovensko)</option>
									<option value="SI">Slovenia (Slovenija)</option>
									<option value="SB">Solomon Islands</option>
									<option value="SO">Somalia (Soomaaliya)</option>
									<option value="ZA">South Africa</option>
									<option value="GS">South Georgia and South Sandwich Islands</option>
									<option value="KR">South Korea (대한민국)</option>
									<option value="SS">South Sudan (‫جنوب السودان‬‎)</option>
									<option value="ES">Spain (España)</option>
									<option value="LK">Sri Lanka (ශ්‍රී ලංකාව)</option>
									<option value="BL">St. Barthélemy (Saint-Barthélemy)</option>
									<option value="SH">St. Helena</option>
									<option value="KN">St. Kitts and Nevis</option>
									<option value="LC">St. Lucia</option>
									<option value="MF">St. Martin (Saint-Martin)</option>
									<option value="PM">St. Pierre and Miquelon (Saint-Pierre-et-Miquelon)</option>
									<option value="VC">St. Vincent and Grenadines</option>
									<option value="SD">Sudan (‫السودان‬‎)</option>
									<option value="SR">Suriname</option>
									<option value="SJ">Svalbard and Jan Mayen (Svalbard og Jan Mayen)</option>
									<option value="SZ">Swaziland</option>
									<option value="SE">Sweden (Sverige)</option>
									<option value="CH">Switzerland (Schweiz)</option>
									<option value="SY">Syria (‫سوريا‬‎)</option>
									<option value="TW">Taiwan (台灣)</option>
									<option value="TJ">Tajikistan</option>
									<option value="TZ">Tanzania</option>
									<option value="TH">Thailand (ไทย)</option>
									<option value="TL">Timor-Leste</option>
									<option value="TG">Togo</option>
									<option value="TK">Tokelau</option>
									<option value="TO">Tonga</option>
									<option value="TT">Trinidad and Tobago</option>
									<option value="SH">Tristan da Cunha</option>
									<option value="TN">Tunisia</option>
									<option value="TR">Turkey (Türkiye)</option>
									<option value="TM">Turkmenistan</option>
									<option value="TC">Turks and Caicos Islands</option>
									<option value="TV">Tuvalu</option>
									<option value="UM">U.S. Outlying Islands</option>
									<option value="VI">U.S. Virgin Islands</option>
									<option value="UG">Uganda</option>
									<option value="UA">Ukraine (Україна)</option>
									<option value="AE">United Arab Emirates (‫الإمارات العربية المتحدة‬‎)</option>
									<option value="GB">United Kingdom</option>
									<option value="US">United States</option>
									<option value="UY">Uruguay</option>
									<option value="UZ">Uzbekistan (Oʻzbekiston)</option>
									<option value="VU">Vanuatu</option>
									<!--option value="248">Vatican City (Città del Vaticano)</option-->
									<option value="VE">Venezuela</option>
									<option value="VN">Vietnam (Việt Nam)</option>
									<option value="WF">Wallis and Futuna</option>
									<option value="EH">Western Sahara (‫الصحراء الغربية‬‎)</option>
									<option value="YE">Yemen (‫اليمن‬‎)</option>
									<option value="ZM">Zambia</option>
									<option value="ZW">Zimbabwe</option>
								</optgroup>
							</select>

						</div>
						<div class="form-group col-sm-6">
							<label for="estado"><?php echo $GLOBALS['Hoteles_Reserve_state_form']; ?></label>
							<input id="estado" name="estado" type="text" class="form-control" value="<?php echo (isset($_SESSION['cliente'])) ? $_SESSION['cliente']->getEstado() : '' ?>">

						</div>
						<div class="form-group col-sm-6">
							<label for="ciudad"><?php echo $GLOBALS['Hoteles_Reserve_city_form']; ?></label>
							<input id="ciudad" name="ciudad" type="text" class="form-control" value="<?php echo (isset($_SESSION['cliente'])) ?  $_SESSION['cliente']->getCiudad() : ''; ?>">

						</div>
						<div class="form-group col-sm-6">
							<label for="codigo_postal"><?php echo $GLOBALS['Hoteles_Reserve_cp_form']; ?></label>
							<input id="codigo_postal" name="codigo_postal" type="text" class="form-control" value="<?php echo (isset($_SESSION['cliente'])) ? $_SESSION['cliente']->getCiudad() : ''; ?>">

						</div>
						<div class="form-group col-sm-12">
							<label for="direccion"><?php echo $GLOBALS['Hoteles_Reserve_address_form']; ?></label>
							<input id="direccion" name="direccion" type="text" class="form-control" value="<?php echo (isset($_SESSION['cliente'])) ? $_SESSION['cliente']->getDireccion() : ''; ?>">

						</div>
						<div class="form-group col-sm-12">
							<label for="comentarios"><?php echo $GLOBALS['Hoteles_Reserve_comments_form']; ?></label>
							<textarea id="comentarios" name="comentarios" class="form-control" style="resize: none; height: 100px;"></textarea>

						</div>
					</div>

					<!-- Metodos de Pago -->
					<div class="row" id="metodoPagos">
						<div class="form-group col-sm-12">
							<p style="color: #777;"><?php echo $GLOBALS['Hoteles_Reserve_payment_form']; ?></p>
						</div>
						<div class="col-xs-6 col-md-4 col-sm-4" style="text-align: center;">
							<label class="form-check-label equals" id="pagoHotel">
								<input class="form-check-input equals" type="radio" name="metodoPago" id="pasarela" value="credit_card">
							</label>
							<img src="/img/iconos/tarjeta.svg" alt="Terminal Bancaria" style="width: 50px;">
							<p class="equals" style="text-align: center;"><?php echo $GLOBALS['Hoteles_Reserve_card_form']; ?></p>
						</div>
						<div class="col-xs-6 col-md-4 col-sm-4" style="text-align: center;">
							<label class="form-check-label equals" id="pagoPaypal">
								<input class="form-check-input equals" type="radio" name="metodoPago" id="paypal" value="paypal">
							</label>
							<img src="/img/iconos/paypal.svg" alt="Paypal" style="width: 65px;">
							<p class="equals" style="text-align: center;"><?php echo $GLOBALS['Hoteles_Reserve_paypal_form'] ?></p>
						</div>
						<div class="col-xs-6 col-md-4 col-sm-4 hide" style="text-align: center;">
							<label class="form-check-label equals" id="pagoPuntos">
								<input class="form-check-input equals" type="radio" name="metodoPago" id="saldoPoints" value="puntos">
							</label>
							<p class="equals" style="text-align: center;"><?php echo $GLOBALS['Hoteles_Reserve_points_form'] ?></p>
						</div>
					</div>
					<div class="row" style="margin-bottom: 20px;">
						<div class="col-md-12">
							<p>
								<div class="checkbox text-justify">
									<label>
										<input id="accept_terms" name="accept_terms" type="checkbox"> <?php echo $GLOBALS['Hoteles_Reserve_terms_form']; ?> <a href="#2" onclick="load_modal()"><?php echo $GLOBALS['Hoteles_Reserve_conditions_form']; ?></a> <?php echo $GLOBALS['Hoteles_Reserve_terms_text_form']; ?>
									</label>
								</div>
								<label for="accept_terms" generated="true" class="error"></label>
							</p>
						</div>
							<!--div class="col-md-12">
								<div class="form-group">
									<div class="g-recaptcha" data-sitekey="6Ldoai8UAAAAALdQRiiUoJOm2iGa-_-R9CKu-rCO"></div>
								</div>
							</div-->
							<div class="col-md-12">
								<div class="form-group">

									<?php
									echo "<input type='hidden' name='to' value='".$this->to->format('d/m/Y')."'>
									<input type='hidden' name='from' value='".$this->from->format('d/m/Y')."'>
									<input type='hidden' name='idDestiny' value='".$idCiudad."'>
									<input type='hidden' name='idHotel' value='".$idHotel."'>
									<input type='hidden' name='idRoom' value='".$idRoom."'>
									<input type='hidden' name='idRoom2' value='".$room->Id."'>
									<input type='hidden' name='rooms' value='".$this->rooms."'>
									<input type='hidden' name='idCity' value='".$idCiudad."'>
									<input type='hidden' name='puntos' id='puntos' value='0' >
									<input type='hidden' name='lang' id='lang' value='".$GLOBALS['lang']."' >";

									for ($i=0; $i < $this->rooms ; $i++) { 
										echo "<input type='hidden' name='adults[".$i."]' value='".$this->adults[$i]."'>";
										echo "<input type='hidden' name='kids[".$i."]' value='".$this->kids[$i]."'>";
										for ($j=0; $j < 3; $j++) { 
											if(!empty($this->ageKids[$i][$j])){
												echo "<input type='hidden' name='ages[".$i."][".$j."]' value='".$this->ageKids[$i][$j]."'>";

											}
										}
									}
									?>
									<button class="btn btn-ok white"><?php echo $GLOBALS['Hoteles_Reserve_button_form']; ?></button>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="col-sm-3" id="reserveBox">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center;">
							<?php 
							$cashPoints = 0;
							if (isset($_SESSION['cliente'])) {
								$clubestrellaController = new clubestrellaController();
								$cashPoints = $clubestrellaController->PuntosPesos($_SESSION['cliente']->getPuntos());
								?>
								<img src="/img/logos/cash.svg" style="width: 150px;" alt="Cash and Points" id="cashhPoints">
								<p style="margin-top: 20px;color: #FC5D20;"><strong><?php echo $GLOBALS['Hoteles_Reserve_clubestrella']; ?> <?php echo number_format($_SESSION['cliente']->getPuntos()); ?> <?php echo $GLOBALS['Hoteles_Reserve_points_estrella']; ?></strong> </p>
								<p style="color: #FC5D20;"><strong>= $ <?php echo number_format($cashPoints, 2, '.', ''); ?></strong></p>
								<hr>
								<p style="color: #777;"><?php echo $GLOBALS['Hoteles_Reserve_pay_points']; ?></p>
								<form action="post" id="power-cash" name="power-cash">
									<input type="submit" class="button stiling-vip"  name ="saldado" value="pagar total con puntos" readonly>
								</form>
								<form action="POST" id="power-cash-n" name="power-cash-n">
									<input type="submit" class="button stiling-vip" name="porPartes" value="pagar solo una parte">
								</form>
								<div class="alert hide" role="alert" id="saldarPuntos"></div>
								<hr>
								<div id="box"></div> <!-- aqui va el contenido de javascript-->
								<div id="points-result" class="hide"></div>
								<?php
							}

							?>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">

							<div class="box">
								<h4 style="color: white;"><?php echo $GLOBALS['Hoteles_Reserve_data']; ?></h4>
								<hr>
								<div class="row law">	
									<div class="col-xs-4 col-sm-3 col-md-3">
										<img src="/img/iconos/hotel-w.svg" alt="Hotel">
									</div>
									<div class="col-xs-8 col-sm-9 col-md-9">
										<p class="textReserve"><?php echo $hoteles->Name; ?></p>
									</div>
								</div>
								<div class="row law">	
									<div class="col-xs-4 col-sm-3 col-md-3">
										<img src="/img/iconos/person.svg" alt="Huespedes">
									</div>
									<div class="col-xs-8 col-sm-9 col-md-9">
										<ul class="l-style-none" style="font-size: 14px;color: white;">
											<?php
											/**/
										/*$formatter = new NumberFormatter('es_MX', NumberFormatter::CURRENCY);
										$curr = 'MXN';
										$coins = $room->MealPlans[0]->AgencyPublic->AgencyPublic;
										$priceTotal = $formatter->formatCurrency($coins,$curr);*/
										$coins = $room->MealPlans[0]->AgencyPublic->AgencyPublic;
										$tarifaNormal = $room->MealPlans[0]->Total;

										if (isset($_SESSION['cliente'])) {
											
											$precioClub = $clubestrellaController->showEstrella($tarifaNormal,$coins);

											if($precioClub == 0){
												$priceTotal = money_format('%.2n', $coins);
											}
											else{
												$priceTotal = money_format('%.2n', $precioClub);
											}
											
										}
										else
											$priceTotal = money_format('%.2n', $coins);
										

										for ($i=0; $i < $this->rooms ; $i++) { 

											$adultsString = "<li>".$this->adults[$i].(($this->adults[$i] > 1) ? $GLOBALS['Hoteles_lbl_adults']."</li>" : $GLOBALS['Hoteles_lbl_adults']."</li>");
											$kidsString = ($this->kids[$i] > 0 ) ? "<li>".$this->kids[$i].(($this->kids[$i] > 1) ? $GLOBALS['Hoteles_lbl_kids']."</li>" : $GLOBALS['Hoteles_lbl_kid']."</li>") : "";

											echo "<li>
											".$GLOBALS['_searcher_label_room']." ".($i + 1).": <br>
											<ul style='padding-left: 25px;'>
											".$adultsString."
											".$kidsString." 
											</ul></li>";
										}
										
										?>
									</ul>
								</div>
							</div>
							<div class="row law">	
								<div class="col-xs-4 col-sm-3 col-md-3">
									<img src="/img/iconos/bed.svg" alt="Habitación">
								</div>
								<div class="col-xs-8 col-sm-9 col-md-9">
									<p class="textReserve"><?php echo $roomSelected->Name; ?></p>
								</div>
							</div>
							<div class="row law">	
								<div class="col-xs-4 col-sm-3 col-md-3">
									<img src="/img/iconos/calendario-s.svg" alt="Llegada">
								</div>
								<div class="col-xs-8 col-sm-9 col-md-9">
									<p class="textReserve"><?php echo $this->from->format("d/m/Y"); ?></p>
								</div>
							</div>
							<div class="row law">
								<div class="col-xs-4 col-sm-3 col-md-3">
									<img src="/img/iconos/calendario-e.svg" alt="Salida">
								</div>
								<div class="col-xs-8 col-sm-9 col-md-9">
									<p class="textReserve"><?php echo $this->to->format("d/m/Y"); ?></p>
								</div>
							</div>
							<div class="row law">
								<div class="col-xs-4 col-sm-3 col-md-3">
									<img src="/img/iconos/person.svg" alt="Total">
								</div>
								<div class="col-xs-8 col-sm-9 col-md-9">
									<p id="tarifaTotal" class="textReserve"><?php echo $priceTotal; ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>			
			</div>
		</div>
	</div>
	<!-- Modal Soy miembro Clubestrella -->
	<div class="modal fade" id="soyMiembro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="SoyMiembro"><?php echo $GLOBALS['Hoteles_Reserve_login']; ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="oldMember" method="POST" action="">
					<div class="modal-body">
						<div class="form-group">
							<label for="correo"><?php echo $GLOBALS['Hoteles_Reserve_email_form']; ?></label>
							<input type="email" class="form-control" id="correo" name="correo" aria-describedby="emailHelp" placeholder="Enter email" required>
							<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
						</div>
						<div class="form-group">
							<label for="security"><?php echo $GLOBALS['Hoteles_Reserve_login_password']; ?></label>
							<input type="password" class="form-control" id="security" name="security" placeholder="Password" required>
						</div>
						<div class="form-group alert alert-danger hide" role="alert" id="boxDanger" style="text-align: center;">
							<p id="messageD" style="margin-bottom: 0px;"></p>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" id="ingresarUser"><?php echo $GLOBALS['Hoteles_Reserve_login_button']; ?></button>
						<div id="loading2" class="hide">
							<img src="/img/gif/loading.gif" alt="loading..."  style="width: 60px; float: right;">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Modal Clubestrella registro -->
	<div class="modal fade" id="newMember" tabindex="-1" role="dialog" aria-labelledby="NewMember" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="NewMember"><?php echo $GLOBALS['Hoteles_Reserve_signup']; ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="newUser" method="POST" action="">
					<div class="modal-body" id="registroBody">
						<div class="form-row" id="whenyouGone">	
							<div class="form-group col-xs-12 col-sm-6 col-md-6">
								<label class="form-control-label" for="username"><?php echo $GLOBALS['Hoteles_Reserve_username']; ?></label>
								<input type="text" class="form-control" id="username" placeholder="Username" name="username">
							</div>
							<div class="form-group col-xs-12 col-sm-6 col-md-6">
								<label class="form-control-label" for="nombreR"><?php echo $GLOBALS['Hoteles_Reserve_name_form']; ?>:</label>
								<input type="text" class="form-control" id="nombreR" placeholder="Nombre" name="nombreR">
							</div>
							<div class="form-group col-xs-12 col-sm-6 col-md-6">
								<label class="form-control-label" for="apellidoP"><?php echo $GLOBALS['Hoteles_Reserve_lastname_form']; ?>:</label>
								<input type="text" class="form-control" id="apellidoP" placeholder="Apellido Paterno" name="apellidoP">
							</div>
							<div class="form-group col-xs-12 col-sm-6 col-md-6">
								<label class="form-control-label" for="apellidoM"><?php echo $GLOBALS['Hoteles_Reserve_lastname']; ?>:</label>
								<input type="text" class="form-control" id="apellidoM" placeholder="Apellido Materno" name="apellidoM">
							</div>
							<div class="form-group col-xs-12 col-sm-6 col-md-6">
								<label for="emailR"><?php echo $GLOBALS['Hoteles_Reserve_email_form']; ?></label>
								<input type="email" class="form-control" id="emailR" name="emailR" aria-describedby="emailHelp" placeholder="Enter email" required>
								<!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
							</div>
							<div class="form-group col-xs-12 col-sm-6 col-md-6">
								<label class="form-control-label" for="empresa"><?php echo $GLOBALS['Hoteles_Reserve_company']; ?>:</label>
								<input type="text" class="form-control" id="empresa" placeholder="Empresa" name="empresa">
							</div>
							<div class="form-group col-xs-12 col-sm-6 col-md-6">
								<label for="password2"><?php echo $GLOBALS['Hoteles_Reserve_login_password']; ?></label>
								<input type="password" class="form-control" id="password2" name="password2" placeholder="Password" required>
								<button type="button" id="eye">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</button>
							</div>
							<div class="form-group col-xs-12 col-sm-6 col-md-6">
								<label for="contraseña"><?php echo $GLOBALS['Hoteles_Reserve_confirm_password']; ?></label>
								<input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="Password" required>
								<button type="button" id="eye2">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</button>
							</div>
							<div class="form-group col-xs-12 col-sm-6 col-md-6">
								<label class="form-control-label" for="telefonoR"><?php echo $GLOBALS['Hoteles_Reserve_phone']; ?>:</label>
								<input type="text" class="form-control" id="telefonoR" placeholder="Telefono" name="telefonoR">
							</div>
							<div class="form-group col-xs-12 col-sm-6 col-md-6">
								<label class="form-control-label" for="paisR"><?php echo $GLOBALS['Hoteles_Reserve_country_form']; ?>:</label>
								<input type="text" class="form-control" id="paisR" placeholder="Pais" name="paisR">
							</div>
							<div class="form-group col-xs-12 col-sm-6 col-md-6">
								<label class="form-control-label" for="ciudadR"><?php echo $GLOBALS['Hoteles_Reserve_city_form'] ?>:</label>
								<input type="text" class="form-control" id="ciudadR" placeholder="Ciudad" name="ciudadR">
							</div>
							<div class="form-group col-xs-12 col-sm-6 col-md-6">
								<label class="form-control-label" for="estadoR"><?php echo $GLOBALS['Hoteles_Reserve_state_form'] ?>:</label>
								<input type="text" class="form-control" id="estadoR" placeholder="Estado" name="estadoR">
							</div>
							<div class="form-group col-xs-12 col-sm-6 col-md-6">
								<label class="form-control-label" for="codigoPostal"><?php echo $GLOBALS['Hoteles_Reserve_cp_form'] ?>:</label>
								<input type="text" class="form-control" id="codigoPostal" placeholder="Codigo Postal" name="codigoPostal">
							</div>
							<div class="form-group col-xs-12 col-sm-6 col-md-6">
								<label class="form-control-label" for="direccionR"><?php echo $GLOBALS['Hoteles_Reserve_address_form'] ?>:</label>
								<input type="text" class="form-control" id="direccionR" placeholder="Dirección" name="direccionR">
							</div>
							<div class="form-group alert  hide col-xs-12 col-md-12 col-sm-12" role="alert" id="boxDanger2" style="text-align: center;">
								<p id="messageD2" style="margin-bottom: 0px;"></p>
							</div>

						</div>
						<div class="clearfix"></div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" id="ingresarNew"><?php echo $GLOBALS['Hoteles_Reserve_login_button']; ?></button>
						<div id="loading3" class="hide">
							<img src="/img/gif/loading.gif" alt="loading..."  style="width: 60px; float: right;">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Modal Clubestrella recuperar Password  -->
	<div class="modal fade" id="Passrecover" tabindex="-1" role="dialog" aria-labelledby="MemberPass" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="MemberPass"><?php echo $GLOBALS['Hoteles_Reserve_password_estrella']; ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="recoverPass" method="POST" action="">
					<div class="modal-body">
						<div class="form-group">
							<label for="correoPass"><?php echo $GLOBALS['Hoteles_Reserve_email_form']; ?></label>
							<input type="email" class="form-control" id="correoPass" name="correoPass" aria-describedby="emailHelp" placeholder="Enter email" required>
							<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
						</div>

						<div class="form-group alert hide" role="alert" id="boxDanger3" style="text-align: center;">
							<p id="messageD3" style="margin-bottom: 0px;"></p>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" id="ingresar"><?php echo $GLOBALS['Hoteles_Reserve_login_button']; ?></button>
						<div id="loading" class="hide">
							<img src="/img/gif/loading.gif" alt="loading..."  style="width: 60px; float: right;">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>


	<?php include("views/partialViews/_loader-page.html"); ?>
	<?php include("views/partialViews/_footer.php"); ?>
	<?php include("views/partialViews/_landingScripts.html"); ?>
	<script type="text/javascript" src="/js/chosen/chosen.jquery.min.js"></script>
	<script src="https://www.google.com/recaptcha/api.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			$(".chosen-select").chosen();

			$("#formReserve").validate({
				rules: {
					conf_email: {
						required: true,
						equalTo: "#email"
					},
					nombre:{ required: true, minlength: 3 },
					ape_pat:{ required: true },
					ape_mat:{ required: true },
					email:{ required: true },
					direccion:{ required: true },
					ciudad:{ required: true },
					estado:{ required: true },
					pais:{ required: true },
					telefono:{ required: true },
					codigo_postal:{ required: true },
					accept_terms:{ required: true }

				},
				messages: {
					nombre: {
						required: "Nombre es requerido.",
					},
					ape_pat: {
						required: "Apellido paterno es requerido.",
					},
					ape_mat: {
						required: "Apellido materno es requerido.",
					},
					email: {
						required: "Correo electrónico es requerido.",
						email: "Favor de introducir una dirección de correo válido."
					},
					conf_email: {
						required: "Confirmar correo electrónico es requerido.",
						equalTo: "El correo debe ser igual al que escribiste.",
						email: "Favor de introducir una dirección de correo válido."
					},
					telefono: {
						required: "Teléfono es requerido.",
					},
					pais: {
						required: "País es requerido.",
					},
					ciudad: {
						required: "Ciudad es requerida.",
					},
					estado: {
						required: "Estado es requerido",
					},
					direccion: {
						required: "Dirección es requerido",
					},
					codigo_postal: {
						required: "Código postal es requerido.",
					},
					accept_terms: {
						required: "Debes aceptar los términos y condiciones de la empresa",
					},
				},
				submitHandler: function(form) {


					$(".wall-ok").css("display","block");
					form.submit();
					/*form.submit();
					/*var idForm = "#" + form.id;
					$.ajax({
						url: form.action,
						type: form.method,
						data: $(form).serialize(),
						beforeSend: function(){
							$(".alert").addClass("hide");
							$("#btn_register").addClass("hide");
							$("#btn_loading").removeClass("hide");
						},
						success: function (jsonObject) {
							console.log(jsonObject);
							var object = JSON.parse(jsonObject);
							$(".alert-"+object.type).html(object.message);
							$(".alert-"+object.type).removeClass("hide");
							$(idForm+" input").val("");
							$("#btn_register").removeClass("hide");
							$("#btn_loading").addClass("hide");
						},
						failed: function(result) {
							console.log("failed");
						}
					});
					return false;*/
				}
			});

			/* Restricciones modal OldMember Clubestrella */
			$("#oldMember").validate({

				rules: {
					correo: { required:true, email: true},
					security: { required:true, minlength: 3},   
				},
				messages: {
					correo : "Debe introducir un email válido.",
					security: "Introducir password.",
				},
				submitHandler: function(form){
					var dataString = 'correo='+$('#correo').val()+'&security='+$('#security').val();
					$.ajax({
						type: "POST",
						url:"/controllers/loginController.php",
						data: dataString,
						beforeSend: function(){
							$("#ingresarUser").addClass("hide");
							$("#loading2").removeClass("hide");
						},
						success: function(data){

							if (data==1) {

								window.location.reload();
							}
							else if (data==2) {

								$("#ingresarUser").removeClass("hide");
								$("#loading2").addClass("hide");
								$('#boxDanger').removeClass("hide");
								$('#messageD').append("Email/Password incorrectos");
							}

						}
					});
				}
			});

			/* Restricciones modal recoverPass Clubestrella */
			$("#recoverPass").validate({

				rules: {
					correoPass: { required:true, email: true},   
				},
				messages: {
					correoPass : "Debe introducir un email válido.",
				},
				submitHandler: function(form){

					$.ajax({
						type: "POST",
						url:"/controllers/recoverPassController.php",
						data: $(form).serialize(),
						beforeSend: function(){
							$("#ingresar").addClass("hide");
							$("#loading").removeClass("hide");
						},
						success: function(data){
							console.log(data);
							if (data==1) {

								$("#ingresar").removeClass("hide");
								$("#loading").addClass("hide");
								$('#boxDanger3').removeClass("alert-danger");
								$('#messageD3').html("");
								$('#boxDanger3').addClass("alert-success");
								$('#boxDanger3').removeClass("hide");
								$('#messageD3').append("Se ha enviado un email a tu correo!!");
							}
							else{

								$("#ingresar").removeClass("hide");
								$("#loading").addClass("hide");
								$('#boxDanger3').removeClass("alert-success");
								$('#messageD3').html("");
								$('#boxDanger3').addClass("alert-danger");
								$('#boxDanger3').removeClass("hide");
								$('#messageD3').append("Email no se encuentra registrado en Clubestrella");
							}

						}
					});
				}
			});


			/* Restricciones para newMember Clubestrella */
			$("#newUser").validate({

				rules: {
					emailR: { required:true, email: true},
					password2: { required:true, minlength: 3},   
					contraseña: { required:true, minlength: 3, equalTo: "#password2"},   
					nombreR: { required:true, minlength: 3},   
					apellidoP: { required:true, minlength: 3},   
					apellidoM: { required:true, minlength: 3},   
					username: { required:true, minlength: 3},   
					empresa: { required:true, minlength: 3},   
					telefonoR: { required:true, minlength: 3},   
					paisR: { required:true},   
					ciudadR: { required:true, minlength: 3},   
					estadoR: { required:true, minlength: 3},   
					codigoPostal: { required:true, minlength: 3},   
					direccionR: { required:true, minlength: 3},   
				},
				messages: {
					emailR : "Debe introducir un email válido.",
					password2: "Introducir password.",
					contraseña: "Passwords no coinciden.",
					nombreR: "Introducir tu nombre.",
					apellidoP: "Introducir tu apellido paterno.",
					apellidoM: "Introducir tu apellido materno.",
					username: "Introducir tu username.",
					empresa: "Introducir tu empresa.",
					telefonoR: "Introducir tu número de contacto.",
					paisR: "Introducir tu país.",
					ciudadR: "Introducir tu ciudad.",
					estadoR: "Introducir tu estado.",
					codigoPostal: "Introducir tu Código Postal.",
					direccionR: "Introducir tu dirección.",
				},
				submitHandler: function(form){

					$.ajax({
						type: "POST",
						url:"/controllers/registroController.php",
						data: $(form).serialize(),
						beforeSend: function(){
							$("#ingresarNew").addClass("hide");
							$("#loading3").removeClass("hide");
						},
						success: function(data){

							var object = JSON.parse(data);
							if (object.type == "error") {

								$("#ingresarNew").removeClass("hide");
								$("#loading3").addClass("hide");

								$('#boxDanger2').removeClass("hide");
								$('#boxDanger2').removeClass("alert-success");
								$('#boxDanger2').removeClass("alert-danger");
								$('#boxDanger2').addClass("alert-danger");
								$('#messageD2').html("");
								$('#messageD2').append(object.message);
							}
							else if(object.type == "success"){

								$("#ingresarNew").removeClass("hide");
								$("#loading3").addClass("hide");

								$('#boxDanger2').removeClass("hide");
								$('#boxDanger2').removeClass("alert-danger");
								$('#boxDanger2').removeClass("alert-success");
								$('#boxDanger2').addClass("alert-success");
								$('#messageD2').html("");
								$('#messageD2').append(object.message);
							}

						}
					});
				}
			});

			//Revelar Contraseñas
			function show() {
				var p = document.getElementById('password2');
				p.setAttribute('type', 'text');
			}

			function hide() {
				var p = document.getElementById('password2');
				p.setAttribute('type', 'password');
			}

			var pwShown = 0;

			document.getElementById("eye").addEventListener("click", function () {
				if (pwShown == 0) {
					pwShown = 1;
					show();
				} else {
					pwShown = 0;
					hide();
				}
			}, false);

			function show2() {
				var p = document.getElementById('contraseña');
				p.setAttribute('type', 'text');
			}

			function hide2() {
				var p = document.getElementById('contraseña');
				p.setAttribute('type', 'password');
			}

			var pwShown2 = 0;

			document.getElementById("eye2").addEventListener("click", function () {
				if (pwShown2 == 0) {
					pwShown2 = 1;
					show2();
				} else {
					pwShown2 = 0;
					hide2();
				}
			}, false);

			/* Saldar reserva con puntos */
			var tarifa = <?php 

			if($coins != 0)
			{ 

				echo $coins; 
			}else
			{ 
				echo 0; 
			} 		
			?>;
			var idioma = <?php 
			if ($GLOBALS['lang'] == "es") {

				echo 0;
			}
			else
				echo 1;
			?>;
			var clubestrella = <?php echo $cashPoints; ?>;
			/*var template ="<div class='col-xs-12 col-sm-12 col-md-12' id='cash2'><form action='post' id='cash' name='cash'><div class='col-xs-12 col-sm-12 col-md-12'><div class='row'><div class='col-xs-12 col-sm-12 col-md-12'><p id='howmuch'> ¿Cuantos puntos deseas utilizar?</p></div></div></div><div class='col-xs-12 col-sm-12 col-md-12 firma'><label for='cashpoints' class='hide'> Puntos: </label><input type='text' name='cashpoints' id='cashpoints' class='cash-points' placeholder='Introduce una cantidad'></div><div class='col-xs-12 col-sm-12 col-md-12'><div class='row firma'><div class='col-xs-12 col-sm-12 col-md-12'><input type='submit' class='button' id='calcular' value='Calcular puntos a pesos'></div></div></div></form><div class='col-xs-12 col-sm-12 col-md-12'><div class='row firma'><div class='col-xs-12 col-sm-12 col-md-12' ><form action='POST' id='points' name='points'><label for='convertpoints' class='labels-text col-xs-12 col-sm-12 col-md-12'>$ MX</label><input type='text' name='convertpoints' id='convertpoints' class='convertpoints' placeholder='Resultado en pesos' readonly><div id='btns-acciones'><div class='row' style='margin-bottom: 20px;'><div class='col-xs-6 col-md-6 col-sm-6'><input type='submit' class='button rice-hoteles' value='Usar Puntos'></div><div class='col-xs-6 col-md-6 col-sm-6'><input type='submit' class='button rice-hoteles' value='Cancelar'></div></div></div></form></div></div></div><div class='alert hide col-xs-12 col-sm-12 col-md-12' role='alert' id='calcularPuntos'></div></div>";*/
			var template= "	<div class='row'><form action='post' id='cash' name='cash'><div class='col-xs-12 col-sm-12 col-md-12'><p id='howmuch'> ¿Cuantos puntos deseas utilizar?</p></div><div class='col-xs-12 col-sm-12 col-md-12 firma'><label for='cashpoints' class='hide'> Puntos: </label><input type='text' name='cashpoints' id='cashpoints' class='cash-points' placeholder='Introduce una cantidad'></div><div class='col-xs-12 col-sm-12 col-md-12 firma'><input type='submit' class='button' id='calcular' value='Calcular puntos a pesos'></div></form><div class='col-xs-12 col-sm-12 col-md-12 firma'><form action='POST' id='points' name='points'><label for='convertpoints' class='labels-text col-xs-12 col-sm-12 col-md-12'>$ MX</label><input type='text' name='convertpoints' id='convertpoints' class='convertpoints' placeholder='Resultado en pesos' readonly><div id='btns-acciones'><div class='row' style='margin-bottom: 20px;'><div class='col-xs-12 col-md-6 col-sm-12'><input type='submit' class='button rice-hoteles' value='Usar Puntos'></div><div class='col-xs-12 col-md-6 col-sm-12'><input type='submit' class='button rice-hoteles' value='Cancelar'></div></div></div></form></div><div class='alert hide col-xs-12 col-sm-12 col-md-12' role='alert' id='calcularPuntos'></div></div>"
			var template2 = "<div class='row firma'><p>Precio total MXN:</p></div><div class='row firma'><div class='col-xs-6 col-sm-6 col-md-6 margen-text-r size-box-r'><p class='text-resta' style='margin-top: 4px;'>Precio Oktrip:</p></div><div class='col-xs-5 col-md-5 col-sm-5 col-sm-offset-1 col-md-offset-1 size-box-r' id='text-q'><span class='redpricebig' id='original-price'>$<strike style='padding-left: 5px;' id='clubestrellaFinal'></strike></span></div></div><div class='row firma' id='desc-row'><div class='col-xs-6 col-sm-6 col-md-6 margen-text-r size-box-r' style='padding-right: 0px;'><p class='text-resta' id='dec-p'>Descuento de puntos</p></div><div class='col-xs-1 col-md-1 col-sm-1 size-box-r'><p id='signo_resta'>__</p></div><div class='col-xs-5 col-md-5 col-sm-5 size-box-r' id='price-index'><span class='redpricebig' id='resta_line'></span><hr id='restDiv'></div></div><div class='row'><div class='col-xs-6 col-sm-6 col-md-6 margen-text-r size-box-r' id='signo'><p class='text-resta'>Precio Club estrella</p></div><div class='col-xs-5 col-md-5 col-sm-5 col-sm-offset-1 col-md-offset-1 size-box-r'><span class='redpricebig' id='redpricebig'></span></div></div>";

			$("#power-cash").validate({

				submitHandler: function(form){
					var dataString = 'tarifa='+tarifa+'&clubestrella='+clubestrella+'&idioma='+idioma;
					$.ajax({
						type: "POST",
						url:"/controllers/clubestrellaController.php",
						data: dataString,
						success: function(data){
							if (data == 0) {

								$("#saldarPuntos").removeClass("hide");
								$("#saldarPuntos").addClass("alert-danger");
								$("#saldarPuntos").html("No cuentas con los puntos suficientes para realizar esta acción.");
							}

							else{

								$("#points-result").html("");
								$("#points-result").append(template2);
								$("#points-result").removeClass("hide");
								document.getElementById('clubestrellaFinal').innerHTML = tarifa.toFixed(2);
								document.getElementById('resta_line').innerHTML = '$ '+tarifa.toFixed(2);
								document.getElementById('redpricebig').innerHTML = '$ 0.00';
								document.getElementById('tarifaTotal').innerHTML = '$ 0.00';
								document.getElementById("saldoPoints").checked = true;
								$('#puntos').val(data);
								$("#metodoPagos").addClass("hide");
							}

						}
					});
				}
			});

			$("#power-cash-n").validate({
				rules: {
					tarifa2: { required: true, minlength: 2},

				},
				messages: {
					tarifa2: " error",

				},
				submitHandler: function(form){
					var dataString = 'tarifa='+tarifa;
					$.ajax({
						type: "POST",
						url:"/controllers/clubestrellaController.php",
						data: dataString,
						success: function(data){

							$("#box").html("");
							$("#saldarPuntos").addClass("hide");
							$("#box").append(template);
							$("#points-result").append(template2);

							$("#cash").validate({
								rules: {
									cashpoints: { required: true, number: true},

								},
								messages: {
									cashpoints: " Caracter no valido",

								},
								submitHandler: function(form){
									var dataString = 'cashpoints='+$('#cashpoints').val()+'&clubestrella='+clubestrella+'&idioma='+idioma;
									$.ajax({
										type: "POST",
										url:"/controllers/clubestrellaController.php",
										data: dataString,
										success: function(data){

											console.log(data);
											if (data == 0) {

												$("#calcularPuntos").removeClass("hide");
												$("#calcularPuntos").addClass("alert-danger");
												$("#calcularPuntos").html("No cuentas con los puntos suficientes para realizar esta acción.");
											}
											else{
												$("#calcularPuntos").addClass("hide");
												$("#convertpoints").val(data);
												$('#puntos').val($('#cashpoints').val());
											}

										}
									});
								}
							});

							$("#points").validate({
								rules: {
									convertpoints: { required: true, number: true},

								},
								messages: {
									convertpoints: "Llene el campo",
								},
								submitHandler: function(form){
									var calculado = $('#convertpoints').val();
									var dataString = 'convertpoints='+$('#convertpoints').val()+'&total='+tarifa;
									$.ajax({
										type: "POST",
										url:"/controllers/clubestrellaController.php",
										data: dataString,
										success: function(data){

											$("#points-result").removeClass("hide");
											document.getElementById('clubestrellaFinal').innerHTML = tarifa.toFixed(2);
											document.getElementById('resta_line').innerHTML = '$ '+calculado;
											document.getElementById('redpricebig').innerHTML = '$ '+parseFloat(data).toFixed(2);
											document.getElementById('tarifaTotal').innerHTML = '$ '+parseFloat(data).toFixed(2);

										}
									});
								}
							});
						}
					});
				}
			});

		}); // Fin Document Ready
	</script>
</body>
</html>

