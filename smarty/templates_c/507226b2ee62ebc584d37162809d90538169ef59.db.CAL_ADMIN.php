<?php /* Smarty version Smarty-3.1.13, created on 2015-05-21 07:53:30
         compiled from "db:cal_admin" */ ?>
<?php /*%%SmartyHeaderCode:1843824681555dc73a3f7ad5-23831329%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '507226b2ee62ebc584d37162809d90538169ef59' => 
    array (
      0 => 'db:cal_admin',
      1 => 1432179403,
      2 => 'db',
    ),
    '96e98dc0a071e9031638794927f1d96551ac1b8e' => 
    array (
      0 => 'db:cal_dashboard',
      1 => 1432188669,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '1843824681555dc73a3f7ad5-23831329',
  'function' => 
  array (
  ),
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
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_555dc73a5fa9b5_15375655',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_555dc73a5fa9b5_15375655')) {function content_555dc73a5fa9b5_15375655($_smarty_tpl) {?><!DOCTYPE html>
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
	<link rel="stylesheet" type="text/css" href="/css/DT_bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/css/TableTools.css">

	<style>
		.dataTables_filter {
	 		margin-right: 40px;
		}
		div.dataTables_paginate {
			margin-right: 40px;
			margin: 0 40px 0 0;
		}
		.margin-right40 {
			margin: 0 40px 0 0;
			margin-right: 40px;
		}

	</style>

   
 
       <script type="text/javascript" src="/js/jquery.js"></script>
       <script type="text/javascript" src="/js/bootstrap.min.js"/></script>


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

	


					<?php if ($_smarty_tpl->tpl_vars['alertSuccess']->value){?><div class="span11 alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Success! </strong><?php echo $_smarty_tpl->tpl_vars['successMsg']->value;?>
</div><?php }?>
					<?php if ($_smarty_tpl->tpl_vars['alertInfo']->value){?><div class="span11 alert alert-info"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $_smarty_tpl->tpl_vars['infoMsg']->value;?>
</div><?php }?>
					<?php if ($_smarty_tpl->tpl_vars['alertWarning']->value){?><div class="span11 alert alert-warning"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $_smarty_tpl->tpl_vars['warningMsg']->value;?>
</div><?php }?>
					<?php if ($_smarty_tpl->tpl_vars['alertError']->value){?><div class="span11 alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong><?php echo $_smarty_tpl->tpl_vars['errorMsg']->value;?>
</div><?php }?>

<div class="span12">				
	<div class="well">	

	
				<h4>Users Pending Approval</h4>

					<table class="table table-bordered table-striped" id="events">
						<thead>
							<tr>
								<th>
									Email Address
								</th>
								<th  class="hidden-phone hidden-tablet"><center>
									Name</center>
								</th>
								<th  class="hidden-phone hidden-tablet"><center>
									Organization/Phone</center>
								</th>
	
								<th  class="hidden-phone hidden-tablet"><center>
									Registered</center>
								</th>											<th><center>
									Action</center>
								</th>							
							</tr>
						</thead>
						<tbody>

							<?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['user']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['pendingUsers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
$_smarty_tpl->tpl_vars['user']->_loop = true;
?>

																			<tr>

								<td> 
									<a href="calendar/user/<?php echo $_smarty_tpl->tpl_vars['user']->value['userID'];?>
" class="">
									<?php echo $_smarty_tpl->tpl_vars['user']->value['emailAddress'];?>

									</a>
								</td>

								<td style="text-align: center;"  class="hidden-phone hidden-tablet">									<a href=calendar/user/<?php echo $_smarty_tpl->tpl_vars['user']->value['userID'];?>
" class="view-link">
										<?php echo $_smarty_tpl->tpl_vars['user']->value['lastName'];?>
, <?php echo $_smarty_tpl->tpl_vars['user']->value['firstName'];?>

									</a>
								</td>
								<td  class="hidden-phone hidden-tablet" nowrap>
									<center><?php echo $_smarty_tpl->tpl_vars['user']->value['organizationName'];?>
 <?php if ($_smarty_tpl->tpl_vars['user']->value['organizationName']){?><br><?php }?> <?php echo $_smarty_tpl->tpl_vars['user']->value['phoneNumber'];?>
</center>
								</td>			
								<td  class="hidden-phone hidden-tablet" nowrap>
									<?php echo $_smarty_tpl->tpl_vars['user']->value['lastModified'];?>

								</td>
								<td><center>
									<div class="btn-toolbar">
									  <div class="btn-group">
									     <button id="btn-pending-activate-<?php echo $_smarty_tpl->tpl_vars['user']->value['userID'];?>
" class="btn" onclick="javascript:activateUser('<?php echo $_smarty_tpl->tpl_vars['user']->value['userID'];?>
');"><i class="icon-ok"></i></button>
									     <button id="btn-pending-show-<?php echo $_smarty_tpl->tpl_vars['user']->value['userID'];?>
" class="btn" onclick="javascript:showUser('<?php echo $_smarty_tpl->tpl_vars['user']->value['userID'];?>
');"><i class="icon-search"></i></button>
									     <button id="btn-pending-delete-<?php echo $_smarty_tpl->tpl_vars['user']->value['userID'];?>
" class="btn" onclick="javascript:deleteUser('<?php echo $_smarty_tpl->tpl_vars['user']->value['userID'];?>
');" disabled><i class="icon-trash"></i></button>
									  </div>
									</div></center>
								</td>
							</tr>

							<?php continue 1?>
							<?php } ?>
						</tbody>
				</table>



</div>

</div>




	</div>
	
	
    



	<script type="text/javascript" charset="utf-8" language="javascript" src="/assets/js/datatable/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf-8" language="javascript" src="https://www.filelogix.com/js/DT_bootstrap.js"></script>
	<script type="text/javascript" charset="utf-8" language="javascript" src="/assets/js/datatable/dataTables.bootstrap.js"></script>
	<script type="text/javascript" charset="utf-8" language="javascript" src="/assets/js/datatable/dataTables.tableTools.min.js"></script>


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
		"sDom": "T<'row'><'row'<'span3'l><'span12' f>r>t<'row'<'span12 small'i><'span12 margin-right40' p>>",
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
			{ "bSortable": false }
		]

	} );
	


} );

$('#events').show();

function activateUser(userID) {
	console.log("Activating User " + userID);
	$.post( "/calendar/ajax/admin/user/activate/"+userID, function( data ) {		console.log("Activate User: " + data);
		if (data=="1") {
			$('#btn-pending-activate-'+userID).attr("disabled", "disabled");
//			$('#btn-pending-delete-'+userID).attr("disabled", false);
		}
	});
}

function deleteUser(userID) {
	alert("Deleting Events Is Currently Disabled");
//	$.ajax("/calendar/ajax/admin/user/delete/"+eventID");
}

function showUser(userID) {
	window.location.href = "/calendar/user/" + userID;
//	$.ajax("/calendar/ajax/admin/user/"+userID");
}

</script>


  </body>
</html>
<?php }} ?>