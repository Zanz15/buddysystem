<div class="buddyForm">
	<form name="loginForm" id="loginForm" method="post" action="{$caller}?action=admin">
		<div class="loginText" align="center">
			<b>Please login</b><br />
		</div>
	
		{if $error != ""}
			<fieldset class="errorFieldSet">
			<legend>Oops! something went wrong</legend>
			<div class="errorField">
				{foreach $error as $err}
				    <li>{$err}</li>
				{/foreach}
			</div>
			</fieldset>
		{/if}
	
		<table class="table">
			<tr>
				<td>Username*:</td>
				<td><input type="text" name="username" value="{$firstName}"/></td>
			</tr>
			<tr>
				<td>Password*:</td>
				<td><input type="password" name="password" value="{$lastName}"/></td>
			</tr>
		</table>
		
		<div class="submitButton" align="center">
			<button type="submit" value="Login" name="submit">Submit</button>
		</div>
		
	</form>
</div>
