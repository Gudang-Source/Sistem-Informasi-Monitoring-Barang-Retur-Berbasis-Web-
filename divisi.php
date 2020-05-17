<?php
// include header
include "header.php";
// set the tpl page
$page = "divisi.tpl";

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
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '2'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
		
	// if module is divisi and action is delete
	if ($module == 'divisi' && $act == 'delete')
	{
		// insert method into a variable
		$divisiID = $_GET['divisiID'];
		$page = $_GET['page'];
		
		// delete divisi
		$queryDivisi = "DELETE FROM divisi WHERE divisiID = '$divisiID'";
		$sqlDivisi = mysqli_query($connect, $queryDivisi);
		
		// redirect to the divisi page
		header("Location: divisi.php?page=".$page."&msg=Data divisi berhasil dihapus");
	} // close bracket
	
	// if module is divisi and act is search
	elseif ($module == 'divisi' && $act == 'search')
	{
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		
		$queryDivisi = "SELECT * FROM divisi WHERE kodeDivisi LIKE '%$q%' OR namaDivisi LIKE '%$q%'";
		$sqlDivisi = mysqli_query($connect, $queryDivisi);
		
		// fetch data
		$i = 1;
		while ($dtDivisi = mysqli_fetch_array($sqlDivisi))
		{
			$dataDivisi[] = array('divisiID' => $dtDivisi['divisiID'],
									'kodeDivisi' => $dtDivisi['kodeDivisi'],
									'namaDivisi' => $dtDivisi['namaDivisi'],
									'noTelp' => $dtDivisi['noTelp'],
									'no' => $i);
			$i++;
		}
		
		// assign 
		$smarty->assign("dataDivisi", $dataDivisi);
		$smarty->assign("q", $q);
	}
	
	else
	{	
		// create new object pagination
		$p = new PaginationCustomer;
		// limit 20 data for page
		$limit  = 10;
		$position = $p->searchPosition($limit);
		
		// showing up the divisi data
		$queryDivisi = "SELECT * FROM divisi ORDER BY kodeDivisi ASC LIMIT $position,$limit";
		$sqlDivisi = mysqli_query($connect, $queryDivisi);
		
		// fetch data
		$i = 1 + $position;
		while ($dtDivisi = mysqli_fetch_array($sqlDivisi))
		{
			$dataDivisi[] = array('divisiID' => $dtDivisi['divisiID'],
									'kodeDivisi' => $dtDivisi['kodeDivisi'],
									'namaDivisi' => $dtDivisi['namaDivisi'],
									'noTelp' => $dtDivisi['noTelp'],
									'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataDivisi", $dataDivisi);
		
		// count data
		$queryCountDivisi = "SELECT * FROM divisi";
		$sqlCountDivisi = mysqli_query($connect, $queryCountDivisi);
		$amountData = mysqli_num_rows($sqlCountDivisi);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		$smarty->assign("page", $_GET['page']);
	}
	
	$smarty->assign("msg", $_GET['msg']);
	$smarty->assign("breadcumbTitle", "Manajemen Divisi");
	$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan pengolahan data master divisi.");
	$smarty->assign("breadcumbMenuName", "Master Data");
	$smarty->assign("breadcumbMenuSubName", "Divisi");
}

// include footer
include "footer.php";
?>