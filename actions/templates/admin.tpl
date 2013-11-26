<script language="JavaScript" src="js/calendar/calendar_eu.js"></script>
<link rel="stylesheet" href="js/calendar/calendar.css">

<div class="buddyForm">
	<div class="adminGreeting">
		<form name="logout" id="newBuddyForm" method="post" action="{$caller}?action=admin&logout=true">
			<div class="logout" >
				<button type="submit" value="Logout" name="submit">Logout</button>
			</div>
		</form>
	
		<b>Hi {$userdata.firstName}, welcome to the admin page of the Buddy System.</b><br/>
		select your administrative options in the menu below.
	</div>
		
	<div class="options"> 
		<fieldset class="optionsFieldSet">
			<legend class="optionLegend">Administrative options</legend>

			<div class="adminOptions"><a href="{$caller}?action=admin&actionAdmin=buddyList">List of buddies</a></div>
			<div class="adminOptions"><a href="{$caller}?action=admin&actionAdmin=incomingList">List of incomings</a></div>
			<br />
			<div class="adminOptionsDescription">To unlock persons who attended the Buddy info evening:</div>
			<div class="adminOptions"><a href="{$caller}?action=admin&actionAdmin=buddyUnlock">Buddy unlocker</a></div>
			<br />
			<div class="adminOptionsDescription">To match buddies with incomings:</div>
			<div class="adminOptions"><a href="{$caller}?action=admin&actionAdmin=matchingSystem">Maching system</a></div>
			
			<!--div class="adminOptionsDescription">To control the chatrooms (use only when needed!! no fun!):</div><div class="adminOptions"><a href="{$caller}?action=admin&actionAdmin=chatControl">Chat control</a></div-->
		</fieldset>
	</div>	
	
	{if $tableSelect == "listBuddies"}
		<fieldset class="unlockFieldSet">
		<legend class="optionLegend">List of buddies</legend>
			{if $buddyArray != ""}
				<i>total: {$buddyArray|@count}</i>, <del>locked</del>
				<a href="mailto:office@example.com?subject=To%20all%20buddies&bcc=
					{foreach $buddyArray as $buddy}
						{$buddy.email},
					{/foreach}
				">mail buddies</a>
				<table>
					<tr> <th>id</th> <th>First name</th> <th>Last name</th> <th>email</th> <th>available</th> <th>group</th> </tr>
				{foreach $buddyArray as $buddy}
					<tr>
						<td><a href="{$caller}?action=buddyLogin&auth={$buddy.authHash}" target="_blank">{$buddy.id}</a></td>
						<td>{if $buddy.locked}<del>{$buddy.firstName}</del>{else}{$buddy.firstName}{/if}</td>
						<td>{if $buddy.locked}<del>{$buddy.lastName}</del>{else}{$buddy.lastName}{/if}</td>
						<td>{$buddy.email}</td>
						<td>{$buddy.dateAvailable|date_format:"%d.%m.%y"}</td>
						<td>{if $buddy.idGroup != 0}<a href="{$caller}?action=groupChat&auth={$buddy.authHash}" target="_blank">{$buddy.idGroup}</a>{/if}</td>
					</tr>
				{/foreach}
				</table>
			{else}
				No buddies in DB :'(
			{/if}	
		</fieldset>
	{/if}	

	{if $tableSelect == "listIncomings"}
		<fieldset class="unlockFieldSet">
		<legend class="optionLegend">List of Incomings</legend>
			{if $incomingArray != ""}
				<i>total: {$incomingArray|@count}</i>
				<a href="mailto:office@example.com?subject=To%20all%20incomings&bcc=
					{foreach $incomingArray as $incoming}
						{$incoming.email},
					{/foreach}
				">mail incomings</a>
				<table>
					<tr> <th>id</th> <th>First name</th> <th>Last name</th> <th>email</th> <th>arrival</th> <th>group</th> </tr>
				{foreach $incomingArray as $incoming}
					<tr>
						<td><a href="{$caller}?action=incomingLogin&authIncoming={$incoming.authHash}" target="_blank">{$incoming.id}</a></td>
						<!--td><a href="{$caller}?action=admin&actionAdmin=buddyUnlock&unlockByHash={$buddy.hash}" class="unlockField">Unlock</a></td-->
						<td>{$incoming.firstName}</td>
						<td>{$incoming.lastName}</td>
						<td>{$incoming.email}</td>
						<td>{$incoming.dateArrival|date_format:"%d.%m.%y, %a"}</td>
						<td>{if $incoming.idGroup != 0}<a href="{$caller}?action=groupChat&auth={$incoming.authHash}" target="_blank">{$incoming.idGroup}</a>{/if}</td>
					</tr>
				{/foreach}
				</table>
			{else}
				No incomings in DB :'(
			{/if}	
		</fieldset>
	{/if}	

	{if $tableSelect == "buddyUnlock"}
		<fieldset class="unlockFieldSet">
		<legend class="optionLegend">Unlock new buddy's</legend>
			{if $buddyArray.table != ""}
				<i>total: {$buddyArray.table|@count}</i>
				<table>
					<tr> <th>id</th> <th>Unlock</th> <th>First name</th> <th>Last name</th> <th>email</th> </tr>
				{foreach $buddyArray.table as $buddy}
					<tr>
						<td>{$buddy.id}</td>
						<td><a href="{$caller}?action=admin&actionAdmin=buddyUnlock&unlockByHash={$buddy.hash}" class="unlockField">Unlock</a></td>
						<td>{$buddy.firstName}</td>
						<td>{$buddy.lastName}</td>
						<td>{$buddy.email}</td>
					</tr>
				{/foreach}
				</table>
			{else}
				No buddies to unlock!
			{/if}	
		</fieldset>
	{/if}	

	{if $tableSelect == "matchingSystem"}
		<fieldset class="unlockFieldSet">
		<legend class="optionLegend">Match buddies and incomings</legend>
			<b>Stuff for buddy matching</b>
			<form id="matchingForm" method="post" action="{$caller}?action=admin&actionAdmin=matchingSystem&stage=options">
				<div>Number of buddies per group: <input type="text" name="numberBuddies" value="{$buddySystem.numberBuddies}"/></div>
				<div>Number of incomings per group: <input type="text" name="numberIncomings" value="{$buddySystem.numberIncomings}"/></div>
				<div>End of time span dd-mm-yyyy: <input type="text" name="dateAvailable" value="{$buddySystem.dateAvailable}"/>
				<script language="JavaScript">
						new tcal ({
							'formname': 'matchingForm', // form name
							'controlname': 'dateAvailable' // input name
						});
					</script></div>
				<div class="submitButton" align="left">
					<button type="submit" value="Submit" name="submit">Preview groups</button>
				</div>
			</form>
			{if $stage == "options"}
				<form id="matchesForm" method="post" action="{$caller}?action=admin&actionAdmin=matchingSystem&stage=saveGroups">
					<br/>
					<table>
						<tr><th></th><th>groups</th><th>buddies</th><th>incomings</th><th>ratio b/i</th></tr>
						<tr>
							<td>Requested</td><td></td><td>{$buddySystem.numberBuddies}</td><td>{$buddySystem.numberIncomings}</td>
							<td>{if $buddySystem.numberIncomings != 0}{$buddySystem.numberBuddies/$buddySystem.numberIncomings}{/if}</td>
						</tr>
						<tr>
							<td>Available</td><td></td><td>{$buddySystem.buddies}</td><td>{$buddySystem.incomings}</td>
							<td>{if $buddySystem.incomings != 0}{$buddySystem.buddies/$buddySystem.incomings}{/if}</td>
						</tr>
						<tr>
							<td>Matched</td><td>{$numberOfCreatedGroups}</td><td>{$buddySystem.buddiesMatched}</td><td>{$buddySystem.incomingsMatched}</td>
							<td>{if $buddySystem.incomingsMatched != 0}{$buddySystem.buddiesMatched/$buddySystem.incomingsMatched}{/if}</td>
						</tr>
						<tr>
							<td>Left</td><td></td>
							<td>{$leftBuddies = $buddySystem.buddies-$buddySystem.buddiesMatched}{$leftBuddies}</td>
							<td>{$leftIncomings = $buddySystem.incomings-$buddySystem.incomingsMatched}{$leftIncomings}</td>
							<td>{if $leftIncomings != 0} {$leftBuddies/$leftIncomings} {/if}</td>
						</tr>
						<tr></tr>
					</table>
					
					<div class="submitButton" align="left">
						<button type="submit" value="Submit" name="submit">Save groups</button>
					</div>

					<table id="matchStatistics">
					<tr><th>Incomings</th>
					{foreach $buddySystem.statistics.incomings as $matchKey => $matchCount}
						<td>{$matchKey}</td>
					{/foreach}
					</tr><tr><td></td>
					{foreach $buddySystem.statistics.incomings as $matchKey => $matchCount}
						<td>{$matchCount}</td>
					{/foreach}
					</tr><tr><th>Buddies</th><td></td>
					{foreach $buddySystem.statistics.buddies as $matchKey => $matchCount}
						<td>{$matchKey}</td>
					{/foreach}
					</tr><tr><td></td><td></td>
					{foreach $buddySystem.statistics.buddies as $matchKey => $matchCount}
						<td>{$matchCount}</td>
					{/foreach}
					</tr>
					</table>

					<table id="matchDetails">
					{foreach $buddySystem.groups as $group}
						<tr><th>group {$group@key}</th><th>ex</th><th>study</th><th>arrival</th><th>country</th><th>lang</th><th>match<th></tr>
						{foreach $group as $student}
							<tr class="{cycle values='colOdd,colEven'}">
							<td>{$student.firstName} {$student.lastName}</td>
							{if $student.type == 'incoming'}
								<td>x</td>
								<td>{$student.idStudy}</td>
								<td>{$student.dateArrival|date_format:"%e %b"}</td>
								<td>{$nations[$student.country]}</td>
								<td>{$student.preferredLanguage}</td>
							{else}
								<td>o</td>
								<td>{$student.idStudy}</td>
								<td>{$student.dateAvailable|date_format:"%e %b"}</td><td>
								{if $student.idPreferredCountryFirst != 0}
									{$nations[$student.idPreferredCountryFirst]}
								{/if}
								{if $student.idPreferredCountrySecond != 0}
									,{$nations[$student.idPreferredCountrySecond]}
								{/if}
								{if $student.idPreferredCountryThird != 0}
									,{$nations[$student.idPreferredCountryThird]}
								{/if}
								</td>
								<td></td>
							{/if}
								<td>{$student.match}</td>
							</tr>
						{/foreach}
						<tr><td></td></tr>
					{/foreach}
					</table>
				</form>
			{/if}
			{if $stage == "saveGroups"}
				<form id="savedForm" method="post" action="{$caller}?action=admin&actionAdmin=matchingSystem&stage=mailGroups">
					All groups are saved to the database but not mailed yet.... Click on the button to do that!
					<div class="submitButton" align="left">
						<button type="submit" value="Submit" name="submit">Mail matched ppl</button>
					</div>
				</form>			
			{/if}
			{if $stage == "mailGroups"}
				<form id="mailForm" method="post" action="{$caller}?action=admin&actionAdmin=matchingSystem&stage=endReport">
					You are done! grab a beer :)
				</form>			
			{/if}							
		</fieldset>
	{/if}		
	
	{if $tableSelect == "chatControl"}
		<fieldset class="unlockFieldSet">
		<legend class="optionLegend">Unlock new buddy's</legend>
			Admin and check on group chats
			
			
			
		</fieldset>
	{/if}	
	
		
</div>
