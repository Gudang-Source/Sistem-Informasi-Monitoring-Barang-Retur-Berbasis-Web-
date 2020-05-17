<?php
// include header
include "header.php";
// set the tpl page
$page = "faktur.tpl";

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
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '13'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
		
	// if module is bbm and action is delete
	if ($module == 'bbm' && $act == 'delete')
	{
		// insert method into a variable
		$bbmID = $_GET['bbmID'];
		$nofaktur = $_GET['nofaktur'];
		$bbmFaktur = $_GET['bbmFaktur'];
		
		$queryBD = "SELECT * FROM detail_fakturbeli WHERE nofaktur = '$nofaktur' AND bbmFaktur = '$bbmFaktur'";
		$sqlBD = mysqli_query($connect, $queryBD);
		
		// fetch data
		while ($dataBD = mysqli_fetch_array($sqlBD))
		{
			$querySP = "UPDATE barang SET stock=stock-$dataBD[qty] WHERE productID = '$dataBD[productID]'";
			mysqli_query($connect, $querySP);

			$querydetail = "DELETE FROM detail_barang WHERE no_detail_brg = '$dataBD[no_detail_brg]'";
			mysqli_query($connect, $querydetail);
		}
		




		// delete bbm
		$queryBbm = "DELETE FROM faktur_beli WHERE bbmID = '$bbmID' AND nofaktur = '$nofaktur' AND bbmFaktur = '$bbmFaktur' ";
		$sqlBbm = mysqli_query($connect, $queryBbm);
		
		// delete bbm detail
		$queryBbmDetail = "DELETE FROM detail_fakturbeli WHERE nofaktur = '$nofaktur' AND bbmFaktur = '$bbmFaktur'";
		$sqlBbmDetail = mysqli_query($connect, $queryBbmDetail);
		
		// redirect to the bbm page
		header("Location: bbm.php?msg=Data transaksi pembelian berhasil dihapus");
	} // close bracket
	
	// if the module is bbm and act is input
	elseif ($module == 'bbm' && $act == 'input')
	{
		$bbmFaktur = $_SESSION['bbmFaktur'];
		$staffID = $_SESSION['staffID'];
		$sName = $_SESSION['staffCode']." ".$_SESSION['staffName'];
		$nofaktur = $_POST['nofaktur'];
		$bbmID = $_POST['bbmID'];
		$spbNo = $_POST['spbNo'];
		$supplierID = $_POST['supplierID'];
		$namaSupplier = $_POST['namaSupplier'];
		$rDate = explode("-", $_POST['tglfaktur']);
		$tglfaktur = $rDate[2]."-".$rDate[1]."-".$rDate[0];
		$oDate = explode("-", $_POST['tanggal']);
		$tanggal = $oDate[2]."-".$oDate[1]."-".$oDate[0];
		$nDate = explode("-", $_POST['needDate']);
		$needDate = $nDate[2]."-".$nDate[1]."-".$nDate[0];
		$note = mysqli_real_escape_string($connect, $_POST['note']);
		$detailID = $_POST['detailID'];
		$countDetailID = COUNT($detailID);
		$productID = $_POST['productID'];
		$productName = $_POST['productName'];
		$price = $_POST['price'];
		$qty = $_POST['qty'];
		$receiveQty = $_POST['receiveQty'];
		$status = $_POST['status'];
		$no_detail_brg = $_POST['no_detail_brg'];
		$notedetail = $_POST['notedetail'];
		$tgl_kadaluarsa = $_POST['tgl_kadaluarsa'];
		$total = $_POST['total'];

		
		$dataSpb = mysqli_fetch_array(mysqli_query($connect, "SELECT spbID FROM purchaseorder WHERE spbNo = '$spbNo'"));
		
		for ($i = 0; $i < $countDetailID; $i++)
		{
			$tkadaluarsa = explode("-", $tgl_kadaluarsa[$i]);
		    $tgl_kadaluarsa[$i] = $tkadaluarsa[2]."-".$tkadaluarsa[1]."-".$tkadaluarsa[0];
			$productNm = mysqli_real_escape_string($connect, $productName[$i]);
			
			
			$queryInsert = "INSERT INTO detail_fakturbeli (	nofaktur,
														bbmFaktur,
														productID,
														productName,
														price,
														qty,
														no_detail_brg,
														tgl_kadaluarsa)
										VALUES 			('$nofaktur',
														'$bbmFaktur',
														'$productID[$i]',
														'$productNm',
														'$price[$i]',
														'$qty[$i]',
														'$no_detail_brg[$i]',
														'$tgl_kadaluarsa[$i]')";
			
			$first_five = substr($productNm, 0, 5);
			$queryInsertt   = "INSERT INTO	 detail_barang (	
														no_detail_brg,
														productCode,
														mep,
														qty_brg,
														namaSupplier)
											VALUES (	
														'$no_detail_brg[$i]',
														'$productNm',
														'$tgl_kadaluarsa[$i]',
														'$qty[$i]',
														'$namaSupplier')";


			mysqli_query($connect, $queryInsert);
			mysqli_query($connect, $queryInsertt);

			$queryStock = "UPDATE barang SET stock=stock+$qty[$i] WHERE productID = '$productID[$i]'";
			mysqli_query($connect, $queryStock);
			
			
		}

		// update bbm
		$queryBbm = "UPDATE faktur_beli SET 	spbID = '$dataSpb[spbID]', 
										spbNo = '$spbNo',
										supplierID = '$supplierID',
										namaSupplier = '$namaSupplier',
										staffID = '$staffID',
										staffName = '$sName',
										tglfaktur = '$tglfaktur',
										tanggal = '$tanggal',
										total = '$total'
										WHERE bbmID = '$bbmID' AND bbmFaktur = '$bbmFaktur'";
										
		$sqlBbm = mysqli_query($connect, $queryBbm);

		$_SESSION['bbmFaktur'] = "";
		
		header("Location: bbm.php?module=bbm&act=finish&nofaktur=".$nofaktur."&bbmFaktur=".$bbmFaktur);
	}
	
	// if the module is bbm and act is detailbbm
	elseif ($module == 'bbm' && $act == 'detailbbm')
	{
		$bbmID = $_GET['bbmID'];
		$bbmFaktur = $_GET['bbmFaktur'];
		$nofaktur = $_GET['nofaktur'];
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		
		$queryBbm = "SELECT * FROM faktur_beli WHERE bbmID = '$bbmID' AND nofaktur = '$nofaktur' AND bbmFaktur = '$bbmFaktur'";
		$sqlBbm = mysqli_query($connect, $queryBbm);
		$dataBbm = mysqli_fetch_array($sqlBbm);
		
		// assign to the tpl
		$smarty->assign("bbmFaktur", $dataBbm['bbmFaktur']);
		$smarty->assign("bbmID", $dataBbm['bbmID']);
		$smarty->assign("nofaktur", $dataBbm['nofaktur']);
		$smarty->assign("spbID", $dataBbm['spbID']);
		$smarty->assign("spbNo", $dataBbm['spbNo']);
		$smarty->assign("supplierID", $dataBbm['supplierID']);
		$smarty->assign("namaSupplier", $dataBbm['namaSupplier']);
		$smarty->assign("staffID", $dataBbm['staffID']);
		$smarty->assign("staffName", $dataBbm['staffName']);
		$smarty->assign("tglfaktur", tgl_indo2($dataBbm['tglfaktur']));
		$smarty->assign("tanggal", tgl_indo2($dataBbm['tanggal']));
		
		$smarty->assign("total", number_format($dataBbm['total'], 2, '.', ''));


		// show the bbm detail
		$queryBbmDetail = "SELECT * FROM detail_fakturbeli WHERE nofaktur = '$nofaktur' AND bbmFaktur = '$bbmFaktur' ORDER BY detailID ASC";
		$sqlBbmDetail = mysqli_query($connect, $queryBbmDetail);
		
		$i = 1;
		while ($dtBbmDetail = mysqli_fetch_array($sqlBbmDetail))
		{
			$subtotal = ($dtBbmDetail['qty'] * $dtBbmDetail['price']);
			$dataBbmDetail[] = array(	'detailID' => $dtBbmDetail['detailID'],
										'nofaktur' => $dtBbmDetail['nofaktur'],
										'bbmFaktur' => $dtBbmDetail['bbmFaktur'],
										'productID' => $dtBbmDetail['productID'],
										'productName' => $dtBbmDetail['productName'],
										'price' => rupiah($dtBbmDetail['price']),
										'qty' => $dtBbmDetail['qty'],
										'receiveQty' => $dtBbmDetail['receiveQty'],
										'subtotal' => rupiah($subtotal),
										'no_detail_brg' => $dtBbmDetail['no_detail_brg'],
										'tgl_kadaluarsa' => $dtBbmDetail['tgl_kadaluarsa'],
										'no' => $i
										);
			$i++;
			$total += ($subtotal);
		}
		$smarty->assign("total", rupiah($total));
		$smarty->assign("dataBbmDetail", $dataBbmDetail);
		$smarty->assign("page", $_GET['page']);
		$smarty->assign("q", $_GET['q']);
		
		$smarty->assign("breadcumbTitle", "Transaksi Pembelian ");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi pembelian, faktur pembelian.");
		$smarty->assign("breadcumbMenuName", "Transaksi Pembelian ");
		$smarty->assign("breadcumbMenuSubName", "Transaksi Pembelian ");
	}
	
	// if the module bbm and act is cancel
	elseif ($module == 'bbm' && $act == 'cancel')
	{
		$bbmFaktur = $_SESSION['bbmFaktur'];
		
		// delete bbm
		$queryBbm = "DELETE FROM faktur_beli WHERE bbmFaktur = '$bbmFaktur'";
		$sqlBbm = mysqli_query($connect, $queryBbm);
		
		$_SESSION['bbmFaktur'] = "";
		
		header("Location: bbm.php?msg=Data transaksi pembelian dibatalkan.");
	}
	
	// if module bbm and act is finish
	elseif ($module == 'bbm' && $act == 'finish')
	{
		$nofaktur = $_GET['nofaktur'];
		$bbmFaktur = $_GET['bbmFaktur'];
		
		$queryBbm = "SELECT * FROM faktur_beli WHERE nofaktur = '$nofaktur' AND bbmFaktur = '$bbmFaktur'";
		$sqlBbm = mysqli_query($connect, $queryBbm);
		$dataBbm = mysqli_fetch_array($sqlBbm);
		
		$smarty->assign("bbmID", $dataBbm['bbmID']);
		$smarty->assign("nofaktur", $dataBbm['nofaktur']);
		$smarty->assign("bbmFaktur", $dataBbm['bbmFaktur']);
		$smarty->assign("spbID", $dataBbm['spbID']);
		$smarty->assign("spbNo", $dataBbm['spbNo']);
		$smarty->assign("supplierID", $dataBbm['supplierID']);
		$smarty->assign("namaSupplier", $dataBbm['namaSupplier']);
		$smarty->assign("staffID", $dataBbm['staffID']);
		$smarty->assign("staffName", $dataBbm['staffName']);
		$smarty->assign("tglfaktur", tgl_indo2($dataBbm['tglfaktur']));
		$smarty->assign("tanggal", tgl_indo2($dataBbm['tanggal']));

		
		// show the bbm detail
		$queryBbmDetail = "SELECT * FROM detail_fakturbeli WHERE nofaktur = '$nofaktur' AND bbmFaktur = '$bbmFaktur'";
		$sqlBbmDetail = mysqli_query($connect, $queryBbmDetail);
		
		// fetch data
		$k = 1;
		while ($dtBbmDetail = mysqli_fetch_array($sqlBbmDetail))
		{
			$subtotal = ($dtBbmDetail['qty'] * $dtBbmDetail['price']);
			$dataBbmDetail[] = array(	'detailID' => $dtBbmDetail['detailID'],
										'nofaktur' => $dtBbmDetail['nofaktur'],
										'bbmFaktur' => $dtBbmDetail['bbmFaktur'],
										'productName' => $dtBbmDetail['productName'],
										'price' => rupiah($dtBbmDetail['price']),
										'qty' => $dtBbmDetail['qty'],
										'subtotal' => rupiah($subtotal),
										'receiveQty' => $dtBbmDetail['receiveQty'],
										'no_detail_brg' => $dtBbmDetail['no_detail_brg'],
										'tgl_kadaluarsa' => $dtBbmDetail['tgl_kadaluarsa'],
										'no' => $k 
										);
			$k++;
			$total += ($subtotal);
		}
		$smarty->assign("total", rupiah($total));
		$smarty->assign("dataBbmDetail", $dataBbmDetail);
		
		$smarty->assign("breadcumbTitle", "Transaksi Pembelian");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi pembelian, faktur pembelian.");
		$smarty->assign("breadcumbMenuName", "Transaksi Pembelian");
		$smarty->assign("breadcumbMenuSubName", "Transaksi Pembelian");
	}
	
	// if the module bbm and act is add
	elseif ($module == 'bbm' && $act == 'add')
	{
		$bbmFaktur = $_SESSION['bbmFaktur'];
		
		// get last sort bbm number ID
		$queryNoBbm = "SELECT nofaktur FROM faktur_beli ORDER BY nofaktur DESC LIMIT 1";
		$sqlNoBbm = mysqli_query($connect, $queryNoBbm);
		$numsNoBbm = mysqli_num_rows($sqlNoBbm);
		$dataNoBbm = mysqli_fetch_array($sqlNoBbm);
		
		$start = substr($dataNoBbm['nofaktur'],0-5);
		$next = $start + 1;
		$tempNo = strlen($next);
		
		if ($numsNoBbm == '0')
		{
			$nofaktur = "00000";
		}
		elseif ($tempNo == 1)
		{
			$nofaktur = "00000";
		}
		elseif ($tempNo == 2)
		{
			$nofaktur = "0000";
		}
		elseif ($tempNo == 3)
		{
			$nofaktur = "000";
		}
		elseif ($tempNo == 4)
		{
			$nofaktur = "00";
		}
		elseif ($tempNo == 5)
		{
			$nofaktur = "0";
		}
		elseif ($tempNo == 6)
		{
			$nofaktur = "";
		}
		
		$bbmCode = "TB".$nofaktur.$next;
		
		// count bbm based on nofaktur
		$showBbm = "SELECT * FROM faktur_beli WHERE bbmFaktur = '$bbmFaktur'";
		$sqlBbm = mysqli_query($connect, $showBbm);
		$numsBbm = mysqli_num_rows($sqlBbm);
		
		if ($numsBbm == 0)
		{
			$tglfaktur = date('Y-m-d');
			$sName = $_SESSION['staffCode']." ".$_SESSION['staffName'];
			$queryBbm = "INSERT INTO faktur_beli(bbmFaktur,
											nofaktur,
											spbID,
											spbNo,
											supplierID,
											namaSupplier,
											staffID,
											staffName,
											tglfaktur,
											tanggal,
											total)
									VALUES(	'$bbmFaktur',
											'$bbmCode',
											'',
											'',
											'',
											'',
											'$_SESSION[staffID]',
											'$sName',
											'$tglfaktur',
											'',
											'$total')";
			mysqli_query($connect, $queryBbm);
		}
		
		// count bbm based on nofaktur
		$showBbm = "SELECT * FROM faktur_beli WHERE bbmFaktur = '$bbmFaktur'";
		$sqlBbm = mysqli_query($connect, $showBbm);
		$dataBbm = mysqli_fetch_array($sqlBbm);
		
		$smarty->assign("nofaktur", $dataBbm['nofaktur']);
		$smarty->assign("bbmID", $dataBbm['bbmID']);
		
		if ($dataBbm['tglfaktur'] == '0000-00-00')
		{
			$tglfaktur = date('Y-m-d');
		}
		else
		{
			$tglfaktur = $dataBbm['tglfaktur'];
		}
		
		$smarty->assign("tglfaktur", tgl_indo2($tglfaktur));
		
		// show the spb data based on spbNo
		$spbNo = mysqli_real_escape_string($connect, $_GET['spbNo']);
		$querySpb = "SELECT * FROM purchaseorder WHERE spbNo = '$spbNo'";
		$sqlSpb = mysqli_query($connect, $querySpb);
		$dataSpb = mysqli_fetch_array($sqlSpb);
		$numsSpb = mysqli_num_rows($sqlSpb);
		
		$smarty->assign("numsSpb", $numsSpb);
		
		// show the bbm data
		$queryBbm = "SELECT A.bbmID FROM faktur_beli A INNER JOIN detail_fakturbeli B ON B.nofaktur=A.nofaktur WHERE A.spbNo = '$spbNo'";
		$sqlBbm = mysqli_query($connect, $queryBbm);
		$numsBbm = mysqli_num_rows($sqlBbm);
		
		$smarty->assign("numsBbm", $numsBbm);
		
		// assign to the bbm tpl
		$smarty->assign("spbNo", $spbNo);
		$smarty->assign("namaSupplier", $dataSpb['namaSupplier']);
		$smarty->assign("supplierID", $dataSpb['supplierID']);
		$smarty->assign("tanggal", tgl_indo2($dataSpb['tanggal']));
		
		// show the spb detail based on spbNo
		$i = 1;
		$querySpbDetail = "SELECT * FROM detail_po WHERE spbNo = '$spbNo' AND spbFaktur = '$dataSpb[spbFaktur]'";
		$sqlSpbDetail = mysqli_query($connect, $querySpbDetail);
		while ($dataSpbDetail = mysqli_fetch_array($sqlSpbDetail))
		{
			$subtotal = ($dataSpbDetail['qty'] * $dataSpbDetail['price']);
			
			$dataDetail[] = array(	'detailID' => $dataSpbDetail['detailID'],
									'spbNo' => $dataSpbDetail['spbNo'],
									'spbFaktur' => $dataSpbDetail['spbFaktur'],
									'productID' => $dataSpbDetail['productID'],
									'productName' => $dataSpbDetail['productName'],
									'price' => ($dataSpbDetail['price']),
									'qty' => $dataSpbDetail['qty'],
									'subtotal' => ($subtotal),
									'tgl_kadaluarsa' => $dataSpbDetail['tgl_kadaluarsa'],
									'no' => $i
									);
			$total += ($subtotal);
			$i++;
		}
		
		// assign to the spb tpl
		$smarty->assign("total", $total);
		$smarty->assign("dataDetail", $dataDetail);
		
		// show the factories data
		/*$queryFactory = "SELECT * FROM as_factories WHERE status = 'Y' ORDER BY factoryCode ASC";
		$sqlFactory = mysqli_query($connect, $queryFactory);
		
		while ($dtFactory = mysqli_fetch_array($sqlFactory))
		{
			$dataFactory[] = array(	'factoryID' => $dtFactory['factoryID'],
									'factoryCode' => $dtFactory['factoryCode'],
									'factoryName' => $dtFactory['factoryName']);
		}
		
		$smarty->assign("dataFactory", $dataFactory);*/
		
		$smarty->assign("breadcumbTitle", "Transaksi Pembelian");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi pembelian, faktur pembelian.");
		$smarty->assign("breadcumbMenuName", "Transaksi Pembelian");
		$smarty->assign("breadcumbMenuSubName", "Transaksi Pembelian");
	}

	elseif ($module == 'bbm' && $act == 'search')
	{
		$bbmFaktur = date('Ymdhis');
		$_SESSION['bbmFaktur'] = $bbmFaktur;
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		$sDate = mysqli_real_escape_string($connect, $_GET['startDate']);
		$eDate = mysqli_real_escape_string($connect, $_GET['endDate']);
		
		$smarty->assign("startDate", $sDate);
		$smarty->assign("endDate", $eDate);
		
		$s2Date = explode("-", $sDate);
		$e2Date = explode("-", $eDate);
		
		$startDate = $s2Date[2]."-".$s2Date[1]."-".$s2Date[0];
		$endDate = $e2Date[2]."-".$e2Date[1]."-".$e2Date[0];
		
		// showing up the bbm data
		if ($sDate != '' || $eDate != '')
		{
			$queryBbm = "SELECT * FROM faktur_beli WHERE nofaktur LIKE '%$q%' AND tglfaktur BETWEEN '$startDate' AND '$endDate' ORDER BY bbmID DESC";
		}
		else
		{
			$queryBbm = "SELECT * FROM faktur_beli WHERE nofaktur LIKE '%$q%' ORDER BY bbmID DESC";
		}
		$sqlBbm = mysqli_query($connect, $queryBbm);
		
		// fetch data
		$i = 1 + $position;
		while ($dtBbm = mysqli_fetch_array($sqlBbm))
		{
			$dataBbm[] = array(	'bbmID' => $dtBbm['bbmID'],
								'nofaktur' => $dtBbm['nofaktur'],
								'bbmFaktur' => $dtBbm['bbmFaktur'],
								'spbID' => $dtBbm['spdID'],
								'spbNo' => $dtBbm['spbNo'],
								'supplierID' => $dtBbm['supplierID'],
								'namaSupplier' => $dtBbm['namaSupplier'],
								'staffID' => $dtBbm['staffID'],
								'staffName' => $dtBbm['staffName'],
								'tglfaktur' => tgl_indo2($dtBbm['tglfaktur']),
								'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataBbm", $dataBbm);
		
		$smarty->assign("page", $_GET['page']);
		$smarty->assign("q", $q);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Transaksi Pembelian");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi pembelian, faktur pembelian.");
		$smarty->assign("breadcumbMenuName", "Transaksi Pembelian");
		$smarty->assign("breadcumbMenuSubName", "Transaksi Pembelian");
	} 
	
	else
	{
		$bbmFaktur = date('Ymdhis');
		$_SESSION['bbmFaktur'] = $bbmFaktur;
		
		// create new object pagination
		$p = new PaginationBbm;
		// limit 20 data for page
		$limit  = 30;
		$position = $p->searchPosition($limit);
		
		// showing up the bbm data
		$queryBbm = "SELECT * FROM faktur_beli ORDER BY bbmID DESC LIMIT $position,$limit";
		$sqlBbm = mysqli_query($connect, $queryBbm);
		
		// fetch data
		$i = 1 + $position;
		while ($dtBbm = mysqli_fetch_array($sqlBbm))
		{
			$dataBbm[] = array(	'bbmID' => $dtBbm['bbmID'],
								'nofaktur' => $dtBbm['nofaktur'],
								'bbmFaktur' => $dtBbm['bbmFaktur'],
								'spbID' => $dtBbm['spdID'],
								'spbNo' => $dtBbm['spbNo'],
								'supplierID' => $dtBbm['supplierID'],
								'namaSupplier' => $dtBbm['namaSupplier'],
								'staffID' => $dtBbm['staffID'],
								'staffName' => $dtBbm['staffName'],
								'tglfaktur' => tgl_indo2($dtBbm['tglfaktur']),
								'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataBbm", $dataBbm);
		
		// count data
		$queryCountBbm = "SELECT * FROM faktur_beli";
		$sqlCountBbm = mysqli_query($connect, $queryCountBbm);
		$amountData = mysqli_num_rows($sqlCountBbm);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		$smarty->assign("page", $_GET['page']);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Transaksi Pembelian");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi pembelian, faktur pembelian.");
		$smarty->assign("breadcumbMenuName", "Transaksi Pembelian");
		$smarty->assign("breadcumbMenuSubName", "Transaksi Pembelian");
	}
	
	$smarty->assign("module", $module);
	$smarty->assign("act", $act);
}

// include footer
include "footer.php";
?>