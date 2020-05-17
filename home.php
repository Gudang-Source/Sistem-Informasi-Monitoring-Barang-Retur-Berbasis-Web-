<?php
// include header
include "header.php";
// set the tpl page
$page = "dashboard.tpl";

$module = $_GET['module'];
$act = $_GET['act'];


$querySpb = "SELECT * FROM barang ORDER BY productID DESC";
$sqlSpb = mysqli_query($connect, $querySpb);
$total = mysqli_num_rows($sqlSpb);

$queryPO = "SELECT * FROM purchaseorder ORDER BY spbID DESC";
$sqlPO = mysqli_query($connect, $queryPO);
$total1 = mysqli_num_rows($sqlPO);

$querySupplier = "SELECT * FROM supplier ORDER BY supplierID DESC";
$sqlSupplier = mysqli_query($connect, $querySupplier);
$total2 = mysqli_num_rows($sqlSupplier);

$sekarang= date('Y-m-d');
$min1bulan= date('Y-m-d', strtotime("+1 months",strtotime($sekarang)));
$queryKadaluarsa = "SELECT DATEDIFF(mep,now()) as date_difference from detail_barang where mep <='".$min1bulan . "' AND qty_brg>0 ";
$sqlKadaluarsa = mysqli_query($connect, $queryKadaluarsa);
$total3 = mysqli_num_rows($sqlKadaluarsa);

$queryRetur = "SELECT * FROM retur";
$sqlRetur= mysqli_query($connect, $queryRetur);
$anshar = mysqli_num_rows($sqlRetur);


$smarty->assign("total", $total);
$smarty->assign("total1", $total1);
$smarty->assign("total2", $total2);
$smarty->assign("total3", $total3);
$smarty->assign("anshar", $anshar);
$smarty->assign("msg", $_GET['msg']);
$smarty->assign("breadcumbTitle", "Home");
$smarty->assign("breadcumbTitleSmall", "Halaman utama aplikasi");
$smarty->assign("breadcumbMenuName", "Home");
$smarty->assign("breadcumbMenuSubName", "Dashboard");

// include footer
include "footer.php";
?>
