<?php /* Smarty version Smarty-3.1.11, created on 2017-09-01 03:29:40
         compiled from ".\templates\side_menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14562596b8d15b6e605-78577064%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c07eb5fd02e7c9335227925fc8d6c2c876ded3be' => 
    array (
      0 => '.\\templates\\side_menu.tpl',
      1 => 1504211378,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14562596b8d15b6e605-78577064',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_596b8d15e837b7_03245059',
  'variables' => 
  array (
    'dataAuthorize' => 0,
    'loginStaffLevel' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_596b8d15e837b7_03245059')) {function content_596b8d15e837b7_03245059($_smarty_tpl) {?><!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
	<li class="active">
		<a href="home.php">
			<i class="fa fa-dashboard"></i> <span>Home</span>
		</a>
	</li>
	<li class="treeview">
		<a href="#">
			<i class="fa fa-th"></i>
			<span>Master Data</span>
			<i class="fa fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['name'] = 'dataAuthorize';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataAuthorize']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total']);
?>
				<!-- <?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==1&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="staffs.php"><i class="fa fa-angle-double-right"></i> Staff</a></li> 
				<?php }?> -->
				<!-- <?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==4&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="categories.php"><i class="fa fa-angle-double-right"></i> Kategori</a></li>
				<?php }?> -->
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==5&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="products.php"><i class="fa fa-angle-double-right"></i> Barang</a></li>
				<?php }?>
				
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==12&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
				<!--	<li><a href="factories.php"><i class="fa fa-angle-double-right"></i> Gudang</a></li> -->
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==6&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="suppliers.php"><i class="fa fa-angle-double-right"></i> Supplier</a></li>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==2&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
				<!--	<li><a href="divisi.php"><i class="fa fa-angle-double-right"></i> Divisi</a></li> -->
				<?php }?> 
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==25&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<!-- <li><a href="authorize.php"><i class="fa fa-angle-double-right"></i> Level Authorize</a></li> -->
				<?php }?>
			<?php endfor; endif; ?>
		</ul>
	</li>
	<li class="treeview">
		<a href="#">
			<i class="fa fa-laptop"></i>
			<span>Transaksi Pembelian</span>
			<i class="fa fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['name'] = 'dataAuthorize';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataAuthorize']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total']);
?>
				
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==13&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="bbm.php"><i class="fa fa-angle-double-right"></i> Transaksi Pembelian</a></li>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==14&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="spb.php"><i class="fa fa-angle-double-right"></i> Purchase Order</a></li>
				<?php }?>	
			<?php endfor; endif; ?>
		</ul>
	</li>
	<!-- <li class="treeview">
		<a href="#">
			<i class="fa fa-laptop"></i>
			<span>Transaksi Penjualan</span>
			<i class="fa fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['name'] = 'dataAuthorize';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataAuthorize']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total']);
?>
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==9&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="out.php"><i class="fa fa-angle-double-right"></i> Transaksi Penjualan</a></li>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==13&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="do.php"><i class="fa fa-angle-double-right"></i> Delivery Order</a></li>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==14&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="so.php"><i class="fa fa-angle-double-right"></i> Sales Order</a></li>
				<?php }?>
			<?php endfor; endif; ?>
		</ul>
	</li> -->
	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['name'] = 'dataAuthorize';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataAuthorize']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total']);
?>
		<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==10&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
			<li><a href="retur_suppliers.php"><i class="fa fa-shopping-cart"></i> <span>Retur Pembelian</span></a></li>
		<?php }?>
	<?php endfor; endif; ?>

	<!-- <li class="treeview">
		<a href="#">
			<i class="fa fa-edit"></i> <span>Retur</span>
			<i class="fa fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['name'] = 'dataAuthorize';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataAuthorize']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total']);
?>
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==11&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="retur_staffs.php"><i class="fa fa-angle-double-right"></i> Retur Penjualan</a></li>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==10&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="retur_suppliers.php"><i class="fa fa-angle-double-right"></i> Retur Pembelian</a></li>
				<?php }?>
			<?php endfor; endif; ?>
		</ul>
	</li> -->
	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['name'] = 'dataAuthorize';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataAuthorize']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total']);
?>
		<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==28&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="so.php"><i class="fa fa-edit"></i> Barang Rusak</a></li>
				<?php }?>
	<?php endfor; endif; ?>
	<li class="treeview">
		<a href="#">
			<i class="fa fa-bar-chart-o"></i> <span>Laporan</span>
			<i class="fa fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['name'] = 'dataAuthorize';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataAuthorize']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total']);
?>
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==17&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="report_stock_products.php"><i class="fa fa-angle-double-right"></i> Laporan Stok Barang</a></li>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==19&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="report_in.php"><i class="fa fa-angle-double-right"></i> Laporan Pembelian</a></li>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==23&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
				<li><a href="report_retur.php"><i class="fa fa-angle-double-right"></i> Laporan Retur Pembelian</a></li>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==22&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="report_kadaluarsa.php?module=receive&act=search"><i class="fa fa-angle-double-right"></i> Laporan Barang Kadaluarsa</a></li>
				<?php }?>
			<?php endfor; endif; ?>
		</ul>
	</li>
	<!-- <li class="treeview">
		<a href="#">
			<i class="fa fa-folder"></i> <span>Hutang dan Piutang</span>
			<i class="fa fa-angle-left pull-right"></i>
		</a>
		 <ul class="treeview-menu">
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['name'] = 'dataAuthorize';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataAuthorize']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAuthorize']['total']);
?>
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==23&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="debts.php"><i class="fa fa-angle-double-right"></i> Hutang Dagang</a></li>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['modulID']==24&&strpos(((string)$_smarty_tpl->tpl_vars['dataAuthorize']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAuthorize']['index']]['authorize']),((string)$_smarty_tpl->tpl_vars['loginStaffLevel']->value))!==false){?>
					<li><a href="receivables.php"><i class="fa fa-angle-double-right"></i> Piutang Dagang</a></li>
				<?php }?>
			<?php endfor; endif; ?>
		</ul> 
	</li> -->
</ul><?php }} ?>