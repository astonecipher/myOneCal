<div id="buzz-submit-alert">
	{if $alertSuccess}<br><div class="col-md-10 alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>{$successMsg}</div>{/if}
	{if $alertInfo}<br><div class="col-md-10 alert alert-info"><button type="button" class="close" data-dismiss="alert">&times;</button>{$infoMsg}</div>{/if}
	{if $alertWarning}<br><div class="col-md-10 alert alert-warning"><button type="button" class="close" data-dismiss="alert">&times;</button>{$warningMsg}</div>{/if}
	{if $alertError}<br><div class="col-md-10 alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>{$errorMsg}</div>{/if}
</div>
<div class="col-md-12"  id="buzz-event-loading">
	<center>
	<div class="col-md-11"><img src="/images/ajax-loader.gif"></div>
	<div class="col-md-11">Loading Event</div>
	</center>
</div>
<div class="col-md-11 hide"  id="buzz-event-form"> <!-- should be hidden while jquery libraries load -->

	<form action="{$formAction}" method="post" enctype="multipart/form-data" class="form-horizontal" onsubmit="return processEvent();">
	<!-- Event Title -->
	<div class="event-title">
		<label for="post_title" class=""><h4>Event Title:<small class="req"> (required)</small></h4></label>
		<input type="text" class="input-xxlarge" name="eventTitle" value="{$eventTitle}">
	</div>
	<!--event-title -->

	<!-- Event Description -->
	<div class="events-description" style="padding-bottom: 20px;">
		<label for="post_content" class=""><h4>Event Description:</h4></label>
		<textarea  name="eventDescription" class=" form-control" rows="3">{$eventDetails}</textarea>	
	</div>
	<!-- event-description -->

	<!-- Event Categories -->
	
	<div class="well row" id="event_categories">
		
			<h4 class="event-time">Event Categories:</h4>

			<div class="control-group">
					{foreach $categories as $category}
			        	<div class="col-md-3" style="margin-left: 30px;">		
			            		<label class="checkbox" for="category-{$category.id}"><input type="checkbox" name="eventCategories[]" value="{$category.id}" id="category-{$category.id}"> {$category.sName} </label>
					 </div>       
					{/foreach}
				
			</div>
		
	</div>
	
	<!-- event-categories -->
	
	<!-- Event Featured Image -->
{*
	<div class="well hide" id="event-image">

			<h4 class="event-time">Event Image &nbsp;&nbsp;<small class="pull-right">(This feature is in preview mode.)</small></h4>
			<div class="control-group">
				<label class="control-label" for="eventImage">Event Image:</label>
				<div class="controls">
					<input id="fileupload" type="file" name="eventFiles[]" data-url="/buzz/calendar/media/upload" multiple>

    <span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>Select files...</span>
        <!-- The file input field used as target for the file upload widget -->
        <input id="fileupload" type="file" name="eventFiles[]" multiple>
    </span>
    <br>
    <br>
    <!-- The global progress bar -->
    <div id="progress" class="progress progress-striped">
        <div class="bar bar-success" id="file-upload-progress"></div>
    </div>
    <!-- The container for the uploaded files -->
    <div id="files" class="files"></div>

	</div><!-- eventImage -->
	</div>
				</div>
*}
	<!-- Event Date Selection -->

	<div class="well row" id="event-datepicker">


			<h4 class="event-time">Event Time &amp; Date</h4>
			<div class="control-group">
				<label class="control-label" for="allDayCheckbox">All day event?</label>
					<div class="controls">
						<input type="checkbox" id="allDayCheckbox" name="eventAllDay" onChange="javascript:allDayChanged();" value="1" {if $event.bAllDay}checkec{/if}>
					</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="EventStartDate">From:</label>
					<div>

				<div id="EventStartDate" class="input-group col-md-2">
				    <input  data-format="yyyy-MM-dd" type="text" name="startDate" value="{$startDate}">
				    <span class="input-group-addon glyphicon glyphicon-calendar"></span>
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

				<div id="EventEndDate" class="input-group col-md-2">
				    <input class="form-control" data-format="yyyy-MM-dd" type="text" name="endDate" value="{$endDate}">
				    <span class="input-group-addon glyphicon glyphicon-calendar"></span>
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
					<div class="form-group">
						<div class="col-md-6 pull-left" style="margin-left: 0px;">
									<div class="col-md-3 pull-left" style="margin-left: 0px; margin-bottom: 10px;">
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
									<div class="col-md-4 pull-left" style="margin-left: 5px;">
										<div id="eventRepeats-RepeatFreq" style="display: none;">
											  every&nbsp;&nbsp;<div class="input-prepend input-append">
										         <button class="btn" type="button" onclick="javascript:minusButton('repeatEvery',1);">-</button>
											 <input class="col-md-2" class="input input-mini" size=2 id="repeatEvery" name="repeatEvery" type="text" style="text-align: center; width: 30px;" value="1">
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
												option value="7">7</option>
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

										<textarea name="repeatCustomDates" rows="2" class="col-md-8" placeholder="Enter a list of dates in YYYY-MM-DD format, separated by spaces or commas.  Dates may also be listed in ranges, using '-' or 'to'.">{$repeatCustomDates}</textarea>
										
									</div>
								</div>
			</div>			   

			    <div class="eventRepeats" id="eventRepeats-Exception" style="display: none;">
								<div class="control-group">
									<label class="control-label" for="repeatSkip">Except?</label>
									<div class="controls">

										<textarea name="repeatSkipDates" rows="2" class="col-md-8" placeholder="Enter a list of dates to skip in YYYY-MM-DD format, separated by spaces or commas.">{$repeatSkipDates}</textarea>
										
									</div>
								</div>
			</div>	
			 <div class="eventRepeats" id="eventRepeats-EndDate" style="display: none;">
				<div class="control-group">
						<label class="control-label" for="repeatEndDate">Until?</label>
						<div class="controls">

						<div id="repeatEndDate" class="input-append">
				   			 <input class="col-md-2" data-format="yyyy-MM-dd" type="text" name="repeatEndDate" value="{$repeatEndDate}"></input>
							<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						 </div><small> (Leave blank for never ending events)</small>
					</div>
				</div>
			   </div>
	</div>	

	<!-- Venue -->

	<div class="well" id="event-venue">

			<h4>Event Location Details</h4>
<div class="row">
	<div class="col-md-5">
			<div class="control-group">
				<label class="control-label" for="eventLocation">Location?</label>
					<div class="controls">
						<select class="input-xlarge" name="eventLocation" id="eventLocation" onChange="javascript:locationChanged(this);"><option value="new">Use New Location</option>
						{foreach $locations as $location} 
							<option data-address="{$location.zAddress}" data-latlng="{$location.sLat}, {$location.sLon}"  data-name="{$location.sName}"  data-city="{$location.sCity}" data-state="{$location.sState}" data-postalCode="{$location.sZipcode}" data-phoneNumber="{$location.sPhoneNumber}" value="{$location.id}">{$location.sName}</option>
						{/foreach}	
</select>
			</div>
		</div>
		<div class="control-group">
				<label class="control-label" for="locationName">Venue Name:</label>
				<div class="controls">			
					<input type="text" id="locationName" class="input-xlarge newLocation" name="locationName" size="128" value="{$locationName}">
				</div>
		</div>
		<div class="control-group">			
				<label class="control-label" for="newAddress">Address:</label>
				<div class="controls">
					<input type="text" class="input-xlarge newLocation" id="newAddress" name="newAddress" size="128" value="{$newAddress}" onBlur="javascript:canGeocode();">
				</div>
		</div>
		<div class="control-group">	
				<label class="control-label" for="city">City:</label>
				<div class="controls">
					<input type="text" id="newCity" class="newLocation" name="newCity" size="25" value="{$newLocation|default:"Jacksonville"}"></td>
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
					<input type="text" class="input-small newLocation" id="newPostalCode" name="newPostalCode" size="10" value="{$newPostalCode}">
				</div>
		</div>
		<div class="control-group">
				<label class="control-label" for="newPhone">Phone:</label>
				<div class="controls">			
					<input type="text" id="newPhone" class="newLocation" name="newPhone" size="25" value="{$newPhone}">
				</div>
		</div>		
	
	</div>
	<div class="col-md-4 pull-right" style="height: 400px; border: 1px solid #ccc;">
		<input type="hidden" id="newLocationLatitude" class="newLocation" name="newLatitutde"  value="{$newLatitude}">
		<input type="hidden" id="newLocationLongitude" class="newLocation" name="newLongitude" value="{$newLongitude}">
		<div id="map-canvas" style="height: 400px; max-width: none; width: 100%;">
		</div>
	</div>
</div>
</div>
	
<!-- Organizer -->
<div class="well row" id="event_organizer">

	<h4>Event Organizer Details</h4>
				<div class="control-group">	
				<label class="control-label" for="saved_organizer">Use Saved Organizer?</label>
				<div class="controls">
				<select class="input-xxlarge" name="organizerID" id="saved_organizer" >
					<option value="0">Use New Organizer</option>
					{foreach $organizers as $organizer}
						<option value="{$organizer.id}">{$organizer.name}</option>
					{/foreach}
				</select>
				</div>
			</div>			
			<div class="control-group">	
				<label class="control-label" for="organizer">Name:</label>
				<div class="controls">
					<input type="text" class="input-xlarge" id="Organizer" name="organizerName" size="50" value="{$organizerName}">
				</div>
			</div>
			<div class="control-group">	
				<label class="control-label" for="state">Phone:</label>
				<div class="controls">
					<input type="text"  id="OrganizerPhone" name="organizerPhone" size="25" value="{$organizerPhone}">
				</div>
			</div>

			<div class="control-group">	
				<label class="control-label" for="organizerWebsite">Website:</label>
				<div class="controls">
					<input type="text" class="input-xlarge" id="OrganizerWebsite" name="organizerWebsite" size="100" value="{$organizerWebsite}">
				</div>
			</div>
			<div class="control-group">	
				<label class="control-label" for="organizerEmail">Email:</label>
				<div class="controls">
					<input type="text" class="input-xlarge" id="OrganizerEmail" name="organizerEmail" size="255" value="{$organizerEmail}">
				</div>
			</div> <!-- #event_organizer -->

</div>
	
<!-- Event Website -->

<div class="well row" id="event_url">

	<h4>Event Website</h4>

			<div class="control-group">	
				<label class="control-label" for="eventurl">URL:</label>
				<div class="controls">	
					<input type="text" class="input-xxlarge" id="EventURL" name="eventURL" size="25" value="{$eventURL}">
				</div>
			</div> <!-- .website -->
			<div class="control-group">	
				<label class="control-label" for="eventurl">Facebook:</label>
				<div class="controls">	
					<input type="text" class="input-xxlarge" id="EventFacebookURL" name="eventFacebookURL" size="25" value="{$eventFacebookURL}">
				</div>
			</div> <!-- .website -->
			<div class="control-group">	
				<label class="control-label" for="eventurl">Foursquare:</label>
				<div class="controls">	
					<input type="text" class="input-xxlarge" id="EventFourSquareURL" name="eventFoursquareURL" size="25" value="{$eventFoursquareURL}">
				</div>
			</div> <!-- .website -->
</div>


	
<!-- Custom -->
<div class="well row" id="event-custom">
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

<div class="well row" id="event_cost">

	<h4>Event Cost</h4>
		
	<div class="control-group">	
				<label class="control-label" for="eventCost" >Cost:</label>
				<div class="controls">				
					<div class="input-prepend input-append">
						  <span class="add-on">$</span>						  <input type="text" id="EventCost" name="eventCost" class="input input-small" value="{$eventCost}">
					</div><div style="white-space: nowrap; overflow: hidden;"><small> (Leave blank to hide the field. Enter a 0 for events that are free.) </small></div>
				</div>
	</div><!-- #event_cost -->
			<div class="control-group">	
				<label class="control-label" for="eventurl">Ticketing URL:</label>
				<div class="controls">	
					<input type="text" class="input-xxlarge" id="EventTicketingURL" name="ticketURL" size="25" value="{$ticketURL}">
				</div>
			</div> <!-- .website -->
</div><!-- event-cost -->

	{if $calendars|@count >= 1}

	<div class="row well" id="event_calendar">
			<h4 class="event-time">Add to Calendar:</h4>

			<div class="control-group" style="margin-left: 30px;">
					{foreach $calendars as $calendar}
			        			<div class="col-md-10">
			            		<label class="radio" for="calendar-{$calendar.id}"><input type="radio" name="calendarID" value="{$calendar.id}" id="calendar-{$calendar.id}" {if $calendar.isSelected}checked{/if}> {$calendar.sName} </label>
					        </div>
					{foreachelse}
			        			<div class="col-md-10">
			            		<label class="radio" for="calendar-{$calendar.id}"><input type="radio" name="calendarID" value="" id="calendar-{$calendar.id}" checked> Default Calendar</label>
					        </div>
					{/foreach}
				
			</div>
	</div><!-- event-calendar -->

	{/if}

	{if $calendars|@count < 1}

	<div class="well row" id="event_calendar_default">
			<center><h5 class="event-time">This event will be added to the default calendar.</h5></center>

					<input type="hidden" name="calendarID" value="{$calendarID|default:"0"}">

	</div><!-- event-calendar_default -->
	
	{/if}

	<div class="well row">
	<table class="" cellspacing="0" cellpadding="0">
		<tbody><tr>
			<td colspan="2" class="tribe_sectionheader">
				<h4>Keywords or Tags</h4>
			</td><!-- .tribe_sectionheader -->
		</tr>
		<tr>
			<td>
				<input type="text" class="input-xxlarge" name="tags" id="eventTags" value="{$tags}">
			</td>
		</tr>
		</tbody>
		</table>		
	</div>

	<!-- Form Submit -->
		<div class="event-submit">
		{if $canSubmit}
			<input type="submit" id="post" class="btn btn-success" value="Submit Event" name="submit" {if $submitDisabled}disabled{/if}>
		{/if}
		{if $canUpdateThis}
			<input type="submit" id="post" class="btn btn-success disabled" value="Update Just This Event" name="copy" {if $updateThisDisabled}disabled{/if}>
		{/if}
		{if $canUpdateAll}
			<input type="submit" id="post" class="btn btn-success disabled" value="Update All Events" name="copy" {if $updateAllDisabled}disabled{/if}>
		{/if}
		{if $canSave}
			<input type="submit" id="post" class="btn btn-primary" value="Save Event" name="copy" {if $saveDisabled}disabled{/if}>
		{/if}
		{if $canCopy}
			<input type="submit" id="post" class="btn btn-default" value="Copy Event" name="copy" {if $copyDisabled}disabled{/if}>
		{/if}

	</div>
	
</form>


<script src="/lib/fileUploader/js/vendor/jquery.ui.widget.js"></script>
<script src="/lib/fileUploader/js/jquery.iframe-transport.js"></script>
<script src="/lib/fileUploader/js/jquery.fileupload.js"></script>

<script type="text/javascript">





/*
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

	{if $eventLocation}
		$("#eventLocation").val("{$eventLocation}");
		locationChanged("{$eventLocation}");
	{elseif $lastLocationID}
		$("#eventLocation").val("{$lastLocationID}");
		locationChanged("{$lastLocationID}");
	{/if}	

  $("#buzz-event-loading").hide();
  $("#buzz-event-form").show();

});
*/

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

	{if $eventCategories} 
		var eventCategories = {$eventCategories};
	
	 	$.each(eventCategories, function(index, value) {
			var categoryID = "#category-" + value.toString();
	        		$(categoryID).prop("checked",true);
	         });
	{/if}

	{if $eventAllDay}
		$("#allDayCheckbox").prop("checked",true);
		allDayChanged();
	{/if}
	
	$("#startHour").val("{$startHour}");
	$("#startMinute").val("{$startMinute}");
	$("#startMeridian").val("{$startMeridian}");
	$("#endHour").val("{$endHour}");
	$("#endMinute").val("{$endMinute}");
	$("#endMeridian").val("{$endMeridian}");

	{if $repeatFrequency} 
	
		$("#eventFrequency").val("{$repeatFrequency}");
		$("#repeatEvery").val("{$repeatEvery}");
		$("#repeatMonthDayNumber").val("{$repeatMonthDayNumber}");
		$("#repeatMonthWeek").val("{$repeatMonthWeek}");
		$("#repeatAnnualMonth1").val("{$repeatAnnualMonth1}");
		$("#repeatAnnualDayNumber").val("{$repeatAnnualDayNumber}");
		$("#repeatAnnualMonth2").val("{$repeatAnnualMonth2}");
		$("#repeatAnnualDayOfWeek").val("{$repeatAnnualDayOfWeek}");
		$("#repeatAnnualWeek").val("{$repeatAnnualWeek}");
		changeFreq();
	{/if}

	$("#newState").val("{$newState}");

	{if $sharing} 
		$("#sharing").prop("checked",true);
	{/if}
	{if $sponsored}
		$("#sponsored").prop("checked",true);
	{/if}

	{if $repeatDaysBinaryStr}
		setDays({$repeatDaysBinary});
	{/if}

	{if $repeatMonthDaysBinaryStr}
		setMonthDays({$repeatMonthDaysBinary});
	{/if}

	//console.log("Monthly: {$repeatMonth}");

	{if $repeatMonth}
		$("#repeatMonth-{$repeatMonth}").prop("checked",true);
	{/if}

	{if $repeatAnnual}
		$("#repeatAnnual-{$repeatAnnual}").prop("checked", true);
	{/if}

	{if $repeat}
		var repeat = {$repeat};
	{/if}
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
