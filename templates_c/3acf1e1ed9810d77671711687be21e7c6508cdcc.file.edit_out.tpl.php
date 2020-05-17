<?php /* Smarty version Smarty-3.1.11, created on 2017-07-04 23:47:26
         compiled from ".\templates\edit_out.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10194595bc69e3d0820-10129975%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3acf1e1ed9810d77671711687be21e7c6508cdcc' => 
    array (
      0 => '.\\templates\\edit_out.tpl',
      1 => 1418496246,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10194595bc69e3d0820-10129975',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'detailID' => 0,
    'doNo' => 0,
    'kursID' => 0,
    'valas' => 0,
    'kurs' => 0,
    'productName' => 0,
    'kursrp' => 0,
    'price' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_595bc69e49f8d8_75956921',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_595bc69e49f8d8_75956921')) {function content_595bc69e49f8d8_75956921($_smarty_tpl) {?><script src="design/js/jquery-1.8.1.min.js" type="text/javascript"></script>
<link href="design/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="design/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<script src="design/js/bootstrap.min.js" type="text/javascript"></script>
	
<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>

<body style='background-color: #FFF; color: #000;'>

	<script>
		$(document).ready(function() {
			
			$("#out").submit(function() { return false; });
	
			$("#send").on("click", function(){
				var detailID = $("#detailID").val();
				var doNo = $("#doNo").val();
				var price = $("#price").val();
				var kursID = $("#kursID").val();
				var valas = $("#valas").val();
				var kurs = $("#kurs").val();
				
				if (detailID != '' && doNo != '' && price != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_out.php',
						dataType: 'JSON',
						data:{
							detailID: detailID,
							doNo: doNo,
							price: price,
							kursID: kursID,
							valas: valas,
							kurs: kurs
						},
						beforeSend: function (data) {
							$('#send').hide();
						},
						success: function(data) {
							parent.jQuery.fancybox.close();
						}
					});
				}
			});
		});
	</script>	

				

<?php if ($_smarty_tpl->tpl_vars['module']->value=='out'&&$_smarty_tpl->tpl_vars['act']->value=='edit'){?>
	<table width="95%" align="center">
		<tr>
			<td colspan="3"><h3>Koreksi Harga</h3></td>
		</tr>
		<tr>
			<td>
				<form id="out" name="out" method="POST" action="#">
				<input type="hidden" id="detailID" name="detailID" value="<?php echo $_smarty_tpl->tpl_vars['detailID']->value;?>
">
				<input type="hidden" id="doNo" name="doNo" value="<?php echo $_smarty_tpl->tpl_vars['doNo']->value;?>
">
				<input type="hidden" id="kursID" name="kursID" value="<?php echo $_smarty_tpl->tpl_vars['kursID']->value;?>
">
				<input type="hidden" id="valas" name="valas" value="<?php echo $_smarty_tpl->tpl_vars['valas']->value;?>
">
				<input type="hidden" id="kurs" name="kurs" value="<?php echo $_smarty_tpl->tpl_vars['kurs']->value;?>
">
				<table cellpadding="3" cellspacing="3">
					<tr>
						<td width="130">Nama Produk</td>
						<td width="5">:</td>
						<td><input type="text" id="productName" name="productName" value="<?php echo $_smarty_tpl->tpl_vars['productName']->value;?>
" class="form-control" style="width: 270px;" DISABLED></td>
					</tr>
					<tr>
						<td>Valas</td>
						<td>:</td>
						<td><input type="text" id="valas" name="valas" value="<?php echo $_smarty_tpl->tpl_vars['valas']->value;?>
" class="form-control" style="width: 270px;" DISABLED></td>
					</tr>
					<tr>
						<td>Kurs</td>
						<td>:</td>
						<td><input type="text" id="kurs" name="kurs" value="<?php echo $_smarty_tpl->tpl_vars['kursrp']->value;?>
" class="form-control" style="width: 270px;" DISABLED></td>
					</tr>
					<tr>
						<td>Harga</td>
						<td>:</td>
						<td><input type="text" id="price" name="price" value="<?php echo $_smarty_tpl->tpl_vars['price']->value;?>
" class="form-control" style="width: 270px;" placeholder="Koreksi Harga" required></td>
					</tr>
				</table>
				<button id="send" class="btn btn-primary">Simpan</button>
				</form>
			</td>
		</tr>
	</table>

<?php }?>
</body><?php }} ?>