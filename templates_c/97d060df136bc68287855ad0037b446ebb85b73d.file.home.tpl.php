<?php /* Smarty version Smarty-3.1.11, created on 2017-08-14 20:45:58
         compiled from ".\templates\home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28038576dc8ea126975-12728683%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '97d060df136bc68287855ad0037b446ebb85b73d' => 
    array (
      0 => '.\\templates\\home.tpl',
      1 => 1502718351,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28038576dc8ea126975-12728683',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_576dc8ea1ab8b7_89944525',
  'variables' => 
  array (
    'total' => 0,
    'total1' => 0,
    'total2' => 0,
    'total3' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_576dc8ea1ab8b7_89944525')) {function content_576dc8ea1ab8b7_89944525($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	
<header class="header">
	
	<?php echo $_smarty_tpl->getSubTemplate ("logo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		
	<?php echo $_smarty_tpl->getSubTemplate ("navigation.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		
</header>

<div class="wrapper row-offcanvas row-offcanvas-left">
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="left-side sidebar-offcanvas">
		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">

			<?php echo $_smarty_tpl->getSubTemplate ("user_panel.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        	
			<?php echo $_smarty_tpl->getSubTemplate ("side_menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


		</section>
		<!-- /.sidebar -->
	</aside>
	
	<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		
		<?php echo $_smarty_tpl->getSubTemplate ("breadcumb.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		
		<!-- Main content -->
		<section class="content">
		
			<!-- Main row -->
			<div class="row">
				<!-- Left col -->
				<br>
				<section class="col-lg-12 connectedSortable">
				
				<div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>

                                        <?php echo $_smarty_tpl->tpl_vars['total']->value;?>

                                    </h3>
                                    <p>
                                       Jumlah Barang
                                    </p>
                                </div>
                                <div class="icon">
                                    <span class="glyphicon glyphicon-tag"></span>
                                </div>
                                <a href="products.php" class="small-box-footer">
                                    Lihat Detail Barang <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                           
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                       <?php echo $_smarty_tpl->tpl_vars['total1']->value;?>

                                    </h3>
                                    <p>
                                        PO (Purchase Order)
                                    </p>
                                </div>
                                <div class="icon">
                                    <span class="glyphicon glyphicon-shopping-cart"></span>
                                </div>
                                <a href="spb.php" class="small-box-footer">
                                    Lihat Detail PO <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                           
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                         <?php echo $_smarty_tpl->tpl_vars['total2']->value;?>
 
                                    </h3>
                                    <p>
                                        Supplier
                                    </p>
                                </div>
                                <div class="icon">
                                    <span class="glyphicon glyphicon-user"></span>
                                </div>
                                <a href="suppliers.php" class="small-box-footer">
                                    Lihat Detail Supplier <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                      
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                       <?php echo $_smarty_tpl->tpl_vars['total3']->value;?>
 
                                    </h3>
                                    <p>
                                        Barang akan kadaluarsa
                                    </p>
                                </div>
                                <div class="icon">
                                    <span class="glyphicon glyphicon-warning-sign"></span>
                                </div>
                                <a href="report_kadaluarsa.php?module=receive&act=search" class="small-box-footer">
                                    Lihat Detail Barang Kadaluarsa <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->
				</section><!-- /.Left col -->
			</div><!-- /.row (main row) -->
		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->

<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>