<script language="JavaScript" src="{$buddysys_baseUrl}js/calendar/calendar_eu.js"></script>
<script language="JavaScript" src="{$buddysys_baseUrl}js/buddySystem.js"></script>
<link rel="stylesheet" href="{$buddysys_baseUrl}js/calendar/calendar.css">

	<div class="buddyForm">
		<form name="newIncomingForm" id="newIncomingForm" method="post" action="{$action}">
	
			<div class="textfield">
				<h1>Dear Erasmus student!</h1>

				<p>You used the link that was sent to you in the confirmation email. Here you can change and delete your personal data. This can be done until we are starting to make matches between buddies and their new international friends.</p>
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
					<td><label for="countrySelected">Nationality</label></td>
					<td></td>
					<td>{html_options name=countrySelected id=countrySelected options=$countries selected=$countrySelected}</td>
				</tr>
				{if $usePreferredLanguage}
				<tr>
					<td><label for="preferredLanguageSelected">Preferred language</label></td>
					<td></td>
					<td>{html_options name=preferredLanguageSelected id=preferredLanguageSelected options=$preferredLanguage selected=$preferredLanguageSelected}</td>
				</tr>
				{/if}
				<tr>
					<td><label for="studySelect">Study</label></td>
					<td>*</td>
					<td>{html_options name=studySelect id=studySelect options=$studies selected=$studiesSelected}</td>
				</tr>
				<tr>
					<td><label for="dateArrivalInput">Date of arrival</label></td>
					<td>*</td>
					<td>
					<input type="text" name="dateArrivalInput" id="dateArrivalInput" value="{$dateArrivalInput}"/>
						<script language="JavaScript">
							new tcal ({
								// form name
								'formname': 'newIncomingForm',
								// input name
								'controlname': 'dateArrivalInput'
							});
			
						</script><br/><br/>
						
				</td>
				</tr>	
				
			</table>
		
			<div class="submitButton" align="center">
				<button type="submit" value="Submit" name="submit">Submit</button>
			</div>
			<br />
			<div class="submitButton" align="center">
				<button type="button" value="Delete me" name="deleteButton" ONCLICK="window.location.href='{$caller}?action=deleteIncoming&auth={$authHash}'">Delete me</button>
			</div>		

	</form>

</div>
