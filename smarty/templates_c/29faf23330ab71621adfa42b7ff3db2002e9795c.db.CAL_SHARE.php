<?php /* Smarty version Smarty-3.1.13, created on 2015-04-01 12:37:12
         compiled from "db:cal_share" */ ?>
<?php /*%%SmartyHeaderCode:636684507551c1eb8676563-64697787%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '29faf23330ab71621adfa42b7ff3db2002e9795c' => 
    array (
      0 => 'db:cal_share',
      1 => 1399045643,
      2 => 'db',
    ),
    'ff49eb36fc5b9b42d02790a8e9fc6744dac033c2' => 
    array (
      0 => 'db:cal_wrapper',
      1 => 1427811977,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '636684507551c1eb8676563-64697787',
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
  'unifunc' => 'content_551c1eb876de29_58959681',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_551c1eb876de29_58959681')) {function content_551c1eb876de29_58959681($_smarty_tpl) {?><!DOCTYPE html>
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




   
	<link media="all" rel="stylesheet" type="text/css" href="/buzz/css/bootstrap-datetimepicker.min.css" />
	<link media="all" rel="stylesheet" type="text/css" href="/css/bootstrap-switch.css" />


   


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
	
<div class="well">
Please contact your account representative to discuss sharing options and feeds not listed below.
</div>

<div class="well">
Tiny: <a href="http://www.iwantabuzz.com/index.php?RID=jacksonville-fl&PAGE=index_calendar&TEMPLATE=tiny_calendar" target="_new"> Tiny Calendar on Buzz Site </a>
</div>

<div class="well">
Small: <a href="http://www.iwantabuzz.com/index.php?RID=jacksonville-fl&PAGE=index_calendar&TEMPLATE=default_calendar" target="_new"> Small Calendar on Buzz Site </a>
</div>

<div class="well">
Large: <a href="http://www.iwantabuzz.com/index.php?RID=jacksonville-fl&PAGE=calendar&TEMPLATE=calendar" target="_new"> Large Calendar on Buzz Site </a>
or <a href="http://www.letsgomaa.org/calendar.php"> Large Calendar on LetsGoMAA Site </a>
</div>

<div class="well">
Event Details: <a href="http://www.iwantabuzz.com/index.php?RID=jacksonville-fl&PAGE=calendar&TEMPLATE=calendar&eventID=823480" target="_new"> Event Details Example on Buzz Site </a>
</div>

<div class="well">
Standard Calendar: <a href="http://www.iwantabuzz.com/index.php?RID=jacksonville-fl&PAGE=calendarFull&TEMPLATE=calendarFull" target="_new"> Standard Calendar on Buzz Site </a>
or  <a href="http://www.jax-homes.com/calendar"> Standard Calendar on Jax-Homes </a>
</div>

<div class="well">
New Event: <a href="http://www.iwantabuzz.com/index.php?RID=jacksonville-fl&PAGE=submitEvent&TEMPLATE=submitEvent" target="_new"> New Event Example Buzz Site </a>
</div>

<div class="well">
Data Feed: <a href="http://www.filelogix.com/buzz/calendar/feed" target="_new"> Sample Data Feed </a>
</div>


	</div>

    



<script type="text/javascript" src="/buzz/js/bootstrap-datetimepicker.min.js"></script>



  </body>
</html>



<?php }} ?>