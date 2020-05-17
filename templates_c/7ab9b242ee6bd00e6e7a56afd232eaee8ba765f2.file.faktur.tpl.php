<?php /* Smarty version Smarty-3.1.11, created on 2017-08-15 16:41:16
         compiled from ".\templates\faktur.tpl" */ ?>
<?php /*%%SmartyHeaderCode:85195992c13c1ae659-52135823%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7ab9b242ee6bd00e6e7a56afd232eaee8ba765f2' => 
    array (
      0 => '.\\templates\\faktur.tpl',
      1 => 1502790072,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '85195992c13c1ae659-52135823',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5992c13c915098_62848173',
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'nofaktur' => 0,
    'bbmID' => 0,
    'tglfaktur' => 0,
    'spbNo' => 0,
    'numsSpb' => 0,
    'numsBbm' => 0,
    'supplierID' => 0,
    'namaSupplier' => 0,
    'alamatSupplier' => 0,
    'tanggal' => 0,
    'dataDetail' => 0,
    'total' => 0,
    'bbmFaktur' => 0,
    'dataBbmDetail' => 0,
    'q' => 0,
    'page' => 0,
    'endDate' => 0,
    'startDate' => 0,
    'dataBbm' => 0,
    'pageLink' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5992c13c915098_62848173')) {function content_5992c13c915098_62848173($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


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

		function toRp(amount, decimalSeparator, thousandsSeparator, nDecimalDigits){
			var num = parseFloat( amount ); //convert to float
			//default values
			decimalSeparator = decimalSeparator || ',';
			thousandsSeparator = thousandsSeparator || ',';
			nDecimalDigits = nDecimalDigits == null? 2 : nDecimalDigits;
			
			var fixed = num.toFixed(nDecimalDigits); //limit or add decimal digits
			//separate begin [$1], middle [$2] and decimal digits [$4]
			var parts = new RegExp('^(-?\\d{1,3})((?:\\d{3})+)(\\.(\\d{' + nDecimalDigits + '}))?$').exec(fixed);
			
			if(parts){ //num >= 1000 || num < = -1000
				return parts[1] + parts[2].replace(/\d{3}/g, thousandsSeparator + '$&') + (parts[4] ? decimalSeparator + parts[4] : '');
			}else{
				return fixed.replace('.', decimalSeparator);
			}
		}  



	////////////////////////////////////////////
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
			
			$( "#tglfaktur" ).datepicker({
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
			
			$('#tglfaktur').change(function () {
				var nofaktur = $("#nofaktur").val();
				var bbmID = $("#bbmID").val();
				var spbNo = $("#spbNo").val();
				var tglfaktur = $("#tglfaktur").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_bbm_receivedate.php',
					dataType: 'JSON',
					data:{
						nofaktur: nofaktur,
						bbmID: bbmID,
						tglfaktur: tglfaktur
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "bbm.php?module=bbm&act=add&spbNo=" + spbNo;
					}
				});
			});
			
			$('#note').change(function () {
				var nofaktur = $("#nofaktur").val();
				var bbmID = $("#bbmID").val();
				var spbNo = $("#spbNo").val();
				var note = $("#note").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_bbm_note.php',
					dataType: 'JSON',
					data:{
						nofaktur: nofaktur,
						bbmID: bbmID,
						spbNo: spbNo,
						note: note
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "bbm.php?module=bbm&act=add&spbNo=" + spbNo;
					}
				});
			});
			
			$( ".tgl_kadaluarsa" ).datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "dd-mm-yy"
			});


			$('#spbNo').change(function () {
				var spbNo = $("#spbNo").val();
				
				window.location.href = "bbm.php?module=bbm&act=add&spbNo=" + spbNo;
			});
			
			$(".modalbox").fancybox();
			$(".modalbox2").fancybox();
			
			$("#bbm").submit(function() { return false; });
			$("#bbm2").submit(function() { return false; });
			
			$("#send2").on("click", function(){
				var nofaktur = $("#nofaktur").val();
				var productID = $("#productID").val();
				var productName1 = $("#productName1").val();
				var qty = parseInt($("#qty").val());
				var price = parseInt($("#price").val());
				var desc = $("#desc").val();
				
				if (qty != '' && spbNo != '' && productID != '' && price != ''){
					
					$.ajax({
						type: 'POST',
						url: 'save_spb.php',
						dataType: 'JSON',
						data:{
							qty: qty,
							price: price,
							spbNo: spbNo,
							productID: productID,
							productName1: productName1,
							desc: desc
						},
						beforeSend: function (data) {
							$('#send2').hide();
						},
						success: function(data) {
							setTimeout("$.fancybox.close()", 1000);
							window.location.href = "spb.php?module=spb&act=add&msg=Data berhasil disimpan";
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
						
						<?php if ($_smarty_tpl->tpl_vars['module']->value=='bbm'&&$_smarty_tpl->tpl_vars['act']->value=='add'){?>
							
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
								<h3 class="box-title">Tambah Transaksi Pembelian</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="bbm.php?module=bbm&act=cancel" onclick="return confirm('Anda Yakin ingin membatalkan transaksi pembelian ini?');"><button class="btn btn-default pull-right">Batal Trx</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<form method="POST" action="bbm.php?module=bbm&act=input">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="150">NO FAKTUR / TGL</td>
										<td width="5">:</td>
										<td><input type="hidden" id="nofaktur" name="nofaktur" value="<?php echo $_smarty_tpl->tpl_vars['nofaktur']->value;?>
">
											<input type="hidden" id="bbmID" name="bbmID" value="<?php echo $_smarty_tpl->tpl_vars['bbmID']->value;?>
">
											<input type="text" id="nofaktur" name="nofaktur" value="<?php echo $_smarty_tpl->tpl_vars['nofaktur']->value;?>
" class="form-control" placeholder="ID BBM" style="width: 110px; float: left" DISABLED>
											<input type="text" id="tglfaktur" name="tglfaktur" value="<?php echo $_smarty_tpl->tpl_vars['tglfaktur']->value;?>
" class="form-control" placeholder="Tanggal " style="width: 160px;" required>
										</td>
									</tr>
									<tr valign="top">
										<td>NO PO</td>
										<td>:</td>
										<td><input type="text" id="spbNo" name="spbNo" value="<?php echo $_smarty_tpl->tpl_vars['spbNo']->value;?>
" class="form-control" placeholder="Nomor PO" style="width: 270px;" required> 
											<?php if ($_smarty_tpl->tpl_vars['numsSpb']->value=='0'&&$_smarty_tpl->tpl_vars['spbNo']->value!=''){?>
												<font color="#f56954">Nomor PO tidak ditemukan.</font>
											<?php }?>
											<?php if ($_smarty_tpl->tpl_vars['numsBbm']->value>0&&$_smarty_tpl->tpl_vars['spbNo']->value!=''){?>
												<font color="#f56954">Nomor PO sudah digunakan.</font>
											<?php }?>
										</td>
									</tr>
									<tr>
										<td>SUPPLIER</td>
										<td>:</td>
										<td><?php if ($_smarty_tpl->tpl_vars['numsBbm']->value=='0'&&$_smarty_tpl->tpl_vars['spbNo']->value!=''){?>
											<input type="hidden" id="supplierID" name="supplierID" value="<?php echo $_smarty_tpl->tpl_vars['supplierID']->value;?>
">
											<input type="hidden" id="namaSupplier" name="namaSupplier" value="<?php echo $_smarty_tpl->tpl_vars['namaSupplier']->value;?>
">
											<input type="hidden" id="alamatSupplier" name="alamatSupplier" value="<?php echo $_smarty_tpl->tpl_vars['alamatSupplier']->value;?>
">
											<input type="text" id="namaSupplier" name="namaSupplier" value="<?php echo $_smarty_tpl->tpl_vars['namaSupplier']->value;?>
" class="form-control" placeholder="Supplier" style="width: 270px;" DISABLED>
											<?php }else{ ?>
											<input type="text" id="namaSupplier" name="namaSupplier" class="form-control" placeholder="Supplier" style="width: 270px;" DISABLED>
											<?php }?>
										</td>
									</tr>
									<tr>
										<td>TANGGAL PO</td>
										<td>:</td>
										<td><input type="hidden" id="tanggal" name="tanggal" value="<?php echo $_smarty_tpl->tpl_vars['tanggal']->value;?>
">
											<?php if ($_smarty_tpl->tpl_vars['numsBbm']->value=='0'&&$_smarty_tpl->tpl_vars['spbNo']->value!=''){?>
												<input type="text" id="tanggal" name="tanggal" value="<?php echo $_smarty_tpl->tpl_vars['tanggal']->value;?>
" class="form-control" placeholder="Tgl Order" style="float: left; width: 135px;" DISABLED></td>
											<?php }else{ ?>
												<input type="text" id="tanggal" name="tanggal" class="form-control" placeholder="Tgl Order" style="float: left; width: 135px;" DISABLED></td>
											<?php }?>
									</tr>
									
									<tr>
										<td colspan="3">
											<br>
										</td>
									</tr>
								</table>

								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO</th>
												<th>NAMA BARANG</th>
												<th>HARGA</th>
												<th>QTY</th>
												<th>SUBTOTAL</th>
												<th>NO. BARANG</th>
												<th>TGL KADALUARSA</th>
											
											</tr>
										</thead>
										<tbody>
											<?php if ($_smarty_tpl->tpl_vars['numsBbm']->value=='0'&&$_smarty_tpl->tpl_vars['spbNo']->value!=''){?>
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
 <input type="hidden" name="detailID[]" id="detailID" value="<?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['detailID'];?>
"></td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['productName'];?>
 <input type="hidden" name="productName[]" id="productName" value="<?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['productName'];?>
"> <input type="hidden" name="productID[]" id="productID" value="<?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['productID'];?>
"></td>
													<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['price'];?>

													<input type="hidden" name="price[]" id="price" value="<?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['price'];?>
"></td>
													<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['qty'];?>
 
													<input type="hidden" name="qty[]" id="qty" value="<?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['qty'];?>
"> </td>
													<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['subtotal'];?>
 </td>
													
													<td>
														<input type="text" class="no_detail_brg" name="no_detail_brg[]" value="<?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['no_detail_brg'];?>
" class="form-control" placeholder="No. Detail Barang" style="width: 160px;" required>
													</td>
													<td>
														
														<input type="text" class="tgl_kadaluarsa" name="tgl_kadaluarsa[]" value="<?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['tgl_kadaluarsa'];?>
" class="form-control" placeholder="Tanggal Kadaluarsa" style="width: 160px;" required>
													</td>
													
												</tr>
											<?php endfor; endif; ?>
											<?php }?>
										</tbody>
									</table>
								</div>
								<br>
								<br>
								<?php if ($_smarty_tpl->tpl_vars['numsSpb']->value>0){?>
									<?php if ($_smarty_tpl->tpl_vars['numsBbm']->value>0&&$_smarty_tpl->tpl_vars['spbNo']->value!=''){?>
									<?php }else{ ?>

								<table cellpadding="3" cellspacing="3">
											<tr>
												<td width="150">GRANDTOTAL</td>
												<td>:</td>
												<td><input type="hidden" id="total" name="total" value="<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
">
													<input type="text" id="total" name="total" value="<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
" class="form-control" style="width: 270px;" DISABLED>
												</td>
											</tr>
										</table>
										<br>


										<button type="submit" class="btn btn-primary">Simpan</button>
									<?php }?>
								<?php }?>
								</form>
							
							</div><!-- /.box-body -->
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='bbm'&&$_smarty_tpl->tpl_vars['act']->value=='finish'){?>
							
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
								<h3 class="box-title">Faktur Transaksi Pembelian</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_bbm.php?module=bbm&act=print&bbmID=<?php echo $_smarty_tpl->tpl_vars['bbmID']->value;?>
&nofaktur=<?php echo $_smarty_tpl->tpl_vars['nofaktur']->value;?>
&bbmFaktur=<?php echo $_smarty_tpl->tpl_vars['bbmFaktur']->value;?>
" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="bbm.php"><button class="btn btn-default pull-right">Close</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="150">NO FAKTUR / TGL</td>
										<td width="5">:</td>
										<td><input type="text" id="nofaktur" name="nofaktur" value="<?php echo $_smarty_tpl->tpl_vars['nofaktur']->value;?>
" class="form-control" placeholder="ID BBM" style="width: 110px; float: left" DISABLED>
											<input type="text" id="tglfaktur" name="tglfaktur" value="<?php echo $_smarty_tpl->tpl_vars['tglfaktur']->value;?>
" class="form-control" placeholder="Tanggal " style="width: 160px;" DISABLED>
										</td>
									</tr>
									<tr valign="top">
										<td>NO PO</td>
										<td>:</td>
										<td><input type="text" id="spbNo" name="spbNo" value="<?php echo $_smarty_tpl->tpl_vars['spbNo']->value;?>
" class="form-control" placeholder="Nomor PO" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>SUPPLIER</td>
										<td>:</td>
										<td><input type="text" id="namaSupplier" name="namaSupplier" value="<?php echo $_smarty_tpl->tpl_vars['namaSupplier']->value;?>
" class="form-control" placeholder="Supplier" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>TGL PO</td>
										<td>:</td>
										<td><input type="text" id="tanggal" name="tanggal" value="<?php echo $_smarty_tpl->tpl_vars['tanggal']->value;?>
" class="form-control" placeholder="Tgl Order" style="float: left; width: 135px;" DISABLED></td>
									</tr>
									<tr>
										<td colspan="3">
											<br>
										</td>
									</tr>
								</table>

								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO</th>
												<th>NAMA BARANG</th>
												<th>HARGA</th>
												<th>QTY</th>
												<th>SUBTOTAL</th>
												<th>NO. BARANG</th>
												<th>TGL KADALUARSA</th>
											
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['name'] = 'dataBbmDetail';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataBbmDetail']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataBbmDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbmDetail']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataBbmDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbmDetail']['index']]['productName'];?>
</td>
													<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataBbmDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbmDetail']['index']]['price'];?>
</td>
													<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataBbmDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbmDetail']['index']]['qty'];?>
</td>
													<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataBbmDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbmDetail']['index']]['subtotal'];?>
</td>
													
													<td><?php echo $_smarty_tpl->tpl_vars['dataBbmDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbmDetail']['index']]['no_detail_brg'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataBbmDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbmDetail']['index']]['tgl_kadaluarsa'];?>
</td>
													
												</tr>
											<?php endfor; endif; ?>
										</tbody>
									</table>
								</div>
								<br><br>
							<table cellpadding="3" cellspacing="3">
											<tr>
											<td width="150">GRANDTOTAL</td>
												<td>:</td>
												<td><input type="hidden" id="total" name="total" value="<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
">
													<input type="text" id="total" name="total" value="<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
" class="form-control" style="width: 270px;" DISABLED>
												</td>
											</tr>
										</table>
										<br>
							</div><!-- /.box-body -->
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='bbm'&&$_smarty_tpl->tpl_vars['act']->value=='detailbbm'){?>
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Faktur Transaksi Pembelian</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_bbm.php?module=bbm&act=print&bbmID=<?php echo $_smarty_tpl->tpl_vars['bbmID']->value;?>
&nofaktur=<?php echo $_smarty_tpl->tpl_vars['nofaktur']->value;?>
&bbmFaktur=<?php echo $_smarty_tpl->tpl_vars['bbmFaktur']->value;?>
" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<?php if ($_smarty_tpl->tpl_vars['q']->value!=''){?>
											<a href="bbm.php?module=bbm&act=search&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><button class="btn btn-default pull-right">Back</button></a>
										<?php }else{ ?>
											<a href="bbm.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><button class="btn btn-default pull-right">Back</button></a>
										<?php }?>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="150">NO FAKTUR / TGL</td>
										<td width="5">:</td>
										<td><input type="text" id="nofaktur" name="nofaktur" value="<?php echo $_smarty_tpl->tpl_vars['nofaktur']->value;?>
" class="form-control" placeholder="ID BBM" style="width: 110px; float: left" DISABLED>
											<input type="text" id="tglfaktur" name="tglfaktur" value="<?php echo $_smarty_tpl->tpl_vars['tglfaktur']->value;?>
" class="form-control" placeholder="Tanggal " style="width: 160px;" DISABLED>
										</td>
									</tr>
									<tr valign="top">
										<td>NO PO</td>
										<td>:</td>
										<td><input type="text" id="spbNo" name="spbNo" value="<?php echo $_smarty_tpl->tpl_vars['spbNo']->value;?>
" class="form-control" placeholder="Nomor PO" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>SUPPLIER</td>
										<td>:</td>
										<td><input type="text" id="namaSupplier" name="namaSupplier" value="<?php echo $_smarty_tpl->tpl_vars['namaSupplier']->value;?>
" class="form-control" placeholder="Supplier" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>TGL PO</td>
										<td>:</td>
										<td><input type="text" id="tanggal" name="tanggal" value="<?php echo $_smarty_tpl->tpl_vars['tanggal']->value;?>
" class="form-control" placeholder="Tgl Order" style="float: left; width: 135px;" DISABLED></td>
									</tr>
									
									<tr>
										<td colspan="3">
											<br>
										</td>
									</tr>
								</table>

								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO</th>
												<th>NAMA BARANG</th>
												<th>HARGA</th>
												<th>QTY</th>
												<th>SUBTOTAL</th>
												<th>NO. BARANG</th>
												<th>TGL KADALUARSA</th>
												
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['name'] = 'dataBbmDetail';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataBbmDetail']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataBbmDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbmDetail']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataBbmDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbmDetail']['index']]['productName'];?>
</td>
													<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataBbmDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbmDetail']['index']]['price'];?>
</td>
													<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataBbmDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbmDetail']['index']]['qty'];?>
</td>
													<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataBbmDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbmDetail']['index']]['subtotal'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataBbmDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbmDetail']['index']]['no_detail_brg'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataBbmDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbmDetail']['index']]['tgl_kadaluarsa'];?>
</td>
													
												</tr>
											<?php endfor; endif; ?>
										</tbody>
									</table>
								</div>
								<br><br>
							<table cellpadding="3" cellspacing="3">
											<tr>
											<td width="150">GRANDTOTAL</td>
												<td>:</td>
												<td><input type="hidden" id="total" name="total" value="<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
">
													<input type="text" id="total" name="total" value="<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
" class="form-control" style="width: 270px;" DISABLED>
												</td>
											</tr>
										</table>
										<br>
							</div><!-- /.box-body -->
						
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='bbm'&&$_smarty_tpl->tpl_vars['act']->value=='search'){?>
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="bbm.php">
											<input type="hidden" name="module" value="bbm">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" id="endDate" name="endDate" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
" id="startDate" name="startDate" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" id="q" name="q" value="<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" class="form-control" placeholder="Pencarian : Nomor Transaksi Pembelian" style="float: right; width: 270px;" required>
										
											<a href="bbm.php?module=bbm&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_bbm.php?act=print&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
&startDate=<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
&endDate=<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
												<th>NO FAKTUR <i class="fa fa-sort"></i></th>
												<th>NO PO <i class="fa fa-sort"></i></th>
												<th>SUPPLIER <i class="fa fa-sort"></i></th>
												<th>TANGGAL FAKTUR <i class="fa fa-sort"></i></th>
											<!--	<th>DIBUAT OLEH <i class="fa fa-sort"></i></th> -->
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['name'] = 'dataBbm';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataBbm']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataBbm']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbm']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataBbm']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbm']['index']]['nofaktur'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataBbm']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbm']['index']]['spbNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataBbm']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbm']['index']]['namaSupplier'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataBbm']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbm']['index']]['tglfaktur'];?>
</td>
												<!--	<td><?php echo $_smarty_tpl->tpl_vars['dataBbm']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbm']['index']]['staffName'];?>
</td> -->
													<td>
														<a title="Detail" href="bbm.php?module=bbm&act=detailbbm&bbmID=<?php echo $_smarty_tpl->tpl_vars['dataBbm']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbm']['index']]['bbmID'];?>
&nofaktur=<?php echo $_smarty_tpl->tpl_vars['dataBbm']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbm']['index']]['nofaktur'];?>
&bbmFaktur=<?php echo $_smarty_tpl->tpl_vars['dataBbm']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbm']['index']]['bbmFaktur'];?>
&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="bbm.php?module=bbm&act=delete&bbmID=<?php echo $_smarty_tpl->tpl_vars['dataBbm']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbm']['index']]['bbmID'];?>
&bbmFaktur=<?php echo $_smarty_tpl->tpl_vars['dataBbm']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbm']['index']]['bbmFaktur'];?>
&nofaktur=<?php echo $_smarty_tpl->tpl_vars['dataBbm']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbm']['index']]['nofaktur'];?>
" onclick="return confirm('Anda Yakin ingin membatalkan transaksi <?php echo $_smarty_tpl->tpl_vars['dataBbm']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbm']['index']]['nofaktur'];?>
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
										<form method="GET" action="bbm.php">
											<input type="hidden" name="module" value="bbm">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" id="endDate" name="endDate" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
" id="startDate" name="startDate" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" id="q" name="q" value="<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" class="form-control" placeholder="Pencarian : No Faktur Pembelian" style="float: right; width: 270px;">
										
											<a href="bbm.php?module=bbm&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_bbm.php?act=print&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
&startDate=<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
&endDate=<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
												<th>NO FAKTUR <i class="fa fa-sort"></i></th>
												<th>NO PO <i class="fa fa-sort"></i></th>
												<th>SUPPLIER <i class="fa fa-sort"></i></th>
												<th>TANGGAL FAKTUR<i class="fa fa-sort"></i></th>
											<!--	<th>DIBUAT OLEH <i class="fa fa-sort"></i></th> -->
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['name'] = 'dataBbm';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataBbm']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbm']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataBbm']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbm']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataBbm']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbm']['index']]['nofaktur'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataBbm']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbm']['index']]['spbNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataBbm']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbm']['index']]['namaSupplier'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataBbm']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbm']['index']]['tglfaktur'];?>
</td>
											<!--		<td><?php echo $_smarty_tpl->tpl_vars['dataBbm']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbm']['index']]['staffName'];?>
</td> -->
													<td>
														<a title="Detail" href="bbm.php?module=bbm&act=detailbbm&bbmID=<?php echo $_smarty_tpl->tpl_vars['dataBbm']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbm']['index']]['bbmID'];?>
&nofaktur=<?php echo $_smarty_tpl->tpl_vars['dataBbm']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbm']['index']]['nofaktur'];?>
&bbmFaktur=<?php echo $_smarty_tpl->tpl_vars['dataBbm']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbm']['index']]['bbmFaktur'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="bbm.php?module=bbm&act=delete&bbmID=<?php echo $_smarty_tpl->tpl_vars['dataBbm']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbm']['index']]['bbmID'];?>
&bbmFaktur=<?php echo $_smarty_tpl->tpl_vars['dataBbm']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbm']['index']]['bbmFaktur'];?>
&nofaktur=<?php echo $_smarty_tpl->tpl_vars['dataBbm']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbm']['index']]['nofaktur'];?>
" onclick="return confirm('Anda Yakin ingin membatalkan transaksi <?php echo $_smarty_tpl->tpl_vars['dataBbm']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbm']['index']]['nofaktur'];?>
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