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
	$q = mysqli_real_escape_string($connect, $_GET['q']);
	$queryProduct = "SELECT A.productID, A.productCode, A.harga, A.productName FROM barang A WHERE A.productCode LIKE '%$q%' OR A.productName LIKE '%$q%'";
	$sqlProduct = mysqli_query($connect, $queryProduct);
	
	// fetch data
	while ($dtProduct = mysqli_fetch_array($sqlProduct))
	{					
		echo "$dtProduct[productCode] # $dtProduct[productName] # $dtProduct[productID] # $dtProduct[harga]\n";	
	}
}
?>