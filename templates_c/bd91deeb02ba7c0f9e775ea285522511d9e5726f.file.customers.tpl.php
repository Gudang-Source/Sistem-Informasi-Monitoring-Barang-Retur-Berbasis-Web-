<?php /* Smarty version Smarty-3.1.11, created on 2017-07-21 12:46:19
         compiled from ".\templates\customers.tpl" */ ?>
<?php /*%%SmartyHeaderCode:22604576dc99e9a3ea7-80932669%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bd91deeb02ba7c0f9e775ea285522511d9e5726f' => 
    array (
      0 => '.\\templates\\customers.tpl',
      1 => 1500615977,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22604576dc99e9a3ea7-80932669',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_576dc99eb0e7f6_70280052',
  'variables' => 
  array (
    'q' => 0,
    'module' => 0,
    'act' => 0,
    'dataDivisi' => 0,
    'page' => 0,
    'pageLink' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_576dc99eb0e7f6_70280052')) {function content_576dc99eb0e7f6_70280052($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>


	<script>
		$(document).ready(function() {
			
			$(".various2").fancybox({
				fitToView: false,
				scrolling: 'no',
				afterLoad: function(){
					this.width = $(this.element).data("width");
					this.height = $(this.element).data("height");
				},
				'afterClose':function () {
					window.location.reload();
				}
			});
			
			$(".modalbox").fancybox();
			$(".modalbox2").fancybox();
			
			$("#divisi").submit(function() { return false; });
			$("#divisi2").submit(function() { return false; });
					
			$("#send").on("click", function(){
				var kodeDivisi = $("#kodeDivisi").val();
				var namaDivisi = $("#namaDivisi").val();
				var noTelp = $("#noTelp").val();
				
				if (kodeDivisi != '' && namaDivisi != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_customer.php',
						dataType: 'JSON',
						data:{
							kodeDivisi: kodeDivisi,
							namaDivisi: namaDivisi,
							noTelp: noTelp
						},
						beforeSend: function (data) {
							$('#send').hide();
						},
						success: function(data) {
							setTimeout("$.fancybox.close()", 1000);
							window.location.href = "customers.php?msg=Data berhasil disimpan";
						}
					});
				}
			});
		});
	</script>


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
				<section class="col-lg-12 connectedSortable">
				
					<!-- TO DO List -->
					<div class="box box-primary">
						
						<div class="box-header">
							<i class="ion ion-clipboard"></i>
							<h3 class="box-title">Data Divisi</h3>
							<div class="box-tools pull-right">
								<div class="box-footer clearfix no-border">
								
									<form method="GET" action="customers.php">
										<input type="hidden" name="module" value="divisi">
										<input type="hidden" name="act" value="search">
										<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
										<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" id="q" name="q" class="form-control" placeholder="Pencarian : Kode atau Nama Divisi" style="float: right; width: 275px;" required>
									
										<a href="#inline" class="modalbox" style="float: left;"><button class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
										<a href="print_customers.php?act=print&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
										&nbsp;&nbsp;&nbsp;
									</form>
								</div>
							</div>
						</div><!-- /.box-header -->
						
						<?php if ($_smarty_tpl->tpl_vars['module']->value=='divisi'&&$_smarty_tpl->tpl_vars['act']->value=='search'){?>
						
							<div class="box-body">
								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO <i class="fa fa-sort"></i></th>
												<th>KODE DIVISI <i class="fa fa-sort"></i></th>
												<th>NAMA DIVISI <i class="fa fa-sort"></i></th>
												<th>TLP <i class="fa fa-sort"></i></th>
												<th width="60">AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['name'] = 'dataDivisi';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataDivisi']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDivisi']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDivisi']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDivisi']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDivisi']['index']]['kodeDivisi'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDivisi']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDivisi']['index']]['namaDivisi'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDivisi']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDivisi']['index']]['noTelp'];?>
</td>
													<td>
														<a title="Edit" href="edit_customers.php?module=divisi&act=edit&divisiID=<?php echo $_smarty_tpl->tpl_vars['dataDivisi']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDivisi']['index']]['divisiID'];?>
" data-width="450" data-height="180" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a>
														<a title="Delete" href="customers.php?module=divisi&act=delete&divisiID=<?php echo $_smarty_tpl->tpl_vars['dataDivisi']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDivisi']['index']]['divisiID'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" onclick="return confirm('Anda Yakin ingin menghapus divisi <?php echo $_smarty_tpl->tpl_vars['dataDivisi']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDivisi']['index']]['namaDivisi'];?>
?');"><img src="img/icons/delete.png" width="18"></a>
													</td>
												</tr>
											<?php endfor; endif; ?>
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
						
						<?php }else{ ?>
						
							<div class="box-body">
							
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO <i class="fa fa-sort"></i></th>
												<th>KODE DIVISI <i class="fa fa-sort"></i></th>
												<th>NAMA DIVISI <i class="fa fa-sort"></i></th>
												<th>TLP <i class="fa fa-sort"></i></th>
												<th width="60">AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['name'] = 'dataDivisi';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataDivisi']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDivisi']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDivisi']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDivisi']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDivisi']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDivisi']['index']]['kodeDivisi'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDivisi']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDivisi']['index']]['namaDivisi'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDivisi']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDivisi']['index']]['noTelp'];?>
</td>
													<td>
														<a title="Edit" href="edit_customers.php?module=divisi&act=edit&divisiID=<?php echo $_smarty_tpl->tpl_vars['dataDivisi']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDivisi']['index']]['divisiID'];?>
" data-width="450" data-height="180" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a>
														<a title="Delete" href="customers.php?module=divisi&act=delete&divisiID=<?php echo $_smarty_tpl->tpl_vars['dataDivisi']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDivisi']['index']]['divisiID'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" onclick="return confirm('Anda Yakin ingin menghapus divisi <?php echo $_smarty_tpl->tpl_vars['dataDivisi']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDivisi']['index']]['namaDivisi'];?>
?');"><img src="img/icons/delete.png" width="18"></a>
													</td>
												</tr>
											<?php endfor; endif; ?>
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-left">
									<ul class="pagination pagination-sm inline">
										<?php echo $_smarty_tpl->tpl_vars['pageLink']->value;?>

									</ul>
								</div>
							</div><!-- /.box-header -->
							
							
						
								<div id="inline">	
								<table width="95%" align="center">
									<tr>
										<td colspan="3"><h3>Tambah Divisi</h3></td>
									</tr>
									<tr>
										<td>
											<form id="divisi" name="divisi" method="POST" action="#">
											<table cellpadding="7" cellspacing="7">
												<tr>
													<td width="140">Kode Divisi</td>
													<td width="5">:</td>
													<td>
													
														<input type="text" id="kodeDivisi" name="kodeDivisi" class="form-control" placeholder="Kode Divisi" style="width: 270px;" required>
													</td>
												</tr>
												<tr>
													<td>Nama Divisi</td>
													<td>:</td>
													<td><input type="text" id="namaDivisi" name="namaDivisi" class="form-control" placeholder="Nama Divisi" style="width: 270px;" required></td>
												</tr>
												<tr>
													<td>Telepon</td>
													<td>:</td>
													<td><input type="text" id="noTelp" name="noTelp" class="form-control" placeholder="Telepon" style="width: 270px;"></td>
												</tr>
											</table>
											<br>
											<button id="send" class="btn btn-primary">Simpan</button>
											</form>
										</td>
									</tr>
								</table>
							</div>
						<?php }?>
					</div><!-- /.box -->
					
				</section><!-- /.Left col -->
			</div><!-- /.row (main row) -->
		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->

<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>