<script language="JavaScript" src="{$buddysys_baseUrl}js/calendar/calendar_eu.js"></script>
<script language="JavaScript" src="{$buddysys_baseUrl}js/buddySystem.js"></script>
<link rel="stylesheet" href="{$buddysys_baseUrl}js/calendar/calendar.css">

	<div class="buddyForm">
		<form name="newIncomingForm" id="newIncomingForm" method="post" action="{$caller}?action=newIncoming&validate=true">
			<div class="textfield" >
				<h1>Dear new Erasmus student!</h1>
				
				<p>On this page you can register yourself to our buddy system. After the registration process you will receive an email with a link where you can change or delete your data.</p>
					
				<p>Before your arrival you will be assigned to a buddy group which contains local students and other exchange students.	The locals will help you making your first steps in Example City together with your fellow incoming friends.</p>
				
				<p>In case of further questions read the <a href="http://example.com/faq">FAQ's</a> or contact our <a href="mailto:office@example.com">office</a>.</p>
			
				<p>Best regards,<br/>
				your ESN Example Team</p>
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
				<td><input type="text" name="email" id="email" onchange="validateEmail('newIncomingForm','email', 'emailConfirm', 'emailConfirmDiv');" value="{$email0}"/></td>
			</tr>
			<tr>
				<td><label for="emailConfirm">Email confirm</label></td>
				<td>*</td>
				<td><input type="text" name="emailConfirm" id="emailConfirm" onchange="validateEmail('newIncomingForm','email', 'emailConfirm', 'emailConfirmDiv');" value="{$email1}"/> 
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
				<td><label for="dateArrivalInput">Date of arrival</label</td>
				<td>*</td>
				<td>
				<input type="text" name="dateArrivalInput" id="dateArrivalInput" value="{$dateArrivalInput}" onchange="validateDate('newIncomingForm', 'dateArrivalInput', 'dateFeedback');"/>
					<script language="JavaScript">
						new tcal ({
							// form name
							'formname': 'newIncomingForm',
							// input name
							'controlname': 'dateArrivalInput'
						});
		
					</script><br/>
					Date format: dd-mm-yy <div id="dateFeedback"></div>
					
			</td>
			</tr>	
			<tr><td colspan=2><p>* mandatory fields</p></td></tr>
			
		</table>
		
		<div class="submitButton" align="center">
			<button type="submit" value="Submit" name="submit">Submit</button>
		</div>
	</form>
	</div>
