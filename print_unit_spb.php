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
	$module = $_GET['module'];
	
	if ($module == 'spb' && $act == 'print')
	{
		$spbID = $_GET['spbID'];
		$spbFaktur = $_GET['spbFaktur'];
		$now = date('Y-m-d');
		
		$filename="unit_purchase_order.pdf";
		$content = ob_get_clean();
		
		// showing up the main transfer data
		$queryMain = "SELECT * FROM purchaseorder WHERE spbID = '$spbID' AND spbFaktur = '$spbFaktur'";
		$sqlMain = mysqli_query($connect, $queryMain);
		$dataMain = mysqli_fetch_array($sqlMain);
		
		$tanggal = tgl_indo2($dataMain['tanggal']);
		$needDate = tgl_indo2($dataMain['needDate']);
		
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
							<td><span style='font-size: 8pt;'>Mall Panakukang, Jl.Boulevard Raya No.1<br>Makassar, Sulawesi Selatan, Indonesia
								</span>
							</td>
							<td><br>
								<span style='font-size: 11pt;'><b>PURCHASE ORDER</b></span>
							</td>
						</tr>
					</table>
					<table cellpadding='0' cellspacing='0' style='width: 240mm;'>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 28mm;'>Nomor</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 3mm;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 100mm;'>$dataMain[spbNo]</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 28mm;'>Kepada Yth,</td>
							<td colspan='2'></td>
						</tr>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>Tanggal</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$tanggal</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;' colspan='3'>$dataMain[namaSupplier]</td>
						</tr>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'></td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'></td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'></td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;' colspan='3'>$dataMain[alamatSupplier]</td>
						</tr>
					</table>
					<br>
					<table cellpadding='0' cellspacing='0' style='width: 270mm; border-bottom: 1px solid #000;'>
						<tr>
							<th style='width: 30mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO.</th>
							<th style='width: 86mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NAMA BARANG</th>
							<th style='width: 35mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>HARGA</th>
							<th style='width: 35mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>JUMLAH</th>
							<th style='width: 15mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>SUBTOTAL</th>
							
						</tr>";
						
						// showing the transfer detail
						$queryTransferDetail = "SELECT * FROM detail_po WHERE spbFaktur = '$spbFaktur' AND spbNo = '$dataMain[spbNo]' ORDER BY detailID ASC";
						$sqlTransferDetail = mysqli_query($connect, $queryTransferDetail);
						
						// fetch data
						$i = 1;
						while ($dtTransferDetail = mysqli_fetch_array($sqlTransferDetail))
						{
							$subtotal = $dtTransferDetail['qty'] * $dtTransferDetail['price'];
							$subtotalrp = rupiah($subtotal);
							
							$price = rupiah($dtTransferDetail['price']);
							
							$note = chunk_split($dtTransferDetail['note'], 42, "<br>");
							$productName = chunk_split($dtTransferDetail['productName'], 35, "<br>");
							
							$content .= "
									<tr valign='top'>
										<td style='padding: 11px 0px 2px 0px; font-size: 9pt;'>$i</td>
										<td style='padding: 11px 0px 2px 0px; font-size: 9pt;'>$productName</td>
										<td style='padding: 11px 95px 2px 0px; font-size: 9pt; text-align: right;'>$price</td>
										<td style='padding: 11px 0px 2px 0px; font-size: 9pt;'>$dtTransferDetail[qty]</td>
										<td style='padding: 11px 110px 2px 0px; font-size: 9pt; text-align: right;'>$subtotalrp</td>
										
									</tr>
							";
							
							$i++;
						}
			$content .= 
						"
						
					</table>
					
					<table cellpadding='0' cellspacing='0' style='width: 230mm;'>
						<tr>
							<td style='width: 160mm;'><p style='padding: 5px 0px 5px 0px; font-size: 8pt;'><br></p></td>
							<td style='padding: 30px 0px 5px 0px; font-size: 9pt; text-align: center; width: 40mm;'>HORMAT KAMI,</td>
						</tr>
						<tr>
							<td style='width: 160mm;'></td>
							<td style='padding: 5px 0px 5px 0px; font-size: 9pt; text-align: center; width: 30mm;'><br><br><br><br>Administrasi</td>
						</tr>
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