<?php
// include header
include "header.php";
// set the tpl page
$page = "products.tpl";

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
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '5'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
	
	// if module is product and action is delete
	if ($module == 'product' && $act == 'delete')
	{
		// insert method into a variable
		$productID = $_GET['productID'];
		$pic = $_GET['pic'];
		
		// delete product
		$queryProduct = "DELETE FROM barang WHERE productID = '$productID'";
		$sqlProduct = mysqli_query($connect, $queryProduct);
		
		if ($sqlProduct)
		{
			if ($pic != '')
			{
				unlink("img/products/".$pic);
				unlink("img/products/thumb/small_".$pic);
			}
		}
		
		// redirect to the product page
		header("Location: products.php?msg=Data barang berhasil dihapus");
	} // close bracket
	
	////// if the module is barang and act is detailbarang
	elseif ($module == 'barang' && $act == 'detailbarang')
	{
		/////$productID = $_GET['productID'];
		$productCode = $_GET['productCode'];
		$q = mysqli_real_escape_string($connect, $_GET['q']);

		$queryProduct = "SELECT * FROM barang WHERE productCode = '$productCode'";
		$sqlProduct = mysqli_query($connect, $queryProduct);
		$dataProduct = mysqli_fetch_array($sqlProduct);
		
		
		$smarty->assign("productCode", $dataProduct['productCode']);

		// show the barang detail
		$queryBarangDetail = "SELECT * FROM detail_barang WHERE LEFT(productCode,5) = '$productCode' ";
		$sqlBarangDetail = mysqli_query($connect, $queryBarangDetail);
	
		//$month = date("y-m-d", strtotime('-1 month'));
		//$sql = ("SELECT * FROM detail_barang where mep <'".$month . "'");

		$dewa = "SELECT DATEDIFF(mep,now()) as date_difference from detail_barang WHERE LEFT(productCode,5) = '$productCode'";
		$dewa1 = mysqli_query($connect, $dewa);
		
		
		$i = 1;
		while ($dtBarangDetail = mysqli_fetch_array($sqlBarangDetail))
		{
			$dtBarangDetail1 = mysqli_fetch_array($dewa1);
			$dataBarangDetail[] = array('no_detail_brg' => $dtBarangDetail['no_detail_brg'],
										'productCode' => $dtBarangDetail['productCode'],
										'mep' => $dtBarangDetail1['date_difference']."  hari lagi kedaluarsa",
										'qty_brg' => $dtBarangDetail['qty_brg'],
										'no' => $i
										);
			$i++;
		}
		
		$smarty->assign("dataBarangDetail", $dataBarangDetail);
		$smarty->assign("page", $_GET['page']);
		$smarty->assign("q", $_GET['q']);
		
		$smarty->assign("breadcumbTitle", "Detail Barang");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melihat Data Detail Barang");
		$smarty->assign("breadcumbMenuName", "Detail Barang");
		$smarty->assign("breadcumbMenuSubName", "Detail Barang");
	} ///////////////


	// if module is product and action is search
	elseif ($module == 'product' && $act == 'search')
	{

		$q = mysqli_real_escape_string($connect, $_GET['q']);
		
		$queryProduct = "SELECT * FROM barang WHERE productCode LIKE '%$q%' OR productName LIKE '%$q%' ORDER BY productName ASC";
		$sqlProduct = mysqli_query($connect, $queryProduct);
		
		// fetch data
		$i = 1;
		while ($dtProduct = mysqli_fetch_array($sqlProduct))
		{
			if ($dtProduct['unit'] == '1')
			{
				$unit = "PCS";
			}
			elseif ($dtProduct['unit'] == '2')
			{
				$unit = "SACHET";
			}
			elseif ($dtProduct['unit'] == '3')
			{
				$unit = "BOX";
			}
			elseif ($dtProduct['unit'] == '4')
			{
				$unit = "PACK";
			}

			
			// count stock total based on productID
			$queryStock = "SELECT SUM(stock) as stockAmount FROM barang WHERE productID = '$dtProduct[productID]'";
			$sqlStock = mysqli_query($connect, $queryStock);
			$dataStock = mysqli_fetch_array($sqlStock);
			
			$dataProduct[] = array(	'productID' => $dtProduct['productID'],
									'productCode' => $dtProduct['productCode'],
									'productName' => $dtProduct['productName'],
									'categoryID' => $dtProduct['categoryID'],
									'unit' => $unit,
									'harga' => rupiah($dtProduct['harga']),
									'stockAmount' => $dataStock['stockAmount'],
									'stock' => $dtProduct['stock'],
									'no' => $i);
			$i++;
		}

		// assign
		$smarty->assign("dataProduct", $dataProduct);
		$smarty->assign("page", $_GET['page']);
		$smarty->assign("q", $q);
	}
	
	// if module is product and action is delete image
	elseif ($module == 'product' && $act == 'deleteimage')
	{
		$productID = $_GET['productID'];
		$picture = $_GET['picture'];
		
		$queryProduct = "UPDATE barang SET image = '' WHERE productID = '$productID'";
		$sqlProduct = mysqli_query($connect, $queryProduct);
		
		if ($sqlProduct)
		{
			unlink("img/products/".$picture);
			unlink("img/products/thumb/small_".$picture);
		}
		
		// redirect to the product page
		header("Location: products.php?msg=Gambar produk berhasil dihapus");
	}
	
	else
	{
		// get last sort product number
		$queryNoProduct = "SELECT productCode FROM barang ORDER BY productCode DESC LIMIT 1";
		$sqlNoProduct = mysqli_query($connect, $queryNoProduct);
		$numsNoProduct = mysqli_num_rows($sqlNoProduct);
		$dataNoProduct = mysqli_fetch_array($sqlNoProduct);
		
		$start = substr($dataNoProduct['productCode'],0-5);
		$next = $start + 1;
		$tempNo = strlen($next);
		
		if ($numsNoProduct == '0')
		{
			$productNo = "0000";
		}
		elseif ($tempNo == 1)
		{
			$productNo = "0000";
		}
		elseif ($tempNo == 2)
		{
			$productNo = "000";
		}
		elseif ($tempNo == 3)
		{
			$productNo = "00";
		}
		elseif ($tempNo == 4)
		{
			$productNo = "0";
		}
		elseif ($tempNo == 5)
		{
			$productNo = "";
		}
		
		$productCode = $productNo.$next;
		
		$smarty->assign("productCode", $productCode);
		
		// create new object pagination
		$p = new PaginationProduct;
		// limit 20 data for page
		$limit  = 10;
		$position = $p->searchPosition($limit);
		
		// showing up the product data
		$queryProduct = "SELECT * FROM barang ORDER BY productCode ASC LIMIT $position,$limit";
		$sqlProduct = mysqli_query($connect, $queryProduct);
		
		// fetch data
		$i = 1 + $position;
		while ($dtProduct = mysqli_fetch_array($sqlProduct))
		{
			if ($dtProduct['unit'] == '1')
			{
				$unit = "PCS";
			}
			elseif ($dtProduct['unit'] == '2')
			{
				$unit = "SACHET";
			}
			elseif ($dtProduct['unit'] == '3')
			{
				$unit = "BOX";
			}
			elseif ($dtProduct['unit'] == '4')
			{
				$unit = "PACK";
			}

			// count stock total based on productID
			$queryStock = "SELECT SUM(stock) as stockAmount FROM barang WHERE productID = '$dtProduct[productID]'";
			$sqlStock = mysqli_query($connect, $queryStock);
			$dataStock = mysqli_fetch_array($sqlStock);
			
			$dataProduct[] = array(	'productID' => $dtProduct['productID'],
									'productCode' => $dtProduct['productCode'],
									'productName' => $dtProduct['productName'],
									'categoryID' => $dtProduct['categoryID'],
									'unit' => $unit,
									'harga' => rupiah($dtProduct['harga']),
									'stockAmount' => $dataStock['stockAmount'],
									'stock' => $dtProduct['stock'],
									'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataProduct", $dataProduct);
		$smarty->assign("page", $_GET['page']);
		$smarty->assign("q", $q);

		
		// count data
		$queryCountProduct = "SELECT * FROM barang";
		$sqlCountProduct = mysqli_query($connect, $queryCountProduct);
		$amountData = mysqli_num_rows($sqlCountProduct);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		$smarty->assign("page", $_GET['page']);
		
		// showing up the categories data 
		$queryCategory = "SELECT * FROM as_categories WHERE status = 'Y' ORDER BY categoryName ASC";
		$sqlCategory = mysqli_query($connect, $queryCategory);
		
		// fetch data
		while ($dtCategory = mysqli_fetch_array($sqlCategory))
		{
			$dataCategory[] = array('categoryID' => $dtCategory['categoryID'],
									'categoryName' => $dtCategory['categoryName']);
		}
		
		// assign to the tpl
		$smarty->assign("dataCategory", $dataCategory);
		$smarty->assign("dataProduct", $dataProduct);
	}
	
	$smarty->assign("msg", $_GET['msg']);
	$smarty->assign("breadcumbTitle", "Manajemen Barang");
	$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan pengolahan data master barang.");
	$smarty->assign("breadcumbMenuName", "Master Data");
	$smarty->assign("breadcumbMenuSubName", "Barang");

	$smarty->assign("module", $module);
	$smarty->assign("act", $act);
}

// include footer
include "footer.php";
?>