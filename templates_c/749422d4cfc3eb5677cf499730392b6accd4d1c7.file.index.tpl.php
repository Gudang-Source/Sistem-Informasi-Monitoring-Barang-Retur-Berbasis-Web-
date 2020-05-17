<?php /* Smarty version Smarty-3.1.11, created on 2017-08-14 20:00:53
         compiled from ".\templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6455576dc8d69a5446-79152008%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '749422d4cfc3eb5677cf499730392b6accd4d1c7' => 
    array (
      0 => '.\\templates\\index.tpl',
      1 => 1502715650,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6455576dc8d69a5446-79152008',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_576dc8d69f9c88_19596174',
  'variables' => 
  array (
    'msg' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_576dc8d69f9c88_19596174')) {function content_576dc8d69f9c88_19596174($_smarty_tpl) {?><!doctype html>
<head>

	<!-- General Metas -->
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">	<!-- Force Latest IE rendering engine -->
	<title>Login Form PT. LOTTE MART CABANG MAKASSAR</title>
	<meta name="description" content="This is inventory application system ">
	<meta name="author" content="PT. Lotte Mart Indonesia Cabang Makassar">
	
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
	
	<!-- Stylesheets -->
	<link rel="stylesheet" href="design/css/base.css">
	<link rel="stylesheet" href="design/css/skeleton.css">
	<link rel="stylesheet" href="design/css/layout.css">
	
</head>
<body>

	<!-- Primary Page Layout -->
	
	<div class="alert-danger-login"><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</div>
	<div class="container">
		
		<div class="form-bg">
			<form method="POST" action="index.php?module=login&act=submit">
				<h2 >LOGIN PT. LOTTE MART CABANG MAKASSAR</h2>
				<p><input type="text" name="username" placeholder="username" required></p>
				<p><input type="password" name="password"  placeholder="password" required></p>
				<button type="submit"></button>
			<form>
		</div>
		
		<br>
		<p class="forgot" style="color:black;    text-shadow:-2px 0px 2px white;" >
			
		
			Copyright &copy; PT. LOTTE MART INDONESIA CAB. MAKASSAR <br>
			Mall Panakukang, Jl. Boulevard Raya No.1<br>
			Makassar, Sulawesi Selatan, Indonesia
		
		</p>


	</div><!-- container -->
	
<!-- End Document -->
</body>
</html><?php }} ?>