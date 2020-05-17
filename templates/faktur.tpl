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
						
						{if $module == 'bbm' AND $act == 'add'}
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
										<td><input type="hidden" id="nofaktur" name="nofaktur" value="{$nofaktur}">
											<input type="hidden" id="bbmID" name="bbmID" value="{$bbmID}">
											<input type="text" id="nofaktur" name="nofaktur" value="{$nofaktur}" class="form-control" placeholder="ID BBM" style="width: 110px; float: left" DISABLED>
											<input type="text" id="tglfaktur" name="tglfaktur" value="{$tglfaktur}" class="form-control" placeholder="Tanggal " style="width: 160px;" required>
										</td>
									</tr>
									<tr valign="top">
										<td>NO PO</td>
										<td>:</td>
										<td><input type="text" id="spbNo" name="spbNo" value="{$spbNo}" class="form-control" placeholder="Nomor PO" style="width: 270px;" required> 
											{if $numsSpb == '0' AND $spbNo != ''}
												<font color="#f56954">Nomor PO tidak ditemukan.</font>
											{/if}
											{if $numsBbm > 0 AND $spbNo != ''}
												<font color="#f56954">Nomor PO sudah digunakan.</font>
											{/if}
										</td>
									</tr>
									<tr>
										<td>SUPPLIER</td>
										<td>:</td>
										<td>{if $numsBbm == '0' AND $spbNo != ''}
											<input type="hidden" id="supplierID" name="supplierID" value="{$supplierID}">
											<input type="hidden" id="namaSupplier" name="namaSupplier" value="{$namaSupplier}">
											<input type="hidden" id="alamatSupplier" name="alamatSupplier" value="{$alamatSupplier}">
											<input type="text" id="namaSupplier" name="namaSupplier" value="{$namaSupplier}" class="form-control" placeholder="Supplier" style="width: 270px;" DISABLED>
											{else}
											<input type="text" id="namaSupplier" name="namaSupplier" class="form-control" placeholder="Supplier" style="width: 270px;" DISABLED>
											{/if}
										</td>
									</tr>
									<tr>
										<td>TANGGAL PO</td>
										<td>:</td>
										<td><input type="hidden" id="tanggal" name="tanggal" value="{$tanggal}">
											{if $numsBbm == '0' AND $spbNo != ''}
												<input type="text" id="tanggal" name="tanggal" value="{$tanggal}" class="form-control" placeholder="Tgl Order" style="float: left; width: 135px;" DISABLED></td>
											{else}
												<input type="text" id="tanggal" name="tanggal" class="form-control" placeholder="Tgl Order" style="float: left; width: 135px;" DISABLED></td>
											{/if}
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
											{if $numsBbm == '0' AND $spbNo != ''}
											{section name=dataDetail loop=$dataDetail}
												<tr>

													<td>{$dataDetail[dataDetail].no} <input type="hidden" name="detailID[]" id="detailID" value="{$dataDetail[dataDetail].detailID}"></td>
													<td>{$dataDetail[dataDetail].productName} <input type="hidden" name="productName[]" id="productName" value="{$dataDetail[dataDetail].productName}"> <input type="hidden" name="productID[]" id="productID" value="{$dataDetail[dataDetail].productID}"></td>
													<td style='text-align: center;'>{$dataDetail[dataDetail].price}
													<input type="hidden" name="price[]" id="price" value="{$dataDetail[dataDetail].price}"></td>
													<td style='text-align: center;'>{$dataDetail[dataDetail].qty} 
													<input type="hidden" name="qty[]" id="qty" value="{$dataDetail[dataDetail].qty}"> </td>
													<td style='text-align: center;'>{$dataDetail[dataDetail].subtotal} </td>
													
													<td>
														<input type="text" class="no_detail_brg" name="no_detail_brg[]" value="{$dataDetail[dataDetail].no_detail_brg}" class="form-control" placeholder="No. Detail Barang" style="width: 160px;" required>
													</td>
													<td>
														
														<input type="text" class="tgl_kadaluarsa" name="tgl_kadaluarsa[]" value="{$dataDetail[dataDetail].tgl_kadaluarsa}" class="form-control" placeholder="Tanggal Kadaluarsa" style="width: 160px;" required>
													</td>
													
												</tr>
											{/section}
											{/if}
										</tbody>
									</table>
								</div>
								<br>
								<br>
								{if $numsSpb > 0}
									{if $numsBbm > 0 AND $spbNo != ''}
									{else}

								<table cellpadding="3" cellspacing="3">
											<tr>
												<td width="150">GRANDTOTAL</td>
												<td>:</td>
												<td><input type="hidden" id="total" name="total" value="{$total}">
													<input type="text" id="total" name="total" value="{$total}" class="form-control" style="width: 270px;" DISABLED>
												</td>
											</tr>
										</table>
										<br>


										<button type="submit" class="btn btn-primary">Simpan</button>
									{/if}
								{/if}
								</form>
							
							</div><!-- /.box-body -->
							
						{elseif $module == 'bbm' AND $act == 'finish'}
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
								<h3 class="box-title">Faktur Transaksi Pembelian</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_bbm.php?module=bbm&act=print&bbmID={$bbmID}&nofaktur={$nofaktur}&bbmFaktur={$bbmFaktur}" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="bbm.php"><button class="btn btn-default pull-right">Close</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="150">NO FAKTUR / TGL</td>
										<td width="5">:</td>
										<td><input type="text" id="nofaktur" name="nofaktur" value="{$nofaktur}" class="form-control" placeholder="ID BBM" style="width: 110px; float: left" DISABLED>
											<input type="text" id="tglfaktur" name="tglfaktur" value="{$tglfaktur}" class="form-control" placeholder="Tanggal " style="width: 160px;" DISABLED>
										</td>
									</tr>
									<tr valign="top">
										<td>NO PO</td>
										<td>:</td>
										<td><input type="text" id="spbNo" name="spbNo" value="{$spbNo}" class="form-control" placeholder="Nomor PO" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>SUPPLIER</td>
										<td>:</td>
										<td><input type="text" id="namaSupplier" name="namaSupplier" value="{$namaSupplier}" class="form-control" placeholder="Supplier" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>TGL PO</td>
										<td>:</td>
										<td><input type="text" id="tanggal" name="tanggal" value="{$tanggal}" class="form-control" placeholder="Tgl Order" style="float: left; width: 135px;" DISABLED></td>
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
											{section name=dataBbmDetail loop=$dataBbmDetail}
												<tr>
													<td>{$dataBbmDetail[dataBbmDetail].no}</td>
													<td>{$dataBbmDetail[dataBbmDetail].productName}</td>
													<td style='text-align: center;'>{$dataBbmDetail[dataBbmDetail].price}</td>
													<td style='text-align: center;'>{$dataBbmDetail[dataBbmDetail].qty}</td>
													<td style='text-align: center;'>{$dataBbmDetail[dataBbmDetail].subtotal}</td>
													
													<td>{$dataBbmDetail[dataBbmDetail].no_detail_brg}</td>
													<td>{$dataBbmDetail[dataBbmDetail].tgl_kadaluarsa}</td>
													
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
								<br><br>
							<table cellpadding="3" cellspacing="3">
											<tr>
											<td width="150">GRANDTOTAL</td>
												<td>:</td>
												<td><input type="hidden" id="total" name="total" value="{$total}">
													<input type="text" id="total" name="total" value="{$total}" class="form-control" style="width: 270px;" DISABLED>
												</td>
											</tr>
										</table>
										<br>
							</div><!-- /.box-body -->
							
						{elseif $module == 'bbm' AND $act == 'detailbbm'}
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Faktur Transaksi Pembelian</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_bbm.php?module=bbm&act=print&bbmID={$bbmID}&nofaktur={$nofaktur}&bbmFaktur={$bbmFaktur}" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										{if $q != ''}
											<a href="bbm.php?module=bbm&act=search&q={$q}&page={$page}"><button class="btn btn-default pull-right">Back</button></a>
										{else}
											<a href="bbm.php?page={$page}"><button class="btn btn-default pull-right">Back</button></a>
										{/if}
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="150">NO FAKTUR / TGL</td>
										<td width="5">:</td>
										<td><input type="text" id="nofaktur" name="nofaktur" value="{$nofaktur}" class="form-control" placeholder="ID BBM" style="width: 110px; float: left" DISABLED>
											<input type="text" id="tglfaktur" name="tglfaktur" value="{$tglfaktur}" class="form-control" placeholder="Tanggal " style="width: 160px;" DISABLED>
										</td>
									</tr>
									<tr valign="top">
										<td>NO PO</td>
										<td>:</td>
										<td><input type="text" id="spbNo" name="spbNo" value="{$spbNo}" class="form-control" placeholder="Nomor PO" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>SUPPLIER</td>
										<td>:</td>
										<td><input type="text" id="namaSupplier" name="namaSupplier" value="{$namaSupplier}" class="form-control" placeholder="Supplier" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>TGL PO</td>
										<td>:</td>
										<td><input type="text" id="tanggal" name="tanggal" value="{$tanggal}" class="form-control" placeholder="Tgl Order" style="float: left; width: 135px;" DISABLED></td>
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
											{section name=dataBbmDetail loop=$dataBbmDetail}
												<tr>
													<td>{$dataBbmDetail[dataBbmDetail].no}</td>
													<td>{$dataBbmDetail[dataBbmDetail].productName}</td>
													<td style='text-align: center;'>{$dataBbmDetail[dataBbmDetail].price}</td>
													<td style='text-align: center;'>{$dataBbmDetail[dataBbmDetail].qty}</td>
													<td style='text-align: center;'>{$dataBbmDetail[dataBbmDetail].subtotal}</td>
													<td>{$dataBbmDetail[dataBbmDetail].no_detail_brg}</td>
													<td>{$dataBbmDetail[dataBbmDetail].tgl_kadaluarsa}</td>
													
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
								<br><br>
							<table cellpadding="3" cellspacing="3">
											<tr>
											<td width="150">GRANDTOTAL</td>
												<td>:</td>
												<td><input type="hidden" id="total" name="total" value="{$total}">
													<input type="text" id="total" name="total" value="{$total}" class="form-control" style="width: 270px;" DISABLED>
												</td>
											</tr>
										</table>
										<br>
							</div><!-- /.box-body -->
						
						{elseif $module == 'bbm' AND $act == 'search'}
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="bbm.php">
											<input type="hidden" name="module" value="bbm">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" value="{$endDate}" id="endDate" name="endDate" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" value="{$startDate}" id="startDate" name="startDate" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" id="q" name="q" value="{$q}" class="form-control" placeholder="Pencarian : Nomor Transaksi Pembelian" style="float: right; width: 270px;" required>
										
											<a href="bbm.php?module=bbm&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_bbm.php?act=print&q={$q}&startDate={$startDate}&endDate={$endDate}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
											{section name=dataBbm loop=$dataBbm}
												<tr>
													<td>{$dataBbm[dataBbm].no}</td>
													<td>{$dataBbm[dataBbm].nofaktur}</td>
													<td>{$dataBbm[dataBbm].spbNo}</td>
													<td>{$dataBbm[dataBbm].namaSupplier}</td>
													<td>{$dataBbm[dataBbm].tglfaktur}</td>
												<!--	<td>{$dataBbm[dataBbm].staffName}</td> -->
													<td>
														<a title="Detail" href="bbm.php?module=bbm&act=detailbbm&bbmID={$dataBbm[dataBbm].bbmID}&nofaktur={$dataBbm[dataBbm].nofaktur}&bbmFaktur={$dataBbm[dataBbm].bbmFaktur}&q={$q}&page={$page}"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="bbm.php?module=bbm&act=delete&bbmID={$dataBbm[dataBbm].bbmID}&bbmFaktur={$dataBbm[dataBbm].bbmFaktur}&nofaktur={$dataBbm[dataBbm].nofaktur}" onclick="return confirm('Anda Yakin ingin membatalkan transaksi {$dataBbm[dataBbm].nofaktur}?');"><img src="img/icons/delete.png" width="18"></a>
													</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->	
													
						{else}
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="bbm.php">
											<input type="hidden" name="module" value="bbm">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" value="{$endDate}" id="endDate" name="endDate" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" value="{$startDate}" id="startDate" name="startDate" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" id="q" name="q" value="{$q}" class="form-control" placeholder="Pencarian : No Faktur Pembelian" style="float: right; width: 270px;">
										
											<a href="bbm.php?module=bbm&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_bbm.php?act=print&q={$q}&startDate={$startDate}&endDate={$endDate}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
											{section name=dataBbm loop=$dataBbm}
												<tr>
													<td>{$dataBbm[dataBbm].no}</td>
													<td>{$dataBbm[dataBbm].nofaktur}</td>
													<td>{$dataBbm[dataBbm].spbNo}</td>
													<td>{$dataBbm[dataBbm].namaSupplier}</td>
													<td>{$dataBbm[dataBbm].tglfaktur}</td>
											<!--		<td>{$dataBbm[dataBbm].staffName}</td> -->
													<td>
														<a title="Detail" href="bbm.php?module=bbm&act=detailbbm&bbmID={$dataBbm[dataBbm].bbmID}&nofaktur={$dataBbm[dataBbm].nofaktur}&bbmFaktur={$dataBbm[dataBbm].bbmFaktur}&page={$page}"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="bbm.php?module=bbm&act=delete&bbmID={$dataBbm[dataBbm].bbmID}&bbmFaktur={$dataBbm[dataBbm].bbmFaktur}&nofaktur={$dataBbm[dataBbm].nofaktur}" onclick="return confirm('Anda Yakin ingin membatalkan transaksi {$dataBbm[dataBbm].nofaktur}?');"><img src="img/icons/delete.png" width="18"></a>
													</td>
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