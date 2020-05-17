{include file="header.tpl"}
<script src="jquery.js"></script>
<script>
    $(document).ready(function()
                     {
        $("#fetchval").on('change',function()
                         {
            var keyword = $(this).val();
            $.ajax(
            {
                url:'dewa.php',
                type:'POST',
                data:'request='+keyword,
                
                beforeSend:function()
                {
                    $("#table-container").html('Working...');
                    
                },
                success:function(data)
                {
                    $("#table-container").html(data);
                },
            });
        });
    });
    
</script>




<style>
	div.ui-datepicker{
		font-size:14px;
	}
</style>

{literal}
	<script>
		$(document).ready(function() {
			
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
						
						{if $module == 'receive' && $act == 'search'}
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="report_kadaluarsa.php">
											<input type="hidden" name="module" value="receive">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											
											
										
	<select id="fetchval" name="fetchby" class="form-control" style="float: right; width: 270px; margin-right: 5px;">
	<?php
		$conn = mysqli_connect('localhost','root','','dbinventory');
		$sekarang= date('Y-m-d');
		$min1bulan= date('Y-m-d', strtotime("-1 months",strtotime($sekarang)));

		$sql = ("SELECT * FROM detail_barang where mep -'".$min1bulan . "'");
		$dewa1 = mysqli_query($conn, $sql);

	'<option value="2" selected></option>'
    '<option value="2"></option>'
    '<option value="2">Semua</option>'
    '<option value="1">1 Bulan Sebelum Kadaluarsa</option>'
 	if (value='180') {
			$request= echo $sql;
		}
    ?>
	</select>
	
	<br>



											<a href="print_report_kadaluarsa.php?act=print&startDate={$startDate}&endDate={$endDate}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
											&nbsp;
										</form>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								
								<div class="table-responsive" id="table-container">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO <i class="fa fa-sort"></i></th>
												<th>NOMOR DETAIL BARANG<i class="fa fa-sort"></i></th>
												<th>KODE - NAMA BARANG <i class="fa fa-sort"></i></th>
												<th>NAMA SUPPLIER <i class="fa fa-sort"></i></th>
												<th style="text-align: center">TANGGAL KADALUARSA <i class="fa fa-sort"></i></th>
												<th style="text-align: center">QTY <i class="fa fa-sort"></i></th>

											</tr>
										</thead>
										<tbody>
											{section name=dataReceived loop=$dataReceived}
												<tr>
													<td>{$dataReceived[dataReceived].no}</td>
													<td>{$dataReceived[dataReceived].no_detail_brg}</td>
													<td>{$dataReceived[dataReceived].productCode}</td>
													<td>{$dataReceived[dataReceived].namaSupplier}</td>
													<td style="text-align: center">{$dataReceived[dataReceived].mep}</td>
													<td style="text-align: center">{$dataReceived[dataReceived].qty_brg}</td>
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
										<form method="GET" action="report_kadaluarsa.php">
											<input type="hidden" name="module" value="receive">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" id="endDate" name="endDate" value="{$endDate}" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px; margin-right: 5px;">
											<input type="text" id="startDate" name="startDate" value="{$startDate}" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px; margin-right: 5px;">
											<select id="customerID" name="customerID" class="form-control" style="float: right; width: 270px; margin-right: 5px;">
												<option value=""></option>
												{section name=dataCustomer loop=$dataCustomer}
													<option value="{$dataCustomer[dataCustomer].customerID}">{$dataCustomer[dataCustomer].customerName} [ Kode : {$dataCustomer[dataCustomer].customerCode} ]</option>
												{/section}
											</select>
											<a href="print_report_receives.php?act=print&customerID={$customerID}&startDate={$startDate}&endDate={$endDate}"  target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
											&nbsp;
										</form>
									</div>
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