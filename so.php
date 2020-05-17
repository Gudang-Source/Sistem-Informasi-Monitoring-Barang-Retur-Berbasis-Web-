<?php
// include header
include "header.php";
// set the tpl page
$page = "sdd.tpl";

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
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '28'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
		
	// if module is so and action is delete
	if ($module == 'so' && $act == 'delete')
	{
		// insert method into a variable
		$soID = $_GET['soID'];
		$soFaktur = $_GET['soFaktur'];
		$KD_brg_rusak = $_GET['KD_brg_rusak'];
		
		// delete sales order
		$querySo = "DELETE FROM barangrusak WHERE soID = '$soID' AND soFaktur = '$soFaktur'";
		$sqlSo = mysqli_query($connect, $querySo);
		
		// delete sales order detail
		$querySoDetail = "DELETE FROM detail_barangrusak WHERE soFaktur = '$soFaktur'";
		$sqlSoDetail = mysqli_query($connect, $querySoDetail);
		
		// redirect to the sales order page
		header("Location: so.php?msg=Data purchase order berhasil dihapus");
	} // close bracket
	
	// if module is sales order and act is finish
	elseif ($module == 'so' && $act == 'finish')
	{
		$soID = $_GET['soID'];
		$KD_brg_rusak = $_GET['KD_brg_rusak'];
		$soFaktur = $_GET['soFaktur'];
		$orderDate = $_GET['orderDate'];
		
		// showing up the main sales order
		$querySo = "SELECT * FROM detail_barangrusak WHERE KD_brg_rusak = '$KD_brg_rusak'";
		$sqlSo = mysqli_query($connect, $querySo);
		$dataSo = mysqli_fetch_array($sqlSo);
		
		// assign to the tpl
		$smarty->assign("soID", $dataSo['soID']);
		$smarty->assign("no_detail_brg", $dataSo['no_detail_brg']);
		$smarty->assign("namaSupplier", $dataSo['namaSupplier']);
		$smarty->assign("KD_brg_rusak", $dataSo['KD_brg_rusak']);
		$smarty->assign("staffID", $dataSo['staffID']);
		$smarty->assign("staffName", $dataSo['staffName']);
		$smarty->assign("orderDate", tgl_indo2($dataSo['orderDate']));
		$smarty->assign("soFaktur", $soFaktur);
		
		// showing up the detail sales order
		$queryDetail = "SELECT * FROM detail_barangrusak WHERE KD_brg_rusak = '$KD_brg_rusak'";
		$sqlDetail = mysqli_query($connect, $queryDetail);
		
		// fetch data
		$i = 1;
		while ($dtDetail = mysqli_fetch_array($sqlDetail))
		{
			
			
			$dataDetail[] = array(	'detailID' => $dtDetail['detailID'],
									'productID' => $dtDetail['productID'],
									'productName' => $dtDetail['productName'],
									'ket' => $dtDetail['ket'],
									'no_detail_brg' => $dtDetail['no_detail_brg'],
									'namaSupplier' => $dtDetail['namaSupplier'],
									'jumlah' => $dtDetail['jumlah'],
									'no' => $i
									);
			$i++;
		}
		
		// assign to the tpl
		$smarty->assign("grandtotal", rupiah($grandtotal));
		$smarty->assign("dataDetail", $dataDetail);
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Manajemen Barang Rusak");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk mengelola barang rusak.");
		$smarty->assign("breadcumbMenuName", "Barang Rusak");
		$smarty->assign("breadcumbMenuSubName", "Barang Rusak");
		$smarty->assign("pageNumber", $_GET['page']);
	}
	
	// if module is sales order and act is detailso
	elseif ($module == 'so' && $act == 'detailso')
	{
		$soID = $_GET['soID'];
		$soFaktur = $_GET['soFaktur'];
		
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		
		// showing up the main so
		$querySo = "SELECT * FROM barangrusak WHERE soID = '$soID' AND soFaktur = '$soFaktur'";
		$sqlSo = mysqli_query($connect, $querySo);
		$dataSo = mysqli_fetch_array($sqlSo);
		
		// assign to the tpl
		$smarty->assign("soID", $dataSo['soID']);
		$smarty->assign("KD_brg_rusak", $dataSo['KD_brg_rusak']);
		$smarty->assign("staffID", $dataSo['staffID']);
		$smarty->assign("staffName", $dataSo['staffName']);
		$smarty->assign("orderDate", tgl_indo2($dataSo['orderDate']));
		$smarty->assign("soFaktur", $soFaktur);
		
		// showing up the detail so
		$queryDetail = "SELECT * FROM detail_barangrusak WHERE KD_brg_rusak = '$dataSo[KD_brg_rusak]'";
		$sqlDetail = mysqli_query($connect, $queryDetail);
		
		// fetch data
		$i = 1;
		while ($dtDetail = mysqli_fetch_array($sqlDetail))
		{
			
			
			$dataDetail[] = array(	'detailID' => $dtDetail['detailID'],
									'productID' => $dtDetail['productID'],
									'productName' => $dtDetail['productName'],
									'ket' => $dtDetail['ket'],
									'no_detail_brg' => $dtDetail['no_detail_brg'],
									'namaSupplier' => $dtDetail['namaSupplier'],
									'jumlah' => $dtDetail['jumlah'],
									'no' => $i
									);
		
			$i++;
		}
		
		$smarty->assign("q", $q);
		
		// assign to the tpl
		$smarty->assign("grandtotal", rupiah($grandtotal));
		$smarty->assign("dataDetail", $dataDetail);
		$smarty->assign("msg", $_GET['msg']);
	
		$smarty->assign("breadcumbTitle", "Manajemen Barang Rusak");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk mengelola barang rusak.");
		$smarty->assign("breadcumbMenuName", "Barang Rusak");
		$smarty->assign("breadcumbMenuSubName", "Barang Rusak");
		$smarty->assign("pageNumber", $_GET['page']);
	}
	
	//if module is so and act is input
	elseif ($module == 'so' && $act == 'input')
	{
		$soFaktur = $_SESSION['soFaktur'];
		$KD_brg_rusak = $_POST['KD_brg_rusak'];
		$oDate = explode("-", $_POST['orderDate']);
		$orderDate = $oDate[2]."-".$oDate[1]."-".$oDate[0];
		$productname = mysqli_real_escape_string($connect, $_POST['productname']);
		$productname = $_POST['productname'];
		
		// showing up the temp detail sales order
		$queryTempSo = "SELECT * FROM as_temp_detail_so WHERE KD_brg_rusak = '$KD_brg_rusak' AND soFaktur = '$soFaktur'";
		$sqlTempSo = mysqli_query($connect, $queryTempSo);
		// fetch data
		while ($dataSo = mysqli_fetch_array($sqlTempSo))
		{
			$querySaveSo = "INSERT INTO detail_barangrusak (	KD_brg_rusak,
														productID,
														soFaktur,
														productName,
														ket,
														no_detail_brg,
														jumlah,
														namaSupplier)
												VALUES(	'$dataSo[KD_brg_rusak]',
														'$dataSo[productID]',
														'$_SESSION[soFaktur]',
														'$dataSo[productName]',
														'$dataSo[ket]',
														'$dataSo[no_detail_brg]',
														'$dataSo[jumlah]',
														'$dataSo[namaSupplier]')";
			$save = mysqli_query($connect, $querySaveSo);
		}
		
		// delete temp detail sales order
		$queryDelete = "DELETE FROM as_temp_detail_so WHERE KD_brg_rusak = '$KD_brg_rusak'";
		mysqli_query($connect, $queryDelete);
		
		// redirect to the finish page
		header("Location: so.php?module=so&act=finish&KD_brg_rusak=".$KD_brg_rusak."&msg=Data barang rusak berhasil disimpan");
	}
	
	// if module is so and act is deletedetail
	elseif ($module == 'so' && $act == 'deletedetail')
	{
		$detailID = $_GET['detailID'];
		
		// delete data
		$querySo = "DELETE FROM as_temp_detail_so WHERE detailID = '$detailID'";
		$sqlSo = mysqli_query($connect, $querySo);
		
		// redirect to the add add sales order page
		header("Location: so.php?module=so&act=add&msg=Data item berhasil dihapus");
	}
	
	// if module is so and act is cancel
	elseif ($module == 'so' && $act == 'cancel')
	{
		$soFaktur = $_SESSION['soFaktur'];
		
		$queryDetail = "DELETE FROM as_temp_detail_so WHERE soFaktur = '$soFaktur'";
		$sqlDetail = mysqli_query($connect, $queryDetail);
		
		if ($sqlDetail)
		{
			$querySo = "DELETE FROM barangrusak WHERE soFaktur = '$soFaktur'";
			$sqlSo = mysqli_query($connect, $querySo);
		}

		// redirect to the sales order page
		header("Location: so.php?msg=Data sales order berhasil dibatalkan");
	} 
	
	// if module is so and act is add
	elseif ($module == 'so' && $act == 'add')
	{
		$staffID = $_SESSION['staffID'];
		$createdDate = date('Y-m-d H:i:s');
		
		// get last sort sales order number ID
		$queryNoSo = "SELECT KD_brg_rusak FROM detail_barangrusak ORDER BY KD_brg_rusak DESC LIMIT 1";
		$sqlNoSo = mysqli_query($connect, $queryNoSo);
		$numsNoSo = mysqli_num_rows($sqlNoSo);
		$dataNoSo = mysqli_fetch_array($sqlNoSo);
		
		$start = substr($dataNoSo['KD_brg_rusak'],0-5);
		$next = $start + 1;
		$tempNo = strlen($next);
		
		if ($numsNoSo == '0')
		{
			$sNo = "00000";
		}
		elseif ($tempNo == 1)
		{
			$sNo = "00000";
		}
		elseif ($tempNo == 2)
		{
			$sNo = "0000";
		}
		elseif ($tempNo == 3)
		{
			$sNo = "000";
		}
		elseif ($tempNo == 4)
		{
			$sNo = "00";
		}
		elseif ($tempNo == 5)
		{
			$sNo = "0";
		}
		elseif ($tempNo == 6)
		{
			$sNo = "";
		}
		
		$KD_brg_rusak = "BR".$sNo.$next;
		
		$smarty->assign("breadcumbTitle", "Manajemen Barang Rusak");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk menginput barang yang rusak.");
		$smarty->assign("breadcumbMenuName", "Manajemen Barang Rusak");
		$smarty->assign("breadcumbMenuSubName", "Tambah Barang Rusak");
		
		// save into the transfer table
		$date = date('Y-m-d');
		
	
		
		// count so based on soFaktur
		$showSo1 = "SELECT * FROM barangrusak WHERE soFaktur = '$_SESSION[soFaktur]'";
		$sqlSo1 = mysqli_query($connect, $showSo1);
		$numsSo = mysqli_num_rows($sqlSo1);
		
		if ($numsSo == 0)
		{
			$orderDate = date('Y-m-d');
			$sName = $_SESSION['staffCode']." ".$_SESSION['staffName'];
			$querySo = "INSERT INTO barangrusak(	KD_brg_rusak,
													soFaktur,
													staffName,
													orderDate)
											VALUES(	'$KD_brg_rusak',
													'$_SESSION[soFaktur]',
													'$sName',
													'$orderDate')";
			mysqli_query($connect, $querySo);
		}
		

		// showing up the supplier///////////////////////
 		

		// count sales order based on soFaktur
		$showSo = "SELECT * FROM barangrusak WHERE soFaktur = '$_SESSION[soFaktur]'";
		$sqlSo = mysqli_query($connect, $showSo);
		$dataSo = mysqli_fetch_array($sqlSo);
		$numsSo = mysqli_num_rows($sqlSo);
		
	
		
		if ($dataSo['orderDate'] == '0000-00-00')
		{
			$orderDate = tgl_indo2(date('Y-m-d'));
		}
		else
		{
			$orderDate = tgl_indo2($dataSo['orderDate']);
		}
		
		$smarty->assign("KD_brg_rusak", $KD_brg_rusak);
		$smarty->assign("orderDateIndo", $orderDate);
		$smarty->assign("soFaktur", $_SESSION['soFaktur']);

		// query detil sales order
		$queryDetilSo = "SELECT * FROM as_temp_detail_so WHERE soFaktur = '$_SESSION[soFaktur]' AND KD_brg_rusak = '$KD_brg_rusak' ORDER BY detailID ASC";
		$sqlDetilSo = mysqli_query($connect, $queryDetilSo);
		$numsDetilSo = mysqli_num_rows($sqlDetilSo);
		
		// fetch data
		$i = 1;
		while ($dtDetilSo = mysqli_fetch_array($sqlDetilSo))
		{
			
			$dataDetilSo[] = array(	'detailID' => $dtDetilSo['detailID'],
									'productName' => $dtDetilSo['productName'],
									'ket' => $dtDetilSo['ket'],
									'namaSupplier' => $dtDetilSo['namaSupplier'],
									'no_detail_brg' => $dtDetilSo['no_detail_brg'],
									'jumlah' => $dtDetilSo['jumlah'],
									'no' => $i);
			$i++;
		}
		
		// assign to the tpl
		$smarty->assign("dataDetilSo", $dataDetilSo);
		$smarty->assign("numsDetilSo", $numsDetilSo);
	} // close bracket
	
	// if the module is so and act is search
	elseif ($module == 'so' && $act == 'search')
	{
		$_SESSION['soFaktur'] = date('Ymdhis');
		$smarty->assign("soFaktur", $_SESSION['soFaktur']);
		
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		$sDate = mysqli_real_escape_string($connect, $_GET['startDate']);
		$eDate = mysqli_real_escape_string($connect, $_GET['endDate']);
		
		$smarty->assign("startDate", $sDate);
		$smarty->assign("endDate", $eDate);
		
		$s2Date = explode("-", $sDate);
		$e2Date = explode("-", $eDate);
		
		$startDate = $s2Date[2]."-".$s2Date[1]."-".$s2Date[0];
		$endDate = $e2Date[2]."-".$e2Date[1]."-".$e2Date[0];
		
		// showing up the sales order data
		if ($sDate != '' && $eDate != '')
		{
			$querySo = "SELECT * FROM barangrusak WHERE KD_brg_rusak LIKE '%$q%' AND orderDate BETWEEN '$startDate' AND '$endDate' ORDER BY soID DESC";
		}
		else
		{
			$querySo = "SELECT * FROM barangrusak WHERE KD_brg_rusak LIKE '%$q%' ORDER BY soID DESC";
		}
		
		$sqlSo = mysqli_query($connect, $querySo);
		
		// fetch data
		$i = 1 + $position;
		while ($dtSo = mysqli_fetch_array($sqlSo))
		{
			$dataSo[] = array(	'soID' => $dtSo['soID'],
								'KD_brg_rusak' => $dtSo['KD_brg_rusak'],
								'soFaktur' => $dtSo['soFaktur'],
								'staffName' => $dtSo['staffName'],
								'orderDate' => tgl_indo2($dtSo['orderDate']),
								'total' => rupiah($dtSo['total']),
								'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataSo", $dataSo);
		
		$smarty->assign("page", $_GET['page']);
		$smarty->assign("q", $q);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Manajemen Barang Rusak");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk mengelola barang rusak.");
		$smarty->assign("breadcumbMenuName", "Barang Rusak");
		$smarty->assign("breadcumbMenuSubName", "Barang Rusak");
	} 
	
	else
	{
		$_SESSION['soFaktur'] = date('Ymdhis');
		$smarty->assign("soFaktur", $_SESSION['soFaktur']);
		// create new object pagination
		$p = new PaginationSo;
		// limit 20 data for page
		$limit  = 30;
		$position = $p->searchPosition($limit);
		
		// showing up the sales order data
		$querySo = "SELECT * FROM barangrusak ORDER BY soID DESC LIMIT $position,$limit";
		$sqlSo = mysqli_query($connect, $querySo);
		
		// fetch data
		$i = 1 + $position;
		while ($dtSo = mysqli_fetch_array($sqlSo))
		{
			$dataSo[] = array(	'soID' => $dtSo['soID'],
								'KD_brg_rusak' => $dtSo['KD_brg_rusak'],
								'soFaktur' => $dtSo['soFaktur'],
								'staffName' => $dtSo['staffName'],
								'orderDate' => tgl_indo2($dtSo['orderDate']),
								'total' => rupiah($dtSo['total']),
								'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataSo", $dataSo);
		
		// count data
		$queryCountSo = "SELECT * FROM barangrusak";
		$sqlCountSo = mysqli_query($connect, $queryCountSo);
		$amountData = mysqli_num_rows($sqlCountSo);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		$smarty->assign("page", $_GET['page']);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Manajemen Barang Rusak");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk mengelola barang rusak.");
		$smarty->assign("breadcumbMenuName", "Barang Rusak");
		$smarty->assign("breadcumbMenuSubName", "Barang Rusak");
	}
	
	$smarty->assign("module", $module);
	$smarty->assign("act", $act);
}

// include footer
include "footer.php";
?>