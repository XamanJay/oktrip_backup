$(document).ready(function(){
	
	init();

	$('.carousel').carousel();
	
	$("#tabs li a").on("click",function(){
		$(this).tab("show");
	});

	$("#search li .btn-opt").on("click",function(){
		$(this).tab("show");
	});

	$("#home rooms option[value=1], #hoteles rooms option[value=1]").attr("selected",true);
	$("#home input[type='text'], #hoteles input[type='text']").val("");
	
	$("#from").on("dp.change", function (e) {
		$('#to').data("DateTimePicker").minDate(e.date.add(1, 'day'));
	});
	$("#to").on("dp.change", function (e) {
		$('#from').data("DateTimePicker").maxDate(e.date.subtract(1, 'day'));
	});

	$("#coupon").mask('SSSSSSEEEEEE00', {
		translation: {
			'E': {pattern: /[a-zA-Z]/, optional: true}
		},
		placeholder: "Ejemplo: oktrip15"
	});

	$(".slider").slider({
		animate: "fast",
		range: true,
		max: 15800,
		min: 301,
		values: [ 301, 15800 ],
		classes: {
			"ui-slider": "highlight"
		}

	});

	$('[data-toggle="tooltip"]').tooltip()

	var owl = $('#promos');
	owl.owlCarousel({
		items:1,
		loop:true,
		margin:10,
	});

	var owl_banner = $('#new_banner');
	owl_banner.owlCarousel({
	    items:1,
	    loop:true,
	    margin:10,
	    nav:false,
	    autoHeight:true,
	    autoplay:true,
	    autoplayTimeout:3000,
	    autoplayHoverPause:false
	});

	var owl_banner_mob = $('#new_banner_mob');
	owl_banner_mob.owlCarousel({
	    items:1,
	    loop:true,
	    margin:10,
	    nav:false,
	    autoHeight:true,
	    autoplay:true,
	    autoplayTimeout:3000,
	    autoplayHoverPause:false
	});

	var owl = $('#destinos');
	owl.owlCarousel({		
		loop:true,
		margin:10,
		autoplay:true,
		autoplayTimeout:5000,
		autoplayHoverPause:true,
		responsiveClass:true,
		responsive:{
			0:{
				items:1,
				nav:true
			},
			600:{
				items:3,
				nav:false
			},
			1000:{
				items:3,
				nav:false,
				loop:true
			}
		}
	});

	$("#reserveGet").submit(function(){
		$(".wall-ok").css("display","block");
	});

	$(".btn-reserve, .link-hotel").on("click",function(){
		$(".wall-ok").css("display","block");
	});


	$("#destiny").autocomplete({
		source: [ "" ],
		select: function( event, ui ) {
			$(this).val(ui.item.label);
			$("#idCity").val(ui.item.value);
			$("#idHotel").val(ui.item.idHotel);
			return false;
		},
		change: function( event, ui ) {
			if(ui.item == null){
				$("#idDestiny").val("");
			}
			return false;
		}
	})
	.data("ui-autocomplete")._renderMenu = function( ul, items ) {
		var that = this,
		currentCategory = "";
		$.each( items, function( index, item ) {
			var li;
			if ( item.category != currentCategory ) {

				ul.append( "<li class='ui-autocomplete-category' style='font-weight:bold;'>" + item.category + "</li>" );
				currentCategory = item.category;
			}
			li = that._renderItemData( ul, item );
			if ( item.category ) {

				var i = item.label.toLowerCase().indexOf(item.partial.toLowerCase());
				var j = i + item.partial.length;

				init = item.label.substr(0, i);
				var final = item.label.substr(j);

				var str = init + "<span class='cl-ok'>"+item.partial+"</span>"+ final;

				li.attr( "aria-label", item.category + " : " + item.label );
				li.html("<div>"+str+"</div>");
			}
		});
	};




});


function refillDestiny(element){

	var value = $(element).val();
	$.ajax({
		url: "/destiny",
		type: "POST",
		data: "value="+value,
		success: function (jsonObject) {
			if (jsonObject != "") {
				var object = JSON.parse(jsonObject);
				var destinies = [];

				for(var aux of object){
					var destiny = new Object();
					destiny.label = aux.Name + ", " + aux.Country;
					destiny.value = aux.IdCity;
					destiny.partial = value;
					destiny.idHotel = aux.IdHotel;
					destiny.category = aux.Category;
					destinies.push(destiny);
				}
				$("#destiny").autocomplete( "option", "source", destinies );
			}
		}
	});
}

function initLang(){

	var lang = readCookie("Lang");
	console.log(lang);
	$('#from').datetimepicker({
		format: 'DD/MM/YYYY',
		minDate: moment().add(1, 'day'),
		useCurrent: false,
		locale: moment.locale(lang)

	});

	$('#to').datetimepicker({
		format: 'DD/MM/YYYY',
		minDate: moment().add(2, 'day'),
		useCurrent: false,
		locale: moment.locale(lang)
	});


	$.getJSON("/js/lang/"+lang+".json", function(aux){

		$("#home #rooms, #hoteles #rooms").change(function(){
			var value = $(this).val();
			var template = "";
			switch(value){
				case '1':
				$('.con-rooms').html("");
				break;
				case '2':
				template = '<div class="row"><div class="col-md-12"><div class="title-room">'+aux.searcher.room+' 2</div><div class="form-group col-md-3 half-input-m"><label for="adults_1">'+aux.searcher.adults+'</label><input id="adults_1" name="adults[1]" class="form-control" type="number" min="1" value="1"><label for="adults_1" generated="true" class="error"></label></div><div class="form-group col-md-3 half-input-l"><label for="kids_1">'+aux.searcher.kids+'</label><input id="kids_1" name="kids[1]" class="form-control kids-i-1" type="number" min="0" value="0"><label for="kids_1" generated="true" class="error"></label></div><div class="con-ages-1"></div></div></div>';
				$('.con-rooms').html("");
				$('.con-rooms').append(template);
				initKids(aux);
				break;
				case '3':
				$('.con-rooms').html("");
				template = '<div class="row"><div class="col-md-12"><div class="title-room">'+aux.searcher.room+' 2</div><div class="form-group col-md-3 half-input-m"><label for="adults_1">'+aux.searcher.adults+'</label><input id="adults_1" name="adults[1]" class="form-control" type="number" min="1" value="1"><label for="adults_1" generated="true" class="error"></label></div><div class="form-group col-md-3 half-input-l"><label for="kids_1">'+aux.searcher.kids+'</label><input id="kids_1" name="kids[1]" class="form-control kids-i-1" type="number" min="0" value="0"><label for="kids_1" generated="true" class="error"></label></div><div class="con-ages-1"></div></div></div>';
				$('.con-rooms').append(template);
				template = '<div class="row"><div class="col-md-12"><div class="title-room">'+aux.searcher.room+' 3</div><div class="form-group col-md-3 half-input-m"><label for="adults_2">'+aux.searcher.adults+'</label><input id="adults_2" name="adults[2]" class="form-control" type="number" min="1" value="1"><label for="adults_2" generated="true" class="error"></label></div><div class="form-group col-md-3 half-input-l"><label for="kids_2">'+aux.searcher.kids+'</label><input id="kids_2" name="kids[2]" class="form-control kids-i-2" type="number" min="0" value="0"><label for="kids_2" generated="true" class="error"></label></div><div class="con-ages-2"></div></div></div>';
				$('.con-rooms').append(template);
				initKids(aux);
				break;
			}
		});

		$("#search #rooms, #details #rooms").change(function(){
			var value = $(this).val();
			var template = "";
			switch(value){
				case '1':
				$('.con-rooms').html("");
				break;
				case '2':
				template = '<div class="row"><div class="col-md-12" style="text-align: center;"><label for="">'+aux.searcher.room+' 2</label></div><div class="col-md-6" style="padding-right: 7.5px; text-align: center; "><div class="form-group"><label for="adults_1" style="font-weight: normal;">'+aux.searcher.adults+'</label><input id="adults_1" name="adults[1]" class="form-control" value="1" placeholder="" type="number" required><label for="adults_1" generated="true" class="error"></label></div></div><div class="col-md-6" style="padding-left: 7.5px;  text-align: center; "><div class="form-group"><label for="kids_1" style="font-weight: normal;">'+aux.searcher.kids+'</label><input id="kids_1" name="kids[1]" class="form-control kids-s-1" value="0" placeholder="" type="number" required><label for="kids_1" generated="true" class="error"></label></div></div></div><div class="row"><div class="con-ages-1"></div></div><div class="hr"></div>';
				$('.con-rooms').html("");
				$('.con-rooms').append(template);
				initKids(aux);
				break;
				case '3':
				$('.con-rooms').html("");
				template = '<div class="row"><div class="col-md-12" style="text-align: center;"><label for="">'+aux.searcher.room+' 2</label></div><div class="col-md-6" style="padding-right: 7.5px; text-align: center; "><div class="form-group"><label for="adults_1" style="font-weight: normal;">'+aux.searcher.adults+'</label><input id="adults_1" name="adults[1]" class="form-control" value="1" placeholder="" type="number" required><label for="adults_1" generated="true" class="error"></label></div></div><div class="col-md-6" style="padding-left: 7.5px;  text-align: center; "><div class="form-group"><label for="kids_1" style="font-weight: normal;">'+aux.searcher.kids+'</label><input id="kids_1" name="kids[1]" class="form-control kids-s-1" value="0" placeholder="" type="number" required><label for="kids_1" generated="true" class="error"></label></div></div></div><div class="row"><div class="con-ages-1"></div></div><div class="hr"></div>';
				$('.con-rooms').append(template);
				template = '<div class="row"><div class="col-md-12" style="text-align: center;"><label for="">'+aux.searcher.room+' 3</label></div><div class="col-md-6" style="padding-right: 7.5px; text-align: center; "><div class="form-group"><label for="adults_2" style="font-weight: normal;">'+aux.searcher.adults+'</label><input id="adults_2" name="adults[2]" class="form-control" value="1" placeholder="" type="number" required><label for="adults_2" generated="true" class="error"></label></div></div><div class="col-md-6" style="padding-left: 7.5px;  text-align: center; "><div class="form-group"><label for="kids_2" style="font-weight: normal;">'+aux.searcher.kids+'</label><input id="kids_2" name="kids[2]" class="form-control kids-s-2" value="0" placeholder="" type="number" required><label for="kids_2" generated="true" class="error"></label></div></div></div><div class="row"><div class="con-ages-2"></div></div><div class="hr"></div>';
				$('.con-rooms').append(template);
				initKids(aux);
				break;
			}
		});

		$(".kids-s-0").change(function(){
			var value = $(this).val();
			var template = "";
			switch(value){
				case '0':
				$('.con-ages-0').html("");
				break;
				case '1':
				template = '<div class="col-md-4 col-sm-12 form-group" style="padding-right: 7.5px; text-align: center;"><label for="ages_0_0" style="font-size: 9px;">'+aux.searcher.ageKid+' 1</label><input id="ages_0_0" name="ages[0][0]" type="number" class="form-control" min="1" value="0"><label for="ages_0_0" generated="true" class="error"></label></div>';
				$('.con-ages-0').html("");
				$('.con-ages-0').append(template);
				break;
				case '2':
				$('.con-ages-0').html("");
				template = '<div class="col-md-4 col-sm-12 form-group" style="padding-right: 7.5px; text-align: center;"><label for="ages_0_0" style="font-size: 9px;">'+aux.searcher.ageKid+' 1</label><input id="ages_0_0" name="ages[0][0]" type="number" class="form-control" min="1" value="0"><label for="ages_0_0" generated="true" class="error"></label></div>';
				$('.con-ages-0').append(template);

				template = '<div class="col-md-4 col-sm-12 form-group" style="padding-right: 7.5px; padding-left: 7.5px; text-align: center;"><label for="ages_0_1" style="font-size: 9px;">'+aux.searcher.ageKid+' 2</label><input id="ages_0_1" name="ages[0][1]" type="number" class="form-control" min="1" value="0"><label for="ages_0_1" generated="true" class="error"></label></div>';
				$('.con-ages-0').append(template);
				break;
				case '3':
				$('.con-ages-0').html("");
				template = '<div class="col-md-4 col-sm-12 form-group" style="padding-right: 7.5px; text-align: center;"><label for="ages_0_0" style="font-size: 9px;">'+aux.searcher.ageKid+' 1</label><input id="ages_0_0" name="ages[0][0]" type="number" class="form-control" min="1" value="0"><label for="ages_0_0" generated="true" class="error"></label></div>';
				$('.con-ages-0').append(template);
				template = '<div class="col-md-4 col-sm-12 form-group" style="padding-right: 7.5px; padding-left: 7.5px; text-align: center;"><label for="ages_0_1" style="font-size: 9px;">'+aux.searcher.ageKid+' 2</label><input id="ages_0_1" name="ages[0][1]" type="number" class="form-control" min="1" value="0"><label for="ages_0_1" generated="true" class="error"></label></div>';
				$('.con-ages-0').append(template);
				template = '<div class="col-md-4 col-sm-12 form-group" style="padding-left: 7.5px; text-align: center;"><label for="ages_0_2" style="font-size: 9px;">'+aux.searcher.ageKid+' 3</label><input id="ages_0_2" name="ages[0][2]" type="number" class="form-control" min="1" value="0"><label for="ages_0_2" generated="true" class="error"></label></div>';
				$('.con-ages-0').append(template);
				break;
				default:
				$('.con-ages-0').html("");
				break;
			}
		});

		$(".kids-i-0").change(function(){
			var value = $(this).val();
			var template = "";
			switch(value){
				case '0':
				$('.con-ages-0').html("");
				break;
				case '1':
				template = '<div class="form-group col-md-2 half-input-m"><label for="ages_0_0">'+aux.searcher.ageKid+' 1</label><input id="ages_0_0" name="ages[0][0]" class="form-control" type="number" min="0" value="0"></div>';
				$('.con-ages-0').html("");
				$('.con-ages-0').append(template);
				break;
				case '2':
				$('.con-ages-0').html("");
				template = '<div class="form-group col-md-2 half-input-m"><label for="ages_0_0">'+aux.searcher.ageKid+' 1</label><input id="ages_0_0" name="ages[0][0]" class="form-control" type="number" min="0" value="0"></div>';
				$('.con-ages-0').append(template);
				template = '<div class="form-group col-md-2 half-input-m"><label for="ages_0_1">'+aux.searcher.ageKid+' 2</label><input id="ages_0_1" name="ages[0][1]" class="form-control" type="number" min="0" value="0"></div>';
				$('.con-ages-0').append(template);
				break;
				case '3':
				$('.con-ages-0').html("");
				template = '<div class="form-group col-md-2 half-input-m"><label for="ages_0_0">'+aux.searcher.ageKid+' 1</label><input id="ages_0_0" name="ages[0][0]" class="form-control" type="number" min="0" value="0"></div>';
				$('.con-ages-0').append(template);
				template = '<div class="form-group col-md-2 half-input-m"><label for="ages_0_1">'+aux.searcher.ageKid+' 2</label><input id="ages_0_1" name="ages[0][1]" class="form-control" type="number" min="0" value="0"></div>';
				$('.con-ages-0').append(template);
				template = '<div class="form-group col-md-2 half-input-l"><label for="ages_0_2">'+aux.searcher.ageKid+' 3</label><input id="ages_0_2" name="ages[0][2]" class="form-control" type="number" min="0" value="0"></div>';
				$('.con-ages-0').append(template);
				break;
				default:
				$('.con-ages-0').html("");
				break;
			}
		});

		$(".kids-d-0").change(function(){
			var value = $(this).val();
			var template = "";
			switch(value){
				case '0':
				$('.con-ages-0_').html("");
				break;
				case '1':
				template = '<div class="col-xs-4 half-input-r"><div class="form-group"><label style="font-size: 10px;" for="ages_0_0">'+aux.searcher.age+' 1</label><input id="ages_0_0" name="ages[0][0]" type="number" class="form-control" min="1" value="0" required=""><label for="ages_0_0" generated="true" class="error"></label></div></div>';
				$('.con-ages-0_').html("");
				$('.con-ages-0_').append(template);
				break;
				case '2':
				$('.con-ages-0_').html("");
				template = '<div class="col-xs-4 half-input-r"><div class="form-group"><label style="font-size: 10px;" for="ages_0_0">'+aux.searcher.age+' 1</label><input id="ages_0_0" name="ages[0][0]" type="number" class="form-control" min="1" value="0" required=""><label for="ages_0_0" generated="true" class="error"></label></div></div>';
				$('.con-ages-0_').append(template);
				template = '<div class="col-xs-4 half-input-m"><div class="form-group"><label style="font-size: 10px;" for="ages_0_1">'+aux.searcher.age+' 2</label><input id="ages_0_1" name="ages[0][1]" type="number" class="form-control" min="1" value="0" required=""><label for="ages_0_1" generated="true" class="error"></label></div></div>';
				$('.con-ages-0_').append(template);
				break;
				case '3':
				$('.con-ages-0_').html("");
				template = '<div class="col-xs-4 half-input-r"><div class="form-group"><label style="font-size: 10px;" for="ages_0_0">'+aux.searcher.age+' 1</label><input id="ages_0_0" name="ages[0][0]" type="number" class="form-control" min="1" value="0" required=""><label for="ages_0_0" generated="true" class="error"></label></div></div>';
				$('.con-ages-0_').append(template);
				template = '<div class="col-xs-4 half-input-m"><div class="form-group"><label style="font-size: 10px;" for="ages_0_1">'+aux.searcher.age+' 2</label><input id="ages_0_1" name="ages[0][1]" type="number" class="form-control" min="1" value="0" required=""><label for="ages_0_1" generated="true" class="error"></label></div></div>';
				$('.con-ages-0_').append(template);
				template = '<div class="col-xs-4 half-input-l"><div class="form-group"><label style="font-size: 10px;" for="ages_0_2">'+aux.searcher.age+' 3</label><input id="ages_0_2" name="ages[0][2]" type="number" class="form-control" min="1" value="0" required=""><label for="ages_0_2" generated="true" class="error"></label></div></div>';
				$('.con-ages-0_').append(template);
				break;
				default:
				$('.con-ages-0_').html("");
				break;
			}
		});

		var MessagesValidation = aux.searcher.MessagesValidation;

		$("#formSearch").validate({
			rules: {
				from: {
					required: true
				},
				to: {
					required: true
				},
				rooms: {
					required: true
				},
				"adults[0]":{
					required: true,
					min: 1,
					max: 3
				},
				"adults[1]":{
					required: true,
					min: 1,
					max: 3
				},
				"adults[2]":{
					required: true,
					min: 1,
					max: 3
				},
				"kids[0]":{
					required: true,
					min: 0,
					max: 3
				},
				"kids[1]":{
					required: true,
					min: 0,
					max: 3
				},
				"kids[2]":{
					required: true,
					min: 0,
					max: 3
				},
				"ages[0][0]":{
					required: true,
					min: 1,
					max: 17
				},
				"ages[0][1]":{
					required: true,
					min: 1,
					max: 17
				},
				"ages[0][2]":{
					required: true,
					min: 1,
					max: 17
				},
				"ages[1][0]":{
					required: true,
					min: 1,
					max: 17
				},
				"ages[1][1]":{
					required: true,
					min: 1,
					max: 17
				},
				"ages[1][2]":{
					required: true,
					min: 1,
					max: 17
				},
				"ages[2][0]":{
					required: true,
					min: 1,
					max: 17
				},
				"ages[2][1]":{
					required: true,
					min: 1,
					max: 17
				},
				"ages[2][2]":{
					required: true,
					min: 1,
					max: 17
				}
			},
			messages: {
				from: {
					required: MessagesValidation.from,
				},
				to: {
					required: MessagesValidation.to,
				},
				rooms: MessagesValidation.rooms,
				"adults[0]":{
					required: MessagesValidation.adults[0],
					min: MessagesValidation.adults[1],
					max: MessagesValidation.adults[2]
				},
				"adults[1]":{
					required: MessagesValidation.adults[0],
					min: MessagesValidation.adults[1],
					max: MessagesValidation.adults[2]
				},
				"adults[2]":{
					required: MessagesValidation.adults[0],
					min: MessagesValidation.adults[1],
					max: MessagesValidation.adults[2]
				},
				"kids[0]":{
					required: MessagesValidation.kids[0],
					min: MessagesValidation.kids[1],
					max: MessagesValidation.kids[2]
				},
				"kids[1]":{
					required: MessagesValidation.kids[0],
					min: MessagesValidation.kids[1],
					max: MessagesValidation.kids[2]
				},
				"kids[2]":{
					required: MessagesValidation.kids[0],
					min: MessagesValidation.kids[1],
					max: MessagesValidation.kids[2]
				},
				"ages[0][0]":{
					required: MessagesValidation.ages[0],
					min: MessagesValidation.ages[1],
					max: MessagesValidation.ages[2]
				},
				"ages[0][1]":{
					required: MessagesValidation.ages[0],
					min: MessagesValidation.ages[1],
					max: MessagesValidation.ages[2]
				},
				"ages[0][2]":{
					required: MessagesValidation.ages[0],
					min: MessagesValidation.ages[1],
					max: MessagesValidation.ages[2]
				},
				"ages[1][0]":{
					required: MessagesValidation.ages[0],
					min: MessagesValidation.ages[1],
					max: MessagesValidation.ages[2]
				},
				"ages[1][1]":{
					required: MessagesValidation.ages[0],
					min: MessagesValidation.ages[1],
					max: MessagesValidation.ages[2]
				},
				"ages[1][2]":{
					required: MessagesValidation.ages[0],
					min: MessagesValidation.ages[1],
					max: MessagesValidation.ages[2]
				},
				"ages[2][0]":{
					required: MessagesValidation.ages[0],
					min: MessagesValidation.ages[1],
					max: MessagesValidation.ages[2]
				},
				"ages[2][1]":{
					required: MessagesValidation.ages[0],
					min: MessagesValidation.ages[1],
					max: MessagesValidation.ages[2]
				},
				"ages[2][2]":{
					required: MessagesValidation.ages[0],
					min: MessagesValidation.ages[1],
					max: MessagesValidation.ages[2]
				}
			},
			submitHandler: function(form) {

				$(".wall-ok").css("display","block");
				form.submit(function(){
					$(".wall-ok").css("display","none");
					return false;
				});
			}
		});

		$("#changeDates").validate({
			rules: {
				from: {
					required: true
				},
				to: {
					required: true
				},
				rooms: {
					required: true
				},
				"adults[0]":{
					required: true,
					min: 1,
					max: 3
				},
				"adults[1]":{
					required: true,
					min: 1,
					max: 3
				},
				"adults[2]":{
					required: true,
					min: 1,
					max: 3
				},
				"kids[0]":{
					required: true,
					min: 0,
					max: 3
				},
				"kids[1]":{
					required: true,
					min: 0,
					max: 3
				},
				"kids[2]":{
					required: true,
					min: 0,
					max: 3
				},
				"ages[0][0]":{
					required: true,
					min: 1,
					max: 17
				},
				"ages[0][1]":{
					required: true,
					min: 1,
					max: 17
				},
				"ages[0][2]":{
					required: true,
					min: 1,
					max: 17
				},
				"ages[1][0]":{
					required: true,
					min: 1,
					max: 17
				},
				"ages[1][1]":{
					required: true,
					min: 1,
					max: 17
				},
				"ages[1][2]":{
					required: true,
					min: 1,
					max: 17
				},
				"ages[2][0]":{
					required: true,
					min: 1,
					max: 17
				},
				"ages[2][1]":{
					required: true,
					min: 1,
					max: 17
				},
				"ages[2][2]":{
					required: true,
					min: 1,
					max: 17
				}
			},
			messages: {
				from: {
					required: MessagesValidation.from,
				},
				to: {
					required: MessagesValidation.to,
				},
				rooms: MessagesValidation.rooms,
				"adults[0]":{
					required: MessagesValidation.adults[0],
					min: MessagesValidation.adults[1],
					max: MessagesValidation.adults[2]
				},
				"adults[1]":{
					required: MessagesValidation.adults[0],
					min: MessagesValidation.adults[1],
					max: MessagesValidation.adults[2]
				},
				"adults[2]":{
					required: MessagesValidation.adults[0],
					min: MessagesValidation.adults[1],
					max: MessagesValidation.adults[2]
				},
				"kids[0]":{
					required: MessagesValidation.kids[0],
					min: MessagesValidation.kids[1],
					max: MessagesValidation.kids[2]	
				},
				"kids[1]":{
					required: MessagesValidation.kids[0],
					min: MessagesValidation.kids[1],
					max: MessagesValidation.kids[2]
				},
				"kids[2]":{
					required: MessagesValidation.kids[0],
					min: MessagesValidation.kids[1],
					max: MessagesValidation.kids[2]
				},
				"ages[0][0]":{
					required: MessagesValidation.ages[0],
					min: MessagesValidation.ages[1],
					max: MessagesValidation.ages[2]
				},
				"ages[0][1]":{
					required: MessagesValidation.ages[0],
					min: MessagesValidation.ages[1],
					max: MessagesValidation.ages[2]
				},
				"ages[0][2]":{
					required: MessagesValidation.ages[0],
					min: MessagesValidation.ages[1],
					max: MessagesValidation.ages[2]
				},
				"ages[1][0]":{
					required: MessagesValidation.ages[0],
					min: MessagesValidation.ages[1],
					max: MessagesValidation.ages[2]
				},
				"ages[1][1]":{
					required: MessagesValidation.ages[0],
					min: MessagesValidation.ages[1],
					max: MessagesValidation.ages[2]
				},
				"ages[1][2]":{
					required: MessagesValidation.ages[0],
					min: MessagesValidation.ages[1],
					max: MessagesValidation.ages[2]
				},
				"ages[2][0]":{
					required: MessagesValidation.ages[0],
					min: MessagesValidation.ages[1],
					max: MessagesValidation.ages[2]
				},
				"ages[2][1]":{
					required: MessagesValidation.ages[0],
					min: MessagesValidation.ages[1],
					max: MessagesValidation.ages[2]
				},
				"ages[2][2]":{
					required: MessagesValidation.ages[0],
					min: MessagesValidation.ages[1],
					max: MessagesValidation.ages[2]
				}
			},
			submitHandler: function(form) {
				$(".wall-ok").css("display","block");
				form.submit(function(){
					$(".wall-ok").css("display","none");
					return false;
				});
			}
		});

		MessagesValidation = aux.contact.MessagesValidation;

		$("#formContact").validate({

			rules: {
				nombre: { 
					required:true, 
				},   
				ciudad: { 
					required:true,
				},   
				pais: { 
					required:true
				},   
				email: { 
					required:true, 
					email: true
				},
				telefono: { 
					required:true, 
				},      
				mensaje: { 
					required:true, 
				}
			},
			messages: {
				nombre: {
					required: MessagesValidation.name[0],
				},
				ciudad: {
					required:  MessagesValidation.city[0],
				},
				pais: {
					required:  MessagesValidation.country[0],
				},
				email : {
					required:  MessagesValidation.email[0],
					email:  MessagesValidation.email[1],
				},
				telefono: {
					required: MessagesValidation.phone[0],
				},
				mensaje: {
					required: MessagesValidation.message[0],
				}
			},
			submitHandler: function(form){

				$.ajax({
					type: "POST",
					url:"/controllers/contato_send.php",
					data: $(form).serialize(),
					beforeSend: function(){
						$("#send").addClass("hidden");
						$("#loading").removeClass("hidden");
					},
					success: function(data){

						var object = JSON.parse(data);
						if (object.type == "error") {

							$("#send").removeClass("hidden");
							$("#loading").addClass("hidden");

							$('#boxMessage').removeClass("hidden");
							$('#boxMessage').removeClass("bg-danger");
							$('#boxMessage').removeClass("bg-success");
							$('#boxMessage').addClass("bg-danger");
							$('#messageD2').html("");
							$('#messageD2').append(object.message);
						}
						else if(object.type == "success"){

							$("#send").removeClass("hidden");
							$("#loading").addClass("hidden");

							$('#boxMessage').removeClass("hidden");
							$('#boxMessage').removeClass("bg-danger");
							$('#boxMessage').removeClass("bg-success");
							$('#boxMessage').addClass("bg-success");
							$('#messageD2').html("");
							$('#messageD2').append(object.message);
						}

					}
				});
			}
		});
	});

}

function initKids(aux){
	$(".kids-i-1").change(function(){
		var value = $(this).val();
		var template = "";
		switch(value){
			case '0':
			$('.con-ages-1').html("");
			break;
			case '1':
			template = '<div class="form-group col-md-2 half-input-m"><label for="ages_1_0">'+aux.searcher.ageKid+' 1</label><input id="ages_1_0" name="ages[1][0]" class="form-control" type="number" min="0" value="0"></div>';
			$('.con-ages-1').html("");
			$('.con-ages-1').append(template);
			break;
			case '2':
			$('.con-ages-1').html("");
			template = '<div class="form-group col-md-2 half-input-m"><label for="ages_1_0">'+aux.searcher.ageKid+' 1</label><input id="ages_1_0" name="ages[1][0]" class="form-control" type="number" min="0" value="0"></div>';
			$('.con-ages-1').append(template);
			template = '<div class="form-group col-md-2 half-input-m"><label for="ages_1_1">'+aux.searcher.ageKid+' 2</label><input id="ages_1_1" name="ages[1][1]" class="form-control" type="number" min="0" value="0"></div>';
			$('.con-ages-1').append(template);
			break;
			case '3':
			$('.con-ages-1').html("");
			template = '<div class="form-group col-md-2 half-input-m"><label for="ages_1_0">'+aux.searcher.ageKid+' 1</label><input id="ages_1_0" name="ages[1][0]" class="form-control" type="number" min="0" value="0"></div>';
			$('.con-ages-1').append(template);
			template = '<div class="form-group col-md-2 half-input-m"><label for="ages_1_1">'+aux.searcher.ageKid+' 2</label><input id="ages_1_1" name="ages[1][1]" class="form-control" type="number" min="0" value="0"></div>';
			$('.con-ages-1').append(template);
			template = '<div class="form-group col-md-2 half-input-l"><label for="ages_1_2">'+aux.searcher.ageKid+' 3</label><input id="ages_1_2" name="ages[1][2]" class="form-control" type="number" min="0" value="0"></div>';
			$('.con-ages-1').append(template);
			break;
			default:
			$('.con-ages-1').html("");
			break;
		}
	});

	$(".kids-i-2").change(function(){
		var value = $(this).val();
		var template = "";
		switch(value){
			case '0':
			$('.con-ages-2').html("");
			break;
			case '1':
			template = '<div class="form-group col-md-2 half-input-m"><label for="ages_2_0">'+aux.searcher.ageKid+' 1</label><input id="ages_2_0" name="ages[2][0]" class="form-control" type="number" min="0" value="0"></div>';
			$('.con-ages-2').html("");
			$('.con-ages-2').append(template);
			break;
			case '2':
			$('.con-ages-2').html("");
			template = '<div class="form-group col-md-2 half-input-m"><label for="ages_2_0">'+aux.searcher.ageKid+' 1</label><input id="ages_2_0" name="ages[2][0]" class="form-control" type="number" min="0" value="0"></div>';
			$('.con-ages-2').append(template);
			template = '<div class="form-group col-md-2 half-input-m"><label for="ages_2_1">'+aux.searcher.ageKid+' 2</label><input id="ages_2_1" name="ages[2][1]" class="form-control" type="number" min="0" value="0"></div>';
			$('.con-ages-2').append(template);
			break;
			case '3':
			$('.con-ages-2').html("");
			template = '<div class="form-group col-md-2 half-input-m"><label for="ages_2_0">'+aux.searcher.ageKid+' 1</label><input id="ages_2_0" name="ages[2][0]" class="form-control" type="number" min="0" value="0"></div>';
			$('.con-ages-2').append(template);
			template = '<div class="form-group col-md-2 half-input-m"><label for="ages_2_1">'+aux.searcher.ageKid+' 2</label><input id="ages_2_1" name="ages[2][1]" class="form-control" type="number" min="0" value="0"></div>';
			$('.con-ages-2').append(template);
			template = '<div class="form-group col-md-2 half-input-l"><label for="ages_2_2">'+aux.searcher.ageKid+' 3</label><input id="ages_2_2" name="ages[2][2]" class="form-control" type="number" min="0" value="0"></div>';
			$('.con-ages-2').append(template);
			break;
			default:
			$('.con-ages-2').html("");
			break;
		}
	});

	$(".kids-d-1").change(function(){
		var value = $(this).val();
		var template = "";
		switch(value){
			case '0':
			$('.con-ages-1_').html("");
			break;
			case '1':
			template = '<div class="col-xs-4 half-input-r"><div class="form-group"><label style="font-size: 10px;" for="ages_1_0">'+aux.searcher.age+' 1</label><input id="ages_1_0" name="ages[1][0]" type="number" class="form-control" min="1" value="0" required=""><label for="ages_1_0" generated="true" class="error"></label></div></div>';
			$('.con-ages-1_').html("");
			$('.con-ages-1_').append(template);
			break;
			case '2':
			$('.con-ages-1_').html("");
			template = '<div class="col-xs-4 half-input-r"><div class="form-group"><label style="font-size: 10px;" for="ages_1_0">'+aux.searcher.age+' 1</label><input id="ages_1_0" name="ages[1][0]" type="number" class="form-control" min="1" value="0" required=""><label for="ages_1_0" generated="true" class="error"></label></div></div>';
			$('.con-ages-1_').append(template);
			template = '<div class="col-xs-4 half-input-m"><div class="form-group"><label style="font-size: 10px;" for="ages_1_1">'+aux.searcher.age+' 2</label><input id="ages_1_1" name="ages[1][1]" type="number" class="form-control" min="1" value="0" required=""><label for="ages_1_1" generated="true" class="error"></label></div></div>';
			$('.con-ages-1_').append(template);
			break;
			case '3':
			$('.con-ages-1_').html("");
			template = '<div class="col-xs-4 half-input-r"><div class="form-group"><label style="font-size: 10px;" for="ages_1_0">'+aux.searcher.age+' 1</label><input id="ages_1_0" name="ages[1][0]" type="number" class="form-control" min="1" value="0" required=""><label for="ages_1_0" generated="true" class="error"></label></div></div>';
			$('.con-ages-1_').append(template);
			template = '<div class="col-xs-4 half-input-m"><div class="form-group"><label style="font-size: 10px;" for="ages_1_1">'+aux.searcher.age+' 2</label><input id="ages_1_1" name="ages[1][1]" type="number" class="form-control" min="1" value="0" required=""><label for="ages_1_1" generated="true" class="error"></label></div></div>';
			$('.con-ages-1_').append(template);
			template = '<div class="col-xs-4 half-input-l"><div class="form-group"><label style="font-size: 10px;" for="ages_1_2">'+aux.searcher.age+' 3</label><input id="ages_1_2" name="ages[1][2]" type="number" class="form-control" min="1" value="0" required=""><label for="ages_1_2" generated="true" class="error"></label></div></div>';
			$('.con-ages-1_').append(template);
			break;
			default:
			$('.con-ages-1_').html("");
			break;
		}
	});

	$(".kids-d-2").change(function(){
		var value = $(this).val();
		var template = "";
		switch(value){
			case '0':
			$('.con-ages-2_').html("");
			break;
			case '1':
			template = '<div class="col-xs-4 half-input-r"><div class="form-group"><label style="font-size: 10px;" for="ages_2_0">'+aux.searcher.age+' 1</label><input id="ages_2_0" name="ages[2][0]" type="number" class="form-control" min="1" value="0" required=""></div><label for="ages_2_0" generated="true" class="error"></label></div>';
			$('.con-ages-2_').html("");
			$('.con-ages-2_').append(template);
			break;
			case '2':
			$('.con-ages-2_').html("");
			template = '<div class="col-xs-4 half-input-r"><div class="form-group"><label style="font-size: 10px;" for="ages_2_0">'+aux.searcher.age+' 1</label><input id="ages_2_0" name="ages[2][0]" type="number" class="form-control" min="1" value="0" required=""></div><label for="ages_2_0" generated="true" class="error"></label></div>';
			$('.con-ages-2_').append(template);
			template = '<div class="col-xs-4 half-input-m"><div class="form-group"><label style="font-size: 10px;" for="ages_2_1">'+aux.searcher.age+' 2</label><input id="ages_2_1" name="ages[2][1]" type="number" class="form-control" min="1" value="0" required=""></div><label for="ages_2_1" generated="true" class="error"></label></div>';
			$('.con-ages-2_').append(template);
			break;
			case '3':
			$('.con-ages-2_').html("");
			template = '<div class="col-xs-4 half-input-r"><div class="form-group"><label style="font-size: 10px;" for="ages_2_0">'+aux.searcher.age+' 1</label><input id="ages_2_0" name="ages[2][0]" type="number" class="form-control" min="1" value="0" required=""></div><label for="ages_2_0" generated="true" class="error"></label></div>';
			$('.con-ages-2_').append(template);
			template = '<div class="col-xs-4 half-input-m"><div class="form-group"><label style="font-size: 10px;" for="ages_2_1">'+aux.searcher.age+' 2</label><input id="ages_2_1" name="ages[2][1]" type="number" class="form-control" min="1" value="0" required=""></div><label for="ages_2_1" generated="true" class="error"></label></div>';
			$('.con-ages-2_').append(template);
			template = '<div class="col-xs-4 half-input-l"><div class="form-group"><label style="font-size: 10px;" for="ages_2_2">'+aux.searcher.age+' 3</label><input id="ages_2_2" name="ages[2][2]" type="number" class="form-control" min="1" value="0" required=""></div><label for="ages_2_2" generated="true" class="error"></label></div>';
			$('.con-ages-2_').append(template);
			break;
			default:
			$('.con-ages-2_').html("");
			break;
		}
	});

	/*$(".kids-s-0").change(function(){
		var value = $(this).val();
		var template = "";
		switch(value){
			case '0':
			$('.con-ages-0').html("");
			break;
			case '1':
			template = '<div class="col-md-4 col-sm-12 form-group" style="padding-right: 7.5px; text-align: center;"><label for="ages_0_0" style="font-size: 9px;">'+aux.searcher.ageKid+' 1</label><input id="ages_0_0" name="ages[0][0]" type="number" class="form-control" min="1" value="0"><label for="ages_0_0" generated="true" class="error"></label></div>';
			$('.con-ages-0').html("");
			$('.con-ages-0').append(template);
			break;
			case '2':
			$('.con-ages-0').html("");
			template = '<div class="col-md-4 col-sm-12 form-group" style="padding-right: 7.5px; text-align: center;"><label for="ages_0_0" style="font-size: 9px;">'+aux.searcher.ageKid+' 1</label><input id="ages_0_0" name="ages[0][0]" type="number" class="form-control" min="1" value="0"><label for="ages_0_0" generated="true" class="error"></label></div>';
			$('.con-ages-0').append(template);

			template = '<div class="col-md-4 col-sm-12 form-group" style="padding-right: 7.5px; padding-left: 7.5px; text-align: center;"><label for="ages_0_1" style="font-size: 9px;">'+aux.searcher.ageKid+' 2</label><input id="ages_0_1" name="ages[0][1]" type="number" class="form-control" min="1" value="0"><label for="ages_0_1" generated="true" class="error"></label></div>';
			$('.con-ages-0').append(template);
			break;
			case '3':
			$('.con-ages-0').html("");
			template = '<div class="col-md-4 col-sm-12 form-group" style="padding-right: 7.5px; text-align: center;"><label for="ages_0_0" style="font-size: 9px;">'+aux.searcher.ageKid+' 1</label><input id="ages_0_0" name="ages[0][0]" type="number" class="form-control" min="1" value="0"><label for="ages_0_0" generated="true" class="error"></label></div>';
			$('.con-ages-0').append(template);
			template = '<div class="col-md-4 col-sm-12 form-group" style="padding-right: 7.5px; padding-left: 7.5px; text-align: center;"><label for="ages_0_1" style="font-size: 9px;">'+aux.searcher.ageKid+' 2</label><input id="ages_0_1" name="ages[0][1]" type="number" class="form-control" min="1" value="0"><label for="ages_0_1" generated="true" class="error"></label></div>';
			$('.con-ages-0').append(template);
			template = '<div class="col-md-4 col-sm-12 form-group" style="padding-left: 7.5px; text-align: center;"><label for="ages_0_2" style="font-size: 9px;">'+aux.searcher.ageKid+' 3</label><input id="ages_0_2" name="ages[0][2]" type="number" class="form-control" min="1" value="0"><label for="ages_0_2" generated="true" class="error"></label></div>';
			$('.con-ages-0').append(template);
			break;
			default:
			$('.con-ages-0').html("");
			break;
		}
	});*/

	$(".kids-s-1").change(function(){
		var value = $(this).val();
		var template = "";
		switch(value){
			case '0':
			$('.con-ages-1').html("");
			break;
			case '1':
			template = '<div class="col-md-4 col-sm-12 form-group" style="padding-right: 7.5px; text-align: center;"><label for="ages_1_0" style="font-size: 9px;">'+aux.searcher.ageKid+' 1</label><input id="ages_1_0" name="ages[1][0]" type="number" class="form-control" min="1" value="0"><label for="ages_1_0" generated="true" class="error"></label></div>';
			$('.con-ages-1').html("");
			$('.con-ages-1').append(template);
			break;
			case '2':
			$('.con-ages-1').html("");
			template = '<div class="col-md-4 col-sm-12 form-group" style="padding-right: 7.5px; text-align: center;"><label for="ages_1_0" style="font-size: 9px;">'+aux.searcher.ageKid+' 1</label><input id="ages_1_0" name="ages[1][0]" type="number" class="form-control" min="1" value="0"><label for="ages_1_0" generated="true" class="error"></label></div>';
			$('.con-ages-1').append(template);

			template = '<div class="col-md-4 col-sm-12 form-group" style="padding-right: 7.5px; padding-left: 7.5px; text-align: center;"><label for="ages_1_1" style="font-size: 9px;">'+aux.searcher.ageKid+' 2</label><input id="ages_1_1" name="ages[1][1]" type="number" class="form-control" min="1" value="0"><label for="ages_1_1" generated="true" class="error"></label></div>';
			$('.con-ages-1').append(template);
			break;
			case '3':
			$('.con-ages-1').html("");
			template = '<div class="col-md-4 col-sm-12 form-group" style="padding-right: 7.5px; text-align: center;"><label for="ages_1_0" style="font-size: 9px;">'+aux.searcher.ageKid+' 1</label><input id="ages_1_0" name="ages[1][0]" type="number" class="form-control" min="1" value="0"><label for="ages_1_0" generated="true" class="error"></label></div>';
			$('.con-ages-1').append(template);
			template = '<div class="col-md-4 col-sm-12 form-group" style="padding-right: 7.5px; padding-left: 7.5px; text-align: center;"><label for="ages_1_1" style="font-size: 9px;">'+aux.searcher.ageKid+' 2</label><input id="ages_1_1" name="ages[1][1]" type="number" class="form-control" min="1" value="0"><label for="ages_1_1" generated="true" class="error"></label></div>';
			$('.con-ages-1').append(template);
			template = '<div class="col-md-4 col-sm-12 form-group" style="padding-left: 7.5px; text-align: center;"><label for="ages_1_2" style="font-size: 9px;">'+aux.searcher.ageKid+' 3</label><input id="ages_1_2" name="ages[1][2]" type="number" class="form-control" min="1" value="0"><label for="ages_1_2" generated="true" class="error"></label></div>';
			$('.con-ages-1').append(template);
			break;
			default:
			$('.con-ages-1').html("");
			break;
		}
	});

	$(".kids-s-2").change(function(){
		var value = $(this).val();
		var template = "";
		switch(value){
			case '0':
			$('.con-ages-2').html("");
			break;
			case '1':
			template = '<div class="col-md-4 col-sm-12 form-group" style="padding-right: 7.5px; text-align: center;"><label for="ages_2_0" style="font-size: 9px;">'+aux.searcher.ageKid+' 1</label><input id="ages_2_0" name="ages[2][0]" type="number" class="form-control" min="1" value="0"><label for="ages_2_0" generated="true" class="error"></label></div>';
			$('.con-ages-2').html("");
			$('.con-ages-2').append(template);
			break;
			case '2':
			$('.con-ages-2').html("");
			template = '<div class="col-md-4 col-sm-12 form-group" style="padding-right: 7.5px; text-align: center;"><label for="ages_2_0" style="font-size: 9px;">'+aux.searcher.ageKid+' 1</label><input id="ages_2_0" name="ages[2][0]" type="number" class="form-control" min="1" value="0"><label for="ages_2_0" generated="true" class="error"></label></div>';
			$('.con-ages-2').append(template);

			template = '<div class="col-md-4 col-sm-12 form-group" style="padding-right: 7.5px; padding-left: 7.5px; text-align: center;"><label for="ages_2_1" style="font-size: 9px;">'+aux.searcher.ageKid+' 2</label><input id="ages_2_1" name="ages[2][1]" type="number" class="form-control" min="1" value="0"><label for="ages_2_1" generated="true" class="error"></label></div>';
			$('.con-ages-2').append(template);
			break;
			case '3':
			$('.con-ages-2').html("");
			template = '<div class="col-md-4 col-sm-12 form-group" style="padding-right: 7.5px; text-align: center;"><label for="ages_2_0" style="font-size: 9px;">'+aux.searcher.ageKid+' 1</label><input id="ages_2_0" name="ages[2][0]" type="number" class="form-control" min="1" value="0"><label for="ages_2_0" generated="true" class="error"></label></div>';
			$('.con-ages-2').append(template);
			template = '<div class="col-md-4 col-sm-12 form-group" style="padding-right: 7.5px; padding-left: 7.5px; text-align: center;"><label for="ages_2_1" style="font-size: 9px;">'+aux.searcher.ageKid+' 2</label><input id="ages_2_1" name="ages[2][1]" type="number" class="form-control" min="1" value="0"><label for="ages_2_1" generated="true" class="error"></label></div>';
			$('.con-ages-2').append(template);
			template = '<div class="col-md-4 col-sm-12 form-group" style="padding-left: 7.5px; text-align: center;"><label for="ages_2_2" style="font-size: 9px;">'+aux.searcher.ageKid+' 3</label><input id="ages_2_2" name="ages[2][2]" type="number" class="form-control" min="1" value="0"><label for="ages_2_2" generated="true" class="error"></label></div>';
			$('.con-ages-2').append(template);
			break;
			default:
			$('.con-ages-2').html("");
			break;
		}
	});
}

function init(){

	var path = window.location.pathname.substr(1);
	var pos = path.search('/');
	var pathfilter = path.substr(0,pos);

	if(pathfilter === '') name = path;
	else name = pathfilter;

	/*Activar las opciones del menú conforme al path */
	if(path === '' || path === 'index' || pos === -1)
	{
		$("#navbar .navbar-nav li[data-name='home']").tab("show");
		$("#header .menu-desktop-ok li[data-name='home'] a").css("color", "#FC5D20");

	}
	else
	{
		$("#navbar .navbar-nav li[data-name='"+name+"']").tab("show");
		$("#header .menu-desktop-ok li[data-name='"+name+"'] a").css("color", "#FC5D20");
	}
	initLang();
}

function readCookie(name) {
	return decodeURIComponent(document.cookie.replace(new RegExp("(?:(?:^|.*;)\\s*" + name.replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=\\s*([^;]*).*$)|^.*$"), "$1")) || null;
}

function load_modal(){
	$('#myModal').modal('show');
}