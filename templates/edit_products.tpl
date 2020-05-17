<script src="design/js/jquery-1.8.1.min.js" type="text/javascript"></script>
<link href="design/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="design/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<script src="design/js/bootstrap.min.js" type="text/javascript"></script>
	
<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>



<body style='background-color: #FFF; color: #000;'>
{literal}
	<script>
		$(document).ready(function() {
			
			$("#product").submit(function() { return false; });
			
	
			$("#send").on("click", function(){
				var productID = $("#productID").val();
				var productName = $("#productName").val();
				var categoryID = $("#categoryID").val();
				var unit = $("#unit").val();
				var harga = $("#harga").val();
				var stock = $("#stock").val();
				
				if (productID != '' && productName != '' && categoryID != '' && unit != '' && harga != '' && stock != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_edit_product.php',
						dataType: 'JSON',
						data:{
							productID: productID,
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
							parent.jQuery.fancybox.close();
						}
					});
				}
			});
		});
	</script>	
{/literal}
				

{if $module == 'product' AND $act == 'edit'}
	<table width="45%" align="center">
		<tr>
			<td colspan="3"><h3>Ubah Barang</h3></td>
		</tr>
		<tr>
			<td>
				<form id="product" name="product" method="POST" action="edit_products">
				<input type="hidden" id="productID" name="productID" value="{$productID}">
				<table cellpadding="7" cellspacing="7">
					<tr valign="top">
						<td width="130" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Kode Barang</td>
						<td width="5" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td>
							<input type="hidden" value="{$productCode}" id="productCode" name="productCode">
							<input type="text" value="{$productCode}" id="productCode" name="productCode" class="form-control" placeholder="Kode Barang" style="width: 270px;" DISABLED>
						</td>
						
					</tr>
					<tr>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Nama Barang</td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td><input type="text" value="{$productName}" id="productName" name="productName" class="form-control" placeholder="Nama Barang" style="width: 270px;" required></td>
						
					</tr>
					<tr valign="top">
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Kategori</td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td>
							<select id="categoryID" name="categoryID" class="form-control" style="width: 270px;" required>
								<option value=""></option>
								{section name=dataCategory loop=$dataCategory}
									{if $categoryID == $dataCategory[dataCategory].categoryID}
										<option value="{$dataCategory[dataCategory].categoryID}" SELECTED>{$dataCategory[dataCategory].categoryName}</option>
									{else}
										<option value="{$dataCategory[dataCategory].categoryID}">{$dataCategory[dataCategory].categoryName}</option>
									{/if}
								{/section}
							</select>
						</td>

					</tr>
					<tr valign="top">
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Satuan</td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td>
							<select id="unit" name="unit" class="form-control" style="width: 270px;" required>
								<option value=""></option>
								<option value="1" {if $unit == '1'} SELECTED {/if}>PCS</option>
								<option value="2" {if $unit == '2'} SELECTED {/if}>SACHET</option>
								<option value="3" {if $unit == '3'} SELECTED {/if}>BOX</option>
								<option value="4" {if $unit == '4'} SELECTED {/if}>SACHET</option>
							</select>
						</td>
						
					</tr>
					<tr valign="top">
						<td width="120" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Harga</td>
						<td width="5" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td><input type="number" value="{$harga}" id="harga" name="harga" class="form-control" placeholder="Harga" style="width: 270px;" required></td>
					</tr>
					<tr valign="top">
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Stok</td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td><input type="number" value="{$stock}" id="stock" name="stock" class="form-control" placeholder="Stok" style="width: 270px;" DISABLED></td>
					</tr>
				</table>
				<button id="send" class="btn btn-primary">Simpan</button>
				</form>
			</td>
		</tr>
	</table>

{/if}
</body>