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
	
	if ($act == 'print')
	{
		$now = date('Y-m-d');
		
		$filename="product.pdf";
		$content = ob_get_clean();
		
		$content = "<table style='border-bottom: 1px solid #999999; padding-bottom: 10px; width: 290mm;'>
						<tr valign='top'>
							<td style='width: 290mm;' valign='middle'>
								<div style='font-weight: bold; padding-bottom: 5px; font-size: 12pt; text-align:center;'>
									PT. LOTTE MART INDONESIA CABANG MAKASSAR
								</div>
								<div style='font-size: 10pt; text-align:center;'>Mall Panakukang, Jl.Boulevard Raya No.1, Makassar, Sulawesi Selatan, Indonesia</div>
							</td>
						</tr>
					</table>
					<p style='width: 290mm; font-size: 11pt;'><span style='font-size: 10pt;'><b>DATA BARANG</b></span></p>
					<table cellpadding='0' cellspacing='0' style='width: 290mm;'>
						<tr>
							<th style='width: 30mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>No.</th>
							<th style='width: 115mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>KODE - NAMA BARANG</th>
							<th style='width: 65mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>SATUAN</th>
							<th style='width: 55mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>HARGA </th>
							<th style='width: 27mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999; text-align:center;'>STOCK</th>
						</tr>";
						
						// showing the products
						if ($q != '')
						{
							$queryProduct = "SELECT * FROM barang WHERE productCode LIKE '%$q%' OR productName LIKE '%$q%' ORDER BY productCode ASC";
						}
						else
						{
							$queryProduct = "SELECT * FROM barang ORDER BY productCode ASC";
						}
						$sqlProduct = mysqli_query($connect, $queryProduct);
						
						// fetch data
						$i = 1;
						while ($dtProduct = mysqli_fetch_array($sqlProduct))
						{
							// count stock product
							$queryStock = "SELECT SUM(stock) as stockAmount FROM barang WHERE productID = '$dtProduct[productID]'";
							$sqlStock = mysqli_query($connect, $queryStock);
							$dataStock = mysqli_fetch_array($sqlStock);
							
							if ($dtProduct['unit'] == '1')
							{
								$unit = "PCS";
							}
							elseif ($dtProduct['unit'] == '2')
							{
								$unit = "SACHET";
							}
							elseif ($dtProduct['unit'] == '3')
							{
								$unit = "BOX";
							}
							elseif ($dtProduct['unit'] == '4')
							{
								$unit = "PACK";
							}
							$harga = rupiah($dtProduct['harga']);
							
							$content .= "
								<tr valign='top'>
									<td style='padding: 5px 0px 5px 0px; font-size: 9pt;'>$i</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 9pt;'>$dtProduct[productName]</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 9pt;'>$unit</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 9pt;'>$harga</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 9pt; text-align:center;'>$dataStock[stockAmount]</td>
								</tr>
							";
							$i++;
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
		$html2pdf = new HTML2PDF('L', 'A4','fr', false, 'ISO-8859-15',array(2, 2, 2, 2)); //setting ukuran kertas dan margin pada dokumen anda
		// $html2pdf->setModeDebug();
		$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { echo $e; }
}
?>