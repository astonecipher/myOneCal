{extends file="db:CAL_DASHBOARD"}

{block name="header-css"}
	<link media="all" rel="stylesheet" type="text/css" href="/assets/css/bootstrap-datetimepicker.min.css" />
	<link media="all" rel="stylesheet" type="text/css" href="/css/bootstrap-switch.css" />

{/block}

{block name="header-js"}

{/block}

{block name="body"}
<form method="post" name="eventAdd" action="event/{$formAction|default:"add"}">

		<div class="row">
			{if $alertSuccess}<div class="col-md-8 alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>{$successMsg}</div>{/if}
			{if $alertInfo}<div class="col-md-8 alert alert-info"><button type="button" class="close" data-dismiss="alert">&times;</button>{$infoMsg}</div>{/if}
			{if $alertWarning}<div class="col-md-8 alert alert-warning"><button type="button" class="close" data-dismiss="alert">&times;</button>{$warningMsg}</div>{/if}
			{if $alertError}<div class="col-md-8 alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>{$errorMsg}</div>{/if}
		</div>
		<div class="row">
			<div class="col-md-4">
				<label>Title</label>
				<input type="text" class="col-md-4" placeholder="1 Event Title" name="eventTitle" value="{$eventTitle}">
			</div>		  
			<div class="col-md-4">
			    	<label>Category</label>
				<select id="category" name="category" class="col-md-4">
					{foreach $categories as $category}
						<option value="{$category.id}">{$category.name}</option>
					{/foreach}
				</select>			
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
	 			<label>Starts?</label>
				<div id="datetimepicker-from"  class="input-append" style="">
				    <input class="col-md-2" data-format="yyyy-MM-dd HH:mm PP" type="text" name="startDateTime" value="{$startDateTime}"></input>
				    <span class="add-on ">
				      <i data-time-icon="glyphicon glyphicon-time" data-date-icon="glyphicon glyphicon-calendar">
				      </i>
				    </span>
				 </div>
			</div>
	
			<div class="col-md-3">
 				<label>Ends?</label>
				<div id="datetimepicker-to" class="input-append">
				    <input class="col-md-2" data-format="yyyy-MM-dd HH:mm PP" type="text" name="endDateTime" value="{$endDateTime}"></input>
				    <span class="add-on">
				      <i data-time-icon="glyphicon glyphicon-time" data-date-icon="glyphicon glyphicon-calendar">
				      </i>
				    </span>
				 </div>
			</div>

			<div class="col-md-2">
				<label>Repeats?</label>
				<div id="recurring-switch" class="make-switch" data-on-label="Yes" data-off-label="No" style="margin-bottom: 10px;" data-on="success">
				    <input type="checkbox" id="repeatCheckbox" onChange="javascript:toggleRecurring(this);" name="eventRepeats" value="yes" {if $eventRepeats}checked{/if}>
				</div>
			</div>

		</div>

		<div class="row">
		<br>
			<div class="well col-md-7 hide" id="recurring">
	
				<div class="col-md-2">
					<label>How Often?</label>
					<select name="repeatFreq" class="span2" id="repeatFreq">
						<option value="D">Daily</option>
						<option value="W">Weekly</option>
						<option value="M">Monthly</option>
					 </select>
				</div>

				<div class="col-md-2 hide" id="daily">
					<label>When</label>
					<select name="repeatWhen" class="span2" id="repeatWhenDaily">
						<option value="E">Every Day</option>
						<option value="O">Every Other Day</option>
					 </select>
				</div>

				<div class="col-md-2 hide" id="weekly">
					<label>When</label>
					<select name="repeatWhen" class="span2" id="repeatWhenWeekly">
						<option value="E">Every Week</option>
						<option value="O">Every Other Week</option>
						<option value="EW">Every Weekend</option>
						<option value="EOW">Every  Other Weekend</option>
					 </select>
				</div>

				<div class="col-md-2 hide" id="monthly">
					<label>When</label>
					<select name="repeatWhen" class="span2" id="repeatWhenMonthly">
						<option value="1">1st</option>
						<option value="2">2nd</option>
						<option value="3">3rd</option>
						<option value="4">4th</option>
						<option value="L">Last</option>
					 </select>
					<label>Day</label>
					<select name="repeatDay" class="span2" id="repeatDayMonthly" >
						<option value="Sunday">Sunday</option>
						<option value="Monday">Monday</option>
						<option value="Tuesday">Tuesday</option>
						<option value="Wednesday">Wednesday</option>
						<option value="Thursday">Thursday</option>
						<option value="Friday">Friday</option>
						<option value="Saturday">Saturday</option>
					 </select>
				</div>
				<div class="col-md-2">
					<label>Stop Repeating?</label>
					<div id="datetimepicker-stop" class="input-append">
						    <input class="col-md-2" data-format="yyyy/MM/dd" type="text" name="stopRepeating" value="{$stopRepeating}"></input>
						    <span class="add-on">
						      		<i data-time-icon="glyphicon glyphicon-time" data-date-icon="glyphicon glyphicon-calendar">
							        </i>
						    </span>
					 </div>
				</div>
			</div>
		</div>

		<div class="row">
			<div id="locationBox" class="col-md-4">
				<label>Location</label>
				<select id="location" name="eventLocation" class="col-md-4">
					<option value="new">New Location</option>
					{foreach $locations as $location} 
						<option value="{$location.id}">{$location.sName}</option>
					{/foreach}
				</select>	
				<textarea name="newLocation" id="newLocation" class="input-xlarge col-md-4" rows="7" placeholder="Enter New Location Here" {$locationDisabled} {$locationReadOnly}>{$newLocation}</textarea>
				<input type="hidden" name="prevLocation" value="{$newLocation}">
			</div>
				
			<div class="col-md-4">

				<label>Brief Description</label>
				<textarea name="eventDescription" id="description" class="input-xxlarge col-md-4" style="resize: none;" rows="7">{$eventDescription}</textarea>

			</div>
			<div id="ticketed-switch" class="make-switch  col-md-4" data-on-label="Ticketed" data-off-label="Free / No Charge" data-on="success" data-off="primary" >
				    <input type="checkbox" name="eventTicketed"  id="eventTicketed" onChange="javascript:toggleTicketed(this);" value="yes" {if $eventTicketed}checked{/if}>
			</div>
		</div>
		<div class="row">&nbsp;
		</div>
		<div class="row">

		       <div class="well col-md-7 hide" id="ticketed">
					<div class="col-md-2">
					<label>Cost?</label>
					 <input type="text" class="money col-md-1" name="eventCost" placeholder="0.00" value="{$eventCost}">
					</div>
					<div class="col-md-3">
					<label>Ticketing Website:</label>
					 <input type="text" class="col-md-4" name="ticketURL" placeholder="http://" value="{$ticketURL}">
					</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-8">
				<label>Event Details</label>
				<textarea name="eventDetails" id="message" class="input-xlarge col-md-8" rows="7" name="eventDetails">{$eventDetails}</textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<label>Link to the Event:<label><input type="text" class="input-xlarge col-md-8" name="eventLink" placeholder="http://" value="{$eventLink}">
			</div>
		</div>
		<div class="row">

			<div class="col-md-8 centered">
				<p class="btn-toolbar pull-right">
					<input type="hidden" name="locationDisabled" value="{$locationDisabled}">
					<input type="hidden" name="locationReadOnly" value="{$locationReadOnly}">
					<input type="hidden" name="returnURL" value="{$returnURL}">
					<input type="hidden" name="categoryID" value="{$categoryID}">
					<input type="hidden" name="locationID" value="{$locationID}">
					<input type="hidden" name="action" value="{$action}">
					<input type="hidden" name="formAction" value="{$formAction}">
					<input type="hidden" name="eventID" value="{$eventID}">
					<input type="submit" class="btn btn-primary" name="submit" value="{$action}">
					<button class="btn" onClick="window.location.href='{$returnURL}';">Cancel</button>
				</p>
			</div>
		</div>
	</div>
</div>

</form>
{/block}

{block name="footer-scripts"}


{literal}
<script type="text/javascript" src="/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/js/jquery.bootstrap-money-field.js"></script>
<script type="text/javascript" src="/js/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="/js/bootstrap-transition.js"></script>


<script type="text/javascript">

  var options = {
     width: 80 // The css width to be applied to the textfield
  };
  $('.money').money_field(options); 


  var startDate = new Date(Date.UTC(2013, 08,27, 15,50));
  var maxDate = new Date(Date.UTC(1998, 10, 11, 4, 30));

  $(function() {
    $('#datetimepicker-from').datetimepicker({
      language: 'en',
      pick12HourFormat: true,
      pickSeconds: false,
    });
  });
  $(function() {
    $('#datetimepicker-to').datetimepicker({
      language: 'en',
      pick12HourFormat: true,
      pickSeconds: false,
      startDate: new Date(2013, 7, 20),
      endDate: new Date(2014, 12, 31)
    });
  });
    $(function() {
    $('#datetimepicker-stop').datetimepicker({
      language: 'en',
      pick12HourFormat: true,
      pickSeconds: false,
      pickTime: false,
      startDate: new Date(2013, 10, 01),
      endDate: new Date(2014, 12, 31)
    });
  });

$('#datetimepicker-from').on('changeDate', function(e) {
  console.log(e.date.toString());
  console.log(e.localDate.toString());
  setToStartDate(new Date(2013,7,29));

});


  function setToStartDate(startDate) {
     console.log("setToStartDate");
     $('#datetimepicker-to').datetimepicker({
      startDate: this.startDate
   });
  }

</script>

<script>
    $('.radio1').on('switch-change', function () {
        $('.radio1').bootstrapSwitch('toggleRadioState');
    });
    // or
    $('.radio1').on('switch-change', function () {
        $('.radio1').bootstrapSwitch('toggleRadioStateAllowUncheck');
    });
    // or
    $('.radio1').on('switch-change', function () {
        $('.radio1').bootstrapSwitch('toggleRadioStateAllowUncheck', false);
    });
</script>

{/literal}

<script type="text/javascript">
	$("#category").val("{$categoryID}");
	$("#location").val("{$locationID}");

	toggleRecurring(getElementById('repeatCheckbox'));
	toggleTicketed(getElementById('eventTicketed'));

	function toggleRecurring(checkbox) {
	

		if (checkbox.checked) {
			$('#recurring').slideDown();
		}
		else {
			$('#recurring').slideUp();
		}
	}

	function toggleTicketed(checkbox) {
	

		if (checkbox.checked) {
			$('#ticketed').slideDown();
		}
		else {
			$('#ticketed').slideUp();
		}
	}

</script>
{/block}