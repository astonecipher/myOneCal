<?php /* Smarty version Smarty-3.1.13, created on 2015-05-21 12:18:16
         compiled from "db:cal_home" */ ?>
<?php /*%%SmartyHeaderCode:1370632930555d895abae697-86517114%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '57cd32a3566d2595806d439d209bca474df0d121' => 
    array (
      0 => 'db:cal_home',
      1 => 1432221326,
      2 => 'db',
    ),
    '96e98dc0a071e9031638794927f1d96551ac1b8e' => 
    array (
      0 => 'db:cal_dashboard',
      1 => 1432221475,
      2 => 'db',
    ),
    '0c3224fb63940ed4bf857414f14276ea96332c42' => 
    array (
      0 => 'db:events_table',
      1 => 1431991379,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '1370632930555d895abae697-86517114',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_555d895b466475_69834330',
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
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_555d895b466475_69834330')) {function content_555d895b466475_69834330($_smarty_tpl) {?><!DOCTYPE html>
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




   
	<link media="all" rel="stylesheet" type="text/css" href="/css/bootstrap-datetimepicker.min.css" />
	<link rel="stylesheet" href="https://www.filelogix.com/css/DT_bootstrap.css"/>


   


	<link rel="stylesheet" type="text/css" href="https://www.filelogix.com/css/DT_bootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://www.filelogix.com/css/TableTools.css">
 
       <script type="text/javascript" src="/js/jquery.js"></script>
       <script type="text/javascript" src="/js/bootstrap.min.js"/></script>



 <script type="text/javascript" src="https://www.filelogix.com/js/canvasjs.min.js"></script>

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

        </div>
       
        
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<?php }?>           
	<div class="container" >

	

 <div class="row placeholders">
            <div class="col-xs-6 col-sm-3 placeholder">
              <img data-src="/assets/dashboard/holder.js/200x200/auto/sky" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img data-src="/assets/dashboard/holder.js/200x200/auto/vine" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img data-src="/assets/dashboard/holder.js/200x200/auto/sky" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img data-src="/assets/dashboard/holder.js/200x200/auto/vine" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
          </div>

<div class="btn-group">
  <button class="btn btn-default" id="currentCalendar"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['currentCalendar']->value)===null||$tmp==='' ? "Calendar" : $tmp);?>
</button>
  <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
	<?php  $_smarty_tpl->tpl_vars['calendar'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['calendar']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['calendars']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['calendar']->key => $_smarty_tpl->tpl_vars['calendar']->value){
$_smarty_tpl->tpl_vars['calendar']->_loop = true;
?>
		<li><a href="/onecal/calendar/home/<?php echo $_smarty_tpl->tpl_vars['calendar']->value['sShortName'];?>
"><?php echo $_smarty_tpl->tpl_vars['calendar']->value['sName'];?>
</a></li>
	<?php } ?>	
  </ul>
</div>
<div class="btn-group" role="group">
  <button class="btn btn-default active">Events</button>
  <button class="btn btn-default disabled" disabled>Locations</button>
  <button class="btn btn-default disabled" disabled>Categories</button>
  <button class="btn btn-default disabled" disabled>Areas</button>
</div>
<div class="container col-md-11" style="padding-bottom: 50px;">
<?php /*  Call merged included template "db:EVENTS_TABLE" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("db:EVENTS_TABLE", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '1370632930555d895abae697-86517114');
content_555e0548ad27e7_48697823($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "db:EVENTS_TABLE" */?>
</div>

<div class="container hide">
<div class="span5">
<div id="chartContainer1" style="height: 300px; width: 100%;"></div>
</div>
<div class="col-md-offset-1 span-md-5" >
<div id="chartContainer2" style="height: 300px;"></div>
</div>
</div>

	</div>
	
	
    






	<script type="text/javascript" src="https://www.filelogix.com/js/lodash.min.js"></script>
	<script type="text/javascript" charset="utf-8" language="javascript" src="/assets/js/datatable/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf-8" language="javascript" src="https://www.filelogix.com/js/DT_bootstrap.js"></script>
	<script type="text/javascript" charset="utf-8" language="javascript" src="/assets/js/datatable/dataTables.bootstrap.js"></script>
	<script type="text/javascript" charset="utf-8" language="javascript" src="/assets/js/datatable/dataTables.tableTools.min.js"></script>

<script type="text/javascript" src="/assets/js/datatable/datatables.responsive.js"></script>

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
		"sDom": "T<'row'><'row'<'span3'l><'span11'f>r>t<'row'<'span11 small'i><'span11'p>>",
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
			{ "bSortable": true },
			{ "bSortable": true },
			{ "bSortable": true },
			{ "bSortable": true,  "sType": "datetime-us" },
		]

	} );
	


} );

$('#events').show();


</script>


 <script type="text/javascript">
  window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer1",
    {

      title:{
      text: "Events Coming Up"
      },
       data: [
      {
        type: "line",

        dataPoints: [

	<?php  $_smarty_tpl->tpl_vars['left'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['left']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['chartLeft']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['left']->key => $_smarty_tpl->tpl_vars['left']->value){
$_smarty_tpl->tpl_vars['left']->_loop = true;
?> 
        { x: new Date(<?php echo $_smarty_tpl->tpl_vars['left']->value['year'];?>
, <?php echo $_smarty_tpl->tpl_vars['left']->value['month']-1;?>
, <?php echo $_smarty_tpl->tpl_vars['left']->value['day'];?>
), y: <?php echo $_smarty_tpl->tpl_vars['left']->value['count'];?>
 },
 
        <?php } ?>
        ]
      }
      ]
    });

    chart.render();

   var chart2 = new CanvasJS.Chart("chartContainer2",
    {

      title:{
      text: "Events Viewed"
      },
       data: [
      {
        type: "area",

        dataPoints: [
	<?php $_smarty_tpl->tpl_vars['rightSum'] = new Smarty_variable(0, null, 0);?>
 	<?php  $_smarty_tpl->tpl_vars['right'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['right']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['chartRight']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['right']->key => $_smarty_tpl->tpl_vars['right']->value){
$_smarty_tpl->tpl_vars['right']->_loop = true;
?> 
	<?php $_smarty_tpl->tpl_vars['rightSum'] = new Smarty_variable($_smarty_tpl->tpl_vars['rightSum']->value+$_smarty_tpl->tpl_vars['right']->value['count'], null, 0);?>
        { x: new Date(<?php echo $_smarty_tpl->tpl_vars['right']->value['year'];?>
, <?php echo $_smarty_tpl->tpl_vars['right']->value['month'];?>
, <?php echo $_smarty_tpl->tpl_vars['right']->value['day'];?>
), y: <?php echo $_smarty_tpl->tpl_vars['rightSum']->value;?>
 },
 
        <?php } ?>    
        ]
      }
      ]
    });

    chart2.render();
  }
  </script>





  </body>
</html>
<?php }} ?><?php /* Smarty version Smarty-3.1.13, created on 2015-05-21 12:18:16
         compiled from "db:events_table" */ ?>
<?php if ($_valid && !is_callable('content_555e0548ad27e7_48697823')) {function content_555e0548ad27e7_48697823($_smarty_tpl) {?>					<center><h3>
						Upcoming Events <?php if ($_smarty_tpl->tpl_vars['currentCalendar']->value){?> - <?php echo $_smarty_tpl->tpl_vars['currentCalendar']->value;?>
 <?php }?>
					</h3></center>

					<table class="table table-bordered table-striped" id="events">
						<thead>
							<tr>
								<th>
									Title
								</th>
								<th>
									Category
								</th>
								<th>
									Location
								</th>
								<th>
									Starts
								</th>
								<th>
									Ends
								</th>										
							</tr>
						</thead>
						<tbody>

							<?php  $_smarty_tpl->tpl_vars['event'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['event']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['events']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['event']->key => $_smarty_tpl->tpl_vars['event']->value){
$_smarty_tpl->tpl_vars['event']->_loop = true;
?>

																			<tr>

								<td> 
									<a href="calendar/event/<?php echo $_smarty_tpl->tpl_vars['event']->value['kParentID'];?>
" class="">
									<?php echo $_smarty_tpl->tpl_vars['event']->value['title'];?>

									</a>
								</td>
								<td style="text-align: center;">									<a href="calendar/event/<?php echo $_smarty_tpl->tpl_vars['event']->value['kEventID'];?>
" class="view-link">
<?php echo $_smarty_tpl->tpl_vars['event']->value['categoryName'];?>

</a>
								</td>
								<td style="text-align: center;">									<a href="calendar/event/<?php echo $_smarty_tpl->tpl_vars['event']->value['kEventID'];?>
" class="view-link">
<?php echo $_smarty_tpl->tpl_vars['event']->value['locationName'];?>

</a>
								</td>
								<td>

									<?php echo $_smarty_tpl->tpl_vars['event']->value['tStartStr'];?>

								</td>
								<td>

									<?php echo $_smarty_tpl->tpl_vars['event']->value['tEndStr'];?>

								</td>
							</tr>

							<?php continue 1?>
							<?php } ?>
						</tbody>
				</table>



</div>


<?php }} ?>