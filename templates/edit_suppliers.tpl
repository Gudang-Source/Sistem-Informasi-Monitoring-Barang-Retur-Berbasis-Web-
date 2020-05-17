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
			
			$("#supplier").submit(function() { return false; });
	
			$("#send").on("click", function(){
				var supplierID = $("#supplierID").val();
				var namaSupplier = $("#namaSupplier").val();
				var alamat = $("#alamat").val();
				var noTelp = $("#noTelp").val();
				
				
				if (supplierID != '' && namaSupplier != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_edit_supplier.php',
						dataType: 'JSON',
						data:{
							supplierID: supplierID,
							namaSupplier: namaSupplier,
							alamat: alamat,
							noTelp: noTelp
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
				

{if $module == 'supplier' AND $act == 'edit'}
	<table width="95%" align="center">
		<tr>
			<td colspan="3"><h3>Ubah Supplier</h3></td>
		</tr>
		<tr>
			<td>
				<form id="supplier" name="supplier" method="POST" action="edit_suppliers">
				<input type="hidden" id="supplierID" name="supplierID" value="{$supplierID}">
				<table cellpadding="7" cellspacing="7">
					<tr>
						<td width="140">Kode</td>
						<td width="5">:</td>
						<td><input type="text" value="{$kodeSupplier}" id="kodeSupplier" name="kodeSupplier" class="form-control" placeholder="Kode Supplier" style="width: 270px;" DISABLED></td>
					</tr>
					<tr>
						<td>Nama Supplier</td>
						<td>:</td>
						<td><input type="text" value="{$namaSupplier}" id="namaSupplier" name="namaSupplier" class="form-control" placeholder="Nama Supplier" style="width: 270px;" required></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>:</td>
						<td><input type="text" value="{$alamat}" id="alamat" name="alamat" class="form-control" placeholder="Alamat" style="width: 270px;"></td>
					</tr>
					<tr>
						<td>Telepon</td>
						<td>:</td>
						<td><input type="text" value="{$noTelp}" id="noTelp" name="noTelp" class="form-control" placeholder="Telepon" style="width: 270px;"></td>
					</tr>
				</table>
				<button id="send" class="btn btn-primary">Simpan</button>
				</form>
			</td>
		</tr>
	</table>

{/if}
</body>