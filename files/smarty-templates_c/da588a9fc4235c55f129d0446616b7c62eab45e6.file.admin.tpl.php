<?php /* Smarty version 3.0rc1, created on 2013-10-13 23:25:04
         compiled from "C:\Users\stephan\repos\buddysystem\actions\templates\admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14827525b0fb04c5af0-29801779%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'da588a9fc4235c55f129d0446616b7c62eab45e6' => 
    array (
      0 => 'C:\\Users\\stephan\\repos\\buddysystem\\actions\\templates\\admin.tpl',
      1 => 1379876100,
    ),
  ),
  'nocache_hash' => '14827525b0fb04c5af0-29801779',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'C:\Users\stephan\repos\buddysystem\libs\smarty\plugins\modifier.date_format.php';
if (!is_callable('smarty_function_cycle')) include 'C:\Users\stephan\repos\buddysystem\libs\smarty\plugins\function.cycle.php';
?><script language="JavaScript" src="js/calendar/calendar_eu.js"></script>
<link rel="stylesheet" href="js/calendar/calendar.css">

<div class="buddyForm">
	<div class="adminGreeting">
		<form name="logout" id="newBuddyForm" method="post" action="<?php echo $_smarty_tpl->getVariable('caller')->value;?>
?action=admin&logout=true">
			<div class="logout" >
				<button type="submit" value="Logout" name="submit">Logout</button>
			</div>
		</form>
	
		<b>Hi <?php echo $_smarty_tpl->getVariable('userdata')->value['firstName'];?>
, welcome to the admin page of the Buddy System.</b><br/>
		select your administrative options in the menu below.
	</div>
		
	<div class="options"> 
		<fieldset class="optionsFieldSet">
			<legend class="optionLegend">Administrative options</legend>

			<div class="adminOptions"><a href="<?php echo $_smarty_tpl->getVariable('caller')->value;?>
?action=admin&actionAdmin=buddyList">List of buddies</a></div>
			<div class="adminOptions"><a href="<?php echo $_smarty_tpl->getVariable('caller')->value;?>
?action=admin&actionAdmin=incomingList">List of incomings</a></div>
			<br />
			<div class="adminOptionsDescription">To unlock persons who attended the Buddy info evening:</div>
			<div class="adminOptions"><a href="<?php echo $_smarty_tpl->getVariable('caller')->value;?>
?action=admin&actionAdmin=buddyUnlock">Buddy unlocker</a></div>
			<br />
			<div class="adminOptionsDescription">To match buddies with incomings:</div>
			<div class="adminOptions"><a href="<?php echo $_smarty_tpl->getVariable('caller')->value;?>
?action=admin&actionAdmin=matchingSystem">Maching system</a></div>
			
			<!--div class="adminOptionsDescription">To control the chatrooms (use only when needed!! no fun!):</div><div class="adminOptions"><a href="<?php echo $_smarty_tpl->getVariable('caller')->value;?>
?action=admin&actionAdmin=chatControl">Chat control</a></div-->
		</fieldset>
	</div>	
	
	<?php if ($_smarty_tpl->getVariable('tableSelect')->value=="listBuddies"){?>
		<fieldset class="unlockFieldSet">
		<legend class="optionLegend">List of buddies</legend>
			<?php if ($_smarty_tpl->getVariable('buddyArray')->value!=''){?>
				<i>total: <?php echo count($_smarty_tpl->getVariable('buddyArray')->value);?>
</i>, <del>locked</del>
				<a href="mailto:office@example.com?subject=To%20all%20buddies&bcc=
					<?php  $_smarty_tpl->tpl_vars['buddy'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('buddyArray')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['buddy']->key => $_smarty_tpl->tpl_vars['buddy']->value){
?>
						<?php echo $_smarty_tpl->tpl_vars['buddy']->value['email'];?>
,
					<?php }} ?>
				">mail buddies</a>
				<table>
					<tr> <th>id</th> <th>First name</th> <th>Last name</th> <th>email</th> <th>available</th> <th>group</th> </tr>
				<?php  $_smarty_tpl->tpl_vars['buddy'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('buddyArray')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['buddy']->key => $_smarty_tpl->tpl_vars['buddy']->value){
?>
					<tr>
						<td><a href="<?php echo $_smarty_tpl->getVariable('caller')->value;?>
?action=buddyLogin&auth=<?php echo $_smarty_tpl->tpl_vars['buddy']->value['authHash'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['buddy']->value['id'];?>
</a></td>
						<td><?php if ($_smarty_tpl->tpl_vars['buddy']->value['locked']){?><del><?php echo $_smarty_tpl->tpl_vars['buddy']->value['firstName'];?>
</del><?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['buddy']->value['firstName'];?>
<?php }?></td>
						<td><?php if ($_smarty_tpl->tpl_vars['buddy']->value['locked']){?><del><?php echo $_smarty_tpl->tpl_vars['buddy']->value['lastName'];?>
</del><?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['buddy']->value['lastName'];?>
<?php }?></td>
						<td><?php echo $_smarty_tpl->tpl_vars['buddy']->value['email'];?>
</td>
						<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['buddy']->value['dateAvailable'],"%d.%m.%y");?>
</td>
						<td><?php if ($_smarty_tpl->tpl_vars['buddy']->value['idGroup']!=0){?><a href="<?php echo $_smarty_tpl->getVariable('caller')->value;?>
?action=groupChat&auth=<?php echo $_smarty_tpl->tpl_vars['buddy']->value['authHash'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['buddy']->value['idGroup'];?>
</a><?php }?></td>
					</tr>
				<?php }} ?>
				</table>
			<?php }else{ ?>
				No buddies in DB :'(
			<?php }?>	
		</fieldset>
	<?php }?>	

	<?php if ($_smarty_tpl->getVariable('tableSelect')->value=="listIncomings"){?>
		<fieldset class="unlockFieldSet">
		<legend class="optionLegend">List of Incomings</legend>
			<?php if ($_smarty_tpl->getVariable('incomingArray')->value!=''){?>
				<i>total: <?php echo count($_smarty_tpl->getVariable('incomingArray')->value);?>
</i>
				<a href="mailto:office@example.com?subject=To%20all%20incomings&bcc=
					<?php  $_smarty_tpl->tpl_vars['incoming'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('incomingArray')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['incoming']->key => $_smarty_tpl->tpl_vars['incoming']->value){
?>
						<?php echo $_smarty_tpl->tpl_vars['incoming']->value['email'];?>
,
					<?php }} ?>
				">mail incomings</a>
				<table>
					<tr> <th>id</th> <th>First name</th> <th>Last name</th> <th>email</th> <th>arrival</th> <th>group</th> </tr>
				<?php  $_smarty_tpl->tpl_vars['incoming'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('incomingArray')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['incoming']->key => $_smarty_tpl->tpl_vars['incoming']->value){
?>
					<tr>
						<td><a href="<?php echo $_smarty_tpl->getVariable('caller')->value;?>
?action=incomingLogin&authIncoming=<?php echo $_smarty_tpl->tpl_vars['incoming']->value['authHash'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['incoming']->value['id'];?>
</a></td>
						<!--td><a href="<?php echo $_smarty_tpl->getVariable('caller')->value;?>
?action=admin&actionAdmin=buddyUnlock&unlockByHash=<?php echo $_smarty_tpl->tpl_vars['buddy']->value['hash'];?>
" class="unlockField">Unlock</a></td-->
						<td><?php echo $_smarty_tpl->tpl_vars['incoming']->value['firstName'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['incoming']->value['lastName'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['incoming']->value['email'];?>
</td>
						<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['incoming']->value['dateArrival'],"%d.%m.%y, %a");?>
</td>
						<td><?php if ($_smarty_tpl->tpl_vars['incoming']->value['idGroup']!=0){?><a href="<?php echo $_smarty_tpl->getVariable('caller')->value;?>
?action=groupChat&auth=<?php echo $_smarty_tpl->tpl_vars['incoming']->value['authHash'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['incoming']->value['idGroup'];?>
</a><?php }?></td>
					</tr>
				<?php }} ?>
				</table>
			<?php }else{ ?>
				No incomings in DB :'(
			<?php }?>	
		</fieldset>
	<?php }?>	

	<?php if ($_smarty_tpl->getVariable('tableSelect')->value=="buddyUnlock"){?>
		<fieldset class="unlockFieldSet">
		<legend class="optionLegend">Unlock new buddy's</legend>
			<?php if ($_smarty_tpl->getVariable('buddyArray')->value['table']!=''){?>
				<i>total: <?php echo count($_smarty_tpl->getVariable('buddyArray')->value['table']);?>
</i>
				<table>
					<tr> <th>id</th> <th>Unlock</th> <th>First name</th> <th>Last name</th> <th>email</th> </tr>
				<?php  $_smarty_tpl->tpl_vars['buddy'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('buddyArray')->value['table']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['buddy']->key => $_smarty_tpl->tpl_vars['buddy']->value){
?>
					<tr>
						<td><?php echo $_smarty_tpl->tpl_vars['buddy']->value['id'];?>
</td>
						<td><a href="<?php echo $_smarty_tpl->getVariable('caller')->value;?>
?action=admin&actionAdmin=buddyUnlock&unlockByHash=<?php echo $_smarty_tpl->tpl_vars['buddy']->value['hash'];?>
" class="unlockField">Unlock</a></td>
						<td><?php echo $_smarty_tpl->tpl_vars['buddy']->value['firstName'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['buddy']->value['lastName'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['buddy']->value['email'];?>
</td>
					</tr>
				<?php }} ?>
				</table>
			<?php }else{ ?>
				No buddies to unlock!
			<?php }?>	
		</fieldset>
	<?php }?>	

	<?php if ($_smarty_tpl->getVariable('tableSelect')->value=="matchingSystem"){?>
		<fieldset class="unlockFieldSet">
		<legend class="optionLegend">Match buddies and incomings</legend>
			<b>Stuff for buddy matching</b>
			<form id="matchingForm" method="post" action="<?php echo $_smarty_tpl->getVariable('caller')->value;?>
?action=admin&actionAdmin=matchingSystem&stage=options">
				<div>Number of buddies per group: <input type="text" name="numberBuddies" value="<?php echo $_smarty_tpl->getVariable('buddySystem')->value['numberBuddies'];?>
"/></div>
				<div>Number of incomings per group: <input type="text" name="numberIncomings" value="<?php echo $_smarty_tpl->getVariable('buddySystem')->value['numberIncomings'];?>
"/></div>
				<div>End of time span dd-mm-yyyy: <input type="text" name="dateAvailable" value="<?php echo $_smarty_tpl->getVariable('buddySystem')->value['dateAvailable'];?>
"/>
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
			<?php if ($_smarty_tpl->getVariable('stage')->value=="options"){?>
				<form id="matchesForm" method="post" action="<?php echo $_smarty_tpl->getVariable('caller')->value;?>
?action=admin&actionAdmin=matchingSystem&stage=saveGroups">
					<br/>
					<table>
						<tr><th></th><th>groups</th><th>buddies</th><th>incomings</th><th>ratio b/i</th></tr>
						<tr>
							<td>Requested</td><td></td><td><?php echo $_smarty_tpl->getVariable('buddySystem')->value['numberBuddies'];?>
</td><td><?php echo $_smarty_tpl->getVariable('buddySystem')->value['numberIncomings'];?>
</td>
							<td><?php if ($_smarty_tpl->getVariable('buddySystem')->value['numberIncomings']!=0){?><?php echo $_smarty_tpl->getVariable('buddySystem')->value['numberBuddies']/$_smarty_tpl->getVariable('buddySystem')->value['numberIncomings'];?>
<?php }?></td>
						</tr>
						<tr>
							<td>Available</td><td></td><td><?php echo $_smarty_tpl->getVariable('buddySystem')->value['buddies'];?>
</td><td><?php echo $_smarty_tpl->getVariable('buddySystem')->value['incomings'];?>
</td>
							<td><?php if ($_smarty_tpl->getVariable('buddySystem')->value['incomings']!=0){?><?php echo $_smarty_tpl->getVariable('buddySystem')->value['buddies']/$_smarty_tpl->getVariable('buddySystem')->value['incomings'];?>
<?php }?></td>
						</tr>
						<tr>
							<td>Matched</td><td><?php echo $_smarty_tpl->getVariable('numberOfCreatedGroups')->value;?>
</td><td><?php echo $_smarty_tpl->getVariable('buddySystem')->value['buddiesMatched'];?>
</td><td><?php echo $_smarty_tpl->getVariable('buddySystem')->value['incomingsMatched'];?>
</td>
							<td><?php if ($_smarty_tpl->getVariable('buddySystem')->value['incomingsMatched']!=0){?><?php echo $_smarty_tpl->getVariable('buddySystem')->value['buddiesMatched']/$_smarty_tpl->getVariable('buddySystem')->value['incomingsMatched'];?>
<?php }?></td>
						</tr>
						<tr>
							<td>Left</td><td></td>
							<td><?php $_smarty_tpl->assign('leftBuddies',$_smarty_tpl->getVariable('buddySystem')->value['buddies']-$_smarty_tpl->getVariable('buddySystem')->value['buddiesMatched'],null,null);?><?php echo $_smarty_tpl->getVariable('leftBuddies')->value;?>
</td>
							<td><?php $_smarty_tpl->assign('leftIncomings',$_smarty_tpl->getVariable('buddySystem')->value['incomings']-$_smarty_tpl->getVariable('buddySystem')->value['incomingsMatched'],null,null);?><?php echo $_smarty_tpl->getVariable('leftIncomings')->value;?>
</td>
							<td><?php if ($_smarty_tpl->getVariable('leftIncomings')->value!=0){?> <?php echo $_smarty_tpl->getVariable('leftBuddies')->value/$_smarty_tpl->getVariable('leftIncomings')->value;?>
 <?php }?></td>
						</tr>
						<tr></tr>
					</table>
					
					<div class="submitButton" align="left">
						<button type="submit" value="Submit" name="submit">Save groups</button>
					</div>

					<table id="matchStatistics">
					<tr><th>Incomings</th>
					<?php  $_smarty_tpl->tpl_vars['matchCount'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['matchKey'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('buddySystem')->value['statistics']['incomings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['matchCount']->key => $_smarty_tpl->tpl_vars['matchCount']->value){
 $_smarty_tpl->tpl_vars['matchKey']->value = $_smarty_tpl->tpl_vars['matchCount']->key;
?>
						<td><?php echo $_smarty_tpl->tpl_vars['matchKey']->value;?>
</td>
					<?php }} ?>
					</tr><tr><td></td>
					<?php  $_smarty_tpl->tpl_vars['matchCount'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['matchKey'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('buddySystem')->value['statistics']['incomings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['matchCount']->key => $_smarty_tpl->tpl_vars['matchCount']->value){
 $_smarty_tpl->tpl_vars['matchKey']->value = $_smarty_tpl->tpl_vars['matchCount']->key;
?>
						<td><?php echo $_smarty_tpl->tpl_vars['matchCount']->value;?>
</td>
					<?php }} ?>
					</tr><tr><th>Buddies</th><td></td>
					<?php  $_smarty_tpl->tpl_vars['matchCount'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['matchKey'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('buddySystem')->value['statistics']['buddies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['matchCount']->key => $_smarty_tpl->tpl_vars['matchCount']->value){
 $_smarty_tpl->tpl_vars['matchKey']->value = $_smarty_tpl->tpl_vars['matchCount']->key;
?>
						<td><?php echo $_smarty_tpl->tpl_vars['matchKey']->value;?>
</td>
					<?php }} ?>
					</tr><tr><td></td><td></td>
					<?php  $_smarty_tpl->tpl_vars['matchCount'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['matchKey'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('buddySystem')->value['statistics']['buddies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['matchCount']->key => $_smarty_tpl->tpl_vars['matchCount']->value){
 $_smarty_tpl->tpl_vars['matchKey']->value = $_smarty_tpl->tpl_vars['matchCount']->key;
?>
						<td><?php echo $_smarty_tpl->tpl_vars['matchCount']->value;?>
</td>
					<?php }} ?>
					</tr>
					</table>

					<table id="matchDetails">
					<?php  $_smarty_tpl->tpl_vars['group'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('buddySystem')->value['groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['group']->key => $_smarty_tpl->tpl_vars['group']->value){
?>
						<tr><th>group <?php echo $_smarty_tpl->tpl_vars['group']->key;?>
</th><th>ex</th><th>study</th><th>arrival</th><th>country</th><th>lang</th><th>match<th></tr>
						<?php  $_smarty_tpl->tpl_vars['student'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['group']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['student']->key => $_smarty_tpl->tpl_vars['student']->value){
?>
							<tr class="<?php echo smarty_function_cycle(array('values'=>'colOdd,colEven'),$_smarty_tpl->smarty,$_smarty_tpl);?>
">
							<td><?php echo $_smarty_tpl->tpl_vars['student']->value['firstName'];?>
 <?php echo $_smarty_tpl->tpl_vars['student']->value['lastName'];?>
</td>
							<?php if ($_smarty_tpl->tpl_vars['student']->value['type']=='incoming'){?>
								<td>x</td>
								<td><?php echo $_smarty_tpl->tpl_vars['student']->value['idStudy'];?>
</td>
								<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['student']->value['dateArrival'],"%e %b");?>
</td>
								<td><?php echo $_smarty_tpl->getVariable('nations')->value[$_smarty_tpl->tpl_vars['student']->value['country']];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['student']->value['preferredLanguage'];?>
</td>
							<?php }else{ ?>
								<td>o</td>
								<td><?php echo $_smarty_tpl->tpl_vars['student']->value['idStudy'];?>
</td>
								<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['student']->value['dateAvailable'],"%e %b");?>
</td><td>
								<?php if ($_smarty_tpl->tpl_vars['student']->value['idPreferredCountryFirst']!=0){?>
									<?php echo $_smarty_tpl->getVariable('nations')->value[$_smarty_tpl->tpl_vars['student']->value['idPreferredCountryFirst']];?>

								<?php }?>
								<?php if ($_smarty_tpl->tpl_vars['student']->value['idPreferredCountrySecond']!=0){?>
									,<?php echo $_smarty_tpl->getVariable('nations')->value[$_smarty_tpl->tpl_vars['student']->value['idPreferredCountrySecond']];?>

								<?php }?>
								<?php if ($_smarty_tpl->tpl_vars['student']->value['idPreferredCountryThird']!=0){?>
									,<?php echo $_smarty_tpl->getVariable('nations')->value[$_smarty_tpl->tpl_vars['student']->value['idPreferredCountryThird']];?>

								<?php }?>
								</td>
								<td></td>
							<?php }?>
								<td><?php echo $_smarty_tpl->tpl_vars['student']->value['match'];?>
</td>
							</tr>
						<?php }} ?>
						<tr><td></td></tr>
					<?php }} ?>
					</table>
				</form>
			<?php }?>
			<?php if ($_smarty_tpl->getVariable('stage')->value=="saveGroups"){?>
				<form id="savedForm" method="post" action="<?php echo $_smarty_tpl->getVariable('caller')->value;?>
?action=admin&actionAdmin=matchingSystem&stage=mailGroups">
					All groups are saved to the database but not mailed yet.... Click on the button to do that!
					<div class="submitButton" align="left">
						<button type="submit" value="Submit" name="submit">Mail matched ppl</button>
					</div>
				</form>			
			<?php }?>
			<?php if ($_smarty_tpl->getVariable('stage')->value=="mailGroups"){?>
				<form id="mailForm" method="post" action="<?php echo $_smarty_tpl->getVariable('caller')->value;?>
?action=admin&actionAdmin=matchingSystem&stage=endReport">
					You are done! grab a beer :)
				</form>			
			<?php }?>							
		</fieldset>
	<?php }?>		
	
	<?php if ($_smarty_tpl->getVariable('tableSelect')->value=="chatControl"){?>
		<fieldset class="unlockFieldSet">
		<legend class="optionLegend">Unlock new buddy's</legend>
			Admin and check on group chats
			
			
			
		</fieldset>
	<?php }?>	
	
		
</div>
