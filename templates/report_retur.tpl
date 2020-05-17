{include file="header.tpl"}

<style>
	div.ui-datepicker{
		font-size:14px;
	}
</style>

<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>
<script type='text/javascript' src="design/js/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="design/css/jquery.autocomplete.css" />

{literal}
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
		
		function sum() {
			var subtotal = eval($("#subtotal").val());
			var grandtotal = eval($("#grandtotal").val());
			var ppnType = $("#ppnType").val();
			
			// ppn
			if (ppnType == '1') {
				var ppn = eval(0.1 * subtotal);
				var ppnrp = toRp(ppn);
				var grandtotal2 = eval(subtotal + ppn);
				var grandtotalrp = toRp(grandtotal2);
				
				document.getElementById('ppn').value = ppn.toFixed(2);
				document.getElementById('ppnrp').value = ppnrp;
				document.getElementById('grandtotal').value = grandtotal2.toFixed(2);
				document.getElementById('grandtotalrp').value = grandtotalrp;
			}
			else{
				var ppn = eval(0 * subtotal);
				var ppnrp = toRp(ppn);
				var grandtotal2 = eval(subtotal + ppn);
				var grandtotalrp = toRp(grandtotal2);
				
				document.getElementById('ppn').value = ppn.toFixed(2);
				document.getElementById('ppnrp').value = ppnrp;
				document.getElementById('grandtotal').value = grandtotal2.toFixed(2);
				document.getElementById('grandtotalrp').value = grandtotalrp;
			}
		}
		
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
			
			$( "#tanggalretur" ).datepicker({
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
			
			$('#nofaktur').change(function () {
				var nofaktur = $("#nofaktur").val();
				
				window.location.href = "retur_suppliers.php?module=returbuy&act=add&nofaktur=" + nofaktur;
			});
			
			$(".modalbox").fancybox();
			$(".modalbox2").fancybox();
			
			$("#returbuy").submit(function() { return false; });
			$("#returbuy2").submit(function() { return false; });
			
		});
	</script>
{/literal}

<header class="header">
	
	{include file="logo.tpl"}
		
	{include file="navigation.tpl"}
		
</header>

<div class="wrapper row-offcanvas row-offcanvas-left">
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="left-side sidebar-offcanvas">
		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">

			{include file="user_panel.tpl"}
        	
			{include file="side_menu.tpl"}

		</section>
		<!-- /.sidebar -->
	</aside>
	
	<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		
		{include file="breadcumb.tpl"}
		
		<!-- Main content -->
		<section class="content">
		
			<!-- Main row -->
			<div class="row">
				<!-- Left col -->
				<section class="col-lg-12 connectedSortable">
				
					<!-- TO DO List -->
					<div class="box box-primary">
						
						{if $module == 'returbuy' AND $act == 'add'}
							{literal}
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
							{/literal}
						
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Tambah Retur Pembelian</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="retur_suppliers.php?module=returbuy&act=cancel" onclick="return confirm('Anda Yakin ingin membatalkan retur pembelian ini?');"><button class="btn btn-default pull-right">Batalkan Retur</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<form method="POST" action="retur_suppliers.php?module=returbuy&act=input">
								<input type="hidden" id="supplierID" name="supplierID" value="{$supplierID}">
								<input type="hidden" id="namaSupplier" name="namaSupplier" value="{$namaSupplier}">
							
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="170">NO RETUR / TANGGAL</td>
										<td width="5">:</td>
										<td><input type="hidden" id="returNo" name="returNo" value="{$returNo}">
											<input type="text" id="returNo" name="returNo" value="{$returNo}" class="form-control" placeholder="NO RETUR" style="width: 110px; float: left" DISABLED>
											<input type="text" id="tanggalretur" name="tanggalretur" value="{$tanggalretur}" class="form-control" placeholder="Tanggal Retur Pembelian" style="width: 160px;" required>
										</td>
									</tr>
									<tr valign="top">
										<td>NO FAKTUR</td>
										<td>:</td>
										<td><input type="text" id="nofaktur" name="nofaktur" value="{$nofaktur}" class="form-control" placeholder="Nomor Faktur" style="width: 270px;" required>
											{if $numsBBuy == '0' AND $nofaktur != ''}
												<span style="color: red;">Nomor faktur pembelian tidak ditemukan.</span>
											{/if}
										</td>
									</tr>
									<tr>
										<td>SUPPLIER</td>
										<td>:</td>
										<td><input type="text" id="supplier" name="supplier" value="{$namaSupplier}" class="form-control" placeholder="Supplier" style="width: 270px;" DISABLED></td>
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
												<th>HARGA BELI</th>
												<th style='text-align: center;' >QTY SISA</th>
												<th style='text-align: center;' >QTY RETUR</th>
												<th style='text-align: center;' >KETERANGAN</th>
											</tr>
										</thead>
										<tbody>
											{if $numsBBuy > 0}
												{section name=dataBbmDetail loop=$dataBbmDetail}
													<tr>
														<td>{$dataBbmDetail[dataBbmDetail].no} <input type="hidden" name="detailID[]" value="{$dataBbmDetail[dataBbmDetail].detailID}"></td>
													
														<td>{$dataBbmDetail[dataBbmDetail].productName} <input type="hidden" name="productID[]" value="{$dataBbmDetail[dataBbmDetail].productID}">
														<input type="hidden" id="no_detail_brg" name="no_detail_brg[]" value="{$dataBbmDetail[dataBbmDetail].no_detail_brg}">
														 <input type="hidden" name="productName[]" value="{$dataBbmDetail[dataBbmDetail].productName}"></td>
														<td style='text-align: right;'>{$dataBbmDetail[dataBbmDetail].pricerp} <input type="hidden" name="harga[]" value="{$dataBbmDetail[dataBbmDetail].price}"></td>
														<td style='text-align: center;'>{$dataBbmDetail[dataBbmDetail].stockAmount} </td>
														<td style='text-align: center;'>{$dataBbmDetail[dataBbmDetail].jumlah}  <input type="hidden" name="jumlah[]" value="{$dataBbmDetail[dataBbmDetail].jumlah}"></td>
														<td style='text-align: center;'>{$dataBbmDetail[dataBbmDetail].ket}  <input type="hidden" name="ket[]" value="{$dataBbmDetail[dataBbmDetail].ket}"></td>
													</tr>
												{/section}
											{/if}
										</tbody>
									</table>
								</div>
								<br>
								<button type="submit" class="btn btn-primary">Simpan</button>
								</form>
							
							</div><!-- /.box-body -->
							
						{elseif $module == 'returbuy' AND $act == 'finish'}
							{literal}
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
							{/literal}
						
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Retur Pembelian</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_returbuy.php?module=returbuy&act=print&nofaktur={$nofaktur}&returNo={$returNo}&returID={$returID}" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="retur_suppliers.php"><button class="btn btn-default pull-right">Close</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="170">NO RETUR / TANGGAL</td>
										<td width="5">:</td>
										<td>{$returNo} / {$tanggalretur}</td>
									</tr>
									<tr valign="top">
										<td>NO FAKTUR</td>
										<td>:</td>
										<td>{$nofaktur}</td>
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
												<th>HARGA BELI</th>
												<th>QTY RETUR</th>
												<th>SUBTOTAL</th>
												<th>KETERANGAN</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataReturDetail loop=$dataReturDetail}
												<tr>
													<td>{$dataReturDetail[dataReturDetail].no} </td>
													
													<td>{$dataReturDetail[dataReturDetail].productName}</td>
													<td style='text-align: right;'>{$dataReturDetail[dataReturDetail].price}</td>
													<td style='text-align: center;'>{$dataReturDetail[dataReturDetail].qty}</td>
													<td style='text-align: center;'>{$dataReturDetail[dataReturDetail].subtotal}</td>
													<td>{$dataReturDetail[dataReturDetail].note}</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
								<br>
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="190"><b>GRANDTOTAL<b></td>
										<td width="5"><b>:<b></td>
										<td><b>{$subtotal}<b></td>
									</tr>
									
								</table>
							
							</div><!-- /.box-body -->
							
						{elseif $module == 'returbuy' AND $act == 'detailretur'}
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Retur Pembelian</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_returbuy.php?module=returbuy&act=print&nofaktur={$nofaktur}&returNo={$returNo}&returID={$returID}" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="retur_suppliers.php"><button class="btn btn-default pull-right">Close</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="170">NO RETUR / TANGGAL</td>
										<td width="5">:</td>
										<td>{$returNo} / {$tanggalretur}</td>
									</tr>
									<tr valign="top">
										<td>NO FAKTUR</td>
										<td>:</td>
										<td>{$nofaktur}</td>
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
												<th>HARGA BELI</th>
												<th>QTY RETUR</th>
												<th>KETERANGAN</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataReturDetail loop=$dataReturDetail}
												<tr>
													<td>{$dataReturDetail[dataReturDetail].no} </td>
													
													<td>{$dataReturDetail[dataReturDetail].productName}</td>
													<td style='text-align: right;'>{$dataReturDetail[dataReturDetail].price}</td>
													<td style='text-align: center;'>{$dataReturDetail[dataReturDetail].qty}</td>
													<td>{$dataReturDetail[dataReturDetail].note}</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
								<br>
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="190"><b>GRANDTOTAL<b></td>
										<td width="5"><b>:<b></td>
										<td><b>{$subtotal}<b></td>
									</tr>
								
								</table>
							
							</div><!-- /.box-body -->
							
						{elseif $module == 'returbuy' AND $act == 'search'}
						
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
									
										<form method="GET" action="report_retur.php">
											<input type="hidden" name="module" value="returbuy">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" value="{$endDate}" id="endDate" name="endDate" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" value="{$startDate}" id="startDate" name="startDate" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											
											
											<a href="print_returbuy.php?act=print&q={$q}&startDate={$startDate}&endDate={$endDate}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
												<th>NO RETUR <i class="fa fa-sort"></i></th>
												<th>TGL RETUR <i class="fa fa-sort"></i></th>
												<th>FAKTUR <i class="fa fa-sort"></i></th>
												<th>SUPPLIER <i class="fa fa-sort"></i></th>
												<th>TOTAL <i class="fa fa-sort"></i></th>
											<!--	<th>DIBUAT OLEH <i class="fa fa-sort"></i></th> -->
											
											</tr>
										</thead>
										<tbody>
											{section name=dataRetur loop=$dataRetur}
												<tr>
													<td>{$dataRetur[dataRetur].no}</td>
													<td>{$dataRetur[dataRetur].returNo}</td>
													<td>{$dataRetur[dataRetur].tanggalretur}</td>
													<td>{$dataRetur[dataRetur].nofaktur}</td>
													<td>{$dataRetur[dataRetur].namaSupplier}</td>
													<td>{$dataRetur[dataRetur].subtotal}</td>
											<!--		<td>{$dataRetur[dataRetur].staffName}</td> -->
													
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-left">
									<ul class="pagination pagination-sm inline">
										{$pageLink}
									</ul>
								</div>
							</div><!-- /.box-header -->
													
						{else}
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
									
										<form method="GET" action="report_retur.php">
											<input type="hidden" name="module" value="returbuy">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" value="{$endDate}" id="endDate" name="endDate" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" value="{$startDate}" id="startDate" name="startDate" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											
											
											<a href="print_returbuy.php?act=print&q={$q}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
												<th>NO RETUR <i class="fa fa-sort"></i></th>
												<th>TGL RETUR <i class="fa fa-sort"></i></th>
												<th>FAKTUR <i class="fa fa-sort"></i></th>
												<th>SUPPLIER <i class="fa fa-sort"></i></th>
												<th>TOTAL <i class="fa fa-sort"></i></th>
											<!--	<th>DIBUAT OLEH <i class="fa fa-sort"></i></th> -->
											
											</tr>
										</thead>
										<tbody>
											{section name=dataRetur loop=$dataRetur}
												<tr>
													<td>{$dataRetur[dataRetur].no}</td>
													<td>{$dataRetur[dataRetur].returNo}</td>
													<td>{$dataRetur[dataRetur].tanggalretur}</td>
													<td>{$dataRetur[dataRetur].nofaktur}</td>
													<td>{$dataRetur[dataRetur].namaSupplier}</td>
													<td>{$dataRetur[dataRetur].subtotal}</td>
											<!--		<td>{$dataRetur[dataRetur].staffName}</td> -->
													
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-left">
									<ul class="pagination pagination-sm inline">
										{$pageLink}
									</ul>
								</div>
							</div><!-- /.box-header -->
						{/if}
						
					</div><!-- /.box -->
					
				</section><!-- /.Left col -->
			</div><!-- /.row (main row) -->
		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->

{include file="footer.tpl"}