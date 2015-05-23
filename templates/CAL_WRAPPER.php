<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="http://www.onecal.co.php53-13.dfw1-1.websitetestlink.com/">
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




   {block name="header-css"} {/block}
   {block name="header-js"} 
     <script type="text/javascript" src="https://onecal.co/js/jquery-1-10-2.min.js"></script>

    <script type="text/javascript" src="https://www.filelogix.com/js/bootstrap.min.js"/></script>
   {/block}
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
              <li {if $navHomeActive} class="active" {/if}><a href="/onecal/calendar/home">Home</a></li>
             <li {if $navInboxActive} class="active" {/if}><a href="/onecal/calendar/inbox">Inbox</a></li>
              <li {if $navCreateActive} class="active" {/if}><a href="/onecal/calendar/add">Create</a></li>
              <li {if $navManageActive} class="active" {/if}><a href="/onecal/calendar/manage">Manage</a></li>
              <li {if $navShareActive} class="active" {/if}><a href="/onecal/calendar/share">Share</a></li>
              <li {if $navFeedsActive} class="active" {/if}><a href="/onecal/calendar/feeds">Feed</a></li>
              <li {if $navSupportActive} class="active" {/if}><a href="/onecal/calendar/support">Support</a></li>
              {if $navAdminEnabled}<li {if $navAdminActive} class="active" {/if}><a href="/onecal/calendar/admin">Admin</a></li>{/if}
              <li><a href="/onecal/calendar/logout">Logout</a></li>
            </ul>
          </div>
        </div>
      </div>
     </div>



	<div class="container" style="margin-top: 50px;">
	{block name="body"}
	{/block}
	</div>

    {block name="footer-scripts"}
    {/block}
  </body>
</html>



