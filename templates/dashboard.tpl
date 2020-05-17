{include file="header.tpl"}
	
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
				<br>
				<section class="col-lg-12 connectedSortable">
				
				<div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>

                                        {$total}
                                    </h3>
                                    <p>
                                       Jumlah Barang
                                    </p>
                                </div>
                                <div class="icon">
                                    <span class="glyphicon glyphicon-tag"></span>
                                </div>
                                <a href="products.php" class="small-box-footer">
                                    Lihat Detail Barang <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                           
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                       {$total1}
                                    </h3>
                                    <p>
                                        PO (Purchase Order)
                                    </p>
                                </div>
                                <div class="icon">
                                    <span class="glyphicon glyphicon-shopping-cart"></span>
                                </div>
                                <a href="spb.php" class="small-box-footer">
                                    Lihat Detail PO <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                           
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                         {$total2} 
                                    </h3>
                                    <p>
                                        Supplier
                                    </p>
                                </div>
                                <div class="icon">
                                    <span class="glyphicon glyphicon-user"></span>
                                </div>
                                <a href="suppliers.php" class="small-box-footer">
                                    Lihat Detail Supplier <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                      
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                       {$total3} 
                                    </h3>
                                    <p>
                                        Barang akan kadaluarsa
                                    </p>
                                </div>
                                <div class="icon">
                                    <span class="glyphicon glyphicon-warning-sign"></span>
                                </div>
                                <a href="report_kadaluarsa.php?module=receive&act=search" class="small-box-footer">
                                    Lihat Detail Barang Kadaluarsa <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->
				</section><!-- /.Left col -->
			</div><!-- /.row (main row) -->
		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->

{include file="footer.tpl"}