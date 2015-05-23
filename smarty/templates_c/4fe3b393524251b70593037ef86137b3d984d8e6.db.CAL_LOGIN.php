<?php /* Smarty version Smarty-3.1.13, created on 2015-05-21 21:08:59
         compiled from "db:cal_login" */ ?>
<?php /*%%SmartyHeaderCode:168278543555d724b9bf245-01385827%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4fe3b393524251b70593037ef86137b3d984d8e6' => 
    array (
      0 => 'db:cal_login',
      1 => 1432189387,
      2 => 'db',
    ),
    '96e98dc0a071e9031638794927f1d96551ac1b8e' => 
    array (
      0 => 'db:cal_dashboard',
      1 => 1432221475,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '168278543555d724b9bf245-01385827',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_555d724bc6edb9_99783961',
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
<?php if ($_valid && !is_callable('content_555d724bc6edb9_99783961')) {function content_555d724bc6edb9_99783961($_smarty_tpl) {?><!DOCTYPE html>
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




   
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="/assets/css/dashboard.css" rel="stylesheet">

   

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

	


<div class="container">
	<div class="row">
		<div class="col-sm-6 col-md-4 col-md-offset-4 well">
			<legend>Please Sign In</legend>
          	<?php if ($_smarty_tpl->tpl_vars['alertError']->value){?>
		<div class="alert alert-error">
                <a class="close" data-dismiss="alert" href="#"></a>Incorrect Username or Password!
                </div>
  		<?php }?>
			<form method="POST" action="/calendar/login" accept-charset="UTF-8">
			<input type="text" id="username" class="form-control" name="username" placeholder="Username">
			<input type="password" id="password" class="form-control" name="password" placeholder="Password">
            <label class="checkbox-inline">
            	<input type="checkbox" name="remember" value="1"> Remember Me
            </label> 
			<button type="submit" name="submit" class="btn btn-info btn-block">Sign in</button>
			</form>    

		<div class="toolbar" style="font-size: 13px;"><div class="pull-left"><i class="icon-arrow-left" style="opacity: .45;"></i><a href="calendar/forgot"> Forgot Password?</a></div><div class="pull-right"><a href="calendar/signup">New Account? </a><i class="icon-arrow-right" style="opacity: .45;"></i></div></div>

		</div>

	</div>
</div>





	</div>
	
	
    



  </body>
</html>
<?php }} ?>