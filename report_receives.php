<?php
// include header
include "header.php";
// set the tpl page
$page = "report_receives.tpl";

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
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '22'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
		
	// if the module is receive and act is search
	if ($module == 'receive' && $act == 'search')
	{
		$customerID = $_GET['customerID'];
		$sDate = mysqli_real_escape_string($connect, $_GET['startDate']);
		$eDate = mysqli_real_escape_string($connect, $_GET['endDate']);
		
		$smarty->assign("startDate", $sDate);
		$smarty->assign("endDate", $eDate);
		$smarty->assign("customerID", $customerID);
		
		$s2Date = explode("-", $sDate);
		$e2Date = explode("-", $eDate);
		
		$startDate = $s2Date[2]."-".$s2Date[1]."-".$s2Date[0];
		$endDate = $e2Date[2]."-".$e2Date[1]."-".$e2Date[0];
		
		// create new object pagination
		$p = new PaginationReportReceives;
		// limit 20 data for page
		$limit  = 30;
		$position = $p->searchPosition($limit);
		
		// showing up the receivable data
		if ($sDate != '' && $eDate != '')
		{
			if ($customerID != '')
			{
				$queryReceive = "SELECT * FROM as_receivables A INNER JOIN as_sales_transactions B ON A.invoiceID=B.invoiceID WHERE A.customerID = '$customerID' AND B.invoiceDate BETWEEN '$startDate' AND '$endDate' ORDER BY A.createdDate DESC LIMIT $position,$limit";
			}
			else
			{
				$queryReceive = "SELECT * FROM as_receivables A INNER JOIN as_sales_transactions B ON A.invoiceID=B.invoiceID WHERE B.invoiceDate BETWEEN '$startDate' AND '$endDate' ORDER BY A.createdDate DESC LIMIT $position,$limit";
			}			
		}
		else
		{
			if ($customerID != '')
			{
				$queryReceive = "SELECT * FROM as_receivables A INNER JOIN as_sales_transactions B ON A.invoiceID=B.invoiceID WHERE A.customerID = '$customerID' ORDER BY A.createdDate DESC LIMIT $position,$limit";
			}
			else
			{
				$queryReceive = "SELECT * FROM as_receivables A INNER JOIN as_sales_transactions B ON A.invoiceID=B.invoiceID ORDER BY A.createdDate DESC LIMIT $position,$limit";
			}
		}
		
		$sqlReceive = mysqli_query($connect, $queryReceive);
		
		// fetch data
		$i = 1;
		while ($dtReceive = mysqli_fetch_array($sqlReceive))
		{
			$sisa = $dtReceive['receiveTotal'] - ($dtReceive['incomingTotal'] + $dtReceive['reductionTotal']);
			
			if ($sisa <= 0)
			{
				$sisarp = 0;
			}
			else
			{
				$sisarp = rupiah($sisa);
			}
			
			$dataReceive[] = array(	'receiveID' => $dtReceive['receiveID'],
									'receiveNo' => $dtReceive['receiveNo'],
									'invoiceNo' => $dtReceive['invoiceNo'],
									'customerName' => $dtReceive['customerName'],
									'customerID' => $dtReceive['customerID'],
									'receiveTotal' => rupiah($dtReceive['receiveTotal']),
									'incomingTotal' => rupiah($dtReceive['incomingTotal']),
									'reductionTotal' => rupiah($dtReceive['reductionTotal']),
									'sisa' => $sisarp,
									'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataReceive", $dataReceive);
		
		// show the customer data
		$queryCustomer = "SELECT * FROM as_customers ORDER BY customerName ASC";
		$sqlCustomer = mysqli_query($connect, $queryCustomer);
		
		while ($dtCustomer = mysqli_fetch_array($sqlCustomer))
		{
			$dataCustomer[] = array('customerID' => $dtCustomer['customerID'],
									'customerCode' => $dtCustomer['customerCode'],
									'customerName' => $dtCustomer['customerName']);
		}
		
		$smarty->assign("dataCustomer", $dataCustomer);
		
		// count data
		if ($sDate != '' && $eDate != '')
		{
			if ($customerID == '')
			{
				$queryCountReceive = "SELECT * FROM as_receivables A INNER JOIN as_sales_transactions B ON A.invoiceID=B.invoiceID WHERE A.customerID = '$customerID' AND B.invoiceDate BETWEEN '$startDate' AND '$endDate' ORDER BY A.createdDate DESC";
			}
			else
			{
				$queryCountReceive = "SELECT * FROM as_receivables A INNER JOIN as_sales_transactions B ON A.invoiceID=B.invoiceID WHERE B.invoiceDate BETWEEN '$startDate' AND '$endDate' ORDER BY A.createdDate DESC";
			}			
		}
		else
		{
			if ($customerID == '')
			{
				$queryCountReceive = "SELECT * FROM as_receivables A INNER JOIN as_sales_transactions B ON A.invoiceID=B.invoiceID WHERE A.customerID = '$customerID' ORDER BY A.createdDate DESC";
			}
			else
			{
				$queryCountReceive = "SELECT * FROM as_receivables A INNER JOIN as_sales_transactions B ON A.invoiceID=B.invoiceID ORDER BY A.createdDate DESC";
			}
		}
		
		$sqlCountReceive = mysqli_query($connect, $queryCountReceive);
		$amountData = mysqli_num_rows($sqlCountReceive);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		
		$smarty->assign("page", $_GET['page']);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Piutang Dagang");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melihat laporan piutang dagang.");
		$smarty->assign("breadcumbMenuName", "Laporan");
		$smarty->assign("breadcumbMenuSubName", "Piutang Dagang");
	} 
	
	else
	{
		// show the customer data
		$queryCustomer = "SELECT * FROM as_customers ORDER BY customerName ASC";
		$sqlCustomer = mysqli_query($connect, $queryCustomer);
		
		while ($dtCustomer = mysqli_fetch_array($sqlCustomer))
		{
			$dataCustomer[] = array('customerID' => $dtCustomer['customerID'],
									'customerCode' => $dtCustomer['customerCode'],
									'customerName' => $dtCustomer['customerName']);
		}
		
		$smarty->assign("dataCustomer", $dataCustomer);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Piutang Dagang");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melihat laporan piutang dagang.");
		$smarty->assign("breadcumbMenuName", "Laporan");
		$smarty->assign("breadcumbMenuSubName", "Piutang Dagang");
	}
	
	$smarty->assign("module", $module);
	$smarty->assign("act", $act);
}

// include footer
include "footer.php";
?>