<div class="buddyForm">
	
	<div style="padding-left:25px;">
		<b>Welcome the the ESN Buddy group chat page</b><br />
		You can use the old login URL again to alter your data.<br />
		<br />
		Your ESN Example team!
		<br />
		<br />
		<a href="mailto:
			{foreach $user.buddies as $buddy}
				{$buddy.email},
			{/foreach}
			{foreach $user.incomings as $incoming}
				{$incoming.email},
			{/foreach}
			?subject=Hello%20from%20the%20buddy%20group
		">Mail to the whole group</a>
	</div>

	<div class="userInfo">
		<br />
		<div style="margin-left:25px; margin-bottom: 15px;"><b>Buddies:</b></div>
		{foreach $user.buddies as $buddy}
			<div class="infoBox" style="background-color: #d3e6ed;">
				<b>{$buddy.firstName} {$buddy.lastName}</b><br/>
				<A HREF="mailto:{$buddy.email}">{$buddy.email}</A><br/>
				{$buddy.study}<br/>
				{$buddy.country}<br/>
			</div>
		{/foreach}
		<br class="clearBoth" />
		<div style="margin-left:25px; margin-bottom: 15px;"><b>Incomings:</b></div>
		{foreach $user.incomings as $incoming}
			<div class="infoBox" style="background-color: #d3e6ed;">
				<b>{$incoming.firstName} {$incoming.lastName}</b><br/>
				<A HREF="mailto:{$incoming.email}">{$incoming.email}</A><br/>
				{$incoming.study}<br/>
				{$incoming.country}<br/>
			</div>
		{/foreach}
		<br class="clearBoth" />
		<br />
		<div align="center">Group Chat </div>
<!--		(this is what others are seeing of you. Send an e-mail to office@example.com when you want to be removed from this chat!)-->
	</div>
	<br />
	<div align="center" class="iFrame" border="0">
	<iframe id="chatFrame" src="{$caller}?action=chat&auth={$authHash}" width="420px" height="300" frameborder="0" style="overflow:auto;">
  		<p>Your browser does not support iframes.</p>
	</iframe>
	</div>
	
	
	<div class="newMessage">
		<form method="post" action="{$caller}?action=groupChat&auth={$authHash}#anchor" id="anchor">
			<div align="center" style="margin-top: 7px;">
			New message: <input type="text" name="message" size="60" maxlength="140"/>
			<div class="submitButton" align="center">
				<button type="submit" value="Submit" name="submit">Send message</button>
			</div>	
			</div>			 
		</form>
	</div>	
</div>
