/**
 * Resize function without multiple trigger
 * 
 * Usage:
 * $(window).smartresize(function(){  
 *     // code here
 * });
 */
 (function($,sr){
    // debouncing function from John Hann
    // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
    var debounce = function (func, threshold, execAsap) {
    	var timeout;

    	return function debounced () {
    		var obj = this, args = arguments;
    		function delayed () {
    			if (!execAsap)
    				func.apply(obj, args); 
    			timeout = null; 
    		}

    		if (timeout)
    			clearTimeout(timeout);
    		else if (execAsap)
    			func.apply(obj, args);

    		timeout = setTimeout(delayed, threshold || 100); 
    	};
    };

    // smartresize 
    jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };

})(jQuery,'smartresize');
/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 var CURRENT_URL = window.location.href.split('#')[0].split('?')[0],
 $BODY = $('body'),
 $MENU_TOGGLE = $('#menu_toggle'),
 $SIDEBAR_MENU = $('#sidebar-menu'),
 $SIDEBAR_FOOTER = $('.sidebar-footer'),
 $LEFT_COL = $('.left_col'),
 $RIGHT_COL = $('.right_col'),
 $NAV_MENU = $('.nav_menu'),
 $FOOTER = $('footer');

// Sidebar
function init_sidebar() {
	var setContentHeight = function () {
		$RIGHT_COL.css('min-height', $(window).height());

		var bodyHeight = $BODY.outerHeight(),
		footerHeight = $BODY.hasClass('footer_fixed') ? -10 : $FOOTER.height(),
		leftColHeight = $LEFT_COL.eq(1).height() + $SIDEBAR_FOOTER.height(),
		contentHeight = bodyHeight < leftColHeight ? leftColHeight : bodyHeight;

		contentHeight -= $NAV_MENU.height() + footerHeight;

		$RIGHT_COL.css('min-height', contentHeight);
	};

	$SIDEBAR_MENU.find('a').on('click', function(ev) {
		console.log('clicked - sidebar_menu');
		var $li = $(this).parent();

		if ($li.is('.active')) {
			$li.removeClass('active active-sm');
			$('ul:first', $li).slideUp(function() {
				setContentHeight();
			});
		} else {
			if (!$li.parent().is('.child_menu')) {
				$SIDEBAR_MENU.find('li').removeClass('active active-sm');
				$SIDEBAR_MENU.find('li ul').slideUp();
			}else
			{
				if ( $BODY.is( ".nav-sm" ) )
				{
					$SIDEBAR_MENU.find( "li" ).removeClass( "active active-sm" );
					$SIDEBAR_MENU.find( "li ul" ).slideUp();
				}
			}
			$li.addClass('active');

			$('ul:first', $li).slideDown(function() {
				setContentHeight();
			});
		}
	});

	$MENU_TOGGLE.on('click', function() {
		console.log('clicked - menu toggle');

		if ($BODY.hasClass('nav-md')) {
			$SIDEBAR_MENU.find('li.active ul').hide();
			$SIDEBAR_MENU.find('li.active').addClass('active-sm').removeClass('active');
		} else {
			$SIDEBAR_MENU.find('li.active-sm ul').show();
			$SIDEBAR_MENU.find('li.active-sm').addClass('active').removeClass('active-sm');
		}

		$BODY.toggleClass('nav-md nav-sm');

		setContentHeight();

		$('.dataTable').each ( function () { $(this).dataTable().fnDraw(); });
	});


	$SIDEBAR_MENU.find('a[href="' + CURRENT_URL + '"]').parent('li').addClass('current-page');

	$SIDEBAR_MENU.find('a').filter(function () {
		return this.href == CURRENT_URL;
	}).parent('li').addClass('current-page').parents('ul').slideDown(function() {
		setContentHeight();
	}).parent().addClass('active');

	$(window).smartresize(function(){  
		setContentHeight();
	});

	setContentHeight();

	if ($.fn.mCustomScrollbar) {
		$('.menu_fixed').mCustomScrollbar({
			autoHideScrollbar: true,
			theme: 'minimal',
			mouseWheel:{ preventDefault: true }
		});
	}
};


// NProgress
if (typeof NProgress != "undefined") {
	$(document).ready(function () {
		NProgress.start();
	});

	$(window).ready(function () {
		NProgress.done();
	});
}


var originalLeave = $.fn.popover.Constructor.prototype.leave;
$.fn.popover.Constructor.prototype.leave = function(obj) {
	var self = obj instanceof this.constructor ?
	obj : $(obj.currentTarget)[this.type](this.getDelegateOptions()).data('bs.' + this.type);
	var container, timeout;

	originalLeave.call(this, obj);

	if (obj.currentTarget) {
		container = $(obj.currentTarget).siblings('.popover');
		timeout = self.timeout;
		container.one('mouseenter', function() {
			clearTimeout(timeout);
			container.one('mouseleave', function() {
				$.fn.popover.Constructor.prototype.leave.call(self, self);
			});
		});
	}
};

$('body').popover({
	selector: '[data-popover]',
	trigger: 'click hover',
	delay: {
		show: 50,
		hide: 400
	}
});

var languageEditor = {
	"create": {
		"button": "Nuevo",
		"title":  "<h4>Crear nuevo registro</h4>",
		"submit": "Crear"
	},

	"edit": {
		"button": "Editar",
		"title":  "<h4>Editar registro</h4>",
		"submit": "Actualizar"
	},

	"remove": {
		"button": "Eliminar",
		"title":  "<h4>Eliminar</h4>",
		"submit": "Eliminar",
		"confirm": {
			"_": "¿Está seguro que desea eliminar %d registros?",
			"1": "¿Está seguro que desea eliminar 1 registro?"
		}
	},

	"error": {
		"system": "Un error de sistema ha ocurrido (Más información)"
	},

	"datetime": {
		"previous": 'Anterior',
		"next":     'Siguiente',
		"months":   [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ],
		"weekdays": [ 'Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab' ],
		"amPm":     [ 'am', 'pm' ],
		"unknown":  '-'
	}
};

var dom = "<'row'<'col-sm-12'l>>"+
"<'row'<'col-sm-6'B><'col-sm-6'f>>" +
"<'row'<'col-sm-12'tr>>" +
"<'row'<'col-sm-5'i><'col-sm-7'p>>";


$(document).ready(function() {


	init_sidebar();
	init_dtKeys();

	var editorCities = new $.fn.dataTable.Editor( {
		ajax: "/lib/editor/cities.php",
		i18n: languageEditor,
		table: "#cities",
		fields:
		[{
			label: "Id ciudad:",
			name: "IdCity"
		}, 
		{
			label: "Nombre:",
			name: "Name"
		}, 
		{
			label: "Id país",
			name: "IdCountry"
		}, 
		{
			label: "Nombre del país:",
			name: "Country"
		}, 
		{
			label: "Ruta",
			name: "Path"
		}, 
		{
			label: "Longitud",
			name: "Longitude"
		}, 
		{
			label: "Latitud",
			name: "Latitude"
		}]
	});

	var dataTableCities = $('#cities').dataTable({
		language: {
			url: "/js/dataTables/spanish.lang"
		},
		ajax: "/lib/editor/cities.php",
		responsive: { details: true },
		dom: dom,
		columns: [{ data: "IdCity" },
		{ data: "Name" },
		{ data: "IdCountry" },
		{ data: "Country" },
		{ data: "Path" },
		{ data: "Longitude" },
		{ data: "Latitude" }],
		buttons: [ 'copy', 'excel', 'pdf',
		{ extend: "create", editor: editorCities },
		{ extend: "edit",   editor: editorCities },
		/*{ 
			extend: "remove",   
			editor: editorCities,
			formMessage: function ( e, dt ) {
				var rows = dt.rows( e.modifier() ).data().pluck('Name');
				return '¿Estás seguro que deseas eliminar este registro? '+
				'<ul><li>'+rows.join('</li><li>')+'</li></ul>';
			}
		}*/
		{
			extend: "selectedSingle",
			text: "Eliminar",
			action: function ( e, dt, node, config ) {
				var item = dt.row( { selected: true } ).data();
				console.log(item);
				swal({
					title: "¿Estás seguro de eliminar un registro?",
					text: "Se eliminará el registro con clave: " + item.Id,
					type: "warning",
					confirmButtonColor: "#FC5D20",
					confirmButtonText: "Ok!",
					closeOnConfirm: false
				}).then(function () {
					$.ajax({
						url: "/ciudades/eliminar/"+item.Id,
						type: "POST",
						beforeSend: function(){},
						success: function (jsonObject) {
							console.log(jsonObject);
							if (jsonObject != "") {
								var object = JSON.parse(jsonObject);
								console.log(object);
								swal({
									title: object.title,
									text: object.message,
									type: object.type,
									confirmButtonText: "Ok!"
								}).then(function(){
									window.location.reload(true);
								})

							}
						}
					});
				});
			}
		}
		],
		select: { style: 'single'},
	});

	var editorHotelsCity = new $.fn.dataTable.Editor( {
		ajax: "/lib/editor/hotelsCity.php",
		i18n: languageEditor,
		table: "#hotelsCity",
		fields:
		[{
			label: "Id Hotel:",
			name: "hotels_city.IdHotel"
		}, 
		{
			label: "Nombre:",
			name: "hotels_city.Name"
		}, 
		{
			label: "Nombre de la zona",
			name: "hotels_city.ZoneName"
		}, 
		{
			label: "Categoria",
			name: "hotels_city.Category",
			type: "select",
			options: [
			{ label: "Estrellas: 2", value: "S2" },
			{ label: "Estrellas: 2.5", value: "S25" },
			{ label: "Estrellas: 3", value: "S3" },
			{ label: "Estrellas: 3.5", value: "S35" },
			{ label: "Estrellas: 4", value: "S4" },
			{ label: "Estrellas: 4.5", value: "S45" },
			{ label: "Estrellas: 5", value: "S5" },
			{ label: "Estrellas: 5.5", value: "S55" },
			{ label: "Estrellas: 6", value: "S6" }
			] 
		}, 
		{
			label: "Dirección",
			name: "hotels_city.Address"
		}, 
		{
			label: "Ciudad",
			name: "hotels_city.City_id",
			type: "select"
		}]
	});

	var dataTableHotelsCity = $('#hotelsCity').dataTable({
		language: {
			url: "/js/dataTables/spanish.lang"
		},
		ajax: "/lib/editor/hotelsCity.php",
		responsive: { details: true },
		dom: dom,
		columns: [
		{ data: "hotels_city.IdHotel" },
		{ data: "hotels_city.Name" },
		{ data: "hotels_city.ZoneName" },
		{ data: "hotels_city.Category" },
		{ data: "hotels_city.Address" },
		{ data: "cities.Name" },
		{ data: "cities.Country" },
		{ data: "cities.IdCity" }
		],
		buttons: [ 'copy', 'excel', 'pdf',
		{ extend: "create", editor: editorHotelsCity },
		{ extend: "edit",   editor: editorHotelsCity },
		/*{ 
			extend: "remove",   
			editor: editorHotelsCity,
			formMessage: function ( e, dt ) {
				var rows = dt.rows( e.modifier() ).data().pluck('Name');
				return '¿Estás seguro que deseas eliminar este registro? '+
				'<ul><li>'+rows.join('</li><li>')+'</li></ul>';
			}
		}*/
		{
			extend: "selectedSingle",
			text: "Eliminar",
			action: function ( e, dt, node, config ) {
				var item = dt.row( { selected: true } ).data();
				console.log(item);
				swal({
					title: "¿Estás seguro de eliminar un registro?",
					text: "Se eliminará el registro con clave: " + item.hotels_city.Id,
					type: "warning",
					confirmButtonColor: "#FC5D20",
					confirmButtonText: "Ok!",
					closeOnConfirm: false
				}).then(function () {
					$.ajax({
						url: "/hoteles-destinos/eliminar/"+item.hotels_city.Id,
						type: "POST",
						beforeSend: function(){},
						success: function (jsonObject) {
							console.log(jsonObject);
							if (jsonObject != "") {
								var object = JSON.parse(jsonObject);
								console.log(object);
								swal({
									title: object.title,
									text: object.message,
									type: object.type,
									confirmButtonText: "Ok!"
								}).then(function(){
									window.location.reload(true);
								})

							}
						}
					});
				});
			}
		}
		],
		select: { style: 'single'},
	});

	var editorSales = new $.fn.dataTable.Editor( {
		ajax: "/lib/editor/sales.php",
		i18n: languageEditor,
		table: "#sales",
		fields:
		[{
			label: "Clave",
			name: "sales.Key_"
		},
		{
			label: "Fecha",
			name: "sales.Date"
		}]
	});

	var dataTableSales = $('#sales').dataTable({
		language: {
			url: "/js/dataTables/spanish.lang"
		},
		ajax: "/lib/editor/sales.php",
		responsive: { details: true },
		dom: dom,
		order: [[ 2, "desc" ]],
		columns: [

		{ data: "payments.Status", render: function ( data, type, row ) {

			switch (data) {
				case "1":
				return "No efectiva";
				break;
				case "2":
				return "<label style='color:orange'>Pendiente</label>";
				break;
				case "3":
				return "<label style='color:green'>Autorizada</label>";
				break;
				case "4":
				return "<label style='color:red'>Declinada</label>";
				break;
				case "5":
				return "<label style='color:red'>Cancelada</label>";
				break;
				case "6":
				return "Aprobada sin capturar";
				break;
				case "8":
				return "<label style='color:orange'>En proceso<label>";
				break;
				default:
				return "Sin Estado";
				break;
			}
		}
	},
	{ data: "sales.Id" }, 
	{ data: "sales.Date" },
	{ 
		data: "customers",
		render: function ( val, type, row ) {
			return val.Name ?
			val.Name +' '+ val.LastName : '';
		},
		defaultContent: ""
	},
	{ data: "customers.Email" },
	{ data: "customers.Country" },
	{ data: "customers.City" },

	{ data: "services.Name" },
	{ data: "services.TypeService" },
	{ data: "services.DateFrom" },
	{ data: "services.DateTo" },
	{ data: "payments.Total",
		render: $.fn.dataTable.render.number( ',', '.', 2, '$' )
	},
	{ data: "payments.Subtotal",
		  render: $.fn.dataTable.render.number( ',', '.', 2, '$' )
	}],

	buttons: [ 'copy', 'excel', 'pdf',
		/*{ extend: "create", editor: editorSales },
		{ extend: "edit",   editor: editorSales },*/
		{ 
			text: "Crear",
			action: function ( e, dt, node, config ) {
				var item = dt.row( { selected: true } ).data();
				location.href = "/ventas/crear";
			}
		},            
		{
			extend: "selectedSingle",
			text: "Editar",
			action: function ( e, dt, node, config ) {
				var item = dt.row( { selected: true } ).data();
				location.href = "/ventas/editar/"+item.sales.Id;
			}
		},          
		{
			extend: "selectedSingle",
			text: "Detalles",
			action: function ( e, dt, node, config ) {
				var item = dt.row( { selected: true } ).data();
				location.href = "/ventas/detalles/"+item.sales.Id;
			}
		},
		{
			extend: "selectedSingle",
			text: "Eliminar",
			action: function ( e, dt, node, config ) {
				var item = dt.row( { selected: true } ).data();
				console.log(item);
				swal({
					title: "¿Estás seguro de eliminar un registro?",
					text: "Se eliminará el registro con clave: " + item.sales.Id,
					type: "warning",
					confirmButtonColor: "#FC5D20",
					confirmButtonText: "Ok!",
					closeOnConfirm: false
				}).then(function () {
					$.ajax({
						url: "/ventas/eliminar/"+item.sales.Id,
						type: "POST",
						beforeSend: function(){},
						success: function (jsonObject) {
							console.log(jsonObject);
							if (jsonObject != "") {
								var object = JSON.parse(jsonObject);
								console.log(object);
								swal({
									title: object.title,
									text: object.message,
									type: object.type,
									confirmButtonText: "Ok!"
								}).then(function(){
									window.location.reload(true);
								})

							}
						}
					});
				});
			}
		}],
		select: { style: 'single'},

		initComplete: function () {
            this.api().columns([0]).every( function () {
                var column = this;
                //console.log(this);
                var select = $('<select><option value="">Todas</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        console.log(val);
                        if($(this).val() == 1){
                        	val = "No Efectiva";
                        }
                        else if($(this).val() == 2){
                        	val = "Pendiente";
                        }
                        else if($(this).val() == 3){
                        	val = "Autorizada";
                        }
                        else if($(this).val() == 4){

                        	val = "Declinada";
                        }
                        else if($(this).val() == 5){
                        	val = "Cancelada";
                        }
                        else if($(this).val() == 6){
                        	val = "Aprobada sin capturar";
                        }
                        else if($(this).val() == 8){
                        	val = "En proceso";
                        }
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                	
                	if(d == 1){
                		d = "No Efectiva";
                	}
                	else if(d == 2){
                		d = "Pendiente";
                	}
                	else if(d == 3){
                		d = "Autorizada";
                	}
                	else if(d == 4){
                		d = "Declinada";
                	}
                	else if(d == 5){
                		d = "Cancelada";
                	}
                	else if(d == 6){
                		d = "Aprobada sin capturar";
                	}
                	else if(d == 8){
                		d = "En proceso";
                	}
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }

	});

	/* Sales Offline */
	var editorSales = new $.fn.dataTable.Editor( {
		ajax: "/lib/editor/salesOff.php",
		i18n: languageEditor,
		table: "#salesOff",
		fields:
		[{
			label: "Clave",
			name: "sales.Id"
		}]
	});
	var dataTableSales = $('#salesOff').dataTable({
		language: {
			url: "/js/dataTables/spanish.lang"
		},
		ajax: "/lib/editor/salesOff.php",
		responsive: { details: true },
		dom: dom,
		order: [[ 2, "desc" ]],
		columns: [

		/*{ data: "Estatus", render: function ( data, type, row ) {

			switch (data) {
				case "1":
				return "No efectiva";
				break;
				case "2":
				return "<label style='color:orange'>Pendiente</label>";
				break;
				case "3":
				return "<label style='color:green'>Autorizada</label>";
				break;
				case "4":
				return "<label style='color:red'>Declinada</label>";
				break;
				case "5":
				return "<label style='color:red'>Cancelada</label>";
				break;
				case "6":
				return "Aprobada sin capturar";
				break;
				case "8":
				return "<label style='color:orange'>En proceso<label>";
				break;
				default:
				return "Sin Estado";
				break;
			}
		}
	},*/
	{ data: "customers.Name" },
	{ data: "services.Name" },
	{ data: "services.NameProvider" },
	{ data: "services.TypeService" },
	{ data: "services.DateTo" },
	{ data: "services.DateFrom" },
	{ data: "services.NoPeople" },
	{ data: "payments.Total",
		render: $.fn.dataTable.render.number( ',', '.', 2, '$' ) 
	},
	{ data: "payments.Subtotal",
		render: $.fn.dataTable.render.number( ',', '.', 2, '$' ) 
	},
	{ data: "payments.Reference" },
	{ data: "payments.AuthorizationNo" }], 
	buttons: [ 'copy', 'excel', 'pdf',
		/*{ extend: "create", editor: editorSales },
		{ extend: "edit",   editor: editorSales },*/
		{ 
			text: "Crear",
			action: function ( e, dt, node, config ) {
				var item = dt.row( { selected: true } ).data();
				location.href = "/ventas/crear";
			}
		},            
		{
			extend: "selectedSingle",
			text: "Editar",
			action: function ( e, dt, node, config ) {
				var item = dt.row( { selected: true } ).data();
				location.href = "/ventas/editar/"+item.sales.Id;
			}
		},          
		{
			extend: "selectedSingle",
			text: "Detalles",
			action: function ( e, dt, node, config ) {
				var item = dt.row( { selected: true } ).data();
				location.href = "/ventas/detalles/"+item.sales.Id;
			}
		},
		{
			extend: "selectedSingle",
			text: "Eliminar",
			action: function ( e, dt, node, config ) {
				var item = dt.row( { selected: true } ).data();
				console.log(item);
				swal({
					title: "¿Estás seguro de eliminar un registro?",
					text: "Se eliminará el registro con clave: " + item.sales.Id,
					type: "warning",
					confirmButtonColor: "#FC5D20",
					confirmButtonText: "Ok!",
					closeOnConfirm: false
				}).then(function () {
					$.ajax({
						url: "/ventas/eliminar/"+item.sales.Id,
						type: "POST",
						beforeSend: function(){},
						success: function (jsonObject) {
							console.log(jsonObject);
							if (jsonObject != "") {
								var object = JSON.parse(jsonObject);
								console.log(object);
								swal({
									title: object.title,
									text: object.message,
									type: object.type,
									confirmButtonText: "Ok!"
								}).then(function(){
									window.location.reload(true);
								})

							}
						}
					});
				});
			}
		}],
		select: { style: 'single'},

		/*initComplete: function () {
            this.api().columns([0]).every( function () {
                var column = this;
                //console.log(this);
                var select = $('<select><option value="">Todas</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        console.log(val);
                        if($(this).val() == 1){
                        	val = "No Efectiva";
                        }
                        else if($(this).val() == 2){
                        	val = "Pendiente";
                        }
                        else if($(this).val() == 3){
                        	val = "Autorizada";
                        }
                        else if($(this).val() == 4){

                        	val = "Declinada";
                        }
                        else if($(this).val() == 5){
                        	val = "Cancelada";
                        }
                        else if($(this).val() == 6){
                        	val = "Aprobada sin capturar";
                        }
                        else if($(this).val() == 8){
                        	val = "En proceso";
                        }
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                	
                	if(d == 1){
                		d = "No Efectiva";
                	}
                	else if(d == 2){
                		d = "Pendiente";
                	}
                	else if(d == 3){
                		d = "Autorizada";
                	}
                	else if(d == 4){
                		d = "Declinada";
                	}
                	else if(d == 5){
                		d = "Cancelada";
                	}
                	else if(d == 6){
                		d = "Aprobada sin capturar";
                	}
                	else if(d == 8){
                		d = "En proceso";
                	}
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }*/

	});

	/* Update cities */
	$("#updateCities").submit(function(e){
		var formURL = $(this).attr("action");
		console.log(formURL);
		$.ajax({
			url: formURL,
			type: "POST",
			beforeSend: function(){
				$('.wall-ok').css('display','block');
			},
			success: function (jsonObject) {
				$('.wall-ok').css('display','none');
				if (jsonObject != "") {
					console.log(object);
					var object = JSON.parse(jsonObject);
					swal({
						title: object.title,
						text: object.message,
						type: object.type,
						confirmButtonColor: "#FC5D20",
						confirmButtonText: "Ok!",
						closeOnConfirm: false
					}).then(function () {
						window.location.reload(true);
					})
				}
			}
		});
		e.preventDefault(); /* STOP default action*/
		return false;
	});

	/* Update cities */
	$("#updateHotels").submit(function(e){
		var formURL = $(this).attr("action");
		console.log(formURL);
		$.ajax({
			url: formURL,
			type: 'GET',
			beforeSend: function(){
				$('.wall-ok').css('display','block');
				console.log("waiting-update");
			},
			success: function (jsonObject) {
				$('.wall-ok').css('display','none');
				console.log("done-update");
				if (jsonObject != "") {
					console.log(object);
					var object = JSON.parse(jsonObject);
					swal({
						title: object.title,
						text: object.message,
						type: object.type,
						confirmButtonColor: "#FC5D20",
						confirmButtonText: "Ok!",
						closeOnConfirm: false
					}).then(function () {
						window.location.reload(true);
					})
				}
			}
		});
		e.preventDefault(); /* STOP default action*/
		return false;
	});

	$("#saleEditForm").submit(function(event){
		$.ajax({
			url: this.action,
			type: this.method,
			data: $(this).serialize(),
			beforeSend: function(){
				$('.wall-ok').css('display','block');
			},
			success: function (jsonObject) {
				$('.wall-ok').css('display','none');
				console.log(jsonObject);
				if (jsonObject != "") {
					var object = JSON.parse(jsonObject);
					swal({
						title: object.title,
						text: object.message,
						type: object.type,
						confirmButtonColor: "#FC5D20",
						confirmButtonText: "Ok!",
						closeOnConfirm: false
					}).then(function () {
						window.location.reload(true);
					})
				}
			}
		});
		event.preventDefault(); /* STOP default action*/
		return false;
	});
});	

function init_dtKeys()
{
	var editorKeys = new $.fn.dataTable.Editor( {
		ajax: "/lib/editor/keys.php",
		i18n: languageEditor,
		table: "#keys",
		fields:
		[{
			label: "Nombre llave",
			name: "Name"
		},
		{
			label: "Dependencia",
			name: "Dependence"
		},
		{
			label: "Contraseña",
			name: "Password"
		}]
	});

	var dataTableKeys= $('#keys').dataTable({
		language: {
			url: "/js/dataTables/spanish.lang"
		},
		ajax: "/lib/editor/keys.php",
		responsive: { details: true },
		dom: dom,
		columns: [{ data: "Name" },
		{ data: "Id_Key" },
		{ data: "Dependence" },
		{ data: "Password" }],
		buttons: [ 'copy', 'excel', 'pdf',
		{ 
			extend: "create",
			text: "Nuevo",
			action: function ( e, dt, node, config ) {
				$('#ModalCrear').modal('toggle');

			}
		},
		{ 
			extend: "selectedSingle",
			text: "Editar",
			action: function ( e, dt, node, config ) {

			}
		},
		{
			extend: "selectedSingle",
			text: "Eliminar",
			action: function ( e, dt, node, config ) {
				var item = dt.row( { selected: true } ).data();
				console.log(item);
				swal({
					title: "¿Estás seguro de eliminar un registro?",
					text: "Se eliminará el registro con clave: " + item.Id,
					type: "warning",
					confirmButtonColor: "#FC5D20",
					confirmButtonText: "Ok!",
					closeOnConfirm: false
				}).then(function () {
					$.ajax({
						url: "/claves/eliminar/"+item.Id,
						type: "POST",
						beforeSend: function(){},
						success: function (jsonObject) {
							console.log(jsonObject);
							if (jsonObject != "") {
								var object = JSON.parse(jsonObject);
								console.log(object);
								swal({
									title: object.title,
									text: object.message,
									type: object.type,
									confirmButtonText: "Ok!"
								}).then(function(){
									window.location.reload(true);
								})

							}
						}
					});
				});
			}
		}
		],
		select: { style: 'single'},
	});
}

function eliminar_dt() 
{
	$('.table').dataTable().fnDestroy();
}