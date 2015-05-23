<?php /* Smarty version Smarty-3.1.13, created on 2015-05-21 11:37:14
         compiled from "db:cal_manage_event" */ ?>
<?php /*%%SmartyHeaderCode:1436980324555d71260c58b1-71685836%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3a5a348850da3a38de0df70a877606c36d27f44c' => 
    array (
      0 => 'db:cal_manage_event',
      1 => 1432218106,
      2 => 'db',
    ),
    '96e98dc0a071e9031638794927f1d96551ac1b8e' => 
    array (
      0 => 'db:cal_dashboard',
      1 => 1432188669,
      2 => 'db',
    ),
    'feffbfe6ac9449d4f7562155d506bf9391413425' => 
    array (
      0 => 'db:cal_submit_event',
      1 => 1432218277,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '1436980324555d71260c58b1-71685836',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_555d7126eb69b7_03713919',
  'variables' => 
  array (
    'navHomeActive' => 0,
    'navInboxActive' => 0,
    'navCreateActive' => 0,
    'navManageActive' => 0,
    'navShareActive' => 0,
    'navFeedsActive' => 0,
    'navSupportActive' => 0,
    'navAdminActive' => 0,
    'navAdminEnabled' => 0,
    'calendars' => 0,
    'calendar' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_555d7126eb69b7_03713919')) {function content_555d7126eb69b7_03713919($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
  <head>
    <base href="http://dev.onecal.co.php53-13.dfw1-1.websitetestlink.com/">
    <meta charset="utf-8">
    <title>OneCal Calendar Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

<meta http-equiv="cache-control" content="no-cache"> 
<meta http-equiv="expires" content="Mon, 26 Jul 1997 05:00:00 GMT"/> 
<meta http-equiv="expires" content="0">
<meta http-equiv="pragma" content="no-cache">

    <!-- Le styles -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="/assets/css/dashboard.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="/onecal/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="/assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="/assets/ico/favicon.png">




   
	<link media="all" rel="stylesheet" type="text/css" href="https://www.filelogix.com/onecal/css/bootstrap-datetimepicker.min.css" />
	<link media="all" rel="stylesheet" type="text/css" href="https://www.filelogix.com/css/bootstrap-switch.css" />
	<link media="all" rel="stylesheet" type="text/css" href="https://www.filelogix.com/lib/tagsinput/bootstrap-tagsinput.css" />

		<link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="/assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="/assets/css/font-awesome.min.css" />
		<link rel="stylesheet" href="https://www.filelogix.com/lib/fileUploader/css/jquery.fileupload.css">
		<link rel="stylesheet" href="https://www.filelogix.com//lib/fileUploader/css/style.css">

		<link rel="stylesheet" href="/css/bootstrap-datetimepicker.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="/assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!--page specific plugin styles-->

		<!--fonts-->

		<link rel="stylesheet" href="/assets/css/ace-fonts.css" />

		<!--inline styles related to this page-->
		
		<style type="text/css">
			.buzz-select-small { width: 70px; margin-top: 10px; white-space: nowrap; position: relative; top: -5px;}
			.gmnoprint img { max-width: none; }

		</style>


   

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

		<script src="https://onecal.filelogix.com/js/bootstrap.min.js"></script>
	
		<script type="text/javascript" src="/js/bootstrap-datetimepicker.min.js"></script>

		<script src="https://www.filelogix.com/lib/fileUploader/js/vendor/jquery.ui.widget.js"></script>
		<script src="https://www.filelogix.com/lib/fileUploader/js/jquery.iframe-transport.js"></script>
		<script src="https://www.filelogix.com/lib/fileUploader/js/jquery.fileupload.js"></script>

 

  </head>

  <body>   

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
			<a class="navbar-brand" href="calendar/home">OneCal Portal</a>
        </div>
<?php if ($_smarty_tpl->tpl_vars['navHomeActive']->value||$_smarty_tpl->tpl_vars['navInboxActive']->value||$_smarty_tpl->tpl_vars['navCreateActive']->value||$_smarty_tpl->tpl_vars['navManageActive']->value||$_smarty_tpl->tpl_vars['navShareActive']->value||$_smarty_tpl->tpl_vars['navFeedsActive']->value||$_smarty_tpl->tpl_vars['navSupportActive']->value||$_smarty_tpl->tpl_vars['navAdminActive']->value){?>      
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Help</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
<?php }?>
    </nav>
          

 <?php if ($_smarty_tpl->tpl_vars['navHomeActive']->value||$_smarty_tpl->tpl_vars['navInboxActive']->value||$_smarty_tpl->tpl_vars['navCreateActive']->value||$_smarty_tpl->tpl_vars['navManageActive']->value||$_smarty_tpl->tpl_vars['navShareActive']->value||$_smarty_tpl->tpl_vars['navFeedsActive']->value||$_smarty_tpl->tpl_vars['navSupportActive']->value||$_smarty_tpl->tpl_vars['navAdminActive']->value){?>      
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
              <li <?php if ($_smarty_tpl->tpl_vars['navHomeActive']->value){?> class="active" <?php }?>><a href="/calendar/home">Home</a></li>
             <li <?php if ($_smarty_tpl->tpl_vars['navInboxActive']->value){?> class="active" <?php }?>><a href="/calendar/inbox">Inbox</a></li>
              <li <?php if ($_smarty_tpl->tpl_vars['navCreateActive']->value){?> class="active" <?php }?>><a href="/event/add">Create</a></li>
              <li <?php if ($_smarty_tpl->tpl_vars['navManageActive']->value){?> class="active" <?php }?>><a href="/calendar/manage">Manage</a></li>
              <li <?php if ($_smarty_tpl->tpl_vars['navShareActive']->value){?> class="active" <?php }?>><a href="/calendar/share">Share</a></li>
              <li <?php if ($_smarty_tpl->tpl_vars['navFeedsActive']->value){?> class="active" <?php }?>><a href="/calendar/feeds">Feed</a></li>
              <li <?php if ($_smarty_tpl->tpl_vars['navSupportActive']->value){?> class="active" <?php }?>><a href="/calendar/support">Support</a></li>
              <?php if ($_smarty_tpl->tpl_vars['navAdminEnabled']->value){?><li <?php if ($_smarty_tpl->tpl_vars['navAdminActive']->value){?> class="active" <?php }?>><a href="/calendar/admin">Admin</a></li><?php }?>
              <?php if ($_smarty_tpl->tpl_vars['navHomeActive']->value||$_smarty_tpl->tpl_vars['navInboxActive']->value||$_smarty_tpl->tpl_vars['navCreateActive']->value||$_smarty_tpl->tpl_vars['navManageActive']->value||$_smarty_tpl->tpl_vars['navShareActive']->value||$_smarty_tpl->tpl_vars['navFeedsActive']->value||$_smarty_tpl->tpl_vars['navSupportActive']->value||$_smarty_tpl->tpl_vars['navAdminActive']->value){?> 
              <li><a href="/calendar/logout">Logout</a></li>
              <?php }?>
          </ul>
          <ul class="nav nav-sidebar">
	<?php  $_smarty_tpl->tpl_vars['calendar'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['calendar']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['calendars']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['calendar']->key => $_smarty_tpl->tpl_vars['calendar']->value){
$_smarty_tpl->tpl_vars['calendar']->_loop = true;
?>
		<li><a href="/calendar/home/<?php echo $_smarty_tpl->tpl_vars['calendar']->value['sShortName'];?>
"><?php echo $_smarty_tpl->tpl_vars['calendar']->value['sName'];?>
</a></li>
	<?php } ?>	
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
          </ul>
        </div>
       
        
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<?php }?>           
	<div class="container" >

	
	<div class="span12">
<!--		<?php /*  Call merged included template "db:CAL_SUBMIT_EVENT" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("db:CAL_SUBMIT_EVENT", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '1436980324555d71260c58b1-71685836');
content_555dfbaad29238_90137318($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "db:CAL_SUBMIT_EVENT" */?> -->
	</div>

	</div>
	
	
    

   		<script type="text/javascript"
      			src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAesr_spqa2sOSI90mkR1lnmXf6JAcZI8U&sensor=false">
	        </script>
		<script type="text/javascript">
		     var map;  
    		     function initialize() {
        			var mapOptions = {
 		         center: new google.maps.LatLng(30.3369, -81.6614),
 		         zoom: 10,
  			panControl: false,
  			zoomControl: true,
  			mapTypeControl: true,
  			scaleControl: true,
 			 streetViewControl: true,
 			 overviewMapControl: false			
        		      };
		      map = new google.maps.Map(document.getElementById("map-canvas"),
		            mapOptions);
		      }
		      google.maps.event.addDomListener(window, 'load', initialize);

 			function codeAddress(address) {
			      geocoder = new google.maps.Geocoder();

			    geocoder.geocode( { 'address': address}, function(results, status) {
			      if (status == google.maps.GeocoderStatus.OK) {
			        map.setCenter(results[0].geometry.location);
			        var marker = new google.maps.Marker({
			            map: map,
			            position: results[0].geometry.location
			        });
				map.setZoom(15);
			      } else {
//        				alert("Geocode was not successful for the following reason: " + status);
		      		}
			    });
			  }
		</script>	



  </body>
</html>
<?php }} ?><?php /* Smarty version Smarty-3.1.13, created on 2015-05-21 11:37:14
         compiled from "db:cal_submit_event" */ ?>
<?php if ($_valid && !is_callable('content_555dfbaad29238_90137318')) {function content_555dfbaad29238_90137318($_smarty_tpl) {?><div id="buzz-submit-alert">
	<?php if ($_smarty_tpl->tpl_vars['alertSuccess']->value){?><br><div class="span10 alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $_smarty_tpl->tpl_vars['successMsg']->value;?>
</div><?php }?>
	<?php if ($_smarty_tpl->tpl_vars['alertInfo']->value){?><br><div class="span10 alert alert-info"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $_smarty_tpl->tpl_vars['infoMsg']->value;?>
</div><?php }?>
	<?php if ($_smarty_tpl->tpl_vars['alertWarning']->value){?><br><div class="span10 alert alert-warning"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $_smarty_tpl->tpl_vars['warningMsg']->value;?>
</div><?php }?>
	<?php if ($_smarty_tpl->tpl_vars['alertError']->value){?><br><div class="span10 alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $_smarty_tpl->tpl_vars['errorMsg']->value;?>
</div><?php }?>
</div>
<div class="col-md-11"  id="buzz-event-loading">
	<center>
	<div class="col-md-11"><img src="images/ajax-loader.gif"></div>
	<div class="col-md-11">Loading Event</div>
	</center>
</div>
<div class="col-md-11 hide"  id="buzz-event-form">

	<form action="<?php echo $_smarty_tpl->tpl_vars['formAction']->value;?>
" method="post" enctype="multipart/form-data" class="form-horizontal" onsubmit="return processEvent();">
	<!-- Event Title -->
	<div class="event-title">
				<label for="post_title" class=""><h4>Event Title:<small class="req"> (required)</small></h4></label>
					<input type="text" class="input-xxlarge" name="eventTitle" value="<?php echo $_smarty_tpl->tpl_vars['eventTitle']->value;?>
">
				</div><!--event-title -->
	<!-- Event Description -->
	<div class="events-description" style="padding-bottom: 20px;>
				<label for="post_content" class=""><h4>Event Description:<!--<small class="req"> (required)</small>--></h4></label>
		<textarea name="eventDescription" class="span10" rows=3><?php echo $_smarty_tpl->tpl_vars['eventDetails']->value;?>
</textarea>	</div><!-- event-description -->

	<!-- Event Categories -->
	<div class="well" id="event_categories">
			<h4 class="event-time">Event Categories:</h4>

			<div class="control-group" style="margin-left: 30px;">
					<?php  $_smarty_tpl->tpl_vars['category'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['category']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['categories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['category']->key => $_smarty_tpl->tpl_vars['category']->value){
$_smarty_tpl->tpl_vars['category']->_loop = true;
?>
			        			<div class="span3">
			            		<label class="checkbox" for="category-<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
"><input type="checkbox" name="eventCategories[]" value="<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
" id="category-<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
"> <?php echo $_smarty_tpl->tpl_vars['category']->value['sName'];?>
 </label>
					        </div>
					<?php } ?>
				
			</div>
	</div><!-- event-categories -->
	
	<!-- Event Featured Image -->

	<!-- Event Date Selection -->

	<div class="well" id="event-datepicker">


			<h4 class="event-time">Event Time &amp; Date</h4>
			<div class="control-group">
				<label class="control-label" for="allDayCheckbox">All day event?</label>
					<div class="controls">
						<input type="checkbox" id="allDayCheckbox" name="eventAllDay" onChange="javascript:allDayChanged();" value="1" <?php if ($_smarty_tpl->tpl_vars['event']->value['bAllDay']){?>checkec<?php }?>>
					</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="EventStartDate">From:</label>
					<div class="controls">

				<div id="EventStartDate" class="input-append">
				    <input class="col-md-2" data-format="yyyy-MM-dd" type="text" name="startDate" value="<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
"></input>
				    <span class="add-on">
				      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
				      </i>
				    </span>
				 </div>
<div style="display: inline; white-space: nowrap;">
						<select name="startHour" class="buzz-select-small" id="startHour"><option value="01">01</option>
							<option value="02">02</option>
							<option value="03">03</option>
							<option value="04">04</option>
							<option value="05">05</option>
							<option value="06">06</option>
							<option value="07">07</option>
							<option value="08" selected="selected">08</option>
							<option value="09">09</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
							</select> <select name="startMinute" class="buzz-select-small" id="startMinute"><option value="00" selected="selected">00</option>
							<option value="05">05</option>
							<option value="10">10</option>
							<option value="15">15</option>
							<option value="20">20</option>
							<option value="25">25</option>
							<option value="30">30</option>
							<option value="35">35</option>
							<option value="40">40</option>
							<option value="45">45</option>
							<option value="50">50</option>
							<option value="55">55</option>
							</select> <select name="startMeridian" class="buzz-select-small" id="startMeridian"><option value="am" selected="selected">am</option>
							<option value="pm">pm</option>
							</select>
</div>
					</div><!-- .timeofdayoptions -->
			</div>

			<div class="control-group">
				<label class="control-label" for="EventEndDate">To:</label>
					<div class="controls">

				<div id="EventEndDate" class="input-append">
				    <input class="col-md-2" data-format="yyyy-MM-dd" type="text" name="endDate" value="<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
"></input>
				    <span class="add-on">
				      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
				      </i>
				    </span>
				 </div>

<div style="display: inline; white-space: nowrap;">

						<select name="endHour" class="buzz-select-small" id="endHour"> <option value="01">01</option>
						<option value="02">02</option>
						<option value="03">03</option>
						<option value="04">04</option>
						<option value="05" selected="selected">05</option>
						<option value="06">06</option>
						<option value="07">07</option>
						<option value="08">08</option>
						<option value="09">09</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						</select> <select name="endMinute" class="buzz-select-small" id="endMinute"> <option value="00" selected="selected">00</option>
						<option value="05">05</option>
						<option value="10">10</option>
						<option value="15">15</option>
						<option value="20">20</option>
						<option value="25">25</option>
						<option value="30">30</option>
						<option value="35">35</option>
						<option value="40">40</option>
						<option value="45">45</option>
						<option value="50">50</option>
						<option value="55">55</option>
						</select> <select name="endMeridian" class="buzz-select-small" id="endMeridian"> <option value="am">am</option>
						<option value="pm" selected="selected">pm</option>
						</select>
						</div>
				</div>
					</div><!-- .timeofdayoptions -->

			<!--Repeating Event-->

			<div class="control-group">
				<label class="control-label" for="EventFrequency">Repeats?</label>
					<div class="controls">
						<div class="span6 pull-left" style="margin-left: 0px;">
									<div class="span3 pull-left" style="margin-left: 0px; margin-bottom: 10px;">
									<select name="repeatFrequency" id="eventFrequency" class="input-medium" onchange="javascript:changeFreq();">
										<option value="">Never</option>
										<!--<option value="Hourly">Hourly</option>-->
										<option value="Daily">Daily</option>
										<option value="Weekly">Weekly</option>
										<option value="Monthly">Monthly</option>
										<option value="Annually">Annually</option>
										<option value="Custom">Custom</option>
									</select>
									</div>
									<div class="span4 pull-left" style="margin-left: 5px;">
										<div id="eventRepeats-RepeatFreq" style="display: none;">
											  every&nbsp;&nbsp;<div class="input-prepend input-append">
										         <button class="btn" type="button" onclick="javascript:minusButton('repeatEvery',1);">-</button>
											 <input class="span2" class="input input-mini" size=2 id="repeatEvery" name="repeatEvery" type="text" style="text-align: center; width: 30px;" value="1">
										         <button class="btn" type="button" onclick="javascript:plusButton('repeatEvery',99);">+</button>											</div>&nbsp;&nbsp;<div id="repeatStr" style="display: inline;">day(s)</div>
										</div>
									</div>
							</div>
					</div>

                            </div> 
			    <div class="eventRepeats" id="eventRepeats-WhichDays" style="display: none;">
								<div class="control-group">
									<label class="control-label" for="eventDays">Which Days?</label>
									<div class="controls">
										<input type="hidden" name="repeatDaysBinary" id="eventDaysBinary" value="">
										<input type="hidden" name="repeatDaysBinaryStr" id="eventDaysBinaryStr" value="">
	                           						<div class="btn-group" data-toggle="buttons-checkbox" data-toggle-name="eventDaysBinary">
        	                        								<button type="button" name="eventDays[]" id="eventDays-1" onclick="javascript:daysChanged('#eventDays-1');" class="btn" data-value="SU" value="1">S</button>
        	     	                   							<button type="button" name="eventDays[]" id="eventDays-2" onclick="javascript:daysChanged('#eventDays-2');" class="btn" data-value="MO" value="2">M</button>
                	         	       							<button type="button" name="eventDays[]" id="eventDays-3" onclick="javascript:daysChanged('#eventDays-3');" class="btn" data-value="TU" value="3">T</button>
                	  	        	      							<button type="button" name="eventDays[]" id="eventDays-4" onclick="javascript:daysChanged('#eventDays-4');" class="btn" data-value="WE" value="4">W</button>
                                								<button type="button" name="eventDays[]" id="eventDays-5" onclick="javascript:daysChanged('#eventDays-5');" class="btn" data-value="TH" value="5">T</button>
                                								<button type="button" name="eventDays[]" id="eventDays-6" onclick="javascript:daysChanged('#eventDays-6');" class="btn" data-value="FR" value="6">F</button>
                               								<button type="button" name="eventDays[]" id="eventDays-7" onclick="javascript:daysChanged('#eventDays-7');" class="btn" data-value="SA" value="7">S</button>
				                        	 			</div>
									</div>
								</div>
			    </div>
			    <div class="eventRepeats" id="eventRepeats-Monthly" style="display: none;">
								<div class="control-group">
									<label class="control-label" for="eventDays">How Often?</label>
									<div class="controls">
										<div class="repeat-monthly-block" style="display: block; margin-left: 30px;">
      									                      <div class="repeat-monthly-date" >
 									                               <label class="radio" ><input type="radio" name="repeatMonth" id="repeatMonth-1" checked="checked" value="1" style="margin-top: 5px; ">on day
												<select name="repeatMonthDayNumber" class="input-mini" id="repeatMonthDayNumber">		
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
												<option value="10">10</option>
												<option value="11">11</option>
												<option value="12">12</option>
												<option value="13">13</option>
												<option value="14">14</option>
												<option value="15">15</option>
												<option value="16">16</option>
												<option value="17">17</option>
												<option value="18">18</option>
												<option value="19">19</option>
												<option value="20">20</option>
												<option value="21">21</option>
												<option value="22">22</option>
												<option value="23">23</option>
												<option value="24">24</option>
												<option value="25">25</option>
												<option value="26">26</option>
												<option value="27">27</option>
												<option value="28">28</option>
												<option value="29">29</option>
												<option value="30">30</option>
												<option value="31">31</option>
												</select> 
										</label>
						                           			</div>
        							                    			<div class="repeat-monthly-day">
                       							         <label class="radio"><input type="radio" name="repeatMonth" id="repeatMonth-2" value="2" style="margin-top: 10px;">on the
											<select name="repeatMonthWeek" id="repeatMonthWeek" class="input-small" style="margin-bottom: 10px;">
												<option value="1">First</option>
												<option value="2">Second</option>
												<option value="3">Third</option>
												<option value="4">Fourth</option>												<option value="9">Last</option>											</select>
  											<input type="hidden" name="repeatMonthDaysBinary" id="eventMonthDaysBinary" value="">
  											<input type="hidden" name="repeatMonthDaysBinaryStr" id="eventMonthDaysBinaryStr" value="">
	                           							<div class="btn-group" data-toggle="buttons-checkbox" data-toggle-name="eventMonthDaysBinary"  style="margin-bottom: 10px;">
        	                        									<button type="button" name="eventMonthDays[]" id="eventMonthDays-1" onclick="javascript:daysChanged();" class="btn" data-value="SU" value="1">S</button>
        	     	                   								<button type="button" name="eventMonthDays[]" id="eventMonthDays-2" onclick="javascript:daysChanged();" class="btn" data-value="MO" value="2">M</button>
                	         	       								<button type="button" name="eventMonthDays[]" id="eventMonthDays-3" onclick="javascript:daysChanged();" class="btn" data-value="TU" value="3">T</button>
                	  	        	      								<button type="button" name="eventMonthDays[]" id="eventMonthDays-4" onclick="javascript:daysChanged();" class="btn" data-value="WE" value="4">W</button>
                                									<button type="button" name="eventMonthDays[]" id="eventMonthDays-5" onclick="javascript:daysChanged();" class="btn" data-value="TH" value="5">T</button>
                                									<button type="button" name="eventMonthDays[]" id="eventMonthDays-6" onclick="javascript:daysChanged();" class="btn" data-value="FR" value="6">F</button>
                               									<button type="button" name="eventMonthDays[]" id="eventMonthDays-7" onclick="javascript:daysChanged();" class="btn" data-value="SA" value="7">S</button>
				                        	 				</div>
										</label>
                            						</div>
                        						</div>			
							</div>
						</div>
			   </div>

			    <div class="eventRepeats" id="eventRepeats-Annually" style="display: none;">
								<div class="control-group">
									<label class="control-label" for="eventDays">How Often?</label>
									<div class="controls">
										<div class="repeat-annually-block" style="display: block; margin-left: 30px;">
      									                      <div class="repeat-monthly-date" >
 									                       <label class="radio" ><input type="radio" name="repeatAnnual" id="repeatAnnual-1" checked="checked" value="1" style="margin-top: 5px; ">on
			
												<select name="repeatAnnualMonth1" class="input-small" id="repeatAnnualMonth1">												       <option value="1">January</option>
												       <option value="2">February</option>
												       <option value="3">March</option>												       <option value="4">April</option>
												       <option value="5">May</option>
												       <option value="6">June</option>												       <option value="7">July</option>
												       <option value="8">August</option>
												       <option value="9">September</option>												       <option value="10">October</option>
												       <option value="11">November</option>
												       <option value="12">December</option>
												</select>			
												<select name="repeatAnnualDayNumber" class="input-mini" id="repeatAnnualDayNumber">		
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
												<option value="10">10</option>
												<option value="11">11</option>
												<option value="12">12</option>
												<option value="13">13</option>
												<option value="14">14</option>
												<option value="15">15</option>
												<option value="16">16</option>
												<option value="17">17</option>
												<option value="18">18</option>
												<option value="19">19</option>
												<option value="20">20</option>
												<option value="21">21</option>
												<option value="22">22</option>
												<option value="23">23</option>
												<option value="24">24</option>
												<option value="25">25</option>
												<option value="26">26</option>
												<option value="27">27</option>
												<option value="28">28</option>
												<option value="29">29</option>
												<option value="30">30</option>
												<option value="31">31</option>
												</select> 
										</label>
						                           			</div>
        							                    			<div class="repeat-monthly-day">
                       							         <label class="radio"><input type="radio" name="repeatAnnual"  id="repeatAnnual-2" value="2" style="margin-top: 10px;">on the
											<select name="repeatAnnualWeek" class="input-small" style="margin-bottom: 10px;" id="repeatAnnualWeek">
												<option value="1">First</option>
												<option value="2">Second</option>
												<option value="3">Third</option>
												<option value="4">Fourth</option>
												<option value="9">Last</option>											</select>
											<select name="repeatAnnualDayOfWeek" class="input-small" style="margin-bottom: 10px;" id="repeatAnnualDayOfWeek">
												<option value="1">Sunday</option>
												<option value="2">Monday</option>
												<option value="3">Tuesday</option>
												<option value="4">Wednesday</option>
												<option value="5">Thursday</option>												<option value="6">Friday</option>												<option value="7">Saturday</option>												<option value="9">Day</option>											</select>
											&nbsp;of&nbsp;
											<select name="repeatAnnualMonth2" class="input-small" style="margin-bottom: 10px;" id="repeatAnnualMonth2">												       <option value="1">January</option>
												       <option value="2">February</option>
												       <option value="3">March</option>												       <option value="4">April</option>
												       <option value="5">May</option>
												       <option value="6">June</option>												       <option value="7">July</option>
												       <option value="8">August</option>
												       <option value="9">September</option>												       <option value="10">October</option>
												       <option value="11">November</option>
												       <option value="12">December</option>
												</select>
										</label>
                            						</div>
                        						</div>			
							</div>
						</div>
			</div>

			    <div class="eventRepeats" id="eventRepeats-Custom" style="display: none;">
								<div class="control-group">
									<label class="control-label" for="eventDays">When?</label>
									<div class="controls">

										<textarea name="repeatCustomDates" rows="2" class="span8" placeholder="Enter a list of dates in YYYY-MM-DD format, separated by spaces or commas.  Dates may also be listed in ranges, using '-' or 'to'."><?php echo $_smarty_tpl->tpl_vars['repeatCustomDates']->value;?>
</textarea>
										
									</div>
								</div>
			</div>			   

			    <div class="eventRepeats" id="eventRepeats-Exception" style="display: none;">
								<div class="control-group">
									<label class="control-label" for="repeatSkip">Except?</label>
									<div class="controls">

										<textarea name="repeatSkipDates" rows="2" class="span8" placeholder="Enter a list of dates to skip in YYYY-MM-DD format, separated by spaces or commas."><?php echo $_smarty_tpl->tpl_vars['repeatSkipDates']->value;?>
</textarea>
										
									</div>
								</div>
			</div>	
			 <div class="eventRepeats" id="eventRepeats-EndDate" style="display: none;">
				<div class="control-group">
						<label class="control-label" for="repeatEndDate">Until?</label>
						<div class="controls">

						<div id="repeatEndDate" class="input-append">
				   			 <input class="span2" data-format="yyyy-MM-dd" type="text" name="repeatEndDate" value="<?php echo $_smarty_tpl->tpl_vars['repeatEndDate']->value;?>
"></input>
				     	          	<span class="add-on">
				      	      			<i data-time-icon="icon-time" data-date-icon="icon-calendar">
					      			</i>
					        		 </span>
						 </div><small> (Leave blank for never ending events)</small>
					</div>
				</div>
			   </div>
	</div>	

	<!-- Venue -->

	<div class="well" id="event-venue">

			<h4>Event Location Details</h4>
<div class="row">
	<div class="span5">
			<div class="control-group">
				<label class="control-label" for="eventLocation">Location?</label>
					<div class="controls">
						<select class="input-xlarge" name="eventLocation" id="eventLocation" onChange="javascript:locationChanged(this);"><option value="new">Use New Location</option>
						<?php  $_smarty_tpl->tpl_vars['location'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['location']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['locations']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['location']->key => $_smarty_tpl->tpl_vars['location']->value){
$_smarty_tpl->tpl_vars['location']->_loop = true;
?> 
							<option data-address="<?php echo $_smarty_tpl->tpl_vars['location']->value['zAddress'];?>
" data-latlng="<?php echo $_smarty_tpl->tpl_vars['location']->value['sLat'];?>
, <?php echo $_smarty_tpl->tpl_vars['location']->value['sLon'];?>
"  data-name="<?php echo $_smarty_tpl->tpl_vars['location']->value['sName'];?>
"  data-city="<?php echo $_smarty_tpl->tpl_vars['location']->value['sCity'];?>
" data-state="<?php echo $_smarty_tpl->tpl_vars['location']->value['sState'];?>
" data-postalCode="<?php echo $_smarty_tpl->tpl_vars['location']->value['sZipcode'];?>
" data-phoneNumber="<?php echo $_smarty_tpl->tpl_vars['location']->value['sPhoneNumber'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['location']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['location']->value['sName'];?>
</option>
						<?php } ?>	
</select>
			</div>
		</div>
		<div class="control-group">
				<label class="control-label" for="locationName">Venue Name:</label>
				<div class="controls">			
					<input type="text" id="locationName" class="input-xlarge newLocation" name="locationName" size="128" value="<?php echo $_smarty_tpl->tpl_vars['locationName']->value;?>
">
				</div>
		</div>
		<div class="control-group">			
				<label class="control-label" for="newAddress">Address:</label>
				<div class="controls">
					<input type="text" class="input-xlarge newLocation" id="newAddress" name="newAddress" size="128" value="<?php echo $_smarty_tpl->tpl_vars['newAddress']->value;?>
" onBlur="javascript:canGeocode();">
				</div>
		</div>
		<div class="control-group">	
				<label class="control-label" for="city">City:</label>
				<div class="controls">
					<input type="text" id="newCity" class="newLocation" name="newCity" size="25" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['newLocation']->value)===null||$tmp==='' ? "Jacksonville" : $tmp);?>
"></td>
				</div>
		</div>
		<div class="control-group">	
				<label class="control-label" for="country">Country:</label>
				<div class="controls">
					<input type="text" id="newCountry" class="newLocation" name="newCountry" size="25" value="USA" readonly></td>
				</div>
		</div>
		<div class="control-group">	
				<label class="control-label" for="state">State:</label>
				<div class="controls">
					<select class="newLocation" id="newState" name="newState" style="">
					<option value="">Select a State</option>
					<option value="AL">Alabama</option>
					<option value="AK">Alaska</option>
					<option value="AZ">Arizona</option>
					<option value="AR">Arkansas</option>
					<option value="CA">California</option>
					<opt	ion value="CO">Colorado</option>
					<option value="CT">Connecticut</option>
					<option value="DE">Delaware</option>
					<option value="DC">District of Columbia</option>
					<option value="FL">Florida</option>
					<option value="GA">Georgia</option>
					<option value="HI">Hawaii</option>
					<option value="ID">Idaho</option>
					<option value="IL">Illinois</option>
					<option value="IN">Indiana</option>
					<option value="IA">Iowa</option>
					<option value="KS">Kansas</option>
					<option value="KY">Kentucky</option>
					<option value="LA">Louisiana</option>
					<option value="ME">Maine</option>
					<option value="MD">Maryland</option>
					<option value="MA">Massachusetts</option>
					<option value="MI">Michigan</option>
					<option value="MN">Minnesota</option>
					<option value="MS">Mississippi</option>
					<option value="MO">Missouri</option>
					<option value="MT">Montana</option>
					<option value="NE">Nebraska</option>
					<option value="NV">Nevada</option>
					<option value="NH">New Hampshire</option>
					<option value="NJ">New Jersey</option>
					<option value="NM">New Mexico</option>
					<option value="NY">New York</option>
					<option value="NC">North Carolina</option>
					<option value="ND">North Dakota</option>
					<option value="OH">Ohio</option>
					<option value="OK">Oklahoma</option>
					<option value="OR">Oregon</option>
					<option value="PA">Pennsylvania</option>
					<option value="RI">Rhode Island</option>
					<option value="SC">South Carolina</option>
					<option value="SD">South Dakota</option>
					<option value="TN">Tennessee</option>
					<option value="TX">Texas</option>
					<option value="UT">Utah</option	
					<option value="VT">Vermont</option>
					<option value="VA">Virginia</option>
					<option value="WA">Washington</option>
					<option value="WV">West Virginia</option>
					<option value="WI">Wisconsin</option>
					<option value="WY">Wyoming</option>
				</select>
			</div>
		</div>
		<div class="control-group">
				<label class="control-label" for="postalCode">Postal Code:</label>
				<div class="controls">			
					<input type="text" class="input-small newLocation" id="newPostalCode" name="newPostalCode" size="10" value="<?php echo $_smarty_tpl->tpl_vars['newPostalCode']->value;?>
">
				</div>
		</div>
		<div class="control-group">
				<label class="control-label" for="newPhone">Phone:</label>
				<div class="controls">			
					<input type="text" id="newPhone" class="newLocation" name="newPhone" size="25" value="<?php echo $_smarty_tpl->tpl_vars['newPhone']->value;?>
">
				</div>
		</div>		
	
	</div>
	<div class="span4 pull-right" style="height: 400px; border: 1px solid #ccc;">
		<input type="hidden" id="newLocationLatitude" class="newLocation" name="newLatitutde"  value="<?php echo $_smarty_tpl->tpl_vars['newLatitude']->value;?>
">
		<input type="hidden" id="newLocationLongitude" class="newLocation" name="newLongitude" value="<?php echo $_smarty_tpl->tpl_vars['newLongitude']->value;?>
">
		<div id="map-canvas" style="height: 400px; max-width: none; width: 100%;">
		</div>
	</div>
</div>
</div>
	
<!-- Organizer -->
<div class="well" id="event_organizer">

	<h4>Event Organizer Details</h4>
				<div class="control-group">	
				<label class="control-label" for="saved_organizer">Use Saved Organizer?</label>
				<div class="controls">
				<select class="input-xxlarge" name="organizerID" id="saved_organizer" >
					<option value="0">Use New Organizer</option>
					<?php  $_smarty_tpl->tpl_vars['organizer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['organizer']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['organizers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['organizer']->key => $_smarty_tpl->tpl_vars['organizer']->value){
$_smarty_tpl->tpl_vars['organizer']->_loop = true;
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['organizer']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['organizer']->value['name'];?>
</option>
					<?php } ?>
				</select>
				</div>
			</div>			
			<div class="control-group">	
				<label class="control-label" for="organizer">Name:</label>
				<div class="controls">
					<input type="text" class="input-xlarge" id="Organizer" name="organizerName" size="50" value="<?php echo $_smarty_tpl->tpl_vars['organizerName']->value;?>
">
				</div>
			</div>
			<div class="control-group">	
				<label class="control-label" for="state">Phone:</label>
				<div class="controls">
					<input type="text"  id="OrganizerPhone" name="organizerPhone" size="25" value="<?php echo $_smarty_tpl->tpl_vars['organizerPhone']->value;?>
">
				</div>
			</div>

			<div class="control-group">	
				<label class="control-label" for="organizerWebsite">Website:</label>
				<div class="controls">
					<input type="text" class="input-xlarge" id="OrganizerWebsite" name="organizerWebsite" size="100" value="<?php echo $_smarty_tpl->tpl_vars['organizerWebsite']->value;?>
">
				</div>
			</div>
			<div class="control-group">	
				<label class="control-label" for="organizerEmail">Email:</label>
				<div class="controls">
					<input type="text" class="input-xlarge" id="OrganizerEmail" name="organizerEmail" size="255" value="<?php echo $_smarty_tpl->tpl_vars['organizerEmail']->value;?>
">
				</div>
			</div> <!-- #event_organizer -->

</div>
	
<!-- Event Website -->

<div class="well" id="event_url">

	<h4>Event Website</h4>

			<div class="control-group">	
				<label class="control-label" for="eventurl">URL:</label>
				<div class="controls">	
					<input type="text" class="input-xxlarge" id="EventURL" name="eventURL" size="25" value="<?php echo $_smarty_tpl->tpl_vars['eventURL']->value;?>
">
				</div>
			</div> <!-- .website -->
			<div class="control-group">	
				<label class="control-label" for="eventurl">Facebook:</label>
				<div class="controls">	
					<input type="text" class="input-xxlarge" id="EventFacebookURL" name="eventFacebookURL" size="25" value="<?php echo $_smarty_tpl->tpl_vars['eventFacebookURL']->value;?>
">
				</div>
			</div> <!-- .website -->
			<div class="control-group">	
				<label class="control-label" for="eventurl">Foursquare:</label>
				<div class="controls">	
					<input type="text" class="input-xxlarge" id="EventFourSquareURL" name="eventFoursquareURL" size="25" value="<?php echo $_smarty_tpl->tpl_vars['eventFoursquareURL']->value;?>
">
				</div>
			</div> <!-- .website -->
</div>


	
<!-- Custom -->
<div class="well" id="event-custom">
	<h4>Sharing</h4>
	<div class="margin-left: 30px;" style="padding-bottom: 30px; position: relative; left: 30px; white-space: wrap; overflow: hidden; margin-right: 20px;">
		<label class="checkbox">
			  <input type="checkbox" value="yes" name="sharing" id="sharing">
		  	  Yes, I would you like this event to be featured or shared on our social media outlets.
		</label>
		<label class="checkbox">
			  <input type="checkbox" value="yes" name="sponsored" id="sponsored">
		  	  Please have someone contact me about making this a featured/sponsored event.
		</label>
	</div>	
</div><!-- #event-custom -->

	
<!-- Event Cost -->

<div class="well" id="event_cost">

	<h4>Event Cost</h4>
		
	<div class="control-group">	
				<label class="control-label" for="eventCost" >Cost:</label>
				<div class="controls">				
					<div class="input-prepend input-append">
						  <span class="add-on">$</span>						  <input type="text" id="EventCost" name="eventCost" class="input input-small" value="<?php echo $_smarty_tpl->tpl_vars['eventCost']->value;?>
">
					</div><div style="white-space: nowrap; overflow: hidden;"><small> (Leave blank to hide the field. Enter a 0 for events that are free.) </small></div>
				</div>
	</div><!-- #event_cost -->
			<div class="control-group">	
				<label class="control-label" for="eventurl">Ticketing URL:</label>
				<div class="controls">	
					<input type="text" class="input-xxlarge" id="EventTicketingURL" name="ticketURL" size="25" value="<?php echo $_smarty_tpl->tpl_vars['ticketURL']->value;?>
">
				</div>
			</div> <!-- .website -->
</div><!-- event-cost -->

	<?php if (count($_smarty_tpl->tpl_vars['calendars']->value)>=1){?>

	<div class="well" id="event_calendar">
			<h4 class="event-time">Add to Calendar:</h4>

			<div class="control-group" style="margin-left: 30px;">
					<?php  $_smarty_tpl->tpl_vars['calendar'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['calendar']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['calendars']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['calendar']->key => $_smarty_tpl->tpl_vars['calendar']->value){
$_smarty_tpl->tpl_vars['calendar']->_loop = true;
?>
			        			<div class="span10">
			            		<label class="radio" for="calendar-<?php echo $_smarty_tpl->tpl_vars['calendar']->value['id'];?>
"><input type="radio" name="calendarID" value="<?php echo $_smarty_tpl->tpl_vars['calendar']->value['id'];?>
" id="calendar-<?php echo $_smarty_tpl->tpl_vars['calendar']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['calendar']->value['isSelected']){?>checked<?php }?>> <?php echo $_smarty_tpl->tpl_vars['calendar']->value['sName'];?>
 </label>
					        </div>
					<?php }
if (!$_smarty_tpl->tpl_vars['calendar']->_loop) {
?>
			        			<div class="span10">
			            		<label class="radio" for="calendar-<?php echo $_smarty_tpl->tpl_vars['calendar']->value['id'];?>
"><input type="radio" name="calendarID" value="" id="calendar-<?php echo $_smarty_tpl->tpl_vars['calendar']->value['id'];?>
" checked> Default Calendar</label>
					        </div>
					<?php } ?>
				
			</div>
	</div><!-- event-calendar -->

	<?php }?>

	<?php if (count($_smarty_tpl->tpl_vars['calendars']->value)<1){?>

	<div class="well" id="event_calendar_default">
			<center><h5 class="event-time">This event will be added to the default calendar.</h5></center>

					<input type="hidden" name="calendarID" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['calendarID']->value)===null||$tmp==='' ? "0" : $tmp);?>
">

	</div><!-- event-calendar_default -->
	
	<?php }?>

	<div class="well">
	<table class="" cellspacing="0" cellpadding="0">
		<tbody><tr>
			<td colspan="2" class="tribe_sectionheader">
				<h4>Keywords or Tags</h4>
			</td><!-- .tribe_sectionheader -->
		</tr>
		<tr>
			<td>
				<input type="text" class="input-xxlarge" name="tags" id="eventTags" value="<?php echo $_smarty_tpl->tpl_vars['tags']->value;?>
">
			</td>
		</tr>
		</tbody>
		</table>		
	</div>

	<!-- Form Submit -->
		<div class="event-submit">
		<?php if ($_smarty_tpl->tpl_vars['canSubmit']->value){?>
			<input type="submit" id="post" class="btn btn-success" value="Submit Event" name="submit" <?php if ($_smarty_tpl->tpl_vars['submitDisabled']->value){?>disabled<?php }?>>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['canUpdateThis']->value){?>
			<input type="submit" id="post" class="btn btn-success disabled" value="Update Just This Event" name="copy" <?php if ($_smarty_tpl->tpl_vars['updateThisDisabled']->value){?>disabled<?php }?>>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['canUpdateAll']->value){?>
			<input type="submit" id="post" class="btn btn-success disabled" value="Update All Events" name="copy" <?php if ($_smarty_tpl->tpl_vars['updateAllDisabled']->value){?>disabled<?php }?>>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['canSave']->value){?>
			<input type="submit" id="post" class="btn btn-primary" value="Save Event" name="copy" <?php if ($_smarty_tpl->tpl_vars['saveDisabled']->value){?>disabled<?php }?>>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['canCopy']->value){?>
			<input type="submit" id="post" class="btn btn-default" value="Copy Event" name="copy" <?php if ($_smarty_tpl->tpl_vars['copyDisabled']->value){?>disabled<?php }?>>
		<?php }?>

	</div>
	
</form>



<script type="text/javascript">





$(function () {
    'use strict';
    var url = 'https://onecal.co/calendar/uploader/index.php';
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo('#files');
            });
      },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#file-upload-progress').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');

	<?php if ($_smarty_tpl->tpl_vars['eventLocation']->value){?>
		$("#eventLocation").val("<?php echo $_smarty_tpl->tpl_vars['eventLocation']->value;?>
");
		locationChanged("<?php echo $_smarty_tpl->tpl_vars['eventLocation']->value;?>
");
	<?php }elseif($_smarty_tpl->tpl_vars['lastLocationID']->value){?>
		$("#eventLocation").val("<?php echo $_smarty_tpl->tpl_vars['lastLocationID']->value;?>
");
		locationChanged("<?php echo $_smarty_tpl->tpl_vars['lastLocationID']->value;?>
");
	<?php }?>	

  $("#buzz-event-loading").hide();
  $("#buzz-event-form").show();

});

function canGeocode() {
	var newAddress = $("#newAddress").val();
	codeAddress(newAddress);
}

function locationChanged(location) {
	if ($("#eventLocation").val()=="new") {
		$(".newLocation").prop("disabled", false);
		$("#locationName").val("");
		$("#newAddress").val("");
		$("#newCity").val("");
		$("#newState").val("");
		$("#newPostalCode").val("");
		$("#newPhone").val("");
	}
	else {
		$(".newLocation").prop("disabled", true);
		codeAddress($("#eventLocation").find('option:selected').data("address"));
		$("#locationName").val($("#eventLocation").find('option:selected').data("name"));
		$("#newAddress").val($("#eventLocation").find('option:selected').data("address"));
		$("#newCity").val($("#eventLocation").find('option:selected').data("city"));
		$("#newState").val($("#eventLocation").find('option:selected').data("state"));
		$("#newPostalCode").val($("#eventLocation").find('option:selected').data("postalcode"));
		$("#newPhone").val($("#eventLocation").find('option:selected').data("phonenumber"));
	}
}


  var startDate = new Date(Date.UTC(2014, 01,01, 12,00));
  var maxDate = new Date(Date.UTC(2019, 12, 31, 23, 59));

  $(function() {
    $('#repeatEndDate').datetimepicker({
      language: 'en',
      pick12HourFormat: true,
      pickSeconds: false,
      pickTime: false
    });
  });
  $(function() {
    $('#EventStartDate').datetimepicker({
      language: 'en',
      pickTime: false,
      startDate: new Date(2014, 1, 1),
      endDate: new Date(2019, 12, 31)
    });
  });
    $(function() {
    $('#EventEndDate').datetimepicker({
      language: 'en',
      pickTime: false,
      startDate: new Date(2014, 1, 1),
      endDate: new Date(2019, 12, 31)
    });
  });

$('#EventStartDate').on('changeDate', function(e) {

  setToStartDate(new Date(2013,7,29));

});


  function setToStartDate(startDate) {
      $('#EventEndDate').datetimepicker({
      startDate: this.startDate
   });

  }

function daysChanged(button) {

//	$(button).addClass("active");

}

function getDays() {

	var eventDaysBinaryStr="";
	var eventDaysBinary=0;

	if ($("#eventDays-1").hasClass("active")) {
		eventDaysBinary += 1;
		eventDaysBinaryStr = "1";
	}
	else {
		eventDaysBinaryStr = "0";	
	}

	if ($("#eventDays-2").hasClass("active")) {
		eventDaysBinary += 2;
		eventDaysBinaryStr += "1";
	}
	else {
		eventDaysBinaryStr += "0";	
	}

	if ($("#eventDays-3").hasClass("active")) {
		eventDaysBinary += 4;
		eventDaysBinaryStr += "1";
	}
	else {
		eventDaysBinaryStr += "0";	
	}

	if ($("#eventDays-4").hasClass("active")) {
		eventDaysBinary += 8;
		eventDaysBinaryStr += "1";
	}
	else {
		eventDaysBinaryStr += "0";	
	}

	if ($("#eventDays-5").hasClass("active")) {
		console.log("Thursday checked");
		eventDaysBinary += 16;
		eventDaysBinaryStr += "1";
	}
	else {
		eventDaysBinaryStr += "0";	
	}

	if ($("#eventDays-6").hasClass("active")) {
		console.log("Friday checked");
		eventDaysBinary += 32;
		eventDaysBinaryStr += "1";
	}
	else {
		eventDaysBinaryStr += "0";	
	}

	if ($("#eventDays-7").hasClass("active")) {
		console.log("Saturday checked");
		eventDaysBinary += 64;
		eventDaysBinaryStr += "1";
	}
	else {
		eventDaysBinaryStr += "0";	
	}
	
	$("#eventDaysBinary").val(eventDaysBinary);
	$("#eventDaysBinaryStr").val(eventDaysBinaryStr);

}

function reverse(s){
    return s.split("").reverse().join("");
}

/**
*
*  Javascript string pad
*  http://www.webtoolkit.info/
*
**/
  
function pad(str, len, pad, dir) {
 
	var STR_PAD_LEFT = 1;
	var STR_PAD_RIGHT = 2;
	var STR_PAD_BOTH = 3;

    if (typeof(len) == "undefined") { var len = 0; }
    if (typeof(pad) == "undefined") { var pad = ' '; }
    if (typeof(dir) == "undefined") { var dir = STR_PAD_RIGHT; }
 
    if (len + 1 >= str.length) {
 
        switch (dir){
 
            case STR_PAD_LEFT:
                str = Array(len + 1 - str.length).join(pad) + str;
            break;
 
            case STR_PAD_BOTH:
                var right = Math.ceil((padlen = len - str.length) / 2);
                var left = padlen - right;
                str = Array(left+1).join(pad) + str + Array(right+1).join(pad);
            break;
 
            default:
                str = str + Array(len + 1 - str.length).join(pad);
            break;
 
        } // switch
 
    }
 
    return str;
 
}

function setDays(eventDaysBinary) {

	var binaryStr = pad(reverse((eventDaysBinary).toString(2)),7,"0",2);

	if (binaryStr[0]==1) {
		$("#eventDays-1").addClass("active");
	}

	if (binaryStr[1]==1) {
		$("#eventDays-2").addClass("active");
	}

	if (binaryStr[2]==1) {
		$("#eventDays-3").addClass("active");
	}

	if (binaryStr[3]==1) {
		$("#eventDays-4").addClass("active");
	}

	if (binaryStr[4]==1) {
		$("#eventDays-5").addClass("active");
	}

	if (binaryStr[5]==1) {
		$("#eventDays-6").addClass("active");
	}

	if (binaryStr[6]==1) {
		$("#eventDays-7").addClass("active");
	}
}


function getMonthDays() {

	var eventMonthDaysBinaryStr="";
	var eventMonthDaysBinary=0;

	if ($("#eventMonthDays-1").hasClass("active")) {
		eventMonthDaysBinary += 1;
		eventMonthDaysBinaryStr = "1";
	}
	else {
		eventMonthDaysBinaryStr = "0";	
	}

	if ($("#eventMonthDays-2").hasClass("active")) {
		eventMonthDaysBinary += 2;
		eventMonthDaysBinaryStr += "1";
	}
	else {
		eventMonthDaysBinaryStr += "0";	
	}

	if ($("#eventMonthDays-3").hasClass("active")) {
		console.log("Tuesday checked");
		eventMonthDaysBinary += 4;
		eventMonthDaysBinaryStr += "1";
	}
	else {
		eventMonthDaysBinaryStr += "0";	
	}

	if ($("#eventMonthDays-4").hasClass("active")) {
		eventMonthDaysBinary += 8;
		eventMonthDaysBinaryStr += "1";
	}
	else {
		eventMonthDaysBinaryStr += "0";	
	}

	if ($("#eventMonthDays-5").hasClass("active")) {
		eventMonthDaysBinary += 16;
		eventMonthDaysBinaryStr += "1";
	}
	else {
		eventMonthDaysBinaryStr += "0";	
	}

	if ($("#eventMonthDays-6").hasClass("active")) {
		eventMonthDaysBinary += 32;
		eventMonthDaysBinaryStr += "1";
	}
	else {
		eventMonthDaysBinaryStr += "0";	
	}

	if ($("#eventMonthDays-7").hasClass("active")) {
		eventMonthDaysBinary += 64;
		eventMonthDaysBinaryStr += "1";
	}
	else {
		eventMonthDaysBinaryStr += "0";	
	}
	
	$("#eventMonthDaysBinary").val(eventMonthDaysBinary);
	$("#eventMonthDaysBinaryStr").val(eventMonthDaysBinaryStr);

}


function setMonthDays(eventDaysBinary) {

	var binaryStr = pad(reverse((eventDaysBinary).toString(2)),7,"0",2);

	if (binaryStr[0]==1) {
		$("#eventMonthDays-1").addClass("active");
	}

	if (binaryStr[1]==1) {
		$("#eventMonthDays-2").addClass("active");
	}

	if (binaryStr[2]==1) {
		$("#eventMonthDays-3").addClass("active");
	}

	if (binaryStr[3]==1) {
		$("#eventMonthDays-4").addClass("active");
	}

	if (binaryStr[4]==1) {
		$("#eventMonthDays-5").addClass("active");
	}

	if (binaryStr[5]==1) {
		$("#eventMonthDays-6").addClass("active");
	}

	if (binaryStr[6]==1) {
		$("#eventMonthDays-7").addClass("active");
	}
}


function processEvent() {
	
	getDays();
	getMonthDays();

	return true;

}

function minusButton(fieldID,floor) {
	
	var currentValue = document.getElementById(fieldID).value;
	if (currentValue>floor) {
		currentValue--;
	}
	document.getElementById(fieldID).value=currentValue;

}

function plusButton(fieldID,ceiling) {
	var currentValue = document.getElementById(fieldID).value;
	if (currentValue<ceiling) {
		currentValue++;
	}
	document.getElementById(fieldID).value=currentValue;
}

function changeFreq() {
	if ($("#eventFrequency").val() == "Hourly") {
		$("#eventRepeats-WhichDays").hide();
		$("#eventRepeats-EndDate").show();
		$("#eventRepeats-Custom").hide();
		$("#eventRepeats-Annually").hide();
		$("#eventRepeats-Monthly").hide();
		$('#repeatStr').html("hour(s)");
		$("#eventRepeats-RepeatFreq").show();
		$("#eventRepeats-Exception").hide();
	} 
	else if ($("#eventFrequency").val() == "Daily") {
		$("#eventRepeats-WhichDays").hide();
		$("#eventRepeats-EndDate").show();
		$("#eventRepeats-Annually").hide();
		$("#eventRepeats-Custom").hide();
		$("#eventRepeats-Monthly").hide();
		$('#repeatStr').html("day(s)");
		$("#eventRepeats-RepeatFreq").show();
		$("#eventRepeats-Exception").show();
	} 
	else if ($("#eventFrequency").val() == "Weekly") {
		$("#eventRepeats-WhichDays").show();
		$("#eventRepeats-Custom").hide();
		$("#eventRepeats-EndDate").show();
		$("#eventRepeats-Annually").hide();
		$("#eventRepeats-Monthly").hide();
		$('#repeatStr').html("week(s)");
		$("#eventRepeats-RepeatFreq").show();
		$("#eventRepeats-Exception").show();
	} 	
	else if ($("#eventFrequency").val() == "Monthly") {
		$("#eventRepeats-WhichDays").hide();
		$("#eventRepeats-Custom").hide();
		$("#eventRepeats-Monthly").show();
		$("#eventRepeats-Annually").hide();
		$("#eventRepeats-EndDate").show();
		$('#repeatStr').html("month(s)");
		$("#eventRepeats-RepeatFreq").show();
		$("#eventRepeats-Exception").show();
	} 
	else if ($("#eventFrequency").val() == "Annually") {
		$("#eventRepeats-Custom").hide();
		$("#eventRepeats-WhichDays").hide();
		$("#eventRepeats-Annually").show();
		$("#eventRepeats-Monthly").hide();
		$("#eventRepeats-EndDate").show();
		$('#repeatStr').html("year(s)");
		$("#eventRepeats-RepeatFreq").show();
		$("#eventRepeats-Exception").show();
	} 
	else if ($("#eventFrequency").val() == "Custom") {
		$("#eventRepeats-WhichDays").hide();
		$("#eventRepeats-Custom").show();
		$("#eventRepeats-Annually").hide();
		$("#eventRepeats-Monthly").hide();
		$("#eventRepeats-EndDate").show();
		$('#repeatStr').html("");
		$("#eventRepeats-RepeatFreq").hide();
		$("#eventRepeats-Exception").hide();
	} 
	else {
		$("#eventRepeats-Exception").hide();
		$("#eventRepeats-Custom").hide();
		$("#eventRepeats-WhichDays").hide();
		$("#eventRepeats-EndDate").hide();
		$("#eventRepeats-RepeatFreq").hide();
		$("#eventRepeats-Annually").hide();
		$("#eventRepeats-Monthly").hide();
	}
}

function allDayChanged() {

	var isAllDay = $("#allDayCheckbox").prop("checked");

	if (isAllDay) {
		$("#startHour").prop("disabled",true);
		$("#startHour").hide();
		$("#startMinute").prop("disabled",true);
		$("#startMinute").hide();
		$("#startMeridian").prop("disabled",true);
		$("#startMeridian").hide();

		$("#endHour").prop("disabled",true);
		$("#endHour").hide();
		$("#endMinute").prop("disabled",true);
		$("#endMinute").hide();
		$("#endMeridian").prop("disabled",true);
		$("#endMeridian").hide();
	}
	else {
		$("#startHour").prop("disabled",false);
		$("#startHour").show();
		$("#startMinute").prop("disabled",false);
		$("#startMinute").show();
		$("#startMeridian").prop("disabled",false);
		$("#startMeridian").show();

		$("#endHour").prop("disabled",false);
		$("#endHour").show();
		$("#endMinute").prop("disabled",false);
		$("#endMinute").show();
		$("#endMeridian").prop("disabled",false);
		$("#endMeridian").show();
	}
}

function populateForm() {

	<?php if ($_smarty_tpl->tpl_vars['eventCategories']->value){?> 
		var eventCategories = <?php echo $_smarty_tpl->tpl_vars['eventCategories']->value;?>
;
	
	 	$.each(eventCategories, function(index, value) {
			var categoryID = "#category-" + value.toString();
	        		$(categoryID).prop("checked",true);
	         });
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['eventAllDay']->value){?>
		$("#allDayCheckbox").prop("checked",true);
		allDayChanged();
	<?php }?>
	
	$("#startHour").val("<?php echo $_smarty_tpl->tpl_vars['startHour']->value;?>
");
	$("#startMinute").val("<?php echo $_smarty_tpl->tpl_vars['startMinute']->value;?>
");
	$("#startMeridian").val("<?php echo $_smarty_tpl->tpl_vars['startMeridian']->value;?>
");
	$("#endHour").val("<?php echo $_smarty_tpl->tpl_vars['endHour']->value;?>
");
	$("#endMinute").val("<?php echo $_smarty_tpl->tpl_vars['endMinute']->value;?>
");
	$("#endMeridian").val("<?php echo $_smarty_tpl->tpl_vars['endMeridian']->value;?>
");

	<?php if ($_smarty_tpl->tpl_vars['repeatFrequency']->value){?> 
	
		$("#eventFrequency").val("<?php echo $_smarty_tpl->tpl_vars['repeatFrequency']->value;?>
");
		$("#repeatEvery").val("<?php echo $_smarty_tpl->tpl_vars['repeatEvery']->value;?>
");
		$("#repeatMonthDayNumber").val("<?php echo $_smarty_tpl->tpl_vars['repeatMonthDayNumber']->value;?>
");
		$("#repeatMonthWeek").val("<?php echo $_smarty_tpl->tpl_vars['repeatMonthWeek']->value;?>
");
		$("#repeatAnnualMonth1").val("<?php echo $_smarty_tpl->tpl_vars['repeatAnnualMonth1']->value;?>
");
		$("#repeatAnnualDayNumber").val("<?php echo $_smarty_tpl->tpl_vars['repeatAnnualDayNumber']->value;?>
");
		$("#repeatAnnualMonth2").val("<?php echo $_smarty_tpl->tpl_vars['repeatAnnualMonth2']->value;?>
");
		$("#repeatAnnualDayOfWeek").val("<?php echo $_smarty_tpl->tpl_vars['repeatAnnualDayOfWeek']->value;?>
");
		$("#repeatAnnualWeek").val("<?php echo $_smarty_tpl->tpl_vars['repeatAnnualWeek']->value;?>
");
		changeFreq();
	<?php }?>

	$("#newState").val("<?php echo $_smarty_tpl->tpl_vars['newState']->value;?>
");

	<?php if ($_smarty_tpl->tpl_vars['sharing']->value){?> 
		$("#sharing").prop("checked",true);
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['sponsored']->value){?>
		$("#sponsored").prop("checked",true);
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['repeatDaysBinaryStr']->value){?>
		setDays(<?php echo $_smarty_tpl->tpl_vars['repeatDaysBinary']->value;?>
);
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['repeatMonthDaysBinaryStr']->value){?>
		setMonthDays(<?php echo $_smarty_tpl->tpl_vars['repeatMonthDaysBinary']->value;?>
);
	<?php }?>

	console.log("Monthly: <?php echo $_smarty_tpl->tpl_vars['repeatMonth']->value;?>
");

	<?php if ($_smarty_tpl->tpl_vars['repeatMonth']->value){?>
		$("#repeatMonth-<?php echo $_smarty_tpl->tpl_vars['repeatMonth']->value;?>
").prop("checked",true);
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['repeatAnnual']->value){?>
		$("#repeatAnnual-<?php echo $_smarty_tpl->tpl_vars['repeatAnnual']->value;?>
").prop("checked", true);
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['repeat']->value){?>
		var repeat = <?php echo $_smarty_tpl->tpl_vars['repeat']->value;?>
;
	<?php }?>
}

populateForm();

</script>

<script type="text/javascript">

	  
	$( document ).ready(function() {
	
		var map; 
    		     function initialize() {
        			var mapOptions = {
 		         center: new google.maps.LatLng(30.3369, -81.6614),
 		         zoom: 10,
  			panControl: false,
  			zoomControl: true,
  			mapTypeControl: true,
  			scaleControl: true,
 			 streetViewControl: true,
 			 overviewMapControl: false			
        		      };
		      map = new google.maps.Map(document.getElementById("map-canvas"),
		            mapOptions);
		      }
		      google.maps.event.addDomListener(window, 'load', initialize);
	});

 			function codeAddress(address) {
				var map;

			      geocoder = new google.maps.Geocoder();

			    geocoder.geocode( { 'address': address}, function(results, status) {
			      if (status == google.maps.GeocoderStatus.OK) {
			        map.setCenter(results[0].geometry.location);
			        var marker = new google.maps.Marker({
			            map: map,
			            position: results[0].geometry.location
			        });
				map.setZoom(15);
			      } else {
	     				alert("Geocode was not successful for the following reason: " + status);
		      		}
			    });
			  }

</script>	
<?php }} ?>