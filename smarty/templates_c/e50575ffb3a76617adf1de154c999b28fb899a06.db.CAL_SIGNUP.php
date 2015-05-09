<?php /* Smarty version Smarty-3.1.13, created on 2015-05-07 14:17:51
         compiled from "db:cal_signup" */ ?>
<?php /*%%SmartyHeaderCode:211343540554bac4f28da26-78373418%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e50575ffb3a76617adf1de154c999b28fb899a06' => 
    array (
      0 => 'db:cal_signup',
      1 => 1401298080,
      2 => 'db',
    ),
    'ff49eb36fc5b9b42d02790a8e9fc6744dac033c2' => 
    array (
      0 => 'db:cal_wrapper',
      1 => 1427811977,
      2 => 'db',
    ),
  ),
  'nocache_hash' => '211343540554bac4f28da26-78373418',
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
  'unifunc' => 'content_554bac4fca11b2_71816106',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_554bac4fca11b2_71816106')) {function content_554bac4fca11b2_71816106($_smarty_tpl) {?><!DOCTYPE html>
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
	


<div class="container">
	<div class="row">
		<div class="span4 offset4 well">
			<legend>Sign Up for an Account</legend>
          	<?php if ($_smarty_tpl->tpl_vars['alertError']->value){?>
			<div class="alert alert-error">
                		<a class="close" data-dismiss="alert" href="#">×</a><?php echo $_smarty_tpl->tpl_vars['errorMsg']->value;?>

                		</div>
  		<?php }?>
          	<?php if ($_smarty_tpl->tpl_vars['alertSuccess']->value){?>
			<div class="alert alert-success">
                		<?php echo $_smarty_tpl->tpl_vars['successMsg']->value;?>

                		</div>
  		<?php }?>		
			<div class="<?php echo $_smarty_tpl->tpl_vars['signUpHide']->value;?>
" id="signup">
			<form method="POST" action="/calendar/signup" accept-charset="UTF-8">
			<label>Email Address?</label>
			<input type="text" id="emailAddress" class="input span4" name="emailAddress" value="<?php echo $_smarty_tpl->tpl_vars['emailAddress']->value;?>
" placeholder="Email Address" required>
			<label>First Name?</label>
			<input type="text" id="firstName" class="input span4" name="firstName" value="<?php echo $_smarty_tpl->tpl_vars['firstName']->value;?>
" placeholder="First Name" required>
			<label>Last Name?</label>
			 <input type="text" id="lastName" class="input span4" name="lastName" value="<?php echo $_smarty_tpl->tpl_vars['lastName']->value;?>
" placeholder="Last Name" required>
			<label>Organization or Company?</label>
			 <input type="text" id="lastName" class="input span4" name="organization" value="<?php echo $_smarty_tpl->tpl_vars['organization']->value;?>
" placeholder="Organization / Company" required>
			<label>Phone Number?</label>
			 <input type="text" id="phoneNumber" class="input span4" name="phoneNumber" value="<?php echo $_smarty_tpl->tpl_vars['phoneNumber']->value;?>
" placeholder="Phone Number" required>
									

			<button type="submit" name="submit" class="btn btn-info btn-block" value="submit">Sign Up</button>
			</form>    
		</div>
<br>
		<div class="toolbar"><div class="pull-left"><i class="icon-arrow-left" style="opacity: .45;"></i><a href="calendar/forgot"> Forgot Password?</a></div><div class="pull-right"><a href="calendar/login">Login? </a><i class="icon-arrow-right" style="opacity: .45;"></i></div></div>

		</div>

	</div>
</div>





	</div>

    



  </body>
</html>



<?php }} ?>