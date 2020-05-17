<script src="design/js/jquery-1.8.1.min.js" type="text/javascript"></script>
<link href="design/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="design/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<script src="design/js/bootstrap.min.js" type="text/javascript"></script>
	
<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>

<body style='background-color: #EEEEEE; color: #000;'>
{literal}
	<script>
		$(document).ready(function() {
			
			$("#divisi").submit(function() { return false; });
	
			$("#send").on("click", function(){
				var divisiID = $("#divisiID").val();
				var kodeDivisi = $("#kodeDivisi").val();
				var namaDivisi = $("#namaDivisi").val();
				var noTelp = $("#noTelp").val();
			
				
				if (divisiID != '' && namaDivisi != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_edit_divisi.php',
						dataType: 'JSON',
						data:{
							divisiID: divisiID,
							kodeDivisi: kodeDivisi,
							namaDivisi: namaDivisi,
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
				

{if $module == 'divisi' AND $act == 'edit'}
	<table width="95%" align="center">
		<tr>
			<td colspan="3"><h3>Ubah Divisi</h3></td>
		</tr>
		<tr>
			<td>
				<form id="divisi" name="divisi" method="POST" action="edit_divisi">
				<input type="hidden" id="divisiID" name="divisiID" value="{$divisiID}">
				<table cellpadding="7" cellspacing="7">
					<tr>
						<td width="140">Kode Divisi</td>
						<td width="5">:</td>
						<td><input type="text" value="{$kodeDivisi}" id="kodeDivisi" name="kodeDivisi" class="form-control" placeholder="Kode Divisi" style="width: 270px;"></td>
					</tr>
					<tr>
						<td>Nama Divisi</td>
						<td>:</td>
						<td><input type="text" value="{$namaDivisi}" id="namaDivisi" name="namaDivisi" class="form-control" placeholder="Nama Divisi" style="width: 270px;" required></td>
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