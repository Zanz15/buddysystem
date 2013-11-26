<script language="JavaScript" src="{$buddysys_baseUrl}js/calendar/calendar_eu.js"></script>
<script language="JavaScript" src="{$buddysys_baseUrl}js/buddySystem.js"></script>
<link rel="stylesheet" href="{$buddysys_baseUrl}js/calendar/calendar.css">

<div class="buddyForm">
<form name="newBuddyForm" id="newBuddyForm" method="post" action="{$action}">

		<div class="textfield">
			<h1>Dear buddy!</h1>

			<p>You used the link that was sent to you in the confirmation email. Here you can change your personal data. This can be done until we are starting to make matches between buddies and their new international friends.</p>

			<p>Thanks for the effort,<br />
			Your ESN Example Team</p>
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
		<td><label for="firstname">First name</label></td>
		<td>*</td>
		<td><input type="text" name="firstname" id="firstname" value="{$firstName}"/></td>
	</tr>
	<tr>
		<td><label for="lastname">Last name</label></td>
		<td>*</td>
		<td><input type="text" name="lastname" id="lastname" value="{$lastName}"/></td>
	</tr>
	<tr>
		<td><label for="email">Email</label></td>
		<td>*</td>
		<td><input type="text" name="email" id="email" onchange="validateEmail('newBuddyForm','email');" value="{$email0}"/></td>
	</tr>
	<tr>
		<td><label for="emailConfirm">Email confirm</label></td>
		<td>*</td>
		<td><input type="text" name="emailConfirm" id="emailConfirm" onchange="validateEmail('newBuddyForm','emailConfirm');" value="{$email1}"/> 
		<div id="emailConfirmDiv"></div></td>
	</tr>
	<tr>
		<td><label for="preferredCountry1">Preferred country 1</label></td>
		<td></td>
		<td>{html_options name=preferredCountry1 id=preferredCountry1 options=$countries selected=$countriesSelected1}</td>
	</tr>
	<tr>
		<td><label for="preferredCountry2">Preferred country 2</label></td>
		<td></td>
		<td>{html_options name=preferredCountry2 id=preferredCountry2 options=$countries selected=$countriesSelected2}</td>
	</tr>
	<tr>
		<td><label for="preferredCountry3">Preferred country 3</label></td>
		<td></td>
		<td>{html_options name=preferredCountry3 id=preferredCountry3 options=$countries selected=$countriesSelected3}</td>
	</tr>
	<tr>
		<td><label for="studySelect">Study</label></td>
		<td>*</td>
		<td>{html_options name=studySelect id=studySelect options=$studies selected=$studiesSelected}</td>
	</tr>
	{if $use_tandem}
	<tr>
		<td><label for="tandem">Tandem</label></td>
		<td></td>
		<td>
			<input type="radio" name="tandem" id="tandem" value="1" {$tandem.checkedTandem1} > Yes</input>
			<input type="radio" name="tandem" id="tandem" value="0" {$tandem.checkedTandem0} > No </input>
		</td>
	</tr>
	{/if}
	<tr>
		<td><label for="buddyBefore">Were you a buddy before?</label></td>
		<td>*</td>
		<td>
			<input type="radio" name="buddyBefore" id="buddyBefore" value="1" {$buddyBefore.checkedBuddy1}> Yes</input>
			<input type="radio" name="buddyBefore" id="buddyBefore" value="0" {$buddyBefore.checkedBuddy0}> No </input>
		</td>
	</tr>	

	<tr>
		<td><label for="availableFrom">Available from</label></td>
		<td>*</td>
		<td>
			{foreach $infoEvenings as $infoEveName=>$infoEveDate}
				<input type="radio" name="availableFrom" id="availableFrom" value="{$infoEveDate}" onchange="changeInputDate('{$infoEveDate}');">{$infoEveName} ({$infoEveDate})</input><br/>
			{/foreach}
			<input type="text" name="availableFromInput" id="availableFrom" value="{$availableFromInput}"/>
			<script language="JavaScript">
				new tcal ({
					'formname': 'newBuddyForm', // form name
					'controlname': 'availableFromInput'}); // input name
			</script><br/><br/>
	</td>
	</tr>	

</table>

		<div class="submitButton" align="center">
			<button type="submit" value="Submit" name="submit">Submit</button>
		</div>
		<br />
		<div class="submitButton" align="center">
			<button type="button" value="Delete me" name="deleteButton" ONCLICK="window.location.href='{$caller}?action=deleteBuddy&auth={$authHash}'">Delete me</button>
		</div>		

</form>

</div>
