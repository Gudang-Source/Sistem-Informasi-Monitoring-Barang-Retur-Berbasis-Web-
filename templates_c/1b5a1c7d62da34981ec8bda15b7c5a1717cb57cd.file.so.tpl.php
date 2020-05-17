<?php /* Smarty version Smarty-3.1.11, created on 2017-09-01 21:58:40
         compiled from ".\templates\so.tpl" */ ?>
<?php /*%%SmartyHeaderCode:154925787b5592a54a3-95367821%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1b5a1c7d62da34981ec8bda15b7c5a1717cb57cd' => 
    array (
      0 => '.\\templates\\so.tpl',
      1 => 1504277883,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '154925787b5592a54a3-95367821',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5787b55974df57_35786344',
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'KD_brg_rusak' => 0,
    'orderDateIndo' => 0,
    'numsDetilSo' => 0,
    'dataDetilSo' => 0,
    'q' => 0,
    'pageNumber' => 0,
    'orderDate' => 0,
    'dataDetail' => 0,
    'dataSo' => 0,
    'page' => 0,
    'pageLink' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5787b55974df57_35786344')) {function content_5787b55974df57_35786344($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<style>
	div.ui-datepicker{
		font-size:14px;
	}
</style>

<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>
<script type='text/javascript' src="design/js/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="design/css/jquery.autocomplete.css" />


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
			
			$( "#orderDate" ).datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "dd-mm-yy",
				yearRange: 'c-1:c-0'
			});
			
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
			
			$('#needDate').change(function () {
				var KD_brg_rusak = $("#KD_brg_rusak").val();
				var needDate = $("#needDate").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_so_needdate.php',
					dataType: 'JSON',
					data:{
						KD_brg_rusak: KD_brg_rusak,
						needDate: needDate
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "so.php?module=so&act=add";
					}
				});
			});
			
			$('#orderDate').change(function () {
				var KD_brg_rusak = $("#KD_brg_rusak").val();
				var orderDate = $("#orderDate").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_so_orderdate.php',
					dataType: 'JSON',
					data:{
						KD_brg_rusak: KD_brg_rusak,
						orderDate: orderDate
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "so.php?module=so&act=add";
					}
				});
			});
			
			$('#note').change(function () {
				var KD_brg_rusak = $("#KD_brg_rusak").val();
				var note = $("#note").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_so_note.php',
					dataType: 'JSON',
					data:{
						KD_brg_rusak: KD_brg_rusak,
						note: note
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "so.php?module=so&act=add";
					}
				});
			});
			
			$( "#needDate" ).datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "dd-mm-yy",
				yearRange: 'c-1:c+1'
			});
			
			$(".modalbox").fancybox();
			$(".modalbox2").fancybox();
			
			$("#so").submit(function() { return false; });
			$("#so2").submit(function() { return false; });
			
			$("#productBarcode").autocomplete("product_so_autocomplete.php", {
				width: 310
			}).result(function(event, item, a) {
				var myarr = item[0].split(" # ");
				
				document.getElementById('productBarcode').value = myarr[0];
				document.getElementById('productName1').value = myarr[1];
				document.getElementById('productName').value = myarr[1];
				document.getElementById('productID').value = myarr[2];
			});
			
			$("#customerID").change(function(e){
				var customerID = $("#customerID").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_so_customer.php',
					dataType: 'JSON',
					data:{
						customerID: customerID
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "so.php?module=so&act=add";
					}
				});
			});
					
			$("#send2").on("click", function(){
				var KD_brg_rusak = $("#KD_brg_rusak").val();
				var productID = $("#productID").val();
				var productName1 = $("#productName1").val();
				var jumlah = parseInt($("#jumlah").val());
				var ket = $("#ket").val();
				var no_detail_brg = $("#no_detail_brg").val();
				var desc = $("#desc").val();
				var productBarcode = $("#productBarcode").val();

				if (jumlah != '' && KD_brg_rusak != '' && productID != ''){
					
					$.ajax({
						type: 'POST',
						url: 'save_so.php',
						dataType: 'JSON',
						data:{
							jumlah: jumlah,
							ket: ket,
							KD_brg_rusak: KD_brg_rusak,
							productID: productID,
							productName1: productName1,
							no_detail_brg: no_detail_brg,
							desc: desc,
							productBarcode : productBarcode
						},
						beforeSend: function (data) {
							$('#send2').hide();
						},
						success: function(data) {
							setTimeout("$.fancybox.close()", 1000);
							window.location.href = "so.php?module=so&act=add&msg=Data berhasil disimpan";
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
						
						<?php if ($_smarty_tpl->tpl_vars['module']->value=='so'&&$_smarty_tpl->tpl_vars['act']->value=='add'){?>
							
								<script>
									window.location.hash="no-back-button";
									window.location.hash="Again-No-back-button";//again because google chrome don't insert first hash into history
									window.onhashchange=function(){window.location.hash="no-back-button";}
									
									document.onkeydown = function (e) {
										if (e.keyCode === 116) {
											return false;
										}
									};
								</script>
							
						
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Tambah Barang Rusak</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="so.php?module=so&act=cancel" onclick="return confirm('Anda Yakin ingin membatalkan ?');"><button class="btn btn-default pull-right">Batal</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<form method="POST" action="so.php?module=so&act=input">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="220">KODE BARANG RUSAK / TGL</td>
										<td width="5">:</td>
										<td><input type="hidden" id="KD_brg_rusak" name="KD_brg_rusak" value="<?php echo $_smarty_tpl->tpl_vars['KD_brg_rusak']->value;?>
">
											<input type="text" id="KD_brg_rusak" name="KD_brg_rusak" value="<?php echo $_smarty_tpl->tpl_vars['KD_brg_rusak']->value;?>
" class="form-control" placeholder="Kode Barang Rusak" style="width: 110px; float: left" DISABLED>
											<input type="text" id="orderDate" name="orderDate" value="<?php echo $_smarty_tpl->tpl_vars['orderDateIndo']->value;?>
" class="form-control" placeholder="Tanggal" style="width: 160px;" required>
										</td>
									</tr>
									<tr>
										<td colspan="3">
											<br>
											<?php if ($_smarty_tpl->tpl_vars['numsDetilSo']->value<10){?>
											<a href="#inline" class="modalbox"><button class="btn btn-default pull-left"><i class="fa fa-plus"></i> Add</button></a>
											<?php }?>
										</td>
									</tr>
								</table>

								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO</th>
												<th>NAMA BARANG</th>
												<th>NO BARANG</th>
												<th  style="text-align: center;">QTY</th>
												<th  style="text-align: center;">KETERANGAN</th>
												<th style='text-align: center;'>AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['name'] = 'dataDetilSo';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataDetilSo']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSo']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetilSo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilSo']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetilSo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilSo']['index']]['productName'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetilSo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilSo']['index']]['no_detail_brg'];?>
</td>
													
													<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataDetilSo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilSo']['index']]['jumlah'];?>
</td>
													<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataDetilSo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilSo']['index']]['ket'];?>
</td>
													<td style='text-align: center;'>
														
														<a title="Delete" href="so.php?module=so&act=deletedetail&detailID=<?php echo $_smarty_tpl->tpl_vars['dataDetilSo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilSo']['index']]['detailID'];?>
" onclick="return confirm('Anda Yakin ingin menghapus item produk <?php echo $_smarty_tpl->tpl_vars['dataDetilSo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilSo']['index']]['productName'];?>
?');"><img src="img/icons/delete.png" width="18"></a>
													</td>
												</tr>
											<?php endfor; endif; ?>
										</tbody>
									</table>
								</div>
								<br>
								<br>
								<?php if ($_smarty_tpl->tpl_vars['numsDetilSo']->value>0){?>
									<button type="submit" class="btn btn-primary">Simpan</button>
								<?php }else{ ?>
									<button type="button" class="btn btn-primary">Simpan</button>
								<?php }?>
								</form>
							
							</div><!-- /.box-body -->
							
							<div id="inline">	
								<table width="95%" align="center">
									<tr>
										<td colspan="3"><h3>Tambah Item</h3></td>
									</tr>
									<tr>
										<td>
											<form id="so" name="so" method="POST" action="#">
											<input type="hidden" id="KD_brg_rusak" name="KD_brg_rusak" value="<?php echo $_smarty_tpl->tpl_vars['KD_brg_rusak']->value;?>
">
											<table cellpadding="3" cellspacing="3">
												<tr>
													<td width="180">Kode / Nama Barang</td>
													<td width="5">:</td>
													<td><input type="text" id="productBarcode" name="productBarcode" class="form-control" placeholder="Kode atau Nama Barang" style="width: 270px;" required></td>
												</tr>
												
												<tr>
													<td colspan="2"></td>
													<td><input type="hidden" id="productID" name="productID">
														<input type="hidden" id="productName1" name="productName1">
														<input type="text" id="productName" name="productName" class="form-control" placeholder="Nomor Barang" style="width: 270px;" DISABLED>
													</td>
												</tr>
												<tr>
													<td>Qty</td>
													<td>:</td>
													<td><input type="number" id="jumlah" name="jumlah" class="form-control" placeholder="Qty Barang" style="width: 270px;" required></td>
												</tr>
												<tr>
													<td>Keterangan</td>
													<td>:</td>
													<td><input type="text" id="ket" name="ket" class="form-control" placeholder="Keterangan" style="width: 270px;" required></td>
												</tr>
												
											</table>
											<button id="send2" class="btn btn-primary">Simpan</button>
											</form>
										</td>
									</tr>
								</table>
							</div>
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='so'&&$_smarty_tpl->tpl_vars['act']->value=='detailso'){?>
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Detail Barang Rusak</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										
										<?php if ($_smarty_tpl->tpl_vars['q']->value!=''){?>
											<a href="so.php?module=so&act=search&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
&page=<?php echo $_smarty_tpl->tpl_vars['pageNumber']->value;?>
"><button class="btn btn-default pull-right">Back</button></a>
										<?php }else{ ?>
											<a href="so.php?page=<?php echo $_smarty_tpl->tpl_vars['pageNumber']->value;?>
"><button class="btn btn-default pull-right">Back</button></a>
										<?php }?>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="220">KODE BARANG RUSAK / TGL</td>
										<td width="5">:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['KD_brg_rusak']->value;?>
 / <?php echo $_smarty_tpl->tpl_vars['orderDate']->value;?>
</td>
									</tr>
									
									<tr>
										<td colspan="3"><br></td>
									</tr>
								</table>

								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO</th>
												<th>NAMA BARANG</th>
												<th>NO BARANG</th>
												<th  style="text-align: center;">QTY</th>
												<th  style="text-align: center;">KETERANGAN</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['name'] = 'dataDetail';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataDetail']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['productName'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['no_detail_brg'];?>
</td>
													<td style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['jumlah'];?>
</td>
													<td style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['ket'];?>
</td>
												
												</td>
												</tr>
											<?php endfor; endif; ?>
												
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='so'&&$_smarty_tpl->tpl_vars['act']->value=='finish'){?>
							
								<script>
									window.location.hash="no-back-button";
									window.location.hash="Again-No-back-button";//again because google chrome don't insert first hash into history
									window.onhashchange=function(){window.location.hash="no-back-button";}
									
									document.onkeydown = function (e) {
										if (e.keyCode === 116) {
											return false;
										}
									};
								</script>
							
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Detail Barang Rusak</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										
										<a href="so.php"><button class="btn btn-default pull-right">Tutup</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="220">KODE BARANG RUSAK / TGL</td>
										<td width="5">:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['KD_brg_rusak']->value;?>
 / <?php echo $_smarty_tpl->tpl_vars['orderDate']->value;?>
</td>
									</tr>
									
									
									<tr>
										<td colspan="3"><br></td>
									</tr>
								</table>

								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO</th>
												<th>NAMA BARANG</th>
												<th>NO BARANG</th>
												<th style="text-align: center;">QTY</th>
												<th style="text-align: center;">KETERANGAN</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['name'] = 'dataDetail';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataDetail']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['productName'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['no_detail_brg'];?>
</td>
													<td style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['jumlah'];?>
</td>
													<td style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['ket'];?>
</td>
													</td>
												</tr>
											<?php endfor; endif; ?>
												
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='so'&&$_smarty_tpl->tpl_vars['act']->value=='search'){?>
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="so.php">
											<input type="hidden" name="module" value="so">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											
											<input type="text" id="q" name="q" value="<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" class="form-control" placeholder="Pencarian : Kode Barang Rusak" style="float: right; width: 270px;">
										
											<a href="so.php?module=so&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<!-- <button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a> -->
											&nbsp;&nbsp;&nbsp;
										</form>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO <i class="fa fa-sort"></i></th>
												<th>KODE BARANG RUSAK<i class="fa fa-sort"></i></th>
												<th style='text-align: center;'>TANGGAL<i class="fa fa-sort"></i></th>
												
												<th style='text-align: center;'>AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['name'] = 'dataSo';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataSo']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataSo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSo']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataSo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSo']['index']]['KD_brg_rusak'];?>
</td>
													<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataSo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSo']['index']]['orderDate'];?>
</td>
													
													<td style='text-align: center;'>
														<a title="Detail" href="so.php?module=so&act=detailso&soID=<?php echo $_smarty_tpl->tpl_vars['dataSo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSo']['index']]['soID'];?>
&soFaktur=<?php echo $_smarty_tpl->tpl_vars['dataSo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSo']['index']]['soFaktur'];?>
&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="so.php?module=so&act=delete&soID=<?php echo $_smarty_tpl->tpl_vars['dataSo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSo']['index']]['soID'];?>
&soFaktur=<?php echo $_smarty_tpl->tpl_vars['dataSo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSo']['index']]['soFaktur'];?>
&soNo=<?php echo $_smarty_tpl->tpl_vars['dataSo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSo']['index']]['KD_brg_rusak'];?>
" onclick="return confirm('Anda Yakin ingin menghapus <?php echo $_smarty_tpl->tpl_vars['dataSo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSo']['index']]['KD_brg_rusak'];?>
?');"><img src="img/icons/delete.png" width="18"></a>
													</td>
												</tr>
											<?php endfor; endif; ?>
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
						
						<?php }else{ ?>
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="so.php">
											<input type="hidden" name="module" value="so">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											
											<input type="text" id="q" name="q" value="<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" class="form-control" placeholder="Pencarian : Kode Barang Rusak" style="float: right; width: 270px;">
										
											<a href="so.php?module=so&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<!--
											<a href="print_so.php?act=print&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a> -->
											&nbsp;&nbsp;&nbsp;
										</form>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO <i class="fa fa-sort"></i></th>
												<th>KODE BARANG RUSAK<i class="fa fa-sort"></i></th>
												<th style='text-align: center;'>TANGGAL<i class="fa fa-sort"></i></th>
											
												<th style='text-align: center;'>AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['name'] = 'dataSo';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataSo']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSo']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataSo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSo']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataSo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSo']['index']]['KD_brg_rusak'];?>
</td>
													<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataSo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSo']['index']]['orderDate'];?>
</td>
												
													<td style='text-align: center;'>
														<a title="Detail" href="so.php?module=so&act=detailso&soID=<?php echo $_smarty_tpl->tpl_vars['dataSo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSo']['index']]['soID'];?>
&soFaktur=<?php echo $_smarty_tpl->tpl_vars['dataSo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSo']['index']]['soFaktur'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="so.php?module=so&act=delete&soID=<?php echo $_smarty_tpl->tpl_vars['dataSo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSo']['index']]['soID'];?>
&soFaktur=<?php echo $_smarty_tpl->tpl_vars['dataSo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSo']['index']]['soFaktur'];?>
&soNo=<?php echo $_smarty_tpl->tpl_vars['dataSo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSo']['index']]['KD_brg_rusak'];?>
" onclick="return confirm('Anda Yakin ingin menghapus <?php echo $_smarty_tpl->tpl_vars['dataSo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSo']['index']]['KD_brg_rusak'];?>
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
						<?php }?>
						
					</div><!-- /.box -->
					
				</section><!-- /.Left col -->
			</div><!-- /.row (main row) -->
		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->

<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>