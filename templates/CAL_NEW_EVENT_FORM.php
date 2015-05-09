{extends file="db:CAL_WRAPPER"}

{block name="header-css"}
	<link media="all" rel="stylesheet" type="text/css" href="/css/bootstrap-datetimepicker.min.css" />
	<link media="all" rel="stylesheet" type="text/css" href="/css/bootstrap-switch.css" />

{/block}

{block name="header-js"}

{/block}

{block name="body"}
<form method="post" name="eventAdd" action="calendar/add">
<div class="container">
  <div class="row">
	<div class="span12">
		<div class="row">
			{if $alertSuccess}<div class="span8 alert alert-success">{$successMsg}</div>{/if}
			{if $alertInfo}<<div class="span8 alert alert-info">($infoMsg}</div>{/if}
			{if $alertWarning}<<div class="span8 alert alert-warning">{$warningMsg}</div>{/if}
			{if $alertError}<<div class="span8 alert alert-danger">{$errorMsg}</div>{/if}
		</div>
		<div class="row">
			<div class="span4">
				<label>Title</label>
				<input type="date" class="span4" placeholder="Event Title">
			</div>		  
			<div class="span4">
			    	<label>Category</label>
				<select id="category" name="category" class="span4">
					<option value="service">Dining</option>
					<option value="suggestions">Music & Concerts</option>
					<option value="product">Arts & Theater</option>
				</select>			
			</div>
		</div>
		<div class="row">
			<div class="span3">
	 			<label>Starts?</label>
				<div id="datetimepicker-from"  class="input-append" >
				    <input class="span2" data-format="yyyy/MM/dd HH:mm PP" type="text" name="startDateTime"></input>
				    <span class="add-on ">
				      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
				      </i>
				    </span>
				 </div>
			</div>
	
			<div class="span3">
 				<label>Ends?</label>
				<div id="datetimepicker-to" class="input-append">
				    <input class="span2" data-format="yyyy/MM/dd HH:mm PP" type="text" name="endDateTime"></input>
				    <span class="add-on">
				      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
				      </i>
				    </span>
				 </div>
			</div>

			<div class="span2">
				<label>Repeats?</label>
				<div id="recurring-switch" class="make-switch" data-on-label="Yes" data-off-label="No" style="margin-bottom: 10px;" data-on="success">
				    <input type="checkbox" onChange="javascript:$('#recurring').toggle('slide in');" name="eventRepeats">
				</div>
			</div>

		</div>

		<div class="row">
		<br>
			<div class="well span7  hide slide in" id="recurring">
	
				<div class="span2">
					<label>How Often?</label>
					<select name="repeatFreq" class="span2">
						<option value="D">Daily</option>
						<option value="W">Weekly</option>
						<option value="M">Monthly</option>
					 </select>
				</div>

				<div class="span2 hide" id="daily">
					<label>When</label>
					<select name="repeatWhen" class="span2">
						<option value="E">Every Day</option>
						<option value="O">Every Other Day</option>
					 </select>
				</div>

				<div class="span2 hide" id="weekly">
					<label>When</label>
					<select name="repeatWhen" class="span2">
						<option value="E">Every Week</option>
						<option value="O">Every Other Week</option>
						<option value="EW">Every Weekend</option>
						<option value="EOW">Every  Other Weekend</option>
					 </select>
				</div>

				<div class="span2 hide" id="monthly">
					<label>When</label>
					<select name="repeatWhen" class="span2">
						<option value="1">1st</option>
						<option value="2">2nd</option>
						<option value="3">3rd</option>
						<option value="4">4th</option>
						<option value="L">Last</option>
					 </select>
					<label>Day</label>
					<select name="repeatDay" class="span2">
						<option value="Sunday">Sunday</option>
						<option value="Monday">Monday</option>
						<option value="Tuesday">Tuesday</option>
						<option value="Wednesday">Wednesday</option>
						<option value="Thursday">Thursday</option>
						<option value="Friday">Friday</option>
						<option value="Saturday">Saturday</option>
					 </select>
				</div>
				<div class="span2">
					<label>Stop Repeating?</label>
					<div id="datetimepicker-stop" class="input-append">
						    <input class="span2" data-format="yyyy/MM/dd" type="text" name="stopRepeating"></input>
						    <span class="add-on">
						      		<i data-time-icon="icon-time" data-date-icon="icon-calendar">
							        </i>
						    </span>
					 </div>
				</div>
			</div>
		</div>

		<div class="row">
			<div id="locationBox" class="span4">
				<label>Location</label>
				<select id="location" name="eventLocation" class="span4">
					<option value="new">New Location</option>
					<option value="101">Location A</option>
					<option value="202">Location B</option>
					<option value="303">Location C</option>
				</select>	
				<textarea name="newLocation" id="newLocation" class="input-xlarge span4" rows="7" placeholder="Enter New Location Here"></textarea>
			</div>
				
			<div class="span4">

				<label>Brief Description</label>
				<textarea name="description" id="description" class="input-xxlarge span4" style="resize: none;" rows="7"></textarea>

			</div>
			<div id="ticketed-switch" class="make-switch  span4" data-on-label="Ticketed" data-off-label="Free / No Charge" data-on="success" data-off="primary" >
				    <input type="checkbox" name="eventTicketed" onChange="javascript:$('#ticketed').toggle('fade in');">
			</div>
		</div>
		<div class="row">&nbsp;
		</div>
		<div class="row">

		       <div class="well span7 hide" id="ticketed">
					<div class="span2">
					<label>Cost?</label>
					 <input type="text" class="money span1" name="eventCost" placeholder="0.00" >
					</div>
					<div class=span3">
					<label>Ticketing Website:</label>
					 <input type="text" class="span4" name="ticketURL" placeholder="http://" >
					</div>
			</div>
		</div>

		<div class="row">
			<div class="span8">
				<label>Event Details</label>
				<textarea name="eventDetails" id="message" class="input-xlarge span8" rows="7"></textarea>
			</div>
		</div>
		<div class="row">
			<div class="span8">
				<label>Link to the Event:<label><input type="text" class="input-xlarge span8" name="eventLink" placeholder="http://">
			</div>
		</div>
		<div class="row">

			<div class="span8 centered">
				<p class="btn-toolbar pull-right">
					<input type="submit" class="btn btn-primary" name="submit" value="Create">
					<button type="submit" class="btn" onClick="javascript:window.location('{$returnURL}');">Cancel</button>
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
      endDate: new Date(2013, 8, 30)
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
{/block}