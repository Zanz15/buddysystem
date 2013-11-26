<?php /* Smarty version 3.0rc1, created on 2013-09-22 20:57:55
         compiled from "C:\Users\stephan\repos\buddysystem\actions\templates\newBuddy.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2415523f3db367ffd2-54604951%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '817d41e1ab689774c5a4a97620555fd1f21bd09a' => 
    array (
      0 => 'C:\\Users\\stephan\\repos\\buddysystem\\actions\\templates\\newBuddy.tpl',
      1 => 1379876100,
    ),
  ),
  'nocache_hash' => '2415523f3db367ffd2-54604951',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_html_options')) include 'C:\Users\stephan\repos\buddysystem\libs\smarty\plugins\function.html_options.php';
?><script language="JavaScript" src="<?php echo $_smarty_tpl->getVariable('buddysys_baseUrl')->value;?>
js/calendar/calendar_eu.js"></script>
<script language="JavaScript" src="<?php echo $_smarty_tpl->getVariable('buddysys_baseUrl')->value;?>
js/buddySystem.js"></script>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->getVariable('buddysys_baseUrl')->value;?>
js/calendar/calendar.css">

<div class="buddyForm">
	<form name="newBuddyForm" id="newBuddyForm" method="post" action="<?php echo $_smarty_tpl->getVariable('caller')->value;?>
?action=newBuddy&validate=true">
		<div class="textfield" >
			<h1>Lieber Buddy!</h1>

			<p>Danke, dass du dich dafür entschieden hast bei ESN Example mitzumachen.
			Nach deiner Anmeldung bekommst du ein E-Mail mit einem Bestätigungslink mit dem du auch deine Daten bearbeiten kannst.</p>

			<p>Rechtzeitig vor der Ankunft deiner Austauschstudierenden (Exchangee) werden wir dich einer Buddy-Gruppe zuteilen. Eine Buddy-Gruppe besteht aus 2-3 TU-Studierenden (Buddy) und 3-4 Austauschstudierenden.</p>
		
			<p>Dein ESN Example Team</p>
		</div>
		
		<?php if ($_smarty_tpl->getVariable('error')->value!=''){?>
			<fieldset class="errorFieldSet">
			<legend>Oops! something went wrong</legend>
			<div class="errorField">
				<?php  $_smarty_tpl->tpl_vars['err'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('error')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['err']->key => $_smarty_tpl->tpl_vars['err']->value){
?>
				    <li><?php echo $_smarty_tpl->tpl_vars['err']->value;?>
</li>
				<?php }} ?>
			</div>
			</fieldset>
		<?php }?>
		
		<table class="table">
			<tr>
				<td><label for="firstname">Vorname</label></td>
				<td>*</td>
				<td><input type="text" name="firstname" id="firstname" value="<?php echo $_smarty_tpl->getVariable('firstName')->value;?>
"/></td>
			</tr>
			<tr>
				<td><label for="lastname">Nachname</label></td>
				<td>*</td>
				<td><input type="text" name="lastname" id="lastname" value="<?php echo $_smarty_tpl->getVariable('lastName')->value;?>
"/></td>
			</tr>
			<tr>
				<td><label for="email">E-Mail</label></td>
				<td>*</td>
				<td><input type="text" name="email" id="email" onchange="validateEmail('newBuddyForm','email', 'emailConfirm', 'emailConfirmDiv');" value="<?php echo $_smarty_tpl->getVariable('email0')->value;?>
"/></td>
			</tr>
			<tr>
				<td><label for="emailConfirm">E-Mail wiederholen</label></td>
				<td>*</td>
				<td><input type="text" name="emailConfirm" id="emailConfirm" onchange="validateEmail('newBuddyForm','email','emailConfirm', 'emailConfirmDiv');" value="<?php echo $_smarty_tpl->getVariable('email1')->value;?>
"/> 
				<div id="emailConfirmDiv"></div></td>
			</tr>
			<tr>
				<td><label for="buddyBefore">Warst du schon mal Buddy?</label></td>
				<td>*</td>
				<td>
					<input type="radio" name="buddyBefore" id="buddyBefore" value="1" <?php echo $_smarty_tpl->getVariable('buddyBefore')->value['checkedBuddy1'];?>
> Ja</input> 
					<input type="radio" name="buddyBefore" id="buddyBefore" value="0" <?php echo $_smarty_tpl->getVariable('buddyBefore')->value['checkedBuddy0'];?>
> Nein </input>
				</td>
			</tr>

			<tr>
				<td><label for="preferredCountry1">Bevorzugtes Land 1</label></td>
				<td></td>
				<td><?php echo smarty_function_html_options(array('name'=>'preferredCountry1','id'=>'preferredCountry1','options'=>$_smarty_tpl->getVariable('countries')->value,'selected'=>$_smarty_tpl->getVariable('countriesSelected1')->value),$_smarty_tpl->smarty,$_smarty_tpl);?>
</td>
			</tr>
			<tr>
				<td><label for="preferredCountry2">Bevorzugtes Land 2</label></td>
				<td></td>
				<td><?php echo smarty_function_html_options(array('name'=>'preferredCountry2','id'=>'preferredCountry2','options'=>$_smarty_tpl->getVariable('countries')->value,'selected'=>$_smarty_tpl->getVariable('countriesSelected2')->value),$_smarty_tpl->smarty,$_smarty_tpl);?>
</td>
			</tr>
			<tr>
				<td><label for="preferredCountry3">Bevorzugtes Land 3</label></td>
				<td></td>
				<td><?php echo smarty_function_html_options(array('name'=>'preferredCountry3','id'=>'preferredCountry3','options'=>$_smarty_tpl->getVariable('countries')->value,'selected'=>$_smarty_tpl->getVariable('countriesSelected3')->value),$_smarty_tpl->smarty,$_smarty_tpl);?>
</td>
			</tr>
			<tr>
				<td><label for="studySelect">Studium</label></td>
				<td>*</td>
				<td><?php echo smarty_function_html_options(array('name'=>'studySelect','id'=>'studySelect','options'=>$_smarty_tpl->getVariable('studies')->value,'selected'=>$_smarty_tpl->getVariable('studiesSelected')->value),$_smarty_tpl->smarty,$_smarty_tpl);?>
</td>
			</tr>
			<?php if ($_smarty_tpl->getVariable('use_tandem')->value){?>
			<tr>
				<td><label for="tandem">Interessiert an einem Sprach-Tandem?</label></td>
				<td></td>
				<td><input type="radio" name="tandem" id="tandem" value="1" <?php echo $_smarty_tpl->getVariable('tandem')->value['checkedTandem1'];?>
 > Yes</input> 
				<input type="radio" name="tandem" id="tandem" value="0" <?php echo $_smarty_tpl->getVariable('tandem')->value['checkedTandem0'];?>
 > No </input></td>
			</tr>
			<?php }?>
			
			<tr>
				<td><label for="availableFrom">Verfügbar ab</label></td>
				<td>*</td>
				<td>
					<?php  $_smarty_tpl->tpl_vars['infoEveDate'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['infoEveName'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('infoEvenings')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['infoEveDate']->key => $_smarty_tpl->tpl_vars['infoEveDate']->value){
 $_smarty_tpl->tpl_vars['infoEveName']->value = $_smarty_tpl->tpl_vars['infoEveDate']->key;
?>
				 		<input type="radio" name="availableFrom" "availableFrom" value="<?php echo $_smarty_tpl->tpl_vars['infoEveDate']->value;?>
" onchange="changeInputDate('<?php echo $_smarty_tpl->tpl_vars['infoEveDate']->value;?>
');"><?php echo $_smarty_tpl->tpl_vars['infoEveName']->value;?>
 (<?php echo $_smarty_tpl->tpl_vars['infoEveDate']->value;?>
)</input><br/>
					<?php }} ?>

					<input type="text" name="availableFromInput" id="availableFrom" value="<?php echo $_smarty_tpl->getVariable('availableFromInput')->value;?>
" onchange="validateDate('newBuddyForm', 'availableFromInput', 'dateFeedback');"/>
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
