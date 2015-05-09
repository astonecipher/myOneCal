{extends file="db:CAL_WRAPPER"}

{block name="header-css"}

{/block}

{block name="header-js"}
{/block}

{block name="body"}


<div class="container">
	<div class="row">
		<div class="span4 offset4 well">
			<legend>Please Sign In</legend>
          	{if $alertError}
		<div class="alert alert-error">
                <a class="close" data-dismiss="alert" href="#">Ã</a>Incorrect Username or Password!
                </div>
  		{/if}
			<form method="POST" action="/onecal/calendar/login" accept-charset="UTF-8">
			<input type="text" id="username" class="span4" name="username" placeholder="Username">
			<input type="password" id="password" class="span4" name="password" placeholder="Password">
            <label class="checkbox">
            	<input type="checkbox" name="remember" value="1"> Remember Me
            </label>
			<button type="submit" name="submit" class="btn btn-info btn-block">Sign in</button>
			</form>    

		<div class="toolbar" style="font-size: 13px;"><div class="pull-left"><i class="icon-arrow-left" style="opacity: .45;"></i><a href="calendar/forgot"> Forgot Password?</a></div><div class="pull-right"><a href="calendar/signup">New Account? </a><i class="icon-arrow-right" style="opacity: .45;"></i></div></div>

		</div>

	</div>
</div>




{/block}

{block name="footer-scripts"}
{literal}
{/literal}
{/block}