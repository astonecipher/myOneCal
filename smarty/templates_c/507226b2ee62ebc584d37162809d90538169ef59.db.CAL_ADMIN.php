<?php /* Smarty version Smarty-3.1.13, created on 2015-04-03 07:29:27
         compiled from "db:cal_admin" */ ?>
<?php /*%%SmartyHeaderCode:1300681491551e7997354b51-36115831%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '507226b2ee62ebc584d37162809d90538169ef59' => 
    array (
      0 => 'db:cal_admin',
      1 => 1401372030,
      2 => 'db',
    ),
    'ff49eb36fc5b9b42d02790a8e9fc6744dac033c2' => 
    array (
      0 => 'db:cal_wrapper',
      1 => 1427811977,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '1300681491551e7997354b51-36115831',
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
    'navAdminEnabled' => 0,
    'navAdminActive' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_551e7997e76c55_23724855',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_551e7997e76c55_23724855')) {function content_551e7997e76c55_23724855($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
  <head>
    <base href="http://www.onecal.co.php53-13.dfw1-1.websitetestlink.com/">
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
    <link href="https://www.filelogix.com/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://www.filelogix.com/css/bootstrap-responsive.css" rel="stylesheet">


    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="/onecal/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/onecal/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/onecal/assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/onecal/assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="/onecal/assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="/onecal/assets/ico/favicon.png">




   
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

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="calendar/home">OneCal Portal</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li <?php if ($_smarty_tpl->tpl_vars['navHomeActive']->value){?> class="active" <?php }?>><a href="/onecal/calendar/home">Home</a></li>
             <li <?php if ($_smarty_tpl->tpl_vars['navInboxActive']->value){?> class="active" <?php }?>><a href="/onecal/calendar/inbox">Inbox</a></li>
              <li <?php if ($_smarty_tpl->tpl_vars['navCreateActive']->value){?> class="active" <?php }?>><a href="/onecal/calendar/add">Create</a></li>
              <li <?php if ($_smarty_tpl->tpl_vars['navManageActive']->value){?> class="active" <?php }?>><a href="/onecal/calendar/manage">Manage</a></li>
              <li <?php if ($_smarty_tpl->tpl_vars['navShareActive']->value){?> class="active" <?php }?>><a href="/onecal/calendar/share">Share</a></li>
              <li <?php if ($_smarty_tpl->tpl_vars['navFeedsActive']->value){?> class="active" <?php }?>><a href="/onecal/calendar/feeds">Feed</a></li>
              <li <?php if ($_smarty_tpl->tpl_vars['navSupportActive']->value){?> class="active" <?php }?>><a href="/onecal/calendar/support">Support</a></li>
              <?php if ($_smarty_tpl->tpl_vars['navAdminEnabled']->value){?><li <?php if ($_smarty_tpl->tpl_vars['navAdminActive']->value){?> class="active" <?php }?>><a href="/onecal/calendar/admin">Admin</a></li><?php }?>
              <li><a href="/onecal/calendar/logout">Logout</a></li>
            </ul>
          </div>
        </div>
      </div>
     </div>



	<div class="container" style="margin-top: 50px;">
	


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

					<table class="table table-bordered table-striped hide" id="events">
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

    



	<script type="text/javascript" charset="utf-8" language="javascript" src="https://www.filelogix.com/release-datatables/media/js/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf-8" language="javascript" src="https://www.filelogix.com/js/DT_bootstrap.js"></script>
	<script type="text/javascript" charset="utf-8" language="javascript" src="https://www.filelogix.com/js/dataTables.bootstrap.js"></script>
	<script type="text/javascript" charset="utf-8" language="javascript" src="https://www.filelogix.com/js/TableTools.min.js"></script>


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