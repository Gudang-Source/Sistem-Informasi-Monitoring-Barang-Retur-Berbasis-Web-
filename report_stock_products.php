<?php
// include header
include "header.php";
// set the tpl page
$page = "report_stock_products.tpl";

$module = $_GET['module'];
$act = $_GET['act'];

// if session is null, showing up the text and exit
if ($_SESSION['staffID'] == '' && $_SESSION['email'] == '')
{
	// show up the text and exit
	echo "Anda tidak berhak akses modul ini.";
	exit();
}

else 
{
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '17'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
	
	// if the module is stock product and act is search
	if ($module == 'stockproduct' && $act == 'search')
	{
		$categoryID = $_GET['categoryID'];
		
		$smarty->assign("categoryID", $categoryID);
		
		$qCat = "SELECT categoryName FROM as_categories WHERE categoryID = '$categoryID'";
		$sCat = mysqli_query($connect, $qCat);
		$dCat = mysqli_fetch_array($sCat);
		
		if ($categoryID != '')
		{
			$smarty->assign("categoryName", $dCat['categoryName']);
		}
		else
		{
			$smarty->assign("categoryName", 'Semua Kategori');
		}
		
		
		// show the category data
		$queryCategory = "SELECT * FROM as_categories WHERE status = 'Y' ORDER BY categoryName ASC";
		$sqlCategory = mysqli_query($connect, $queryCategory);
		
		while ($dtCategory = mysqli_fetch_array($sqlCategory))
		{
			$dataCategory[] = array('categoryID' => $dtCategory['categoryID'],
									'categoryName' => $dtCategory['categoryName']);
		}
		
		$smarty->assign("dataCategory", $dataCategory);
		
		// create new object pagination
		$p = new PaginationStockProduct;
		// limit 20 data for page
		$limit  = 30;
		$position = $p->searchPosition($limit);
		
		
		// showing up the receivable data
		if ($categoryID != '')
		{
			$queryStock = "SELECT * FROM barang WHERE categoryID = '$categoryID' ORDER BY productCode ASC LIMIT $position,$limit";
		}
		else
		{
			$queryStock = "SELECT * FROM barang ORDER BY productCode ASC LIMIT $position,$limit";
		}
		
		$sqlStock = mysqli_query($connect, $queryStock);
		
		// fetch data
		$i = 1 + $position;
		while ($dtStock = mysqli_fetch_array($sqlStock))
		{
			$dataFactory = array();
			$total = array();
			$queryFactory = "SELECT * FROM as_factories WHERE status = 'Y' ORDER BY factoryID ASC";
			$sqlFactory = mysqli_query($connect, $queryFactory);
			while ($dtFactory = mysqli_fetch_array($sqlFactory))
			{
				$querySP = "SELECT SUM(stock) as total, stock FROM as_stock_products WHERE productID = '$dtStock[productID]' AND factoryID = '$dtFactory[factoryID]'";
				$sqlSP = mysqli_query($connect, $querySP);
				$dtSP = mysqli_fetch_array($sqlSP);
				
				$total[] = $dtSP['total'];
				
				$dataFactory[] = array(	'factoryID' => $dtFactory['factoryID'],
										'factoryName' => $dtFactory['factoryName'],
										'stock' => $dtSP['stock']
										);
			}
			
			if ($dtStock['unit'] == '1')
			{
				$unit = "PCS";
			}
			elseif ($dtStock['unit'] == '2')
			{
				$unit = "SACHET";
			}
			elseif ($dtStock['unit'] == '3')
			{
				$unit = "BOX";
			}elseif ($dtStock['unit'] == '4')
			{
				$unit = "PACK";
			}
			$dataStock[] = array(	'productID' => $dtStock['productID'],
									'productName' => $dtStock['productCode']." ".$dtStock['productName'],
									'unit' => $unit,
									'total' => $dtStock['stock'],
									'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataStock", $dataStock);
		
		// count data
		if ($categoryID != '')
		{
			$queryCountSP = "SELECT * FROM as_products WHERE categoryID = '$categoryID'";
		}
		else
		{
			$queryCountSP = "SELECT * FROM as_products";
		}
		
		$sqlCountSP = mysqli_query($connect, $queryCountSP);
		$amountData = mysqli_num_rows($sqlCountSP);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		$smarty->assign("page", $_GET['page']);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Laporan Stok Produk");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melihat laporan stok produk.");
		$smarty->assign("breadcumbMenuName", "Laporan");
		$smarty->assign("breadcumbMenuSubName", "Stok Produk");
	} 
	
	else
	{
		// show the category data
		$queryCategory = "SELECT * FROM as_categories WHERE status = 'Y' ORDER BY categoryName ASC";
		$sqlCategory = mysqli_query($connect, $queryCategory);
		
		while ($dtCategory = mysqli_fetch_array($sqlCategory))
		{
			$dataCategory[] = array('categoryID' => $dtCategory['categoryID'],
									'categoryName' => $dtCategory['categoryName']);
		}
		
		$smarty->assign("dataCategory", $dataCategory);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Laporan Stok Produk");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melihat laporan stok produk.");
		$smarty->assign("breadcumbMenuName", "Laporan");
		$smarty->assign("breadcumbMenuSubName", "Stok Produk");
	}
	
	$smarty->assign("module", $module);
	$smarty->assign("act", $act);
}

// include footer
include "footer.php";
?>