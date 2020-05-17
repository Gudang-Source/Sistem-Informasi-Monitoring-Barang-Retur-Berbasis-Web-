<?php
include "header.php";

// if session is null, showing up the text and exit
if ($_SESSION['staffID'] == '' && $_SESSION['email'] == '')
{
	// show up the text and exit
	echo "You have not authorization for access the modules.";
	exit();
}

else{
	
	ob_start();
	require ("includes/html2pdf/html2pdf.class.php");
	
	$act = $_GET['act'];
	$q = mysqli_real_escape_string($connect, $_GET['q']);
	$sDate = mysqli_real_escape_string($connect, $_GET['startDate']);
	$eDate = mysqli_real_escape_string($connect, $_GET['endDate']);
	
	$s2Date = explode("-", $sDate);
	$e2Date = explode("-", $eDate);
	
	$startDate = $s2Date[2]."-".$s2Date[1]."-".$s2Date[0];
	$endDate = $e2Date[2]."-".$e2Date[1]."-".$e2Date[0];
	
	if ($act == 'print')
	{
		$now = date('Y-m-d');
		
		$filename="purchase_order.pdf";
		$content = ob_get_clean();
		
		$content = "<table style='padding-bottom: 10px; width: 240mm;'>
						<tr valign='top'>
							<td style='width: 150mm;' valign='middle'>
								<div style='font-weight: bold; padding-bottom: 5px; font-size: 12pt;'>
									PT. LOTTE MART INDONESIA CABANG MAKASSAR
								</div>
							</td>
							<td style='width: 83mm;'></td>
						</tr>
						<tr valign='top'>
							<td>
								<span style='font-size: 11pt;'><b>BARANG RUSAK</b></span>
							</td>
						</tr>
					</table>
					<table cellpadding='0' cellspacing='0' style='width: 290mm;'>
						<tr>
							<th style='width: 10mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO.</th>
							<th style='width: 39mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>KODE BRG RUSAK</th>
							<th style='width: 21mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>TANGGAL</th>
							<th style='width: 37mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>SUPPLIER</th>
							<th style='width: 10mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO</th>
							<th style='width: 50mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NOMOR DETAIL BARANG</th>
							<th style='width: 30mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NAMA BARANG</th>
							<th style='width: 20mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>JUMLAH</th>
							<th style='width: 20mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>KET</th>
						</tr>";
						
						// showing the spb invoice
						if ($sDate != '' || $eDate != '')
						{
							$querySpb = "SELECT * FROM barangrusak WHERE KD_brg_rusak LIKE '%$q%' AND orderDate BETWEEN '$startDate' AND '$endDate' ORDER BY tanggal DESC";
						}
						else
						{
							$querySpb = "SELECT * FROM barangrusak WHERE KD_brg_rusak LIKE '%$q%'";
						}
						
						$sqlSpb = mysqli_query($connect, $querySpb);
						
						// fetch data
						$i = 1;
						while ($dtSpb = mysqli_fetch_array($sqlSpb))
						{
							$tanggal = tgl_indo2($dtSpb['orderDate']);
							
							// showing up the detail spb
							$queryDetail = "SELECT * FROM detail_barangrusak WHERE KD_brg_rusak = '$dtSpb[KD_brg_rusak]'";
							$sqlDetail = mysqli_query($connect, $queryDetail);
							
							$namaSupplier = chunk_split($dtSpb['namaSupplier'], 23, "<br>");
							
							$content .= "
									<tr valign='top'>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$i</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dtSpb[KD_brg_rusak]</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$tanggal</td>
										<td colspan='3'></td>
									</tr>
							";
							
							// fetch data
							$k = 1;
							$sum = array();
							while ($dtDetail = mysqli_fetch_array($sqlDetail))
							{
								$productName = chunk_split($dtDetail['productName'], 30, "<br>");
								$price = rupiah($dtDetail['price']);
								$nodetailbrg = $dtDetail['no_detail_brg'];
								$subt = $dtDetail['price'] * $dtDetail['qty'];
								$sum[] = $subt;
								$subtotal = rupiah($subt);
								
								$grand = array_sum($sum);
								
								$content .= "
									<tr valign='top'>
										<td colspan='3'></td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dtDetail[namaSupplier]</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$k</td>
										<td style='padding: 2px 25px 2px 0px; font-size: 9pt;'>$nodetailbrg</td>
										<td style='padding: 2px 15px 2px 0px; font-size: 9pt;'>$productName</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt; text-align:center;'>$dtDetail[jumlah]</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dtDetail[ket]</td>
									</tr>
								";
								$k++;
							}
							
						}
			$content .= 
						"
						
					</table>
				
					";
	}
	
	ob_end_clean();
	// conversion HTML => PDF
	try
	{
		$html2pdf = new HTML2PDF('L', array('240', '130'),'fr', false, 'ISO-8859-15',array(2, 2, 2, 2)); //setting ukuran kertas dan margin pada dokumen anda
		// $html2pdf->setModeDebug();
		$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { echo $e; }
}
?>