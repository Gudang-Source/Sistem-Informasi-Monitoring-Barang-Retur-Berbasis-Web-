{include file="header.tpl"}

<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>

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
			
			$(".modalbox").fancybox();
			$(".modalbox2").fancybox();
			
			$("#divisi").submit(function() { return false; });
			$("#divisi2").submit(function() { return false; });
					
			$("#send").on("click", function(){
				var kodeDivisi = $("#kodeDivisi").val();
				var namaDivisi = $("#namaDivisi").val();
				var noTelp = $("#noTelp").val();
				
				if (kodeDivisi != '' && namaDivisi != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_divisi.php',
						dataType: 'JSON',
						data:{
							kodeDivisi: kodeDivisi,
							namaDivisi: namaDivisi,
							noTelp: noTelp
						},
						beforeSend: function (data) {
							$('#send').hide();
						},
						success: function(data) {
							setTimeout("$.fancybox.close()", 1000);
							window.location.href = "divisi.php?msg=Data berhasil disimpan";
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
							<h3 class="box-title">Data Divisi</h3>
							<div class="box-tools pull-right">
								<div class="box-footer clearfix no-border">
								
									<form method="GET" action="divisi.php">
										<input type="hidden" name="module" value="divisi">
										<input type="hidden" name="act" value="search">
										<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
										<input type="text" value="{$q}" id="q" name="q" class="form-control" placeholder="Pencarian : Kode atau Nama Divisi" style="float: right; width: 275px;" required>
									
										<a href="#inline" class="modalbox" style="float: left;"><button class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
										<a href="print_divisi.php?act=print&q={$q}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
										&nbsp;&nbsp;&nbsp;
									</form>
								</div>
							</div>
						</div><!-- /.box-header -->
						
						{if $module == 'divisi' AND $act == 'search'}
						
							<div class="box-body">
								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO <i class="fa fa-sort"></i></th>
												<th>KODE DIVISI <i class="fa fa-sort"></i></th>
												<th>NAMA DIVISI <i class="fa fa-sort"></i></th>
												<th>TLP <i class="fa fa-sort"></i></th>
												<th width="60">AKSI</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataDivisi loop=$dataDivisi}
												<tr>
													<td>{$dataDivisi[dataDivisi].no}</td>
													<td>{$dataDivisi[dataDivisi].kodeDivisi}</td>
													<td>{$dataDivisi[dataDivisi].namaDivisi}</td>
													<td>{$dataDivisi[dataDivisi].noTelp}</td>
													<td>
														<a title="Edit" href="edit_divisi.php?module=divisi&act=edit&divisiID={$dataDivisi[dataDivisi].divisiID}" data-width="450" data-height="180" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a>
														<a title="Delete" href="divisi.php?module=divisi&act=delete&divisiID={$dataDivisi[dataDivisi].divisiID}&page={$page}" onclick="return confirm('Anda Yakin ingin menghapus divisi {$dataDivisi[dataDivisi].namaDivisi}?');"><img src="img/icons/delete.png" width="18"></a>
													</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
						
						{else}
						
							<div class="box-body">
							
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO <i class="fa fa-sort"></i></th>
												<th>KODE DIVISI <i class="fa fa-sort"></i></th>
												<th>NAMA DIVISI <i class="fa fa-sort"></i></th>
												<th>TLP <i class="fa fa-sort"></i></th>
												<th width="60">AKSI</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataDivisi loop=$dataDivisi}
												<tr>
													<td>{$dataDivisi[dataDivisi].no}</td>
													<td>{$dataDivisi[dataDivisi].kodeDivisi}</td>
													<td>{$dataDivisi[dataDivisi].namaDivisi}</td>
													<td>{$dataDivisi[dataDivisi].noTelp}</td>
													<td>
														<a title="Edit" href="edit_divisi.php?module=divisi&act=edit&divisiID={$dataDivisi[dataDivisi].divisiID}" data-width="450" data-height="180" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a>
														<a title="Delete" href="divisi.php?module=divisi&act=delete&divisiID={$dataDivisi[dataDivisi].divisiID}&page={$page}" onclick="return confirm('Anda Yakin ingin menghapus divisi {$dataDivisi[dataDivisi].namaDivisi}?');"><img src="img/icons/delete.png" width="18"></a>
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
										<td colspan="3"><h3>Tambah Divisi</h3></td>
									</tr>
									<tr>
										<td>
											<form id="divisi" name="divisi" method="POST" action="#">
											<table cellpadding="7" cellspacing="7">
												<tr>
													<td width="140">Kode Divisi</td>
													<td width="5">:</td>
													<td>
													
														<input type="text" id="kodeDivisi" name="kodeDivisi" class="form-control" placeholder="Kode Divisi" style="width: 270px;" required>
													</td>
												</tr>
												<tr>
													<td>Nama Divisi</td>
													<td>:</td>
													<td><input type="text" id="namaDivisi" name="namaDivisi" class="form-control" placeholder="Nama Divisi" style="width: 270px;" required></td>
												</tr>
												<tr>
													<td>Telepon</td>
													<td>:</td>
													<td><input type="text" id="noTelp" name="noTelp" class="form-control" placeholder="Telepon" style="width: 270px;"></td>
												</tr>
											</table>
											<br>
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