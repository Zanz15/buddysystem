<script type="text/javascript">
	document.getElementById("bottom").focus();
</script>
<meta http-equiv="refresh" content="4">

	<div class="chatArea">
		{foreach $messages as $message}
			<div class="messageBox" style="background-color: #d3e6ed; ">
				<div class="mSender"><b>{$message.sender}</b> <small>{$message.date}</small></div>
				<div  ><textarea class="mMessage" cols="55" rows="2">{$message.message}</textarea></div>
			</div>
		{/foreach}
	</div>
	
	
<a id="bottom"></a>
