{include file="header.tpl"}

<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>

<script type="text/javascript" src="design/js/ajaxupload.3.5.js" ></script>
<link rel="stylesheet" type="text/css" href="design/css/Ajaxfile-upload.css" />

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
			
			$(".various3").fancybox({
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
			
			/* Image 
			var btnUpload=$('#me');
			var mestatus=$('#mestatus');
			var files=$('#files');
			new AjaxUpload(btnUpload, {
				action: 'upload_product.php',
				name: 'uploadfile',
				onSubmit: function(file, ext){
					 if (! (ext && /^(jpg|jpeg)$/.test(ext))){ 
	                    // extension is not allowed 
						mestatus.text('Hanya ekstensi .JPG/JPEG yang diijinkan.');
						return false;
					}
					//mestatus.html('<img src="images/ajax-loader.gif" height="16" width="16">');
					mestatus.html('');
				},
				onComplete: function(file, response){
					//On completion clear the status
					mestatus.text('');
					//On completion clear the status
					files.html('');
					//Add uploaded file to list
					if(response!=="error"){
						$('<li></li>').appendTo('#files').html('<img src="img/products/'+response+'" alt="" height="70"/><br />').addClass('success');
						$('<li></li>').appendTo('#photoproduct').html('<input type="hidden" id="image" name="image" value="'+response+'">').addClass('nameupload');
						
					} else{
						$('<li></li>').appendTo('#files').text(file).addClass('error');
					}
				}
			}); */
			
			$(".modalbox").fancybox();
			$(".modalbox2").fancybox();
			
			$("#product").submit(function() { return false; });
			$("#product2").submit(function() { return false; });
			
			$("#send").on("click", function(){
				var productCode = $("#productCode").val();
				var productName = $("#productName").val();
				var categoryID = $("#categoryID").val();
				var unit = $("#unit").val();
				var harga = $("#harga").val();
				var stock = $("#stock").val();
				
				if (productCode != '' && productName != '' && categoryID != '' && unit != '' && harga != '' && stock != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_product.php',
						dataType: 'JSON',
						data:{
							productCode: productCode,
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
							setTimeout("$.fancybox.close()", 1000);
							window.location.href = "products.php?msg=Data berhasil disimpan";
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
						
						<div class="box-header">
							<i class="ion ion-clipboard"></i>
							<h3 class="box-title">Data Barang</h3>
							<div class="box-tools pull-right">
								<div class="box-footer clearfix no-border">
								
									<form method="GET" action="products.php">
										<input type="hidden" name="module" value="product">
										<input type="hidden" name="act" value="search">
										<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
										<input type="text" value="{$q}" id="q" name="q" class="form-control" placeholder="Pencarian : Kode atau Nama Barang" style="float: right; width: 270px;" required>
									
										<a href="#inline" class="modalbox" style="float: left;"><button class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
										<a href="print_products.php?act=print&q={$q}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
										&nbsp;&nbsp;&nbsp;
									</form>
								</div>
							</div>
						</div><!-- /.box-header -->
						
						{if $module == 'product' AND $act == 'search'}
							<div class="box-body">
								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO <i class="fa fa-sort"></i></th>
												<th>KODE - NAMA BARANG <i class="fa fa-sort"></i></th>
												<th>SATUAN <i class="fa fa-sort"></i></th>
												<th>HARGA<i class="fa fa-sort"></i></th>
												<th>STOCK <i class="fa fa-sort"></i></th>
												<th width="80">AKSI</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataProduct loop=$dataProduct}
												<tr>
													<td>{$dataProduct[dataProduct].no}</td>
													<td>{$dataProduct[dataProduct].productName}</td>
													<td align="center">{$dataProduct[dataProduct].unit}</td>
													<td align="right">{$dataProduct[dataProduct].harga}</td>
													<td align="center">{$dataProduct[dataProduct].stockAmount}</td>
													<td>
													    <a title="Detail" href="products.php?module=barang&act=detailbarang&productCode={$dataProduct[dataProduct].productCode}&page={$page}"><img src="img/icons/view.png" width="18"></a>
														<a title="Edit" href="edit_products.php?module=product&act=edit&productID={$dataProduct[dataProduct].productID}" data-width="900" data-height="420" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a>
														<a title="Delete" href="products.php?module=product&act=delete&productID={$dataProduct[dataProduct].productID}&pic={$dataProduct[dataProduct].image}" onclick="return confirm('Anda Yakin ingin menghapus baraang {$dataProduct[dataProduct].productName}?');"><img src="img/icons/delete.png" width="18"></a>
													</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->

						{elseif $module == 'barang' AND $act == 'detailbarang'}
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Detail Barang</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										
										{if $q != ''}
											<a href="products.php?module=products&act=search&q={$q}&page={$page}"><button class="btn btn-default pull-right">Back</button></a>
										{else}
											<a href="products.php?page={$page}"><button class="btn btn-default pull-right">Back</button></a>
										{/if}
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<!-- <table cellpadding="3" cellspacing="3">
									<tr>
										<td width="150">ID / TGL PENERIMAAN</td>
										<td width="5">:</td>
										<td><input type="text" id="bbmNo" name="bbmNo" value="{$bbmNo}" class="form-control" placeholder="ID BBM" style="width: 110px; float: left" DISABLED>
											<input type="text" id="receiveDate" name="receiveDate" value="{$receiveDate}" class="form-control" placeholder="Tanggal Penerimaan" style="width: 160px;" DISABLED>
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
										<td><input type="text" id="supplierName" name="supplierName" value="{$supplierName}" class="form-control" placeholder="Supplier" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>TGL PO/DIBUTUHKAN</td>
										<td>:</td>
										<td><input type="text" id="orderDate" name="orderDate" value="{$orderDate}" class="form-control" placeholder="Tgl Order" style="float: left; width: 135px;" DISABLED><input type="text" id="orderDate" name="needDate" value="{$needDate}" class="form-control" placeholder="Tgl Dibutuhkan" style="width: 135px;" DISABLED></td>
									</tr>
									<tr>
										<td>NOTE</td>
										<td>:</td>
										<td><input type="text" value="{$note}" id="note" name="note" class="form-control" placeholder="Note" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td colspan="3">
											<br>
										</td>
									</tr>
								</table> -->

								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO</th>
												<th>NO DETAIL BARANG</th>
												<th>KODE - NAMA BARANG</th>
												<th style='text-align: center;'>MASA EFEKTIF PAKAI</th>
												<th style='text-align: center;'>JUMLAH</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataBarangDetail loop=$dataBarangDetail}
												<tr>
													<td>{$dataBarangDetail[dataBarangDetail].no}</td>
													<td>{$dataBarangDetail[dataBarangDetail].no_detail_brg}</td>
													<td>{$dataBarangDetail[dataBarangDetail].productCode}</td>
													<td style='text-align: center;'>{$dataBarangDetail[dataBarangDetail].mep}</td>
													<td style='text-align: center;'>{$dataBarangDetail[dataBarangDetail].qty_brg}</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-bodyddddddddddd --> 

						 {else}
						
							<div class="box-body">
								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO <i class="fa fa-sort"></i></th>
												<th>KODE - NAMA BARANG <i class="fa fa-sort"></i></th>
												<th>SATUAN <i class="fa fa-sort"></i></th>
												<th>HARGA<i class="fa fa-sort"></i></th>
												<th>STOCK <i class="fa fa-sort"></i></th>
												<th width="80">AKSI</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataProduct loop=$dataProduct}
												<tr>
													<td>{$dataProduct[dataProduct].no}</td>
													<td>{$dataProduct[dataProduct].productName}</td>
													<td align="center">{$dataProduct[dataProduct].unit}</td>
													<td align="right">{$dataProduct[dataProduct].harga}</td>
													<td align="center">{$dataProduct[dataProduct].stockAmount}</td>
													<td>
													   <a title="Detail" href="products.php?module=barang&act=detailbarang&productCode={$dataProduct[dataProduct].productCode}&page={$page}"><img src="img/icons/view.png" width="18"></a>
														
														<a title="Edit" href="edit_products.php?module=product&act=edit&productID={$dataProduct[dataProduct].productID}" data-width="900" data-height="420" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a>
														<a title="Delete" href="products.php?module=product&act=delete&productID={$dataProduct[dataProduct].productID}&pic={$dataProduct[dataProduct].image}" onclick="return confirm('Anda Yakin ingin menghapus barang {$dataProduct[dataProduct].productName}?');"><img src="img/icons/delete.png" width="18"></a>
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
							
							
							<div id="inline">	
								<table width="95%" align="center">
									<tr>
										<td colspan="3"><h3>Tambah Barang</h3></td>
									</tr>
									<tr>
										<td>
											<form id="product" name="product" method="POST" action="#">
											<table cellpadding="7" cellspacing="7">
												<tr valign="top">
													<td width="130">Kode Barang</td>
													<td width="5">:</td>
													<td>
														<input type="hidden" value="{$productCode}" id="productCode" name="productCode">
														<input type="text" value="{$productCode}" id="productCode" name="productCode" class="form-control" placeholder="Kode Barang" style="width: 270px;" DISABLED>
													</td>
													
												</tr>
												<tr>
													<td>Nama Barang</td>
													<td>:</td>
													<td><input type="text" id="productName" name="productName" class="form-control" placeholder="Nama Barang" style="width: 270px;" required></td>
													
												</tr>
												<tr valign="top">
													<td>Kategori</td>
													<td>:</td>
													<td>
														<select id="categoryID" name="categoryID" class="form-control" style="width: 270px;" required>
															<option value=""></option>
															{section name=dataCategory loop=$dataCategory}
																<option value="{$dataCategory[dataCategory].categoryID}">{$dataCategory[dataCategory].categoryName}</option>
															{/section}
														</select>
													</td>
												</tr>
												<tr valign="top">
													<td>Satuan</td>
													<td>:</td>
													<td>
														<select id="unit" name="unit" class="form-control" style="width: 270px;" required>
															<option value=""></option>
															<option value="1">PCS</option>
															<option value="2">SACHET</option>
															<option value="3">BOX</option>
															<option value="4">PACK</option>
														</select>
													</td>
													
													
												</tr>
												<tr tr valign="top">
													<td width="120">Harga</td>
													<td width="5">:</td>
													<td><input type="number" id="harga" name="harga" class="form-control" placeholder="Harga " style="width: 270px;" required></td>
												</tr>
												<tr tr valign="top">
													<td>Stok</td>
													<td>:</td>
													<td><input type="number" id="stock" name="stock" class="form-control" placeholder="Stok" style="width: 270px;" required></td>
												</tr>
											</table>
											<button id="send" class="btn btn-primary">Simpan</button>
											</form>
										</td>
									</tr>
								</table>
							</div>
						{/if}
					</div><!-- /.box -->
					
				</section><!-- /.Left col -->
			</div><!-- /.row (main row) -->
		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->

{include file="footer.tpl"}