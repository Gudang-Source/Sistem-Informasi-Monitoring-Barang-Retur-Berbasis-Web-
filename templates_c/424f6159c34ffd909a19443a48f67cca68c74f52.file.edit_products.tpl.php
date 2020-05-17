<?php /* Smarty version Smarty-3.1.11, created on 2017-08-08 14:06:32
         compiled from ".\templates\edit_products.tpl" */ ?>
<?php /*%%SmartyHeaderCode:304785788ebf74c0f11-04115543%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '424f6159c34ffd909a19443a48f67cca68c74f52' => 
    array (
      0 => '.\\templates\\edit_products.tpl',
      1 => 1502175977,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '304785788ebf74c0f11-04115543',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5788ebf77caf12_05481561',
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'productID' => 0,
    'productCode' => 0,
    'productName' => 0,
    'dataCategory' => 0,
    'categoryID' => 0,
    'unit' => 0,
    'harga' => 0,
    'stock' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5788ebf77caf12_05481561')) {function content_5788ebf77caf12_05481561($_smarty_tpl) {?><script src="design/js/jquery-1.8.1.min.js" type="text/javascript"></script>
<link href="design/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="design/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<script src="design/js/bootstrap.min.js" type="text/javascript"></script>
	
<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>



<body style='background-color: #FFF; color: #000;'>

	<script>
		$(document).ready(function() {
			
			$("#product").submit(function() { return false; });
			
	
			$("#send").on("click", function(){
				var productID = $("#productID").val();
				var productName = $("#productName").val();
				var categoryID = $("#categoryID").val();
				var unit = $("#unit").val();
				var harga = $("#harga").val();
				var stock = $("#stock").val();
				
				if (productID != '' && productName != '' && categoryID != '' && unit != '' && harga != '' && stock != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_edit_product.php',
						dataType: 'JSON',
						data:{
							productID: productID,
							productName: productName,
							categoryID: categoryID,
							unit: unit,
							harga: harga,
							stock: stock
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

				

<?php if ($_smarty_tpl->tpl_vars['module']->value=='product'&&$_smarty_tpl->tpl_vars['act']->value=='edit'){?>
	<table width="45%" align="center">
		<tr>
			<td colspan="3"><h3>Ubah Barang</h3></td>
		</tr>
		<tr>
			<td>
				<form id="product" name="product" method="POST" action="edit_products">
				<input type="hidden" id="productID" name="productID" value="<?php echo $_smarty_tpl->tpl_vars['productID']->value;?>
">
				<table cellpadding="7" cellspacing="7">
					<tr valign="top">
						<td width="130" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Kode Barang</td>
						<td width="5" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td>
							<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['productCode']->value;?>
" id="productCode" name="productCode">
							<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['productCode']->value;?>
" id="productCode" name="productCode" class="form-control" placeholder="Kode Barang" style="width: 270px;" DISABLED>
						</td>
						
					</tr>
					<tr>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Nama Barang</td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['productName']->value;?>
" id="productName" name="productName" class="form-control" placeholder="Nama Barang" style="width: 270px;" required></td>
						
					</tr>
					<tr valign="top">
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Kategori</td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td>
							<select id="categoryID" name="categoryID" class="form-control" style="width: 270px;" required>
								<option value=""></option>
								<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['name'] = 'dataCategory';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataCategory']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['total']);
?>
									<?php if ($_smarty_tpl->tpl_vars['categoryID']->value==$_smarty_tpl->tpl_vars['dataCategory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCategory']['index']]['categoryID']){?>
										<option value="<?php echo $_smarty_tpl->tpl_vars['dataCategory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCategory']['index']]['categoryID'];?>
" SELECTED><?php echo $_smarty_tpl->tpl_vars['dataCategory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCategory']['index']]['categoryName'];?>
</option>
									<?php }else{ ?>
										<option value="<?php echo $_smarty_tpl->tpl_vars['dataCategory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCategory']['index']]['categoryID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dataCategory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCategory']['index']]['categoryName'];?>
</option>
									<?php }?>
								<?php endfor; endif; ?>
							</select>
						</td>

					</tr>
					<tr valign="top">
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Satuan</td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td>
							<select id="unit" name="unit" class="form-control" style="width: 270px;" required>
								<option value=""></option>
								<option value="1" <?php if ($_smarty_tpl->tpl_vars['unit']->value=='1'){?> SELECTED <?php }?>>PCS</option>
								<option value="2" <?php if ($_smarty_tpl->tpl_vars['unit']->value=='2'){?> SELECTED <?php }?>>SACHET</option>
								<option value="3" <?php if ($_smarty_tpl->tpl_vars['unit']->value=='3'){?> SELECTED <?php }?>>BOX</option>
								<option value="4" <?php if ($_smarty_tpl->tpl_vars['unit']->value=='4'){?> SELECTED <?php }?>>SACHET</option>
							</select>
						</td>
						
					</tr>
					<tr valign="top">
						<td width="120" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Harga</td>
						<td width="5" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td><input type="number" value="<?php echo $_smarty_tpl->tpl_vars['harga']->value;?>
" id="harga" name="harga" class="form-control" placeholder="Harga" style="width: 270px;" required></td>
					</tr>
					<tr valign="top">
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Stok</td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td><input type="number" value="<?php echo $_smarty_tpl->tpl_vars['stock']->value;?>
" id="stock" name="stock" class="form-control" placeholder="Stok" style="width: 270px;" DISABLED></td>
					</tr>
				</table>
				<button id="send" class="btn btn-primary">Simpan</button>
				</form>
			</td>
		</tr>
	</table>

<?php }?>
</body><?php }} ?>