<?php
// include header
include "header.php";
// set the tpl page
$page = "report_retur.tpl";

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
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '23'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
		
	// if module is returbuy and action is delete
	if ($module == 'returbuy' && $act == 'delete')
	{
		// insert method into a variable
		$returID = $_GET['returID'];
		$returNo = $_GET['returNo'];
		
		// show the invoice no, retur type, grandtotal, supplierID
		$queryRetur = "SELECT nofaktur , subtotal, supplierID FROM retur WHERE returID = '$returID' AND returNo = '$returNo'";
		$sqlRetur = mysqli_query($connect, $queryRetur);
		$dataRetur = mysqli_fetch_array($sqlRetur);




		$queryDetail = "SELECT productID, qty FROM detail_retur WHERE returID = '$returID' AND returNo = '$returNo'";
		$sqlDetail = mysqli_query($connect, $queryDetail);
		while ($dataDetail = mysqli_fetch_array($sqlDetail))
		{
			$qty = $dataDetail['qty'];
			
			// addition of the balance based on factory id and product id
			$querySP = "UPDATE barang SET stock=stock+$qty WHERE productID = '$dataDetail[productID]'";
			mysqli_query($connect, $querySP);
		}
		
		// delete the retur data based on retur id and retur no
		$queryDelete = "DELETE FROM retur WHERE returID = '$returID' AND returNo = '$returNo'";
		$sqlDelete = mysqli_query($connect, $queryDelete);
		
		if ($sqlDelete)
		{
			// delete the detail retur data based on retur id and retur no
			$queryDeleteDetail = "DELETE FROM detail_retur WHERE returID = '$returID' AND returNo = '$returNo'";
			$sqlDeleteDetail = mysqli_query($connect, $queryDeleteDetail);
		}

		// redirect to the retur supplier page
		header("Location: retur_suppliers.php?msg=Data retur pembelian berhasil dihapus/dibatalkan");
	} // close bracket
	
	// if the module is returbuy and action is cancel
	elseif ($module == 'returbuy' && $act == 'cancel')
	{
		// redirect to the retur supplier page
		header("Location: retur_suppliers.php?msg=Transaksi retur pembelian dibatalkan.");
	}
	
	// if the module is retur buy and act is input
	elseif ($module == 'returbuy' && $act == 'input')
	{
		$createdDate = date('Y-m-d H:i:s');
		$staffID = $_SESSION['staffID'];
		$sName = $_SESSION['staffCode']." ".$_SESSION['staffName'];
		$returNo = mysqli_real_escape_string($connect, $_POST['returNo']);
		$rDate = mysqli_real_escape_string($connect, $_POST['tanggalretur']);
		$r2Date = explode("-", $rDate);
		$tanggalretur = $r2Date[2]."-".$r2Date[1]."-".$r2Date[0];
		$nofaktur = mysqli_real_escape_string($connect, $_POST['nofaktur']);
		$supplierID = mysqli_real_escape_string($connect, $_POST['supplierID']);
		$namaSupplier = mysqli_real_escape_string($connect, $_POST['namaSupplier']);
		
		$returType = mysqli_real_escape_string($connect, $_POST['returType']);
		$ppnType = mysqli_real_escape_string($connect, $_POST['ppnType']);
		$note = mysqli_real_escape_string($connect, $_POST['note']);
		$no_detail_brg = mysqli_real_escape_string($connect, $_POST['no_detail_brg']);
		
		$productID = $_POST['productID'];
		$productName = $_POST['productName'];
		$qty = $_POST['qty'];
		$jumlah = $_POST['jumlah'];
		$ket = $_POST['ket'];
		$harga = $_POST['harga'];
		$desc = $_POST['desc'];
		$no_detail_brg = $_POST['no_detail_brg'];
		$detailID = $_POST['detailID'];
		$countDetailID = COUNT($detailID);
		
		// save into the retur supplier table
		$queryRetur = "INSERT INTO retur (	returNo,
														tanggalretur,
														nofaktur,
														supplierID,
														namaSupplier,
														subtotal,
														staffID,
														staffName)
												VALUES(	'$returNo',
														'$tanggalretur',
														'$nofaktur',
														'$supplierID',
														'$namaSupplier',
														'0',
														'$staffID',
														'$sName')";
														
		$sqlRetur = mysqli_query($connect, $queryRetur);
		
		$returID = mysqli_insert_id($connect);
		
		if ($sqlRetur)
		{
			for ($i = 0; $i < $countDetailID; $i++)
			{
				if ($jumlah[$i] > 0)
				{
					$subt = $harga[$i] * $jumlah[$i];
					
					$queryDetail = "INSERT INTO detail_retur (	returID,
																			returNo,
																			
																			productID,
																			productName,
																			qty,
																			harga,
																			note)
																	VALUES(	'$returID',
																			'$returNo',
																			'$productID[$i]',
																			'$productName[$i]',
																			'$jumlah[$i]',
																			'$harga[$i]',
																			'$ket[$i]')";
																			
					$save = mysqli_query($connect, $queryDetail);
					
					if ($save)
					{
					
						// reduction of the stock based on factory id and product id
						$querySP = "UPDATE barang SET stock=stock-$jumlah[$i] WHERE productID = '$productID[$i]'";
						mysqli_query($connect, $querySP);
						$queryS = "UPDATE detail_barang SET qty_brg=qty_brg-$jumlah[$i] WHERE no_detail_brg = '$no_detail_brg[$i]'";
						mysqli_query($connect, $queryS);
						$queryS = "DELETE FROM detail_barangrusak WHERE no_detail_brg = '$no_detail_brg[$i]'";
						mysqli_query($connect, $queryS);

					}
					
					$subtotal = $subtotal + $subt;
				}
			}
			/*
			if ($ppnType == '1')
			{
				$ppn = $subtotal * 0.1;
			}
			else
			{
				$ppn = 0;
			}*/
			
			
			$queryUpdate = "UPDATE retur SET subtotal = '$subtotal' WHERE returID = '$returID'";
			mysqli_query($connect, $queryUpdate);
			
			/*
			// if the retur type is add to the balance, reduction in the balance based on supplier id on the supplier data
			if ($returType == '2')
			{
				$queryReturSaldo = "UPDATE as_suppliers SET balance=balance+$grandtotal WHERE supplierID = '$supplierID'";
				$sqlReturSaldo = mysqli_query($connect, $queryReturSaldo);
			}
			// if the retur type is credit, reduction the debts about this transactions
			if ($returType == '3')
			{
				$queryReturCash = "UPDATE as_debts SET reductionTotal=reductionTotal+$grandtotal WHERE nofaktur = '$nofaktur' AND supplierID = '$supplierID'";
				$sqlReturCash = mysqli_query($connect, $queryReturCash);
			} */
		}
		
		header("Location: retur_suppliers.php?module=returbuy&act=finish&nofaktur=".$nofaktur."&returNo=".$returNo."&returID=".$returID);
	}
	
	// if the module is returbuy and act is detailretur
	elseif ($module == 'returbuy' && $act == 'detailretur')
	{
		$nofaktur = $_GET['nofaktur'];
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		$returID = $_GET['returID'];
		$returNo = $_GET['returNo'];
		
		$queryRetur = "SELECT * FROM retur WHERE nofaktur = '$nofaktur' AND returID = '$returID' AND returNo = '$returNo'";
		$sqlRetur = mysqli_query($connect, $queryRetur);
		$dataRetur = mysqli_fetch_array($sqlRetur);
		/*
		if ($dataRetur['returType'] == '1')
		{
			$returType = "CASH";
		}
		elseif ($dataRetur['returType'] == '2')
		{
			$returType = "SALDO";
		}
		else
		{
			$returType = "CREDIT";
		}
		
		if ($dataRetur['ppnType'] == '1')
		{
			$ppnType = "PPN";
			$ppn = rupiah($dataRetur['ppn']);
		}
		else
		{
			$ppnType = "NO PPN";
			$ppn = rupiah(0);
		}*/
		
		// assign to the tpl
		$smarty->assign("returID", $dataRetur['returID']);
		$smarty->assign("returNo", $dataRetur['returNo']);
		$smarty->assign("tanggalretur", tgl_indo2($dataRetur['tanggalretur']));
		$smarty->assign("nofaktur", $dataRetur['nofaktur']);
		$smarty->assign("supplierID", $dataRetur['supplierID']);
		$smarty->assign("namaSupplier", $dataRetur['namaSupplier']);
		$smarty->assign("returType", $returType);
		$smarty->assign("subtotal", rupiah($dataRetur['subtotal']));
		$smarty->assign("ppnType", $dataRetur['ppnType']);
		$smarty->assign("ppn", rupiah($dataRetur['ppnType']));
		$smarty->assign("note", $dataRetur['note']);

		
		// show the retur detail
		$queryReturDetail = "SELECT * FROM detail_retur WHERE returID = '$dataRetur[returID]' AND returNo = '$dataRetur[returNo]' ORDER BY detailID ASC";
		$sqlReturDetail = mysqli_query($connect, $queryReturDetail);
		
		$i = 1;
		while ($dtReturDetail = mysqli_fetch_array($sqlReturDetail))
		{
			$subtotal = rupiah($dtReturDetail['qty'] * $dtReturDetail['harga']);
			
			$dataReturDetail[] = array(	'detailID' => $dtReturDetail['detailID'],
										'productName' => $dtReturDetail['productName'],
										'price' => rupiah($dtReturDetail['harga']),
										'note' => $dtReturDetail['note'],
										'qty' => $dtReturDetail['qty'],
										'no_detail_brg' => $dtBbmDetail['no_detail_brg'],
										'no' => $i

										);
			$i++;
		}
		
		$smarty->assign("dataReturDetail", $dataReturDetail);
		$smarty->assign("page", $_GET['page']);
		$smarty->assign("q", $q);
		
		$smarty->assign("breadcumbTitle", "Retur Pembelian");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan retur pembelian.");
		$smarty->assign("breadcumbMenuName", "Retur");
		$smarty->assign("breadcumbMenuSubName", "Retur Pembelian");
	}
	
	// if module retur buy and act is finish
	elseif ($module == 'returbuy' && $act == 'finish')
	{
		$nofaktur = $_GET['nofaktur'];
		$returID = $_GET['returID'];
		$returNo = $_GET['returNo'];
		
		$queryRetur = "SELECT * FROM retur WHERE nofaktur = '$nofaktur' AND returID = '$returID' AND returNo = '$returNo'";
		$sqlRetur = mysqli_query($connect, $queryRetur);
		$dataRetur = mysqli_fetch_array($sqlRetur);
		/*
		if ($dataRetur['returType'] == '1')
		{
			$returType = "CASH";
		}
		elseif ($dataRetur['returType'] == '2')
		{
			$returType = "SALDO";
		}
		else
		{
			$returType = "CREDIT";
		}
		
		if ($dataRetur['ppnType'] == '1')
		{
			$ppnType = "PPN";
			$ppn = rupiah($dataRetur['ppn']);
		}
		else
		{
			$ppnType = "NO PPN";
			$ppn = rupiah(0);
		}
		*/
		// assign to the tpl
		$smarty->assign("returID", $dataRetur['returID']);
		$smarty->assign("returNo", $dataRetur['returNo']);
		$smarty->assign("tanggalretur", tgl_indo2($dataRetur['tanggalretur']));
		$smarty->assign("nofaktur", $dataRetur['nofaktur']);
		$smarty->assign("supplierID", $dataRetur['supplierID']);
		$smarty->assign("namaSupplier", $dataRetur['namaSupplier']);
		$smarty->assign("returType", $returType);
		$smarty->assign("subtotal", rupiah($dataRetur['subtotal']));
		$smarty->assign("ppnType", $ppnType);
		$smarty->assign("jumlah", $jumlah);
		$smarty->assign("ket", $ket);
		$smarty->assign("ppn", rupiah($dataRetur['ppn']));
		$smarty->assign("note", $dataRetur['note']);
		
		// show the retur detail
		$queryReturDetail = "SELECT * FROM detail_retur WHERE returID = '$dataRetur[returID]' AND returNo = '$dataRetur[returNo]' ORDER BY detailID ASC";
		$sqlReturDetail = mysqli_query($connect, $queryReturDetail);
		
		$i = 1;
		while ($dtReturDetail = mysqli_fetch_array($sqlReturDetail))
		{
			$subtotal = rupiah($dtReturDetail['qty'] * $dtReturDetail['harga']);
			
			$dataReturDetail[] = array(	'detailID' => $dtReturDetail['detailID'],
										'productName' => $dtReturDetail['productName'],
										'price' => rupiah($dtReturDetail['harga']),
										'note' => $dtReturDetail['note'],
										'subtotal' => $subtotal,
										'qty' => $dtReturDetail['qty'],
										'no' => $i
										);
			$i++;
		}
		
		$smarty->assign("dataReturDetail", $dataReturDetail);
		$smarty->assign("page", $_GET['page']);
		
		$smarty->assign("breadcumbTitle", "Retur Pembelian");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan retur pembelian.");
		$smarty->assign("breadcumbMenuName", "Retur");
		$smarty->assign("breadcumbMenuSubName", "Retur Pembelian");
	}
	
	// if the module returbuy and act is add
	elseif ($module == 'returbuy' && $act == 'add')
	{
		// get last sort retur buy number ID
		$queryNoRetur = "SELECT returNo FROM retur ORDER BY returNo DESC LIMIT 1";
		$sqlNoRetur = mysqli_query($connect, $queryNoRetur);
		$numsNoRetur = mysqli_num_rows($sqlNoRetur);
		$dataNoRetur = mysqli_fetch_array($sqlNoRetur);
		
		$start = substr($dataNoRetur['returNo'],2-7);
		$next = $start + 1;
		$tempNo = strlen($next);
		
		if ($numsNoRetur == '0')
		{
			$retNo = "00000";
		}
		elseif ($tempNo == 1)
		{
			$retNo = "00000";
		}
		elseif ($tempNo == 2)
		{
			$retNo = "0000";
		}
		elseif ($tempNo == 3)
		{
			$retNo = "000";
		}
		elseif ($tempNo == 4)
		{
			$retNo = "00";
		}
		elseif ($tempNo == 5)
		{
			$retNo = "0";
		}
		elseif ($tempNo == 6)
		{
			$retNo = "";
		}
		
		$returNo = "RB".$retNo.$next;
		
		$smarty->assign("returNo", $returNo);
		$smarty->assign("tanggalretur", tgl_indo2(date('Y-m-d')));
		
		$nofaktur = $_GET['nofaktur'];
		
		// show the bbm data
		$queryBBuy = "SELECT * FROM faktur_beli WHERE nofaktur = '$nofaktur'";
		$sqlBBuy = mysqli_query($connect, $queryBBuy);
		$dataBBuy = mysqli_fetch_array($sqlBBuy);
		$numsBBuy = mysqli_num_rows($sqlBBuy);
		
		$smarty->assign("numsBBuy", $numsBBuy);
		
		// assign to the tpl
		$smarty->assign("nofaktur", $nofaktur);
		$smarty->assign("supplierID", $dataBBuy['supplierID']);
		$smarty->assign("namaSupplier", $dataBBuy['namaSupplier']);
		$smarty->assign("ppnType", $dataBBuy['ppnType']);
		$smarty->assign("ppn", $dataBBuy['ppn']);
		
		// show the bbm detail
		$queryBbmDetail = "SELECT * FROM detail_fakturbeli WHERE nofaktur = '$dataBBuy[nofaktur]' ORDER BY detailID ASC";
		$sqlBbmDetail = mysqli_query($connect, $queryBbmDetail);
		


		$i = 1;
		while ($dtBbmDetail = mysqli_fetch_array($sqlBbmDetail))
		{
			// count stock total based on productID


			$querybarangrusak = "SELECT * FROM detail_barangrusak WHERE no_detail_brg = '$dtBbmDetail[no_detail_brg]'";
			$sqlbarangrusak = mysqli_query($connect, $querybarangrusak);
			$databrgrusak = mysqli_fetch_array($sqlbarangrusak);

			$sekarang= date('Y-m-d');
 			$min1bulan= date('Y-m-d', strtotime("+1 months",strtotime($sekarang)));
			$querybarangkadaluarsa = "SELECT * FROM detail_barang WHERE no_detail_brg = '$dtBbmDetail[no_detail_brg]' AND mep <='".$min1bulan . "' AND qty_brg>0";
			$sqlbarangkadaluarsa = mysqli_query($connect, $querybarangkadaluarsa);
			$databrgkadaluarsa = mysqli_fetch_array($sqlbarangkadaluarsa);

			if ($databrgkadaluarsa>0) {
				$dtBbmDetail[no_detail_brg] = EXPIRED; }
			else{
				$dtBbmDetail[no_detail_brg] = null;
			}
				
			


			$queryStock = "SELECT SUM(stock) as stockAmount FROM barang WHERE productID = '$dtBbmDetail[productID]'";
			$sqlStock = mysqli_query($connect, $queryStock);
			$dataStock = mysqli_fetch_array($sqlStock);
			
			$subtotal = $dtBbmDetail['qty'] * $dtBbmDetail['price'];
			
			$dataBbmDetail[] = array(	'detailID' => $dtBbmDetail['detailID'],
										'nofaktur' => $dtBbmDetail['nofaktur'],
										'bbmFaktur' => $dtBbmDetail['bbmFaktur'],
										'productID' => $dtBbmDetail['productID'],
										'productName' => $dtBbmDetail['productName'],
										'price' => $dtBbmDetail['price'],
										'pricerp' => rupiah($dtBbmDetail['price']),
										'qty' => $dtBbmDetail['qty'],
										'jumlah' => $databrgrusak['jumlah'] ^= $databrgkadaluarsa['qty_brg'],
										'ket' => $databrgrusak['ket'] . $dtBbmDetail[no_detail_brg],
										'subtotal' => rupiah($subtotal),
										'note' => $dtBbmDetail['note'],
										'stockAmount' => $dataStock['stockAmount'],
										'no_detail_brg' => $dtBbmDetail['no_detail_brg'],
										'no' => $i
										);

			$i++; 
		}
		
		$smarty->assign("dataBbmDetail", $dataBbmDetail);
			
		$smarty->assign("breadcumbTitle", "Retur Pembelian");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan retur pembelian.");
		$smarty->assign("breadcumbMenuName", "Retur");
		$smarty->assign("breadcumbMenuSubName", "Retur Pembelian");
	}

	elseif ($module == 'returbuy' && $act == 'search')
	{
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		$sDate = mysqli_real_escape_string($connect, $_GET['startDate']);
		$eDate = mysqli_real_escape_string($connect, $_GET['endDate']);
		
		$smarty->assign("startDate", $sDate);
		$smarty->assign("endDate", $eDate);
		
		$s2Date = explode("-", $sDate);
		$e2Date = explode("-", $eDate);
		
		$startDate = $s2Date[2]."-".$s2Date[1]."-".$s2Date[0];
		$endDate = $e2Date[2]."-".$e2Date[1]."-".$e2Date[0];
		
		// showing up the retur data
		if ($sDate != '' || $eDate != '')
		{
			$queryRetur = "SELECT * FROM retur WHERE returNo LIKE '%$q%' AND tanggalretur BETWEEN '$startDate' AND '$endDate' ORDER BY returNo DESC";
		}
		else
		{
			$queryRetur = "SELECT * FROM retur WHERE returNo LIKE '%$q%' ORDER BY returNo DESC";	
		}
		$sqlRetur = mysqli_query($connect, $queryRetur);
		
		// fetch data
		$i = 1 + $position;
		while ($dtRetur = mysqli_fetch_array($sqlRetur))
		{/*
			if ($dtRetur['returType'] == '1')
			{
				$returType = "CASH";
			}
			elseif ($dtRetur['returType'] == '2')
			{
				$returType = "SALDO";
			}
			else
			{
				$returType = "CREDIT";
			}
			
			if ($dtRetur['ppnType'] == '1')
			{
				$ppnType = "PPN";
				$ppn = rupiah($dtRetur['ppn']);
			}
			else
			{
				$ppnType = "NO PPN";
				$ppn = "";
			}*/
			
			$dataRetur[] = array(	'returID' => $dtRetur['returID'],
									'returNo' => $dtRetur['returNo'],
									'tanggalretur' => tgl_indo2($dtRetur['tanggalretur']),
									'nofaktur' => $dtRetur['nofaktur'],
									'supplierID' => $dtRetur['supplierID'],
									'namaSupplier' => $dtRetur['namaSupplier'],
									'subtotal' => rupiah($dtRetur['subtotal']),
									'staffID' => $dtRetur['staffName'],
									'staffName' => $dtRetur['staffName'],
									'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataRetur", $dataRetur);
		$smarty->assign("page", $_GET['page']);
		$smarty->assign("q", $q);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Retur Pembelian");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan retur pembelian.");
		$smarty->assign("breadcumbMenuName", "Retur");
		$smarty->assign("breadcumbMenuSubName", "Retur Pembelian");
	}
	
	else
	{
		// create new object pagination
		$p = new PaginationReturSupplier;
		// limit 20 data for page
		$limit  = 30;
		$position = $p->searchPosition($limit);
		
		// showing up the retur data
		$queryRetur = "SELECT * FROM retur ORDER BY returID DESC LIMIT $position,$limit";
		$sqlRetur = mysqli_query($connect, $queryRetur);
		
		// fetch data
		$i = 1 + $position;
		while ($dtRetur = mysqli_fetch_array($sqlRetur))
		{/*
			if ($dtRetur['returType'] == '1')
			{
				$returType = "CASH";
			}
			elseif ($dtRetur['returType'] == '2')
			{
				$returType = "SALDO";
			}
			else
			{
				$returType = "CREDIT";
			}
			
			if ($dtRetur['ppnType'] == '1')
			{
				$ppnType = "PPN";
				$ppn = rupiah($dtRetur['ppn']);
			}
			else
			{
				$ppnType = "NO PPN";
				$ppn = "";
			}*/
			
			$dataRetur[] = array(	'returID' => $dtRetur['returID'],
									'returNo' => $dtRetur['returNo'],
									'tanggalretur' => tgl_indo2($dtRetur['tanggalretur']),
									'nofaktur' => $dtRetur['nofaktur'],
									'supplierID' => $dtRetur['supplierID'],
									'namaSupplier' => $dtRetur['namaSupplier'],
									'subtotal' => rupiah($dtRetur['subtotal']),
									'staffID' => $dtRetur['staffName'],
									'staffName' => $dtRetur['staffName'],
									'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataRetur", $dataRetur);
		
		// count data
		$queryCountRetur = "SELECT * FROM retur";
		$sqlCountRetur = mysqli_query($connect, $queryCountRetur);
		$amountData = mysqli_num_rows($sqlCountRetur);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		$smarty->assign("page", $_GET['page']);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Retur Pembelian");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan retur pembelian.");
		$smarty->assign("breadcumbMenuName", "Retur");
		$smarty->assign("breadcumbMenuSubName", "Retur Pembelian");
	}
	
	$smarty->assign("module", $module);
	$smarty->assign("act", $act);
}

// include footer
include "footer.php";
?>