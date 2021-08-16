
	<div class=" col-sm-offset-2 col-sm-8 col-md-offset-1 col-md-7" id="box_search">
		<div class="searcher-ok" id="searcher_form">
			<form id="formSearch" class="tab-pane fade in active" method="GET" action="/hoteles/search/<?php echo $GLOBALS['lang']; ?>" autocomplete="off">
				<div class="row">
					<div class="col-md-12">
						<div style="font-size: 24px;margin-top:10px;margin-bottom: 10px;"><?php echo $GLOBALS['_searcher_label_reserve']; ?></div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group col-md-4 half-input-r">
							<label for="destiny"><?php echo $GLOBALS['_searcher_label_destiny']; ?></label>
							<div class="input-group" onclick="$('#destiny').focus();" style="cursor: pointer;">
								<div class="input-group-addon">
									<img class="icon-small" src="/img/iconos/hotel-w.svg" alt="">
								</div>
								<input id="destiny" name="destiny" type="text" onkeyup="refillDestiny(this);" class="form-control" placeholder="<?php echo $GLOBALS['_searcher_ph_destiny']; ?>">
								<input id="idCity" name="idCity" type="hidden" >
								<input id="idHotel" name="idHotel" type="hidden" >
							</div>
						</div>
						<div class="form-group col-md-4 half-input-m">
							<label for="from"><?php echo $GLOBALS['_searcher_label_from']; ?></label>
							<div class="input-group testing" onclick="$('#from').focus();" style="cursor: pointer;">
								<div class="input-group-addon">
									<img class="icon-small" src="/img/iconos/calendario-e.svg" alt="" autocomplete="off">
								</div>
								<input id="from" name="from" class="form-control datepicker" placeholder="dd/mm/aaaa" type="text">
							</div>
							<label for="from" generated="true" class="error"></label>
						</div>
						<div class="form-group col-md-4 half-input-l">
							<label for="to"><?php echo $GLOBALS['_searcher_label_to']; ?></label>
							<div class="input-group" onclick="$('#to').focus();" style="cursor: pointer;">
								<div class="input-group-addon">
									<img class="icon-small" src="/img/iconos/calendario-s.svg" alt="">
								</div>
								<input id="to" name="to" class="form-control datepicker" placeholder="dd/mm/aaaa" type="text">
							</div>
							<label for="to" generated="true" class="error"></label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group col-md-4 half-input-r">
							<label for="rooms" ><?php echo $GLOBALS['_searcher_label_rooms']; ?></label>
							<select id="rooms" name="rooms" class="form-control">
								<option value="1" selected>1</option>
								<option value="2">2</option>
								<option value="3">3</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="title-room"><?php echo $GLOBALS['_searcher_label_room']; ?> 1</div>
						<div class="form-group col-md-3 half-input-m">
							<label for="adults_0"><?php echo $GLOBALS['_searcher_label_adults']; ?></label>
							<input id="adults_0" name="adults[0]" class="form-control" type="number" min="1" value="1">
							<label for="adults_0" generated="true" class="error"></label>
						</div>
						<div class="form-group col-md-3 half-input-l">
							<label for="kids_0"><?php echo $GLOBALS['_searcher_label_kids']; ?></label>
							
							<select name="kids[0]" id="kids_0" class="form-control kids-i-0">
								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
							</select>
							<label for="kids_0" generated="true" class="error"></label>
						</div>
						<div class="con-ages-0"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="con-rooms" style="height: auto; float: left;"></div>
					</div>
				</div>
				<div class="clear"></div>
			
				<div class="row">

					<div class="col-md-4 col-md-offset-8">
						<div class="form-spacing"></div>
						<div class="form-group">
							<button class="btn btn-default form-control"><?php echo $GLOBALS['_searcher_btn_search']; ?></button>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="hr-solid"></div>
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="row">
							<div class="col-xs-12 col-sm-3 col-md-2 noPadd" >
								<img src="/img/logos/clubestrella.png" alt="Club Estrella" class="img-responsive" id="club_img">
							</div>
							<div class="col-xs 12 col-sm-6 col-md-6 noPadd" id="label_club">
								<p><b><?php echo $GLOBALS['_searcher_label_clubestrella']; ?> </b></p>
								<p><?php echo $GLOBALS['_searcher_label_p']; ?> </p>
								<p><?php echo $GLOBALS['_searcher_label_p2']; ?> </p>
							</div>
							<div class="col-xs-12 col-sm-3 col-md-4 noPadd">
								<a href="https://clubestrella.mx/" target="_blank" id="btn_club"><?php echo $GLOBALS['_searcher_label_button']?></a>
							</div>
						</div>
					</div>
			    </div>
		    </form>
	    </div>
    </div>
    <div class="col-sm-2 col-md-offset-1 col-md-3">
    	<img src="img/new_items/phone.png" alt="" id="hand_whats">
    </div>

