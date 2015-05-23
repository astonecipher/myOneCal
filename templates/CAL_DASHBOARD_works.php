<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="http://dev.onecal.co.php53-13.dfw1-1.websitetestlink.com/">
    <meta charset="utf-8">
    <title>{block name="title"}OneCal Calendar Portal{/block}</title>
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




   {block name="header-css"} {/block}
   {block name="header-js"} 


    <script type="text/javascript" src="https://www.filelogix.com/js/bootstrap.min.js"/></script>
   {/block}
     <script type="text/javascript" src="/js/jquery-1-10-2.min.js"></script>
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
 <!--         <div class="nav-collapse collapse">
            <ul class="nav">
              <li {if $navHomeActive} class="active" {/if}><a href="/calendar/home">Home</a></li>
             <li {if $navInboxActive} class="active" {/if}><a href="/calendar/inbox">Inbox</a></li>
              <li {if $navCreateActive} class="active" {/if}><a href="/calendar/add">Create</a></li>
              <li {if $navManageActive} class="active" {/if}><a href="/calendar/manage">Manage</a></li>
              <li {if $navShareActive} class="active" {/if}><a href="/calendar/share">Share</a></li>
              <li {if $navFeedsActive} class="active" {/if}><a href="/feeds">Feed</a></li>
              <li {if $navSupportActive} class="active" {/if}><a href="/calendar/support">Support</a></li>
              {if $navAdminEnabled}<li {if $navAdminActive} class="active" {/if}><a href="/calendar/admin">Admin</a></li>{/if}
              {if $navHomeActive || $navInboxActive || $navCreateActive || $navManageActive || $navShareActive || $navFeedsActive || $navSupportActive ||  $navAdminActive} 
              <li><a href="/calendar/logout">Logout</a></li>
              {/if}
            </ul>
          </div> -->
        </div>
      </div>
     </div>

      
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
              <li {if $navHomeActive} class="active" {/if}><a href="/calendar/home">Home</a></li>
             <li {if $navInboxActive} class="active" {/if}><a href="/calendar/inbox">Inbox</a></li>
              <li {if $navCreateActive} class="active" {/if}><a href="/event/add">Create</a></li>
              <li {if $navManageActive} class="active" {/if}><a href="/calendar/manage">Manage</a></li>
              <li {if $navShareActive} class="active" {/if}><a href="/calendar/share">Share</a></li>
              <li {if $navFeedsActive} class="active" {/if}><a href="/feeds">Feed</a></li>
              <li {if $navSupportActive} class="active" {/if}><a href="/calendar/support">Support</a></li>
              {if $navAdminEnabled}<li {if $navAdminActive} class="active" {/if}><a href="/calendar/admin">Admin</a></li>{/if}
              {if $navHomeActive || $navInboxActive || $navCreateActive || $navManageActive || $navShareActive || $navFeedsActive || $navSupportActive ||  $navAdminActive} 
              <li><a href="/calendar/logout">Logout</a></li>
              {/if}
          </ul>
          <ul class="nav nav-sidebar">
	{foreach $calendars as $calendar}
		<li><a href="/calendar/home/{$calendar.sShortName}">{$calendar.sName}</a></li>
	{/foreach}	
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          
	<div class="container" >
<!--	<h1 class="page-header">Dashboard</h1> -->
	{block name="body"}
	{/block}
	</div>
	
	
    {block name="footer-scripts"}
    {/block}
  </body>
</html>
