<script language="JavaScript" src="{$buddysys_baseUrl}js/calendar/calendar_eu.js"></script>
<script language="JavaScript" src="{$buddysys_baseUrl}js/buddySystem.js"></script>
<link rel="stylesheet" href="{$buddysys_baseUrl}js/calendar/calendar.css">

<div class="buddyForm">
	<form name="newBuddyForm" id="newBuddyForm" method="post" action="{$caller}?action=newBuddy&validate=true">
		<div class="textfield" >
			<h1>Lieber Buddy!</h1>

			<p>Danke, dass du dich dafür entschieden hast bei ESN Example mitzumachen.
			Nach deiner Anmeldung bekommst du ein E-Mail mit einem Bestätigungslink mit dem du auch deine Daten bearbeiten kannst.</p>

			<p>Rechtzeitig vor der Ankunft deiner Austauschstudierenden (Exchangee) werden wir dich einer Buddy-Gruppe zuteilen. Eine Buddy-Gruppe besteht aus 2-3 TU-Studierenden (Buddy) und 3-4 Austauschstudierenden.</p>
		
			<p>Dein ESN Example Team</p>
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
				<td><label for="firstname">Vorname</label></td>
				<td>*</td>
				<td><input type="text" name="firstname" id="firstname" value="{$firstName}"/></td>
			</tr>
			<tr>
				<td><label for="lastname">Nachname</label></td>
				<td>*</td>
				<td><input type="text" name="lastname" id="lastname" value="{$lastName}"/></td>
			</tr>
			<tr>
				<td><label for="email">E-Mail</label></td>
				<td>*</td>
				<td><input type="text" name="email" id="email" onchange="validateEmail('newBuddyForm','email', 'emailConfirm', 'emailConfirmDiv');" value="{$email0}"/></td>
			</tr>
			<tr>
				<td><label for="emailConfirm">E-Mail wiederholen</label></td>
				<td>*</td>
				<td><input type="text" name="emailConfirm" id="emailConfirm" onchange="validateEmail('newBuddyForm','email','emailConfirm', 'emailConfirmDiv');" value="{$email1}"/> 
				<div id="emailConfirmDiv"></div></td>
			</tr>
			<tr>
				<td><label for="buddyBefore">Warst du schon mal Buddy?</label></td>
				<td>*</td>
				<td>
					<input type="radio" name="buddyBefore" id="buddyBefore" value="1" {$buddyBefore.checkedBuddy1}> Ja</input> 
					<input type="radio" name="buddyBefore" id="buddyBefore" value="0" {$buddyBefore.checkedBuddy0}> Nein </input>
				</td>
			</tr>

			<tr>
				<td><label for="preferredCountry1">Bevorzugtes Land 1</label></td>
				<td></td>
				<td>{html_options name=preferredCountry1 id=preferredCountry1 options=$countries selected=$countriesSelected1}</td>
			</tr>
			<tr>
				<td><label for="preferredCountry2">Bevorzugtes Land 2</label></td>
				<td></td>
				<td>{html_options name=preferredCountry2 id=preferredCountry2 options=$countries selected=$countriesSelected2}</td>
			</tr>
			<tr>
				<td><label for="preferredCountry3">Bevorzugtes Land 3</label></td>
				<td></td>
				<td>{html_options name=preferredCountry3 id=preferredCountry3 options=$countries selected=$countriesSelected3}</td>
			</tr>
			<tr>
				<td><label for="studySelect">Studium</label></td>
				<td>*</td>
				<td>{html_options name=studySelect id=studySelect options=$studies selected=$studiesSelected}</td>
			</tr>
			{if $use_tandem}
			<tr>
				<td><label for="tandem">Interessiert an einem Sprach-Tandem?</label></td>
				<td></td>
				<td><input type="radio" name="tandem" id="tandem" value="1" {$tandem.checkedTandem1} > Yes</input> 
				<input type="radio" name="tandem" id="tandem" value="0" {$tandem.checkedTandem0} > No </input></td>
			</tr>
			{/if}
			
			<tr>
				<td><label for="availableFrom">Verfügbar ab</label></td>
				<td>*</td>
				<td>
					{foreach $infoEvenings as $infoEveName=>$infoEveDate}
				 		<input type="radio" name="availableFrom" "availableFrom" value="{$infoEveDate}" onchange="changeInputDate('{$infoEveDate}');">{$infoEveName} ({$infoEveDate})</input><br/>
					{/foreach}

					<input type="text" name="availableFromInput" id="availableFrom" value="{$availableFromInput}" onchange="validateDate('newBuddyForm', 'availableFromInput', 'dateFeedback');"/>
					<script language="JavaScript">
						new tcal ({
							'formname': 'newBuddyForm', // form name
							'controlname': 'availableFromInput' // input name
						});
					</script><br/>
					Datumsformat: tt-mm-yy <div id="dateFeedback"></div>
			</td>
			</tr>	
			<tr><td colspan="2"><p>* Pflichtfelder</p></td></tr>
			
		</table>
		
		<div class="submitButton" align="center">
			<button type="submit" value="Submit" name="submit">Bestätigen</button>
		</div>
				
		
	</form>
</div>
