<?php
// include header
include "header.php";
// set the tpl page
$page = "product_autocomplete.tpl";

// if session is null, showing up the text and exit
if ($_SESSION['staffID'] == '' && $_SESSION['email'] == '')
{
	// show up the text and exit
	echo "You have not authorization for access the modules.";
	exit();
}

else 
{
	$q = $_GET['q'];
	$queryTrf = "SELECT transferFrom FROM as_transfers WHERE transferFaktur = '$_SESSION[transferFaktur]'";
	$sqlTrf = mysqli_query($connect, $queryTrf);
	$dataTrf = mysqli_fetch_array($sqlTrf);
	
	$queryProduct = "SELECT B.productID, B.productCode, B.productName, A.stock FROM as_stock_products A INNER JOIN barang B ON B.productID=A.productID WHERE B.productCode LIKE '%$q%' OR B.productName LIKE '%$q%' AND A.factoryID = '$dataTrf[transferFrom]'";
	$sqlProduct = mysqli_query($connect, $queryProduct);
	
	// fetch data
	while ($dtProduct = mysqli_fetch_array($sqlProduct))
	{
		echo "$dtProduct[productCode] - $dtProduct[productName] - $dtProduct[productID] - $dtProduct[stock]\n";	
			
	}	
}
?>