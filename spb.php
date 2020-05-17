<?php
// include header
include "header.php";
// set the tpl page
$page = "spb.tpl";

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
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '14'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
		
	// if module is spb and action is delete
	if ($module == 'spb' && $act == 'delete')
	{
		// insert method into a variable
		$spbID = $_GET['spbID'];
		$spbFaktur = $_GET['spbFaktur'];
		$spbNo = $_GET['spbNo'];
		
		// delete spb
		$querySpb = "DELETE FROM purchaseorder WHERE spbID = '$spbID' AND spbFaktur = '$spbFaktur'";
		$sqlSpb = mysqli_query($connect, $querySpb);
		
		// delete spb detail
		$querySpbDetail = "DELETE FROM detail_po WHERE spbNo = '$spbNo' AND spbFaktur = '$spbFaktur'";
		$sqlSpbDetail = mysqli_query($connect, $querySpbDetail);
		
		// redirect to the spb page
		header("Location: spb.php?msg=Data purchase order berhasil dihapus");
	} // close bracket
	
	// if module is spb and act is detailspb
	elseif ($module == 'spb' && $act == 'finish')
	{
		$spbNo = $_GET['spbNo'];
		$spbFaktur = $_GET['spbFaktur'];
		
		// showing up the main spb
		$querySpb = "SELECT * FROM purchaseorder WHERE spbNo = '$spbNo' AND spbFaktur = '$spbFaktur'";
		$sqlSpb = mysqli_query($connect, $querySpb);
		$dataSpb = mysqli_fetch_array($sqlSpb);
		
		// assign to the tpl
		$smarty->assign("spbID", $dataSpb['spbID']);
		$smarty->assign("spbNo", $dataSpb['spbNo']);
		$smarty->assign("supplierID", $dataSpb['supplierID']);
		$smarty->assign("namaSupplier", $dataSpb['namaSupplier']);
		$smarty->assign("staffID", $dataSpb['staffID']);
		$smarty->assign("staffName", $dataSpb['staffName']);
		$smarty->assign("tanggal", tgl_indo2($dataSpb['tanggal']));
		$smarty->assign("spbFaktur", $spbFaktur);
		
		// showing up the detail spb
		$queryDetail = "SELECT * FROM detail_po WHERE spbNo = '$spbNo' AND spbFaktur = '$spbFaktur'";
		$sqlDetail = mysqli_query($connect, $queryDetail);
		
		// fetch data
		$i = 1;
		while ($dtDetail = mysqli_fetch_array($sqlDetail))
		{
			$subtotal = $dtDetail['qty'] * $dtDetail['price'];
			
			$dataDetail[] = array(	'detailID' => $dtDetail['detailID'],
									'productID' => $dtDetail['productID'],
									'productName' => $dtDetail['productName'],
									'price' => rupiah($dtDetail['price']),
									'subtotal' => rupiah($subtotal),
									'qty' => $dtDetail['qty'],
									'no' => $i
									);
			$grandtotal += $subtotal;
			$i++;
		}
		
		// assign to the tpl
		$smarty->assign("grandtotal", rupiah($grandtotal));
		$smarty->assign("dataDetail", $dataDetail);
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Purchase Order");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi purchase order.");
		$smarty->assign("breadcumbMenuName", "Purchase Order");
		$smarty->assign("breadcumbMenuSubName", "Detail Purchase Order");
		$smarty->assign("pageNumber", $_GET['page']);
	}
	
	// if module is spb and act is detailspb
	elseif ($module == 'spb' && $act == 'detailtrf')
	{
		$spbID = $_GET['spbID'];
		$spbFaktur = $_GET['spbFaktur'];
		
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		
		// showing up the main spb
		$querySpb = "SELECT * FROM purchaseorder WHERE spbID = '$spbID' AND spbFaktur = '$spbFaktur'";
		$sqlSpb = mysqli_query($connect, $querySpb);
		$dataSpb = mysqli_fetch_array($sqlSpb);
		
		// assign to the tpl
		$smarty->assign("spbID", $dataSpb['spbID']);
		$smarty->assign("spbNo", $dataSpb['spbNo']);
		$smarty->assign("supplierID", $dataSpb['supplierID']);
		$smarty->assign("namaSupplier", $dataSpb['namaSupplier']);
		$smarty->assign("staffID", $dataSpb['staffID']);
		$smarty->assign("staffName", $dataSpb['staffName']);
		$smarty->assign("tanggal", tgl_indo2($dataSpb['tanggal']));
		$smarty->assign("spbFaktur", $spbFaktur);
		
		// showing up the detail spb
		$queryDetail = "SELECT * FROM detail_po WHERE spbNo = '$dataSpb[spbNo]' AND spbFaktur = '$spbFaktur'";
		$sqlDetail = mysqli_query($connect, $queryDetail);
		
		// fetch data
		$i = 1;
		while ($dtDetail = mysqli_fetch_array($sqlDetail))
		{
			$subtotal = $dtDetail['qty'] * $dtDetail['price'];
			
			$dataDetail[] = array(	'detailID' => $dtDetail['detailID'],
									'productID' => $dtDetail['productID'],
									'productName' => $dtDetail['productName'],
									'price' => rupiah($dtDetail['price']),
									'subtotal' => rupiah($subtotal),
									'qty' => $dtDetail['qty'],
									'no' => $i
									);
			$grandtotal += ($subtotal);
			$i++;
		}
		
		$smarty->assign("q", $q);
		
		// assign to the tpl
		$smarty->assign("grandtotal", rupiah($grandtotal));
		$smarty->assign("dataDetail", $dataDetail);
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Purchase Order");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi purchase order.");
		$smarty->assign("breadcumbMenuName", "Purchase Order");
		$smarty->assign("breadcumbMenuSubName", "Detail Purchase Order");
		$smarty->assign("pageNumber", $_GET['page']);
	}
	
	//if module is spb and act is input
	elseif ($module == 'spb' && $act == 'input')
	{
		$spbFaktur = $_SESSION['spbFaktur'];
		$spbNo = $_POST['spbNo'];
		$note = mysqli_real_escape_string($connect, $_POST['note']);
		$nDate = explode("-", $_POST['needDate']);
		$oDate = explode("-", $_POST['tanggal']);
		$tanggal = $oDate[2]."-".$oDate[1]."-".$oDate[0];
		
		// update spb
		$querySpb = "UPDATE purchaseorder SET note = '$note' WHERE spbFaktur = '$spbFaktur' AND spbNo = '$spbNo'";
		mysqli_query($connect, $querySpb);
		
		// showing up the temp detail spb
		$queryTempSpb = "SELECT * FROM as_temp_detail_spb WHERE spbNo = '$spbNo' AND spbFaktur = '$spbFaktur'";
		$sqlTempSpb = mysqli_query($connect, $queryTempSpb);
		// fetch data
		while ($dataSpb = mysqli_fetch_array($sqlTempSpb))
		{
			$querySaveSpb = "INSERT INTO detail_po (	spbNo,
															spbFaktur,
															productID,
															productName,
															price,
															qty)
													VALUES(	'$dataSpb[spbNo]',
															'$dataSpb[spbFaktur]',
															'$dataSpb[productID]',
															'$dataSpb[productName]',
															'$dataSpb[price]',
															'$dataSpb[qty]')";
			$save = mysqli_query($connect, $querySaveSpb);
		}
		
		// delete temp detail spb
		$queryDelete = "DELETE FROM as_temp_detail_spb WHERE spbNo = '$spbNo' AND spbFaktur = '$spbFaktur'";
		mysqli_query($connect, $queryDelete);
		
		// redirect to the spb page
		header("Location: spb.php?module=spb&act=finish&spbNo=".$spbNo."&spbFaktur=".$spbFaktur."&msg=Data purchase order berhasil disimpan");
	}
	
	// if module is spb and act is deletedetail
	elseif ($module == 'spb' && $act == 'deletedetail')
	{
		$detailID = $_GET['detailID'];
		
		// delete data
		$querySpb = "DELETE FROM as_temp_detail_spb WHERE detailID = '$detailID'";
		$sqlSpb = mysqli_query($connect, $querySpb);
		
		// redirect to the add transfer page
		header("Location: spb.php?module=spb&act=add&msg=Data item berhasil dihapus");
	}
	
	// if module is spb and act is cancel
	elseif ($module == 'spb' && $act == 'cancel')
	{
		$spbFaktur = $_SESSION['spbFaktur'];
		
		$queryDetail = "DELETE FROM as_temp_detail_spb WHERE spbFaktur = '$spbFaktur'";
		$sqlDetail = mysqli_query($connect, $queryDetail);
		
		if ($sqlDetail)
		{
			$querySpb = "DELETE FROM purchaseorder WHERE spbFaktur = '$spbFaktur'";
			$sqlSpb = mysqli_query($connect, $querySpb);
		}

		// redirect to the spb page
		header("Location: spb.php?msg=Data purchase order berhasil dibatalkan");
	} 
	
	// if module is spb and act is add
	elseif ($module == 'spb' && $act == 'add')
	{
		$staffID = $_SESSION['staffID'];
		$createdDate = date('Y-m-d H:i:s');
		
		// get last sort spb number ID
		$queryNoSpb = "SELECT spbNo FROM detail_po ORDER BY spbNo DESC LIMIT 1";
		$sqlNoSpb = mysqli_query($connect, $queryNoSpb);
		$numsNoSpb = mysqli_num_rows($sqlNoSpb);
		$dataNoSpb = mysqli_fetch_array($sqlNoSpb);
		
		$start = substr($dataNoSpb['spbNo'],0-5);
		$next = $start + 1;
		$tempNo = strlen($next);
		
		if ($numsNoSpb == '0')
		{
			$spbNo = "00000";
		}
		elseif ($tempNo == 1)
		{
			$spbNo = "00000";
		}
		elseif ($tempNo == 2)
		{
			$spbNo = "0000";
		}
		elseif ($tempNo == 3)
		{
			$spbNo = "000";
		}
		elseif ($tempNo == 4)
		{
			$spbNo = "00";
		}
		elseif ($tempNo == 5)
		{
			$spbNo = "0";
		}
		elseif ($tempNo == 6)
		{
			$spbNo = "";
		}
		
		$spbCode = "PO".$spbNo.$next;
		
		$smarty->assign("breadcumbTitle", "Purchase Order");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi purchase order.");
		$smarty->assign("breadcumbMenuName", "Purchase Order");
		$smarty->assign("breadcumbMenuSubName", "Tambah Transaksi Purchase Order");
		
		// save into the transfer table
		$date = date('Y-m-d');
		
		// showing up the supplier
		$querySupplier = "SELECT * FROM supplier ORDER BY namaSupplier ASC";
		$sqlSupplier = mysqli_query($connect, $querySupplier);
		while ($dtSupplier = mysqli_fetch_array($sqlSupplier))
		{
			$dataSupplier[] = array('supplierID' => $dtSupplier['supplierID'],
									'kodeSupplier' => $dtSupplier['kodeSupplier'],
									'namaSupplier' => $dtSupplier['namaSupplier']);
		}
		
		$smarty->assign("dataSupplier", $dataSupplier);
		
		// count spb based on spbFaktur
		$showSpb1 = "SELECT * FROM purchaseorder WHERE spbFaktur = '$_SESSION[spbFaktur]'";
		$sqlSpb1 = mysqli_query($connect, $showSpb1);
		$numsSpb = mysqli_num_rows($sqlSpb1);
		
		if ($numsSpb == 0)
		{
			$tanggal = date('Y-m-d');
			$sName = $_SESSION['staffCode']." ".$_SESSION['staffName'];
			$querySpb = "INSERT INTO purchaseorder(spbNo,
											spbFaktur,
											supplierID,
											namaSupplier,
											staffID,
											staffName,
											tanggal)
									VALUES(	'$spbCode',
											'$_SESSION[spbFaktur]',
											'',
											'',
											'$_SESSION[staffID]',
											'$sName',
											'$tanggal')";
			mysqli_query($connect, $querySpb);
		}
		
		// count spb based on spbFaktur
		$showSpb = "SELECT * FROM purchaseorder WHERE spbFaktur = '$_SESSION[spbFaktur]'";
		$sqlSpb = mysqli_query($connect, $showSpb);
		$dataSpb = mysqli_fetch_array($sqlSpb);
		$numsSpb = mysqli_num_rows($sqlSpb);
		
		$smarty->assign("supplierID", $dataSpb['supplierID']);
		
		if ($dataSpb['needDate'] == '0000-00-00')
		{
			$needDate = tgl_indo2(date('Y-m-d'));
		}
		else
		{
			$needDate = tgl_indo2($dataSpb['needDate']);
		}
		
		if ($dataSpb['tanggal'] == '0000-00-00')
		{
			$tanggal = tgl_indo2(date('Y-m-d'));
		}
		else
		{
			$tanggal = tgl_indo2($dataSpb['tanggal']);
		}
		
		$smarty->assign("spbNo", $spbCode);
		$smarty->assign("orderDateIndo", $tanggal);
		$smarty->assign("needDateIndo", $needDate);
		$smarty->assign("spbFaktur", $_SESSION['spbFaktur']);
		// query detil spb
		$queryDetilSpb = "SELECT * FROM as_temp_detail_spb WHERE spbFaktur = '$_SESSION[spbFaktur]' AND spbNo = '$spbCode' ORDER BY detailID ASC";
		$sqlDetilSpb = mysqli_query($connect, $queryDetilSpb);
		$numsDetilSpb = mysqli_num_rows($sqlDetilSpb);
		
		// fetch data
		$i = 1;
		while ($dtDetilSpb = mysqli_fetch_array($sqlDetilSpb))
		{
			$subtotal = $dtDetilSpb['price'] * $dtDetilSpb['qty'];
			$dataDetilSpb[] = array(	'detailID' => $dtDetilSpb['detailID'],
										'productName' => $dtDetilSpb['productName'],
										'price' => rupiah($dtDetilSpb['price']),
										'qty' => $dtDetilSpb['qty'],
										'subtotal' => rupiah($subtotal),
										'no' => $i);
			$i++;
		}
		
		// assign to the tpl
		$smarty->assign("dataDetilSpb", $dataDetilSpb);
		$smarty->assign("numsDetilSpb", $numsDetilSpb);
	} // close bracket
	
	// if the module is spb and act is search
	elseif ($module == 'spb' && $act == 'search')
	{
		$_SESSION['spbFaktur'] = date('Ymdhis');
		$smarty->assign("spbFaktur", $_SESSION['spbFaktur']);
		
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		$sDate = mysqli_real_escape_string($connect, $_GET['startDate']);
		$eDate = mysqli_real_escape_string($connect, $_GET['endDate']);
		
		$smarty->assign("startDate", $sDate);
		$smarty->assign("endDate", $eDate);
		
		$s2Date = explode("-", $sDate);
		$e2Date = explode("-", $eDate);
		
		$startDate = $s2Date[2]."-".$s2Date[1]."-".$s2Date[0];
		$endDate = $e2Date[2]."-".$e2Date[1]."-".$e2Date[0];
		
		// showing up the spb data
		if ($sDate != '' || $eDate != '')
		{
			$querySpb = "SELECT * FROM purchaseorder WHERE spbNo LIKE '%$q%' AND tanggal BETWEEN '$startDate' AND '$endDate' ORDER BY spbID DESC";
		}
		else
		{
			$querySpb = "SELECT * FROM purchaseorder WHERE spbNo LIKE '%$q%' ORDER BY spbID DESC";
		}
		
		$sqlSpb = mysqli_query($connect, $querySpb);
		
		// fetch data
		$i = 1 + $position;
		while ($dtSpb = mysqli_fetch_array($sqlSpb))
		{
			$dataSpb[] = array(	'spbID' => $dtSpb['spbID'],
								'spbNo' => $dtSpb['spbNo'],
								'spbFaktur' => $dtSpb['spbFaktur'],
								'namaSupplier' => $dtSpb['namaSupplier'],
								'staffName' => $dtSpb['staffName'],
								'tanggal' => tgl_indo2($dtSpb['tanggal']),
								'total' => rupiah($dtSpb['total']),
								'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataSpb", $dataSpb);
		
		$smarty->assign("page", $_GET['page']);
		$smarty->assign("q", $q);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Purchase Order");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi purchase order.");
		$smarty->assign("breadcumbMenuName", "Purchase Order");
		$smarty->assign("breadcumbMenuSubName", "Purchase Order");
	} 
	
	else
	{
		$_SESSION['spbFaktur'] = date('Ymdhis');
		$smarty->assign("spbFaktur", $_SESSION['spbFaktur']);
		// create new object pagination
		$p = new PaginationSpb;
		// limit 20 data for page
		$limit  = 30;
		$position = $p->searchPosition($limit);
		
		// showing up the spb data
		$querySpb = "SELECT * FROM purchaseorder ORDER BY spbID DESC LIMIT $position,$limit";
		$sqlSpb = mysqli_query($connect, $querySpb);
		
		// fetch data
		$i = 1 + $position;
		while ($dtSpb = mysqli_fetch_array($sqlSpb))
		{
			$dataSpb[] = array(	'spbID' => $dtSpb['spbID'],
								'spbNo' => $dtSpb['spbNo'],
								'spbFaktur' => $dtSpb['spbFaktur'],
								'namaSupplier' => $dtSpb['namaSupplier'],
								'staffName' => $dtSpb['staffName'],
								'tanggal' => tgl_indo2($dtSpb['tanggal']),
								'total' => rupiah($dtSpb['total']),
								'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataSpb", $dataSpb);
		
		// count data
		$queryCountSpb = "SELECT * FROM purchaseorder";
		$sqlCountSpb = mysqli_query($connect, $queryCountSpb);
		$amountData = mysqli_num_rows($sqlCountSpb);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		$smarty->assign("page", $_GET['page']);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Purchase Order");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi purchase order.");
		$smarty->assign("breadcumbMenuName", "Purchase Order");
		$smarty->assign("breadcumbMenuSubName", "Purchase Order");
	}
	
	$smarty->assign("module", $module);
	$smarty->assign("act", $act);
}

// include footer
include "footer.php";
?>