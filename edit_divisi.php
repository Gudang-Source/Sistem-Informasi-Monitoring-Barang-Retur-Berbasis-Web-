<?php
// include header
include "header.php";
// set the tpl page
$page = "edit_divisi.tpl";

// if session is null, showing up the text and exit
if ($_SESSION['staffID'] == '' && $_SESSION['email'] == '')
{
	// show up the text and exit
	echo "Anda tidak berhak akses modul ini.";
	exit();
}

else 
{
	// get variable
	$module = $_GET['module'];
	$act = $_GET['act'];
	
	if ($module == 'divisi' && $act == 'edit')
	{
		// insert method into a variable
		$divisiID = $_GET['divisiID'];
		
		// showing up the divisi data based on divisi id
		$queryDivisi = "SELECT * FROM divisi WHERE divisiID = '$divisiID'";
		$sqlDivisi = mysqli_query($connect, $queryDivisi);
		
		// fetch data
		$dataDivisi = mysqli_fetch_array($sqlDivisi);
		
		// assign fetch data to the tpl
		$smarty->assign("divisiID", $dataDivisi['divisiID']);
		$smarty->assign("kodeDivisi", $dataDivisi['kodeDivisi']);
		$smarty->assign("namaDivisi", $dataDivisi['namaDivisi']);
		$smarty->assign("noTelp", $dataDivisi['noTelp']);
	} //close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>