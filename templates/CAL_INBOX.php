{extends file="db:CAL_DASHBOARD"}

{block name="header-css"}
	<link media="all" rel="stylesheet" type="text/css" href="/css/bootstrap-datetimepicker.min.css" />

	<style>
		.dataTables_filter {
	 		margin-right: 40px;
		}
		div.dataTables_paginate {
			margin-right: 40px;
		}
		.margin-right40 {
			margin: 0 40px 0 0;
			margin-right: 40px;
		}



	</style>
{/block}


{block name="header-js"}


	<link rel="stylesheet" type="text/css" href="/css/DT_bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/css/TableTools.css">
 
       <script type="text/javascript" src="/js/jquery.js"></script>
       <script type="text/javascript" src="/js/bootstrap.min.js"/></script>

{/block}


{block name="body"}


					{if $alertSuccess}<div class="col-md-11 alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>{$successMsg}</div>{/if}
					{if $alertInfo}<div class="col-md-11 alert alert-info"><button type="button" class="close" data-dismiss="alert">&times;</button>{$infoMsg}</div>{/if}
					{if $alertWarning}<div class="col-md-11 alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>{$warningMsg}</div>{/if}
					{if $alertError}<div class="col-md-11 alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>{$errorMsg}</div>{/if}

<div classcol-md-12">				
	<div class="well">	

<div class="btn-group">
  <button class="btn btn-default" id="currentCalendar">{$currentCalendar|default:"Calendar"}</button>
  <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <span class="caret"></span>
  </button>
  {if $calendars|@count>0}
  <ul class="dropdown-menu">
	{foreach $calendars as $calendar}
		<li><a href="/inbox/{$calendar.sShortName}">{$calendar.sName}</a></li>
	{/foreach}	
  </ul>
  {/if}
</div>
<div class="btn-group inbox-types">
  <button class="btn {if $inboxType == "events"}active{/if} inbox-types"  onclick="inbox('events');" id="inbox-events">Events</button>
  <button class="btn btn-default inbox-types {if $inboxType == "feeds"}active{/if}" onclick="inbox('feeds');" id="inbox-feeds" >Feeds</button>
  <button class="btn btn-default inbox-types " disabled>Locations</button>
  <button class="btn btn-default inbox-types" disabled>Media</button>
</div>
{if $inboxType == "feeds"}
  <button class="btn btn-default" onclick="clearInbox({$calendarID});" >Clear Inbox</button>
{/if}

					<table class="table table-sorting table-striped table-hover datatable" cellpadding="0" cellspacing="0" width="100%"  id="events">
						<thead>
							<tr>
								<th>
									Title
								</th>
								<th  class="hidden-phone hidden-tablet"><center>
									Organizer/Location</center>
								</th>
								<th  class="hidden-phone hidden-tablet">
									Repeating?
								</th>
								<th  class="hidden-phone hidden-tablet"><center>
									Start Date/Time</center>
								</th>
								<th  class="hidden-phone hidden-tablet"><center>
									Ending Date/Time</center>
								</th>											<th><center>
									Action</center>
								</th>							
							</tr>
						</thead>
						<tbody>

							{foreach $events as $event}

																			<tr class="row-event-{$event.eventID}" id="row-event-{$event.eventID}">

								<td  class="row-event-{$event.eventID}"> 
									<a href="calendar/event/{$event.kParentID}" class="">
									{$event.title}
									</a>
								</td>

								<td style="text-align: center;"  class="hidden-phone hidden-tablet row-event-{$event.eventID}">									<a href="calendar/event/{$event.kParentID}" class="view-link">
										{$event.organizerName}{if $event.organizerName}<br>{/if}
										{$event.locationName}
									</a>
								</td>
								<td  class="hidden-phone hidden-tablet row-event-{$event.eventID}">
									<center>{if $event.bRepeat>0} Yes {else} No {/if}</center>
								</td>											<td  class="hidden-phone hidden-tablet row-event-{$event.eventID}" nowrap>
									{$event.tStartStr}
								</td>
								<td  class="hidden-phone hidden-tablet row-event-{$event.eventID}" nowrap>
									{$event.tEndStr}
								</td>
								<td>
									{if $inboxType == "events"}
										<div class="btn-toolbar">
										  <div class="btn-group">
										     <button id="btn-confirm-{$event.kParentID}" class="btn btn-default btn-xs" onclick="javascript:confirmEvent('{$event.kParentID}');"><i class="glyphicon glyphicon-ok"></i></button>
										     <button id="btn-show-{$event.kParentID}" class="btn btn-default btn-xs" onclick="javascript:showEvent('{$event.kParentID}');"><i class="glyphicon glyphicon-search"></i></button>
										     <button id="btn-delete-{$event.kParentID}" class="btn btn-default btn-xs" onclick="javascript:deleteEvent('{$event.kParentID}');"><i class="glyphicon glyphicon-trash"></i></button>
										  </div>
										</div>
									{elseif $inboxType == "feeds"}
										<div class="btn-toolbar">
										  <div class="btn-group">
									     		<button id="btn-confirm-{$event.eventFeedID}" class="btn  btn-default btn-xs {if $event.isActiveOnFeed}active btn-success{/if}" onclick="javascript:checkFeedEvent('{$event.eventFeedID}');"><i class="glyphicon glyphicon-ok"></i></button>
									     		<button id="btn-show-{$event.eventFeedID}" class="btn btn-default btn-xs" onclick="javascript:showEvent('{$event.kParentID}');"><i class="glyphicon glyphicon-search"></i></button>
									     		<button id="btn-delete-{$event.eventFeedID}" class="btn btn-default btn-xs" onclick="javascript:deleteFeedEvent('{$event.eventFeedID}');" {if $event.isActiveOnFeed}disabled{/if}><i class="glyphicon glyphicon-trash"></i></button>
										  </div>
										</div>
									{/if}
								</td>
							</tr>

							{continue}
							{/foreach}
						</tbody>
				</table>



</div>

</div>



{/block}

{block name="footer-scripts"}

<script src="https://www.filelogix.com/lib/bootbox/bootbox-3.3.0/bootbox.min.js"></script>


{literal}

	<script type="text/javascript" charset="utf-8" language="javascript" src="/assets/js/datatable/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf-8" language="javascript" src="/assets/js/datatable/DT_bootstrap.js"></script>
	<script type="text/javascript" charset="utf-8" language="javascript" src="/assets/js/datatable/dataTables.bootstrap.3.js"></script>
	<script type="text/javascript" charset="utf-8" language="javascript" src="/assets/js/datatable/TableTools.min.js"></script>


<script type="text/javascript">

jQuery.extend( jQuery.fn.dataTableExt.oSort, {
   "datetime-us-pre": function ( a ) {
       var b = a.match(/(\d{1,2})\/(\d{1,2})\/(\d{2,4}) (\d{1,2}):(\d{1,2}) (am|pm|AM|PM|Am|Pm)/),
           month = b[1],
           day = b[2],
           year = b[3],
           hour = b[4],
           min = b[5],
           ap = b[6];
 
       if(hour == '12') hour = '0';
       if(ap == 'pm') hour = parseInt(hour, 10)+12;
 
       if(year.length == 2){
           if(parseInt(year, 10)<70) year = '20'+year;
           else year = '19'+year;
       }
       if(month.length == 1) month = '0'+month;
       if(day.length == 1) day = '0'+day;
       if(hour.length == 1) hour = '0'+hour;
       if(min.length == 1) min = '0'+min;
 
       var tt = year+month+day+hour+min;
       return  tt;
   },
   "datetime-us-asc": function ( a, b ) {
       return a - b;
   },
 
   "datetime-us-desc": function ( a, b ) {
       return b - a;
   }
});
 
jQuery.fn.dataTableExt.aTypes.unshift(
   function ( sData )
   {
       if (sData !== null && sData.match(/\d{1,2}\/\d{1,2}\/\d{2,4} \d{1,2}:\d{1,2} (am|pm|AM|PM|Am|Pm)/))
       {
 
           return 'datetime-us';
       }
       return null;
   }
);



$(document).ready(function() {
	$('#events').dataTable( {
		"sDom": "T<'row'><'row'<'col-md-6'l><'col-md-12' f>r>t<'row'<'col-md-12 small'i><'col-md-12 margin-right40' p>>",
		"sPaginationType": "bootstrap",
		"bStateSave": true,
		
		"oTableTools": {
			"sSwfPath": "/swf/copy_csv_xls_pdf.swf", 			
			"aButtons": [ "copy", "csv", "xls", "pdf" ]
		},
		"oLanguage": {
			"sLengthMenu": "_MENU_ records per page"
		},
		"aoColumns": [
			{ "bSortable": true },
			{ "bSortable": false },
			{ "bSortable": false },
			{ "bSortable": true,  "sType": "datetime-us" },
			{ "bSortable": true,  "sType": "datetime-us" },
			{ "bSortable": false }
		]

	} );
	


} );

$('#events').show();

function confirmEvent(eventID) {
	console.log("Confirming Event " + eventID);
	$.post( "/calendar/ajax/event/confirm/"+eventID, function( data ) {		console.log("Confirm Event: " + data);
		if (data=="1") {
			$('#btn-confirm-'+eventID).attr("disabled", "disabled");
			$('#btn-delete-'+eventID).attr("disabled", false);
		}
		else {
			console.log(data);
		}
	});
}

function deleteEvent(eventID) {
	bootbox.confirm("Are you sure you want to delete this event?", function(result) {
		$.post( "/calendar/ajax/event/delete/"+eventID, function( data ) {			console.log("Delete Event: " + data);
			if (data=="1") {
				$('#row-event-'+eventID).css("text-decoration:line-through;");
				$('#btn-show-'+eventID).attr("disabled", "disabled");
				$('#btn-confirm-'+eventID).attr("disabled", "disabled");
				$('#btn-delete-'+eventID).attr("disabled", "disabled");			}
		});
	}); 
}

function checkFeedEvent(eventID) {
	console.log("Check Event " + eventID);
	if ($('#btn-confirm-'+eventID).hasClass("active")) {
		$.post( "/calendar/ajax/feed/uncheck/"+eventID, function( data ) {
			if (data=="1") {
				$('#btn-confirm-'+eventID).removeClass("active");
				$('#btn-confirm-'+eventID).removeClass("btn-success");
				$('#btn-delete-'+eventID).attr("disabled", false);
				$('#btn-delete-'+eventID).removeClass("disabled");
			}
		});
	}
	else {

		$.post( "/calendar/ajax/feed/check/"+eventID, function( data ) {
			if (data=="1") {
				$('#btn-confirm-'+eventID).addClass("active");
				$('#btn-confirm-'+eventID).addClass("active btn-success");
				$('#btn-delete-'+eventID).attr("disabled", true);
			}
		});
	}


}

function deleteFeedEvent(eventID) {
	bootbox.confirm("Are you sure you want to delete this event from the feed?", function(result) {
		$.post( "/calendar/ajax/feed/delete/"+eventID, function( data ) {
			if (data=="1") {
				$('#row-event-'+eventID).css("text-decoration:line-through;");
				$('#btn-show-'+eventID).attr("disabled", "disabled");
				$('#btn-confirm-'+eventID).attr("disabled", "disabled");
				$('#btn-delete-'+eventID).attr("disabled", "disabled");			}
		});
	}); 
}




function showEvent(eventID) {
	window.location.href = "/calendar/event/" + eventID;
//	$.ajax("/calendar/ajax/event/show/"+eventID");
}
{/literal}

function clearInbox(calendarID) {
	bootbox.confirm("Are you sure you want to clear all new events from this feed?", function(result) {
		$.post( "/calendar/ajax/feed/clear/"+calendarID, function( data ) {
			if (data=="1") {
				window.location.href="/calendar/inbox/feeds/{$currentCalendarShortName}";
			}
		});
	}); 
}

function inbox(type) {

	$(".inbox-types").removeClass("active");
	$("#inbox-"+type).addClass("active");

	window.location.href="/inbox/"+type+"/{$currentCalendarShortName}";
}


</script>
{/block}