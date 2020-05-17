<?php /* Smarty version Smarty-3.1.11, created on 2017-08-24 18:04:03
         compiled from ".\templates\report_kadaluarsa.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24368596b8dae9f6616-87938559%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dec3f19a5c80eb55d2ea2bad9c8d006a9a050ae0' => 
    array (
      0 => '.\\templates\\report_kadaluarsa.tpl',
      1 => 1503572640,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24368596b8dae9f6616-87938559',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_596b8daedcae89_48615552',
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'startDate' => 0,
    'endDate' => 0,
    'dataReceived' => 0,
    'pageLink' => 0,
    'dataCustomer' => 0,
    'customerID' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_596b8daedcae89_48615552')) {function content_596b8daedcae89_48615552($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<script src="jquery.js"></script>
<script>
    $(document).ready(function()
                     {
        $("#fetchval").on('change',function()
                         {
            var keyword = $(this).val();
            $.ajax(
            {
                url:'dewa.php',
                type:'POST',
                data:'request='+keyword,
                
                beforeSend:function()
                {
                    $("#table-container").html('Working...');
                    
                },
                success:function(data)
                {
                    $("#table-container").html(data);
                },
            });
        });
    });
    
</script>




<style>
	div.ui-datepicker{
		font-size:14px;
	}
</style>


	<script>
		$(document).ready(function() {
			
			$( "#startDate" ).datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "dd-mm-yy",
				yearRange: '2014:c-0'
			});
			
			$( "#endDate" ).datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "dd-mm-yy",
				yearRange: '2014:c-0'
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
						
						<?php if ($_smarty_tpl->tpl_vars['module']->value=='receive'&&$_smarty_tpl->tpl_vars['act']->value=='search'){?>
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="report_kadaluarsa.php">
											<input type="hidden" name="module" value="receive">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											
											
										
	<select id="fetchval" name="fetchby" class="form-control" style="float: right; width: 270px; margin-right: 5px;">
	<<?php ?>?php
		$conn = mysqli_connect('localhost','root','','dbinventory');
		$sekarang= date('Y-m-d');
		$min1bulan= date('Y-m-d', strtotime("-1 months",strtotime($sekarang)));

		$sql = ("SELECT * FROM detail_barang where mep -'".$min1bulan . "'");
		$dewa1 = mysqli_query($conn, $sql);

	'<option value="2" selected></option>'
    '<option value="2"></option>'
    '<option value="2">Semua</option>'
    '<option value="1">1 Bulan Sebelum Kadaluarsa</option>'
 	if (value='180') {
			$request= echo $sql;
		}
    ?<?php ?>>
	</select>
	
	<br>



											<a href="print_report_kadaluarsa.php?act=print&startDate=<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
&endDate=<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
											&nbsp;
										</form>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								
								<div class="table-responsive" id="table-container">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO <i class="fa fa-sort"></i></th>
												<th>NOMOR DETAIL BARANG<i class="fa fa-sort"></i></th>
												<th>KODE - NAMA BARANG <i class="fa fa-sort"></i></th>
												<th>NAMA SUPPLIER <i class="fa fa-sort"></i></th>
												<th style="text-align: center">TANGGAL KADALUARSA <i class="fa fa-sort"></i></th>
												<th style="text-align: center">QTY <i class="fa fa-sort"></i></th>

											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['name'] = 'dataReceived';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataReceived']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceived']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataReceived']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceived']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataReceived']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceived']['index']]['no_detail_brg'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataReceived']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceived']['index']]['productCode'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataReceived']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceived']['index']]['namaSupplier'];?>
</td>
													<td style="text-align: center"><?php echo $_smarty_tpl->tpl_vars['dataReceived']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceived']['index']]['mep'];?>
</td>
													<td style="text-align: center"><?php echo $_smarty_tpl->tpl_vars['dataReceived']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceived']['index']]['qty_brg'];?>
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
							
						<?php }else{ ?>
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="report_kadaluarsa.php">
											<input type="hidden" name="module" value="receive">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" id="endDate" name="endDate" value="<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px; margin-right: 5px;">
											<input type="text" id="startDate" name="startDate" value="<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px; margin-right: 5px;">
											<select id="customerID" name="customerID" class="form-control" style="float: right; width: 270px; margin-right: 5px;">
												<option value=""></option>
												<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['name'] = 'dataCustomer';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataCustomer']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['total']);
?>
													<option value="<?php echo $_smarty_tpl->tpl_vars['dataCustomer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCustomer']['index']]['customerID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dataCustomer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCustomer']['index']]['customerName'];?>
 [ Kode : <?php echo $_smarty_tpl->tpl_vars['dataCustomer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCustomer']['index']]['customerCode'];?>
 ]</option>
												<?php endfor; endif; ?>
											</select>
											<a href="print_report_receives.php?act=print&customerID=<?php echo $_smarty_tpl->tpl_vars['customerID']->value;?>
&startDate=<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
&endDate=<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
"  target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
											&nbsp;
										</form>
									</div>
								</div>
							</div><!-- /.box-header -->
						<?php }?>
						
					</div><!-- /.box -->
					
				</section><!-- /.Left col -->
			</div><!-- /.row (main row) -->
		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->

<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>