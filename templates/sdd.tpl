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
				document.getElementById('namaSupplier').value = myarr[3];
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
				var namaSupplier = $("#namaSupplier").val();
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
							namaSupplier: namaSupplier,
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
						
						{if $module == 'so' AND $act == 'add'}
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
										<td><input type="hidden" id="KD_brg_rusak" name="KD_brg_rusak" value="{$KD_brg_rusak}">
											<input type="text" id="KD_brg_rusak" name="KD_brg_rusak" value="{$KD_brg_rusak}" class="form-control" placeholder="Kode Barang Rusak" style="width: 110px; float: left" DISABLED>
											<input type="text" id="orderDate" name="orderDate" value="{$orderDateIndo}" class="form-control" placeholder="Tanggal" style="width: 160px;" required>
										</td>
									</tr>
									<tr>
										<td colspan="3">
											<br>
											{if $numsDetilSo < 10}
											<a href="#inline" class="modalbox"><button class="btn btn-default pull-left"><i class="fa fa-plus"></i> Add</button></a>
											{/if}
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
												<th>NAMA SUPPLIER</th>
												<th  style="text-align: center;">QTY</th>
												<th  style="text-align: center;">KETERANGAN</th>
												<th style='text-align: center;'>AKSI</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataDetilSo loop=$dataDetilSo}
												<tr>
													<td>{$dataDetilSo[dataDetilSo].no}</td>
													<td>{$dataDetilSo[dataDetilSo].productName}</td>
													<td>{$dataDetilSo[dataDetilSo].no_detail_brg}</td>
													<td>{$dataDetilSo[dataDetilSo].namaSupplier}</td>
													<td style='text-align: center;'>{$dataDetilSo[dataDetilSo].jumlah}</td>
													<td style='text-align: center;'>{$dataDetilSo[dataDetilSo].ket}</td>
													<td style='text-align: center;'>
														
														<a title="Delete" href="so.php?module=so&act=deletedetail&detailID={$dataDetilSo[dataDetilSo].detailID}" onclick="return confirm('Anda Yakin ingin menghapus item produk {$dataDetilSo[dataDetilSo].productName}?');"><img src="img/icons/delete.png" width="18"></a>
													</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
								<br>
								<br>
								{if $numsDetilSo > 0}
									<button type="submit" class="btn btn-primary">Simpan</button>
								{else}
									<button type="button" class="btn btn-primary">Simpan</button>
								{/if}
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
											<input type="hidden" id="KD_brg_rusak" name="KD_brg_rusak" value="{$KD_brg_rusak}">
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
													<td>Supplier</td>
													<td>:</td>
													<td><input type="text" id="namaSupplier" name="namaSupplier" class="form-control" placeholder="Nama Supplier" style="width: 270px;" required DISABLED></td>
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
							
						{elseif $module == 'so' AND $act == 'detailso'}
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Detail Barang Rusak</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										
										{if $q != ''}
											<a href="so.php?module=so&act=search&q={$q}&page={$pageNumber}"><button class="btn btn-default pull-right">Back</button></a>
										{else}
											<a href="so.php?page={$pageNumber}"><button class="btn btn-default pull-right">Back</button></a>
										{/if}
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="220">KODE BARANG RUSAK / TGL</td>
										<td width="5">:</td>
										<td>{$KD_brg_rusak} / {$orderDate}</td>
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
												<th>NAMA SUPPLIER</th>
												<th  style="text-align: center;">QTY</th>
												<th  style="text-align: center;">KETERANGAN</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataDetail loop=$dataDetail}
												<tr>
													<td>{$dataDetail[dataDetail].no}</td>
													<td>{$dataDetail[dataDetail].productName}</td>
													<td>{$dataDetail[dataDetail].no_detail_brg}</td>
													<td>{$dataDetail[dataDetail].namaSupplier}</td>
													<td style="text-align: center;">{$dataDetail[dataDetail].jumlah}</td>
													<td style="text-align: center;">{$dataDetail[dataDetail].ket}</td>
												
												</td>
												</tr>
											{/section}
												
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
							
						{elseif $module == 'so' AND $act == 'finish'}
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
										<td width="220">KODE BARANG RUSAK</td>
										<td width="5">:</td>
										<td>{$KD_brg_rusak}</td>
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
												<th>NAMA SUPPLIER</th>
												<th style="text-align: center;">QTY</th>
												<th style="text-align: center;">KETERANGAN</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataDetail loop=$dataDetail}
												<tr>
													<td>{$dataDetail[dataDetail].no}</td>
													<td>{$dataDetail[dataDetail].productName}</td>
													<td>{$dataDetail[dataDetail].no_detail_brg}</td>
													<td>{$dataDetail[dataDetail].namaSupplier}</td>
													<td style="text-align: center;">{$dataDetail[dataDetail].jumlah}</td>
													<td style="text-align: center;">{$dataDetail[dataDetail].ket}</td>
													</td>
												</tr>
											{/section}
												
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
							
						{elseif $module == 'so' && $act == 'search'}
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="so.php">
											<input type="hidden" name="module" value="so">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											
											<input type="text" id="q" name="q" value="{$q}" class="form-control" placeholder="Pencarian : Kode Barang Rusak" style="float: right; width: 270px;">
										
											<a href="so.php?module=so&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											 <button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
											{section name=dataSo loop=$dataSo}
												<tr>
													<td>{$dataSo[dataSo].no}</td>
													<td>{$dataSo[dataSo].KD_brg_rusak}</td>
													<td style='text-align: center;'>{$dataSo[dataSo].orderDate}</td>
													
													<td style='text-align: center;'>
														<a title="Detail" href="so.php?module=so&act=detailso&soID={$dataSo[dataSo].soID}&soFaktur={$dataSo[dataSo].soFaktur}&q={$q}&page={$page}"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="so.php?module=so&act=delete&soID={$dataSo[dataSo].soID}&soFaktur={$dataSo[dataSo].soFaktur}&soNo={$dataSo[dataSo].KD_brg_rusak}" onclick="return confirm('Anda Yakin ingin menghapus {$dataSo[dataSo].KD_brg_rusak}?');"><img src="img/icons/delete.png" width="18"></a>
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
										<form method="GET" action="so.php">
											<input type="hidden" name="module" value="so">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											
											<input type="text" id="q" name="q" value="{$q}" class="form-control" placeholder="Pencarian : Kode Barang Rusak" style="float: right; width: 270px;">
										
											<a href="so.php?module=so&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											
											<a href="print_brgrusak.php?act=print&q={$q}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
											{section name=dataSo loop=$dataSo}
												<tr>
													<td>{$dataSo[dataSo].no}</td>
													<td>{$dataSo[dataSo].KD_brg_rusak}</td>
													<td style='text-align: center;'>{$dataSo[dataSo].orderDate}</td>
												
													<td style='text-align: center;'>
														<a title="Detail" href="so.php?module=so&act=detailso&soID={$dataSo[dataSo].soID}&soFaktur={$dataSo[dataSo].soFaktur}&page={$page}"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="so.php?module=so&act=delete&soID={$dataSo[dataSo].soID}&soFaktur={$dataSo[dataSo].soFaktur}&soNo={$dataSo[dataSo].KD_brg_rusak}" onclick="return confirm('Anda Yakin ingin menghapus {$dataSo[dataSo].KD_brg_rusak}?');"><img src="img/icons/delete.png" width="18"></a>
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