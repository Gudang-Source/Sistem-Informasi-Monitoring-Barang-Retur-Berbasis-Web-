<?php /* Smarty version Smarty-3.1.11, created on 2017-07-21 12:55:31
         compiled from ".\templates\edit_customers.tpl" */ ?>
<?php /*%%SmartyHeaderCode:71395787a23599c768-92223847%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dffa6386f4ef3444b23f2cee58cbd215a98732a3' => 
    array (
      0 => '.\\templates\\edit_customers.tpl',
      1 => 1500616375,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '71395787a23599c768-92223847',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5787a235be18c3_22680394',
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'divisiID' => 0,
    'kodeDivisi' => 0,
    'namaDivisi' => 0,
    'noTelp' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5787a235be18c3_22680394')) {function content_5787a235be18c3_22680394($_smarty_tpl) {?><script src="design/js/jquery-1.8.1.min.js" type="text/javascript"></script>
<link href="design/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="design/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<script src="design/js/bootstrap.min.js" type="text/javascript"></script>
	
<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>

<body style='background-color: #EEEEEE; color: #000;'>

	<script>
		$(document).ready(function() {
			
			$("#divisi").submit(function() { return false; });
	
			$("#send").on("click", function(){
				var divisiID = $("#divisiID").val();
				var kodeDivisi = $("#kodeDivisi").val();
				var namaDivisi = $("#namaDivisi").val();
				var noTelp = $("#noTelp").val();
			
				
				if (divisiID != '' && namaDivisi != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_edit_customer.php',
						dataType: 'JSON',
						data:{
							divisiID: divisiID,
							kodeDivisi: kodeDivisi,
							namaDivisi: namaDivisi,
							noTelp: noTelp
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

				

<?php if ($_smarty_tpl->tpl_vars['module']->value=='divisi'&&$_smarty_tpl->tpl_vars['act']->value=='edit'){?>
	<table width="95%" align="center">
		<tr>
			<td colspan="3"><h3>Ubah Divisi</h3></td>
		</tr>
		<tr>
			<td>
				<form id="divisi" name="divisi" method="POST" action="edit_customers">
				<input type="hidden" id="divisiID" name="divisiID" value="<?php echo $_smarty_tpl->tpl_vars['divisiID']->value;?>
">
				<table cellpadding="7" cellspacing="7">
					<tr>
						<td width="140">Kode Divisi</td>
						<td width="5">:</td>
						<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['kodeDivisi']->value;?>
" id="kodeDivisi" name="kodeDivisi" class="form-control" placeholder="Kode Divisi" style="width: 270px;"></td>
					</tr>
					<tr>
						<td>Nama Divisi</td>
						<td>:</td>
						<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['namaDivisi']->value;?>
" id="namaDivisi" name="namaDivisi" class="form-control" placeholder="Nama Divisi" style="width: 270px;" required></td>
					</tr>
					<tr>
						<td>Telepon</td>
						<td>:</td>
						<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['noTelp']->value;?>
" id="noTelp" name="noTelp" class="form-control" placeholder="Telepon" style="width: 270px;"></td>
					</tr>
				</table>
				<button id="send" class="btn btn-primary">Simpan</button>
				</form>
			</td>
		</tr>
	</table>

<?php }?>
</body><?php }} ?>