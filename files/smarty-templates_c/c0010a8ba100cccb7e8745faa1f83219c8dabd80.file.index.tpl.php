<?php /* Smarty version 3.0rc1, created on 2013-09-22 20:57:55
         compiled from "C:\Users\stephan\repos\buddysystem\actions\templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17486523f3db352c215-43765446%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c0010a8ba100cccb7e8745faa1f83219c8dabd80' => 
    array (
      0 => 'C:\\Users\\stephan\\repos\\buddysystem\\actions\\templates\\index.tpl',
      1 => 1379876100,
    ),
  ),
  'nocache_hash' => '17486523f3db352c215-43765446',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>ESN Buddy system</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link href="css/buddy.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
		select { width: 200px }
	</style>
</head>
<body>

<?php if ($_smarty_tpl->getVariable('buddysys_header')->value){?>
<div id="header">
	<h1>Buddy Registration System</h1>
	<img src="images/your-example-logo.png" />
</div>
<?php }?>

<?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('actionTpl')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>


</body>
</html>
